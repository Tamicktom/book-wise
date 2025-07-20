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
}
