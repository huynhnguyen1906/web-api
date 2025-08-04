<?php

require_once __DIR__ . "/autoload.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/utility.php";
$routes = require_once __DIR__ . "/routes.php";

$method = filter_input(INPUT_SERVER, "REQUEST_METHOD");
$url    =  parse_url(filter_input(INPUT_SERVER, "REQUEST_URI"), PHP_URL_PATH);


$route = matchRoute($routes, $method, $url);

if( $route ){
    [ $class , $method ] = $route["handler"];
    $controller = new $class();
    call_user_func_array( [ $controller , $method ], $route["params"] );
}else{
    print "<p>404 Not Found</p>";
}


function matchRoute($routes, $method, $url) {
    foreach( $routes as $route ){
        [$routeMethod, $routePath, $handler ] = $route;
        $pattern = preg_replace("/\{[a-zA-Z0-9]+\}/", "([a-zA-Z0-9]+)", $routePath);
        $pattern = "#". $pattern . "$#";

        if( $routeMethod === $method && 
        preg_match( $pattern , $url , $matches )){
            array_shift($matches); 
            return ["handler" => $handler,"params" => $matches];
        }
    }
    return null;
}