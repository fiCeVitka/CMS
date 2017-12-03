<?php

namespace core;

abstract Class Controller
{
    private $_model = [];
    private $_view = [];
    private $controllername;

    public function getmodel($controller)
    {
        require_once ROOT.'/modules/'.$controller.'/'.$controller.'_model.php';
        $model = "\\modules\\".$controller."\\".$controller.'Model';
        if (empty($this->_model[$controller]))
        {
            $this->_model[$controller] = new $model;
        }
        return $this->_model[$controller];
    }

    public function getview($controller)
    {
        require_once ROOT.'/modules/'.$controller.'/'.$controller.'_view.php';
        $view = "\\modules\\".$controller."\\".$controller.'View';
        if (empty($this->_view[$controller]))
        {
            $this->_view[$controller] = new $view;
        }
        return $this->_view[$controller];
    }


}

?>