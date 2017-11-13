<?php

Class Router
{
    private $controller;
    private $action;
    private $error=0;  //0 = нет ошибки, 1 = не найден контроллер, 2 = не найден экшен

    public function __construct(){
        //Подключаем все модули
        foreach (glob(ROOT.'/modules' . '/*', GLOB_ONLYDIR) as $dirname) {
            require_once $dirname.'/index.php';
        }
        //Получаем controller и action из ссылки
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
        foreach ($GLOBALS['routes'] as $controllername => $action)
        {
            $this->error=1;
            if ($controllername == $this->controller)
            {
                foreach ($action as $value => $actionname)
                {
                    //echo $action.PHP_EOL.$actionname.PHP_EOL.$value;

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
        $GLOBALS['controller'] = $this->controller;
        require_once (ROOT."/modules/".$this->controller."/".$this->controller."_controller.php");
        require_once (ROOT."/modules/".$this->controller."/".$this->controller."_settings.php");
        $controllernames = ucfirst($this->controller.'Controller');
        $controllerobject = new $controllernames;
        $controlleraction = $this->action;
        //echo $params;
        $result = $controllerobject->$controlleraction($params);
    }
}