<?php

//turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//require autoload
require_once('vendor/autoload.php');

session_start();

//create and instance of the Base class
$f3 = Base::instance();
//turn on fat free error reporting
$f3->set('DEBUG',3);

//define a default route
$f3->route('GET /', function(){
    echo '<h1>My Pets</h1>';
    echo '<a href="order">Order a pet</a>';
    //$view = new View;
    //echo $view->render('views/home.html');
});

$f3->route('GET /@pet', function ($f3, $params)
{
    print_r($params);
    $pet = $params['pet'];

    switch($pet) {

        case 'dog':
            echo "<p>Woof!</p>";
            break;

        case 'chicken':
            echo "<p>Cluck!</p>";
            break;

        case 'cat':
            echo "<p>Meow!</p>";
            break;

        case 'tiger':
            echo "<p>Rawr!</p>";
            break;

        case 'cow':
            echo "<p>Moo!</p>";
            break;

        default:
            $f3->error(404);
    }
});

$f3->route('GET /order', function(){
    $view = new View;
    echo $view->render('views/form1.html');
});
$f3->route('POST /order2', function($f3){
    //print_r($_POST);
    $_SESSION["animal"] = $_POST[animal];
    $f3->set("animal", $_SESSION["animal"]);
    //print_r($_SESSION);

    $view = new View;
    echo $view->render('views/form2.html');
});

$f3->route('POST /results', function($f3){
    //print_r($_POST);
    $_SESSION["color"] = $_POST[color];
    $f3->set("color", $_SESSION["color"]);
    //print_r($_SESSION);

    $template = new Template();
    echo $template->render('views/results.html');
});

//run fat free
$f3->run();