<?php

$view = 'views/login.view.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? null;
  $password = $_POST['password'] ?? null;

  // Aqui você pode adicionar a lógica de autenticação
  // if ($email && $password) {
  //   // Exemplo de validação simples
  //   if ($email === 'admin@example.com' && $password === 'password123') {
  //     header('Location: /dashboard');
  //     exit;
  //   } else {
  //     $error = 'Credenciais inválidas.';
  //   }
  // } else {
  //   $error = 'Por favor, preencha todos os campos.';
  // }
}

require 'views/template/app.php';
