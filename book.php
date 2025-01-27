<?php
//grab the book id from the query string. Example: book.php?id=1
$book_id = $_GET['id'];

$books = [
  [
    'id' => 1,
    'title' => 'The Great Gatsby',
    'author' => 'F. Scott Fitzgerald',
    'rating' => 4,
    'description' => 'Uma história de amor e de tragédia',
    'image' => 'https://i.pinimg.com/736x/92/9b/6b/929b6bceaea9375dc515c099aad59892.jpg'
  ],
  [
    'id' => 2,
    'title' => 'The Catcher in the Rye',
    'author' => 'J. D. Salinger',
    'rating' => 3,
    'description' => 'Uma história de amor e de tragédia',
    'image' => 'https://i.pinimg.com/736x/47/f4/09/47f40920c240110dbb088543612bc6e0.jpg'
  ],
  [
    'id' => 3,
    'title' => 'The Catcher in the Rye',
    'author' => 'J. D. Salinger',
    'rating' => 2,
    'description' => 'Uma história de amor e de tragédia',
    'image' => 'https://i.pinimg.com/736x/ed/dd/df/eddddfb389102ae4dc115c60daf6cc1f.jpg'
  ],
  [
    'id' => 4,
    'title' => 'Harry Potter and the Philosopher\'s Stone',
    'author' => 'J. K. Rowling',
    'rating' => 1,
    'description' => 'Uma história de amor e de tragédia',
    'image' => 'https://i.pinimg.com/736x/a4/16/0d/a4160de9649cff905b7b2c8b4adbc88d.jpg'
  ],
];

$book = $books[$book_id - 1];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>Bookwise - <?= $book['title'] ?></title>
</head>

<body>
  <h1>
    <?= $book['title'] ?>
  </h1>
</body>

</html>