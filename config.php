<?php

// config.php
// contains global configurations

define("HOST",      "robocon.ioe.edu.np");
define("USER",      "robocon");
define("PASSWORD",  "XQCo7NdeX5UZnGtR");
define("DATABASE",  "robocon2016");

define("ROOTDIR", __DIR__);

define("DEBUG", false);

// function to get url from route
function get_url($route)
{
    $baseurl = $_SERVER['PHP_SELF'];
    $baseurl = str_replace('index.php', '', $baseurl);
    return $baseurl.$route;
}

?>
