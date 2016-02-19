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
        $query = $this->prepare('CREATE DATABASE IF NOT EXISTS ' + DATABASE);
        if($query)
        {
            if($query->execute())
            {
                $this->select_db(DATABASE);
            }
            else
            {
                echo 'failed to create database';
            }
        }
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
