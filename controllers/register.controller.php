<?php

require 'models/user.model.php';
require_once "Validation.php";

$view = 'views/register.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'] ?? null;
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $confirm_password = $_POST['confirm_password'] ?? null;

  $schema = new Schema([
    'name' => ['required', 'min:3'],
    'email' => ['required', 'email'],
    'password' => ['required', 'min:6'],
    'confirm_password' => ['required', 'min:6'],
  ]);

  $validation = Validation::parse($schema, $_POST);

  $flash = new Flash(); // Flash messages handler

  if (!$validation->isValid()) {
    $errors = $validation->getErrors();
    // $_SESSION['validations'] = $errors;
    $flash->push('errors', $errors);
    header('Location: /register');
  } else {
    unset($_SESSION['validations']);

    $user = new UserModel();
    $existing_user = $user->getUser($email);
    if ($existing_user) {
      $intl = new Internationalization();
      $msg = $intl->t('validation.email.errors.already_exists');
      // $_SESSION['validations'] = [
      //   'email' => new ValidationError(
      //     field: 'email',
      //     code: 'already_exists',
      //     message: $msg,
      //   ),
      // ];
      $flash->push('errors', [
        'email' => new ValidationError(
          field: 'email',
          code: 'already_exists',
          message: $msg,
        ),
      ]);
      header('Location: /register');
      exit;
    } else {
      $user->createUser($name, $email, $password);
      $message = 'Usuário cadastrado com sucesso. Você pode fazer login agora.';
      header('Location: /login?message=' . urlencode($message));
      exit;
    }
  }
}

require 'views/template/app.php';
