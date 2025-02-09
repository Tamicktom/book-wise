<?php
require "_books.php";

$view = 'views/book.view.php';

$book_id = $_GET['id'];

//import books from books.php
require_once '_books.php';

$db = new PDO('sqlite:db.sqlite');

$query = $db->prepare('SELECT * FROM books WHERE id = ?');
$query->execute([$book_id]);

$query_book = $query->fetch();

$book = new Book($query_book);

require 'views/template/app.php';
