<?php

require "_book.php"; // import Book class

class DB
{
  private $pdo = null;
  private $query = null;

  public function __construct()
  {
    $this->pdo = new PDO("sqlite:db.sqlite");
  }

  public function query(string $unprepared_sql, array $params = [])
  {
    $this->query = $this->pdo->prepare($unprepared_sql);
    $this->query->execute($params);

    return $this->query->fetchAll();
  }
}

$db = new DB();
