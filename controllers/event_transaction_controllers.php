<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 5:06 AM
 */


session_start();

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            /**
             * View events
             */
            viewEvents();
            break;
        case 2:
            /**
             * Search Events
             */

            searchEvents();
            break;
        case 3:
            /**
             * Add Transactions
             */

            break;
        case 4:
            /**
             * Add Receipts
             */


            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}


/**
 *
 */
function viewEvents(){

    $obj = get_event_model();


    if ($obj->getAllEvents()){
        echo '{"result":1, "events":[';
        $row = $obj->fetch();
        while($row){
            echo json_encode($row);
            if( $row = $obj->fetch()){
                echo ',';
            }
        }
        echo ']}';
    }else{
        echo '{"result":0,"message": "query unsuccessful"}';
    }
}

/**
 *
 */
function searchEvents(){
    if(filter_input (INPUT_GET, 'st')){

        $obj = get_event_model();

        $st = sanitize_string(filter_input (INPUT_GET, 'st'));

        if ($obj->searchEventsByName($st)){
            echo '{"result":1, "events":[';
            $row = $obj->fetch();
            while($row){
                echo json_encode($row);
                if( $row = $obj->fetch()){
                    echo ',';
                }
            }
            echo ']}';
        }else{
            echo '{"result":0,"message": "query unsuccessful"}';
        }
    }
}



function purchase(){



    /**
     * Connect To VF Cash First
     * First send reciept
     * Then send individual Transactions
     * Then update seat number via schedule no
     *
     */
}

/**
 * Function for adding a receipt
 */
function addReceipt(){

    if(filter_input(INPUT_GET, 'totalCost') && filter_input(INPUT_GET, 'user')){

        $obj = get_transaction_model();
        $totalCost = sanitize_string(filter_input (INPUT_GET, 'totalCost'));
        $user = sanitize_string(filter_input (INPUT_GET, 'user'));

        if($obj->addReceipt($totalCost, $user)){
            $_SESSION['receipt_id'] = $obj->get_insert_id();
            echo '{"result":1,"message": "receipt added"}';
        }else{
            echo '{"result":0,"message": "unsuccesful transaction"}';
        }
    }
}


/**
 * Function for individual transactions
 */
function addTransaction(){
    if(filter_input(INPUT_GET, 'schedule_no')){

        $obj = get_transaction_model();
        $events = get_event_model();

        $receipt_id = $_SESSION['receipt_id'];
        $sch_no = sanitize_string(filter_input (INPUT_GET, 'schedule_no'));

        if($obj->addTransaction($receipt_id, $sch_no)){

            $events->getSeats($sch_no);

            $row = $events->fetch();

            $seats = $row['seats'];

            /** Update Seats Available */
            $events->updateSeats($sch_no, $seats-1);

            if(filter_input(INPUT_GET, 'seat_no')){

                $seat_no = sanitize_string(filter_input (INPUT_GET, 'seat_no'));

                $trans_id = $obj->get_insert_id();
                if($obj->assignSeat($trans_id, $seat_no )){
                    echo '{"result":1,"message": "seats assigned"}';
                }
            }
            echo '{"result":1,"message": "transaction added"}';
        }else{
            echo '{"result":0,"message": "query unsuccessful"}';
        }
    }
}













/**
 * @param $val
 * @return string
 */
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


/**
 * @return events
 */
function get_event_model(){
    require_once '../models/event.php';
    $obj = new events();
    return $obj;
}

/**
 * @return transactions
 */
function get_transaction_model(){
    require_once '../models/transactions.php';
    $obj = new transactions();
    return $obj;
}