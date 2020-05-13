<?php
error_reporting(0);
$host   = "localhost";
$dbname = "database";
$dbuser = "root";
$dbpass = "";

$conn = new PDO("mysql:host=$host;dbname=$dbname","$dbuser","$dbpass");
?>