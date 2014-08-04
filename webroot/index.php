<?php
error_reporting(-1);ini_set('display_errors',1);
include('../system/Config.php');
require '../system/PageHandler.class.php';
$uri = explode('/', strpos($_SERVER['REQUEST_URI'], '?') ? strstr($_SERVER['REQUEST_URI'], '?', true) : $_SERVER['REQUEST_URI']);
foreach($uri as $id => $dir){
    if($dir == ""){
        unset($uri[$id]);
    }
}
$page = isset($uri[1]) ? $uri[1] : 'index';
array_shift($uri);
$args = $uri === NULL ? array() : $uri;

if (!preg_match("/[a-zA-Z0-9\/]/", $page))
    die("Attempted injection");

if(strpos($page, '_') === 0){
    include $page.'.php'; // BE WEARY OF INJECTION!!!
} else {
    new PageHandler($page, $args);
}
