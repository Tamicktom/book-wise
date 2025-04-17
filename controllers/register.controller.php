<?php

require 'models/user.model.php';

$view = 'views/register.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $confirm_password = $_POST['confirm-password'] ?? null;

  // Aqui você pode adicionar a lógica de autenticação
  $user = new UserModel();
  $existing_user = $user->getUser($email);
  if ($existing_user) {
    $error = 'Email já cadastrado.';
  } elseif ($password !== $confirm_password) {
    $error = 'As senhas não coincidem.';
  } else {
    $user->createUser($name, $email, $password);
    header('Location: /login');
    exit;
  }
}

require 'views/template/app.php';
