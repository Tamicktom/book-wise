<?php

//* Components imports
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

function getRating($value): string
{
  $rating = '';
  $int_from_rating = intval($value);
  $rest_from_rating = $value - $int_from_rating;
  $rating = str_repeat('★', $int_from_rating);

  if ($rest_from_rating >= 0.5) {
    $rating .= '⯪';
  }

  return $rating;
}

$total_avaliations = count($avaliations);

?>

<div class="pt-12">
  <main
    class="grid grid-cols-6 gap-4 p-4 rounded-lg border"
    style="background-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>40;
       border-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>80;">
    <figure
      class="col-span-2 flex justify-center items-center border rounded-lg hover:scale-105 transition-transform duration-300"
      style="border-color: #<?= htmlspecialchars($book->predominant_color, ENT_QUOTES, 'UTF-8') ?>80;">
      <img
        id="<?= htmlspecialchars('book-image-' . $book->id, ENT_QUOTES, 'UTF-8') ?>"
        src="<?= htmlspecialchars($book->image_url, ENT_QUOTES, 'UTF-8') ?>"
        alt="<?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>"
        class="object-cover size-full max-h-[512px] rounded-lg" />
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

  <div class="flex flex-col gap-8 pt-8">
    <div class="grid grid-cols-4 gap-4">
      <div class="col-span-3 flex flex-col gap-4">
        <div class="flex flex-col gap-2">
          <h2 class="text-center w-full font-bold text-2xl">
            Avaliações
          </h2>
          <span class="text-stone-500 text-center">
            <?php
            $text = "($total_avaliations)";
            if ($total_avaliations !== 0) {
              $text = "($total_avaliations) - Média: " . getRating($average_rating);
            }
            echo htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            ?>
          </span>
        </div>
        <?php
        if (count($avaliations) === 0) {
          echo '<p class="text-stone-500 w-full text-center">Nenhuma avaliação encontrada para este livro.</p>';
        } else {
          foreach ($avaliations as $avaliation) {
            $user_name = htmlspecialchars($avaliation['user_name'], ENT_QUOTES, 'UTF-8');
            $rating = htmlspecialchars($avaliation['rating'], ENT_QUOTES, 'UTF-8');
            $comment = htmlspecialchars($avaliation['comment'], ENT_QUOTES, 'UTF-8');

            $rating_color = $rating >= 4 ? 'text-green-500' : ($rating >= 2 ? 'text-yellow-500' : 'text-red-500');
            $rating = getRating($rating);

            echo <<<HTML
              <div class="border border-stone-700 rounded w-full p-2 space-y-2">
                <div class="flex flex-row justify-between items-center">
                  <h3 class="font-semibold">{$user_name}</h3>
                  <p class="{$rating_color}">
                    {$rating}
                  </p>
                </div>
                <p>{$comment}</p>
              </div>
            HTML;
          }
        }
        ?>
      </div>
      <?php if (auth()): ?>
        <div class="border border-stone-700 rounded p-4">
          <h3 class="text-center w-full font-bold text-xl">Avaliar</h3>
          <form class="space-y-4 pt-2" method="post" action="/avaliation?book_id=<?= htmlspecialchars($book->id, ENT_QUOTES, 'UTF-8') ?>">
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
              $avaliation_input->value = ""; // Valor inicial vazio
              $avaliation_input->required = true;
              echo $avaliation_input->render();

              if ($has_errors && isset($validation_errors['avaliation'])) {
                echo '<p class="text-sm text-red-500">' . $validation_errors['avaliation']->getMessage() . '</p>';
              }
              ?>
            </div>

            <div class="flex flex-col w-full gap-2">
              <?php
              $label = new Label();
              $label->for = "rating-select";
              $label->text = "Nota";
              echo $label->render();

              $rating_select = new Select();
              $rating_select->id = "rating-select";
              $rating_select->name = "rating";
              $rating_select->placeholder = "Selecione uma nota";
              $rating_select->options = [
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
            $button->name = "submit_avaliation"; // Mudança: nome diferente do textarea
            $button->text = "Enviar Avaliação";
            $button->type = ButtonType::SUBMIT;
            echo $button->render();
            ?>
          </form>
        </div>
      <?php endif; ?>
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