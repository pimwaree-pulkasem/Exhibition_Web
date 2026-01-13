<?php
require_once __DIR__ . '/auth.php';
require_admin();
require_once __DIR__ . '/../connect.php';

$exhibition_id = 1;

// Toggle current state
$sql = "UPDATE ticket_sales SET is_open = NOT is_open WHERE Exhibition_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $exhibition_id);
$stmt->execute();

$conn->close();
header("Location: ../Admin_Dashboard/adminDashboard.php");
exit;
