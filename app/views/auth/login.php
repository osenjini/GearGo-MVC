<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - GearGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #0b0f19;
            --bg-card: #141c2e;
            --accent-orange: #f59e0b;
            --accent-gold: #fbbf24;
            --accent-glow: rgba(245, 158, 11, 0.35);
            --text-light: #ffffff;
            --text-muted: #94a3b8;
            --text-subtle: #64748b;
            --border-card: rgba(255, 255, 255, 0.09);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-light);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; transition: all 0.25s ease; }
        .ambient-glow-top {
            position: absolute;
            top: -150px; left: 50%;
            transform: translateX(-50%);
            width: 800px; height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0) 70%);
            pointer-events: none; z-index: 0;
        }
        header.top-navbar {
            position: sticky; top: 0; z-index: 1000;
            background: rgba(11, 15, 25, 0.94);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-card);
            padding: 14px 30px;
        }
        .nav-wrapper {
            max-width: 1200px; margin: 0 auto;
            display: flex; align-items: center; justify-content: space-between;
        }
        .brand-logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 24px; font-weight: 800; color: var(--text-light);
        }
        .brand-logo .gear-icon {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: #000; font-size: 18px; box-shadow: 0 4px 14px var(--accent-glow);
        }
        .brand-logo span strong { color: var(--accent-orange); }
        .nav-links { display: flex; align-items: center; gap: 22px; }
        .nav-link {
            font-size: 14px; font-weight: 500; color: var(--text-muted);
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 20px; white-space: nowrap;
        }
        .nav-link:hover, .nav-link.active { color: var(--text-light); background: rgba(255, 255, 255, 0.06); }

        .login-container {
            position: relative; max-width: 460px; width: 100%;
            margin: 60px auto 80px auto; padding: 0 20px; z-index: 1;
        }
        .auth-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; padding: 40px; box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        }
        .auth-header { text-align: center; margin-bottom: 30px; }
        .auth-badge {
            font-size: 11.5px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.2px; color: var(--accent-orange);
            background: rgba(245, 158, 11, 0.08); border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 4px 14px; border-radius: 20px; display: inline-block; margin-bottom: 12px;
        }
        .auth-title { font-size: 28px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }
        .auth-desc { color: var(--text-muted); font-size: 14px; margin-top: 6px; }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-muted); margin-bottom: 8px;
        }
        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-icon { position: absolute; left: 14px; color: var(--text-subtle); font-size: 14px; }
        .form-control {
            width: 100%; background: #0a0e17; border: 1px solid var(--border-card);
            color: #ffffff; padding: 13px 14px 13px 40px; border-radius: 10px;
            font-family: inherit; font-size: 14px; outline: none;
        }
        .form-control:focus { border-color: var(--accent-orange); }
        .password-toggle-btn {
            position: absolute; right: 14px; background: none; border: none;
            color: var(--text-subtle); cursor: pointer; font-size: 14px;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-size: 15px; font-weight: 700; padding: 14px;
            border-radius: 30px; border: none; cursor: pointer; width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            box-shadow: 0 8px 25px var(--accent-glow); margin-top: 10px;
        }
        .btn-submit:hover { transform: translateY(-2px); }

        .alert-error {
            background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
            font-size: 13.5px; display: flex; align-items: center; gap: 10px;
        }
        .auth-footer-text { text-align: center; margin-top: 24px; font-size: 13.5px; color: var(--text-muted); }
        .auth-footer-text a { color: var(--accent-orange); font-weight: 600; }
    </style>
</head>
<body>
    <div class="ambient-glow-top"></div>

    <header class="top-navbar">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">
                <div class="gear-icon"><i class="fas fa-gear"></i></div>
                <span>Gear<strong>Go</strong></span>
            </a>
            <nav class="nav-links">
                <a href="index.php" class="nav-link"><i class="fas fa-house"></i> Home</a>
                <a href="marketplace.php" class="nav-link"><i class="fas fa-car-burst"></i> Marketplace</a>
                <a href="index.php#steps" class="nav-link"><i class="fas fa-list-check"></i> How It Works</a>
                <a href="index.php#about" class="nav-link"><i class="fas fa-circle-info"></i> About Us</a>
                <a href="index.php#find-us" class="nav-link"><i class="fas fa-map-location-dot"></i> Find Us</a>
                <a href="index.php#contact" class="nav-link"><i class="fas fa-headset"></i> Contact</a>
            </nav>
        </div>
    </header>

    <main class="login-container">
        <div class="auth-card">
            <div class="auth-header">
                <span class="auth-badge">Account Access</span>
                <h1 class="auth-title">Welcome Back</h1>
                <p class="auth-desc">Sign in to your Driver or Shop Owner account</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" id="loginPass" class="form-control" placeholder="Enter your password" required>
                        <button type="button" class="password-toggle-btn" onclick="togglePass('loginPass', this)">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-arrow-right-to-bracket"></i> Sign In to Account
                </button>
            </form>

            <div class="auth-footer-text">
                Don't have an account yet? <a href="register.php">Register here &rarr;</a>
            </div>
        </div>
    </main>

    <script>
        function togglePass(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>