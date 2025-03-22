<?php
require 'db.php'; // Ensure the correct DB connection file

// Debugging: Check received data
print_r($_POST);

if (!isset($_POST['booking_id']) || empty($_POST['booking_id'])) {
    die("Error: Missing booking ID.");
}

$booking_id = $_POST['booking_id'];

// SQL Query to delete booking
$query = "DELETE FROM bookings WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $booking_id);

if ($stmt->execute()) {
    echo "Booking deleted successfully.";
    header("Location: home.php");
    exit(); 
} else {
    echo "Error: Could not delete booking.";
}

$stmt->close();
$conn->close();
?>
