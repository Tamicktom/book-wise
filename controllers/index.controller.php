<?php

// grab the search from the searchParams
$search = $_GET['search'] ?? '';

// import books from books.php
require_once '_books.php';

$filtered_books = [];

if ($search) {
  foreach ($books as $book) {
    if (strpos(strtolower($book->title), strtolower($search)) !== false) {
      $filtered_books[] = $book;
    }
  }
} else {
  $filtered_books = $books;
}

$view = "views/index.view.php";

require "views/template/app.php";