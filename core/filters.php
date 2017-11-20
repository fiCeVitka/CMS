<?php

/*
class FS //FilterSystem
{
    protected static $instance;
    protected static $_filters=array();

    public static function getInstance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        return new self;
    }

    public function register($eventhook,$function)
    {
        $alo = new Filter($eventhook,$function);
        self::$_hooks[] = $alo;
    }

    public function do_action ($hookname)
    {
        foreach(self::$_hooks as $hook){
            if($hook->getHookName() == $hookname){
                $hook->run($this);
            }
        }
    }

}

class Filter
{
    private $hookname;
    private $functionname;

    public function __construct($hookName, $functionName){
        $this->_hookName = $hookName;
        $this->_functionName = $functionName;
    }

    // Запуск обработчика для хука
    public function run(HS $pm){
        if(function_exists($this->_functionName)){
            call_user_func($this->_functionName);
        }
    }

    public function getHookName(){
        return $this->_hookName;
    }
}