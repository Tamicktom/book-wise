<?php

require_once 'models/model.php';

class UserModel extends Model
{
  public function getUser(string $email): ?array
  {
    $sql = "SELECT * FROM users WHERE email = :email";
    $params = ['email' => $email];

    $queried_user = $this->db->query($sql, $params);

    return $queried_user[0] ?? null;
  }

  public function createUser(string $name, string $email, string $password)
  {
    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $params = [
      'name' => $name,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_BCRYPT)
    ];

    return $this->db->query($sql, $params);
  }
}
