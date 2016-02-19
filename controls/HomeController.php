<?php

class HomeController extends Controller
{
    public function get()
    {
        return new View($this->model, 'home.html');
    }

    public function get_cool()
    {
        return new View($this->model, 'rules.html');
    }
}

?>
