<?php
include '../connect.php';

$date = $_POST['date'];
$time = $_POST['time'];
$total = (int)$_POST['total'];

$exhibition_id = 1;

$sql = "SELECT Capacity FROM capacitys WHERE Exhibition_id = ? AND Date = ? AND Time = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $exhibition_id, $date, $time);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['available' => false, 'message' => 'No slot found']);
    exit();
}

$capacity = $result->fetch_assoc()['Capacity'];

$sql2 = "
    SELECT 
        SUM(
            CASE 
                WHEN Ticket_type = 'Couple Ticket' THEN 2 
                ELSE 1 
            END
        ) AS people_count
    FROM bookings
    WHERE Exhibition_id = ? AND Date = ? AND Time_Slot = ?
";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("iss", $exhibition_id, $date, $time);
$stmt2->execute();
$result2 = $stmt2->get_result();
$booked = (int)$result2->fetch_assoc()['people_count'];

$remaining = $capacity - $booked;

if ($total > $remaining) {
    echo json_encode(['available' => false, 'remaining' => $remaining]);
} else {
    echo json_encode(['available' => true, 'remaining' => $remaining]);
}
?>