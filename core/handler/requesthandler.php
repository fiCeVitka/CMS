<?php

namespace core\handler;

if (isset($_POST['form_name']))
{
    \core\handler\Log::log($_POST['form_name']);
    Request::getInstance()->addlist($_POST['form_name']);
    //echo "alo";
    //print_r( Ajax::getInstance()->getready());
    //echo Core::$ready;
    /*while(1<2) {
        if (Core::getInstance()->ready) {
            Ajax::getInstance()->do_action($_POST['form_name']);
            break;
        }
    }*/
    //do_action($_POST);
}

Class Request
{
    use \core\traits\Singleton;

    private $list=array();

    public function addlist($name)
    {
        $this->list[] = $name;
    }

    public function start()
    {
        foreach ($this->list as $item)
        {
            \core\handler\Log::log($item);
            \core\Ajax::getInstance()->do_action($item);
        }
    }

}