<?php
require_once __DIR__ . '/../connect.php';
require_once __DIR__ . '/auth.php';

require_admin();

$sql = "DELETE FROM bookings";
if ($conn->query($sql) === TRUE) {
    header("Location: ../Admin_Dashboard/adminDashboard.php");
    exit();
} else {
    echo "Error deleting records: " . $conn->error;
}
?>
