<?php
require_once 'BaseRouter.php';
require_once '../models/User.php';

class Router extends BaseRouter
{
    public function __construct()
    {
        // create user
        $user = new User();
        $user->username = "helloThere";
        $user->save();

        $this->routing_rules = array(
            // Default rule
            "default" => "home",

            // Template redirection rules
            "rules" => array('template', 'rules.html'),
            "faqs" => array('template', 'faqs.html'),
            "test" => array('template', 'test.html'),

            // Controller redirection rules
            // This one is optional as controller name matches the rule
            "home" => array('controller', 'HomeController'),
        );
    }
}

?>
