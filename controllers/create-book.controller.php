<?php

require 'models/book.model.php';
require_once "Validation.php";
require_once "Flash.php";

// dd($_POST);

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /my-books");
  exit();
}

// if user is not authenticated, redirect to login
if (!auth()) {
  header("Location: /login");
  exit();
}

$images_dir = 'public/images/books';

$image = $_FILES['image'];
$image_type = pathinfo($image['name'], PATHINFO_EXTENSION);
// generate a random image name
$random_image_name = md5(uniqid() . $image['name']) . md5(uniqid());
$full_image_name = $random_image_name . '.' . $image_type;

$schema = new Schema([
  'title' => ['required', 'min:3'],
  'author' => ['required', 'min:3'],
  'description' => ['required', 'min:3'],
  'release_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')],
  'rating' => ['required', 'integer', 'max: 5'],
  'number_of_pages' => ['required', 'integer', 'min:1'],
  // 'image' => ['required', 'file', 'image', 'max:8192'], // 8MB
  'image_url' => ['required', 'url'],
  // 'predominant_color' => ['required', 'hex_color'],
]);

$validation = Validation::parse($schema, [
  ...$_POST,
  'image_url' => 'http://localhost:8888/public/images/books/' . $full_image_name,
]);

$flash = new Flash(); // Flash messages handler

if (!$validation->isValid()) {
  $errors = $validation->getErrors();

  $flash->push('errors', $errors);
  header('Location: /create-book');
} else {
  unset($_SESSION['validations']);

  $book = new BookModel();
  $newBook = $book->createBook($validation->getParsedData());

  // move the image to the images directory
  $file = "$images_dir/$full_image_name";
  move_uploaded_file($image['tmp_name'], $file);

  header("Location: /book?id={$newBook->id}");
  exit();
}
