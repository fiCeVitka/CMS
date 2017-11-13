<?php

Class NewsController extends Controller
{
    public function _construct ()
    {

    }

    public function index()
    {
        //echo "индекс";
        $view = $this->getview('News');
        //$view::generate('lel','template');
        $title = 'Индекс';
        $vars = array('title' => $title,);
        echo $view->generate('lel','template',$vars);
    }

    public function view($params)
    {
        //Вид новости или выборка по странице
        // /page/.. - вывод определенной страницы новостей
        // /category/ - вывод определенной категории
        // /category/page/.. - вывод страницы новостей из категории
        // /category/232 - вывод новости

        //Проверка параметров ссылки
        $uri = explode("/", $params, 3);
        $model = $this->getmodel('News');
        $view = $this->getview('News');


        if ( $uri[0]=='page' )
        {
            if ( empty($uri[1]) ) $uri[1]='1';
            if ( !ctype_digit($uri[1]) ) Core::redirect('/404');
            //Показ новостей на определенной странице (НЕ СДЕЛАНО)

            //$res = $model::getnewsid($uri[1]);
            $res = $model::getpagenews(null,$uri[1],News_Count);
            $view->preview($res,$uri[1],$model);
            //$vars = array('title' => $res['name'],);
            //echo $view->generate('lel','template',$vars);

            return true;

        } else
        {
            //Если категории активированы
            if (News_Cat)
            {
                $cat_id = $model::checkcat($uri[0]);
                if ( !empty($cat_id) )
                {
                    //Если page или пусто, то выводим определенную страницу в категории
                    if ( empty($uri[1]) or ($uri[1]=='page') )
                    {
                        //Показ новостей на определенной страницы категории (НЕ СДЕЛАНО)
                        if ( empty($uri[2]) ) $uri[2]='1';
                        if ( !ctype_digit($uri[2]) ) Core::redirect('/404');
                        $res = $model::getpagenews($cat_id,$uri[2],News_Count);
                        $view->preview($res,$uri[2],$model);
                    }
                    else
                    {
                        //Показ новости
                        $res = $model::getnews($uri[1]);

                        $other['link'] = BASE_URL.'news/'.$uri[0].'/'.$uri[1];
                        $cat = $model::namecat($uri[0]);
                        $other['cat_name'] = $cat['cat_name'];
                        $other['cat_link'] = BASE_URL.'news/'.$uri[0].'/';
                        $view->full($res,$other);
                        return true;
                    }
                }
                else { Core::redirect('/404'); }
            }
            else
            {
                //Показ новости
                $res = $model::getnews($uri[0]);
                $other['link'] = BASE_URL.'news/'.$uri[0];

                $view->full($res,$other);
                return true;
            }

        }


        //Пример использования модели и вьюшки вместе
       /* $model = $this->getmodel('News');
        $res = $model::getnews(1);

        $view = $this->getview('News');
        $vars = array('title' => $res['name'],);
        echo $view->generate('lel','template',$vars);*/

    }

    public function addnews()
    {
        echo "добавление новости";
    }

    public function editnews($params)
    {
        //Берем id новости и редактируем ее, если есть права.
        $uri = explode("/", $params, 3);

    }
}

?>