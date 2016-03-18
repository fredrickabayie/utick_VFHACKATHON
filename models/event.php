<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 12:54 AM
 */

require_once 'adb_object.php';


class events extends adb_object{


    function events(){

    }


    /**
     * @param $category
     * @return bool
     */
    function getEventsByCategory($category){

        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.category = '$category'";

        return $this->query($str_query);
    }


    /**
     * @param $event
     * @return bool
     */
    function searchEventsByName($event){
        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.name LIKE '%$event%'";

        return $this->query($str_query);
    }


    /**
     * @param $id
     * @return bool
     */
    function viewEventDetails($id){

        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.event_id = $id";

        return $this->query($str_query);
    }
}