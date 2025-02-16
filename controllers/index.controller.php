<?php

// grab the search from the searchParams
$search = $_GET['search'] ?? '';

require_once 'models/book.model.php';

$book_model = new BookModel();

// get all books from the database
$books = $book_model->getBooks(strtolower($search));

$view = "views/index.view.php";

require "views/template/app.php";