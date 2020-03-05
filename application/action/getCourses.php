<?php
include_once '../core/database/connect.php';
$pdo = new PDO_();

print json_encode($pdo->getCourses());