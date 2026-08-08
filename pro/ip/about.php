<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-about {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 60vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        .hero-about::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('./image/a17.png') no-repeat center center;
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
        }
        .hero-about .container {
            position: relative;
            z-index: 2;
        }
        .story-section {
            background: linear-gradient(180deg, #1a1a1a 0%, #2a2a2a 100%);
            color: #ffffff;
        }
        .stats-card {
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            transition: transform 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-10px);
        }
        .timeline-item {
            position: relative;
            padding-left: 50px;
            margin-bottom: 2rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: -2rem;
            width: 2px;
            background: #0071e3;
        }
        .timeline-item::after {
            content: '';
            position: absolute;
            left: 8px;
            top: 15px;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #0071e3;
        }
        .team-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
            color: #ffffff;
        }
        .team-card:hover {
            transform: translateY(-5px);
        }
        .value-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,113,227,0.2);
            color: #ffffff;
        }
        .value-card:hover {
            border-color: rgba(0,113,227,0.3);
            box-shadow: 0 10px 25px rgba(0,113,227,0.15);
        }
        .testimonial-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            position: relative;
            color: #ffffff;
        }
            position: relative;
        }
        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 4rem;
            color: rgba(0,113,227,0.1);
            font-family: Georgia, serif;
        }
        .service-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
            border: 1px solid rgba(0,113,227,0.2);
            color: #ffffff;
        }
        .service-card:hover {
            transform: translateY(-5px);
            border-color: rgba(0,113,227,0.3);
            box-shadow: 0 15px 35px rgba(0,113,227,0.2);
        }
        .service-card i {
            font-size: 3rem;
            color: #0071e3;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body style="background-color: #000000; color: #ffffff;">
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="h4 mb-0"><i class="fab fa-apple"></i> iPhone </h1>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search iPhones...">
                        <button class="btn btn-outline-light" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="col-md-3 text-end">
                    <a href="cart.php" class="btn btn-outline-light me-2"><i class="fas fa-shopping-cart"></i> Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
                    <a href="login.php" class="btn btn-outline-light"><i class="fas fa-user"></i> Account</a>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="./index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./products.php"><i class="fas fa-mobile-alt"></i> iPhones</a></li>
                    <li class="nav-item"><a class="nav-link" href="./accessories.php"><i class="fas fa-headphones"></i> Accessories</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="./contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                    <li class="nav-item"><a class="nav-link" href="./login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-about text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">About iPhone Store</h1>
                    <p class="lead mb-4">Your premier destination for authentic Apple products. We bring you the latest iPhones, cutting-edge accessories, and unparalleled customer service that sets the standard for excellence.</p>
                    <div class="d-flex gap-3">
                        <a href="products.php" class="btn btn-primary btn-lg px-4">Shop iPhones</a>
                        <a href="accessories.php" class="btn btn-outline-light btn-lg px-4">Explore Accessories</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="./image/a15 pro.jpg" alt="iPhone 15 Pro" class="img-fluid rounded shadow" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="story-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h2 class="display-5 fw-bold mb-4">Our Story</h2>
                    <p class="lead mb-4">Founded in 2018, iPhone Store began with a simple mission: to provide Indian consumers with genuine Apple products at competitive prices with exceptional service.</p>
                    <p class="mb-4">What started as a small storefront has grown into India's most trusted Apple product retailer, serving thousands of satisfied customers across the country.</p>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                        <span>100% Genuine Apple Products</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                        <span>Pan-India Delivery Network</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-check-circle text-success me-3 fs-5"></i>
                        <span>24/7 Customer Support</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="./image/display1.jpg" alt="Our Store" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center mb-5">iPhone Store by Numbers</h2>
            <div class="row g-4">
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <i class="fas fa-users fa-3x mb-3"></i>
                        <h3 class="display-4 fw-bold mb-2">50K+</h3>
                        <p class="mb-0">Happy Customers</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <i class="fas fa-mobile-alt fa-3x mb-3"></i>
                        <h3 class="display-4 fw-bold mb-2">25K+</h3>
                        <p class="mb-0">iPhones Sold</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <i class="fas fa-star fa-3x mb-3"></i>
                        <h3 class="display-4 fw-bold mb-2">4.9/5</h3>
                        <p class="mb-0">Customer Rating</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="stats-card">
                        <i class="fas fa-award fa-3x mb-3"></i>
                        <h3 class="display-4 fw-bold mb-2">6</h3>
                        <p class="mb-0">Years of Excellence</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Core Values</h2>
            <div class="row g-4">
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                        <h4 class="mb-3">Authenticity</h4>
                        <p>We guarantee 100% genuine Apple products with official warranty and certification.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <i class="fas fa-handshake fa-3x text-success mb-3"></i>
                        <h4 class="mb-3">Trust</h4>
                        <p>Building lasting relationships through transparency, reliability, and exceptional service.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="value-card">
                        <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                        <h4 class="mb-3">Innovation</h4>
                        <p>Staying ahead with the latest Apple technology and providing cutting-edge solutions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Services Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%); color: #ffffff;">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose iPhone Store?</h2>
            <div class="row g-4">
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-truck"></i>
                        <h5 class="mb-3">Free Delivery</h5>
                        <p>Free shipping on all orders above ₹50,000. Fast and secure delivery across India.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-tools"></i>
                        <h5 class="mb-3">Expert Support</h5>
                        <p>24/7 technical support and expert guidance to help you choose the perfect iPhone.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-exchange-alt"></i>
                        <h5 class="mb-3">Easy Returns</h5>
                        <p>Hassle-free 30-day return policy on all products with full refund guarantee.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-certificate"></i>
                        <h5 class="mb-3">Genuine Warranty</h5>
                        <p>All products come with official Apple warranty and our additional support coverage.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-store"></i>
                        <h5 class="mb-3">Showroom Experience</h5>
                        <p>Visit our showrooms to experience iPhones firsthand with expert demonstrations.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card">
                        <i class="fas fa-credit-card"></i>
                        <h5 class="mb-3">Flexible Payment</h5>
                        <p>Multiple payment options including EMI, credit cards, and digital wallets.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Company Timeline Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Journey</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="timeline">
                        <div class="timeline-item">
                            <h5 class="fw-bold">2018 - The Beginning</h5>
                            <p>iPhone Store was founded with a vision to bring genuine Apple products to Indian consumers at competitive prices.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2019 - First Showroom</h5>
                            <p>Opened our flagship showroom in Mumbai, becoming the first dedicated Apple product store in Western India.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2020 - Digital Transformation</h5>
                            <p>Launched our e-commerce platform and expanded online presence, reaching customers across India.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2021 - Nationwide Expansion</h5>
                            <p>Opened showrooms in 15 major cities and established partnerships with leading logistics companies.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2022 - Excellence Award</h5>
                            <p>Recognized as "Best Apple Retailer" by Apple India for outstanding customer service and sales performance.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2023 - Innovation Hub</h5>
                            <p>Launched our Innovation Hub with AR demonstrations and personalized shopping experiences.</p>
                        </div>
                        <div class="timeline-item">
                            <h5 class="fw-bold">2024 - Future Forward</h5>
                            <p>Continuing to innovate with new services, expanded product range, and enhanced customer experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Team Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center mb-5">Leadership Team</h2>
            <div class="row g-4">
                <div class="col-md-4 mb-4">
                    <div class="team-card text-center">
                        <div class="p-4 bg-primary text-white">
                            <i class="fas fa-user-tie fa-4x mb-3"></i>
                            <h5 class="mb-2">Rajesh Kumar</h5>
                            <p class="mb-0">Founder & CEO</p>
                        </div>
                        <div class="p-3">
                            <p class="mb-0">Visionary leader with 15+ years in consumer electronics and retail management.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-card text-center">
                        <div class="p-4 bg-success text-white">
                            <i class="fas fa-cogs fa-4x mb-3"></i>
                            <h5 class="mb-2">Priya Sharma</h5>
                            <p class="mb-0">Chief Operations Officer</p>
                        </div>
                        <div class="p-3">
                            <p class="mb-0">Operations expert ensuring seamless supply chain and customer satisfaction.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="team-card text-center">
                        <div class="p-4 bg-info text-white">
                            <i class="fas fa-users fa-4x mb-3"></i>
                            <h5 class="mb-2">Amit Patel</h5>
                            <p class="mb-0">Head of Customer Experience</p>
                        </div>
                        <div class="p-3">
                            <p class="mb-0">Dedicated to creating exceptional customer experiences and building lasting relationships.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">What Our Customers Say</h2>
            <div class="row g-4">
                <div class="col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-3x text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Anjali Mehta</h6>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"iPhone Store provided exceptional service! The staff helped me choose the perfect iPhone for my needs, and the delivery was lightning fast. Highly recommended!"</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-3x text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Vikram Singh</h6>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Best Apple store experience in India! Genuine products, great prices, and outstanding customer support. They've earned my lifetime loyalty."</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-3x text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Sneha Reddy</h6>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"From online purchase to doorstep delivery, everything was perfect. The product quality and after-sales service exceeded my expectations!"</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3">
                                <i class="fas fa-user-circle fa-3x text-secondary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">Arun Kumar</h6>
                                <div class="text-warning">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mb-0">"Professional staff, genuine products, and competitive pricing. iPhone Store has set the standard for Apple retailers in India. Five stars!"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">Stay Connected</h2>
            <p class="lead mb-4">Get exclusive access to new product launches, special offers, and Apple updates.</p>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="Enter your email address" aria-label="Email address">
                        <button class="btn btn-light btn-lg" type="button">
                            <i class="fas fa-paper-plane me-2"></i>Subscribe
                        </button>
                    </div>
                    <p class="small mt-3 opacity-75">Join 50,000+ subscribers • No spam, unsubscribe anytime</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>iPhone Store</h5>
                    <p>Your trusted source for the latest iPhones.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="index.php">iPhones</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Warranty</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; 2023 iPhone Store. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Chatbot -->
    <div id="chatbot" class="chatbot">
        <div class="chatbot-header">
            <span><i class="fas fa-robot"></i> iPhone Assistant</span>
            <button id="close-chat" class="btn-close btn-close-white"></button>
        </div>
        <div class="chatbot-body" id="chat-messages">
            <div class="message bot">Hi! I'm here to help you choose the perfect iPhone. What's your budget?</div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chat-input" placeholder="Type your message...">
            <button id="send-chat" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    <div id="chat-toggle" class="chat-toggle">
        <i class="fas fa-comments"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>