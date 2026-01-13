<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../connect.php';

$userId = $_GET['userId'] ?? null;
$totalQnty = $_GET['total_quantity'] ?? null;

if (!$userId) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing userId']);
    exit;
}

$stmt = $pdo->prepare("
    SELECT b.BookingID, b.Ticket_type, b.Date, b.Time_Slot, b.Price, e.Title
    FROM bookings b
    JOIN exhibitions e ON b.Exhibition_id = e.Exhibition_id
    WHERE b.UserID = :userId
    ORDER BY b.Create_at DESC
    LIMIT $totalQnty
");
$stmt->execute([':userId' => $userId]);
$tickets = $stmt->fetchAll();

echo json_encode($tickets);
?>
