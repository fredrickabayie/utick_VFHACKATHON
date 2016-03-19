<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/19/16
 * Time: 5:35 AM
 */

session_start();

require_once '../sms_module/event_sms_sender.php';

$ticket_info = "Dear Customer: \r\n Ticket Receipt";

$ticket_info.= "Event : ".$_SESSION['current_event']['name']."\r\n";
$ticket_info.= "Cost : ".$_SESSION['current_event']['cost']."\r\n";
$ticket_info.= "Event Date : ".$_SESSION['current_event']['date']."\r\n";
$ticket_info.= "Event Time : ".$_SESSION['current_event']['time']."\r\n";
$ticket_info.= "Transaction ID : ".incrementalHash(10)."\r\n";
$ticket_info.= "Transaction Date : ".date("Y/m/d")." : ".date("h:i:sa")."\r\n";

//sendSMS("+233209339957", $ticket_info);
sendSMS("+233200393945", $ticket_info);

/**
 * Obtained from stack over flow
 * Credits to
 *
 * @param int $len
 * @return string
 */
function incrementalHash($len = 10){
    $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $base = strlen($charset);
    $result = '';

    $now = explode(' ', microtime())[1];
    while ($now >= $base){
        $i = $now % $base;
        $result = $charset[$i] . $result;
        $now /= $base;
    }
    return substr($result, -10);
}