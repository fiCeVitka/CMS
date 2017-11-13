<?php
    class Routing
    {
        private $routes;
        private $controller;
        private $action;
        private $error=0;  //0 = нет ошибки, 1 = не найден контроллер, 2 = не найден экшен

        public function __construct()
        {
            //Получаем controller и action из ссылки
            $this->routes = include("core/routes.php");
            $uri = explode("/", $_SERVER['REQUEST_URI'],3);
            if (!empty($uri[1]))
            {
                $this->controller = mb_strtolower($uri[1]);
            } else
            {
                $this->controller=CONTROLLERDEFAULT;
            }
            $this->action = $uri[2];
            $uri=null;

        }

        public function run()
        {
            //Проверка контроллера и действия
            foreach ($this->routes as $controllername => $action)
            {
                $this->error=1;
                if ($controllername == $this->controller)
                {
                    foreach ($action as $value => $actionname)
                    {
                        $this->error=2;
                        if (preg_match("~$value~",$this->action))
                        {
                            $this->error=0;
                            $params=$this->action;
                            $this->action=$actionname;
                            break;
                        }
                    }
                    break;
                }
            }

            //Действия с результатами ошибок
            switch ($this->error)
            {
                case 0:
                    //echo $this->controller,PHP_EOL;
                    //echo $params,PHP_EOL, $actionname;
                    break;
                case 1:
                    echo "Не найден контроллер";
                    break;
                case 2:
                    $this->action=ACTIONDEFAULT;
                    break;
            }

            //Запускаем нужный контроллер
            include_once ("controllers/".$this->controller.".php");
            $controllernames = ucfirst($this->controller.'Controller');
            $controllerobject = new $controllernames;
            $controlleraction = $this->action;
            $result = $controllerobject->$controlleraction($params);
        }
    }
?>