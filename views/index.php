<?php

session_start();

require_once 'Twig-1.x/lib/Twig/Autoloader.php';

require_once '../models/event.php';

Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('home.html.twig');
$params = array();


/**
 * Get events
 */

$event = new events();
$event->getAllEvents();
$row = $event->fetch_all();

$params['events'] = $row;


$template->display($params);