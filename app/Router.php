<?php

class Router extends RouterBase
{
    public function __construct()
    {
        $this->routing_rules = [
            "^$" => ['controller', 'HomeController'],
            "^faqs$" => ['controller', 'FaqController'],
            "^rules$" => ['template', 'rules.html'],

            "^admin$" => ['controller', 'AdminController'],
        ];
    }
}

?>
