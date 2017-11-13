<?php

Class NewsView extends View
{

    public function full($data,$other=array())
    {

        $this->vars('title',$data['name']);
        $this->vars('id',$data['id']);
        $this->vars('description',$data['description']);
        $this->vars('cat_id',$data['cat_id']);

        $this->vars('link',$other['link']);
        $this->vars('cat_name',$other['cat_name']);
        $this->vars('cat_link',$other['cat_link']);

        //Пример вывода через генерейт

        $this->vars('content',$this->generate('','news/news_full'));
        echo $this->generate('','template');

    }

    public function preview($data,$page,$model)
    {
        $max_count = $data[1];
        $res = $data[0];
        $string=null;
        while($row = $res->fetch(PDO::FETCH_LAZY)) {

            $this->vars('title',$row['name']);
            $this->vars('id',$row['id']);
            $this->vars('description',$row['description']);
            $cat_id = $row['cat_id'];
            $this->vars('cat_id',$cat_id);
            if (News_Cat)
            {
                $cat_info = $model->namecat($cat_id);
                $cat_link = $cat_info['cat_link'];
                $this->vars('cat_name',$cat_info['cat_name']);
                $this->vars('cat_link',BASE_URL.'news/'.$cat_link);
                $this->vars('link',BASE_URL.'news/'.$cat_link.'/'.$row['link']);
            }

            $string = $this->generate('','news/news_preview') . $string;

            $this->clear();
        }

        $this->vars('title','Страница '.$page.' - Новости сайта - '.SITENAME);
        $this->vars('content',$string);
        echo $this->generate('','template');
    }



}

?>