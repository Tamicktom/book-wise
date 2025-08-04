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
  public function addAvaliation(int $bookId, $userId, float $rating, string $comment): array
  {
    // Validate inputs
    if ($rating < 1 || $rating > 5) {
      throw new InvalidArgumentException('Rating must be between 1 and 5.');
    }

    $sql = "INSERT INTO avaliations (user_id, book_id, rating, comment) VALUES (:user_id, :book_id, :rating, :comment)";
    $params = [
      'user_id' => $userId,
      'book_id' => $bookId,
      'rating' => $rating,
      'comment' => $comment
    ];

    $addAvaliationResult = $this->db->query($sql, $params);

    // Calculate new average rating based on all avaliation records
    $sql = "SELECT AVG(rating) as average_rating, COUNT(*) as total_avaliations FROM avaliations WHERE book_id = :book_id";
    $params = [
      'book_id' => $bookId,
    ];
    $avaliationStats = $this->db->query($sql, $params)[0];

    $newAverageRating = (float)$avaliationStats["average_rating"];
    $newRatingQuantity = (int)$avaliationStats["total_avaliations"];

    // Update book rating and rating_quantity
    $sql = "UPDATE books SET rating = :rating, rating_quantity = :rating_quantity WHERE id = :book_id";
    $params = [
      "rating_quantity" => $newRatingQuantity,
      "rating" => $newAverageRating,
      "book_id" => $bookId
    ];

    $this->db->query($sql, $params);

    return $addAvaliationResult;
  }
}
