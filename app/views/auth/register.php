<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - GearGo</title>
    <!-- Google Fonts & FontAwesome 6 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- COMPLETE SELF-CONTAINED CREATIVE STYLING -->
    <style>
        :root {
            --bg-body: #0d131f;
            --bg-card: #131c2c;
            --bg-card-inner: #1c273c;
            --accent-orange: #f59e0b;
            --accent-gold: #fbbf24;
            --accent-hover: #d97706;
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
            background-color: #0b111e;
            background-image: 
                radial-gradient(1100px circle at 50% -120px, #1a2742 0%, #0d1424 50%, #060910 100%);
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
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
            top: -150px;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.18) 0%, rgba(245, 158, 11, 0) 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* TOP NAVIGATION BAR */
        header.top-navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: rgba(13, 19, 31, 0.92);
            backdrop-filter: blur(16px);
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
        }
        .nav-link:hover, .nav-link.active {
            color: var(--text-light);
            background: rgba(255, 255, 255, 0.06);
        }

        /* REGISTRATION CONTAINER */
        .register-container {
            position: relative;
            max-width: 620px;
            width: 100%;
            margin: 45px auto 70px auto;
            padding: 0 20px;
            z-index: 1;
        }

        .auth-card {
            background: var(--bg-card);
            border: 1px solid var(--border-card);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-badge {
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--accent-orange);
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.2);
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 12px;
        }
        .auth-title {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .auth-desc {
            color: var(--text-muted);
            font-size: 14px;
            margin-top: 6px;
        }

        /* ROLE TOGGLE TABS */
        .role-selector-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            background: #090d16;
            padding: 6px;
            border-radius: 16px;
            border: 1px solid var(--border-card);
            margin-bottom: 25px;
        }
        .role-btn {
            background: transparent;
            border: none;
            color: var(--text-muted);
            padding: 12px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s ease;
        }
        .role-btn.active {
            background: var(--bg-card-inner);
            color: #ffffff;
            border: 1px solid rgba(245, 158, 11, 0.4);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.4);
        }
        .role-btn.active i {
            color: var(--accent-orange);
        }

        /* FORM ELEMENTS */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }
        .form-group label span.req {
            color: var(--accent-orange);
        }
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 14px;
            color: var(--text-subtle);
            font-size: 14px;
        }
        .form-control {
            width: 100%;
            background: #0a0e17;
            border: 1px solid var(--border-card);
            color: #ffffff;
            padding: 12px 14px 12px 40px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s ease;
        }
        .form-control:focus {
            border-color: var(--accent-orange);
        }
        .password-toggle-btn {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: var(--text-subtle);
            cursor: pointer;
            font-size: 14px;
        }

        /* SUBSCRIPTION TICKBOX BOX (ONLY FOR SHOP OWNERS) */
        .subscription-box {
            display: none;
            background: rgba(245, 158, 11, 0.06);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 22px;
        }
        .sub-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }
        .sub-header h4 {
            font-size: 14px;
            font-weight: 700;
            color: var(--accent-gold);
        }
        .subscription-box p {
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 14px;
        }
        .sub-check-label {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #ffffff;
            cursor: pointer;
            user-select: none;
        }
        .sub-check-label input[type="checkbox"] {
            margin-top: 3px;
            width: 18px;
            height: 18px;
            accent-color: var(--accent-orange);
            cursor: pointer;
        }

        /* PAYMENT DETAILS SUB-WINDOW (CARD FORM) */
        .payment-window {
            margin-top: 18px;
            background: #0d1322;
            border: 1px solid rgba(245, 158, 11, 0.45);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4), 0 0 15px rgba(245, 158, 11, 0.1);
            animation: fadeInSlide 0.3s ease-out;
        }
        @keyframes fadeInSlide {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .payment-window-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 8px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .payment-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 700;
            color: #10b981;
            background: rgba(16, 185, 129, 0.12);
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid rgba(16, 185, 129, 0.25);
        }
        .card-icons {
            display: flex;
            gap: 8px;
            color: var(--text-muted);
            font-size: 20px;
        }
        .card-icons i:hover {
            color: var(--accent-orange);
        }
        .payment-summary-pill {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(245, 158, 11, 0.1);
            border: 1px dashed rgba(245, 158, 11, 0.35);
            padding: 8px 14px;
            border-radius: 8px;
            margin-top: 12px;
            font-size: 12.5px;
            color: #e2e8f0;
        }
        .payment-summary-pill strong {
            color: var(--accent-gold);
            font-size: 13.5px;
        }
        .payment-disclaimer {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 11.5px;
            color: var(--text-subtle);
            margin-top: 14px;
            line-height: 1.4;
        }
        .payment-disclaimer i {
            color: var(--accent-orange);
            font-size: 12px;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: #0b0f19;
            font-size: 15px;
            font-weight: 700;
            padding: 14px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 25px var(--accent-glow);
            transition: all 0.25s ease;
            margin-top: 10px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(245, 158, 11, 0.5);
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .auth-footer-text {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: var(--text-muted);
        }
        .auth-footer-text a {
            color: var(--accent-orange);
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
            .auth-card { padding: 25px 20px; }
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

    <main class="register-container">
        <div class="auth-card">
            <div class="auth-header">
                <span class="auth-badge">Join GearGo Network</span>
                <h1 class="auth-title">Create Your Account</h1>
                <p class="auth-desc">Register as a Vehicle Owner or list your Spare Parts Shop</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>

            <!-- Role Selector Tabs -->
            <div class="role-selector-wrap">
                <button type="button" class="role-btn active" id="tabCustomer" onclick="selectRole('customer')">
                    <i class="fas fa-car"></i> Driver / Customer
                </button>
                <button type="button" class="role-btn" id="tabOwner" onclick="selectRole('owner')">
                    <i class="fas fa-store"></i> Spare Parts Shop
                </button>
            </div>

            <form action="register.php" method="POST" id="registerForm">
                <input type="hidden" name="account_type" id="accountTypeInput" value="customer">

                <div class="form-row">
                    <div class="form-group">
                        <label>First Name <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="firstname" class="form-control" placeholder="Alex" required value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text" name="lastname" class="form-control" placeholder="Perera" required value="<?php echo htmlspecialchars($_POST['lastname'] ?? ''); ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email Address <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-control" placeholder="alex@example.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Phone Number (10 Digits) <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" name="phonenumber" class="form-control" placeholder="0771234567" maxlength="10" required value="<?php echo htmlspecialchars($_POST['phonenumber'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Customer Specific Address Field -->
                <div class="form-group" id="customerAddressGroup">
                    <label>Residential / Garage Address <span class="req">*</span></label>
                    <div class="input-wrap">
                        <i class="fas fa-location-dot input-icon"></i>
                        <input type="text" name="address" id="custAddressInput" class="form-control" placeholder="No. 45, Kandy Road, Kiribathgoda" value="<?php echo htmlspecialchars($_POST['address'] ?? ''); ?>">
                    </div>
                </div>

                <!-- Shop Owner Specific Fields -->
                <div id="shopFields" style="display: none;">
                    <div class="form-group">
                        <label>Shop Name <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-store input-icon"></i>
                            <input type="text" name="shopname" id="shopNameInput" class="form-control" placeholder="e.g., Colombo Auto Spares" value="<?php echo htmlspecialchars($_POST['shopname'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Shop Address (Used for Google Maps) <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-map-pin input-icon"></i>
                            <input type="text" name="shopaddress" id="shopAddressInput" class="form-control" placeholder="e.g., No. 120, Panchikawatta Road, Colombo" value="<?php echo htmlspecialchars($_POST['shopaddress'] ?? ''); ?>">
                        </div>
                    </div>

                    <!-- MANDATORY SUBSCRIPTION TICKBOX FOR SHOP OWNERS -->
                    <div class="subscription-box" id="subscriptionBox" style="display: block;">
                        <div class="sub-header">
                            <i class="fas fa-gem" style="color: var(--accent-orange);"></i>
                            <h4>Shop Owner Monthly Subscription</h4>
                        </div>
                        <p>Verified shop owners enjoy unlimited spare parts listing, direct customer chat, and automated 24-hour reservation management on GearGo for a monthly fee of <strong>LKR 2,000.00</strong>.</p>
                        
                        <label class="sub-check-label">
                            <input type="checkbox" name="subscription_agree" id="subscriptionAgree" value="1" <?php echo !empty($_POST['subscription_agree']) ? 'checked' : ''; ?>>
                            <span>I agree to pay the monthly subscription fee of <strong>LKR 2,000</strong> to operate my shop on GearGo. <span class="req">*</span></span>
                        </label>

                        <!-- DYNAMIC CARD PAYMENT SUB-WINDOW (REVEALED AFTER TICKING BOX) -->
                        <div class="payment-window" id="paymentDetailsWindow" style="display: none;">
                            <div class="payment-window-header">
                                <div class="payment-badge">
                                    <i class="fas fa-shield-halved"></i> Secure 256-Bit SSL Checkout
                                </div>
                                <div class="card-icons">
                                    <i class="fab fa-cc-visa" title="Visa"></i>
                                    <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                                    <i class="fab fa-cc-amex" title="Amex"></i>
                                </div>
                            </div>

                            <div class="payment-summary-pill">
                                <span>Subscription Recurring Plan:</span>
                                <strong>LKR 2,000.00 / month</strong>
                            </div>

                            <div class="form-group" style="margin-top: 15px;">
                                <label>Cardholder Name <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <i class="fas fa-user-tag input-icon"></i>
                                    <input type="text" name="card_name" id="cardNameInput" class="form-control" placeholder="KAMAL PERERA" value="<?php echo htmlspecialchars($_POST['card_name'] ?? ''); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Card Number <span class="req">*</span></label>
                                <div class="input-wrap">
                                    <i class="fas fa-credit-card input-icon"></i>
                                    <input type="text" name="card_number" id="cardNumberInput" class="form-control" placeholder="0000 0000 0000 0000" maxlength="19" value="<?php echo htmlspecialchars($_POST['card_number'] ?? ''); ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>Expiry Date <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-calendar-days input-icon"></i>
                                        <input type="text" name="card_expiry" id="cardExpiryInput" class="form-control" placeholder="MM/YY" maxlength="5" value="<?php echo htmlspecialchars($_POST['card_expiry'] ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>CVV / CVC <span class="req">*</span></label>
                                    <div class="input-wrap">
                                        <i class="fas fa-lock input-icon"></i>
                                        <input type="password" name="card_cvv" id="cardCvvInput" class="form-control" placeholder="123" maxlength="4" value="<?php echo htmlspecialchars($_POST['card_cvv'] ?? ''); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="payment-disclaimer">
                                <i class="fas fa-circle-check"></i> Your card will be billed LKR 2,000.00 upon registration and monthly thereafter. Cancel anytime from shop dashboard.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Password <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="passInput" class="form-control" placeholder="Min 6 chars" required>
                            <button type="button" class="password-toggle-btn" onclick="togglePass('passInput', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password <span class="req">*</span></label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="confirm_password" id="confirmPassInput" class="form-control" placeholder="Re-enter password" required>
                            <button type="button" class="password-toggle-btn" onclick="togglePass('confirmPassInput', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="auth-footer-text">
                Already have an account? <a href="login.php">Sign In here &rarr;</a>
            </div>
        </div>
    </main>

    <script>
        function selectRole(role) {
            const tabCustomer = document.getElementById('tabCustomer');
            const tabOwner = document.getElementById('tabOwner');
            const accountTypeInput = document.getElementById('accountTypeInput');
            const customerAddressGroup = document.getElementById('customerAddressGroup');
            const shopFields = document.getElementById('shopFields');
            const custAddressInput = document.getElementById('custAddressInput');
            const shopNameInput = document.getElementById('shopNameInput');
            const shopAddressInput = document.getElementById('shopAddressInput');
            const subscriptionAgree = document.getElementById('subscriptionAgree');

            if (role === 'owner') {
                tabCustomer.classList.remove('active');
                tabOwner.classList.add('active');
                accountTypeInput.value = 'owner';
                customerAddressGroup.style.display = 'none';
                custAddressInput.removeAttribute('required');
                shopFields.style.display = 'block';
                shopNameInput.setAttribute('required', 'required');
                shopAddressInput.setAttribute('required', 'required');
                subscriptionAgree.setAttribute('required', 'required');
                updatePaymentWindow();
            } else {
                tabOwner.classList.remove('active');
                tabCustomer.classList.add('active');
                accountTypeInput.value = 'customer';
                customerAddressGroup.style.display = 'block';
                custAddressInput.setAttribute('required', 'required');
                shopFields.style.display = 'none';
                shopNameInput.removeAttribute('required');
                shopAddressInput.removeAttribute('required');
                subscriptionAgree.removeAttribute('required');
                hidePaymentWindow();
            }
        }

        function updatePaymentWindow() {
            const subscriptionAgree = document.getElementById('subscriptionAgree');
            const paymentWindow = document.getElementById('paymentDetailsWindow');
            const cardName = document.getElementById('cardNameInput');
            const cardNumber = document.getElementById('cardNumberInput');
            const cardExpiry = document.getElementById('cardExpiryInput');
            const cardCvv = document.getElementById('cardCvvInput');

            if (subscriptionAgree && subscriptionAgree.checked) {
                paymentWindow.style.display = 'block';
                cardName.setAttribute('required', 'required');
                cardNumber.setAttribute('required', 'required');
                cardExpiry.setAttribute('required', 'required');
                cardCvv.setAttribute('required', 'required');
            } else if (paymentWindow) {
                paymentWindow.style.display = 'none';
                cardName.removeAttribute('required');
                cardNumber.removeAttribute('required');
                cardExpiry.removeAttribute('required');
                cardCvv.removeAttribute('required');
            }
        }

        function hidePaymentWindow() {
            const paymentWindow = document.getElementById('paymentDetailsWindow');
            const cardName = document.getElementById('cardNameInput');
            const cardNumber = document.getElementById('cardNumberInput');
            const cardExpiry = document.getElementById('cardExpiryInput');
            const cardCvv = document.getElementById('cardCvvInput');

            if (paymentWindow) paymentWindow.style.display = 'none';
            if (cardName) cardName.removeAttribute('required');
            if (cardNumber) cardNumber.removeAttribute('required');
            if (cardExpiry) cardExpiry.removeAttribute('required');
            if (cardCvv) cardCvv.removeAttribute('required');
        }

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

        // Initialize state on load & bind formatters
        document.addEventListener('DOMContentLoaded', () => {
            const currentRole = '<?php echo isset($_POST['account_type']) ? $_POST['account_type'] : 'customer'; ?>';
            selectRole(currentRole);

            const subscriptionAgree = document.getElementById('subscriptionAgree');
            if (subscriptionAgree) {
                subscriptionAgree.addEventListener('change', updatePaymentWindow);
            }

            // Cardholder Name uppercase formatter
            const cardName = document.getElementById('cardNameInput');
            if (cardName) {
                cardName.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            }

            // Card Number 16-digit spacing formatter (0000 0000 0000 0000)
            const cardNumber = document.getElementById('cardNumberInput');
            if (cardNumber) {
                cardNumber.addEventListener('input', function() {
                    let val = this.value.replace(/\D/g, '').slice(0, 16);
                    let formatted = val.match(/.{1,4}/g)?.join(' ') || val;
                    this.value = formatted;
                });
            }

            // Expiry Date MM/YY formatter
            const cardExpiry = document.getElementById('cardExpiryInput');
            if (cardExpiry) {
                cardExpiry.addEventListener('input', function() {
                    let val = this.value.replace(/\D/g, '').slice(0, 4);
                    if (val.length >= 3) {
                        this.value = val.slice(0, 2) + '/' + val.slice(2);
                    } else {
                        this.value = val;
                    }
                });
            }

            // CVV numbers only formatter (max 4)
            const cardCvv = document.getElementById('cardCvvInput');
            if (cardCvv) {
                cardCvv.addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '').slice(0, 4);
                });
            }
        });
    </script>
</body>
</html>