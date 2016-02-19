<?php

require_once 'Model.php';
require_once 'View.php';
require_once 'Controller.php';

class Page
{
    private $model;
    private $view;
    private $controller;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function set_template($template_file_name)
    {
        $this->view = new View($this->model, $template_file_name);
    }

    public function get_model()
    {
        return $this->model;
    }

    public function set_controller($controller)
    {
        $this->controller = $controller;
    }

    public function generate()
    {
        if( $this->view )
        {
            if( $this->controller )
            {
                $this->controller->preprocess();
            }
        }
        else
        {
            $this->view = new View($this->model, '__default_template.html');
        }
        $this->view->render();
    }
}

 ?>
