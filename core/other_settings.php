<?php


/**
 * Настройки скриптов
 */
//Начало переменных замены
define('KEY_START', '{');
//Конец переменных замены
define('KEY_END', '}');
//fele exits design
define('FILEEXT', '.html');

//Папка с файлами отображения
define('PAGEDIRCOMP', 'views/'.PAGEDIRCOMPUTER);
//Доменное имя приложения
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
//define('ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/');
//Папка с моделями
define("PATCHMODEL", 'models/');
//Папка с контроллерами
define("PATCCONTROLLERS", 'controllers/');
//Папка с файлами javascript
define('JSFOLDER', DOMAINSERVER.'views/js/');
//Папка с файлами css
define('CSSFOLDER', DOMAINSERVER.'views/css/');
//папка с файлами images
define('IMGFOLDER', DOMAINSERVER.'views/images/');
/**
 * Настройки базы данных
 */

 //* Настройки роутера
//Контроллер по умолчанию
define("CONTROLLERDEFAULT", 'news');
//Действие по умолчанию
define("ACTIONDEFAULT", 'index');

define("SITENAME","CMS");

define("{{Title}}",SITENAME);
define("View_Header","require_once 'template/header.php';");

define("Error",'0');


//Выводим сообщение что файл config.php подключен
?>