<?php

class Book
{
  public $id;
  public $title;
  public $author;
  public $rating;
  public $description;
  public $image;

  public function __construct($id, $title, $author, $rating, $description, $image)
  {
    $this->id = $id;
    $this->title = $title;
    $this->author = $author;
    $this->rating = $rating;
    $this->description = $description;
    $this->image = $image;
  }

  public function getRating()
  {
    $rating = '';
    for ($i = 0; $i < $this->rating; $i++) {
      $rating .= '⭐';
    }
    return $rating;
  }

  public function getBookUrl()
  {
    return "/book.php?id=" . $this->id;
  }

  public function render()
  {
    $book_url = $this->getBookUrl();

    $html = <<<HTML
      <div class="grid h-48 grid-cols-5 col-span-1 gap-2 p-2 transition-all border-2 rounded border-stone-800 hover:bg-stone-800">
        <a href="{$book_url}" class="h-full col-span-2 overflow-hidden rounded">
          <img
            src="{$this->image}"
            alt="Imagem do livro"
            class="object-cover size-full" />
        </a>
        <div class="col-span-3 flex flex-col justify-start gap-2">
          <a href="{$book_url}" class="font-semibold hover:underline">
            {$this->title}
          </a>
          <div class="text-xs italic">
            {$this->author}
          </div>
          <div class="text-xs italic">
            {$this->getRating()}
          </div>
          <div class="text-sm text-stone-400 h-fit line-clamp-3">
            {$this->description}
          </div>
        </div>
      </div>
    HTML;

    echo $html;
  }
};

$books = array_map(function ($book) {
  return new Book(
    $book['id'],
    $book['title'],
    $book['author'],
    $book['rating'],
    $book['description'],
    $book['image']
  );
}, [
  [
    'id' => 1,
    'title' => 'The Great Gatsby',
    'author' => 'F. Scott Fitzgerald',
    'rating' => 4,
    'description' => 'The Great Gatsby is a novel by American writer F. Scott Fitzgerald. Set in the Jazz Age on Long Island, near New York City, the novel depicts first-person narrator Nick Carraway\'s interactions with mysterious millionaire Jay Gatsby and Gatsby\'s obsession to reunite with his former lover, Daisy Buchanan.',
    'image' => 'https://i.pinimg.com/736x/92/9b/6b/929b6bceaea9375dc515c099aad59892.jpg'
  ],
  [
    'id' => 2,
    'title' => 'The Catcher in the Rye',
    'author' => 'J. D. Salinger',
    'rating' => 3,
    'description' => 'The Catcher in the Rye is a novel by J. D. Salinger, partially published in serial form in 1945–1946 and as a novel in 1951.',
    'image' => 'https://i.pinimg.com/736x/47/f4/09/47f40920c240110dbb088543612bc6e0.jpg'
  ],
  [
    'id' => 3,
    'title' => 'The Lord of the Rings',
    'author' => 'J. R. R. Tolkien',
    'rating' => 2,
    'description' => 'The Lord of the Rings is an epic high-fantasy novel by the English author and scholar J. R. R. Tolkien. Set in Middle-earth, the world at some distant time in the past, the story began as a sequel to Tolkien\'s 1937 children\'s book The Hobbit, but eventually developed into a much larger work.',
    'image' => 'https://i.pinimg.com/736x/ed/dd/df/eddddfb389102ae4dc115c60daf6cc1f.jpg'
  ],
  [
    'id' => 4,
    'title' => 'Harry Potter and the Philosopher\'s Stone',
    'author' => 'J. K. Rowling',
    'rating' => 1,
    'description' => 'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling. The first novel in the Harry Potter series and Rowling\'s debut novel, it follows Harry Potter, a young wizard who discovers his magical heritage on his eleventh birthday, when he receives a letter of acceptance to Hogwarts School of Witchcraft and Wizardry.',
    'image' => 'https://i.pinimg.com/736x/a4/16/0d/a4160de9649cff905b7b2c8b4adbc88d.jpg'
  ]
]);
