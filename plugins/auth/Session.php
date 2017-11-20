<?php

namespace plugins\auth;


class Session
{
    protected static $instance;
    private $session_start = FALSE;

    private function __construct() {}

    public static function getInstance()
    {
        return (null !== self::$instance) ? self::$instance : (self::$instance = new Session());
    }

    public function start()
    {
        if($this->session_start){
            return true;
        }
        /*if(!session_start()){
            throw new Exception('Error session start');
        }*/
        $this->session_start = true;
        return true;
    }

    public function destroy()
    {
        $_SESSION = array(); //Очищаем сессию
        session_destroy();
    }

    public function getSession($key)
    {
        $this->start();
        return (!empty($_SESSION[$key])) ? $_SESSION[$key] : false;
    }


    public function setSession($key, $value)
    {
        $this->start();
        $_SESSION[$key] = $value;
    }
}