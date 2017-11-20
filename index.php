<?php
header('Content-Type: text/html; charset=utf-8');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');
//session_start();


require_once 'settings.php';
require_once 'core/other_settings.php';

require_once(ROOT .'/core/mysql.php');
require_once(ROOT .'/core/core.php');
require_once (ROOT.'/core/controller.php');
require_once (ROOT.'/core/model.php');
require_once (ROOT.'/core/view.php');
require_once (ROOT.'/core/paginator.php');
require_once (ROOT.'/core/hooks.php');

require_once (ROOT.'/plugins/auth/Core.php');
require_once (ROOT.'/plugins/auth/Session.php');
require_once (ROOT.'/plugins/auth/User.php');

//Поменять ROOT при заливке на сайт
ini_set('display_errors', Dev_Error);

$routes=array();

require_once 'core/routing.php';
//Запуск роутинга
$router = new \core\Router;
$router->run();

