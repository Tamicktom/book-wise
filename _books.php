<?php

class Book
{
  public string $id;
  public string $title;
  public string $author;
  public string $rating;
  public string $description;
  public string $image;

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

  public function getBookUrl(): string
  {
    return "/book?id=" . $this->id;
  }

  public function render()
  {
    $book_url = $this->getBookUrl();

    $html = <<<HTML
      <div class="grid h-48 grid-cols-5 col-span-1 transition-all border-2 rounded border-stone-800 hover:bg-stone-800 overflow-hidden group">
        <a href="{$book_url}" class="h-full col-span-2 overflow-hidden">
          <img
            src="{$this->image}"
            alt="Imagem do livro"
            class="object-cover size-full group-hover:scale-[1.1] transition-all" />
        </a>
        <div class="col-span-3 flex flex-col justify-start gap-2 p-2">
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
}

global $books;

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
  ],
  [
    'id' => 5,
    'title' => '1984',
    'author' => 'George Orwell',
    'rating' => 5,
    'description' => '1984 é um romance distópico que se passa em um futuro totalitário onde o governo exerce controle total sobre a vida dos cidadãos. A história segue Winston Smith, um homem que começa a questionar o regime e sonha com a liberdade em um mundo de vigilância constante.',
    'image' => 'https://i.pinimg.com/736x/a3/6e/36/a36e36ae6665b48cb891df8c675574ec.jpg'
  ],
  [
    'id' => 6,
    'title' => 'Cem Anos de Solidão',
    'author' => 'Gabriel García Márquez',
    'rating' => 4,
    'description' => 'Uma obra-prima do realismo mágico que narra a saga da família Buendía ao longo de sete gerações em Macondo, uma cidade fictícia. O romance entrelaça realidade e fantasia em uma narrativa épica sobre amor, guerra, e o destino inevitável.',
    'image' => 'https://i.pinimg.com/736x/3c/c0/0f/3cc00f3bac0d97fb272d38a3b398abaf.jpg'
  ],
  [
    'id' => 7,
    'title' => 'Dom Quixote',
    'author' => 'Miguel de Cervantes',
    'rating' => 5,
    'description' => 'Considerado o primeiro romance moderno, conta a história do fidalgo Alonso Quijano que, após ler muitos romances de cavalaria, decide se tornar um cavaleiro andante sob o nome de Dom Quixote, embarcando em aventuras com seu fiel escudeiro Sancho Pança.',
    'image' => 'https://i.pinimg.com/736x/07/03/de/0703de395d1d8d81853c4183a22ebc49.jpg'
  ],
  [
    'id' => 8,
    'title' => 'Crime e Castigo',
    'author' => 'Fiódor Dostoiévski',
    'rating' => 4,
    'description' => 'Um thriller psicológico que explora a mente atormentada de Raskólnikov, um ex-estudante que comete um assassinato baseado em suas teorias filosóficas. O romance examina temas de moralidade, redenção e as consequências psicológicas do crime.',
    'image' => 'https://i.pinimg.com/736x/77/80/90/77809037bf4a6319952948f89ce88fb3.jpg'
  ],
  [
    'id' => 9,
    'title' => 'O Pequeno Príncipe',
    'author' => 'Antoine de Saint-Exupéry',
    'rating' => 5,
    'description' => 'Uma fábula poética que narra as aventuras de um pequeno príncipe que deixa seu asteroide para explorar o universo. Através de seus encontros com diferentes personagens, o livro aborda temas profundos sobre amor, amizade e o sentido da vida.',
    'image' => 'https://i.pinimg.com/736x/0f/ce/07/0fce077e331341f6861ef49b92a41e2d.jpg'
  ],
  [
    'id' => 10,
    'title' => 'Orgulho e Preconceito',
    'author' => 'Jane Austen',
    'rating' => 4,
    'description' => 'Um romance que retrata a sociedade inglesa do século XIX através da história de Elizabeth Bennet e Mr. Darcy. A obra explora temas de casamento, moral e educação, mesclando crítica social com romance.',
    'image' => 'https://i.pinimg.com/736x/fa/74/22/fa7422d0a4e04ef5541cb3b38aced03c.jpg'
  ],
  [
    'id' => 11,
    'title' => 'A Metamorfose',
    'author' => 'Franz Kafka',
    'rating' => 3,
    'description' => 'A história surreal de Gregor Samsa, que acorda uma manhã transformado em um inseto gigante. O livro explora temas de alienação, família e a condição humana através desta narrativa absurda e perturbadora.',
    'image' => 'https://i.pinimg.com/736x/a9/9a/c3/a99ac37d96933a658d6ef90da2db1a72.jpg'
  ],
  [
    'id' => 12,
    'title' => 'A Revolução dos Bichos',
    'author' => 'George Orwell',
    'rating' => 4,
    'description' => 'Uma fábula satírica que retrata uma revolução de animais de fazenda contra seus donos humanos. A história serve como uma alegoria da Revolução Russa e do surgimento do estado soviético.',
    'image' => 'https://i.pinimg.com/736x/89/77/3c/89773c650b463e970a4d58bf88cad41f.jpg'
  ],
  [
    'id' => 13,
    'title' => 'O Processo',
    'author' => 'Franz Kafka',
    'rating' => 4,
    'description' => 'O romance segue Josef K., que acorda em uma manhã e é preso e sujeito a um longo e incompreensível processo por um crime não especificado. A obra explora temas de burocracia, justiça e a natureza opressiva das instituições modernas.',
    'image' => 'https://i.pinimg.com/736x/41/4c/81/414c8158e95402a1643495acd179e76d.jpg'
  ],
  [
    'id' => 14,
    'title' => 'O Retrato de Dorian Gray',
    'author' => 'Oscar Wilde',
    'rating' => 5,
    'description' => 'Um romance filosófico sobre um belo jovem que faz um pacto faustiano para que seu retrato envelheça em seu lugar. A obra explora temas de moralidade, hedonismo e a natureza da arte e da beleza.',
    'image' => 'https://i.pinimg.com/736x/53/01/58/530158bc3728c75551177bf0c8eb33cf.jpg'
  ]
]);
