<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>BookWise</title>
</head>

<body class="bg-stone-950 text-stone-200">
  <header class="shadow-lg bg-stone-900">
    <nav class="flex justify-between max-w-screen-lg px-8 py-4 mx-auto">
      <a href="/">
        <div class="text-xl font-bold tracking-wider">BookWise</div>
      </a>
      <ul class="flex space-x-4 font-bold">
        <li>
          <a href="/" class="text-lime-500">Explorar</a>
        </li>
        <li>
          <a href="/my-books" class="hover:underline">Meus Livros</a>
        </li>
      </ul>
      <ul>
        <li>
          <a href="/login" class="hover:underline">Login</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="flex flex-col items-center justify-start max-w-screen-lg mx-auto space-y-6">
    <?php
    require $view;
    ?>
  </main>
</body>

</html>