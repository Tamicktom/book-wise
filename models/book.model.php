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

  public function getBookAvaliations(string $bookId): array
  {
    // SQL query to get all avaliations for a specific book
    // with the name of the user
    $sql = "
      SELECT avaliations.*, users.name AS user_name
      FROM avaliations
      JOIN users ON avaliations.user_id = users.id
      WHERE avaliations.book_id = :id;
    ";

    $params = ['id' => $bookId];

    return $this->db->query($sql, $params);
  }

  public function getAverageRating(string $bookId): float
  {
    // SQL query to get the average rating of a book
    $sql = "
      SELECT AVG(rating) AS average_rating
      FROM avaliations
      WHERE book_id = :id;
    ";

    $params = ['id' => $bookId];

    $result = $this->db->query($sql, $params);

    return (float) ($result[0]['average_rating'] ?? 0);
  }

  public function createBook(array $bookData): array
  {
    $sql = "
      INSERT INTO books (title, author, description, release_year, rating, number_of_pages, image_url)
      VALUES (:title, :author, :description, :release_year, :rating, :number_of_pages, :image_url)
    ";

    $params = [
      'title' => $bookData['title'],
      'author' => $bookData['author'],
      'description' => $bookData['description'],
      'release_year' => $bookData['release_year'],
      'rating' => $bookData['rating'],
      'number_of_pages' => $bookData['number_of_pages'],
      'image_url' => $bookData['image_url'],
    ];

    return $this->db->query($sql, $params);
  }
}
