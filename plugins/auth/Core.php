<?php

namespace plugins\auth;

//use \plugins\auth\Session as Session;



class Auth
{
    protected static $instance;

    public static function getInstance()
    {
        return (null !== self::$instance) ? self::$instance : (self::$instance = new Auth());
    }

    public function __construct()
    {
        Session::getInstance()->start();
        $this->auth(null,null);
    }

    public function isAuth()
    {
        return ( (Session::getInstance()->getSession('is_auth')) ) ? true : false;
    }

    public function auth($login,$password)
    {
        Session::getInstance()->setSession('is_auth',true);
    }

    public function out()
    {
        Session::getInstance()->destroy();
    }



}