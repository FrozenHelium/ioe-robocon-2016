<?php

require_once 'Database.php';

class Model
{
    private $db;
    public $data;

    public function __construct()
    {
        $this->db = Database::get_instance();
        $this->data = array();
    }
}

?>
