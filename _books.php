<?php

$db = new PDO('sqlite:db.sqlite');

$query = $db->query('SELECT * FROM books');

global $books;

$books_query = $query->fetchAll();

class Book
{
  public string $id;
  public string $title;
  public string $author;
  public string $description;
  public string $image_url;
  public float $rating;
  public int $rating_quantity;
  public int $release_year;
  public int $number_of_pages;

  public function __construct($args)
  {
    $this->id = $args['id'];
    $this->title = $args['title'];
    $this->author = $args['author'];
    $this->description = $args['description'];
    $this->image_url = $args['image_url'];
    $this->rating = $args['rating'];
    $this->release_year = $args['release_year'];
    $this->number_of_pages = $args['number_of_pages'];
    $this->rating_quantity = $args['rating_quantity'];
  }

  public function getRating()
  {
    $rating = '';
    $int_from_rating = intval($this->rating);
    $rest_from_rating = $this->rating - $int_from_rating;
    $rating = str_repeat('★', $int_from_rating);
    
    if ($rest_from_rating >= 0.5) {
      $rating .= '⯪';
    }

    return $rating;
  }

  public function getBookUrl(): string
  {
    return "/book?id=" . $this->id;
  }

  public function render()
  {
    $book_url = $this->getBookUrl();

    $html = <<<HTML
      <article class="grid h-48 grid-cols-5 col-span-1 transition-all border-2 rounded border-stone-800 hover:bg-stone-800 overflow-hidden group">
        <figure class="h-full col-span-2 overflow-hidden">
          <a href="{$book_url}">
            <img
              id="book-image-{$this->id}"
              src="{$this->image_url}"
              alt="Capa do livro {$this->title}"
              class="object-cover size-full group-hover:scale-[1.1] transition-all" />
          </a>
        </figure>
        <section class="col-span-3 flex flex-col justify-start gap-2 p-2">
          <h2>
            <a href="{$book_url}" class="font-semibold hover:underline">
              {$this->title}
            </a>
          </h2>
          <p 
          id="book-author-{$this->id}"
          class="text-xs italic not-italic">
            {$this->author}
          </p>
          <div 
          id="book-rating-{$this->id}"
          role="img" aria-label="Avaliação: {$this->rating} estrelas" class="text-xl text-base/2">
            {$this->getRating()} ({$this->rating_quantity})
          </div>
          <p 
          id="book-description-{$this->id}"
          class="text-sm text-stone-400 h-fit line-clamp-3">
            {$this->description}
          </p>
        </section>
      </article>
    HTML;

    echo $html;
  }
}

function convert_query_to_books($query)
{
  return array_map(function ($book) {
    return new Book($book);
  }, $query);
}

$books = convert_query_to_books($books_query);