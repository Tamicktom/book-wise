<?php

require 'components/input.php';

$search_input = new Input();
$search_input->id = "search-input";
$search_input->name = "search";
$search_input->placeholder = "Pesquisar";
$search_input->value = $search ?? '';

$_SESSION['search'] = $search_input->value;

?>

<form action="" class="flex items-center justify-center w-full gap-2 pt-6">
  <?php echo $search_input->render(); ?>
  <button type="submit">🔍</button>
</form>

<section class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-3">
  <?php

  /**
   * Loop through the filtered books and display them
   */
  foreach ($books as $book) {
    $book->render();
  }

  ?>

</section>