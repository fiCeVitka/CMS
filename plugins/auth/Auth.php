<?php

namespace plugins\auth;

//use \plugins\auth\Session as Session;
use \PDO;


class Auth
{
    use \core\traits\Singleton;

    public function __construct()
    {
        Session::getInstance();
        //$user = $this->auth();
        if ($user)
        {
            echo $user->getemail();
        };
        //$this->out();
        //echo Session::getInstance()->getvalue('name');
        //echo Session::getInstance()->getvalue('id');
    }

    public function isAuth()
    {
        return ( (Session::getInstance()->getvalue('is_auth')) ) ? true : false;
    }

    public function auth($login,$password)
    {
        $hashin = substr(hash(sha256,Hash),0,20);
        $hashout = substr(hash(sha256,Hash),40,10);
        $hash = hash(sha1,$password);
        $pass = $hashin.$hash.$hashout;
        $res = \core\Mysql::getInstance()->query('SELECT * FROM users WHERE login = ? AND password = ?',$login,$pass);
        $row = $res->fetch(PDO::FETCH_LAZY);
        if ($row)
        {
            $user = new User($row['id'],$row['login'],$row['email'],$row['group'],$row['stats']);
            print_r($user);
            $user->setsession();
            return $user;
            //echo $user->getemail();
        } else
        {
            echo "НЕТ ТАКИХ";
            return false;
        }

    }

    public function out()
    {
        Session::getInstance()->destroy();
    }



}