<div class="py-4">
  <h1 class="text-2xl font-bold">
    My Books
  </h1>
</div>

<section class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
  <?php

  /**
   * Loop through the filtered books and display them
   */
  foreach ($user_books as $book) {
    $book->render();
  }

  ?>
</section>