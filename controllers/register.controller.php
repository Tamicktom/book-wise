<?php

require 'models/user.model.php';
require 'Validation.php';

$view = 'views/register.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $confirm_password = $_POST['confirm-password'] ?? null;

  $schema = new Schema([
    'name' => ['required', 'min:3'],
    'email' => ['required', 'email'],
    'password' => ['required', 'min:6'],
    'confirm_password' => ['required', 'min:6'],
  ]);

  $validation = Validation::parse($schema, $_POST);

  if (!$validation->isValid()) {
    $errors = $validation->getErrors();
    $_SESSION['validations'] = $errors;
    header('Location: /register');
  } else {
    unset($_SESSION['validations']);

    $user = new UserModel();
    $existing_user = $user->getUser($email);
    if ($existing_user) {
      $error = 'Email já cadastrado.';
    } else {
      $user->createUser($name, $email, $password);
      $message = 'Usuário cadastrado com sucesso. Você pode fazer login agora.';
      header('Location: /login?message=' . urlencode($message));
      exit;
    }
  }
}

require 'views/template/app.php';
