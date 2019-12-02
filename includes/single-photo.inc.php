<?php
require_once('includes\config.inc.php');
require_once('includes\db-functions.inc.php');

$photoArray = null;

function getArray($code){
$data = file_get_contents("http://localhost/Assignment_2/api-photos.php");
$photos = json_decode($data, true);

$GLOBALS['photoArray'] = $photos;

};

function getInfo($code){

    

};

function getPhoto($code){

    

};

?>