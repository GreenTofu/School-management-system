<?php
$host = "localhost";
$username = "root";
$pw = "";
$db = "smsdb";

$conn = new mysqli($host, $username, $pw, $db);
session_start();