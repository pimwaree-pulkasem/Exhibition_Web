<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="register.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
<header class="header">
        <div class="header-container">
            <div class="logo-section">
                <div class="logo">
                    <a href="../homepage/homepage.php">
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
  <center>
    <div class="container">
      <div class="profile-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24">
          <path
            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 3c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22 0.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z" />
        </svg>
      </div>
      <h1 id="registerTitle">Register</h1>
      <form action="../Controller/auth.php" name="register" method="POST">
        <input type="text" id="name" name="name" placeholder="Name">
        <input type="text" id="surname" name="surname" placeholder="Surname">
        <input type="email" id="email" name="email" placeholder="Email">
        <div class="password-input">
          <input type="password" name ="password" placeholder="Password" id="password">
          <i class="fas fa-eye password-toggle" id="password-toggle"></i>
       </div>

        <button type="submit" name="register" id="registerBtn" onclick="return validateRegisterForm()">Register</button>
      </form>
    </div>
  </center>
  <script src="register.js"></script>
</body>
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
    <script src="register.js"></script>
    <script src="../textMap.js"></script>
</html>