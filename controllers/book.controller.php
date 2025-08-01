<?php

$view = 'views/book.view.php';

$book_id = $_GET['id'];

require_once 'models/book.model.php';

$book_model = new BookModel();

$book = $book_model->getBook($book_id);
$avaliations = $book_model->getBookAvaliations($book_id);
$average_rating = $book_model->getAverageRating($book_id);

require 'views/template/app.php';
