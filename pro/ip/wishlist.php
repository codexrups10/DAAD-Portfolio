<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize wishlist if not exists
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Handle add/remove from wishlist
if (isset($_GET['action']) && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if ($_GET['action'] == 'add') {
        if (!in_array($product_id, $_SESSION['wishlist'])) {
            $_SESSION['wishlist'][] = $product_id;
        }
    } elseif ($_GET['action'] == 'remove') {
        if (($key = array_search($product_id, $_SESSION['wishlist'])) !== false) {
            unset($_SESSION['wishlist'][$key]);
            $_SESSION['wishlist'] = array_values($_SESSION['wishlist']); // Reindex array
        }
    }

    // Redirect back to avoid resubmission
    header('Location: wishlist.php');
    exit();
}

// Sample product data (in a real app, this would come from a database)
$products = [
    1 => ['name' => 'iPhone 15 Pro', 'price' => 1199, 'image' => './image/a15 pro.jpg', 'storage' => '128GB'],
    2 => ['name' => 'iPhone 15', 'price' => 999, 'image' => './image/iphone15.jpg', 'storage' => '128GB'],
    3 => ['name' => 'iPhone 14 Pro', 'price' => 1099, 'image' => './image/iphone14pro.jpg', 'storage' => '128GB'],
    4 => ['name' => 'iPhone 14', 'price' => 899, 'image' => './image/iphone14.jpg', 'storage' => '128GB'],
    5 => ['name' => 'iPhone 13', 'price' => 799, 'image' => './image/iphone13.jpg', 'storage' => '128GB'],
    6 => ['name' => 'AirPods Pro', 'price' => 249, 'image' => './image/airpods.jpg', 'storage' => ''],
    7 => ['name' => 'MagSafe Charger', 'price' => 39, 'image' => './image/magsafe.jpg', 'storage' => ''],
    8 => ['name' => 'iPhone Case', 'price' => 49, 'image' => './image/case.jpg', 'storage' => '']
];

