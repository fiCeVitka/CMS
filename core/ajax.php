<?php

namespace core;
use \core\Core as Core;

Class Ajax
{
    protected static $instance;
    protected static $ajax_list=array();
    public static $ready = false;

    public static function getInstance()
    {
        if (null !== self::$instance)
        {
            $instance = self::$instance;
        } else {
            $instance = self::$instance = new Ajax();
        }

        return $instance;
    }

    public function do_post($name)
    {
        //print_r(self::$ajax_list);
        //return "alo";
        //$s = print_r(self::$ready);
        //return $s;
        //$this->end();
        do {
            var_dump(self::$ready);
            if ((self::$ready)==true) {
                $this->do_action($name);
                break;
            }
        } while (1<2);
    }

    public function getready()
    {
        return self::$ready;
    }

    public function end()
    {
       self::$ready=true;
    }

    public function register($eventhook,$function)
    {
        $alo = new Ajax_hook($eventhook,$function);
        self::$ajax_list[] = $alo;
        //print_r(self::$ajax_list);
    }

    public function do_action ($hookname)
    {
        echo $hookname;
        //return print_r(self::$ajax_list);
        foreach(self::$ajax_list as $hook){
            if($hook->getHookName() == $hookname){
                $hook->run($this);
                echo $hookname;
            }
        }
    }

}

class Ajax_hook
{
    private $hookname;
    private $functionname;

    public function __construct($hookName, $functionName){
        $this->hookname = $hookName;
        $this->functioname = $functionName;
        //echo $functionName;
    }

    // Запуск обработчика для хука
    public function run(Ajax $pm){
        if(function_exists($this->functionname)){
            call_user_func($this->functionname);
        }
    }

    public function getHookName(){
        return $this->hookname;
    }
}