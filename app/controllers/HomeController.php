<?php

class HomeController extends Controller
{
    public function get()
    {
        return new TemplateView('home.html');
    }
}

?>
