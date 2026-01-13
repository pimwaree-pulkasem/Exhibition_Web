<!DOCTYPE html>
<html lang="th">
<?php
  require_once __DIR__ . "/../Controller/auth.php";
  require_once __DIR__ . "/../connect.php";
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $isLoggedIn = isset($_SESSION['user']);
  $capSql = "SELECT * FROM capacitys;";
  $exSql = "SELECT e.Exhibition_id, e.Title, p.Ticket_type, p.Price, 
                    t.Date, t.Time, c.Capacity FROM exhibitions e JOIN prices p ON e.Exhibition_id = p.Exhibition_id
                    JOIN time_slots t ON e.Exhibition_id = t.Exhibition_id JOIN capacitys c ON e.Exhibition_id = c.Exhibition_id AND t.Date = c.Date AND t.Time = c.Time WHERE e.Exhibition_id = 1";
  $sales = $conn->query("SELECT is_open FROM ticket_sales WHERE Exhibition_id = 1");
  $sales_row = $sales->fetch_assoc();
  $is_open = $sales_row['is_open'] ?? false;
  $exhibition = mysqli_query($conn, $exSql);
  $exRow = mysqli_fetch_array($exhibition);
  $capcity = mysqli_query($conn, $capSql);
  $capRow = mysqli_fetch_array($capcity);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $exRow["Title"] ?></title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body data-logged-in="<?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>" data-user-id="<?php echo isset($_SESSION['user']) ? $_SESSION['user']['id'] : 'null'; ?>">
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

    <div class="image-placeholder">
        <div class="slider">
            <img src="../Picture/ex6.jpeg" alt="Image 5">
            <img src="../Picture/ex7.jpeg" alt="Image 1">
            <img src="../Picture/ex2.jpeg" alt="Image 3">
            <img src="../Picture/ex8.jpeg" alt="Image 4">
            <img src="../Picture/ex9.jpeg" alt="Image 6">
        </div>
        <button class="prev-btn">&lt;</button>
        <button class="next-btn">&gt;</button>
    </div>

    <div class="text-container-outer">
        <div class="text-container">
            <h1>
                <?php echo $exRow["Title"]; ?>
            </h1>
        </div>
    </div>

    <div class="event-card-container">
        <div class="event-card">
            <div class="date">
                <div class="day">4-6</div>
                <div class="month">April</div>
                <div class="year">2024</div>
            </div>
            <div class="event-title">
                <?php echo $exRow["Title"]; ?>
            </div>
        </div>
    </div>

    <div class="exhibition-details-container">
        <div class="exhibition-details">
            <div class="exhibition-title-detail">
                <p id="exhibition_intro_p1">
                    Embark on a journey into <strong>'World of Art'</strong>, an exhibition showcasing a diverse range of artworks from both local and international artists. This exhibition will take you through the various facets of the art world, from paintings and sculptures to photography, mixed media, and installations, offering a fresh perspective on art appreciation.
                </p>
                <p id="exhibition_intro_p2">
                    <strong>'World of Art'</strong> is more than just an art exhibition; it's a space for creative exchange and inspiration. This exhibition will provide opportunities to get to know the artists and their works intimately through talks, demonstrations, and other activities that will deepen your understanding of the creative process and the artists' concepts.
                </p>
                <p id="exhibition_intro_p3">
                    Whether you're an art collector, an artist, or simply an art enthusiast, <strong>'World of Art'</strong> promises an unforgettable experience that will enrich your appreciation for art.
                </p>
            </div>
            <div class="exhibition-date" id="dateDesc">Date: 4-6 April 2025</div>
            <div class="exhibition-location" id="locationDesc">Location: Bangkok Art Gallery</div>
        </div>
    </div>

    <form id="booking-form" name="exhibition_id" value="1" action="<?php echo $isLoggedIn ? '../Payment/Payment.php' : '../signInpage/signIn.php'; ?>" method="POST">
        <div class="ticket-container">
            <div class="datetime-section">
                <div class="datetime-title" id="dateTime">Date & Time</div>
                <div class="date-input-section">
                    <select name="date" id="date">
                        <option value="2025-04-04">04/04/2568</option>
                        <option value="2025-04-05">05/04/2568</option>
                        <option value="2025-04-06">06/04/2568</option>
                    </select>
                    <i class="far fa-calendar-alt"></i>
                </div>
                <div class="time-input-section">
                    <select name="time" id="time">
                        <option value="11:00:00">11:00</option>
                        <option value="13:00:00">13:00</option>
                        <option value="15:00:00">15:00</option>
                        <option value="17:00:00">17:00</option>
                    </select>
                    <i class="far fa-clock"></i>
                </div>
            </div>

            <div class="ticketdetails-section" id="ticketType">
            <div class="ticketdetails-title" id="ticketDetailTitle">Ticket details</div>
                <table class="ticket-table">
                    <thead>
                        <tr>
                        <th id="ticketTypeHeader">Ticket type</th>
                        <th id="ticketPriceHeader">Price</th>
                        <th id="ticketQntyHeader">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td id="ticket_description_1"></td>
                            <td>250 THB</td>
                            <td>
                                <select id="student_quantity" name="student_quantity">
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <td id="ticket_description_2"></td>
                            <td>400 THB</td>
                            <td>
                                <select id="adult_quantity" name="adult_quantity">
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                        <td id="ticket_description_3"></td>
                            <td>720 THB</td>
                            <td>
                                <select id="couple_quantity" name="couple_quantity">
                                    <option value=0>0</option>
                                    <option value=1>1</option>
                                    <option value=2>2</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php if (!$is_open): ?>
                <p class="closed-message" id="closeMsg">Ticket booking is currently closed. Please check back later.</p>
                <?php else: ?>
                <button type="submit" button class="buy-tickets-button" id="buyButton">Buy Tickets</button>
                <?php endif; ?>
            </div>
        </div>
    </form>

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

    <script src="homepage.js"></script>
    <script src="../textMap.js"></script>
</body>

</html>