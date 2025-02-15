<?php

$view = 'views/book.view.php';

$book_id = $_GET['id'];

require_once "db.php";

$book = $db->book($book_id);

require 'views/template/app.php';
