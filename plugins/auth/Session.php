<?php

namespace plugins\auth;


class Session
{
    use \core\traits\Singleton;

    private $session_start = FALSE;

    private function __construct()
    {
        if($this->session_start){
            return true;
        }
        /*if(!session_start()){
            throw new Exception('Error session start');
        }*/
        session_start();
        $this->session_start = true;
        return true;
    }


    public function start()
    {

    }

    public function destroy()
    {
        $_SESSION = array(); //Очищаем сессию
        session_destroy();
    }

    public function getvalue($key)
    {
        return (!empty($_SESSION[$key])) ? $_SESSION[$key] : false;
    }


    public function setvalue($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}