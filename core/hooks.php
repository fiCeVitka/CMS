<?php
//\core\HS::getInstance()->register('start','alo');
//\core\HS::getInstance()->do_action('start');

namespace core;

class HS //HookSystem
{
    protected static $instance;
    protected static $_hooks=array();

    public static function getInstance()
    {
        if (self::$instance != null) {
            return self::$instance;
        }
        return new self;
    }

    public function register($eventhook,$function)
    {
        $alo = new Hook($eventhook,$function);
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

class Hook
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