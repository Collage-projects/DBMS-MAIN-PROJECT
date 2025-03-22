<?php
session_start();
include("db.php"); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'] ?? null;
    $room = htmlspecialchars($_POST['room']);
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $guests = intval($_POST['guests']);
    $special_requests = htmlspecialchars($_POST['special_requests']);

    if (!$user_id) {
        echo "<script>alert('You must be logged in to book a room!'); window.location.href='login.php';</script>";
        exit();
    }

    // Insert booking into database
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_type, full_name, email, phone, checkin_date, checkout_date, guests, special_requests, booking_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

    if ($stmt) {
        $stmt->bind_param("issssssss", $user_id, $room, $full_name, $email, $phone, $checkin_date, $checkout_date, $guests, $special_requests);
        if ($stmt->execute()) {
            echo "<script>alert('Booking Confirmed!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('Booking failed. Please try again!'); window.location.href='confirm_booking.php?room=$room';</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Database error! Please try again later.'); window.location.href='confirm_booking.php?room=$room';</script>";
    }
}

$conn->close();
?>
