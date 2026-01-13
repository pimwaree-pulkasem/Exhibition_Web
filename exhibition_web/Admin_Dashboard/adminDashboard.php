<?php
require_once __DIR__ . '/../Controller/auth.php';
require_admin();
require_once __DIR__ . '/../connect.php';

$exhibition_id = 1;
$status_sql = "SELECT is_open FROM ticket_sales WHERE Exhibition_id = ?";
$stmt = $conn->prepare($status_sql);
$stmt->bind_param("i", $exhibition_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$is_open = $row ? (bool)$row['is_open'] : false;

$booking_sql = "
  SELECT 
      b.BookingID,
      b.UserID,
      u.name AS UserName,
      e.Title AS ExhibitionName,
      b.Ticket_type,
      1 AS Quantity,
      b.Price,
      b.Date,
      b.Time_Slot,
      b.Create_at
  FROM bookings b
  LEFT JOIN user u ON b.UserID = u.UserID
  LEFT JOIN exhibitions e ON b.Exhibition_id = e.Exhibition_id
  WHERE b.Exhibition_id = ?
  ORDER BY b.Create_at DESC
";


$stmt = $conn->prepare($booking_sql);
if (!$stmt = $conn->prepare($booking_sql)) {
  die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("i", $exhibition_id);
$stmt->execute();
$bookings = $stmt->get_result();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="admin.css">
</head>

<body>
  <main>
    <h1>Admin Dashboard</h1>

    <section>
      <h2>Manage Ticket Sales</h2>
      <div class="button-group">
        <form action="../Controller/toggle_sales.php" method="POST">
          <button type="submit">
            <?= $is_open ? 'Close Ticket Sales' : 'Open Ticket Sales' ?>
          </button>
        </form>

        <form action="../Controller/auth.php" method="GET">
          <input type="hidden" name="action" value="logout">
          <button type="submit">Log out</button>
        </form>
      </div>
    </section>

    <section>
      <h2>All Bookings</h2>
      <table border="1" cellpadding="10" cellspacing="0">
        <thead>
          <tr>
            <th>User</th>
            <th>Exhibition</th>
            <th>Ticket Type</th>
            <th>Quantity</th>
            <th>Price per Ticket</th>
            <th>Date</th>
            <th>Time Slot</th>
            <th>Booking Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($bookings->num_rows > 0): ?>
            <?php while ($row = $bookings->fetch_assoc()): ?>
              <tr>
                <td><?= htmlspecialchars($row['UserName'] ?? "User #" . $row['UserID']) ?></td>
                <td><?= htmlspecialchars($row['ExhibitionName']) ?></td>
                <td><?= htmlspecialchars($row['Ticket_type']) ?></td>
                <td><?= htmlspecialchars($row['Quantity']) ?></td>
                <td><?= number_format((float)$row['Price'], 2) ?> ฿</td>
                <td><?= htmlspecialchars($row['Date']) ?></td>
                <td><?= htmlspecialchars($row['Time_Slot']) ?></td>
                <td><?= htmlspecialchars($row['Create_at']) ?></td>
                <td>
                  <form action="../Controller/delete_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    <input type="hidden" name="booking_id" value="<?= htmlspecialchars($row['BookingID']) ?>">
                    <button type="submit" style="background-color: #dc3545;">Delete</button>
                  </form>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align:center;">No bookings yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="center-button">
        <form action="../Controller/delete_all_bookings.php" method="POST" onsubmit="return confirm('Are you sure you want to delete ALL bookings?');">
          <button type="submit" class="danger-button">
            Delete All Bookings
          </button>
        </form>
      </div>


    </section>
  </main>
</body>

</html>
