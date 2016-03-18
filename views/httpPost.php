<?php
/**
 * Created by PhpStorm.
 * User: fredrickabayie
 * Date: 18/03/2016
 * Time: 08:48
// */
//

echo "okay files";
//function httpPost($url,$params)
//{
//    $postData = '';
//    //create name value pairs seperated by &
//    foreach($params as $k => $v)
//    {
//        $postData .= $k . '='.$v.'&';
//        http_build_query($params);
//    }
//    $postData = rtrim($postData, '&');
//
////    http_build_query($params);
//
//    $ch = curl_init();
//
//    curl_setopt($ch,CURLOPT_URL,$url);
//    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//    curl_setopt($ch,CURLOPT_HEADER, false);
//    curl_setopt($ch, CURLOPT_POST, count($postData));
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
//
//    $output=curl_exec($ch);
//
//    curl_close($ch);
//    return $output;
//}
//
//
//function httpGet($url)
//{
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_URL, $url);
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//    curl_setopt($ch,CURLOPT_HEADER, false);
//
//    $output = curl_exec($ch);
//
//    if($output === false){
//        echo 'Error Number:'.curl_errno($ch).'<br>';
//        echo 'Error String:'.curl_error($ch);
//    }
//
//    curl_close($ch);
//    return $output;
//}
//
////username=711507&password=hackathon2&token=abc1234&amount=3.00
//
//$params = array(
//    "username" => "711507",
//    "password" => "hackathon2",
//    "token" => "abc1234",
//    "amount" => "3"
//);
//
//echo httpPost("http://testpay.vodafonecash.com.gh",$params);