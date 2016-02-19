<?php

require_once 'Page.php';

class Router
{
    private function get_args($php_self, $request_uri)
    {
    	$basepath = implode('/', array_slice(explode('/', $php_self), 0, -1)) . '/';
    	$uri = substr($request_uri, strlen($basepath));
    	if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    	$uri = '/' . trim($uri, '/');
    	return $uri;
    }

    public function route($php_self, $request_uri)
    {
        $args = $this->get_args($php_self, $request_uri);
        $routes = array();
        $temp = explode('/', $args);
        foreach($temp as $route)
        {
        	if(trim($route) != "")
        		array_push($routes, $route);
        }

        $page = new Page();

        if(count($routes) > 0)
        {
            switch($routes[0])
            {
            case "home":
                require_once '../controls/HomePageController.php';
                $page->set_template('home.html');
                $page->set_controller(new HomePageController($page->get_model()));
                break;
            case "rules":
                $page->set_template('rules.html');
                break;
            case "faqs":
                $page->set_template('faqs.html');
                break;
            default:
                $page->set_template('404.html');
            }
        }
        else
        {
            header("Location: /home");
            exit();
        }
        $page->generate();
    }
}

?>
