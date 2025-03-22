<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); // Redirect to login if not logged in
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Grand Hotel - Home</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .header {
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #d4af37;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 30px;
        }
        
        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #d4af37;
        }
        
        .nav-links a.active {
            border-bottom: 2px solid #d4af37;
            padding-bottom: 5px;
        }
        
        .hero {
            position: relative;
            height: 60vh;
            background-image: url('back.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero-content h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: #fff;
        }
        
        .hero-content p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        
        .btn {
            display: inline-block;
            background-color: #d4af37;
            color: #fff;
            padding: 12px 30px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #b4941f;
        }
        
        .section {
            padding: 80px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: #333;
        }
        
        .section-title h2 {
            font-size: 36px;
            position: relative;
            display: inline-block;
            padding-bottom: 15px;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 2px;
            background-color: #d4af37;
        }
        
        .about-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 40px;
        }
        
        .about-image {
            flex: 1;
            min-width: 300px;
        }
        
        .about-image img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .about-text {
            flex: 1;
            min-width: 300px;
        }
        
        .about-text h3 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }
        
        .about-text p {
            margin-bottom: 15px;
            line-height: 1.8;
            color: #666;
        }
        
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }
        
        .feature-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            text-align: center;
            flex: 1;
            min-width: 250px;
            max-width: 350px;
            transition: transform 0.3s;
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 40px;
            color: #d4af37;
            margin-bottom: 20px;
        }
        
        .feature-box h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }
        
        .feature-box p {
            color: #666;
            line-height: 1.6;
        }
        
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            position: relative;
            height: 250px;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .footer {
            background-color: #1a1a1a;
            color: #fff;
            padding: 60px 0 20px;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-column {
            flex: 1;
            min-width: 250px;
        }
        
        .footer-column h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #d4af37;
        }
        
        .footer-column p, .footer-column a {
            display: block;
            color: #aaa;
            margin-bottom: 10px;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-column a:hover {
            color: #d4af37;
        }
        
        .social-links a {
            display: inline-block;
            margin-right: 15px;
            font-size: 20px;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #333;
            color: #aaa;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
            }
            
            .nav-links {
                margin-top: 20px;
            }
            
            .nav-links li {
                margin-left: 15px;
                margin-right: 15px;
            }
            
            .hero {
                height: 50vh;
            }
            
            .hero-content h1 {
                font-size: 36px;
            }
            
            .section {
                padding: 60px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <nav class="navbar">
            <div class="container nav-container">
                <a href="home.php" class="logo">The Grand Hotel</a>
                <ul class="nav-links">
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="room_booking.html">Room Booking</a></li>
                    <li><a href="room_status.html">Room Status</a></li>
                    <li><a href="feedback.html">Feedback</a></li>
                    <li><a href="about.html">About us</a></li>
                </ul>
                <!-- Add a Logout button in the navigation -->
                <ul class="nav-links">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Welcome to The Grand Hotel</h1>
            <p>Experience luxury, comfort, and exceptional service in the heart of the city.</p>
            
            <a href="room_booking.html" class="btn">Book Now</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="section-title">
                <h2>About Our Hotel</h2>
            </div>
            <div class="about-content">
                <div class="about-image">
                    <img src="about.jpg" alt="About The Grand Hotel">
                </div>
                <div class="about-text">
                    <h3>Luxury Redefined</h3>
                    <p>Established in 1995, The Grand Hotel has been synonymous with luxury and excellence for over two decades. Our commitment to providing exceptional service and creating memorable experiences for our guests has made us one of the most prestigious hotels in the region.</p>
                    <p>Located in the heart of the city, The Grand Hotel offers easy access to major attractions, shopping centers, and business districts. Our prime location combined with world-class amenities makes us the perfect choice for both business and leisure travelers.</p>
                    <p>From our elegantly appointed rooms to our gourmet restaurants, every aspect of The Grand Hotel is designed to exceed your expectations and provide you with an unforgettable stay.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section" style="background-color: #f0f0f0;">
        <div class="container">
            <div class="section-title">
                <h2>Our Amenities</h2>
            </div>
            <div class="features">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-swimming-pool"></i>
                    </div>
                    <h3>Luxury Pool</h3>
                    <p>Relax and unwind in our temperature-controlled swimming pool with stunning panoramic views of the city skyline.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3>Spa & Wellness</h3>
                    <p>Rejuvenate your body and mind with our wide range of spa treatments and wellness programs.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Fine Dining</h3>
                    <p>Savor exquisite cuisines prepared by our award-winning chefs in our elegant restaurants.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3>Fitness Center</h3>
                    <p>Stay fit during your stay with our state-of-the-art fitness equipment and personal trainers.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <h3>Free Wi-Fi</h3>
                    <p>Stay connected with complimentary high-speed internet access throughout the hotel.</p>
                </div>
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                    <h3>Concierge Service</h3>
                    <p>Our dedicated concierge team is available 24/7 to assist you with all your needs and requests.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="section">
        <div class="container">
            <div class="section-title">
                <h2>Our Gallery</h2>
            </div>
            <div class="gallery">
                <div class="gallery-item">
                    <img src="gallery1.jpg" alt="Hotel Room">
                    <div class="gallery-overlay">
                        <h3>Luxury Suites</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="image/gallery2.jpg" alt="Hotel Restaurant">
                    <div class="gallery-overlay">
                        <h3>Gourmet Restaurant</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="image/gallery3.jpg" alt="Hotel Pool">
                    <div class="gallery-overlay">
                        <h3>Infinity Pool</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="image/gallery4.jpg" alt="Hotel Spa">
                    <div class="gallery-overlay">
                        <h3>Wellness Spa</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="image/gallery5.jpg" alt="Hotel Lobby">
                    <div class="gallery-overlay">
                        <h3>Elegant Lobby</h3>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="image/gallery6.jpg" alt="Hotel Exterior">
                    <div class="gallery-overlay">
                        <h3>Hotel Exterior</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>The Grand Hotel</h3>
                    <p>Experience luxury and comfort like never before at The Grand Hotel, where every stay becomes a cherished memory.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <a href="home.php">Home</a>
                    <a href="room_booking.html">Room Booking</a>
                    <a href="room_status.html">Room Status</a>
                    <a href="#">Services</a>
                    <a href="#">Gallery</a>
                    <a href="#">Contact Us</a>
                </div>
                <div class="footer-column">
                    <h3>Contact Info</h3>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Luxury Avenue, City Center</p>
                    <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                    <p><i class="fas fa-envelope"></i> info@thegrandhotel.com</p>
                </div>
                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p>Subscribe to our newsletter to get updates on special offers and events.</p>
                    <form action="#" method="post">
                        <input type="email" placeholder="Your Email" style="padding: 10px; width: 100%; margin-bottom: 10px; border: none; border-radius: 4px;">
                        <button type="submit" style="background-color: #d4af37; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 The Grand Hotel. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
