<?php

require_once "models/model.php";
require_once "models/book.model.php";

class UserBooksModel extends Model
{
  private array $userBooks = [];

  public function getUserBooks(int $userId): array
  {
    if (!empty($this->userBooks)) {
      return $this->userBooks;
    }

    $sql = "SELECT * FROM user_books WHERE user_id = :user_id";
    $params = ['user_id' => $userId];

    $userBooksQuery = $this->db->query($sql, $params);

    if (empty($userBooksQuery)) {
      return [];
    }

    $bookModel = new BookModel();
    foreach ($userBooksQuery as $key => $userBook) {
      $book = $bookModel->getBook($userBook['book_id']);
      if ($book) {
        $this->userBooks[$key] = $book;
      } else {
        $this->userBooks[$key] = null; // or handle missing book
      }
    }

    return $this->userBooks;
  }
}
