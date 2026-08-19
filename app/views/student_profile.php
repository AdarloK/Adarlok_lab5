<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Record &middot; <?= htmlspecialchars($name) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600;1,700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --brown: #6F4E37;
            --brown-light: #A0826D;
            --tan: #D4A574;
            --cream: #F5E6D3;
            --dark-brown: #3E2723;
            --gold: #D4AF37;
            --text-dark: #2d2520;
            --muted: #7a6e63;
            --white: #ffffff;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, var(--tan) 0%, var(--brown-light) 60%, var(--brown) 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            position: relative;
            overflow-x: hidden;
        }

        .sparkle {
            position: absolute;
            font-size: 1.4rem;
            opacity: 0.6;
            animation: twinkle 3.2s ease-in-out infinite;
            pointer-events: none;
        }
        .sparkle.s1 { top: 8%; left: 10%; animation-delay: 0s; }
        .sparkle.s2 { top: 14%; right: 12%; font-size: 1.1rem; animation-delay: 0.6s; }
        .sparkle.s3 { bottom: 12%; left: 8%; font-size: 1.6rem; animation-delay: 1.2s; }
        .sparkle.s4 { bottom: 18%; right: 10%; animation-delay: 1.8s; }

        @keyframes twinkle {
            0%, 100% { opacity: 0.25; transform: scale(0.85) rotate(0deg); }
            50% { opacity: 0.9; transform: scale(1.15) rotate(15deg); }
        }

        .card {
            width: 100%;
            max-width: 780px;
            background: var(--white);
            border-radius: 26px;
            box-shadow: 0 24px 60px rgba(111,78,55,0.28);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1.4fr;
        }

        @media (max-width: 680px) {
            .card { grid-template-columns: 1fr; }
        }

        /* ---------- Left: identity panel ---------- */
        .id-panel {
            background: linear-gradient(160deg, var(--tan) 0%, var(--brown) 100%);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .avatar-ring {
            width: 108px;
            height: 108px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 700;
            font-size: 2.2rem;
            color: var(--brown);
            box-shadow: 0 0 0 6px rgba(255,255,255,0.5), 0 14px 30px rgba(111,78,55,0.25);
            margin-bottom: 18px;
        }

        .id-panel h1 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.35rem;
            color: #fff;
            margin-bottom: 8px;
        }

        .verified {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            color: #fff;
            background: rgba(255,255,255,0.25);
            padding: 5px 12px;
            border-radius: 999px;
            margin-bottom: 26px;
        }

        .id-panel .field {
            width: 100%;
            text-align: left;
            font-size: 0.78rem;
            padding: 10px 0;
            border-top: 1px solid rgba(255,255,255,0.5);
        }

        .id-panel .field:last-child { border-bottom: 1px solid rgba(255,255,255,0.5); }

        .id-panel .field b {
            display: block;
            font-size: 0.62rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.75);
            margin-bottom: 2px;
        }

        /* ---------- Right: record panel ---------- */
        .record {
            padding: 38px 36px 30px;
            display: flex;
            flex-direction: column;
        }

        .kicker {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--brown);
            margin-bottom: 6px;
        }

        .record h2 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 10px;
        }

        .info-row {
            background: #f9f4ed;
            border-radius: 12px;
            padding: 12px 14px;
        }

        .info-row.wide { grid-column: 1 / -1; }

        .info-row .label {
            display: block;
            font-size: 0.64rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
        }

        .info-row .value {
            font-size: 0.88rem;
            font-weight: 600;
            word-break: break-word;
            color: var(--text-dark);
        }

        .about {
            margin-top: 8px;
            font-size: 0.85rem;
            font-style: italic;
            color: var(--muted);
            line-height: 1.6;
        }

        .footnote {
            margin-top: auto;
            padding-top: 22px;
            font-size: 0.72rem;
            color: var(--muted);
            border-top: 1px dashed rgba(147,120,159,0.4);
            line-height: 1.7;
        }

        nav {
            display: flex;
            gap: 12px;
            margin-top: 14px;
        }

        nav a {
            text-decoration: none;
            font-weight: 700;
            font-size: 0.8rem;
            padding: 10px 20px;
            border-radius: 12px;
        }

        nav a.primary-link {
            background: linear-gradient(135deg, var(--brown-light), var(--brown));
            color: #fff;
        }

        nav a.secondary-link {
            color: var(--brown);
            border: 1.5px solid var(--tan);
            background: #fff;
        }
    </style>
</head>
<body>
    <span class="sparkle s1">✨</span>
    <span class="sparkle s2">⭐</span>
    <span class="sparkle s3">✨</span>
    <span class="sparkle s4">⭐</span>

    <div class="card">
        <!-- LEFT: identity -->
        <div class="id-panel">
            <div class="avatar-ring"><?= strtoupper(substr($name, 0, 1)) ?></div>
            <h1><?= htmlspecialchars($name) ?></h1>
            <span class="verified">✨ VERIFIED</span>

            <div class="field">
                <b>Course</b>
                <?= htmlspecialchars($course) ?>
            </div>
            <?php if (!empty($address ?? null)): ?>
            <div class="field">
                <b>Address</b>
                <?= htmlspecialchars($address) ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($social ?? null)): ?>
            <div class="field">
                <b>Social / Portfolio</b>
                <?= htmlspecialchars($social) ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- RIGHT: record -->
        <div class="record">
            <div class="kicker">STUDENT RECORD</div>
            <h2><?= htmlspecialchars($course) ?></h2>

            <div class="info-grid">
                <div class="info-row">
                    <span class="label">Student ID</span>
                    <span class="value"><?= htmlspecialchars($student_id) ?></span>
                </div>
                <div class="info-row">
                    <span class="label">Year &amp; Section</span>
                    <span class="value"><?= htmlspecialchars($year) ?> &middot; <?= htmlspecialchars($section) ?></span>
                </div>
                <div class="info-row wide">
                    <span class="label">Email</span>
                    <span class="value"><?= htmlspecialchars($email) ?></span>
                </div>
                <?php if (!empty($contact ?? null)): ?>
                <div class="info-row">
                    <span class="label">Contact No.</span>
                    <span class="value"><?= htmlspecialchars($contact) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($skills ?? null)): ?>
                <div class="info-row <?= empty($contact ?? null) ? 'wide' : '' ?>">
                    <span class="label">Skills</span>
                    <span class="value"><?= htmlspecialchars($skills) ?></span>
                </div>
                <?php endif; ?>
                <?php if (!empty($hobbies ?? null)): ?>
                <div class="info-row wide">
                    <span class="label">Hobbies</span>
                    <span class="value"><?= htmlspecialchars($hobbies) ?></span>
                </div>
                <?php endif; ?>
            </div>

            <?php if (!empty($description ?? null)): ?>
                <p class="about">&ldquo;<?= htmlspecialchars($description) ?>&rdquo;</p>
            <?php endif; ?>

            <div class="footnote">
                Received via a route protected by <strong>StudentMiddleware</strong>.
                Lock the portal to test unauthorized access again.
                <nav>
                    <a class="primary-link" href="<?= site_url('student') ?>">Home</a>
                    <a class="secondary-link" href="<?= site_url('student/lock') ?>">Lock Portal</a>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
