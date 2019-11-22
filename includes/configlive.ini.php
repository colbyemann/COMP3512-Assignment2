<?php
$url = getenv('mysql://tkvd4h5t0qak1d2p:ik8znm2000si7662@am1shyeyqbxzy8gc.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/pv6ckb3kah9ykgpa');
$dbparts = parse_url($url);

$hostname = $dbparts['host'];
$username = $dbparts['user'];
$password = $dbparts['pass'];
$database = ltrim($dbparts['path'],'/');
?>