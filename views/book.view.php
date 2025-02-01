<main class="grid grid-cols-6 gap-4 p-4">
  <figure class="col-span-2 flex justify-center items-center">
    <img
      src="<?= htmlspecialchars($book->image, ENT_QUOTES, 'UTF-8') ?>"
      alt="<?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>"
      class="object-cover w-fit max-h-[512px]"
    />
  </figure>

  <article class="col-span-4 flex flex-col justify-start gap-2 p-2">
    <header>
      <h1 class="font-semibold text-2xl">
        <?= htmlspecialchars($book->title, ENT_QUOTES, 'UTF-8') ?>
      </h1>
      <p class="italic">
        <?= htmlspecialchars($book->author, ENT_QUOTES, 'UTF-8') ?>
      </p>
    </header>
    <div class="italic">
      <?= htmlspecialchars($book->getRating(), ENT_QUOTES, 'UTF-8') ?>
    </div>
    <p class="text-stone-400 h-fit line-clamp-3">
      <?= htmlspecialchars($book->description, ENT_QUOTES, 'UTF-8') ?>
    </p>
  </article>
</main>