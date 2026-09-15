<<<<<<< HEAD
# Sabina Student Portal — LavaLust Lab Activity

A Student Information Page built with the **LavaLust PHP framework**,
covering **routing → middleware → controller → view**, per *Laboratory
Activity 3: Routing, Controllers, Views, and Middleware*.

Design: a pastel pink/lavender "sparkling" access-terminal theme —
a two-panel home page (hero + PIN terminal) and a Student Record card.

- `GET  /student` — access terminal (enter a PIN to unlock the profile)
- `POST /student/verify` — checks the submitted PIN
- `GET  /student/lock` — revokes access, so you can re-test the denial flow
- `GET  /student/profile` — protected by `StudentMiddleware`

---

## 1. What's inside

```
app/
  controllers/StudentController.php   -> index(), verify(), lock(), profile()
  middlewares/StudentMiddleware.php   -> guards /student/profile
  views/student_home.php              -> access terminal (PIN form)
  views/student_profile.php           -> Student Record card
  config/routes.php                   -> route -> controller/middleware map
public/index.php                      -> front controller (Apache doc root)
Dockerfile                            -> used by Render to build & run the app
```

---

## 2. How the access flow works

```
GET /student
    |
    v
Access Terminal (PIN form) --submits--> POST /student/verify
    |                                          |
    | correct PIN                              | wrong PIN
    v                                          v
session['portal_unlocked'] = true    session['portal_unlocked'] = false
    |                                          |
    v                                          v
GET /student/profile                  redirected back to /student
    |                                  with an "Incorrect PIN" message
    v
StudentMiddleware checks the flag -> allowed -> profile view
```

The default PIN is **`0050`**. To change it, open
`app/controllers/StudentController.php` and edit:

```php
private $portal_pin = '0050';
```

Visit `GET /student/lock` any time to revoke access again and re-test the
"unauthorized access redirected by StudentMiddleware" behavior.

---

## 3. Personalize your information

Open `app/controllers/StudentController.php` → `profile()` and edit the
`$student` array with your own real information:

```php
$student = [
    'student_id'  => 'MCC2024-00050',
    'name'        => 'Sabina Rheazel B. Elumba',
    'course'      => 'BS Information Technology',
    'year'        => '3rd Year',
    'section'     => '3F1',
    'email'       => 'sabinarheazelelumba@gmail.com',

    // optional — uncomment any of these to show them on the profile card
    // 'address'     => 'City, Province, Philippines',
    // 'contact'     => '09XX-XXX-XXXX',
    // 'skills'      => 'List your own skills here',
    // 'hobbies'     => 'List your own hobbies here',
    // 'description' => 'A short one- or two-sentence bio about yourself.',
    // 'social'      => 'github.com/your-username',
];
```

The profile view only renders optional fields that are present — no need to
touch the HTML for those.

To restyle colors, edit the `:root { ... }` block at the top of
`student_home.php` / `student_profile.php` (`--pink`, `--lavender`,
`--gold`, `--ink`).

---

## 4. Run it locally

Requires PHP 7.4+ (PHP 8.x recommended).

```bash
# from the project root (the folder containing "public/")
php -S localhost:8000 -t public
```

Then open:
- http://localhost:8000/student
- http://localhost:8000/student/profile *(redirects back until you unlock it)*

If you'd rather use Laragon/XAMPP/WAMP, point the virtual host's document
root to the `public/` folder.

---

## 5. Push to GitHub (first time)

