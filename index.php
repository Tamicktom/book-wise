<?php
// grab the search from the searchParams
$search = $_GET['search'] ?? '';

// import books from books.php
require_once '_books.php';
require_once 'book-card.php';

$filtered_books = [];

if ($search) {
  foreach ($books as $book) {
    if (strpos(strtolower($book['title']), strtolower($search)) !== false) {
      $filtered_books[] = $book;
    }
  }
} else {
  $filtered_books = $books;
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
      /**
       * Loop through the filtered books and display them
       */
      foreach ($filtered_books as $book) {
        book_card($book);
      }
      ?>

    </section>
  </main>
</body>

</html>