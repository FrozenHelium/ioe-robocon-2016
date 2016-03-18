<?php

class Router extends RouterBase
{
    public function __construct()
    {
        $this->routing_rules = array(
            "^$" => array('controller', 'HomeController'),
            "^rules$" => array('template', 'rules.html'),
            "^faqs$" => array('template', 'faqs.html'),
        );
    }
}

?>
