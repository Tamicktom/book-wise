<?php

require "_book.php"; // import Book class

class DB
{
  private $pdo = null;
  private $query = null;

  public function __construct()
  {
    $config = require('config.php');

    $connectionString = sprintf(
      "%s:%s",
      $config['driver'],
      $config['database']
    );

    $this->pdo = new PDO($connectionString);
  }

  public function query(string $unprepared_sql, array $params = [])
  {
    $this->query = $this->pdo->prepare($unprepared_sql);
    $this->query->execute($params);

    return $this->query->fetchAll();
  }
}

$db = new DB();
