<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../connect.php';

$bookingID = isset($_GET['bookingId']) ? $_GET['bookingId'] : null;

if (!$bookingID) {
    http_response_code(400);
    echo json_encode(["error" => "Missing bookingId"]);
    exit;
}

$sql = "SELECT b.BookingID, b.UserID, e.Title, b.Date, b.Time_Slot, b.Ticket_type,
        b.Price, b.Create_at FROM bookings b JOIN exhibitions e ON b.Exhibition_id = e.Exhibition_id WHERE BookingID = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $bookingID);
$stmt->execute();
$result = $stmt->get_result();

$tickets = [];
while ($row = $result->fetch_assoc()) {
    $tickets[] = $row;
}

echo json_encode($tickets);
?>
