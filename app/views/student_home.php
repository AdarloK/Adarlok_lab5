<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Student Home') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Archivo:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --ink: #111111;
            --paper: #FFF7E8;
            --yellow: #FFD23F;
            --coral: #FF6B4A;
            --teal: #2EC4B6;
            --shadow: 6px 6px 0 var(--ink);
        }

        body {
            font-family: 'Archivo', sans-serif;
            background: var(--paper);
            background-image:
                radial-gradient(var(--ink) 1px, transparent 1px);
            background-size: 26px 26px;
            background-position: -6px -6px;
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .panel {
            max-width: 640px;
            width: 100%;
            background: #fff;
            border: 3px solid var(--ink);
            border-radius: 4px;
            padding: 44px 40px;
            box-shadow: var(--shadow);
        }

        .stamp {
            display: inline-block;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 0.72rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: var(--yellow);
            border: 2px solid var(--ink);
            padding: 6px 14px;
            border-radius: 3px;
            box-shadow: 3px 3px 0 var(--ink);
            margin-bottom: 22px;
            transform: rotate(-2deg);
        }

        h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        h1 span {
            background: var(--teal);
            padding: 0 6px;
            box-decoration-break: clone;
            -webkit-box-decoration-break: clone;
        }

        p.lead {
            font-size: 1rem;
            line-height: 1.65;
            max-width: 480px;
            margin: 0 0 30px;
        }

        .msg {
            font-size: 0.85rem;
            font-weight: 600;
            padding: 12px 16px;
            border: 2px solid var(--ink);
            border-radius: 3px;
            background: var(--yellow);
            margin-bottom: 26px;
        }

        nav {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: var(--ink);
            font-size: 0.95rem;
            padding: 12px 26px;
            border: 3px solid var(--ink);
            border-radius: 3px;
            box-shadow: 4px 4px 0 var(--ink);
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }

        nav a.primary-link { background: var(--coral); color: #fff; }
        nav a.secondary-link { background: #fff; }

        nav a:hover {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0 var(--ink);
        }

        footer {
            margin-top: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
    </style>
</head>
<body>
    <div class="panel">
        <span class="stamp">LavaLust &middot; Access Console</span>
        <h1>Hi, I'm <span>CHANGE_ME</span> &mdash; welcome to my student page.</h1>
        <p class="lead">
            This is a simple Student Information Page built with LavaLust's
            routing, controllers, views, and middleware. Badge clearance is
            granted automatically for this activity — tap the button below
            to view my protected profile.
        </p>

        <?php if (!empty($_SESSION['access_message'])): ?>
            <div class="msg">
                <?= htmlspecialchars($_SESSION['access_message']) ?>
            </div>
            <?php unset($_SESSION['access_message']); ?>
        <?php endif; ?>

        <nav>
            <a class="primary-link" href="<?= site_url('student') ?>">Home</a>
            <a class="secondary-link" href="<?= site_url('student/profile') ?>">Student Profile</a>
        </nav>

        <footer>Built with LavaLust PHP Framework &middot; Laboratory Activity 3</footer>
    </div>
</body>
</html>
