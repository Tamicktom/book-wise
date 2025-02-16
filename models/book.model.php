<?php

require_once 'models/model.php';
require_once '_book.php';

class BookModel extends Model
{
  public function getBooks(string $search = '', int $limit = 10)
  {
    $sql = "
      SELECT * FROM books 
      WHERE title LIKE :search OR author LIKE :search 
      LIMIT :limit
    ";

    $params = [
      'search' => '%' . $search . '%',
      'limit' => $limit
    ];

    $queried_books = $this->db->query($sql, $params);

    return Book::makeMany($queried_books);
  }

  public function getBook(string $id)
  {
    // $sql = "SELECT * FROM books WHERE id = $id";
    $sql = "SELECT * FROM books WHERE id = :id";
    $params = ['id' => $id];

    $queried_book = $this->db->query($sql, $params);

    return Book::make($queried_book[0]);
  }
}
