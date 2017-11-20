<?php

namespace core;

abstract Class View
{
    protected $vars=array();

    public function vars($varname, $value)
    {
        if (isset($this->vars[$varname]) == true) {
            trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
            return false;
        }
        $this->vars[$varname] = $value;
        return true;
    }


    public function clear()
    {
        $this->vars = array();
        return true;
    }

    public function generate($content_view, $template_view, $data = array())
    {

        foreach ($this->vars as $k => $v)
        {
            $$k = $v;
        }

        // Генерация HTML в строку.
        ob_start();
        include 'template/'.$template_view.'.php';
        return ob_get_clean();

    }
}