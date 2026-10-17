<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with <?php echo htmlspecialchars(($role === 'customer') ? $shop_name : $customer_name); ?> - GearGo</title>
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

        .chat-app-wrapper {
            position: relative; max-width: 900px; width: 100%;
            margin: 30px auto 40px auto; padding: 0 20px; z-index: 1;
            flex: 1; display: flex; flex-direction: column;
        }
        .chat-card {
            background: var(--bg-card); border: 1px solid var(--border-card);
            border-radius: 24px; display: flex; flex-direction: column;
            height: calc(100vh - 160px); min-height: 520px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5); overflow: hidden;
        }
        .chat-header {
            background: var(--bg-card-inner); border-bottom: 1px solid var(--border-card);
            padding: 18px 24px; display: flex; align-items: center; justify-content: space-between;
        }
        .chat-user-meta { display: flex; align-items: center; gap: 12px; }
        .avatar-circle {
            width: 44px; height: 44px; border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #000; display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800;
        }
        .chat-user-meta h2 { font-size: 16px; font-weight: 700; color: #ffffff; }
        .chat-user-meta p { font-size: 12px; color: var(--text-muted); }

        .item-context-strip {
            background: rgba(245, 158, 11, 0.08); border-bottom: 1px solid rgba(245, 158, 11, 0.2);
            padding: 10px 24px; display: flex; align-items: center; justify-content: space-between;
        }
        .item-context-left {
            display: flex; align-items: center; gap: 10px;
            font-size: 13px; color: var(--accent-gold); font-weight: 600;
        }
        .item-context-price { font-size: 14px; font-weight: 800; color: var(--accent-orange); }

        .chat-messages-area {
            flex: 1; padding: 24px; overflow-y: auto;
            display: flex; flex-direction: column; gap: 16px;
        }
        .bubble-row { display: flex; flex-direction: column; max-width: 72%; }
        .bubble-row.outgoing { align-self: flex-end; align-items: flex-end; }
        .bubble-row.incoming { align-self: flex-start; align-items: flex-start; }

        .chat-bubble {
            padding: 12px 18px; border-radius: 18px; font-size: 14px;
            line-height: 1.5; word-break: break-word;
        }
        .bubble-row.outgoing .chat-bubble {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; font-weight: 600; border-bottom-right-radius: 4px;
        }
        .bubble-row.incoming .chat-bubble {
            background: var(--bg-card-inner); color: #ffffff;
            border: 1px solid var(--border-card); border-bottom-left-radius: 4px;
        }
        .bubble-timestamp { font-size: 10.5px; color: var(--text-subtle); margin-top: 4px; padding: 0 4px; }

        .chat-footer-form {
            background: #090d16; border-top: 1px solid var(--border-card); padding: 16px 20px;
        }
        .input-row { display: flex; gap: 12px; align-items: center; }
        .input-row input {
            flex: 1; background: var(--bg-card); border: 1px solid var(--border-card);
            color: #ffffff; padding: 14px 18px; border-radius: 14px;
            font-family: inherit; font-size: 14px; outline: none;
        }
        .input-row input:focus { border-color: var(--accent-orange); }
        .btn-send {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19; border: none; padding: 14px 24px; border-radius: 14px;
            font-weight: 700; font-size: 14px; cursor: pointer; display: inline-flex;
            align-items: center; gap: 8px; box-shadow: 0 4px 14px var(--accent-glow);
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
                <?php if ($role === 'owner'): ?>
                    <a href="inbox.php" class="nav-link active"><i class="fas fa-inbox"></i> Inbox</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="chat-app-wrapper">
        <div class="chat-card">
            <?php if ($param_error): ?>
                <div style="padding: 60px 20px; text-align: center; color: var(--text-muted); margin: auto;">
                    <i class="fas fa-circle-exclamation" style="font-size: 40px; color: var(--accent-orange); margin-bottom: 12px; display: block;"></i>
                    <h3>Chat Session Not Found</h3>
                    <p style="margin-top: 6px;">Invalid shop owner or customer parameters specified.</p>
                    <a href="marketplace.php" style="color: var(--accent-orange); font-weight: 600; display: inline-block; margin-top: 15px;">&larr; Back to Marketplace</a>
                </div>
            <?php else: ?>
                <div class="chat-header">
                    <div class="chat-user-meta">
                        <div class="avatar-circle">
                            <i class="<?php echo ($role === 'customer') ? 'fas fa-store' : 'fas fa-user'; ?>"></i>
                        </div>
                        <div>
                            <h2><?php echo htmlspecialchars(($role === 'customer') ? $shop_name : $customer_name); ?></h2>
                            <p><?php echo ($role === 'customer') ? 'Verified Spare Parts Supplier' : 'Verified Driver / Buyer'; ?></p>
                        </div>
                    </div>
                    <div>
                        <a href="marketplace.php" style="font-size: 13px; color: var(--accent-orange); font-weight: 600;">
                            <i class="fas fa-arrow-left"></i> Marketplace
                        </a>
                    </div>
                </div>

                <?php if ($item_details): ?>
                    <div class="item-context-strip">
                        <div class="item-context-left">
                            <i class="fas fa-wrench"></i>
                            <span>Item: <strong><?php echo htmlspecialchars($item_details['Itemname']); ?></strong></span>
                        </div>
                        <div class="item-context-price">
                            LKR <?php echo number_format($item_details['Price'], 2); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="chat-messages-area" id="chatArea">
                    <?php if ($messages_res && $messages_res->num_rows > 0): ?>
                        <?php while ($m = $messages_res->fetch_assoc()): ?>
                            <?php
                                $is_outgoing = ($role === 'customer' && $m['sender_type'] === 'customer') || ($role === 'owner' && $m['sender_type'] === 'owner');
                            ?>
                            <div class="bubble-row <?php echo $is_outgoing ? 'outgoing' : 'incoming'; ?>">
                                <div class="chat-bubble">
                                    <?php echo nl2br(htmlspecialchars($m['messagetext'])); ?>
                                </div>
                                <span class="bubble-timestamp">
                                    <?php echo date('M d, g:i a', strtotime($m['Sentdatetime'])); ?>
                                </span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div style="margin: auto; text-align: center; color: var(--text-muted);">
                            <i class="far fa-comments" style="font-size: 40px; color: var(--accent-orange); margin-bottom: 10px; display: block;"></i>
                            <h4 style="color: #fff; margin-bottom: 4px;">Start Your Conversation</h4>
                            <p style="font-size: 13px;">Ask about spare part fitment, warranty, price discounts, or collection time.</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="chat-footer-form">
                    <form action="chat.php?supplier_id=<?php echo $supplier_id; ?>&customer_id=<?php echo $customer_id; ?>&item_id=<?php echo $item_id; ?>" method="POST" class="input-row">
                        <input type="text" name="message" placeholder="Type your message to <?php echo htmlspecialchars(($role === 'customer') ? $shop_name : $customer_name); ?>..." required autocomplete="off" autofocus>
                        <button type="submit" class="btn-send">
                            <i class="fas fa-paper-plane"></i> Send
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chatArea = document.getElementById('chatArea');
            if (chatArea) {
                chatArea.scrollTop = chatArea.scrollHeight;
            }
        });
    </script>
</body>
</html>