<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 1:11 AM
 */

require_once 'adb_object.php';


class transactions extends adb_object{


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


    function addTransaction($receipt_id, $event_id){

        $str_query = "INSERT INTO transactions
                      SET
                      receipt_id = $receipt_id,
                      event_id = $event_id";

        return $this->query($str_query);
    }


    /**
     * @param $receipt
     */
    function getTransaction($receipt){

        $str_query = "SELECT * FROM
                      transactions T INNER JOIN receipts R
                      ON T.receipt_id = R.receipt_id
                      INNER JOIN event E
                      ON T.event_id = E.event_id
                      INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE T.receipt_id = $receipt";

    }


}