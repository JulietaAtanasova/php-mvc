<?php
session_start();
//ini_set('display_errors', 1);
spl_autoload_register(function($className) {
    $classPathSplitted = explode('\\', $className);
    $vendor = $classPathSplitted[0];
    $classPath = str_replace(
        $vendor . "\\",
        "",
        $className
    );

    $classPath = str_replace("\\", "/", $classPath);
    if (!is_readable($classPath.'.php')) {
        throw new \Exception();
    }
    require_once $classPath . ".php";
});

$configName = getenv('CONFIG_NAME');
/**
 * @var \PhotoAlbum\Configs\DbConfig $dbConfigClass
 */
$dbConfigClass = '\\PhotoAlbum\\Configs\\'
    . $configName . '\\DbConfig';

PhotoAlbum\Db::setInstance(
    $dbConfigClass::USER,
    $dbConfigClass::PASS,
    $dbConfigClass::DBNAME,
    $dbConfigClass::HOST
);

$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
$requestUri = explode('/', $_SERVER['REQUEST_URI']);
$customUri = [];
$controllerIndex = 0;
foreach ($scriptName as $k => $v) {
    if ($v == 'index.php') {
        $controllerIndex = $k;
        break;
    }
}
$actionIndex = $controllerIndex + 1;
$controllerName = $requestUri[$controllerIndex];
$actionName = $requestUri[$actionIndex];

$controllerClassName = '\\PhotoAlbum\\Controllers\\'
    . ucfirst($controllerName)
    . 'Controller';

$view = new \PhotoAlbum\View($controllerName, $actionName);

$request = [];
for ($key = $actionIndex + 1; $key < count($requestUri); $key += 2) {
    if (!isset($requestUri[$key+1])) {
        break;
    }

    $request[$requestUri[$key]] = $requestUri[$key+1];
}
$requestObject = new \PhotoAlbum\Request($request);

try {
    $controller = new $controllerClassName($view, $requestObject, $controllerName);
} catch (\Exception $e) {
    echo "No such controller";
}

if (!$actionName) {
    $actionName = "index";
}

if (!method_exists($controller, $actionName)) {
    die("no such action");
}

$controller->$actionName();

$view->render();
