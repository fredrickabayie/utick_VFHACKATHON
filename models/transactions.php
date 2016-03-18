<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 1:11 AM
 */

require_once 'adb_object.php';


class transactions extends adb_object{


    /**
     * transactions constructor.
     */
    function transactions(){

    }

    /**
     * @param $total
     * @param $user_email
     * @return bool
     */
    function addReceipt($total, $user_email){

        $str_query = "INSERT INTO receipts
                      SET
                      total_cost = $total,
                      user_email = $user_email,
                      date = NOW()";

        return $this->query($str_query);
    }


    /**
     * @param $trans_id
     * @param $seat_no
     * @return bool
     */
    function assignSeat($trans_id, $seat_no){

        $str_query = "INSERT INTO seat_assignment
                      SET
                      transaction_id = $trans_id,
                      seat_no = $seat_no";


        return $this->query($str_query);
    }


    /**
     * @param $receipt_id
     * @param $schedule_no
     * @return bool
     */
    function addTransaction($receipt_id, $schedule_no){

        $str_query = "INSERT INTO transactions
                      SET
                      receipt_id = $receipt_id,
                      schedule_no = $schedule_no";

        return $this->query($str_query);
    }


    /**
     * @param $receipt
     */
    function getTransaction($receipt){

        $str_query = "SELECT * FROM
                      transactions T INNER JOIN receipts R
                      ON T.receipt_id = R.receipt_id
                      INNER JOIN event_schedule ES
                      ON T.schedule_no = ES.schedule_no
                      INNER JOIN event E
                      ON ES.event_id = E.event_id
                      WHERE T.receipt_id = $receipt";


        return $this->query($str_query);
    }

    function setSeatNumber($transaction_id, $seat_no){
        $str_query = "INSERT INTO seat_assignment
                      SET transaction_id = $transaction_id,
                      seat_no = '$seat_no'";

        return $this->query($str_query);
    }


}