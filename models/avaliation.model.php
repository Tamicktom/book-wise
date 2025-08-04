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

    $sql = "SELECT rating, rating_quantity FROM books WHERE id = :book_id";
    $params = [
      'book_id' => $bookId,
    ];
    $bookData = $this->db->query($sql, $params)[0];

    $totalAvaliationsQuantity = $bookData["rating_quantity"];
    $averageRating = $bookData["rating"];

    $newAverageRating = ($averageRating + $rating) / 2;
    $newRatingQuantity = $totalAvaliationsQuantity + 1;

    // Update book rating and rating_quantity
    $sql = "UPDATE books SET (rating, rating_quantity) = (:rating, :rating_quantity) WHERE (id) = (:book_id)";
    $params = [
      "rating_quantity" => $newRatingQuantity,
      "rating" => $newAverageRating,
      "book_id" => $bookId
    ];

    $this->db->query($sql, $params);

    return $addAvaliationResult;
  }
}
