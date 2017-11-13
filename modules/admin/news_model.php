<?php

Class NewsModel extends Model
{

    function __construct()
    {

    }

    //Получение данных одной новости по id
    public function getnewsid($id)
    {
        $Mysql = new Mysql();
        $res = $Mysql->select('news',"WHERE id = '$id'");
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        if ( empty ($row) )
        {
            Core::redirect('/404');
        };

        return $row;
    }

    //Получение данных одной новости по ссылке
    public function getnews($link)
    {
        $Mysql = new Mysql();
        $res = $Mysql->select('news',"WHERE link = '$link'",null);
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        if ( empty ($row) )
        {
            Core::redirect('/404');
        };

        return $row;
    }

    //Проверка существует ли категория, если да, то возвращает ее id
    public function checkcat($name)
    {
        $Mysql = new Mysql();
        $res = $Mysql->select('news_cat',"WHERE cat_link = '$name'",null);
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        return $row['id'];
    }
    //Получение имени и ссылки категории
    public function namecat($catid)
    {
        $Mysql = new Mysql();
        $res = $Mysql->select('news_cat',"WHERE id = '$catid'",null);
        $row = $res->fetch(PDO::FETCH_LAZY);
        unset($Mysql);
        return $row;
    }

    public function getlistnews($id,$cat,$count)
    {
        $Mysql = new Mysql();
        $order = (News_Order) ? 'ASC' : 'ASC';
        if ( empty($cat) ):
            $res = $Mysql->select('news',"Order by id.". $order ."LIMIT $id,$count",null);
        else :
            $res = $Mysql->select('news',"WHERE cat_id ='$cat' Order by id ". $order ." LIMIT $id,$count",null);
        endif;

        //$row = $res->fetch(PDO::FETCH_LAZY);
        //$count = $row['id'];
        unset($Mysql);
        return $res;
    }

    public function getpagenews($cat,$page,$count)
    {
        $Mysql = new Mysql();

        if ( empty($cat) ):
            $res = $Mysql->select('news',null,'COUNT(*)');
        else:
            $res = $Mysql->select('news',"WHERE cat_id = '$cat'",'COUNT(*)');
        endif;
        $row = $res->fetch(PDO::FETCH_LAZY);
        $max_count = $row['COUNT(*)'];

        //echo $max_count;

        $model = $this->getmodel('News');
        if ( $max_count<$count ):
            $list = $model::getlistnews(0,$cat,$count);
        else :
            $list = $model::getlistnews(($page-1)*$count, $cat, $count);
        endif;
        unset($model);
        unset($Mysql);
        return array($list,$max_count);
    }
}

?>