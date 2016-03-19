<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/18/16
 * Time: 9:05 PM
 */

require_once '../sms_module/event_sms_sender.php';


function sendEvents($users, $events){
    foreach($users as $phone){
        sendSMS($phone, $events);
    }
}

function getUsers()
{
    $user = userModel();
    $users = [];

    if ($user->fetch_users()) {
        $row = $user->fetch_all();

        foreach ($row as $value) {
            $phone = $value['phone'];
            $users[] = $phone;
        }
    }

    return $users;
}

/**
 *  This function retrieves events
 *
 */
function getEvents(){

    $event_json = json_decode(@file_get_contents('https://gh-disaster-relief.appspot.com/_ah/api/ticketApi/v1/ticket'));

    $items1 = $event_json->items;


    $str = 'Upcoming Events:'."\n";
    foreach($items1 as $key=>$value){


//            echo $key . " : ". $value->id. " <br>";
            $str.= "Event :".$value->name. "\r\n ";
            @$str.= "Location :". $value->location. " \r\n";
//            echo $key . " : ". $value->discription. " <br>";
            @$str.="Price :".$value->price. " \r\n";
            $str.="\r\n";
//            echo $key . " : ". $value->seats. " <br>";
    }
    return $str;
}


function userModel(){
    require_once '../models/user.php';
    $user = new user();
    return $user;
}

$events = getEvents();

$users = getUsers();

sendEvents($users, $events);

