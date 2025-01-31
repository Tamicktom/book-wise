<?php

require "_books.php";

$request_url = $_SERVER["REQUEST_URI"];

$routes = [
  "/" => "index",
  "/book" => "book",
];

function clearRouteSearchParams($route)
{
  return explode("?", $route)[0];
}

function getRouteOrDefault($routes, $request_url)
{
  $route = clearRouteSearchParams($request_url);
  return $routes[$route] ?? "404";
}

$view = getRouteOrDefault($routes, $request_url);

require "views/template/app.php";
