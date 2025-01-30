<?php
//* grab the book id from the query string. Example: book.php?id=1
$book_id = $_GET['id'];

//import books from books.php
require_once '_books.php';

$book = array_filter($books, fn($book) => $book->id == $book_id);

$book = array_pop($book);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Bookwise - <?= $book->title ?></title>
</head>

<body>
  <h1>
    <?= $book->title ?>
  </h1>
</body>

</html>