<?php

require_once 'models/model.php';

// create table
//   avaliations (
//     id integer primary key,
//     user_id integer not null references users,
//     book_id integer not null references books,
//     rating real not null,
//     comment text
//   );

class Avaliation extends Model
{
  private array $avaliations = [];

  public function getBookAvaliations(int $bookId): array
  {

    return [];
  }
  public function getUserAvaliations(int $userId): array
  {

    return [];
  }

  public function addAvaliation(int $bookId, $userId, float $rating, string $comment): array
  {
    // Validate inputs
    if ($rating < 0 || $rating > 5) {
      throw new InvalidArgumentException('Rating must be between 0 and 5.');
    }

    $sql = "INSERT INTO avaliations (user_id, book_id, rating, comment) VALUES (:user_id, :book_id, :rating, :comment)";
    $params = [
      'user_id' => $userId,
      'book_id' => $bookId,
      'rating' => $rating,
      'comment' => $comment
    ];

    return $this->db->query($sql, $params);
  }
}
