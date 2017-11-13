<?php
abstract Class Controller
{
    private $controllername;

    public function getmodel($controller)
    {
       require_once ROOT.'/modules/'.$controller.'/'.$controller.'_model.php';
       $model = $controller.'Model';
       return new $model();
    }

    public function getview($controller)
    {
        require_once ROOT.'/modules/'.$controller.'/'.$controller.'_view.php';
        $view = $controller.'View';
        return new $view();
    }


}

?>