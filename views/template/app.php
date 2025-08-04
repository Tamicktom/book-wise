<?php

$user = $_SESSION['user'] ?? null;

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>BookWise</title>
</head>

<body class="bg-stone-100 dark:bg-stone-950 text-stone-200 flex flex-col items-center justify-start min-h-screen">
  <header class="shadow-lg bg-stone-900 w-full">
    <nav class="flex justify-between max-w-screen-lg px-8 py-4 mx-auto items-center">
      <a href="/">
        <div class="text-xl font-bold tracking-wider">BookWise</div>
      </a>
      <ul class="flex space-x-4 font-bold">
        <li>
          <a href="/" class="text-lime-500">Explorar</a>
        </li>
        <?php if (auth() != null): ?>
          <li>
            <a href="/my-books" class="hover:underline">Meus Livros</a>
          </li>
        <?php endif; ?>
      </ul>
      <ul>
        <?php
        if (!$user) {
          echo <<<HTML
          <li>
          <a href="/login" class="hover:underline">
            <button class="cursor-pointer border border-lime-500 text-lime-500 px-4 py-2 rounded font-bold hover:bg-lime-500 hover:text-stone-900 transition-colors">
              Login
            </button>
          </a>
        </li>
        HTML;
        } else {
          echo <<<HTML
          <li>
            <a href="/logout" class="hover:underline">
              <button class="cursor-pointer border border-lime-500 text-lime-500 px-4 py-2 rounded font-bold hover:bg-lime-500 hover:text-stone-900 transition-colors">
                Logout
              </button>
            </a>
          </li>
          HTML;
        }
        ?>
      </ul>
    </nav>
  </header>

  <main class="flex flex-col items-center justify-start max-w-screen-lg w-full mx-auto space-y-6 pb-20">
    <?php
    require $view;
    ?>
  </main>
</body>

</html>