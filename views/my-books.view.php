<?php

require 'components/input.php';
require 'components/textarea.php';
require 'components/label.php';
require 'components/button.php';
require 'components/select.php';

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

<div class="w-full grid grid-cols-5 gap-2">
  <section class="grid grid-cols-1 w-full gap-2 sm:grid-cols-2 col-span-5 lg:col-span-3 p-4">
    <?php
    /**
     * Loop through the filtered books and display them
     */
    foreach ($user_books as $book) {
      $book->render();
    }
    ?>
  </section>

  <div class="flex flex-col justify-center col-span-5 lg:col-span-2 p-4 lg:p-2">
    <form action="/create-book" method="POST">
      <input
        name="rating"
        id="rating-input"
        type="number"
        value="5"
        class="hidden" />

      <div class="flex flex-col w-full gap-2">
        <?php
        $label = new Label();
        $label->for = "title-input";
        $label->text = "Título";
        echo $label->render();

        $title_input = new Input();
        $title_input->id = "title-input";
        $title_input->name = "title";
        $title_input->placeholder = "Nome do livro";
        $title_input->value = ""; // Valor inicial vazio
        $title_input->required = true;
        echo $title_input->render();

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

        $author_input = new Input();
        $author_input->id = "author-input";
        $author_input->name = "author";
        $author_input->placeholder = "Nome do autor";
        $author_input->value = ""; // Valor inicial vazio
        $author_input->required = true;
        echo $author_input->render();

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

        $description_input = new Textarea();
        $description_input->id = "description-input";
        $description_input->name = "description";
        $description_input->placeholder = "Descrição";
        $description_input->value = ""; // Valor inicial vazio
        $description_input->required = true;
        echo $description_input->render();

        if ($has_errors && isset($validation_errors['description'])) {
          echo '<p class="text-sm text-red-500">' . $validation_errors['description']->getMessage() . '</p>';
        }
        ?>
      </div>

      <div class="flex flex-col w-full gap-2">
        <?php
        $label = new Label();
        $label->for = "release_year-input";
        $label->text = "Ano de publicação";
        echo $label->render();

        $release_year = new Input();
        $release_year->id = "release_year-select";
        $release_year->name = "release_year";
        $release_year->placeholder = "Selecione um ano de publicação";
        $release_year->value = ""; // Valor inicial vazio
        $release_year->required = true;
        $release_year->type = InputType::NUMBER;
        echo $release_year->render();

        if ($has_errors && isset($validation_errors['release_year'])) {
          echo '<p class="text-sm text-red-500">' . $validation_errors['release_year']->getMessage() . '</p>';
        }
        ?>
      </div>

      <div class="flex flex-col justify-center">
        <?php
        $label = new Label();
        $label->for = "number_of_pages-input";
        $label->text = "Quantidade de páginas";
        echo $label->render();

        $number_of_pages = new Input();
        $number_of_pages->id = "number_of_pages-input";
        $number_of_pages->name = "number_of_pages";
        $number_of_pages->placeholder = "Quantidade de páginas";
        $number_of_pages->value = ""; // Valor inicial vazio
        $number_of_pages->required = true;
        $number_of_pages->type = InputType::NUMBER;
        echo $number_of_pages->render();

        if ($has_errors && isset($validation_errors['number_of_pages'])) {
          echo '<p class="text-sm text-red-500">' . $validation_errors['number_of_pages']->getMessage() . '</p>';
        }
        ?>
      </div>

      <div class="flex flex-col justify-center">
        <?php
        $label = new Label();
        $label->for = "image_url-input";
        $label->text = "Imagem";
        echo $label->render();

        $image_url = new Input();
        $image_url->id = "image_url-input";
        $image_url->name = "image_url";
        $image_url->placeholder = "Imagem da capa";
        $image_url->value = ""; // Valor inicial vazio
        $image_url->required = true;
        echo $image_url->render();

        if ($has_errors && isset($validation_errors['image_url'])) {
          echo '<p class="text-sm text-red-500">' . $validation_errors['image_url']->getMessage() . '</p>';
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
</div>