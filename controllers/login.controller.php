<?php

require 'models/user.model.php';

$view = 'views/login.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;

  if ($email && $password) {
    $user = new UserModel();
    $existing_user = $user->getUser($email);
    // Check if user exists
    if ($existing_user) {
      // Check if password is correct
      if ($user->checkPassword($password)) {
        // Start session and set user data
        $_SESSION['user'] = $existing_user;
        header('Location: /my-books');
        exit;
      } else {
        $error = 'Senha incorreta.';
      }
    } else {
      $error = 'Email não cadastrado.';
    }
  } else {
    $error = 'Por favor, preencha todos os campos.';
  }
}

require 'views/template/app.php';
