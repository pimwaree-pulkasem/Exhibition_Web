<!DOCTYPE html>
<html lang="th">

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width = device-width, initial - scale = 1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="Payment.css">
</head>

<body data-user-id="<?php echo $_SESSION['user']['id']; ?>">
<header class="header">
        <div class="header-container">
            <div class="logo-section">
                <div class="logo">
                    <a href="homepage.php">
                        <img src="../Picture/logo3.png" alt="Logo" class="logo">
                    </a>
                </div>
            </div>
            <nav class="nav-section">
                <a href="#" id="helpHeader">Need help?</a>
                <a href="#" id="orgnHeader">Event Organizers</a>
                <div class="dropdown language-dropdown">
                    <button class="dropdownbtn" id="language-toggle">Language</button>
                    <div class="dropdown-content">
                        <a href="#" data-lang="en">EN</a>
                        <a href="#" data-lang="th">TH</a>
                    </div>
                </div>
                <?php if (isset($_SESSION['user'])): ?>
                <div class="user-menu">
                    <div class="dropdown">
                        <span class="dropdownbtn"><?= htmlspecialchars($_SESSION['user']['name']) ?></button>
                        <div class="dropdown-content">
                            <a href="../My Tickets/Mytickets.php" id="myTicketsHeader">My Tickets</a>
                            <a href="../Controller/auth.php?action=logout" id="logoutHeader">Log out</a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <a href="../registerpage/register.php" class="register-link" id="registerHeader">Register |</a>
                <a href="../signInpage/signIn.php" class="signin-link" id="signInHeader">Sign in</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
        <section class="payment-method">
            <h2 id="paymentMeth">Payment method</h2>
            <div class="payment-icons">
                <div class="icon" id="credit-card" onclick="selectPaymentMethod('credit-card')">
                    <div class="gg-credit-card"></div>
                </div>
                <div class="icon" id="prompt-pay" onclick="selectPaymentMethod('prompt-pay')">
                    <img src="../Picture/prompt-pay-logo.png" alt="PromptPay">
                </div>
            </div>
        </section>


        <section class="ticket">
            <h2 id="ticketSection">Ticket</h2>
            <div class="ticket-table">
                <div class="row header">
                    <div class="cell" id="ticketTypeLabel">Ticket type</div>
                    <div class="cell" id="ticketQuantityLabel">Quantity</div>
                    <div class="cell" id="ticketPriceLabel">Price</div>
                </div>
                <div class="row">
                    <div class="cell" id="ticket-type"></div>
                    <div class="cell" id="ticket-quantity"></div>
                    <div class="cell" id="ticket-price"></div>
                </div>
                <div class="row summary">
                    <div class="price-cell" id="ticketSubtotalLabel">Subtotal</div>
                    <div class="price-cell"></div>
                    <div class="price-cell" id="subtotal"></div>
                </div>
                <div class="row summary">
                    <div class="price-cell" id="ticketFeeLabel">Fee</div>
                    <div class="price-cell"></div>
                    <div class="price-cell" id="fee"></div>
                </div>
                <div class="row total">
                    <div class="price-cell" id="ticketTotalLabel">Total</div>
                    <div class="price-cell"></div>
                    <div class="price-cell" id="total"></div>
                </div>
            </div>

            <button class="buy-button" id="buyBtn" disabled>Buy Tickets</button>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <img src="../Picture/logo3.png" alt="Logo" class="footer-logo">
                <select class="country-select">
                    <option value="thailand">
                        <img src="../Picture/thailand.png" alt="Thailand Flag"> Thailand
                    </option>
                </select>
            </div>
            <div class="footer-section">
                <h3 id="helpFooter">Need help?</h3>
                <ul>
                    <li><a href="#" id="faqBuy">How to buy tickets?</a></li>
                    <li><a href="#" id="faqWhere">Where are my tickets?</a></li>
                    <li><a href="#" id="faqUse">How to use e-ticket?</a></li>
                    <li><a href="#" id="helpCenter">Help Center</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 id="customerFooter">Customer Support</h3>
                <ul>
                    <li><img src="../Picture/gmail.png" alt="Email"> <a href="#">support@Exhibition.com</a></li>
                    <li><img src="../Picture/line.png" alt="Line"> <a href="#">@ArtExhibition</a></li>
                    <li><img src="../Picture/facebook.png" alt="Facebook"> <a href="#">Art Exhibition</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 id="forOrgn">For Event Organizers</h3>
                <ul>
                    <li><a href="#" id="ourSolutions">Our Solutions</a></li>
                    <li><a href="#" id="pricing">Pricing</a></li>
                    <li><a href="#" id="contactUs">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 id="legalFooter">Legal</h3>
                <ul>
                    <li><a href="#" id="terms">Terms</a></li>
                    <li><a href="#" id="policy">Policy</a></li>
                    <li><a href="#" id="security">Security</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="Payment.js"></script>
    <script src="../textMap.js"></script>
</body>

</html>