# Student Access Console — LavaLust Lab Activity

A small Student Information Page built with the **LavaLust PHP framework**,
covering **routing → middleware → controller → view**, per *Laboratory
Activity 3: Routing, Controllers, Views, and Middleware*.

- `GET /student` — home page
- `GET /student/profile` — profile page, protected by `StudentMiddleware`

This copy ships with **placeholder data only**. Follow the steps below to
personalize it, push it to your own GitHub repo, and deploy it on Render.

---

## 1. What's inside

```
app/
  controllers/StudentController.php   -> index() and profile() actions
  middlewares/StudentMiddleware.php   -> guards /student/profile
  views/student_home.php              -> home page (edit title/copy here)
  views/student_profile.php           -> profile page (design lives here)
  config/routes.php                   -> route -> controller/middleware map
public/index.php                      -> front controller (Apache doc root)
Dockerfile                            -> used by Render to build & run the app
```

---

## 2. Personalize your information

Everything the lab's "Individualization Requirement" asks for is centralized
in **one file**: `app/controllers/StudentController.php`.

1. Open `app/controllers/StudentController.php`.
2. In `index()`, replace the page title:
   ```php
   $data['title'] = 'CHANGE_ME — My Student Access Console';
   ```
3. In `profile()`, replace every value in the `$student` array with your own
   real information (student ID, name, course, year, section, email, and the
   optional fields — address, contact, skills, hobbies, description, social):
   ```php
   $student = [
       'student_id'  => 'YYYY-NNNNN',
       'name'        => 'Juan Dela Cruz',
       'course'      => 'BS Information Technology',
       'year'        => '1st Year',
       'section'     => 'A',
       'email'       => 'you@example.com',
       'address'     => 'City, Province, Philippines',
       'contact'     => '09XX-XXX-XXXX',
       'skills'      => 'List your own skills here',
       'hobbies'     => 'List your own hobbies here',
       'description' => 'Write a short one- or two-sentence bio about yourself.',
       'social'      => 'github.com/your-username',
   ];
   ```
   Delete any optional line you don't want — the view only renders fields
   that are present.
4. Open `app/views/student_home.php` and replace `CHANGE_ME` in the
   `<h1>` line with your own name/greeting.
5. (Optional, for a fully unique access condition) open
   `app/middlewares/StudentMiddleware.php` and rename the session key
   `clearance_granted` and/or edit the denial message text.
6. (Optional) tweak colors in the `:root { ... }` CSS block at the top of
   `student_home.php` / `student_profile.php` (`--ink`, `--paper`,
   `--yellow`, `--coral`, `--teal`) if you want a different color story
   while keeping the same layout.

---

## 3. Run it locally

Requires PHP 7.4+ (PHP 8.x recommended).

```bash
# from the project root (the folder containing "public/")
php -S localhost:8000 -t public
```

Then open:
- http://localhost:8000/student
- http://localhost:8000/student/profile

If you'd rather use Laragon/XAMPP/WAMP, point the virtual host's document
root to the `public/` folder.

---

## 4. Push to GitHub

Run these from the project root (the folder that contains this README).

```bash
# one-time setup if this folder isn't a git repo yet
git init
git add .
git commit -m "Initial commit: Student Access Console (LavaLust lab activity)"

# create the empty repo on GitHub first (github.com -> New repository),
# then connect it and push — replace the URL with YOUR repo's URL
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main
```

Whenever you edit your info later and want to update the repo:

```bash
git add .
git commit -m "Update student information"
git push
```

> Tip: if you don't have the GitHub CLI, you can also create the repo from
> the terminal with `gh repo create YOUR_REPO --public --source=. --push`
> (requires `gh auth login` once, first).

---

## 5. Deploy on Render

This project already includes a `Dockerfile` (PHP 8.5 + Apache, document
root set to `public/`), so Render can build and run it with **zero extra
config files**.

1. Go to https://dashboard.render.com and log in (GitHub login is easiest).
2. Click **New +** → **Web Service**.
3. Choose **Build and deploy from a Git repository**, then select the
   GitHub repo you pushed in Step 4.
4. Render will auto-detect the `Dockerfile`. Confirm these settings:
   - **Environment**: `Docker`
   - **Region**: closest to you
   - **Branch**: `main`
   - **Instance Type**: `Free` is fine for this activity
5. Click **Create Web Service**. Render will build the Docker image and
   deploy it — this takes a couple of minutes on the first deploy.
6. When the status shows **Live**, your app is available at the URL Render
   gives you, e.g. `https://your-service-name.onrender.com`.
7. Test both routes on the live URL:
   - `https://your-service-name.onrender.com/student`
   - `https://your-service-name.onrender.com/student/profile`
8. Use that same URL as your "Render Link" in your submission.

**Redeploying after changes:** Render auto-deploys on every push to `main`
by default, so once connected you just need:

```bash
git add .
git commit -m "Personalize student info"
git push
```

...and Render will rebuild and redeploy automatically. You can also click
**Manual Deploy → Deploy latest commit** in the Render dashboard if you
want to trigger it yourself.

---

## 6. Terminal command cheat-sheet

Everything you need, top to bottom:

```bash
# 1. Run locally to preview
php -S localhost:8000 -t public

# 2. Initialize git (first time only)
git init
git add .
git commit -m "Initial commit: Student Access Console"
git branch -M main

# 3. Connect to your GitHub repo (create the empty repo on github.com first)
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO.git
git push -u origin main

# 4. Every time you personalize/update files afterward
git add .
git commit -m "Update student information"
git push

# 5. Render deploys automatically on push once the service is connected
#    (dashboard.render.com -> New + -> Web Service -> pick your repo)
```

---

## 7. Submission checklist

- [ ] Screenshot of `/student`
- [ ] Screenshot of `/student/profile`
- [ ] Screenshot showing the middleware-protected route (e.g. denial
      message, or the code in `StudentMiddleware.php`)
- [ ] Screenshot of `app/config/routes.php`
- [ ] Screenshot of `app/controllers/StudentController.php`
- [ ] Screenshot of `app/middlewares/StudentMiddleware.php`
- [ ] Screenshot of a view file (`student_home.php` or `student_profile.php`)
- [ ] Your Render link

---

*Original LavaLust framework documentation preserved at
[`docs/FRAMEWORK.md`](docs/FRAMEWORK.md).*
