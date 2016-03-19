<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 4:55 AM
 */

require_once 'adb_object.php';


class user extends adb_object{

    /**
     * user constructor.
     */
    function user(){

    }

    /**
     * @param $email
     * @param $phone
     * @param $password
     * @return bool
     */
    function addUser($email, $phone, $password){

        $str_query = "INSERT INTO users
                      SET
                      email = '$email',
                      phone = '$phone',
                      password = PASSWORD('$password')";

        return $this->query($str_query);
    }


    /**
     * @param $email
     * @param $password
     * @return bool
     */
    function loginUser($email, $password){

        $str_query = "SELECT * FROM users
                      WHERE email = '$email'
                      AND password = PASSWORD('$password')";

        return $this->query($str_query);
    }


    /**
     *
     */
    function fetch_users()
    {

        $str_query = "SELECT * FROM users";

        return $this->query($str_query);
    }
}