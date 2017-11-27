<?php


namespace plugins\auth;

class User
{
    private $id;
    private $login;
    private $email;
    private $group;
    private $stats;

    public function __construct($id,$login,$email,$group,$stats)
    {
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->group = $group;
        $this->stats = unserialize($stats);
    }

    public function setsession()
    {
        if (Session::getInstance()->getvalue('is_auth') == false)
        {
            Session::getInstance()->setvalue('is_auth',true);
            Session::getInstance()->setvalue('login',$this->login);
            Session::getInstance()->setvalue('id',$this->id);
            Session::getInstance()->setvalue('stats',$this->stats);
            Session::getInstance()->setvalue('email',$this->email);
            Session::getInstance()->setvalue('group',$this->group);
        } //TODO исключение
    }

    public function getid()
    {
        return $this->id;
    }

    public function getusername()
    {
        return $this->username;
    }

    public function getemail()
    {
        return $this->email;
    }

    public function getstats()
    {
        return $this->stats;
    }

    public function getgroup()
    {
        return $this->group;
    }




}