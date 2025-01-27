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
      <a href="/">
        <div class="text-xl font-bold tracking-wider">BookWise</div>
      </a>
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

  <main class="flex flex-col items-center justify-start max-w-screen-lg mx-auto space-y-6">
    <form action="" class="flex items-center justify-center w-full gap-2 pt-6">
      <input
        type="text"
        name="search"
        id="search-input"
        class="w-full max-w-xs p-2 text-sm transition-all border-2 rounded-md border-stone-800 bg-stone-900 text-stone-200 focus:outline-none focus:border-lime-500"
        placeholder="Pesquisar"
        value="<?php echo $search; ?>" />
      <button type="submit">🔍</button>
    </form>

    <section class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">

      <?php
      // get the books from the database
      $books = [
        [
          'title' => 'The Great Gatsby',
          'author' => 'F. Scott Fitzgerald',
          'rating' => 4,
          'description' => 'Uma história de amor e de tragédia',
          'image' => 'https://i.pinimg.com/736x/92/9b/6b/929b6bceaea9375dc515c099aad59892.jpg'
        ],
        [
          'title' => 'The Catcher in the Rye',
          'author' => 'J. D. Salinger',
          'rating' => 3,
          'description' => 'Uma história de amor e de tragédia',
          'image' => 'https://i.pinimg.com/736x/47/f4/09/47f40920c240110dbb088543612bc6e0.jpg'
        ],
        [
          'title' => 'The Catcher in the Rye',
          'author' => 'J. D. Salinger',
          'rating' => 2,
          'description' => 'Uma história de amor e de tragédia',
          'image' => 'https://i.pinimg.com/736x/ed/dd/df/eddddfb389102ae4dc115c60daf6cc1f.jpg'
        ],
        [
          'title' => 'Harry Potter and the Philosopher\'s Stone',
          'author' => 'J. K. Rowling',
          'rating' => 1,
          'description' => 'Uma história de amor e de tragédia',
          'image' => 'https://i.pinimg.com/736x/a4/16/0d/a4160de9649cff905b7b2c8b4adbc88d.jpg'
        ],
      ];

      foreach ($books as $book) {
        // display the books
        $rating = '';
        for ($i = 0; $i < $book['rating']; $i++) {
          $rating .= '⭐';
        }
        echo '
            <div class="grid h-48 grid-cols-5 col-span-1 gap-2 p-2 transition-all border-2 rounded border-stone-800 hover:bg-stone-800">
            <div class="h-full col-span-2 overflow-hidden rounded">
              <img
                src="' . $book['image'] . '"
                alt="Imagem do livro"
                class="object-cover size-full" />
            </div>
            <div class="col-span-3">
              <div class="font-semibold">
                ' . $book['title'] . '
              </div>
              <div class="text-xs italic">
                ' . $book['author'] . '
              </div>
              <div class="text-xs italic">
                ' . $rating . '
              </div>
              <div class="text-sm text-stone-400">
                ' . $book['description'] . '
              </div>
            </div>
          </div>
          ';
      }
      ?>

    </section>
  </main>
</body>

</html>