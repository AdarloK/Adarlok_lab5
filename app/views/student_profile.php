<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile &middot; <?= htmlspecialchars($name) ?></title>
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
            background-image: radial-gradient(var(--ink) 1px, transparent 1px);
            background-size: 26px 26px;
            background-position: -6px -6px;
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .card {
            max-width: 620px;
            width: 100%;
            background: #fff;
            border: 3px solid var(--ink);
            border-radius: 4px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .card-header {
            background: var(--teal);
            border-bottom: 3px solid var(--ink);
            padding: 34px 36px 26px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .avatar {
            flex-shrink: 0;
            width: 64px;
            height: 64px;
            border-radius: 3px;
            background: var(--yellow);
            border: 3px solid var(--ink);
            box-shadow: 3px 3px 0 var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .card-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.5rem;
            line-height: 1.25;
        }

        .card-header .role {
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 4px;
        }

        .card-body {
            padding: 28px 36px 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 18px;
            padding: 12px 14px;
            border: 2px solid var(--ink);
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .info-row:nth-child(3n+1) { background: var(--yellow); }
        .info-row:nth-child(3n+2) { background: #fff; }
        .info-row:nth-child(3n)   { background: #FFE7DD; }

        .info-row .label {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .info-row .value {
            font-size: 0.9rem;
            font-weight: 500;
            text-align: right;
        }

        .about {
            padding: 8px 14px 22px;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .card-footer {
            padding: 22px 36px 32px;
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
            border-top: 3px solid var(--ink);
        }

        nav a {
            text-decoration: none;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            color: var(--ink);
            font-size: 0.92rem;
            padding: 11px 24px;
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
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <div class="avatar"><?= strtoupper(substr($name, 0, 1)) ?></div>
            <div>
                <h1><?= htmlspecialchars($name) ?></h1>
                <div class="role"><?= htmlspecialchars($course) ?> &middot; <?= htmlspecialchars($year) ?> &middot; Section <?= htmlspecialchars($section) ?></div>
            </div>
        </div>

        <div class="card-body">
            <div class="info-row">
                <span class="label">Student ID</span>
                <span class="value"><?= htmlspecialchars($student_id) ?></span>
            </div>
            <div class="info-row">
                <span class="label">Email</span>
                <span class="value"><?= htmlspecialchars($email) ?></span>
            </div>
            <?php if (!empty($address)): ?>
            <div class="info-row">
                <span class="label">Address</span>
                <span class="value"><?= htmlspecialchars($address) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($contact)): ?>
            <div class="info-row">
                <span class="label">Contact Number</span>
                <span class="value"><?= htmlspecialchars($contact) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($skills)): ?>
            <div class="info-row">
                <span class="label">Skills</span>
                <span class="value"><?= htmlspecialchars($skills) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($hobbies)): ?>
            <div class="info-row">
                <span class="label">Hobbies</span>
                <span class="value"><?= htmlspecialchars($hobbies) ?></span>
            </div>
            <?php endif; ?>
            <?php if (!empty($social)): ?>
            <div class="info-row">
                <span class="label">Social / Portfolio</span>
                <span class="value"><?= htmlspecialchars($social) ?></span>
            </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($description)): ?>
        <p class="about"><?= htmlspecialchars($description) ?></p>
        <?php endif; ?>

        <div class="card-footer">
            <nav style="display:flex; gap:14px;">
                <a class="primary-link" href="<?= site_url('student') ?>">Home</a>
                <a class="secondary-link" href="<?= site_url('student/profile') ?>">Student Profile</a>
            </nav>
        </div>
    </div>
</body>
</html>
