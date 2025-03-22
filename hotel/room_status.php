<?php
session_start();
$port = 3307; // Add this line to specify the port
include("db.php"); // Ensure database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to view your bookings!'); window.location.href='login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user's bookings from database
$stmt = $conn->prepare("SELECT id, room_type, checkin_date, checkout_date, guests, full_name, phone, email FROM bookings WHERE user_id = ? ORDER BY checkin_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Grand Hotel - My Room Status</title>
    <link rel="stylesheet" href="css/room_ststus.css">
    <script>
        function toggleUpdateForm(bookingId) {
            var form = document.getElementById("update-form-" + bookingId);
            form.style.display = form.style.display === "none" ? "block" : "none";
        }
    </script>
</head>
<body>

<header class="header">
    <h1>The Grand Hotel</h1>
    <nav class="nav">
        <a href="home.php">Home</a>
        <a href="room_booking.html">Room Booking</a>
        <a href="room_status.php" class="active">Room Status</a>
        <a href="feedback.html">Feedback</a>
        <a href="about.html">About Us</a>
    </nav>
</header>

<section class="hero">
    <h2>My Room Status</h2>
    <p>View details about your current and upcoming stays at The Grand Hotel.</p>
</section>

<section class="content">
    <h2 class="section-title">Your Bookings</h2>

    <div class="room-status-container">
        <?php if (count($bookings) > 0): ?>
            <?php foreach ($bookings as $booking): ?>
                <div class="room-card">
                    <div class="room-image" style="background-image: url('https://via.placeholder.com/600x400');"></div>
                    <div class="room-info">
                        <span class="status-badge status-booked">
                            <?= (strtotime($booking['checkin_date']) <= time() && strtotime($booking['checkout_date']) >= time()) ? 'Active Stay' : 'Upcoming Stay' ?>
                        </span>
                        <h3 class="room-title"><?= htmlspecialchars($booking['room_type']) ?></h3>

                        <div class="detail-item"><span>Check-in:</span><span class="detail-value"><?= htmlspecialchars($booking['checkin_date']) ?></span></div>
                        <div class="detail-item"><span>Check-out:</span><span class="detail-value"><?= htmlspecialchars($booking['checkout_date']) ?></span></div>
                        <div class="detail-item"><span>Guests:</span><span class="detail-value"><?= htmlspecialchars($booking['guests']) ?> Person(s)</span></div>
                        <div class="detail-item"><span>Name:</span><span class="detail-value"><?= htmlspecialchars($booking['full_name']) ?></span></div>
                        <div class="detail-item"><span>Phone:</span><span class="detail-value"><?= htmlspecialchars($booking['phone']) ?></span></div>
                        <div class="detail-item"><span>Email:</span><span class="detail-value"><?= htmlspecialchars($booking['email']) ?></span></div>

                        <p>Booking ID: <?= $booking['id'] ?></p>

                        <!-- Cancel Booking Button -->
                        <form action="cancel_booking.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                            <button type="submit" class="action-button cancel-button">Cancel Booking</button>
                        </form>

                        <!-- Update Booking Button -->
                        <button onclick="toggleUpdateForm(<?= $booking['id'] ?>)" class="action-button update-button">Update Booking</button>

                        <!-- Update Form (Initially Hidden) -->
                        <form id="update-form-<?= $booking['id'] ?>" action="update_booking.php" method="POST" style="display:none;">
                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">

                            <label for="name">Name:</label>
                            <input type="text" name="full_name" value="<?= htmlspecialchars($booking['full_name'] ?? '') ?>" required><br>

                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" value="<?= htmlspecialchars($booking['phone'] ?? '') ?>" required><br>

                            <label for="email">Email:</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($booking['email'] ?? '') ?>" required><br>

                            <button type="submit" class="action-button save-button">Save Changes</button>
                        </form>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-bookings">You have no bookings yet.</p>
        <?php endif; ?>
    </div>

</section>

</body>
</html>
