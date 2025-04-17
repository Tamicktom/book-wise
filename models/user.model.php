<?php

require_once 'models/model.php';

class UserModel extends Model
{
  private array $user = [];

  public function getUser(string $email): ?array
  {
    // check if theres already a loaded user
    if (!empty($this->user)) {
      return $this->userWithoutPassword();
    }

    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $params = ['email' => $email];

    $queried_user = $this->db->query($sql, $params);

    if (empty($queried_user)) {
      return null;
    }

    $this->user = $queried_user[0];

    return $this->userWithoutPassword();
  }

  private function userWithoutPassword(): array
  {
    return [
      'id' => $this->user['id'],
      'name' => $this->user['name'],
      'email' => $this->user['email'],
    ];
  }

  public function checkPassword(string $password): bool
  {
    if (empty($this->user)) {
      return false;
    }

    return password_verify($password, $this->user['password']);
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
