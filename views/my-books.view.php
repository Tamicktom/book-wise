<?php

require 'components/input.php';
require 'components/textarea.php';
require 'components/label.php';
require 'components/button.php';

// create table books
// (
//     id                integer
//         primary key,
//     title             varchar(255),
//     author            varchar(255),
//     description       text,
//     release_year      integer,
//     rating            real,
//     number_of_pages   integer,
//     image_url         varchar(2047),
//     rating_quantity   integer    default 0 not null,
//     predominant_color varchar(6) default 'FFFFFF'
// );

$validation_errors = [];

if (isset($_SESSION['validations'])) {
  $validation_errors = $_SESSION['validations'];
}

$has_errors = count($validation_errors) > 0;

?>

<div class="py-4">
  <h1 class="text-2xl font-bold">
    My Books
  </h1>
</div>

<div class="flex flex-col justify-center">
  <form action="/create-book" method="post">
    <div class="flex flex-col w-full gap-2">
      <?php
      $label = new Label();
      $label->for = "title-input";
      $label->text = "Título";
      echo $label->render();

      $avaliation_input = new Input();
      $avaliation_input->id = "title-input";
      $avaliation_input->name = "title";
      $avaliation_input->placeholder = "Nome do livro";
      $avaliation_input->value = ""; // Valor inicial vazio
      $avaliation_input->required = true;
      echo $avaliation_input->render();

      if ($has_errors && isset($validation_errors['title'])) {
        echo '<p class="text-sm text-red-500">' . $validation_errors['title']->getMessage() . '</p>';
      }
      ?>
    </div>

    <div class="flex flex-col justify-center">
      <?php
      $label = new Label();
      $label->for = "author-input";
      $label->text = "Autor";
      echo $label->render();

      $avaliation_input = new Input();
      $avaliation_input->id = "author-input";
      $avaliation_input->name = "author";
      $avaliation_input->placeholder = "Nome do autor";
      $avaliation_input->value = ""; // Valor inicial vazio
      $avaliation_input->required = true;
      echo $avaliation_input->render();

      if ($has_errors && isset($validation_errors['author'])) {
        echo '<p class="text-sm text-red-500">' . $validation_errors['author']->getMessage() . '</p>';
      }
      ?>
    </div>

    <div class="flex flex-col justify-center">
      <?php
      $label = new Label();
      $label->for = "description-input";
      $label->text = "Descrição";
      echo $label->render();

      $avaliation_input = new Textarea();
      $avaliation_input->id = "description-input";
      $avaliation_input->name = "description";
      $avaliation_input->placeholder = "Descrição";
      $avaliation_input->value = ""; // Valor inicial vazio
      $avaliation_input->required = true;
      echo $avaliation_input->render();

      if ($has_errors && isset($validation_errors['description'])) {
        echo '<p class="text-sm text-red-500">' . $validation_errors['description']->getMessage() . '</p>';
      }
      ?>
    </div>



    <?php
    $button = new Button();
    $button->id = "create-book-button";
    $button->name = "submit_create_book"; // Mudança: nome diferente do textarea
    $button->text = "Cadastrar livro";
    $button->type = ButtonType::SUBMIT;
    echo $button->render();
    ?>
  </form>
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