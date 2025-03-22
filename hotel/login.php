<?php
session_start();
$port = 3307; // Add this line to specify the port
include("db.php"); // Ensure database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;
                header("Location: home.php"); // Redirect to home page after login
                exit();
            } else {
                echo "<script>alert('Invalid password!'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('No user found with this email!'); window.location.href='login.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Database error! Please try again later.'); window.location.href='login.php';</script>";
    }
}

$conn->close();
?>
