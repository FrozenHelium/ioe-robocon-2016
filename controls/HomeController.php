<?php

class HomeController extends Controller
{
    public function get()
    {
        return new View($this->model, 'home.html');
    }
}

?>
