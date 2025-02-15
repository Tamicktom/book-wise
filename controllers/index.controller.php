<?php

// grab the search from the searchParams
$search = $_GET['search'] ?? '';

require_once "db.php";

// get all books from the database
$books = $db->books(strtolower($search));

$view = "views/index.view.php";

require "views/template/app.php";