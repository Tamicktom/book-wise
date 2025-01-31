<?php

// grab the search from the searchParams
$search = $_GET['search'] ?? '';

// import books from books.php
require_once '_books.php';

$filtered_books = [];

if ($search) {
  foreach ($books as $book) {
    if (strpos(strtolower($book->title), strtolower($search)) !== false) {
      $filtered_books[] = $book;
    }
  }
} else {
  $filtered_books = $books;
}


?>

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
    $book->render();
  }

  ?>

</section>