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
</div>

<script>
  // go back one page if "esc" key is pressed
  document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
      window.history.back();
    }
  });
</script>