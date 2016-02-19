<?php

class HomeController extends Controller
{
    public function get()
    {
        return new View($this->model, 'home.html');
    }

    // Try url /home/cool/Bibek/Dahal/
    public function get_cool($a="", $b="")
    {
        echo $a . " " . $b;
        return new View($this->model, 'rules.html');
    }
}

?>
