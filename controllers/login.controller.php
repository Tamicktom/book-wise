<?php

require 'models/user.model.php';

$view = 'views/login.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;

  $schema = new Schema([
    'email' => ['required', 'email'],
    'password' => ['required', 'min:6'],
  ]);

  $validation = Validation::parse($schema, $_POST);

  if ($validation->isValid()) {
    unset($_SESSION['validations']);
    $user = new UserModel();
    $existing_user = $user->getUser($email);
    // Check if user exists and password is correct
    if ($existing_user && $user->checkPassword($password)) {
      $_SESSION['user'] = $existing_user;
      header('Location: /my-books');
      exit;
    } else {
      $intl = new Internationalization();
      $msg = $intl->t('validation.email.errors.invalid_credentials');
      $_SESSION['validations'] = [
        'email' => [
          new ValidationError(
            field: 'email',
            code: 'invalid_credentials',
            message: $msg,
          ),
        ],
      ];
      header('Location: /login');
      exit;
    }
  } else {
    $errors = $validation->getErrors();
    $_SESSION['validations'] = $errors;
    header('Location: /login');
  }
}

require 'views/template/app.php';
