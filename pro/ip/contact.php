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
    <title>Contact Us - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-contact {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 50vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }
        .hero-contact::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('./image/display1.jpg') no-repeat center center;
            background-size: cover;
            opacity: 0.1;
            z-index: 1;
        }
        .hero-contact .container {
            position: relative;
            z-index: 2;
        }
        .contact-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
            border: 1px solid rgba(0,113,227,0.2);
            color: white;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .contact-card i {
            font-size: 3rem;
            color: #0071e3;
            margin-bottom: 1rem;
        }
        .contact-form {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: 1px solid rgba(0,113,227,0.2);
            color: white;
        }
        .contact-form .form-control {
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
        }
        .contact-form .form-control:focus {
            background: #1a1a1a;
            border-color: #0071e3;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(0,113,227,0.25);
        }
        .contact-form .form-label {
            color: #ffffff;
        }
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .business-hours {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
        }
        .faq-item {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 10px;
            margin-bottom: 1rem;
            border: 1px solid rgba(0,113,227,0.1);
        }
        .faq-item .btn {
            color: white;
            text-align: left;
            width: 100%;
            padding: 1rem;
            border: none;
            background: none;
        }
        .faq-item .btn:focus {
            box-shadow: none;
        }
        .faq-item .collapse {
            padding: 0 1rem 1rem;
            color: #cccccc;
        }
        .social-links a {
            display: inline-block;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #0071e3;
            color: white;
            text-align: center;
            line-height: 50px;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }
        .social-links a:hover {
            background: #0056b3;
            transform: translateY(-3px);
        }
    </style>
</head>
<body style="background-color: #000000; color: #ffffff;">
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="h4 mb-0"><i class="fab fa-apple"></i> <a href="index.php" class="text-white text-decoration-none">iPhone Store</a></h1>
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="products.php"><i class="fas fa-mobile-alt"></i> iPhones</a></li>
                    <li class="nav-item"><a class="nav-link" href="accessories.php"><i class="fas fa-headphones"></i> Accessories</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Get in Touch</h1>
                    <p class="lead mb-4">Have questions about iPhones? Need help choosing the perfect device? Our expert team is here to help you every step of the way.</p>
                    <div class="d-flex gap-3">
                        <a href="#contact-form" class="btn btn-primary btn-lg px-4">Send Message</a>
                        <a href="tel:+1234567890" class="btn btn-outline-light btn-lg px-4">Call Now</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-headset fa-5x text-primary mb-3"></i>
                    <h3>24/7 Support</h3>
                    <p>Always here to help</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Methods Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Contact Us</h2>
            <div class="row g-4">
                <div class="col-md-3 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-phone"></i>
                        <h4 class="mb-3">Phone Support</h4>
                        <p class="mb-2">Call our experts</p>
                        <strong>+1 (234) 567-8900</strong>
                        <p class="small mt-2">Mon-Fri: 9AM-9PM<br>Sat-Sun: 10AM-6PM</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-envelope"></i>
                        <h4 class="mb-3">Email Support</h4>
                        <p class="mb-2">Get detailed help</p>
                        <strong>support@iphonestore.com</strong>
                        <p class="small mt-2">Response within 24 hours</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-comments"></i>
                        <h4 class="mb-3">Live Chat</h4>
                        <p class="mb-2">Instant assistance</p>
                        <strong>Available Now</strong>
                        <p class="small mt-2">Average wait: 2 minutes</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="contact-card">
                        <i class="fas fa-store"></i>
                        <h4 class="mb-3">Visit Store</h4>
                        <p class="mb-2">In-person help</p>
                        <strong>15 Locations</strong>
                        <p class="small mt-2">Find nearest store</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form & Map Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="contact-form">
                        <h3 class="mb-4">Send us a Message</h3>
                        <form id="contact-form">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-control" id="subject" required>
                                    <option value="">Select a topic</option>
                                    <option value="product-info">Product Information</option>
                                    <option value="technical-support">Technical Support</option>
                                    <option value="warranty">Warranty & Repairs</option>
                                    <option value="order-status">Order Status</option>
                                    <option value="returns">Returns & Exchanges</option>
                                    <option value="feedback">Feedback & Suggestions</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tell us how we can help you..." required></textarea>
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="newsletter">
                                <label class="form-check-label" for="newsletter">Subscribe to our newsletter for updates</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-container mb-4">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2412648754585!2d-73.98784868459375!3d40.75889697932795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1643123456789!5m2!1sen!2sus" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="business-hours">
                        <h4 class="mb-4">Business Hours</h4>
                        <div class="row">
                            <div class="col-6">
                                <h6>Store Hours</h6>
                                <p class="mb-1">Monday - Friday: 9:00 AM - 9:00 PM</p>
                                <p class="mb-1">Saturday: 10:00 AM - 8:00 PM</p>
                                <p class="mb-1">Sunday: 11:00 AM - 6:00 PM</p>
                            </div>
                            <div class="col-6">
                                <h6>Support Hours</h6>
                                <p class="mb-1">Phone: 24/7</p>
                                <p class="mb-1">Email: 24/7</p>
                                <p class="mb-1">Live Chat: 8:00 AM - 10:00 PM</p>
                            </div>
                        </div>
                        <hr class="my-4">
                        <div class="text-center">
                            <h6>Address</h6>
                            <p class="mb-0">123 Apple Street<br>Tech City, TC 12345<br>United States</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="fas fa-plus me-3"></i>How do I choose the right iPhone for me?
                        </button>
                        <div class="collapse" id="faq1">
                            <div class="mt-3">
                                Our experts can help you choose based on your budget, needs, and preferences. Call us or use our live chat for personalized recommendations.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="fas fa-plus me-3"></i>Do you offer warranty on iPhones?
                        </button>
                        <div class="collapse" id="faq2">
                            <div class="mt-3">
                                All our iPhones come with official Apple warranty. We also provide additional support coverage for peace of mind.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="fas fa-plus me-3"></i>What payment methods do you accept?
                        </button>
                        <div class="collapse" id="faq3">
                            <div class="mt-3">
                                We accept all major credit cards, debit cards, PayPal, Apple Pay, Google Pay, and EMI options.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <i class="fas fa-plus me-3"></i>How long does shipping take?
                        </button>
                        <div class="collapse" id="faq4">
                            <div class="mt-3">
                                Standard delivery takes 3-5 business days. Express delivery (1-2 days) and same-day delivery are also available in select areas.
                            </div>
                        </div>
                    </div>
                    <div class="faq-item">
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                            <i class="fas fa-plus me-3"></i>Can I return or exchange my iPhone?
                        </button>
                        <div class="collapse" id="faq5">
                            <div class="mt-3">
                                Yes, we offer 30-day return policy on all products. Items must be in original condition with all accessories and packaging.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container text-center">
            <h2 class="mb-4">Follow Us on Social Media</h2>
            <p class="lead mb-4">Stay connected for the latest iPhone news, tips, and exclusive offers</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <p class="mt-4 mb-0">Join our community of 100K+ iPhone enthusiasts!</p>
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