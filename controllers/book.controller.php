<?php
//* grab the book id from the query string. Example: book.php?id=1
global $books;
$book_id = $_GET['id'];

//import books from books.php
require_once '_books.php';

$book = array_filter($books, fn($book) => $book->id == $book_id);

$book = array_pop($book);

$view = 'book';
require "views/template/app.php";
