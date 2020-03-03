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

    function SignUp($mail, $password)
    {
        $root = $this->addAdmin($mail, $password);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = $this->prepare("INSERT INTO `user` (`mail`, `password`, `root`) VALUES (:mail,:password,:root)");
        $query->bindParam(':mail', $mail, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':root', $root, PDO::PARAM_STR);
        $query->execute();
    }

    function addAdmin($mail, $password)
    {
        if ($mail == 'admin@admin' && $password == 'admin') {
            return "admin";
        } else return "user";
    }

    function getToken($mail)
    {
        $query = $this->prepare("SELECT mail, password FROM user WHERE mail=:mail");
        $query->bindParam(':mail', $mail, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row != null) {
            return $row['password'];
        } else return "";
    }

    function getUserPass($password, $token)
    {

        return password_verify($password, $token);
    }

    function checkUserPass($mail, $password)
    {

        return $this->getUserPass($password, $this->getToken($mail));
    }

    function logIn($mail, $password)
    {
        session_start();
        if (!isset($_SESSION['mail']) && !isset($_SESSION['password'])) {
            if ($this->checkUserPass($mail, $password) == true) {
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $password;
            } else return false;
        } else return true;
    }

    function logOut()
    {
        session_destroy();
    }

    function deleteUser($id_user)
    {
        $query = $this->prepare("DELETE FROM `user` WHERE id_user=:id_user");
        $query->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $query->execute();
    }

    function updateUser($id_user, $mail, $password)
    {
        $query = $this->prepare("UPDATE `user` SET `mail`=:mail,`password`=:password WHERE id_user=:id_user");
        $query->bindParam(':id_user', $id_user, PDO::PARAM_STR);
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

    function deleteCourses($id_courses)
    {
        $query = $this->prepare("DELETE FROM `courses` WHERE id_courses=:id_courses");
        $query->bindParam(':id_courses', $id_courses, PDO::PARAM_STR);
        $query->execute();
    }

    function updateCourses($id_courses, $title, $description, $date_courses, $price)
    {
        $query = $this->prepare("UPDATE `courses` SET `description`=:description,`date_courses`=:date_courses,`price`=:price,`title`=:title WHERE id_courses=:id_courses");
        $query->bindParam(':id_courses', $id_courses, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':date_courses', $date_courses, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->execute();
    }

    function getCourse($id_courses)
    {
        $query = $this->prepare("SELECT * FROM `courses` WHERE id_courses=:id_courses");
        $query->bindParam(':id_courses', $id_courses, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCourses()
    {
        $query = $this->prepare("SELECT * FROM `courses` ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function saleCourses($id_courses, $id_user)
    {
        $date = gettimeofday();
        $query = $this->prepare("INSERT INTO `sale`(`id_user`, `id_courses`, `date`) VALUES (:id_user,:id_courses,`$date`)");
        $query->bindParam(':id_courses', $id_courses, PDO::PARAM_STR);
        $query->bindParam(':id_user', $id_user, PDO::PARAM_STR);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->execute();
    }

}

