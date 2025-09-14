## BookWise 📚✨

Because judging books by their covers is fine as long as you also rate them with stars 😅⭐️

### What is this? 🤔
BookWise is a tiny MVC-ish PHP app where you can:
- 🔍📖 Search and explore books
- ⭐️📝 View details, average ratings, and user reviews
- 🔐 Register/login (passwords are properly hashed, we’re not monsters)
- 💬⭐️ Rate and comment on books
- 🗂️➕🖼️ Manage your shelf in "My Books" and add new ones with an image upload

It’s lightweight, dependency-free, and powered by coffee, sessions, and a surprisingly loyal `SQLite` file ☕💾

### Tech stack (a.k.a. the ingredients list) 🧪🍳
- 🐘 **PHP**: 8.1+ (uses enums and modern features)
- 💾 **SQLite**: single-file database simplicity
- 🌬️ **Tailwind CSS**: via CDN, because npm is heavy
- 🎟️ **Sessions**: for auth
- 🌍 **i18n**: auto-detects `en` or `pt` for validation messages

### Feature tour 🧭
- 🧭 **/ (Explore)**: Search and scroll happy little book cards
- 📖 **/book?id=ID**: Details page with rating stars and reviews
- 🔑 **/login** and 🪪 **/register**: Become a book critic in 10 seconds
- 📚 **/my-books**: Your shelf + a form to add new books
- ✍️ **/avaliation**: POST endpoint for adding ratings/comments

### Quick start 🚀
1) Requirements ✅
- PHP 8.1+ and `sqlite3`

2) Clone and go 🧰
```bash
git clone https://github.com/Tamicktom/book-wise.git
cd book-wise
```

3) Database 🌱
- Use the included `db.sqlite` or create a fresh one:
```bash
sqlite3 db.sqlite < start_db.sql
```

4) Run the server (port matters!) 🧠
The create-book flow assumes `http://localhost:8888` when generating image URLs, so use port 8888:
```bash
php -S localhost:8888 index.php
```
Then visit: `http://localhost:8888` 🎯

### Configuration ⚙️
- `config.php` points to the SQLite file:
```php
return [
  'database' => [
    'driver' => 'sqlite',
    'database' => 'db.sqlite',
  ]
];
```

### Where things live 🗺️
- 🕹️ `controllers/` route handlers (`index`, `book`, `login`, `register`, `my-books`, `avaliation`, `create-book`)
- 🧠 `models/` database access (`BookModel`, `UserModel`, `UserBooksModel`, `Avaliation`)
- 🎨 `views/` server-rendered templates (Tailwind via CDN)
- 🧩 `components/` tiny UI helpers (`Input`, `Label`, `Button`, `Select`, `Textarea`)
- ⭐️ `_book.php` presentational `Book` class with charming star logic
- 🌍 `Internationalization.php` auto-detects `en`/`pt`; JSON dictionaries in `lang/`
- 🗺️ `routes.php` keeps the URL map tidy

### Notes 📝
- 🖼️ Image uploads are saved to `public/images/books` and the app assigns a random filename; the visible URL is built using `http://localhost:8888/public/images/books/...`.
- 🔒 Passwords are stored using `password_hash`/`password_verify`.
- ✅ Validation is homegrown with a small schema DSL and localized messages.
- 🇧🇷/🇺🇸 The UI text is mostly in Portuguese; validation messages switch to English if your browser says so.

### Roadmap-ish ideas 🧭✨
- 🌱 Add seeding script with sample books (so you can immediately judge them)
- 🔗 Attach books to users on creation (so "My Books" gets populated automatically)
- 🎨 Image predominant color detection instead of plain default

### FAQ 🙋
- "Is this production-ready?" — Only if your production is a book club ☕📚
- "Does it use a framework?" — Friendship and Tailwind 🤝🌬️

### License 📄
No license file provided. Use responsibly and credit the author if you publish or adapt.

Project created only for study purposes 🥺