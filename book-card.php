<?php

function book_card($book)
{
  $rating = '';
  for ($i = 0; $i < $book['rating']; $i++) {
    $rating .= '⭐';
  }

  $book_url = "/book.php?id=" . $book['id'];

  echo '
      <div class="grid h-48 grid-cols-5 col-span-1 gap-2 p-2 transition-all border-2 rounded border-stone-800 hover:bg-stone-800">
      <a href=' . $book_url . ' class="h-full col-span-2 overflow-hidden rounded">
        <img
          src="' . $book['image'] . '"
          alt="Imagem do livro"
          class="object-cover size-full" />
      </a>
      <div class="col-span-3 flex flex-col justify-start gap-2">
        <a href=' . $book_url . ' class="font-semibold hover:underline">
          ' . $book['title'] . '
        </a>
        <div class="text-xs italic">
          ' . $book['author'] . '
        </div>
        <div class="text-xs italic">
          ' . $rating . '
        </div>
        <div class="text-sm text-stone-400 h-fit line-clamp-3">
          ' . $book['description'] . '
        </div>
      </div>
    </div>
    ';
}
