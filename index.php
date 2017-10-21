<?php

require __DIR__ . '/autoload.php';

$url = trim($_SERVER['REQUEST_URI'], '/');
$parts = explode('/', $url);

$controllerName = !empty($parts[0]) ? ucfirst($parts[0]) : 'Task'; 

$controllerClassName = '\\App\\Controllers\\' . $controllerName;

if (class_exists($controllerClassName) == false) {
	$view = new \App\Views\View();
	$view->errors = 'Страница не найдена!';
    $view->display(__DIR__ . '/App/templates/404.php');
    exit;
} 

$controller = new $controllerClassName();

$action = !empty($parts[1]) ? ucfirst($parts[1]) : 'Index';  

try {
    $controller->action($action);
} catch (\App\Exceptions\Core $e) {
    echo 'Возникло исключение приложения: ' . $e->getMessage();
} catch (\App\Exceptions\Db $e) {
    $view = new \App\Views\View();
    $view->errors = $e->getMessage();
    $view->display(__DIR__ . '/App/templates/db.php');
} catch (\App\Exceptions\E404 $e) {
    $view = new \App\Views\View();
    $view->errors = $e->getMessage();
    $view->display(__DIR__ . '/App/templates/404.php');
}