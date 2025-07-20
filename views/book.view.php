<?php

require 'components/input.php';
require 'components/label.php';
require 'components/button.php';
require 'components/textarea.php';
require 'components/select.php';

//grab the message from queryParams
$message = $_GET['message'] ?? null;

$validation_errors = [];

if (isset($_SESSION['validations'])) {
  $validation_errors = $_SESSION['validations'];
}

$has_errors = count($validation_errors) > 0;

?>

<div class="pt-12">
  <main
    class="grid grid-cols-6 gap-4 p-4 rounded-lg border"
    style="background-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>40;
       border-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>80;">
    <figure
      class="col-span-2 flex justify-center items-center border rounded-lg"
      style="border-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>80;">
      <img
        id="<?= htmlspecialchars('book-image-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
        src="<?= htmlspecialchars($book->image_url, ENT_QUOTES, 'UTF-8') ?>"
        alt="<?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>"
        class="object-cover w-fit max-h-[512px] rounded-lg" />
    </figure>

    <article class="col-span-4 flex flex-col justify-start gap-2 p-2">
      <header>
        <h1
          id="<?= htmlspecialchars('book-title-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
          class="font-semibold text-2xl">
          <?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>
        </h1>
        <p
          id="<?= htmlspecialchars('book-author-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
          class="italic">
          <?= htmlspecialchars($book->author, ENT_QUOTES, 'UTF-8') ?>
        </p>
      </header>
      <div
        id="<?= htmlspecialchars('book-rating-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
        class="italic">
        <?= htmlspecialchars($book->getRating(), ENT_QUOTES, 'UTF-8') ?>
      </div>
      <p
        id="<?= htmlspecialchars('book-description-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
        class="text-stone-400 h-fit line-clamp-3">
        <?= htmlspecialchars($book->description, ENT_QUOTES, 'UTF-8') ?>
      </p>
    </article>
  </main>

  <div>
    <h2>Avaliações</h2>
    <div class="grid grid-cols-4 gap-4">
      <div class="col-span-3">list</div>
      <div class="border border-stone-700 rounded">
        <h3>Avaliar</h3>
        <form class="p-4 space-y-4" method="post">
          <div class="flex flex-col w-full gap-2">
            <?php
            $label = new Label();
            $label->for = "avaliation-input";
            $label->text = "Avaliação";
            echo $label->render();

            $avaliation_input = new Textarea();
            $avaliation_input->id = "avaliation-input";
            $avaliation_input->name = "avaliation";
            $avaliation_input->placeholder = "Escreva sua avaliação aqui";
            $avaliation_input->required = true;
            echo $avaliation_input->render();

            if ($has_errors && isset($validation_errors['avaliation'])) {
              echo '<p class="text-sm text-red-500">' . $validation_errors['avaliation']->getMessage() . '</p>';
            }
            ?>
          </div>

          <div class="flex flex-col w-full gap-2">
            <?php
            // $label = new Label();
            // $label->for = "rating-input";
            // $label->text = "Nota";
            // echo $label->render();

            // $rating_input = new Input();
            // $rating_input->type = InputType::NUMBER;
            // $rating_input->id = "rating-input";
            // $rating_input->name = "rating";
            // $rating_input->placeholder = "De 0 a 5";
            // $rating_input->required = true;
            // echo $rating_input->render();

            // if ($has_errors && isset($validation_errors['rating'])) {
            //   echo '<p class="text-sm text-red-500">' . $validation_errors['rating']->getMessage() . '</p>';
            // }

            $label = new Label();
            $label->for = "rating-select";
            $label->text = "Nota";
            echo $label->render();

            $rating_select = new Select();
            $rating_select->id = "rating-select";
            $rating_select->name = "rating";
            $rating_select->placeholder = "Selecione uma nota";
            $rating_select->options = [
              '0' => '0',
              '1' => '1',
              '2' => '2',
              '3' => '3',
              '4' => '4',
              '5' => '5',
            ];
            echo $rating_select->render();
            ?>
          </div>

          <?php
          $button = new Button();
          $button->id = "avaliation-button";
          $button->name = "avaliation";
          $button->text = "Enviar Avaliação";
          $button->type = ButtonType::SUBMIT;
          echo $button->render();
          ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // go back one page if "esc" key is pressed
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      window.history.back();
    }
  });
</script>