$wishlist_items = [];
foreach ($_SESSION['wishlist'] as $product_id) {
    if (isset($products[$product_id])) {
        $wishlist_items[$product_id] = $products[$product_id];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Wishlist - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-wishlist {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 40vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }
        .hero-wishlist::before {
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
        .hero-wishlist .container {
            position: relative;
            z-index: 2;
        }
        .wishlist-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
            border: 1px solid rgba(0,113,227,0.2);
            color: white;
        }
        .wishlist-card:hover {
            transform: translateY(-5px);
        }
        .wishlist-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .remove-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(220, 53, 69, 0.9);
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        .remove-btn:hover {
            background: rgba(220, 53, 69, 1);
            transform: scale(1.1);
        }
        .wishlist-content {
            padding: 1.5rem;
        }
        .wishlist-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .wishlist-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0071e3;
            margin-bottom: 1rem;
        }
        .wishlist-actions {
            display: flex;
            gap: 0.5rem;
        }
        .empty-wishlist {
            text-align: center;
            padding: 4rem 2rem;
            color: #cccccc;
        }
        .empty-wishlist i {
            font-size: 4rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .wishlist-stats {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
        }
        .stats-item {
            text-align: center;
        }
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #0071e3;
            display: block;
        }
        .stats-label {
            font-size: 0.9rem;
            color: #cccccc;
        }
        .share-wishlist {
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }
        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }
        .share-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease;
        }
        .share-btn:hover {
            transform: translateY(-3px);
        }
        .share-btn.facebook { background: #1877f2; }
        .share-btn.twitter { background: #1da1f2; }
        .share-btn.whatsapp { background: #25d366; }
        .share-btn.email { background: #ea4335; }
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
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-wishlist">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">My Wishlist</h1>
                    <p class="lead mb-4">Your saved items, ready when you are. Keep track of products you're interested in and never miss a great deal.</p>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-heart text-danger me-2"></i>
                        <span><?php echo count($wishlist_items); ?> items in your wishlist</span>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-heart fa-5x text-danger mb-3"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Wishlist Stats -->
    <?php if (!empty($wishlist_items)): ?>
    <section class="py-4">
        <div class="container">
            <div class="wishlist-stats">
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-item">
                            <span class="stats-number"><?php echo count($wishlist_items); ?></span>
                            <span class="stats-label">Saved Items</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-item">
                            <span class="stats-number">$<?php echo number_format(array_sum(array_column($wishlist_items, 'price')), 0); ?></span>
                            <span class="stats-label">Total Value</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-item">
                            <span class="stats-number"><?php echo count(array_filter($wishlist_items, function($item) { return strpos($item['name'], 'iPhone') === 0; })); ?></span>
                            <span class="stats-label">iPhones</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-item">
                            <span class="stats-number"><?php echo count(array_filter($wishlist_items, function($item) { return strpos($item['name'], 'iPhone') !== 0; })); ?></span>
                            <span class="stats-label">Accessories</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Share Wishlist -->
    <?php if (!empty($wishlist_items)): ?>
    <section class="py-4">
        <div class="container">
            <div class="share-wishlist">
                <h4 class="mb-3">Share Your Wishlist</h4>
                <p class="mb-0">Share your saved items with friends and family</p>
                <div class="share-buttons">
                    <button class="share-btn facebook" onclick="shareWishlist('facebook')">
                        <i class="fab fa-facebook-f"></i>
                    </button>
                    <button class="share-btn twitter" onclick="shareWishlist('twitter')">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button class="share-btn whatsapp" onclick="shareWishlist('whatsapp')">
                        <i class="fab fa-whatsapp"></i>
                    </button>
                    <button class="share-btn email" onclick="shareWishlist('email')">
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Wishlist Items -->
    <section class="py-5">
        <div class="container">
            <?php if (empty($wishlist_items)): ?>
                <div class="empty-wishlist">
                    <i class="fas fa-heart-broken"></i>
                    <h3>Your wishlist is empty</h3>
                    <p>Start browsing our collection and save items you're interested in!</p>
                    <a href="products.php" class="btn btn-primary btn-lg mt-3">
                        <i class="fas fa-shopping-bag me-2"></i>Browse iPhones
                    </a>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($wishlist_items as $product_id => $product): ?>
                        <div class="col-lg-3 col-md-6 mb-4">
                            <div class="wishlist-card">
                                <div class="wishlist-image" style="background-image: url('<?php echo $product['image']; ?>');">
                                    <a href="?action=remove&id=<?php echo $product_id; ?>" class="remove-btn" onclick="return confirm('Remove from wishlist?')">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <div class="wishlist-content">
                                    <div class="wishlist-title"><?php echo $product['name']; ?></div>
                                    <?php if (!empty($product['storage'])): ?>
                                        <small class="text-muted d-block mb-2"><?php echo $product['storage']; ?></small>
                                    <?php endif; ?>
                                    <div class="wishlist-price">$<?php echo number_format($product['price'], 0); ?></div>
                                    <div class="wishlist-actions">
                                        <a href="product.php?id=<?php echo $product_id; ?>" class="btn btn-primary btn-sm flex-fill">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                        <a href="add_to_cart.php?id=<?php echo $product_id; ?>" class="btn btn-success btn-sm flex-fill">
                                            <i class="fas fa-cart-plus me-1"></i>Add to Cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Bulk Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                            <div>
                                <button class="btn btn-outline-danger" onclick="clearWishlist()">
                                    <i class="fas fa-trash me-2"></i>Clear All
                                </button>
                            </div>
                            <div>
                                <a href="cart.php" class="btn btn-success btn-lg">
                                    <i class="fas fa-shopping-cart me-2"></i>View Cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Recently Viewed Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h3 class="text-center mb-4">Recently Viewed</h3>
            <div class="row g-4">
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="./image/a15.webp" class="card-img-top" alt="iPhone 15">
                        <div class="card-body">
                            <h6 class="card-title">iPhone 15</h6>
                            <p class="card-text">$999</p>
                            <a href="#" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="./image/AIR%20PODS.jpg" class="card-img-top" alt="AirPods">
                        <div class="card-body">
                            <h6 class="card-title">AirPods Pro</h6>
                            <p class="card-text">$249</p>
                            <a href="#" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="./image/MagSafe%20Charger.webp" class="card-img-top" alt="MagSafe">
                        <div class="card-body">
                            <h6 class="card-title">MagSafe Charger</h6>
                            <p class="card-text">$39</p>
                            <a href="#" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary text-white">
                        <img src="./image/iPhone%20Case.webp" class="card-img-top" alt="Case">
                        <div class="card-body">
                            <h6 class="card-title">iPhone Case</h6>
                            <p class="card-text">$49</p>
                            <a href="#" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h3 class="mb-3">Never Miss a Deal</h3>
            <p class="lead mb-4">Get notified when your wishlist items go on sale</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="Enter your email address">
                        <button class="btn btn-light btn-lg" type="button">
                            <i class="fas fa-bell me-2"></i>Notify Me
                        </button>
                    </div>
                    <p class="small mt-3 opacity-75">Get wishlist alerts • No spam, unsubscribe anytime</p>
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
                        <li><a href="products.php">iPhones</a></li>
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
                <p>&copy; 2024 iPhone Store. All rights reserved.</p>
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
            <div class="message bot">Hi! Need help with your wishlist? I can help you find similar products or answer questions about your saved items.</div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chat-input" placeholder="Ask about your wishlist...">
            <button id="send-chat" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    <div id="chat-toggle" class="chat-toggle">
        <i class="fas fa-comments"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        function shareWishlist(platform) {
            const url = window.location.href;
            const text = "Check out my iPhone wishlist!";

            switch(platform) {
                case 'facebook':
                    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
                    break;
                case 'twitter':
                    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`, '_blank');
                    break;
                case 'whatsapp':
                    window.open(`https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`, '_blank');
                    break;
                case 'email':
                    window.location.href = `mailto:?subject=${encodeURIComponent('My iPhone Wishlist')}&body=${encodeURIComponent(text + '\n\n' + url)}`;
                    break;
            }
        }

        function clearWishlist() {
            if (confirm('Are you sure you want to clear your entire wishlist?')) {
                window.location.href = '?action=clear';
            }
        }
    </script>
</body>
</html>