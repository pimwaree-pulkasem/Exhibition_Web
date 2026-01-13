<?php
require_once __DIR__ . '/../connect.php';
require_once __DIR__ . '/auth.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingID = $_POST['booking_id'] ?? null;

    if ($bookingID) {
        $stmt = $conn->prepare("
            DELETE FROM bookings 
            WHERE BookingID = ?
        ");
        $stmt->bind_param("i", $bookingID);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("Location: ../Admin_Dashboard/adminDashboard.php");
            exit;
        } else {
            echo "Failed to delete booking.";
        }
    }
}
