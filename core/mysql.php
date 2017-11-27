<?php

namespace core;
use \PDO;
//Пример запроса
/*$Mysql = new Mysql();
$res = $Mysql->select('users',"`login` = 'fiCeVitka'");
echo $res['login'];*/

//https://github.com/colshrapnel/safemysql/blob/master/safemysql.class.php

Class Mysql
{
    use traits\Singleton;

    protected $DB;
    private static $queries=0;
    protected $stats;
    protected $emode;
    protected $exname;


    private function __construct()
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

    private function __clone () {}
    private function __wakeup () {}

    public function select($table,$query=null,$what=null)
    {
        if ( empty($what) ) $what='*';

        /*$res = $this->DB->query("SELECT * FROM `".$table."` WHERE ".$query);
        $row = $res->fetch_assoc();
        return $row;*/
        //echo 'SELECT '.$what.' FROM '.$table.' '.$query.'<br>';
        $STH = $this->DB->query('SELECT '.$what.' FROM '.$table.' '.$query);
        self::$queries++;
        //$STH->setFetchMode(PDO::FETCH_ASSOC);
        return $STH;
    }

    //TODO PDO CRUD

    public function query()
    {
        //echo print_r(func_get_args());
        //return $this->rawQuery($this->prepareQuery(func_get_args()));
        self::$queries++;
        return $this->prepareQuery(func_get_args());
    }

    public function prepareQuery($args)
    {
        $query = array_shift($args);
        $STH = $this->DB->prepare($query);
        //print_r($args);
        $STH->execute($args);
        //$query->fetchAll();
        return $STH;
    }

    //TODO Мб сделать строгую типизацию файлов

    /*public function query()
    {
        return $this->rawQuery($this->prepareQuery(func_get_args()));
    }

    protected function rawQuery($query)
    {
        $start = microtime(TRUE);
        $res   = mysqli_query(self::$instance, $query);
        $timer = microtime(TRUE) - $start;
        $this->stats[] = array(
            'query' => $query,
            'start' => $start,
            'timer' => $timer,
        );
        if (!$res)
        {
            $error = mysqli_error(self::$instance);

            end($this->stats);
            $key = key($this->stats);
            $this->stats[$key]['error'] = $error;
            $this->cutStats();

            $this->error("$error. Full query: [$query]");
        }
        $this->cutStats();
        return $res;
    }

    protected function prepareQuery($args)
    {
        $query = '';
        $raw   = array_shift($args);
        $array = preg_split('~(\?[nsiuap])~u',$raw,null,PREG_SPLIT_DELIM_CAPTURE);
        $anum  = count($args);
        $pnum  = floor(count($array) / 2);
        if ( $pnum != $anum )
        {
            $this->error("Number of args ($anum) doesn't match number of placeholders ($pnum) in [$raw]");
        }
        foreach ($array as $i => $part)
        {
            if ( ($i % 2) == 0 )
            {
                $query .= $part;
                continue;
            }
            $value = array_shift($args);
            switch ($part)
            {
                case '?n':
                    $part = $this->escapeIdent($value);
                    break;
                case '?s':
                    $part = $this->escapeString($value);
                    break;
                case '?i':
                    $part = $this->escapeInt($value);
                    break;
                case '?a':
                    $part = $this->createIN($value);
                    break;
                case '?u':
                    $part = $this->createSET($value);
                    break;
                case '?p':
                    $part = $value;
                    break;
            }
            $query .= $part;
        }
        return $query;
    }
    protected function escapeInt($value)
    {
        if ($value === NULL)
        {
            return 'NULL';
        }
        if(!is_numeric($value))
        {
            $this->error("Integer (?i) placeholder expects numeric value, ".gettype($value)." given");
            return FALSE;
        }
        if (is_float($value))
        {
            $value = number_format($value, 0, '.', ''); // may lose precision on big numbers
        }
        return $value;
    }
    protected function escapeString($value)
    {
        if ($value === NULL)
        {
            return 'NULL';
        }
        return	"'".mysqli_real_escape_string($this->conn,$value)."'";
    }
    protected function escapeIdent($value)
    {
        if ($value)
        {
            return "`".str_replace("`","``",$value)."`";
        } else {
            $this->error("Empty value for identifier (?n) placeholder");
        }
    }*/





}