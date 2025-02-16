<?php

require "_book.php"; // import Book class

class DB
{
  private $pdo = null;

  public function __construct()
  {
    $this->pdo = new PDO("sqlite:db.sqlite");
  }

  // public function books(string $search = '')
  // {
  //   $script = 'SELECT * FROM books WHERE title LIKE :search OR author LIKE :search LIMIT 10';
  //   $query = $this->pdo->prepare($script);
  //   $query->execute(['search' => '%' . $search . '%']);

  //   $books_query = $query->fetchAll();

  //   $books = [];

  //   foreach ($books_query as $book_query) {
  //     $books[] = new Book($book_query);
  //   }

  //   return $books;
  // }

  // public function book(int $id)
  // {
  //   $query = $this->pdo->prepare('SELECT * FROM books WHERE id = :id');
  //   $query->execute(['id' => $id]);
  //   $book_query = $query->fetch();

  //   return new Book($book_query);
  // }

  public function query(string $sql)
  {
    return $this->pdo->query($sql)->fetchAll();
  }
}

$db = new DB();
