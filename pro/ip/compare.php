<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get selected products from URL parameters or session
$compare_products = [];
if (isset($_GET['products'])) {
    $product_ids = explode(',', $_GET['products']);
    // In a real app, fetch from database
    // For now, we'll use the JavaScript data
} elseif (isset($_SESSION['compare'])) {
    $product_ids = $_SESSION['compare'];
} else {
    $product_ids = [];
}

// Sample product data (should match script.js)
$products = [
    1 => ['name' => 'iPhone 15 Pro Max', 'price' => 159900, 'image' => './image/a15 pro.jpg', 'display' => '6.7" Super Retina XDR', 'chip' => 'A17 Pro', 'storage' => '256GB', 'camera' => '48MP Main, 12MP Ultra Wide, 12MP Telephoto', 'battery' => '23 hours video', 'weight' => '221g', 'os' => 'iOS 17', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    2 => ['name' => 'iPhone 15 Pro', 'price' => 129900, 'image' => './image/a15 pro.jpg', 'display' => '6.1" Super Retina XDR', 'chip' => 'A17 Pro', 'storage' => '128GB', 'camera' => '48MP Main, 12MP Ultra Wide, 12MP Telephoto', 'battery' => '23 hours video', 'weight' => '187g', 'os' => 'iOS 17', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    3 => ['name' => 'iPhone 15 Plus', 'price' => 89900, 'image' => './image/a15 plus.webp', 'display' => '6.7" Super Retina XDR', 'chip' => 'A16 Bionic', 'storage' => '128GB', 'camera' => '48MP Main, 12MP Ultra Wide', 'battery' => '26 hours video', 'weight' => '201g', 'os' => 'iOS 17', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    4 => ['name' => 'iPhone 15', 'price' => 79900, 'image' => './image/a15.webp', 'display' => '6.1" Super Retina XDR', 'chip' => 'A16 Bionic', 'storage' => '128GB', 'camera' => '48MP Main, 12MP Ultra Wide', 'battery' => '20 hours video', 'weight' => '171g', 'os' => 'iOS 17', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    5 => ['name' => 'iPhone 14 Pro Max', 'price' => 139900, 'image' => './image/dis3.png', 'display' => '6.7" Super Retina XDR', 'chip' => 'A16 Bionic', 'storage' => '256GB', 'camera' => '48MP Main, 12MP Ultra Wide, 12MP Telephoto', 'battery' => '29 hours video', 'weight' => '240g', 'os' => 'iOS 16', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    6 => ['name' => 'iPhone 14 Pro', 'price' => 119900, 'image' => './image/app2.jpg', 'display' => '6.1" Super Retina XDR', 'chip' => 'A16 Bionic', 'storage' => '128GB', 'camera' => '48MP Main, 12MP Ultra Wide, 12MP Telephoto', 'battery' => '23 hours video', 'weight' => '206g', 'os' => 'iOS 16', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    7 => ['name' => 'iPhone 14 Plus', 'price' => 79900, 'image' => './image/app.jpg', 'display' => '6.7" Liquid Retina HD', 'chip' => 'A15 Bionic', 'storage' => '128GB', 'camera' => '12MP Main, 12MP Ultra Wide', 'battery' => '26 hours video', 'weight' => '203g', 'os' => 'iOS 16', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    8 => ['name' => 'iPhone 14', 'price' => 69900, 'image' => './image/app1.jpg', 'display' => '6.1" Super Retina XDR', 'chip' => 'A15 Bionic', 'storage' => '128GB', 'camera' => '12MP Main, 12MP Ultra Wide', 'battery' => '20 hours video', 'weight' => '172g', 'os' => 'iOS 16', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    9 => ['name' => 'iPhone 13 Pro Max', 'price' => 129900, 'image' => './image/dis5.png', 'display' => '6.7" Super Retina XDR', 'chip' => 'A15 Bionic', 'storage' => '256GB', 'camera' => '12MP Main, 12MP Ultra Wide, 12MP Telephoto', 'battery' => '28 hours video', 'weight' => '238g', 'os' => 'iOS 15', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    10 => ['name' => 'iPhone 13', 'price' => 59900, 'image' => './image/display1.jpg', 'display' => '6.1" Super Retina XDR', 'chip' => 'A15 Bionic', 'storage' => '128GB', 'camera' => '12MP Main, 12MP Ultra Wide', 'battery' => '19 hours video', 'weight' => '173g', 'os' => 'iOS 15', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi'],
    11 => ['name' => 'iPhone SE (3rd gen)', 'price' => 49900, 'image' => './image/a pink.webp', 'display' => '4.7" Retina HD', 'chip' => 'A15 Bionic', 'storage' => '64GB', 'camera' => '12MP Main', 'battery' => '15 hours video', 'weight' => '144g', 'os' => 'iOS 15', 'water_resistant' => 'IP67', 'wireless' => 'Qi'],
    12 => ['name' => 'iPhone 12', 'price' => 54900, 'image' => './image/display2.jpg', 'display' => '6.1" Super Retina XDR', 'chip' => 'A14 Bionic', 'storage' => '64GB', 'camera' => '12MP Main, 12MP Ultra Wide', 'battery' => '17 hours video', 'weight' => '162g', 'os' => 'iOS 14', 'water_resistant' => 'IP68', 'wireless' => 'MagSafe, Qi']
];

$selected_products = [];
foreach ($product_ids as $id) {
    if (isset($products[$id])) {
        $selected_products[$id] = $products[$id];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compare iPhones - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .compare-hero {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 50vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }
        .compare-hero::before {
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
        .compare-hero .container {
            position: relative;
            z-index: 2;
        }
        .product-selector {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
        }
        .product-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            transition: transform 0.3s ease;
            border: 1px solid rgba(0,113,227,0.2);
            color: white;
        }
        .product-card:hover {
            transform: translateY(-5px);
        }
        .product-image {
            height: 200px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .product-info {
            padding: 1.5rem;
        }
        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .product-price {
            font-size: 1.3rem;
            font-weight: 700;
            color: #0071e3;
            margin-bottom: 1rem;
        }
        .compare-table {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            margin-bottom: 2rem;
        }
        .compare-table th {
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
            color: white;
            padding: 1rem;
            font-weight: 600;
            border: none;
        }
        .compare-table td {
            padding: 1rem;
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            vertical-align: middle;
        }
        .compare-table .spec-label {
            background: rgba(0,113,227,0.1);
            font-weight: 600;
            color: #0071e3;
        }
        .empty-compare {
            text-align: center;
            padding: 4rem 2rem;
            color: #cccccc;
        }
        .empty-compare i {
            font-size: 4rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .selection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .phone-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 10px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            color: white;
        }
        .phone-card:hover {
            transform: translateY(-3px);
            border-color: #0071e3;
        }
        .phone-card.selected {
            border-color: #0071e3;
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
        }
        .phone-image {
            height: 120px;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            margin-bottom: 0.5rem;
        }
        .phone-name {
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }
        .phone-price {
            color: #cccccc;
            font-size: 0.8rem;
        }
        .compare-actions {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
        }
        .highlight-winner {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            color: white !important;
        }
        .highlight-runner {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
            color: white !important;
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
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link active" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="compare-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Compare iPhones</h1>
                    <p class="lead mb-4">Choose up to 4 iPhones to compare specifications, features, and prices side by side. Make an informed decision with our detailed comparison tool.</p>
                    <div class="d-flex gap-3">
                        <button class="btn btn-primary btn-lg px-4" onclick="scrollToSelection()">
                            <i class="fas fa-plus me-2"></i>Select Phones
                        </button>
                        <button class="btn btn-outline-light btn-lg px-4" onclick="clearComparison()">
                            <i class="fas fa-trash me-2"></i>Clear All
                        </button>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fas fa-balance-scale fa-5x text-primary mb-3"></i>
                    <h3>Smart Comparison</h3>
                    <p>Side-by-side specs comparison</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Selection -->
    <section class="py-5" id="selection-section">
        <div class="container">
            <h2 class="text-center mb-4">Select iPhones to Compare</h2>
            <p class="text-center text-secondary mb-4">Choose up to 4 iPhones to compare their specifications, features, and prices</p>

            <div class="selection-grid">
                <?php foreach ($products as $id => $product): ?>
                    <div class="phone-card <?php echo in_array($id, array_keys($selected_products)) ? 'selected' : ''; ?>"
                         onclick="toggleSelection(<?php echo $id; ?>)"
                         data-id="<?php echo $id; ?>">
                        <div class="phone-image" style="background-image: url('<?php echo $product['image']; ?>');"></div>
                        <div class="phone-name"><?php echo $product['name']; ?></div>
                        <div class="phone-price">₹<?php echo number_format($product['price'], 0); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="text-center">
                <button class="btn btn-primary btn-lg" onclick="compareSelected()">
                    <i class="fas fa-balance-scale me-2"></i>Compare Selected (<?php echo count($selected_products); ?>/4)
                </button>
            </div>
        </div>
    </section>

    <?php if (!empty($selected_products)): ?>
    <!-- Comparison Table -->
    <section class="py-5">
        <div class="container">
            <div class="compare-actions">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="mb-0">Comparison Results</h3>
                        <p class="mb-0 text-secondary">Comparing <?php echo count($selected_products); ?> iPhone<?php echo count($selected_products) > 1 ? 's' : ''; ?></p>
                    </div>
                    <div class="col-md-6 text-end">
                        <button class="btn btn-outline-light me-2" onclick="highlightBest()">
                            <i class="fas fa-star me-1"></i>Highlight Best
                        </button>
                        <button class="btn btn-primary" onclick="printComparison()">
                            <i class="fas fa-print me-1"></i>Print Comparison
                        </button>
                    </div>
                </div>
            </div>

            <div class="compare-table">
                <table class="table table-dark mb-0">
                    <thead>
                        <tr>
                            <th style="width: 200px;">Specification</th>
                            <?php foreach ($selected_products as $id => $product): ?>
                                <th style="width: <?php echo 800/count($selected_products); ?>px;">
                                    <div class="text-center">
                                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 80px; height: 80px; object-fit: cover; border-radius: 10px; margin-bottom: 0.5rem;">
                                        <div><?php echo $product['name']; ?></div>
                                        <div class="text-primary fw-bold">₹<?php echo number_format($product['price'], 0); ?></div>
                                        <div class="mt-2">
                                            <a href="product.php?id=<?php echo $id; ?>" class="btn btn-sm btn-outline-light me-1">View</a>
                                            <a href="add_to_cart.php?id=<?php echo $id; ?>" class="btn btn-sm btn-success">Buy</a>
                                        </div>
                                    </div>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="spec-label">Display</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['display']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Chip</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['chip']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Storage</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['storage']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Camera System</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['camera']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Battery Life</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['battery']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Weight</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['weight']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Operating System</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['os']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Water Resistance</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['water_resistant']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Wireless Charging</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td><?php echo $product['wireless']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <td class="spec-label">Price</td>
                            <?php foreach ($selected_products as $product): ?>
                                <td class="fw-bold text-primary">₹<?php echo number_format($product['price'], 0); ?></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php else: ?>
    <!-- Empty State -->
    <section class="py-5">
        <div class="container">
            <div class="empty-compare">
                <i class="fas fa-balance-scale"></i>
                <h3>No iPhones Selected</h3>
                <p>Select iPhones above to start comparing their specifications and features</p>
                <button class="btn btn-primary btn-lg mt-3" onclick="scrollToSelection()">
                    <i class="fas fa-plus me-2"></i>Select iPhones to Compare
                </button>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Newsletter Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h3 class="mb-3">Get Comparison Alerts</h3>
            <p class="lead mb-4">Be the first to know about new iPhone releases and comparison updates</p>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="Enter your email address">
                        <button class="btn btn-light btn-lg" type="button">
                            <i class="fas fa-bell me-2"></i>Subscribe
                        </button>
                    </div>
                    <p class="small mt-3 opacity-75">Get iPhone updates • No spam, unsubscribe anytime</p>
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
            <div class="message bot">Hi! Need help comparing iPhones? I can help you choose the best one for your needs!</div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chat-input" placeholder="Ask about iPhone comparisons...">
            <button id="send-chat" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
        </div>
    </div>
    <div id="chat-toggle" class="chat-toggle">
        <div class="pulse-ring"></div>
        <i class="fas fa-comments"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        let selectedPhones = [<?php echo implode(',', array_keys($selected_products)); ?>];

        function toggleSelection(phoneId) {
            const card = document.querySelector(`[data-id="${phoneId}"]`);
            const index = selectedPhones.indexOf(phoneId);

            if (index > -1) {
                selectedPhones.splice(index, 1);
                card.classList.remove('selected');
            } else if (selectedPhones.length < 4) {
                selectedPhones.push(phoneId);
                card.classList.add('selected');
            } else {
                alert('You can compare up to 4 iPhones at once.');
                return;
            }

            updateCompareButton();
        }

        function updateCompareButton() {
            const button = document.querySelector('button[onclick="compareSelected()"]');
            if (button) {
                button.innerHTML = `<i class="fas fa-balance-scale me-2"></i>Compare Selected (${selectedPhones.length}/4)`;
            }
        }

        function compareSelected() {
            if (selectedPhones.length === 0) {
                alert('Please select at least one iPhone to compare.');
                return;
            }

            window.location.href = `compare.php?products=${selectedPhones.join(',')}`;
        }

        function scrollToSelection() {
            document.getElementById('selection-section').scrollIntoView({ behavior: 'smooth' });
        }

        function clearComparison() {
            selectedPhones = [];
            document.querySelectorAll('.phone-card').forEach(card => {
                card.classList.remove('selected');
            });
            updateCompareButton();
            window.location.href = 'compare.php';
        }

        function highlightBest() {
            // Simple highlighting logic - in a real app, this would be more sophisticated
            const rows = document.querySelectorAll('.compare-table tbody tr');

            rows.forEach(row => {
                const cells = Array.from(row.querySelectorAll('td:not(.spec-label)'));
                if (cells.length > 1) {
                    // Remove existing highlights
                    cells.forEach(cell => {
                        cell.classList.remove('highlight-winner', 'highlight-runner');
                    });

                    // Simple logic: highlight first and last cells
                    if (cells.length >= 2) {
                        cells[0].classList.add('highlight-winner');
                        if (cells.length > 2) {
                            cells[cells.length - 1].classList.add('highlight-runner');
                        }
                    }
                }
            });
        }

        function printComparison() {
            window.print();
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateCompareButton();
        });
    </script>
</body>
</html>