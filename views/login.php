<?php
/**
 * Created by PhpStorm.
 * User: StreetHustling
 * Date: 2/15/16
 * Time: 3:13 PM
 */

require_once 'Twig-1.x/lib/Twig/Autoloader.php';

require_once '../models/user.php';
Twig_Autoloader::register();


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
$template =$twig->loadTemplate('sample.html.twig');
$params = array();


if(isset($_POST['cmd'])){
    echo $_POST['cmd'];
}



$template->display($params);