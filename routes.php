<?php

$request_url = $_SERVER["REQUEST_URI"];

$routes = [
  "/" => "index",
  "/book" => "book",
  "/my-books" => "my-books",
];

function clearRouteSearchParams($route): String
{
  return explode("?", $route)[0];
}

function getRouteOrDefault(): String
{
  global $request_url, $routes;
  $route = clearRouteSearchParams($request_url);
  return $routes[$route] ?? "404";
}

$controller = getRouteOrDefault();

if (!file_exists("controllers/{$controller}.controller.php")) {
  $controller = "404";
} else {
  require "controllers/{$controller}.controller.php";
}
