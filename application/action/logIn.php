<?php
include_once 'application/core/database/connect.php';

$pdo=new PDO_();

$json_array=json_decode(file_get_contents("php://input"),true);
