<?php

class Utils {

    public static function login($id) {
        $_SESSION['id'] = $id;
    }

    public static function logout() {
        session_unset();
        session_destroy();
    }

    public static function getLoggedIn() {
        if(isset($_SESSION['id']))
            return $_SESSION['id'];
        else
            return 0;
    }

}