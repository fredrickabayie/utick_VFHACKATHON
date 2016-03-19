<?php
session_start();
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 3/19/16
 * Time: 2:01 AM
 */

require_once 'Twig-1.x/lib/Twig/Autoloader.php';

require_once '../models/event.php';

Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('basicView.html.twig');
$params = array();


/**
 * Get events
 */

if(isset($_REQUEST['id'])) {

    $id = $_REQUEST['id'];
    $event = new events();
    $event->viewEventDetails($id);
    $row = $event->fetch();

    $_SESSION['current_event'] = $row;

    $params['event'] = $row;
}


$template->display($params);