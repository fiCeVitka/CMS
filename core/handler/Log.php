<?php

namespace core\handler;

class Log
{
    public static function log($text)
    {
       $file = fopen(ROOT."/data/logs/log.txt","a+");
       fputs($file,date("[Y-m-d H:i:s] ").$text.PHP_EOL);
       fclose($file);
    }
}