<?php

require 'models/book.model.php';
require_once "Validation.php";
require_once "Flash.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /my-books");
  exit();
}

// if user is not authenticated, redirect to login
if (!auth()) {
  header("Location: /login");
  exit();
}

$schema = new Schema([
  'title' => ['required', 'min:3'],
  'author' => ['required', 'min:3'],
  'description' => ['required', 'min:10'],
  'release_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
  'rating' => ['required', 'integer', 'min: 1', 'max: 5'],
  'number_of_pages' => ['required', 'integer', 'min:1'],
  'image_url' => ['required', 'url'],
  'predominant_color' => ['required', 'hex_color'],
]);

$validation = Validation::parse($schema, $_POST);

$flash = new Flash(); // Flash messages handler

if (!$validation->isValid()) {
  $errors = $validation->getErrors();

  $flash->push('errors', $errors);
  header('Location: /create-book');
} else {
  unset($_SESSION['validations']);

  $book = new BookModel();
  $newBook = $book->createBook($validation->getParsedData());

  header("Location: /book/{$newBook['id']}");
  exit();
}