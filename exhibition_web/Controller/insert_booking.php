<?php
require_once __DIR__ . '/../connect.php';

$data = json_decode(file_get_contents('php://input'), true);

$userId = $data['userId'];
$exhibitionId = $data['exhibitionId'];
$date = $data['date'];
$timeSlot = $data['time'];
$tickets = $data['tickets'];

try {
    $stmt = $pdo->prepare("
        INSERT INTO bookings (UserID, Exhibition_id, Date, Time_Slot, Ticket_type, Price, Create_at)
        VALUES (:userId, :exhibitionId, :date, :timeSlot, :ticketType, :price, NOW())
    ");

    foreach ($tickets as $ticket) {
        $type = $ticket['type'];
        $price = $ticket['price'];
        $quantity = $ticket['quantity'];

        // Insert ทุกประเภทบัตร
        for ($i = 0; $i < $quantity; $i++) {
            $stmt->execute([
                ':userId' => $userId,
                ':exhibitionId' => $exhibitionId,
                ':date' => $date,
                ':timeSlot' => $timeSlot,
                ':ticketType' => $type,
                ':price' => $price
            ]);
        }
    }

    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    http_response_code(500);
    error_log("Insert failed: " . $e->getMessage());
    echo json_encode(['error' => 'Insert failed: ' . $e->getMessage()]);
}
