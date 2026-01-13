<?php
require_once __DIR__ . '/../connect.php';

$userId = $_GET['userId'] ?? null;

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
");
$stmt->execute([':userId' => $userId]);
$tickets = $stmt->fetchAll();

header('Content-Type: application/json');
echo json_encode($tickets);

?>
