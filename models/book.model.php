<?php

require_once 'models/model.php';
require_once '_book.php';

class BookModel extends Model
{
  public function getBooks(string $search = '')
  {
    $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' LIMIT 10";
    $queried_books = $this->db->query($sql);

    $books = [];

    foreach ($queried_books as $book) {
      $books[] = new Book($book);
    }

    return $books;
  }

  public function getBook(string $id)
  {
    $sql = "SELECT * FROM books WHERE id = $id";
    $queried_book = $this->db->query($sql);

    return new Book($queried_book[0]);
  }
}
