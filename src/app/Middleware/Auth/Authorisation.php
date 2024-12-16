<?php

namespace App\Middleware\Auth;

class Authorisation
{
    private static $algoritm = 'sha256';
    
    public static function set_session(SessionDTO $data) {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['uid'] = hash(self::$algoritm, $data->id);
        return $_SESSION['uid'];
    }

    public static function end_session() {
        if (!isset($_SESSION)) {
            session_start();
        }
        session_destroy();
    }
    
    public static function check_session() {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['uid']);
    }
}