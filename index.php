<?php
// grab the search from the searchParams
$search = $_GET['search'] ?? '';

if ($search) {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <title>BookWise</title>
</head>

<body class="bg-stone-950 text-stone-200">
  <header class="shadow-lg bg-stone-900">
    <nav class="flex justify-between max-w-screen-lg px-8 py-4 mx-auto">
      <div class="text-xl font-bold tracking-wider">BookWise</div>
      <ul class="flex space-x-4 font-bold">
        <li>
          <a href="/" class="text-lime-500">Explorar</a>
        </li>
        <li>
          <a href="/my-books.php" class="hover:underline">Meus Livros</a>
        </li>
      </ul>
      <ul>
        <li>
          <a href="/login.php" class="hover:underline">Login</a>
        </li>
      </ul>
    </nav>
  </header>

  <main class="max-w-screen-lg mx-auto space-y-6">
    <form action="" class="flex items-center pt-6 space-x-2">
      <input
        type="text"
        name="search"
        id="search-input"
        class="p-2 text-sm border-2 rounded-md border-stone-800 bg-stone-900 text-stone-200 focus:outline-none focus:border-lime-500"
        placeholder="Pesquisar"
        value="<?php echo $search; ?>" />
      <button type="submit">🔍</button>
    </form>

    <section class="grid grid-cols-3 gap-2 space-y-4">

      <div class="grid grid-cols-4 col-span-1 gap-2 p-2 transition-all border-2 rounded border-stone-800 hover:bg-stone-800">
        <div class="col-span-1 overflow-hidden rounded">
          <img
            src="https://i.pinimg.com/736x/92/9b/6b/929b6bceaea9375dc515c099aad59892.jpg"
            alt="Imagem do livro"
            class="object-cover size-full" />
        </div>
        <div class="col-span-3">
          <div class="font-semibold">Título</div>
          <div class="text-xs italic">Autor</div>
          <div class="text-xs italic">⭐⭐⭐⭐⭐ (3 Avaliações)</div>
          <div class="text-sm text-stone-400">
            Descrição curta
          </div>
        </div>
      </div>

    </section>
  </main>
</body>

</html>