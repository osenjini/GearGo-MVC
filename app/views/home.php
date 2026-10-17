<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GearGo | Sri Lanka's Premier Vehicle Spare Parts Hub</title>
    <!-- Google Fonts & FontAwesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- COMPLETE SELF-CONTAINED CREATIVE AUTOMOTIVE STYLING -->
    <style>
        :root {
            --bg-body: #0b0f19;
            --bg-card: #141c2e;
            --bg-card-hover: #1c273e;
            --bg-card-inner: #1f2c45;
            --accent-orange: #f59e0b;
            --accent-gold: #fbbf24;
            --accent-hover: #d97706;
            --accent-glow: rgba(245, 158, 11, 0.35);
            --text-light: #ffffff;
            --text-muted: #94a3b8;
            --text-subtle: #64748b;
            --border-card: rgba(255, 255, 255, 0.09);
            --border-subtle: rgba(255, 255, 255, 0.05);
            --success: #10b981;
            --danger: #ef4444;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'Plus Jakarta Sans', 'Poppins', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-light);
            line-height: 1.6;
            overflow-x: hidden;
        }
        a { text-decoration: none; color: inherit; transition: all 0.25s ease; }

        .ambient-glow-top {
            position: absolute;
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(245, 158, 11, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        header.top-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(11, 15, 25, 0.94);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border-card);
            padding: 14px 30px;
        }
        .nav-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 800;
            color: var(--text-light);
            letter-spacing: -0.5px;
        }
        .brand-logo .gear-icon {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 18px;
            box-shadow: 0 4px 14px var(--accent-glow);
        }
        .brand-logo span strong { color: var(--accent-orange); }

        .nav-links { display: flex; align-items: center; gap: 22px; }
        .nav-link {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-muted);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            white-space: nowrap;
            transition: all 0.2s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--text-light);
            background: rgba(255, 255, 255, 0.06);
        }
        .nav-link.active { color: var(--accent-orange); font-weight: 600; }

        .nav-auth-group { display: flex; align-items: center; gap: 12px; }
        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--bg-card-inner);
            border: 1px solid var(--border-card);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            color: var(--text-light);
        }
        .user-pill .role-badge {
            background: var(--accent-orange);
            color: #000;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 12px;
            text-transform: uppercase;
        }
        .btn-auth-signin {
            color: var(--text-light);
            border: 1px solid var(--border-card);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, 0.04);
        }
        .btn-auth-signin:hover { border-color: var(--accent-orange); color: var(--accent-orange); }
        .btn-logout {
            color: var(--danger);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 20px;
        }
        .btn-logout:hover { background: rgba(239, 68, 68, 0.15); color: #fca5a5; }

        .hamburger {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 22px;
            cursor: pointer;
        }

        .hero-section {
            position: relative;
            max-width: 1200px;
            margin: 40px auto 60px auto;
            padding: 0 24px;
            z-index: 1;
        }
        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            align-items: center;
            gap: 45px;
            min-height: 60vh;
        }
        .hero-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.28);
            color: var(--accent-gold);
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .hero-pill .dot-pulse {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--accent-orange);
            box-shadow: 0 0 10px var(--accent-orange);
        }
        .hero-title {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.1;
            color: #ffffff;
            letter-spacing: -1.5px;
            margin-bottom: 12px;
        }
        .hero-title span { color: var(--accent-orange); }
        .hero-subtitle {
            display: block;
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
            margin-top: 6px;
        }
        .hero-tagline {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.7;
            margin-bottom: 32px;
            max-width: 540px;
        }
        .hero-btn-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 35px;
        }
        .btn-cta-primary {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19;
            font-size: 15px;
            font-weight: 700;
            padding: 14px 34px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 25px var(--accent-glow);
            transition: all 0.25s ease;
        }
        .btn-cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(245, 158, 11, 0.6);
        }
        .btn-cta-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 30px;
            border-radius: 30px;
            border: 1px solid var(--border-card);
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: all 0.25s ease;
        }
        .btn-cta-secondary:hover {
            border-color: var(--accent-orange);
            color: var(--accent-orange);
            transform: translateY(-2px);
            background: rgba(245, 158, 11, 0.08);
        }
        .hero-stats-row {
            display: flex;
            align-items: center;
            gap: 25px;
            padding-top: 25px;
            border-top: 1px solid var(--border-subtle);
        }
        .stat-cell strong {
            display: block;
            font-size: 22px;
            font-weight: 800;
            color: var(--accent-gold);
            line-height: 1.2;
        }
        .stat-cell span { font-size: 12px; color: var(--text-muted); }
        .stat-cell-divider { width: 1px; height: 32px; background: var(--border-card); }

        /* HERO CARD (RIGHT) - CLEAN MODERN SHOWCASE */
        .hero-card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.45);
            transition: transform 0.3s ease;
        }
        .hero-card:hover {
            transform: translateY(-4px);
            border-color: rgba(245, 158, 11, 0.4);
        }
        .hero-card-img-wrap {
            position: relative;
            width: 100%;
            height: 300px;
            background: #eee8e8;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .fitment-pill-float {
            position: absolute;
            bottom: 14px;
            left: 14px;
            right: 14px;
            background: rgba(11, 15, 25, 0.90);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-card);
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent-gold);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .hero-card-body { padding: 24px; text-align: center; }

        .section-wrap {
            max-width: 1200px;
            margin: 90px auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }
        .section-heading-box { text-align: center; max-width: 650px; margin: 0 auto 50px auto; }
        .heading-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--accent-orange);
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 4px 14px;
            border-radius: 20px;
            margin-bottom: 12px;
        }
        .heading-title {
            font-size: 36px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.8px;
            margin-bottom: 12px;
        }
        .heading-title span { color: var(--accent-orange); }
        .heading-desc { color: var(--text-muted); font-size: 15px; line-height: 1.6; }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
        }
        .step-box {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 20px;
            padding: 32px 24px;
            position: relative;
            transition: all 0.25s ease;
        }
        .step-box:hover {
            transform: translateY(-6px);
            border-color: rgba(245, 158, 11, 0.4);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.35);
        }
        .step-number {
            position: absolute;
            top: 24px;
            right: 24px;
            font-size: 16px;
            font-weight: 800;
            color: var(--text-subtle);
            opacity: 0.5;
        }
        .step-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--bg-card-inner);
            border: 1px solid var(--border-card);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--accent-orange);
            margin-bottom: 22px;
        }
        .step-box h3 { font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 10px; }
        .step-box p { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; margin-bottom: 18px; }
        .step-box a, .step-box span.link-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--accent-orange);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .about-card-split {
            display: grid;
            grid-template-columns: 0.9fr 1.1fr;
            gap: 50px;
            align-items: center;
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 28px;
            padding: 55px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .about-photo-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid var(--border-card);
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .about-photo-frame img { width: 100%; height: 380px; object-fit: cover; display: block; }
        .about-badge-float {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            background: rgba(11, 15, 25, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid var(--border-card);
            padding: 14px 18px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .about-features { display: flex; flex-direction: column; gap: 12px; margin: 20px 0 28px 0; }
        .about-feature-item { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #f1f5f9; }
        .about-feature-item i { color: var(--success); font-size: 16px; }

        .find-us-grid { display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 28px; }
        .location-info-card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 20px;
            padding: 35px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .loc-row { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 22px; }
        .loc-icon-bubble {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--bg-card-inner);
            border: 1px solid var(--border-card);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-orange);
            font-size: 18px;
            flex-shrink: 0;
        }
        .loc-row h4 { font-size: 15px; color: #ffffff; margin-bottom: 4px; }
        .loc-row p { font-size: 13.5px; color: var(--text-muted); line-height: 1.5; }
        .map-embed-frame {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 20px;
            overflow: hidden;
            min-height: 400px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        }

        .contact-grid-split { display: grid; grid-template-columns: 1.15fr 0.85fr; gap: 30px; }
        .contact-form-box {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 20px;
            padding: 35px;
        }
        .form-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group-field { display: flex; flex-direction: column; gap: 6px; margin-bottom: 18px; }
        .form-group-field label { font-size: 13px; font-weight: 600; color: var(--text-muted); }
        .form-group-field input, .form-group-field textarea {
            background: #0a0e17;
            border: 1px solid var(--border-card);
            color: #ffffff;
            padding: 12px 16px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }
        .form-group-field input:focus, .form-group-field textarea:focus { border-color: var(--accent-orange); }

        .contact-instant-panel {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 20px;
            padding: 35px;
            display: flex;
            flex-direction: column;
        }
        .channel-btn-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: var(--bg-card-inner);
            border: 1px solid var(--border-card);
            padding: 16px 20px;
            border-radius: 14px;
            margin-bottom: 14px;
        }
        .channel-btn-card:hover { transform: translateY(-2px); border-color: var(--accent-orange); }
        .channel-btn-card .icon-chan { font-size: 24px; }
        .channel-btn-card.wa-chan .icon-chan { color: #25d366; }
        .channel-btn-card.tel-chan .icon-chan { color: var(--accent-orange); }

        footer.page-footer {
            background: #060910;
            border-top: 1px solid var(--border-card);
            padding: 70px 24px 30px 24px;
        }
        .footer-inner-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1.2fr;
            gap: 40px;
            margin-bottom: 50px;
        }
        .footer-col h4 {
            font-size: 15px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 18px;
        }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul a { color: var(--text-muted); font-size: 13.5px; }
        .footer-col ul a:hover { color: var(--accent-orange); }
        .footer-bottom-copy {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 25px;
            border-top: 1px solid var(--border-subtle);
            text-align: center;
            font-size: 13px;
            color: var(--text-subtle);
        }

        @media (max-width: 992px) {
            .hamburger { display: block; }
            .nav-links {
                display: none;
                position: absolute;
                top: 100%; left: 0; right: 0;
                background: var(--bg-card);
                flex-direction: column;
                align-items: flex-start;
                padding: 24px;
                border-bottom: 1px solid var(--border-card);
            }
            .nav-links.show { display: flex; }
            .hero-grid, .about-card-split, .find-us-grid, .contact-grid-split {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            .hero-title { font-size: 38px; }
            .hero-subtitle { font-size: 22px; }
            .footer-inner-grid { grid-template-columns: 1fr 1fr; }
        }
    </style>
</head>
<body>
    <div class="ambient-glow-top"></div>

    <header class="top-navbar">
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">
                <div class="gear-icon"><i class="fas fa-gear fa-spin-pulse"></i></div>
                <span>Gear<strong>Go</strong></span>
            </a>

            <nav class="nav-links" id="navLinks">
                <a href="index.php" class="nav-link active"><i class="fas fa-house"></i> Home</a>
                <a href="marketplace.php" class="nav-link"><i class="fas fa-car-burst"></i> Marketplace</a>
                <a href="#steps" class="nav-link"><i class="fas fa-list-check"></i> How It Works</a>
                <a href="#about" class="nav-link"><i class="fas fa-circle-info"></i> About Us</a>
                <a href="#find-us" class="nav-link"><i class="fas fa-map-location-dot"></i> Find Us</a>
                <a href="#contact" class="nav-link"><i class="fas fa-headset"></i> Contact</a>
            </nav>

            <?php if (!empty($is_logged_in)): ?>
                <div class="nav-auth-group">
                    <div class="user-pill">
                        <i class="fas fa-user-circle"></i>
                        <span><?php echo htmlspecialchars($user_name); ?></span>
                        <span class="role-badge"><?php echo ucfirst($user_role); ?></span>
                    </div>
                    <?php if ($user_role === 'owner'): ?>
                        <a href="marketplace.php" class="btn-auth-signin"><i class="fas fa-store"></i> Panel</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn-logout" title="Sign Out">
                        <i class="fas fa-power-off"></i> Logout
                    </a>
                </div>
            <?php endif; ?>

            <button class="hamburger" id="hamburgerBtn" aria-label="Toggle Navigation">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </header>

    <main>
        <section class="hero-section">
            <div class="hero-grid">
                <div class="hero-left">
                    <div class="hero-pill">
                        <span class="dot-pulse"></span>
                        <span>Sri Lanka's #1 Auto Spares Marketplace</span>
                    </div>

                    <h1 class="hero-title">
                        Gear<span>Go</span>
                        <span class="hero-subtitle">Precision Spares. Peak Performance.</span>
                    </h1>

                    <p class="hero-tagline">
                        "Powering Every Mile Across Sri Lanka – Find Genuine Vehicle Spare Parts, Chat Directly with Verified Local Shops, & Lock 24-Hour Reservations."
                    </p>

                    <div class="hero-btn-row">
                        <?php if (empty($is_logged_in)): ?>
                            <a href="register.php" class="btn-cta-primary">
                                <i class="fas fa-user-plus"></i> Register Account
                            </a>
                            <a href="login.php" class="btn-cta-secondary">
                                <i class="fas fa-arrow-right-to-bracket"></i> Sign In
                            </a>
                        <?php else: ?>
                            <a href="marketplace.php" class="btn-cta-primary">
                                <i class="fas fa-car-burst"></i> Explore Marketplace
                            </a>
                            <?php if ($user_role === 'owner'): ?>
                                <a href="add_item.php" class="btn-cta-secondary">
                                    <i class="fas fa-plus-circle"></i> Add Spare Part
                                </a>
                            <?php else: ?>
                                <a href="marketplace.php?tab=reserved" class="btn-cta-secondary">
                                    <i class="fas fa-clock"></i> My Reservations
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                    <div class="hero-stats-row">
                        <div class="stat-cell">
                            <strong>100%</strong>
                            <span>Verified Suppliers</span>
                        </div>
                        <div class="stat-cell-divider"></div>
                        <div class="stat-cell">
                            <strong>24 Hours</strong>
                            <span>Reservation Hold</span>
                        </div>
                        <div class="stat-cell-divider"></div>
                        <div class="stat-cell">
                            <strong>Instant</strong>
                            <span>Direct Shop Chat</span>
                        </div>
                    </div>
                </div>

                <!-- Clean Modern Automotive Showcase -->
                <div class="hero-right">
                    <div class="hero-card">
                        <div class="hero-card-img-wrap">
                            <img 
                                src="hero-gear.jpg" 
                                alt="Vehicle Spare Parts" 
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=800&q=80';"
                            >
                            
                        </div>

                        <div class="hero-card-body">
                            <div style="font-size: 17px; font-weight: 700; color: #ffffff; margin-bottom: 8px;">
                                Genuine Spares Direct from Verified Dealers
                            </div>
                            <p style="font-size: 13.5px; color: var(--text-muted); line-height: 1.6; margin-bottom: 20px;">
                                Connect directly with trusted shop owners, verify exact vehicle fitment, and secure parts with guaranteed 24-hour holds.
                            </p>
                            <a href="marketplace.php" class="btn-cta-primary" style="width: 100%; justify-content: center;">
                                <i class="fas fa-store"></i> Explore Marketplace
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- STEPS SECTION -->
        <section class="section-wrap" id="steps">
            <div class="section-heading-box">
                <span class="heading-badge"><i class="fas fa-route"></i> SIMPLE WORKFLOW</span>
                <h2 class="heading-title">How GearGo Works</h2>
                <p class="heading-desc">Four easy steps to register, search compatible spare parts, and reserve risk-free.</p>
            </div>

            <div class="steps-grid">
                <div class="step-box">
                    <div class="step-number">01</div>
                    <div class="step-icon-wrap"><i class="fas fa-user-plus"></i></div>
                    <h3>Create Your Account</h3>
                    <p>Register in 30 seconds as a <strong>Vehicle Owner / Driver</strong> to reserve parts, or as a <strong>Shop Owner</strong> to publish your shop's inventory.</p>
                    <a href="register.php">Register Now &rarr;</a>
                </div>

                <div class="step-box">
                    <div class="step-number">02</div>
                    <div class="step-icon-wrap"><i class="fas fa-magnifying-glass-chart"></i></div>
                    <h3>Filter by Vehicle Model</h3>
                    <p>Search specifically by your car make and model (Toyota Aqua, Prius, Honda Civic, Nissan Leaf, etc.) for guaranteed part fitment.</p>
                    <a href="marketplace.php">Browse Spares &rarr;</a>
                </div>

                <div class="step-box">
                    <div class="step-number">03</div>
                    <div class="step-icon-wrap"><i class="fas fa-comments"></i></div>
                    <h3>Direct Shop Chat</h3>
                    <p>No middlemen. Click <strong>Message Shop</strong> on any item to open a real-time conversation directly with the spare parts dealer.</p>
                    <span class="link-text">Direct Shop Chat</span>
                </div>

                <div class="step-box">
                    <div class="step-number">04</div>
                    <div class="step-icon-wrap"><i class="fas fa-shield-halved"></i></div>
                    <h3>24-Hour Hold & Pick Up</h3>
                    <p>Lock your part with our 24-hour reservation guarantee. Stock is securely held for you so you can collect or pay with complete confidence.</p>
                    <span class="link-text">Guaranteed 24h Hold</span>
                </div>
            </div>
        </section>

        <!-- ABOUT US -->
        <section class="section-wrap" id="about">
            <div class="about-card-split">
                <div class="about-photo-frame">
                    <img 
                        src="about-shop.jpg" 
                        alt="GearGo Workshop & Network" 
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&w=800&q=80';"
                    >
                    <div class="about-badge-float">
                        <i class="fas fa-award" style="color: var(--accent-orange); font-size: 24px;"></i>
                        <div>
                            <strong>Sri Lanka's Auto Hub</strong>
                            <small style="color: var(--text-muted); display: block;">Connecting drivers directly with verified suppliers</small>
                        </div>
                    </div>
                </div>

                <div>
                    <span class="heading-badge"><i class="fas fa-wrench"></i> WHO WE ARE</span>
                    <h2 class="heading-title" style="text-align: left; margin-bottom: 16px;">About Gear<span>Go</span></h2>
                    <p style="color: var(--text-muted); font-size: 15px; margin-bottom: 16px;">
                        At <strong>GearGo</strong>, we are revolutionizing how vehicle owners and professional mechanics source automotive spare parts across Sri Lanka.
                    </p>
                    <p style="color: var(--text-muted); font-size: 15px; margin-bottom: 20px;">
                        Instead of traveling between physical shops or guessing compatibility, our digital network connects you directly with reputable parts suppliers. We provide full transparency with real-time shop chat, clear pricing, verified customer reviews, and a 24-hour reservation hold guarantee.
                    </p>

                    <div class="about-features">
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>100% Genuine & OEM-Grade Spare Parts</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>Direct In-App Communication with Verified Suppliers</span>
                        </div>
                        <div class="about-feature-item">
                            <i class="fas fa-circle-check"></i>
                            <span>Automated 24-Hour Stock Reservation Guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FIND US & MAP -->
        <section class="section-wrap" id="find-us">
            <div class="section-heading-box">
                <span class="heading-badge"><i class="fas fa-location-dot"></i> LOCATION & MAP</span>
                <h2 class="heading-title">Find Us in Colombo</h2>
                <p class="heading-desc">Visit our central coordination hub and partner workshops in Sri Lanka's automotive heartland.</p>
            </div>

            <div class="find-us-grid">
                <div class="location-info-card">
                    <div>
                        <div class="loc-row">
                            <div class="loc-icon-bubble"><i class="fas fa-map-pin"></i></div>
                            <div>
                                <h4>Hub Address</h4>
                                <p>No. 142, Sri Sangaraja Mawatha (Panchikawatta), Colombo 01000, Sri Lanka</p>
                            </div>
                        </div>

                        <div class="loc-row">
                            <div class="loc-icon-bubble"><i class="fas fa-clock"></i></div>
                            <div>
                                <h4>Operating Hours</h4>
                                <p>Monday – Friday: 8:00 AM – 7:00 PM<br>Saturday: 8:30 AM – 5:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>

                        <div class="loc-row">
                            <div class="loc-icon-bubble"><i class="fas fa-phone-volume"></i></div>
                            <div>
                                <h4>Helpline</h4>
                                <p>+94 11 234 5678 / +94 77 123 4567</p>
                            </div>
                        </div>

                        <div class="loc-row">
                            <div class="loc-icon-bubble"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4>Email</h4>
                                <p>support@geargo.lk / info@geargo.lk</p>
                            </div>
                        </div>
                    </div>

                    <a href="https://maps.google.com/?q=Panchikawatta+Colombo" target="_blank" rel="noopener noreferrer" class="btn-auth-signin" style="text-align: center; justify-content: center; padding: 12px; margin-top: 15px;">
                        <i class="fas fa-diamond-turn-right"></i> Open in Google Maps
                    </a>
                </div>

                <div class="map-embed-frame">
                    <iframe 
                        title="GearGo Location Map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.6725838595444!2d79.8596637!3d6.9298495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259160d5b7787%3A0x8dd0cb61921f6a15!2sSri%20Sangaraja%20Mawatha%2C%20Colombo!5e0!3m2!1sen!2slk!4v1710000000000!5m2!1sen!2slk" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </section>

        <!-- CONTACT US -->
        <section class="section-wrap" id="contact" style="margin-bottom: 90px;">
            <div class="section-heading-box">
                <span class="heading-badge"><i class="fas fa-headset"></i> 24/7 SUPPORT</span>
                <h2 class="heading-title">Contact Our Parts Specialists</h2>
                <p class="heading-desc">Have fitment questions or need emergency spare parts? Get in touch with our team.</p>
            </div>

            <div class="contact-grid-split">
                <div class="contact-form-box">
                    <form onsubmit="alert('Thank you! Your spare parts inquiry has been received. Our team will contact you shortly.'); return false;">
                        <div class="form-2col">
                            <div class="form-group-field">
                                <label>Your Name</label>
                                <input type="text" placeholder="Alex Perera" required>
                            </div>
                            <div class="form-group-field">
                                <label>Phone Number</label>
                                <input type="text" placeholder="0771234567" required>
                            </div>
                        </div>

                        <div class="form-group-field">
                            <label>Email Address</label>
                            <input type="email" placeholder="alex@example.com" required>
                        </div>

                        <div class="form-group-field">
                            <label>Vehicle Model & Year (Optional)</label>
                            <input type="text" placeholder="e.g. Toyota Aqua 2016 / Honda Civic EK3">
                        </div>

                        <div class="form-group-field">
                            <label>Spare Part Required / Message</label>
                            <textarea rows="4" placeholder="Describe the part you need..." required></textarea>
                        </div>

                        <button type="submit" class="btn-cta-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-paper-plane"></i> Send Inquiry
                        </button>
                    </form>
                </div>

                <div class="contact-instant-panel">
                    <div style="margin-bottom: 24px;">
                        <i class="fas fa-bolt" style="color: var(--accent-orange); font-size: 24px;"></i>
                        <h3 style="font-size: 18px; color: #ffffff; margin: 8px 0 6px 0;">Instant Response Channels</h3>
                        <p style="font-size: 13px; color: var(--text-muted);">
                            Need emergency spare part dispatch for a vehicle breakdown? Connect directly through our prioritized channels:
                        </p>
                    </div>

                    <a href="https://wa.me/94771234567" target="_blank" rel="noopener noreferrer" class="channel-btn-card wa-chan">
                        <div class="icon-chan"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <strong>WhatsApp Specialist Desk</strong>
                            <small>Typical response: Under 10 minutes</small>
                        </div>
                    </a>

                    <a href="tel:+94112345678" class="channel-btn-card tel-chan">
                        <div class="icon-chan"><i class="fas fa-phone-volume"></i></div>
                        <div>
                            <strong>Spare Parts Helpline</strong>
                            <small>Direct Call: +94 11 234 5678 (Toll Free)</small>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="page-footer">
        <div class="footer-inner-grid">
            <div>
                <a href="index.php" class="brand-logo" style="margin-bottom: 14px; display: inline-flex;">
                    <div class="gear-icon"><i class="fas fa-gear"></i></div>
                    <span>Gear<strong>Go</strong></span>
                </a>
                <p style="color: var(--text-muted); font-size: 13.5px; line-height: 1.7;">
                    Sri Lanka's leading digital platform for vehicle spare parts discovery, direct shop chat, and verified reservations.
                </p>
            </div>

            <div class="footer-col">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="marketplace.php">Marketplace</a></li>
                    <li><a href="#steps">How It Works</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#find-us">Find Us & Map</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Account & Hub</h4>
                <ul>
                    <?php if (empty($is_logged_in)): ?>
                        <li><a href="login.php">Sign In</a></li>
                        <li><a href="register.php">Register (Driver / Shop)</a></li>
                    <?php else: ?>
                        <li><a href="marketplace.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <?php endif; ?>
                    <li><a href="#contact">Contact Support</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Location</h4>
                <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 8px;"><i class="fas fa-location-dot" style="color: var(--accent-orange);"></i> Panchikawatta, Colombo 01000</p>
                <p style="font-size: 13.5px; color: var(--text-muted); margin-bottom: 8px;"><i class="fas fa-phone" style="color: var(--accent-orange);"></i> +94 11 234 5678</p>
                <p style="font-size: 13.5px; color: var(--text-muted);"><i class="fas fa-envelope" style="color: var(--accent-orange);"></i> support@geargo.lk</p>
            </div>
        </div>

        <div class="footer-bottom-copy">
            <p>&copy; <?php echo date("Y"); ?> GearGo Vehicle Spare Parts Network. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const hamburgerBtn = document.getElementById("hamburgerBtn");
            const navLinks = document.getElementById("navLinks");
            if (hamburgerBtn && navLinks) {
                hamburgerBtn.addEventListener("click", () => {
                    navLinks.classList.toggle("show");
                });
            }
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId && targetId !== '#') {
                        const target = document.querySelector(targetId);
                        if (target) {
                            e.preventDefault();
                            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            if (navLinks && navLinks.classList.contains("show")) {
                                navLinks.classList.remove("show");
                            }
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>