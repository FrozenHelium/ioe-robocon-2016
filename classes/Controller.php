<?php

require_once 'Model.php';

class Controller
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function preprocess()
    {
    }

    public function on_action($action)
    {
        //$this->model->data["test"] = $action." triggered";
    }
}

?>
