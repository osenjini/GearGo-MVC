<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Owner Inbox - GearGo</title>
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

        .inbox-wrapper {
            position: relative; max-width: 1000px; width: 100%;
            margin: 35px auto 70px auto; padding: 0 20px; z-index: 1; flex: 1;
        }
        .dashboard-header-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; padding: 28px 32px; margin-bottom: 25px;
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 16px;
        }
        .dashboard-header-card h1 { font-size: 24px; font-weight: 800; color: #ffffff; }
        .dashboard-header-card p { color: var(--text-muted); font-size: 13.5px; margin-top: 4px; }

        .btn-back-inv {
            background: var(--bg-card-inner); border: 1px solid var(--border-card);
            color: #ffffff; padding: 10px 18px; border-radius: 20px;
            font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-back-inv:hover { color: var(--accent-orange); border-color: var(--accent-orange); }

        .inbox-table-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
        }
        .inbox-table { width: 100%; border-collapse: collapse; }
        .inbox-table th {
            background: var(--bg-card-inner); padding: 14px 20px;
            text-align: left; font-size: 12.5px; text-transform: uppercase;
            letter-spacing: 0.8px; color: var(--text-subtle); border-bottom: 1px solid var(--border-card);
        }
        .inbox-table td {
            padding: 16px 20px; border-bottom: 1px solid var(--border-subtle);
            font-size: 14px; vertical-align: middle;
        }
        .inbox-table tr:hover td { background: rgba(255, 255, 255, 0.02); }

        .btn-open-chat {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-weight: 700; font-size: 12.5px;
            padding: 8px 16px; border-radius: 20px; display: inline-flex;
            align-items: center; gap: 6px;
        }
        .empty-inbox { text-align: center; padding: 60px 20px; color: var(--text-muted); }
        .empty-inbox i { font-size: 44px; color: var(--accent-orange); margin-bottom: 14px; display: block; }
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
                <a href="inbox.php" class="nav-link active"><i class="fas fa-inbox"></i> Inbox</a>
                <a href="logout.php" class="nav-link" style="color: var(--danger);"><i class="fas fa-power-off"></i> Logout</a>
            </nav>
        </div>
    </header>

    <main class="inbox-wrapper">
        <div class="dashboard-header-card">
            <div>
                <h1><i class="fas fa-inbox" style="color: var(--accent-orange); margin-right: 8px;"></i> Shop Owner Inbox</h1>
                <p>Respond to customer inquiries and fitment questions for your spare parts inventory.</p>
            </div>
            <div>
                <a href="marketplace.php" class="btn-back-inv">
                    <i class="fas fa-boxes-stacked"></i> View Inventory
                </a>
            </div>
        </div>

        <div class="inbox-table-card">
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="inbox-table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Inquired Spare Part</th>
                            <th>Phone / Contact</th>
                            <th>Last Message</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong style="color:#fff;"><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></strong>
                                    <div style="font-size:12px; color:var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?></div>
                                </td>
                                <td>
                                    <span style="color: var(--accent-gold); font-weight:600;">
                                        <?php echo htmlspecialchars($row['Itemname']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span style="color: var(--text-muted);"><i class="fas fa-phone" style="font-size:11px; margin-right:4px;"></i> <?php echo htmlspecialchars($row['phonenumber']); ?></span>
                                </td>
                                <td>
                                    <span style="font-size: 12.5px; color: var(--text-subtle);">
                                        <?php echo !empty($row['latest_time']) ? date('M d, g:i a', strtotime($row['latest_time'])) : 'Recent'; ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="chat.php?supplier_id=<?php echo $supplier_id; ?>&customer_id=<?php echo $row['CustomerID']; ?>&item_id=<?php echo $row['Itemid']; ?>" class="btn-open-chat">
                                        <i class="fas fa-comments"></i> Open Chat
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-inbox">
                    <i class="far fa-envelope-open"></i>
                    <h3 style="color:#fff; margin-bottom: 6px;">No Customer Messages Yet</h3>
                    <p>When customers save your parts or click "Message Shop", their conversations will appear here.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>