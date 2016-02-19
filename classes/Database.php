<?php

require_once '../config.php';

class Database extends mysqli
{
    private static $instance;

    public function __construct()
    {
        parent::__construct(HOST, USER, PASSWORD, '');
        if (mysqli_connect_error())
        {
            die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
        }

        $stmt = 'CREATE DATABASE IF NOT EXISTS `' . DATABASE . '`';
        $query = $this->prepare($stmt);
        if($query)
        {
            if($query->execute())
            {
                $this->select_db(DATABASE);
            }
            else
            {
                die('Failed to create database.<br>' . $this->error);
            }
        }
        else
            die($this->error . "<br>" . $stmt);
    }

    // make class singleton by not responding to cloning
    private function __clone() {}

    public static function get_instance()
    {
        if (!self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>