```bash
cd path/to/LavaLust
git init
git add .
git commit -m "Initial commit: Sabina Student Portal"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
=======
# LavaLust Framework

> A lightweight, fast PHP framework built for developers who want clean MVC architecture without unnecessary complexity or performance overhead.

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/PHP-%3E%3D7.4-8892BF)](https://www.php.net/)
[![GitHub Stars](https://img.shields.io/github/stars/ronmarasigan/lavalust?style=flat)](https://github.com/ronmarasigan/lavalust/stargazers)

---

## Overview

**LavaLust** is an open-source PHP framework that follows the **MVC (Model–View–Controller)** architectural pattern. It is designed for developers who need a structured, maintainable, and scalable foundation — without the bloat of heavier modern frameworks.

Whether you are building a simple web application, a REST API, or a teaching project, LavaLust provides the right tools with minimal friction.

---

## Features

| Feature | Description |
|---|---|
| **MVC Architecture** | Clean separation of Models, Views, and Controllers for organized, maintainable code |
| **Built-in Routing** | Flexible URL routing that maps requests to controllers with minimal configuration |
| **Libraries & Helpers** | Reusable components for sessions, forms, validation, and database access |
| **Modular Design** | Scalable structure that supports clean organization as your application grows |
| **REST API Support** | First-class support for building RESTful APIs using LavaLust conventions |
| **ORM-like Models** | Simplified, readable database interaction without a heavy abstraction layer |

---

## Requirements

- PHP 7.4 or higher
- A web server with URL rewriting support (Apache `.htaccess` or Nginx config)
- Composer (optional, for dependency management)

---

## Installation

**Clone the repository:**

```bash
git clone https://github.com/ronmarasigan/lavalust.git
cd lavalust
```

**Or download a release directly:**

```bash
wget https://github.com/ronmarasigan/lavalust/archive/refs/heads/main.zip
unzip main.zip
```

Configure your web server to point to the project root and ensure `mod_rewrite` (Apache) or equivalent is enabled.

---

## Quick Start

### 1. Define a Route

**File:** `app/config/routes.php`

```php
$router->get('/', 'Welcome::index');
$router->get('/about', 'Welcome::about');
$router->post('/users/store', 'Users::store');
```

### 2. Create a Controller

**File:** `app/controllers/Welcome.php`

```php
<?php

class Welcome extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $this->call->view('welcome', $data);
    }

    public function about()
    {
        $this->call->view('about');
    }
}
```

### 3. Create a View

**File:** `app/views/welcome.php`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <h1>Welcome to LavaLust Framework</h1>
    <p>Lightweight. Fast. MVC.</p>
</body>
</html>
```

### 4. Create a Model

**File:** `app/models/User_model.php`

```php
<?php

class User_model extends Model
{
    protected $table = 'users';

    public function getAll()
    {
        return $this->db->table($this->table)->get()->getResult();
    }

    public function findById(int $id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get()
    }
}
>>>>>>> 04312585559daad918654f8850ba8079f14ab852
```

---

<<<<<<< HEAD
## 6. Deploy on Render

1. Go to https://dashboard.render.com and log in.
2. **New +** → **Web Service** → **Build and deploy from a Git repository**
   → select your repo.
3. Render auto-detects the included `Dockerfile`. Confirm:
   - **Environment**: `Docker`
   - **Branch**: `main`
   - **Instance Type**: `Free` is fine
4. **Create Web Service** and wait for the status to show **Live**.
5. Test both routes on the live URL, e.g.:
   - `https://your-service-name.onrender.com/student`
   - `https://your-service-name.onrender.com/student/profile`

---

## 7. Terminal commands to update Render after a change

Render is connected to your GitHub repo and **auto-deploys on every push**
to `main`. So any time you personalize a file (info, PIN, colors, etc.),
run this from the project folder:

```bash
git add .
git commit -m "Update student info / design"
git push
```

That's it — Render detects the new commit and redeploys automatically
(watch it happen live under your service → **Events** tab in the Render
dashboard). If you ever want to trigger a rebuild without a new commit,
use the dashboard button instead:

**Render dashboard → your service → Manual Deploy → Deploy latest commit**

If `git push` is rejected with `(fetch first)`, it means the remote has
commits you don't have locally yet — run:

