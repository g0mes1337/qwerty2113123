<?php
include_once '../core/database/connect.php';
$pdo = new PDO_();

$request = json_decode(file_get_contents("php://input"), true);
try {
    $pdo->updateCourses($request['title'],$request['description'],$request['price'],$request['date_courses']);
}
catch (PDOException $exception){
    print $exception;
}
