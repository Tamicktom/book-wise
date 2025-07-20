create table
  users (
    id integer not null primary key autoincrement,
    name varchar(255) not null,
    email varchar(255) not null,
    password VARCHAR(255) default '' not null
  );

create table
  books (
    id integer primary key,
    title varchar(255),
    author varchar(255),
    description text,
    release_year integer,
    rating real,
    number_of_pages integer,
    image_url varchar(2047),
    rating_quantity integer default 0 not null,
    predominant_color varchar(6) default 'FFFFFF'
  );

create table
  user_books (
    id integer primary key,
    user_id integer not null references users,
    book_id integer not null references books
  );

create table
  avaliations (
    id integer primary key,
    user_id integer not null references users,
    book_id integer not null references books,
    rating real not null,
    comment text
  );