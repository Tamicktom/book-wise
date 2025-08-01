<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
  header("Location: /my-books");
  exit();
}

// if user is not authenticated, redirect to login
if (!auth()) {
  header("Location: /login");
  exit();
}
