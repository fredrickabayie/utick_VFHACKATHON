<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/19/16
 * Time: 5:35 AM
 */

session_start();

require_once '../sms_module/event_sms_sender.php';

$ticket_info = "Dear Customer: \r\n Ticket Receipt \r\n";

$ticket_info.= "Event : ".$_SESSION['current_event']['name']."\r\n";
$ticket_info.= "Cost : ".$_SESSION['current_event']['cost']."\r\n";
$ticket_info.= "Event Date : ".$_SESSION['current_event']['date']."\r\n";
$ticket_info.= "Event Time : ".$_SESSION['current_event']['time']."\r\n";

$transaction_id = incrementalHash(10);
$transaction_id .= date("Y")."".date("m")."".date("m")."".date("h")."".date("i")."".date("sa");

$ticket_info.= "Transaction ID : ".$transaction_id."\r\n";


$ticket_info.= "Transaction Date : ".date("Y/m/d")." : ".date("h:i:sa")."\r\n";

//sendSMS("+233209339957", $ticket_info);
sendSMS("+233200393945", $ticket_info);

header("Location: ../views/index.php");

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