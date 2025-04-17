<?php

$view = 'views/register.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;
  $confirm_password = $_POST['confirm-password'] ?? null;

  // Aqui você pode adicionar a lógica de autenticação
}

require 'views/template/app.php';
