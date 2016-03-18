<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 12:54 AM
 */

require_once 'Adb.php';


class Events extends Adb{


    public function __destruct()
    {
        // TODO: Implement __destruct() method.


    }


    /**
     * @param $category
     * @return bool
     */
    function getEventsByCategory($category){

        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.category = ?";

        if ($statement = $this->prepare($str_query)) {
            $statement->bind_param("s", $category);
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }

    /**
     * @return bool
     */
    function getAllEvents(){
        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id";

        if ($statement = $this->prepare($str_query)) {
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }


    /**
     * @param $event
     * @return bool
     */
    function searchEventsByName($event){
        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.name LIKE ?";

        if ($statement = $this->prepare($str_query)) {
            $statement->bind_param("s", $event);
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }


    /**
     * @param $id
     * @return bool
     */
    function viewEventDetails($id){

        $str_query = "SELECT * FROM
                      event E INNER JOIN event_schedule ES
                      ON E.event_id = ES.event_id
                      WHERE E.event_id = ?";

        if ($statement = $this->prepare($str_query)) {
            $statement->bind_param("i", $id);
            $statement->execute();
            return $statement->get_result();
        }
        $statement->close();
        return false;
    }


    /**
     * @param $schedule_no
     * @param $seats
     * @return bool
     */
    function updateSeatNumber($schedule_no, $seats){

        $str_query = "UPDATE event_schedule
                      SET seats = $seats
                      WHERE schedule_no = $schedule_no";

        return $this->query($str_query);
    }


    /**
     * @param $schedule_no
     * @return bool
     */
    function getSeats($schedule_no){
        $str_query = "SELECT * FROM event_schedule
                      WHERE schedule_no = $schedule_no";

        return $this->query($str_query);
    }
}




