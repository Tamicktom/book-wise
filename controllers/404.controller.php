<?php

http_response_code(404); // set the response code to 404

$view = "views/404.view.php";

require "views/template/app.php";