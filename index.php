<?php

require "_books.php";
require "routes.php";

$controller = getRouteOrDefault();

require "controllers/{$controller}.controller.php";
