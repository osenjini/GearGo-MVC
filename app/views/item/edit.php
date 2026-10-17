<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Spare Part #<?php echo $item_id; ?> - GearGo</title>
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
        .nav-link:hover, .nav-link.active { color: var(--text-light); background: rgba(255, 255, 255, 0.06); }

        .form-page-container {
            position: relative; max-width: 680px; width: 100%;
            margin: 45px auto 70px auto; padding: 0 20px; z-index: 1; flex: 1;
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
        .auth-title { font-size: 26px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-muted); margin-bottom: 8px;
        }
        .form-group label span.req { color: var(--accent-orange); }

        .input-wrap { position: relative; display: flex; align-items: center; }
        .input-icon { position: absolute; left: 14px; color: var(--text-subtle); font-size: 14px; }
        .form-control {
            width: 100%; background: #0a0e17; border: 1px solid var(--border-card);
            color: #ffffff; padding: 13px 14px 13px 40px; border-radius: 10px;
            font-family: inherit; font-size: 14px; outline: none;
        }
        .form-control:focus { border-color: var(--accent-orange); }

        .preview-thumb-box {
            display: flex; align-items: center; gap: 16px;
            background: #0a0e17; padding: 12px; border-radius: 12px;
            border: 1px solid var(--border-card); margin-bottom: 12px;
        }
        .preview-thumb-box img { width: 70px; height: 70px; object-fit: cover; border-radius: 8px; }

        .btn-submit {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-size: 15px; font-weight: 700; padding: 14px;
            border-radius: 30px; border: none; cursor: pointer; width: 100%;
            display: flex; align-items: center; justify-content: center; gap: 10px;
            box-shadow: 0 8px 25px var(--accent-glow); transition: all 0.25s ease;
        }
        .btn-submit:hover { transform: translateY(-2px); }

        .btn-delete-item {
            background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5; font-size: 14px; font-weight: 700; padding: 12px;
            border-radius: 30px; width: 100%; cursor: pointer; display: flex;
            align-items: center; justify-content: center; gap: 8px; margin-top: 12px;
        }
        .btn-delete-item:hover { background: var(--danger); color: #ffffff; }

        .alert-error {
            background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
            font-size: 13.5px; display: flex; align-items: center; gap: 10px;
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
                <a href="inbox.php" class="nav-link"><i class="fas fa-inbox"></i> Inbox</a>
                <a href="marketplace.php" class="nav-link active"><i class="fas fa-store"></i> Shop Inventory</a>
            </nav>
        </div>
    </header>

    <main class="form-page-container">
        <div class="auth-card">
            <div class="auth-header">
                <span class="auth-badge"><i class="fas fa-pen-to-square"></i> Inventory Management</span>
                <h1 class="auth-title">Edit Spare Part (#<?php echo str_pad($item_id, 4, '0', STR_PAD_LEFT); ?>)</h1>
                <p style="color: var(--text-muted); font-size: 13px; margin-top: 4px;">Update quantity, price, or vehicle fitment details</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form action="edit_item.php?id=<?php echo $item_id; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="update">

                <div class="form-group">
                    <label>Vehicle Model / Compatibility <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-car input-icon"></i>
                        <input type="text" name="vehicle_model" class="form-control" value="<?php echo htmlspecialchars($existing_vehicle_model); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Spare Part Name <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-wrench input-icon"></i>
                        <input type="text" name="part_name" class="form-control" value="<?php echo htmlspecialchars($existing_part_name); ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Price (LKR) <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-tag input-icon"></i>
                            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $item['Price']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Stock Quantity <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-cubes input-icon"></i>
                            <input type="number" name="quantity" class="form-control" value="<?php echo $item['quantity']; ?>" min="0" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Availability Status</label>
                    <div class="input-wrap">
                        <i class="fas fa-toggle-on input-icon"></i>
                        <select name="status" class="form-control" style="padding-left: 40px; cursor: pointer;">
                            <option value="IN STOCK" <?php echo ($item['availabilitystatus'] === 'IN STOCK') ? 'selected' : ''; ?>>IN STOCK</option>
                            <option value="OUT OF STOCK" <?php echo ($item['availabilitystatus'] === 'OUT OF STOCK') ? 'selected' : ''; ?>>OUT OF STOCK</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Current Photo</label>
                    <div class="preview-thumb-box">
                        <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="Current Item Photo" onerror="this.onerror=null; this.src='default.jpg';">
                        <div>
                            <strong style="color:#fff; font-size:13px;">Existing Image File</strong>
                            <p style="font-size:12px; color:var(--text-muted);"><?php echo htmlspecialchars($item['image_path']); ?></p>
                        </div>
                    </div>
                    <label style="margin-top: 10px;">Replace Image (Optional)</label>
                    <input type="file" name="item_photo" class="form-control" accept="image/*" style="padding: 10px 14px;">
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-floppy-disk"></i> Update Spare Part
                </button>
            </form>

            <form action="edit_item.php?id=<?php echo $item_id; ?>" method="POST" onsubmit="return confirm('Warning: Are you completely sure you want to delete this spare part? This cannot be undone.');">
                <input type="hidden" name="action" value="delete">
                <button type="submit" class="btn-delete-item">
                    <i class="fas fa-trash-can"></i> Delete This Spare Part
                </button>
            </form>

            <div style="text-align: center; margin-top: 18px;">
                <a href="marketplace.php" style="font-size: 13.5px; color: var(--text-muted); font-weight: 600;">&larr; Cancel and return to Marketplace</a>
            </div>
        </div>
    </main>
</body>
</html>