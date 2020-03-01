<?php


class PDO_ extends PDO
{
    public $dsn = 'mysql:host=localhost;dbname=courses_db';
    public $user = 'root';
    public $pass = '';


    /**
     * PDO constructor.
     */
    public function __construct()
    {
        try {
            parent::__construct($this->dsn, $this->user, $this->pass);

        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();

        }
    }

    function addUser($mail, $password)
    {
        $query = $this->prepare("INSERT INTO `user`( `mail`, `password`) VALUES (:mail,:password)");
        $query->bindParam(':mail', $mail, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
    }

    function addCourses($title, $description, $date_courses, $price)
    {
        $query = $this->prepare("INSERT INTO `courses`(`title`,`description`, `date_courses`, `price` ) VALUES (:title,:description,:date_courses,:price)");
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':date_courses', $date_courses, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->execute();

    }


}

