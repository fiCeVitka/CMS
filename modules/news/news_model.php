<?php

namespace modules\news;

use \core\Mysql as Mysql;
use \PDO;

Class NewsModel extends \core\Model
{

    function __construct()
    {

    }

    //Получение данных одной новости по id
    public function getnewsid($id)
    {
        $Mysql = Mysql::getInstance();
        $res = $Mysql->select('news',"WHERE id = '$id'");
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        if ( empty ($row) )
        {
            \core\Core::redirect('/404');
        };

        return $row;
    }

    //Получение данных одной новости по ссылке
    public function getnews($link)
    {
        $Mysql = Mysql::getInstance();
        $s = 'lel';
        $res = $Mysql->query('SELECT * FROM news WHERE link = ?',$link);
        //print_r($res);
        //$res = $Mysql->select('news',"WHERE link = '$link'",null);
        //$res = $Mysql->query('SELECT * FROM "news" WHERE "link = ?s',$link);
        $row = $res->fetch(PDO::FETCH_LAZY);
        //print_r($res);
        unset($Mysql);
        if ( empty ($row) )
        {
            \core\Core::redirect('/404');
        };

        return $row;
    }

    //Проверка существует ли категория, если да, то возвращает ее id
    public function checkcat($name)
    {
        $Mysql = Mysql::getInstance();
        //$res = $Mysql->select('news_cat',"WHERE cat_link = '$name'",null);
        $res = $Mysql->query('SELECT * FROM news_cat WHERE cat_link=?',$name);
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        return $row['id'];
    }
    //Получение имени и ссылки категории
    public function namecat($catid)
    {
        $Mysql = Mysql::getInstance();
        $res = $Mysql->select('news_cat',"WHERE id = '$catid'",null);
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        return $row;
    }

    public function getlistnews($id,$cat,$count)
    {
        $Mysql = Mysql::getInstance();
        $order = (News_Order) ? 'ASC' : 'ASC';
        if ( empty($cat) ):
            //$res = $Mysql->select('news',"Order by id ". $order ." LIMIT $id,$count",null); TODO Удалить
            $res = $Mysql->query('SELECT * FROM news ORDER by id '.$order." LIMIT ?,?",$id,$count);
        else :
            //$res = $Mysql->select('news',"WHERE cat_id ='$cat' Order by id ". $order ." LIMIT $id,$count",null); TODO Удалить
            $res = $Mysql->query('SELECT * FROM news WHERE cat_id = ? ORDER by id '.$order.' LIMIT ?,?',$cat,$id,$count);

        endif;
        //$row = $res->fetch(PDO::FETCH_LAZY);
        //$count = $row['id'];
        unset($Mysql);
        return $res;
    }

    public function getpagenews($cat,$page,$count)
    {
        $Mysql = Mysql::getInstance();

        if ( empty($cat) ):
            //$res = $Mysql->select('news',null,'COUNT(*)');
            $res = $Mysql->query('SELECT COUNT(*) FROM news');
        else:
            //$res = $Mysql->select('news',"WHERE cat_id = '$cat'",'COUNT(*)');
            $res = $Mysql->query('SELECT COUNT(*) FROM news WHERE cat_id = ?',$cat);
        endif;
        $row = $res->fetch(PDO::FETCH_LAZY);
        $max_count = $row['COUNT(*)'];

        //echo $max_count;
        //$this->getlistnews()
        //$model = $this->getmodel('News');
        if ( $max_count<$count ):
            $list = self::getlistnews(0,$cat,$count);
        else :
            if ($max_count-($page)*$count<0) {\core\Core::redirect('/404');}
            $list = self::getlistnews($max_count-($page)*$count, $cat, $count);
        endif;
        //unset($model);
        unset($Mysql);
        return array($list,$max_count);
    }
}

?>