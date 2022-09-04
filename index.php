<?php
session_start();


use Controllers\TagsController;
use Controllers\TransactionsController;

include __DIR__ . '/autoload.php';

$config = include __DIR__ . '/config.php'; // array


$dsn = "{$config['db']['driver']}:host={$config['db']['host']};port={$config['db']['port']};dbname={$config['db']['database']}";

try {
    $db = new PDO($dsn, $config['db']['user'], $config['db']['password']);
    // Tell PDO to throw exception when error occured!
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
} catch (PDOException $e) {
    die('DB connection error: ' . $e->getMessage());
}

$uri = $_SERVER['REQUEST_URI'];
[$path] = explode('?', $uri);
$parts = explode('/', trim($path, '/'));

$controller = $_GET['controller'] ?? ($parts[1] ?? '');
$action = $_GET['action'] ?? ($parts[2] ?? 'index');

echo getenv('DEBUG');
exit;

try {
    switch ($controller) {
        case 'transactions':
            $controllerClass = new TransactionsController;
        break;
        case 'tags':
            $controllerClass = new TagsController;
        break;
        default:
            throw new Exception('Invalid controller name');
    }

    if (!method_exists($controllerClass, $action)) {
        throw new Exception('Action not found!');
    }
    $controllerClass->$action();

} catch (Exception $e) {
    header('Content-type: text/html', true, 404);
    echo '404 - Page Not Found!';
    // include 404 page
}