<?php
session_start();

if(filter_input (INPUT_GET, 'cmd')){
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitize_string( filter_input (INPUT_GET, 'cmd'));
    $cmd = intval($cmd_sanitize);

    switch ($cmd){
        case 1:
            user_signup_control();
            break;
        case 2:
            user_login_control();
            break;
        default:
            echo '{"result":0, "message":"Invalid Command Entered"}';
            break;
    }
}

//signup admin user
function user_signup_control(){

    $obj  = $username = $password = $usertype = $row = '';

    if( filter_input (INPUT_GET, 'email') && filter_input(INPUT_GET, 'pass') && filter_input(INPUT_GET, 'phone')){

        $obj = get_user_model();
        $username = sanitize_string(filter_input (INPUT_GET, 'email'));
        $password = sanitize_string(filter_input (INPUT_GET, 'pass'));
        $phone = sanitize_string(filter_input (INPUT_GET, 'phone'));

        if ($obj->addUser($username,  $phone, $password)){
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['phone'];
            echo '{"result":1,"message": "signup successful"}';
        }else{
            echo '{"result":0,"message": "signup unsuccessful"}';
        }

    }
}


//login
function user_login_control(){

    $obj = $username = $pass = '';

    if(filter_input (INPUT_GET, 'email') && filter_input(INPUT_GET, 'pass')){

        $obj = get_user_model();
        $username = sanitize_string(filter_input (INPUT_GET, 'email'));
        $pass = sanitize_string(filter_input (INPUT_GET, 'pass'));

        if($obj->loginUser($username, $pass)){
            $row = $obj->fetch();
            if(count($row) == 0){
                echo '{"result":0,"message": "sign in unsuccessful"}';
            }else{
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone'] = $row['phone'];
                echo '{"result":1,"message": "sign in successful"}';
            }
        }
        else{
            echo '{"result":0,"message": "Invalid User"}';
        }
    }else{
        echo '{"result":0,"message": "Invalid Credentials"}';
    }

}


//sanitize command sent
function sanitize_string($val){
    $val = stripslashes($val);
    $val = strip_tags($val);
    $val = htmlentities($val);

    return $val;
}


//create an instance of the user class
function get_user_model(){
    require_once '../models/user.php';
    $obj = new user();
    return $obj;
}





