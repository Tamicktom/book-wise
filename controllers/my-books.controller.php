<?php

require_once "models/user-books.model.php";

$user_books_model = new UserBooksModel();
$user_books = $user_books_model->getUserBooks($_SESSION['user']['id'] ?? 0);

$view = "views/my-books.view.php";

require "views/template/app.php";