<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketplace - GearGo Vehicle Spare Parts</title>
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
            --danger: #ef4444;
            --success: #10b981;
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
        .nav-link:hover, .nav-link.active { color: var(--text-light); background: rgba(255, 255, 255, 0.06); }
        .nav-link.active { color: var(--accent-orange); font-weight: 600; }

        .nav-user-area { display: flex; align-items: center; gap: 12px; }
        .user-pill {
            display: flex; align-items: center; gap: 8px;
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            padding: 6px 14px; border-radius: 30px; font-size: 13px;
        }
        .user-pill .role-badge {
            background: var(--accent-orange); color: #000;
            font-size: 10px; font-weight: 700; padding: 2px 8px;
            border-radius: 12px; text-transform: uppercase;
        }

        .marketplace-wrapper {
            position: relative; max-width: 1240px; width: 100%;
            margin: 35px auto 80px auto; padding: 0 20px; z-index: 1; flex: 1;
        }
        .marketplace-head {
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 20px; margin-bottom: 30px;
        }
        .head-titles h1 { font-size: 30px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }
        .head-titles p { color: var(--text-muted); font-size: 14px; margin-top: 4px; }

        .btn-add-item {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-size: 14px; font-weight: 700; padding: 12px 24px;
            border-radius: 30px; display: inline-flex; align-items: center; gap: 8px;
            box-shadow: 0 6px 20px var(--accent-glow);
        }
        .btn-add-item:hover { transform: translateY(-2px); }

        .controls-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 20px; padding: 22px; margin-bottom: 30px;
        }
        .search-form-row { display: flex; gap: 14px; flex-wrap: wrap; }
        .search-input-box { flex: 1; min-width: 280px; position: relative; }
        .search-input-box i {
            position: absolute; left: 16px; top: 50%;
            transform: translateY(-50%); color: var(--text-subtle);
        }
        .search-input-box input {
            width: 100%; background: #0a0e17; border: 1px solid var(--border-card);
            color: #ffffff; padding: 12px 16px 12px 42px; border-radius: 12px;
            font-family: inherit; font-size: 14px; outline: none;
        }
        .search-input-box input:focus { border-color: var(--accent-orange); }
        .btn-search {
            background: var(--accent-orange); color: #0b0f19; font-weight: 700;
            font-size: 14px; padding: 12px 24px; border-radius: 12px; border: none;
            cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
        }

        .filter-pills-row {
            display: flex; align-items: center; gap: 8px; flex-wrap: wrap;
            margin-top: 16px; padding-top: 14px; border-top: 1px solid var(--border-subtle);
        }
        .filter-label { font-size: 12.5px; font-weight: 600; color: var(--text-subtle); margin-right: 4px; }
        .pill-chip {
            font-size: 12px; font-weight: 600; color: var(--text-muted);
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            padding: 5px 14px; border-radius: 20px; cursor: pointer;
        }
        .pill-chip:hover, .pill-chip.active {
            color: #ffffff; background: rgba(245, 158, 11, 0.15); border-color: var(--accent-orange);
        }

        .tabs-row {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 25px; border-bottom: 1px solid var(--border-card);
            padding-bottom: 12px;
        }
        .tab-btn {
            font-size: 13.5px; font-weight: 600; color: var(--text-muted);
            padding: 8px 16px; border-radius: 20px; display: inline-flex;
            align-items: center; gap: 8px; background: transparent; border: none; cursor: pointer;
        }
        .tab-btn.active { background: var(--accent-orange); color: #0b0f19; font-weight: 700; }

        /* MODAL POPUP WHEN ITEM IS SAVED */
        .prompt-modal-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(8px);
            z-index: 2000; display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }
        .prompt-modal-card {
            background: var(--bg-card); border: 1px solid rgba(245, 158, 11, 0.4);
            border-radius: 24px; max-width: 480px; width: 100%; padding: 32px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6); text-align: center;
        }
        .prompt-modal-icon {
            width: 60px; height: 60px; border-radius: 50%;
            background: rgba(16, 185, 129, 0.15); color: var(--success);
            font-size: 26px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px auto;
        }
        .prompt-modal-card h3 { font-size: 20px; color: #ffffff; margin-bottom: 8px; }
        .prompt-modal-card p { font-size: 13.5px; color: var(--text-muted); line-height: 1.6; margin-bottom: 24px; }
        .prompt-modal-btns { display: flex; gap: 12px; }
        .btn-modal-chat {
            flex: 1; background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-weight: 700; padding: 12px; border-radius: 12px;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-modal-close {
            flex: 1; background: rgba(255, 255, 255, 0.06); color: #ffffff;
            border: 1px solid var(--border-card); font-weight: 600; padding: 12px;
            border-radius: 12px; cursor: pointer;
        }

        .parts-grid {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 25px;
        }
        .item-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 20px; overflow: hidden; display: flex;
            flex-direction: column; transition: transform 0.25s ease;
        }
        .item-card:hover { transform: translateY(-4px); border-color: rgba(245, 158, 11, 0.35); }
        .item-card-img-wrap { position: relative; width: 100%; height: 200px; background: #090d16; overflow: hidden; }
        .item-card-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .status-badge {
            position: absolute; top: 12px; right: 12px; font-size: 10.5px; font-weight: 700;
            padding: 3px 10px; border-radius: 20px; text-transform: uppercase;
        }
        .status-badge.in-stock { background: rgba(16, 185, 129, 0.9); color: #ffffff; }
        .status-badge.out-stock { background: rgba(239, 68, 68, 0.9); color: #ffffff; }

        .item-card-body { padding: 20px; display: flex; flex-direction: column; flex: 1; }
        .vehicle-model-pill {
            display: inline-flex; align-items: center; gap: 6px; font-size: 11px;
            font-weight: 700; color: var(--accent-gold); background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.2); padding: 3px 10px;
            border-radius: 12px; margin-bottom: 10px; width: fit-content;
        }
        .item-title { font-size: 17px; font-weight: 700; color: #ffffff; margin-bottom: 6px; line-height: 1.4; }
        .shop-info-row {
            display: flex; align-items: center; gap: 6px; font-size: 12.5px;
            color: var(--text-muted); margin-bottom: 10px;
        }
        .shop-info-row i { color: var(--accent-orange); }

        .rating-strip { display: flex; align-items: center; gap: 6px; font-size: 12.5px; margin-bottom: 14px; }
        .stars-gold { color: #f59e0b; }
        .rating-text { color: var(--text-muted); font-size: 12px; }

        .item-price-row {
            display: flex; align-items: baseline; justify-content: space-between;
            margin-top: auto; padding-top: 14px; border-top: 1px solid var(--border-subtle); margin-bottom: 14px;
        }
        .price-val { font-size: 20px; font-weight: 800; color: var(--accent-orange); }
        .qty-val { font-size: 12px; color: var(--text-subtle); }

        .card-actions-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .card-actions-full { display: flex; gap: 8px; margin-top: 8px; }

        .btn-card {
            padding: 9px 12px; border-radius: 10px; font-size: 12.5px; font-weight: 600;
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            border: none; cursor: pointer; transition: all 0.2s ease;
        }
        .btn-reserve {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-weight: 700;
        }
        .btn-save { background: rgba(255, 255, 255, 0.06); color: #ffffff; border: 1px solid var(--border-card); }
        .btn-save:hover { border-color: var(--accent-orange); color: var(--accent-orange); }
        .btn-chat {
            background: rgba(37, 99, 235, 0.15); color: #60a5fa;
            border: 1px solid rgba(37, 99, 235, 0.3); flex: 1;
        }
        .btn-chat:hover { background: #2563eb; color: #ffffff; }
        .btn-details {
            background: var(--bg-card-inner); color: #ffffff;
            border: 1px solid var(--border-card); flex: 1;
        }
        .btn-details:hover { background: rgba(255, 255, 255, 0.12); }

        .btn-owner-edit {
            background: rgba(245, 158, 11, 0.15); color: var(--accent-gold);
            border: 1px solid rgba(245, 158, 11, 0.3); flex: 1;
        }
        .btn-owner-delete {
            background: rgba(239, 68, 68, 0.15); color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3); flex: 1;
        }
        .btn-owner-delete:hover { background: var(--danger); color: #ffffff; }

        .alert-toast {
            padding: 14px 20px; border-radius: 12px; margin-bottom: 25px;
            font-size: 13.5px; display: flex; align-items: center; gap: 10px;
        }
        .alert-toast.success {
            background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.3); color: #6ee7b7;
        }
        .alert-toast.error {
            background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); color: #fca5a5;
        }

        .empty-placeholder {
            grid-column: 1 / -1; text-align: center; padding: 70px 20px;
            background: var(--bg-card); border: 1px solid var(--border-card); border-radius: 20px;
        }
        .empty-placeholder i { font-size: 48px; color: var(--accent-orange); margin-bottom: 16px; }
        .empty-placeholder h3 { font-size: 20px; color: #ffffff; margin-bottom: 8px; }
        .empty-placeholder p { color: var(--text-muted); font-size: 14px; }
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
                <a href="marketplace.php" class="nav-link active"><i class="fas fa-car-burst"></i> Marketplace</a>
                <a href="index.php#steps" class="nav-link"><i class="fas fa-list-check"></i> How It Works</a>
                <a href="index.php#about" class="nav-link"><i class="fas fa-circle-info"></i> About Us</a>
                <a href="index.php#find-us" class="nav-link"><i class="fas fa-map-location-dot"></i> Find Us</a>
                <a href="index.php#contact" class="nav-link"><i class="fas fa-headset"></i> Contact</a>
            </nav>

            <?php if ($is_logged_in): ?>
                <div class="nav-user-area">
                    <div class="user-pill">
                        <i class="fas fa-user-circle"></i>
                        <span><?php echo htmlspecialchars($user_name); ?></span>
                        <span class="role-badge"><?php echo ucfirst($role); ?></span>
                    </div>
                    <?php if ($role === 'owner'): ?>
                        <a href="inbox.php" class="nav-link" title="Customer Inquiries"><i class="fas fa-inbox"></i> Inbox</a>
                    <?php endif; ?>
                    <a href="logout.php" class="btn-card" style="background: rgba(239, 68, 68, 0.15); color: #fca5a5; border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="fas fa-power-off"></i> Logout
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <main class="marketplace-wrapper">
        <div class="marketplace-head">
            <div class="head-titles">
                <h1>Vehicle Spare Parts Marketplace</h1>
                <p>Browse authentic spares, verify vehicle fitment, chat directly with shops, and hold items for 24 hours.</p>
            </div>
            <?php if ($role === 'owner'): ?>
                <a href="add_item.php" class="btn-add-item">
                    <i class="fas fa-plus-circle"></i> Add Spare Part
                </a>
            <?php endif; ?>
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

        <!-- PROMPT MODAL WHEN ITEM IS SAVED -->
        <?php if ($saved_prompt_item): ?>
            <div class="prompt-modal-overlay" id="savePromptModal">
                <div class="prompt-modal-card">
                    <div class="prompt-modal-icon">
                        <i class="fas fa-bookmark"></i>
                    </div>
                    <h3>Spare Part Saved!</h3>
                    <p>
                        You saved <strong><?php echo htmlspecialchars($saved_prompt_item['name']); ?></strong>.<br>
                        Would you like to message <strong><?php echo htmlspecialchars($saved_prompt_item['shop_name']); ?></strong> directly about pricing, installation, or pickup?
                    </p>
                    <div class="prompt-modal-btns">
                        <a href="chat.php?supplier_id=<?php echo $saved_prompt_item['supplier_id']; ?>&item_id=<?php echo $saved_prompt_item['id']; ?>" class="btn-modal-chat">
                            <i class="fas fa-comments"></i> Message Shop Owner
                        </a>
                        <button type="button" class="btn-modal-close" onclick="document.getElementById('savePromptModal').style.display='none'">
                            Keep Browsing
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- SEARCH & MODEL FILTER BAR -->
        <div class="controls-card">
            <form action="marketplace.php" method="GET" class="search-form-row">
                <div class="search-input-box">
                    <i class="fas fa-magnifying-glass"></i>
                    <input type="text" name="search" placeholder="Search by Vehicle Model (e.g. Toyota Aqua, Prius) or Spare Part (Brake Pads)..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                </div>
                <button type="submit" class="btn-search">
                    <i class="fas fa-filter"></i> Search Spares
                </button>
            </form>

            <div class="filter-pills-row">
                <span class="filter-label"><i class="fas fa-car-side"></i> Vehicle Models:</span>
                <a href="marketplace.php" class="pill-chip <?php echo empty($search) ? 'active' : ''; ?>">All Vehicles</a>
                <a href="marketplace.php?search=Toyota+Aqua" class="pill-chip <?php echo ($search === 'Toyota Aqua') ? 'active' : ''; ?>">Toyota Aqua</a>
                <a href="marketplace.php?search=Toyota+Prius" class="pill-chip <?php echo ($search === 'Toyota Prius') ? 'active' : ''; ?>">Toyota Prius</a>
                <a href="marketplace.php?search=Honda+Vezel" class="pill-chip <?php echo ($search === 'Honda Vezel') ? 'active' : ''; ?>">Honda Vezel</a>
                <a href="marketplace.php?search=Suzuki+Wagon+R" class="pill-chip <?php echo ($search === 'Suzuki Wagon R') ? 'active' : ''; ?>">Suzuki Wagon R</a>
                <a href="marketplace.php?search=Nissan+Leaf" class="pill-chip <?php echo ($search === 'Nissan Leaf') ? 'active' : ''; ?>">Nissan Leaf</a>
            </div>
        </div>

        <?php if ($is_logged_in): ?>
            <div class="tabs-row">
                <a href="marketplace.php" class="tab-btn <?php echo ($view_tab === 'all') ? 'active' : ''; ?>">
                    <i class="fas fa-layer-group"></i> All Spare Parts
                </a>
                <?php if ($role === 'customer'): ?>
                    <a href="marketplace.php?tab=saved" class="tab-btn <?php echo ($view_tab === 'saved') ? 'active' : ''; ?>">
                        <i class="fas fa-bookmark"></i> Saved Items
                    </a>
                    <a href="marketplace.php?tab=reserved" class="tab-btn <?php echo ($view_tab === 'reserved') ? 'active' : ''; ?>">
                        <i class="fas fa-clock"></i> My 24h Reservations
                    </a>
                <?php elseif ($role === 'owner'): ?>
                    <a href="marketplace.php?tab=my_items" class="tab-btn <?php echo ($view_tab === 'my_items') ? 'active' : ''; ?>">
                        <i class="fas fa-boxes-stacked"></i> My Inventory
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="parts-grid">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <?php
                        $full_name = $row['Itemname'];
                        $vehicle_model = 'Universal Fit';
                        $part_name = $full_name;

                        if (strpos($full_name, ' - ') !== false) {
                            $parts = explode(' - ', $full_name, 2);
                            $vehicle_model = trim($parts[0]);
                            $part_name = trim($parts[1]);
                        } elseif (strpos($full_name, ' | ') !== false) {
                            $parts = explode(' | ', $full_name, 2);
                            $vehicle_model = trim($parts[0]);
                            $part_name = trim($parts[1]);
                        }

                        $is_in_stock = ($row['availabilitystatus'] === 'IN STOCK' && $row['quantity'] > 0);
                        $is_my_item = ($role === 'owner' && $row['SupplierID'] == $user_id);
                        $avg_rating = round(floatval($row['avg_rating'] ?? 0), 1);
                        $review_count = intval($row['review_count'] ?? 0);
                        $item_image = (!empty($row['image_path']) && file_exists($row['image_path'])) ? $row['image_path'] : 'default.jpg';
                    ?>
                    <div class="item-card">
                        <div class="item-card-img-wrap">
                            <img src="<?php echo htmlspecialchars($item_image); ?>" alt="<?php echo htmlspecialchars($part_name); ?>" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?auto=format&fit=crop&w=600&q=80';">
                            <span class="status-badge <?php echo $is_in_stock ? 'in-stock' : 'out-stock'; ?>">
                                <?php echo $is_in_stock ? 'IN STOCK' : 'OUT OF STOCK'; ?>
                            </span>
                        </div>

                        <div class="item-card-body">
                            <div class="vehicle-model-pill">
                                <i class="fas fa-car-side"></i> <?php echo htmlspecialchars($vehicle_model); ?>
                            </div>

                            <h3 class="item-title"><?php echo htmlspecialchars($part_name); ?></h3>

                            <div class="shop-info-row">
                                <i class="fas fa-store"></i>
                                <span><?php echo htmlspecialchars($row['Shopname']); ?></span>
                            </div>

                            <div class="rating-strip">
                                <div class="stars-gold">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <i class="<?php echo ($i <= round($avg_rating)) ? 'fas' : 'far'; ?> fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <span class="rating-text">
                                    <?php if ($review_count > 0): ?>
                                        <strong><?php echo $avg_rating; ?></strong> (<?php echo $review_count; ?> <?php echo ($review_count === 1) ? 'review' : 'reviews'; ?>)
                                    <?php else: ?>
                                        <span style="color: var(--text-subtle);">No reviews yet</span>
                                    <?php endif; ?>
                                </span>
                            </div>

                            <div class="item-price-row">
                                <div>
                                    <div class="price-val">LKR <?php echo number_format($row['Price'], 2); ?></div>
                                </div>
                                <div class="qty-val">
                                    Qty: <strong><?php echo $row['quantity']; ?></strong> available
                                </div>
                            </div>

                            <?php if ($role === 'customer'): ?>
                                <div class="card-actions-row">
                                    <form method="POST" action="marketplace.php" style="flex:1;">
                                        <input type="hidden" name="action" value="reserve">
                                        <input type="hidden" name="item_id" value="<?php echo $row['Itemid']; ?>">
                                        <button type="submit" class="btn-card btn-reserve" style="width: 100%;" <?php echo !$is_in_stock ? 'disabled style="opacity:0.5;"' : ''; ?>>
                                            <i class="fas fa-clock"></i> Reserve 24h
                                        </button>
                                    </form>

                                    <form method="POST" action="marketplace.php" style="flex:1;">
                                        <input type="hidden" name="action" value="save">
                                        <input type="hidden" name="item_id" value="<?php echo $row['Itemid']; ?>">
                                        <button type="submit" class="btn-card btn-save" style="width: 100%;">
                                            <i class="fas fa-bookmark"></i> Save
                                        </button>
                                    </form>
                                </div>

                                <div class="card-actions-full">
                                    <a href="chat.php?supplier_id=<?php echo $row['SupplierID']; ?>&item_id=<?php echo $row['Itemid']; ?>" class="btn-card btn-chat">
                                        <i class="fas fa-comments"></i> Message Shop
                                    </a>
                                    <a href="product-details.php?id=<?php echo $row['Itemid']; ?>" class="btn-card btn-details">
                                        <i class="fas fa-circle-info"></i> Details
                                    </a>
                                </div>

                            <?php elseif ($is_my_item): ?>
                                <div class="card-actions-row">
                                    <a href="edit_item.php?id=<?php echo $row['Itemid']; ?>" class="btn-card btn-owner-edit">
                                        <i class="fas fa-pen-to-square"></i> Edit Part
                                    </a>
                                    <form method="POST" action="marketplace.php" style="flex:1;" onsubmit="return confirm('Are you sure you want to delete this spare part from your inventory?');">
                                        <input type="hidden" name="action" value="delete_item">
                                        <input type="hidden" name="item_id" value="<?php echo $row['Itemid']; ?>">
                                        <button type="submit" class="btn-card btn-owner-delete" style="width: 100%;">
                                            <i class="fas fa-trash-can"></i> Delete
                                        </button>
                                    </form>
                                </div>
                                <div class="card-actions-full">
                                    <a href="product-details.php?id=<?php echo $row['Itemid']; ?>" class="btn-card btn-details">
                                        <i class="fas fa-eye"></i> View Listing
                                    </a>
                                </div>

                            <?php else: ?>
                                <div class="card-actions-full">
                                    <a href="product-details.php?id=<?php echo $row['Itemid']; ?>" class="btn-card btn-details">
                                        <i class="fas fa-circle-info"></i> View Details
                                    </a>
                                    <a href="login.php" class="btn-card btn-reserve">
                                        <i class="fas fa-user-lock"></i> Sign In to Reserve
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-placeholder">
                    <i class="fas fa-box-open"></i>
                    <h3>No Spare Parts Found</h3>
                    <p>No items match your search filter. Try clearing the search or select another vehicle model.</p>
                    <a href="marketplace.php" class="btn-search" style="display:inline-flex; margin-top: 15px;">
                        <i class="fas fa-rotate-left"></i> View All Parts
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>