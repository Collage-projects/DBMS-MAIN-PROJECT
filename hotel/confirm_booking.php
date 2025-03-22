<?php
session_start();
$room = isset($_GET['room']) ? htmlspecialchars($_GET['room']) : "Unknown Room";

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You must be logged in to book a room!'); window.location.href='login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white flex items-center justify-center min-h-screen">

    <div class="bg-gray-900 p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-yellow-400 text-center">Confirm Your Booking</h2>
        <p class="text-center text-gray-300 mt-2">Room Type: <span class="text-pink-400 font-semibold"><?= $room ?></span></p>

        <form action="process_booking.php" method="POST" class="mt-4 space-y-4">
            <input type="hidden" name="room" value="<?= $room ?>">

            <div>
                <label class="block text-gray-300">Full Name</label>
                <input type="text" name="full_name" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Email</label>
                <input type="email" name="email" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Phone Number</label>
                <input type="text" name="phone" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Check-in Date</label>
                <input type="date" name="checkin_date" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Check-out Date</label>
                <input type="date" name="checkout_date" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Number of Guests</label>
                <input type="number" name="guests" min="1" required class="w-full p-2 rounded bg-gray-800 text-white">
            </div>

            <div>
                <label class="block text-gray-300">Special Requests (Optional)</label>
                <textarea name="special_requests" class="w-full p-2 rounded bg-gray-800 text-white"></textarea>
            </div>

            <button type="submit" class="w-full p-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white font-semibold rounded-lg shadow-md hover:from-pink-500 hover:to-red-500 transition">
                Confirm Booking
            </button>
        </form>

        <a href="room_booking.html" class="mt-4 block text-center text-gray-300 hover:text-yellow-400">Go Back</a>
    </div>

</body>
</html>
