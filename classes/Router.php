<?php

require_once("../classes/pages/BasicPage.php");
require_once("../classes/pages/Homepage.php");
require_once("../classes/pages/Register.php");
require_once("../classes/pages/Signin.php");
require_once("../classes/pages/Logout.php");
require_once("../classes/pages/Profile.php");
require_once("../classes/pages/CarDetails.php");
require_once("../classes/pages/Rent.php");
require_once("../classes/pages/Rentals.php");
require_once("../classes/pages/NotFound.php");

class Router {

    private static function getCurrentUri() {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    public static function route() {
        $base_url = self::getCurrentUri();
        $routes = explode('/', $base_url);
        foreach($routes as $route) {
            if(!empty(trim($route)))
                array_push($routes, $route);
        }

        switch ($routes[1]) {
            case "":
                (new Homepage())->render();
                break;
            case "register":
                (new Register())->render();
                break;
            case "logout":
                (new Logout())->render();
                break;
            case "signin":
                (new Signin())->render();
                break;
            case "profile":
                (new Profile())->render();
                break;
            case "car":
                (new CarDetails($routes[2]))->render();
                break;
            case "rent":
                (new Rent($routes[2]))->render();
                break;
            case "rentals":
                (new Rentals())->render();
                break;
            default:
                (new NotFound())->render();
        }
    }

}