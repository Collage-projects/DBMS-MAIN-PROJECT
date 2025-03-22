<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are present
    if (!isset($_POST['booking_id'], $_POST['full_name'], $_POST['phone'], $_POST['email'])) {
        die("Error: Missing required fields.");
    }

    $booking_id = $_POST['booking_id'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Update the database
    $stmt = $conn->prepare("UPDATE bookings SET full_name = ?, phone = ?, email = ? WHERE id = ?");
    $stmt->bind_param("sssi", $full_name, $phone, $email, $booking_id);

    if ($stmt->execute()) {
        echo "<script>alert('Booking updated successfully!'); window.location.href='room_status.php';</script>";
    } else {
        echo "Error updating booking: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    die("Invalid request.");
}
?>
