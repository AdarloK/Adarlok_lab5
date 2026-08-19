<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Student Portal') ?></title>
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
            padding: 32px 20px;
            position: relative;
            overflow-x: hidden;
        }

        .sparkle {
            position: absolute;
            font-size: 1.4rem;
            opacity: 0.65;
            animation: twinkle 3.2s ease-in-out infinite;
            pointer-events: none;
        }
        .sparkle.s1 { top: 6%; left: 8%; animation-delay: 0s; }
        .sparkle.s2 { top: 14%; right: 12%; font-size: 1.1rem; animation-delay: 0.6s; }
        .sparkle.s3 { bottom: 10%; left: 14%; font-size: 1.6rem; animation-delay: 1.2s; }
        .sparkle.s4 { bottom: 22%; right: 8%; animation-delay: 1.8s; }
        .sparkle.s5 { top: 46%; left: 3%; font-size: 1rem; animation-delay: 2.4s; }

        @keyframes twinkle {
            0%, 100% { opacity: 0.25; transform: scale(0.85) rotate(0deg); }
            50% { opacity: 0.9; transform: scale(1.15) rotate(15deg); }
        }

        .layout {
            max-width: 1040px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 28px;
            align-items: stretch;
        }

        @media (max-width: 860px) {
            .layout { grid-template-columns: 1fr; }
        }

        /* ---------- Left: hero panel ---------- */
        .hero {
            background: rgba(255,255,255,0.55);
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 26px;
            padding: 44px 40px;
            backdrop-filter: blur(6px);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
        }

        .brand .glyph {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--brown-light), var(--brown));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #fff;
            box-shadow: 0 6px 16px rgba(111,78,55,0.5);
        }

        .brand .label b {
            display: block;
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .brand .label small {
            display: block;
            font-size: 0.68rem;
            letter-spacing: 0.14em;
            color: var(--muted);
            font-weight: 600;
        }

        .eyebrow {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--brown);
            background: rgba(255,255,255,0.7);
            border: 1px solid var(--brown);
            padding: 5px 12px;
            border-radius: 999px;
            margin-bottom: 18px;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-weight: 600;
            font-size: 2rem;
            line-height: 1.3;
            margin-bottom: 16px;
            color: var(--text-dark);
        }

        .hero p.lead {
            color: var(--muted);
            font-size: 0.95rem;
            line-height: 1.7;
            max-width: 420px;
        }

        .route-trace {
            margin-top: 36px;
            font-size: 0.72rem;
            color: var(--muted);
            border-top: 1px dashed rgba(147,120,159,0.4);
            padding-top: 16px;
            line-height: 1.7;
        }

        .route-trace code {
            background: rgba(255,255,255,0.6);
            padding: 1px 6px;
            border-radius: 6px;
            font-weight: 600;
            color: var(--text-dark);
        }

        /* ---------- Right: access terminal ---------- */
        .terminal {
            background: var(--white);
            border-radius: 26px;
            box-shadow: 0 24px 60px rgba(150,110,180,0.28);
            padding: 34px 34px 30px;
            display: flex;
            flex-direction: column;
        }

        .tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
        }

        .tabs a {
            flex: 1;
            text-align: center;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.05em;
            padding: 10px 0;
            border-radius: 12px;
            color: var(--muted);
        }

        .tabs a.active {
            background: linear-gradient(135deg, var(--brown-light), var(--brown));
            color: #fff;
        }

        .tabs a.inactive {
            background: #faf3fb;
        }

        .terminal .kicker {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: var(--brown);
            margin-bottom: 6px;
        }

        .terminal h2 {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 1.35rem;
            margin-bottom: 10px;
        }

        .terminal .desc {
            font-size: 0.85rem;
            color: var(--muted);
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .terminal .desc code {
            background: #faf3fb;
            padding: 1px 6px;
            border-radius: 6px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .flash {
            font-size: 0.82rem;
            font-weight: 600;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }

        .flash.ok {
            background: #eafaf0;
            color: #1f8a4c;
            border: 1px solid #bfe9cf;
        }

        .flash.err {
            background: #fce8e8;
            color: #8B4513;
            border: 1px solid #deb0b0;
        }

        .flash.locked {
            background: #f4ede4;
            color: var(--brown);
            border: 1px solid var(--tan);
        }

        form label {
            display: block;
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .pin-row {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        input[name="pin"] {
            flex: 1;
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: 0.6em;
            text-align: center;
            padding: 14px 10px 14px 22px;
            border-radius: 14px;
            border: 2px solid var(--tan);
            background: #fdf9ff;
            color: var(--text-dark);
            outline: none;
        }

        input[name="pin"]:focus {
            border-color: var(--brown);
        }

        button[type="submit"] {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            font-size: 0.85rem;
            color: #fff;
            background: linear-gradient(135deg, var(--brown-light), var(--brown));
            border: none;
            padding: 14px 20px;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(111,78,55,0.45);
            transition: transform 0.15s ease;
        }

        button[type="submit"]:hover { transform: translateY(-2px); }

        .hint {
            margin-top: 16px;
            font-size: 0.72rem;
            color: var(--muted);
            line-height: 1.6;
        }

        .profile-link {
            display: inline-block;
            margin-top: 18px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.82rem;
            color: var(--brown);
        }
    </style>
</head>
<body>
    <span class="sparkle s1">✨</span>
    <span class="sparkle s2">⭐</span>
    <span class="sparkle s3">✨</span>
    <span class="sparkle s4">⭐</span>
    <span class="sparkle s5">✨</span>

    <div class="layout">
        <!-- LEFT: hero -->
        <div class="hero">
            <div>
                <div class="brand">
                    <div class="glyph">✨</div>
                    <div class="label">
                        <b>Kashiofeya Portal</b>
                        <small>STUDENT ACCESS SYSTEM</small>
                    </div>
                </div>

                <span class="eyebrow">MIDDLEWARE ZONE</span>
                <h1>Route-level access is enforced before the profile view ever renders.</h1>
                <p class="lead">
                    This is a simple Student Information Page built with LavaLust's
                    routing, controllers, views, and middleware. Submit the access
                    PIN on the right to unlock <code>/student/profile</code>.
                </p>
            </div>

            <div class="route-trace">
                <code>GET /student</code> &middot; <code>POST /student/verify</code> &middot; <code>GET /student/profile</code><br>
                Guarded by <strong>StudentMiddleware</strong> — unauthorized requests are redirected here.
            </div>
        </div>

        <!-- RIGHT: access terminal -->
        <div class="terminal">
            <div class="tabs">
                <a class="active" href="<?= site_url('student') ?>">ACCESS</a>
                <a class="inactive" href="<?= site_url('student/profile') ?>">PROFILE</a>
            </div>

            <div class="kicker">ACCESS TERMINAL</div>
            <h2>Kashiofeya Student Portal</h2>
            <p class="desc">
                This route is guarded by <code>StudentMiddleware</code>.
                Submit the access PIN to unlock <code>/student/profile</code>.
            </p>

            <?php if (!empty($message)):
                $tone = 'locked';
                if (stripos($message, 'granted') !== false) $tone = 'ok';
                elseif (stripos($message, 'incorrect') !== false) $tone = 'err';
            ?>
                <div class="flash <?= $tone ?>"><?= htmlspecialchars($message) ?></div>
            <?php elseif (!$unlocked): ?>
                <div class="flash locked">Locked — /student/profile is currently blocked.</div>
            <?php endif; ?>

            <form action="<?= site_url('student/verify') ?>" method="post">
                <label for="pin">ACCESS PIN</label>
                <div class="pin-row">
                    <input type="text" id="pin" name="pin" inputmode="numeric" maxlength="4"
                           autocomplete="off" placeholder="&bull;&bull;&bull;&bull;" required>
                    <button type="submit">UNLOCK</button>
                </div>
            </form>

            <p class="hint">
                Enter the correct PIN to unlock the profile view. An incorrect PIN
                keeps <code>StudentMiddleware</code> in control and redirects the
                request straight back to this screen — this is this student's own
                access condition for the lab activity.
            </p>

            <?php if ($unlocked): ?>
                <a class="profile-link" href="<?= site_url('student/profile') ?>">Go to Student Profile &rarr;</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
