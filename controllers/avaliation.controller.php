<?php

//check if is a POST request
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
  header("location: /");
  exit('Method Not Allowed');
}

//get user id from session
$user = $_SESSION['user'] ?? null;

if (!$user) {
  header("location: /");
  exit('Unauthorized');
}

//get book id from params
$bookId = $_GET['book_id'] ?? null;

if (!$bookId) {
  header("location: /");
  exit('Bad Request');
}

require_once 'models/avaliation.model.php';

$avaliationModel = new Avaliation();
$avaliation = $avaliationModel->addAvaliation(
  bookId: (int)$bookId,
  userId: (int)$user['id'],
  rating: (float)$_POST['rating'],
  comment: $_POST['avaliation'] ?? ''
);

// Send user to the book page
header("location: /book?id=" . $bookId);