<?php

$host = "127.0.0.1";    /* Host name */
$user = "sepaystu_guest	";         /* User */
$password = "sepayguest";         /* Password */
$dbname = "sepaystu_cahayu";   /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 	die("Connection failed: " . mysqli_connect_error());
}