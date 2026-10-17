<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($part_name); ?> - GearGo Details</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-body: #0b0f19;
            --bg-card: #141c2e;
            --bg-card-inner: #1f2c45;
            --accent-orange: #f59e0b;
            --accent-gold: #fbbf24;
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
            max-width: 1240px; margin: 0 auto;
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
        .nav-links { display: flex; align-items: center; gap: 20px; }
        .nav-link {
            font-size: 14px; font-weight: 500; color: var(--text-muted);
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 20px; white-space: nowrap;
        }
        .nav-link:hover { color: var(--text-light); background: rgba(255, 255, 255, 0.06); }

        .details-wrapper {
            position: relative; max-width: 1240px; width: 100%;
            margin: 35px auto 80px auto; padding: 0 20px; z-index: 1; flex: 1;
        }
        .back-strip { margin-bottom: 25px; }
        .btn-back {
            display: inline-flex; align-items: center; gap: 8px; font-size: 14px;
            font-weight: 600; color: var(--text-muted); background: var(--bg-card);
            border: 1px solid var(--border-card); padding: 8px 18px; border-radius: 20px;
        }
        .btn-back:hover { color: var(--accent-orange); border-color: var(--accent-orange); }

        .product-split-grid {
            display: grid; grid-template-columns: 1fr 1.15fr; gap: 40px;
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 28px; padding: 35px; margin-bottom: 40px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .product-media-box {
            position: relative; width: 100%; height: 420px;
            border-radius: 20px; overflow: hidden; background: #090d16;
            border: 1px solid var(--border-card);
        }
        .product-media-box img { width: 100%; height: 100%; object-fit: cover; }
        .product-info-box { display: flex; flex-direction: column; justify-content: space-between; }

        .vehicle-badge-large {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(245, 158, 11, 0.08); border: 1px solid rgba(245, 158, 11, 0.3);
            color: var(--accent-gold); font-size: 13px; font-weight: 700;
            padding: 6px 14px; border-radius: 20px; margin-bottom: 12px; width: fit-content;
        }
        .part-title-large { font-size: 32px; font-weight: 800; color: #ffffff; line-height: 1.2; margin-bottom: 14px; }
        .rating-overview-row { display: flex; align-items: center; gap: 12px; margin-bottom: 20px; }
        .stars-large { color: #f59e0b; font-size: 16px; }
        .rating-summary-text { font-size: 14px; color: var(--text-muted); }

        .price-box-large {
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            border-radius: 16px; padding: 18px 22px; margin-bottom: 25px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .price-num { font-size: 30px; font-weight: 800; color: var(--accent-orange); }
        .stock-tag { font-size: 12px; font-weight: 700; padding: 4px 12px; border-radius: 20px; }
        .stock-tag.in { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); color: var(--success); }
        .stock-tag.out { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.4); color: var(--danger); }

        .cta-actions-group { display: flex; flex-direction: column; gap: 12px; }
        .cta-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .btn-action-lg {
            padding: 14px; border-radius: 14px; font-size: 14px; font-weight: 700;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            cursor: pointer; border: none; transition: all 0.25s ease;
        }
        .btn-reserve-lg {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; box-shadow: 0 8px 25px var(--accent-glow);
        }
        .btn-reserve-lg:hover { transform: translateY(-2px); }
        .btn-save-lg { background: rgba(255, 255, 255, 0.06); border: 1px solid var(--border-card); color: #ffffff; }
        .btn-save-lg:hover { border-color: var(--accent-orange); color: var(--accent-orange); }
        .btn-chat-lg {
            background: rgba(37, 99, 235, 0.2); border: 1px solid rgba(37, 99, 235, 0.4); color: #93c5fd;
        }
        .btn-chat-lg:hover { background: #2563eb; color: #ffffff; }

        .shop-info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; margin-bottom: 45px; }
        .shop-card-box, .shop-map-box {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; padding: 30px;
        }
        .section-sub-title {
            font-size: 18px; font-weight: 700; color: #ffffff; margin-bottom: 18px;
            display: flex; align-items: center; gap: 10px;
        }
        .section-sub-title i { color: var(--accent-orange); }

        .shop-meta-list { display: flex; flex-direction: column; gap: 16px; }
        .shop-meta-row { display: flex; align-items: flex-start; gap: 14px; }
        .meta-icon-bubble {
            width: 40px; height: 40px; border-radius: 10px; background: var(--bg-card-inner);
            display: flex; align-items: center; justify-content: center;
            color: var(--accent-orange); font-size: 16px; flex-shrink: 0;
        }
        .shop-meta-row strong { display: block; font-size: 14px; color: #ffffff; }
        .shop-meta-row span { font-size: 13px; color: var(--text-muted); }

        .map-frame-embed {
            width: 100%; height: 250px; border-radius: 16px; overflow: hidden;
            border: 1px solid var(--border-card); margin-top: 12px;
        }
        .map-frame-embed iframe { width: 100%; height: 100%; border: 0; }

        .reviews-container-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; padding: 35px;
        }
        .reviews-split { display: grid; grid-template-columns: 1fr 1.3fr; gap: 40px; }
        .review-form-box {
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            border-radius: 18px; padding: 24px;
        }
        .star-rating-select { display: flex; gap: 8px; margin-bottom: 14px; }
        .star-radio-label { cursor: pointer; font-size: 24px; color: #475569; transition: color 0.2s; }
        .star-radio-label.active, .star-radio-label:hover { color: #f59e0b; }
        .star-rating-select input[type="radio"] { display: none; }

        .form-review-text {
            width: 100%; background: #0a0e17; border: 1px solid var(--border-card);
            color: #ffffff; padding: 12px 14px; border-radius: 10px;
            font-family: inherit; font-size: 14px; outline: none; resize: vertical;
            min-height: 90px; margin-bottom: 14px;
        }
        .form-review-text:focus { border-color: var(--accent-orange); }

        .reviews-list-box {
            display: flex; flex-direction: column; gap: 16px; max-height: 480px;
            overflow-y: auto; padding-right: 6px;
        }
        .single-review-card {
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            border-radius: 16px; padding: 18px 20px;
        }
        .rev-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px; }
        .rev-author { font-size: 14px; font-weight: 700; color: #ffffff; }
        .rev-date { font-size: 12px; color: var(--text-subtle); }
        .rev-text { font-size: 13.5px; color: var(--text-muted); line-height: 1.5; }

        .alert-toast {
            padding: 14px 20px; border-radius: 12px; margin-bottom: 25px;
            font-size: 13.5px; display: flex; align-items: center; gap: 10px;
        }
        .alert-toast.success { background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #6ee7b7; }
        .alert-toast.error { background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5; }

        @media (max-width: 992px) {
            .product-split-grid, .shop-info-grid, .reviews-split { grid-template-columns: 1fr; }
            .product-media-box { height: 300px; }
        }
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

    <main class="details-wrapper">
        <div class="back-strip">
            <a href="marketplace.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Marketplace
            </a>
        </div>

        <?php if (!empty($flash_msg)): ?>
            <div class="alert-toast success">
                <i class="fas fa-circle-check"></i>
                <span><?php echo htmlspecialchars($flash_msg); ?></span>
            </div>
        <?php endif; ?>

        <?php if (!empty($flash_error)): ?>
            <div class="alert-toast error">
                <i class="fas fa-circle-exclamation"></i>
                <span><?php echo htmlspecialchars($flash_error); ?></span>
            </div>
        <?php endif; ?>

        <div class="product-split-grid">
            <div class="product-media-box">
                <img src="<?php echo htmlspecialchars($item_image); ?>" alt="<?php echo htmlspecialchars($part_name); ?>" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=800&q=80';">
            </div>

            <div class="product-info-box">
                <div>
                    <div class="vehicle-badge-large">
                        <i class="fas fa-car-side"></i> Vehicle Model: <?php echo htmlspecialchars($vehicle_model); ?>
                    </div>

                    <h1 class="part-title-large"><?php echo htmlspecialchars($part_name); ?></h1>

                    <div class="rating-overview-row">
                        <div class="stars-large">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="<?php echo ($i <= round($avg_rating)) ? 'fas' : 'far'; ?> fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="rating-summary-text">
                            <strong><?php echo ($total_reviews > 0) ? $avg_rating : 'New Item'; ?></strong> 
                            <?php if ($total_reviews > 0): ?>
                                (<?php echo $total_reviews; ?> customer <?php echo ($total_reviews === 1) ? 'review' : 'reviews'; ?>)
                            <?php endif; ?>
                        </span>
                    </div>

                    <div class="price-box-large">
                        <div>
                            <span style="font-size: 12px; color: var(--text-subtle); text-transform: uppercase;">Price in Sri Lankan Rupees</span>
                            <div class="price-num">LKR <?php echo number_format($item['Price'], 2); ?></div>
                        </div>
                        <span class="stock-tag <?php echo $is_in_stock ? 'in' : 'out'; ?>">
                            <i class="fas fa-box"></i> <?php echo $is_in_stock ? 'IN STOCK ('.$item['quantity'].' available)' : 'OUT OF STOCK'; ?>
                        </span>
                    </div>
                </div>

                <div class="cta-actions-group">
                    <?php if ($role === 'customer'): ?>
                        <div class="cta-row-2">
                            <form method="POST" action="product-details.php?id=<?php echo $item_id; ?>">
                                <input type="hidden" name="action" value="reserve">
                                <button type="submit" class="btn-action-lg btn-reserve-lg" style="width: 100%;" <?php echo !$is_in_stock ? 'disabled style="opacity:0.5;"' : ''; ?>>
                                    <i class="fas fa-clock"></i> Lock 24h Reservation
                                </button>
                            </form>

                            <form method="POST" action="product-details.php?id=<?php echo $item_id; ?>">
                                <input type="hidden" name="action" value="save">
                                <button type="submit" class="btn-action-lg btn-save-lg" style="width: 100%;">
                                    <i class="fas fa-bookmark"></i> Save for Later
                                </button>
                            </form>
                        </div>

                        <a href="chat.php?supplier_id=<?php echo $item['SupplierID']; ?>&item_id=<?php echo $item_id; ?>" class="btn-action-lg btn-chat-lg">
                            <i class="fas fa-comments"></i> Chat Directly with <?php echo htmlspecialchars($item['Shopname']); ?>
                        </a>

                    <?php elseif (!$is_logged_in): ?>
                        <a href="login.php" class="btn-action-lg btn-reserve-lg">
                            <i class="fas fa-arrow-right-to-bracket"></i> Sign In to Reserve or Chat with Shop
                        </a>
                    <?php else: ?>
                        <div style="font-size: 13px; color: var(--text-muted); background: var(--bg-card-inner); padding: 12px; border-radius: 10px;">
                            <i class="fas fa-info-circle"></i> Logged in as Shop Owner.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- SHOP DETAILS & LOCATION MAP -->
        <div class="shop-info-grid">
            <div class="shop-card-box">
                <h2 class="section-sub-title">
                    <i class="fas fa-store"></i> Verified Shop Details
                </h2>

                <div class="shop-meta-list">
                    <div class="shop-meta-row">
                        <div class="meta-icon-bubble"><i class="fas fa-shop"></i></div>
                        <div>
                            <strong><?php echo htmlspecialchars($item['Shopname']); ?></strong>
                            <span>Registered Automotive Spare Parts Dealer</span>
                        </div>
                    </div>

                    <div class="shop-meta-row">
                        <div class="meta-icon-bubble"><i class="fas fa-user-tie"></i></div>
                        <div>
                            <strong>Owner / Contact Person</strong>
                            <span><?php echo htmlspecialchars($item['firstname'] . ' ' . $item['lastname']); ?></span>
                        </div>
                    </div>

                    <div class="shop-meta-row">
                        <div class="meta-icon-bubble"><i class="fas fa-phone"></i></div>
                        <div>
                            <strong>Direct Helpline</strong>
                            <span><?php echo htmlspecialchars($item['phonenumber']); ?></span>
                        </div>
                    </div>

                    <div class="shop-meta-row">
                        <div class="meta-icon-bubble"><i class="fas fa-map-location-dot"></i></div>
                        <div>
                            <strong>Shop Address</strong>
                            <span><?php echo htmlspecialchars($item['Shopaddress']); ?></span>
                        </div>
                    </div>
                </div>

                <div style="margin-top: 25px; display: flex; gap: 10px;">
                    <a href="tel:<?php echo htmlspecialchars($item['phonenumber']); ?>" class="btn-back" style="flex:1; justify-content:center;">
                        <i class="fas fa-phone-volume"></i> Call Shop
                    </a>
                    <a href="chat.php?supplier_id=<?php echo $item['SupplierID']; ?>&item_id=<?php echo $item_id; ?>" class="btn-back" style="flex:1; justify-content:center; color: var(--accent-orange); border-color: var(--accent-orange);">
                        <i class="fas fa-comments"></i> Message Shop
                    </a>
                </div>
            </div>

            <div class="shop-map-box">
                <h2 class="section-sub-title">
                    <i class="fas fa-map-pin"></i> Shop Location on Map
                </h2>
                <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 10px;">
                    Visit <?php echo htmlspecialchars($item['Shopname']); ?> in person to inspect and pick up your reserved parts:
                </p>

                <div class="map-frame-embed">
                    <iframe 
                        title="Shop Location"
                        src="https://maps.google.com/maps?q=<?php echo urlencode($item['Shopaddress'] . ', Sri Lanka'); ?>&t=&z=14&ie=UTF8&iwloc=&output=embed"
                        loading="lazy"
                    ></iframe>
                </div>

                <div style="margin-top: 15px; text-align: right;">
                    <a href="https://maps.google.com/?q=<?php echo urlencode($item['Shopaddress'] . ', Sri Lanka'); ?>" target="_blank" rel="noopener noreferrer" style="font-size: 13px; color: var(--accent-orange); font-weight: 600;">
                        <i class="fas fa-diamond-turn-right"></i> Open in Google Maps App &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- REVIEWS AND 1-5 STAR RATINGS -->
        <div class="reviews-container-card">
            <h2 class="section-sub-title" style="margin-bottom: 24px;">
                <i class="fas fa-star-half-stroke"></i> Customer Reviews & Shop Ratings
            </h2>

            <div class="reviews-split">
                <div>
                    <?php if ($role === 'customer'): ?>
                        <div class="review-form-box">
                            <h3 style="font-size: 16px; color: #fff; margin-bottom: 6px;">Leave Your Rating & Review</h3>
                            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 16px;">Share your experience with this spare part and shop owner:</p>

                            <form action="product-details.php?id=<?php echo $item_id; ?>" method="POST">
                                <label style="font-size: 13px; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 6px;">Select Rating (1 to 5 Stars)</label>
                                <div class="star-rating-select" id="starSelector">
                                    <?php for ($s = 1; $s <= 5; $s++): ?>
                                        <label class="star-radio-label active" data-value="<?php echo $s; ?>">
                                            <input type="radio" name="rating" value="<?php echo $s; ?>" <?php echo ($s === 5) ? 'checked' : ''; ?>>
                                            <i class="fas fa-star"></i>
                                        </label>
                                    <?php endfor; ?>
                                </div>

                                <textarea name="review_text" class="form-review-text" placeholder="Describe the part condition, shop communication, and fitment..." required></textarea>

                                <button type="submit" name="submit_review" class="btn-action-lg btn-reserve-lg" style="width: 100%;">
                                    <i class="fas fa-paper-plane"></i> Submit Verified Review
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="review-form-box" style="text-align: center; padding: 30px;">
                            <i class="fas fa-lock" style="font-size: 28px; color: var(--text-subtle); margin-bottom: 12px;"></i>
                            <h4 style="font-size: 15px; color: #fff; margin-bottom: 6px;">Write a Review</h4>
                            <p style="font-size: 13px; color: var(--text-muted); margin-bottom: 15px;">Please sign in as a Driver/Customer to rate and review this spare part.</p>
                            <a href="login.php" class="btn-back" style="color: var(--accent-orange); border-color: var(--accent-orange);">
                                <i class="fas fa-arrow-right-to-bracket"></i> Sign In to Review
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div>
                    <h3 style="font-size: 16px; color: #fff; margin-bottom: 14px;">
                        Customer Feedback (<?php echo $total_reviews; ?>)
                    </h3>

                    <?php if ($reviews_result && $reviews_result->num_rows > 0): ?>
                        <div class="reviews-list-box">
                            <?php while ($rev = $reviews_result->fetch_assoc()): ?>
                                <div class="single-review-card">
                                    <div class="rev-header">
                                        <span class="rev-author">
                                            <i class="fas fa-circle-user" style="color: var(--accent-orange); margin-right: 6px;"></i>
                                            <?php echo htmlspecialchars($rev['firstname'] . ' ' . substr($rev['lastname'], 0, 1) . '.'); ?>
                                        </span>
                                        <div class="stars-gold" style="font-size: 12px;">
                                            <?php for ($s = 1; $s <= 5; $s++): ?>
                                                <i class="<?php echo ($s <= $rev['Rating']) ? 'fas' : 'far'; ?> fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="rev-text"><?php echo nl2br(htmlspecialchars($rev['review_text'])); ?></p>
                                    <span class="rev-date"><?php echo date('M d, Y', strtotime($rev['review_date'])); ?></span>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <div style="text-align: center; padding: 40px 20px; background: var(--bg-card-inner); border-radius: 16px; border: 1px solid var(--border-card);">
                            <i class="far fa-comment-dots" style="font-size: 36px; color: var(--text-subtle); margin-bottom: 10px;"></i>
                            <h4 style="font-size: 15px; color: #fff; margin-bottom: 4px;">No reviews yet</h4>
                            <p style="font-size: 13px; color: var(--text-muted);">Be the first customer to review this spare part!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const starLabels = document.querySelectorAll('#starSelector .star-radio-label');
            starLabels.forEach((label, idx) => {
                label.addEventListener('click', () => {
                    const val = idx + 1;
                    starLabels.forEach((l, i) => {
                        if (i < val) {
                            l.classList.add('active');
                            l.querySelector('i').classList.remove('far');
                            l.querySelector('i').classList.add('fas');
                        } else {
                            l.classList.remove('active');
                            l.querySelector('i').classList.remove('fas');
                            l.querySelector('i').classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>