```bash
git pull origin main --allow-unrelated-histories
git push
=======
## Project Structure

```
lavalust/
├── app/
│   ├── config/          # Application configuration (database, routes, etc.)
│   ├── controllers/     # Controller classes
│   ├── models/          # Model classes
│   ├── views/           # View templates
│   └── libraries/       # Custom libraries and helpers
├── scheme/              # Core framework files (do not modify)
├── public/              # Publicly accessible entry point
│   └── index.php
└── runtime/            # Cache, logs, and uploads (must be writable)
>>>>>>> 04312585559daad918654f8850ba8079f14ab852
```

---

<<<<<<< HEAD
## 8. Submission checklist

- [ ] Screenshot of `/student`
- [ ] Screenshot of `/student/profile`
- [ ] Screenshot showing the middleware-protected route (e.g. the
      "Locked" message, or `StudentMiddleware.php`)
- [ ] Screenshot of `app/config/routes.php`
- [ ] Screenshot of `app/controllers/StudentController.php`
- [ ] Screenshot of `app/middlewares/StudentMiddleware.php`
- [ ] Screenshot of a view file (`student_home.php` or `student_profile.php`)
- [ ] Your Render link

---

*Original LavaLust framework documentation preserved at
[`docs/FRAMEWORK.md`](docs/FRAMEWORK.md).*
=======
## Configuration

### Database

**File:** `app/config/database.php`

```php
$database['main'] = array(
    'driver'	=> '',
    'hostname'	=> getenv('DB_HOST') ?: '',
    'port'		=> getenv('DB_PORT') ?: '',
    'username'	=> getenv('DB_USERNAME') ?: '',
    'password'	=> getenv('DB_PASSWORD') ?: '',
    'database'	=> getenv('DB_NAME') ?: '',
    'charset'	=> '',
    'dbprefix'	=> '',
    // Optional for SQLite
    'path'      => ''
);
```

### Base URL

**File:** `app/config/config.php`

```php
$config['base_url'] = 'http://localhost:3000/';
```

---

## Building a REST API

LavaLust supports REST API development out of the box. Controllers can return JSON responses for API endpoints.

```php
<?php

class Api extends Controller
{
    $this->call->library('api');

    public function users()
    {
        $this->api->require_method('GET');
        $auth = $this->api->require_jwt(); 

        $this->call->model('User_model');
        $users = $this->User_model->getAll();

        $this->api->respond(['data' => $users]);
    }
}
```

Route definition:

```php
$router->get('/api/users', 'Api::users');
```

---

## Philosophy

LavaLust is built on a single principle: **minimal core, maximum control.**

Modern frameworks often add layers of abstraction that benefit large enterprise teams but get in the way of developers who want to understand exactly what their code is doing. LavaLust provides structure and utilities without hiding the underlying logic — making it an excellent choice for:

- **Rapid prototyping** — Get an application running in minutes
- **Learning MVC** — Understand how each architectural layer works
- **Lightweight production apps** — Deploy without dragging in unused dependencies
- **Teaching PHP development** — Clear conventions, readable source code

---

## Documentation

Full documentation is available at **[https://lavalust.netlify.app](https://lavalust.netlify.app)**

Topics covered include:

- Installation and server configuration
- Routing: static, dynamic, and grouped routes
- Controllers and request handling
- Models and query builder
- Views, layouts, and partials
- Built-in libraries (sessions, form validation, file upload)
- Helper functions
- REST API development
- Security best practices

---

## Contributing

Contributions are welcome. To contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m "Add your feature description"`
4. Push to your branch: `git push origin feature/your-feature-name`
5. Open a pull request against `main`

Please ensure your code follows the existing style conventions and includes relevant documentation or comments where appropriate.

---

## Roadmap

- [ ] CLI tool for generating controllers, models, and migrations
- [ ] Middleware support
- [ ] Improved query builder with relationship support
- [ ] Enhanced error handling and debugging tools

---

## License

LavaLust Framework is open-source software licensed under the **[MIT License](https://opensource.org/licenses/MIT)**.

---

## Links

- **GitHub Repository:** [https://github.com/ronmarasigan/lavalust](https://github.com/ronmarasigan/lavalust)
- **Documentation:** [https://lavalust.netlify.app](https://lavalust.netlify.app)
- **Report an Issue:** [https://github.com/ronmarasigan/lavalust/issues](https://github.com/ronmarasigan/lavalust/issues)
>>>>>>> 04312585559daad918654f8850ba8079f14ab852
