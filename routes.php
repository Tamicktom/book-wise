<?php

$request_url = $_SERVER["REQUEST_URI"];

$routes = [
  "/" => "index",
  "/book" => "book",
  "/my-books" => "my-books",
];

function clearRouteSearchParams($route)
{
  return explode("?", $route)[0];
}

function getRouteOrDefault()
{
  global $request_url, $routes;
  $route = clearRouteSearchParams($request_url);
  return $routes[$route] ?? "404";
}
