<?php

require 'models/user.model.php';

$view = 'views/register.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $confirm_password = $_POST['confirm-password'] ?? null;

  $validations = [];

  if (strlen($name) < 3) {
    $validations[] = 'O nome deve ter pelo menos 3 caracteres.';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $validations[] = 'Email inválido.';
  }
  if (strlen($password) < 6) {
    $validations[] = 'A senha deve ter pelo menos 6 caracteres.';
  }
  if (strlen($confirm_password) < 6) {
    $validations[] = 'A confirmação de senha deve ter pelo menos 6 caracteres.';
  }
  if ($password !== $confirm_password) {
    $validations[] = 'As senhas não coincidem.';
  }
  if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $validations[] = 'Todos os campos são obrigatórios.';
  }

  if (count($validations) > 0) {
    $_SESSION['validations'] = $validations;
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
