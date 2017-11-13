<?php

//Пример запроса
/*$Mysql = new Mysql();
$res = $Mysql->select('users',"`login` = 'fiCeVitka'");
echo $res['login'];*/

Class Mysql
{
    private $DB;

    public function __construct()
    {
        /*$db = new mysqli(DBHOST, DBLOGIN, DBPASSWORD, DBNAME);
        if ($db->connect_errno) {
            return "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        }
        $db->query('SET NAMES utf8');
        $this->DB = $db;*/
        $host = DBHOST;
        $db   = DBNAME;
        $user = DBLOGIN;
        $pass = DBPASSWORD;
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
        $this->DB = $pdo;
    }

    public function __destruct()
    {
        $this->DB = null;
    }

    public function select($table,$query=null,$what=null)
    {
        if ( empty($what) ) $what='*';

        /*$res = $this->DB->query("SELECT * FROM `".$table."` WHERE ".$query);
        $row = $res->fetch_assoc();
        return $row;*/
        $STH = $this->DB->query('SELECT '.$what.' FROM '.$table.' '.$query);

        //$STH->setFetchMode(PDO::FETCH_ASSOC);
        return $STH;
    }


}