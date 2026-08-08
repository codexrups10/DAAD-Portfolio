<?php
$products = [
    [
        'id' => 1,
        'name' => 'iPhone 15 Pro Max',
        'price' => 159900,
        'image' => './image/a15 pro.jpg',
        'specs' => 'A17 Pro chip, 256GB, Titanium, 6.7" Display',
        'description' => 'The ultimate iPhone with A17 Pro chip, titanium design, and pro camera system.'
    ],
    [
        'id' => 2,
        'name' => 'iPhone 15 Pro',
        'price' => 129900,
        'image' => './image/a15 pro.jpg',
        'specs' => 'A17 Pro chip, 128GB, Titanium',
        'description' => 'The iPhone 15 Pro features the powerful A17 Pro chip, titanium design, and advanced camera system.'
    ],
    [
        'id' => 3,
        'name' => 'iPhone 15 Plus',
        'price' => 89900,
        'image' => './image/a15 plus.webp',
        'specs' => 'A16 Bionic, 128GB, 6.7" Display, Dynamic Island',
        'description' => 'Larger display with Dynamic Island and A16 Bionic chip.'
    ],
    [
        'id' => 4,
        'name' => 'iPhone 15',
        'price' => 79900,
        'image' => './image/a15.webp',
        'specs' => 'A16 Bionic, 128GB, Dynamic Island',
        'description' => 'Experience the Dynamic Island and A16 Bionic chip in the iPhone 15.'
    ],
    [
        'id' => 5,
        'name' => 'iPhone 14 Pro Max',
        'price' => 139900,
        'image' => './image/dis3.png',
        'specs' => 'A16 Bionic, 256GB, 6.7" Display, Pro camera',
        'description' => 'Pro camera system with A16 Bionic for professional photography on a large display.'
    ],
    [
        'id' => 6,
        'name' => 'iPhone 14 Pro',
        'price' => 119900,
        'image' => './image/app2.jpg',
        'specs' => 'A16 Bionic, 128GB, Pro camera',
        'description' => 'Pro camera system with A16 Bionic for professional photography.'
    ],
    [
        'id' => 7,
        'name' => 'iPhone 14 Plus',
        'price' => 79900,
        'image' => './image/app.jpg',
        'specs' => 'A15 Bionic, 128GB, 6.7" Display, All-day battery',
        'description' => 'All-day battery life with A15 Bionic chip on a larger display.'
    ],
    [
        'id' => 8,
        'name' => 'iPhone 14',
        'price' => 69900,
        'image' => './image/app1.jpg',
        'specs' => 'A15 Bionic, 128GB, Great battery',
        'description' => 'All-day battery life with A15 Bionic chip.'
    ],
    [
        'id' => 9,
        'name' => 'iPhone 13 Pro Max',
        'price' => 129900,
        'image' => './image/dis5.png',
        'specs' => 'A15 Bionic, 256GB, 6.7" Display, Pro camera',
        'description' => 'Pro camera system with A15 Bionic for stunning photos and videos.'
    ],
    [
        'id' => 10,
        'name' => 'iPhone 13',
        'price' => 59900,
        'image' => './image/display1.jpg',
        'specs' => 'A15 Bionic, 128GB, Reliable',
        'description' => 'Reliable performance with A15 Bionic.'
    ],
    [
        'id' => 11,
        'name' => 'iPhone SE (3rd gen)',
        'price' => 49900,
        'image' => './image/a pink.webp',
        'specs' => 'A15 Bionic, 64GB, Compact',
        'description' => 'Compact design with powerful A15 Bionic chip.'
    ],
    [
        'id' => 12,
        'name' => 'iPhone 12',
        'price' => 54900,
        'image' => './image/display2.jpg',
        'specs' => 'A14 Bionic, 64GB, Ceramic Shield',
        'description' => 'Durable Ceramic Shield with A14 Bionic performance.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iPhone Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./style.css">
    <style>
        .hero {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
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
        .hero .container {
            position: relative;
            z-index: 2;
        }
        .feature-icon {
            transition: transform 0.3s ease;
        }
        .feature-icon:hover {
            transform: scale(1.1);
        }
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body style="background-color: #000; color: #f5f5f7; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">
    <?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>
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
                    <li class="nav-item"><a class="nav-link active" href="./products.php"><i class="fas fa-mobile-alt"></i> iPhones</a></li>
                    <li class="nav-item"><a class="nav-link" href="./accessories.php"><i class="fas fa-headphones"></i> Accessories</a></li>
                    <li class="nav-item"><a class="nav-link" href="./about.php"><i class="fas fa-info-circle"></i> About</a></li>
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
    <section class="hero bg-dark text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Discover the Latest iPhones</h1>
                    <p class="lead mb-4">Experience innovation, performance, and style with Apple's flagship smartphones. From the powerful A17 Pro chip to advanced camera systems, find your perfect iPhone.</p>
                    <div class="d-flex gap-3">
                        <a href="#products" class="btn btn-primary btn-lg px-4">Shop Now</a>
                        <a href="#specs" class="btn btn-outline-light btn-lg px-4">Compare Specs</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="./image/a15 pro.jpg" alt="iPhone 15 Pro" class="img-fluid rounded shadow" style="max-height: 400px;">
                </div>
            </div>
        </div>
    </section>

    <main class="container my-4" id="products">
        <div class="row">
            <aside class="col-md-3">
                <div class="filters bg-dark text-white p-3 rounded">
                    <h5><i class="fas fa-filter"></i> Filters</h5>
                    <div class="mb-3">
                        <label>Price Range</label>
                        <input type="range" class="form-range" min="30000" max="160000" id="priceRange">
                        <div class="d-flex justify-content-between">
                            <span>₹30,000</span>
                            <span>₹1,60,000</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Storage</label>
                        <select class="form-select" id="storageFilter">
                            <option value="">All</option>
                            <option value="64GB">64GB</option>
                            <option value="128GB">128GB</option>
                            <option value="256GB">256GB</option>
                            <option value="512GB">512GB</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sort By</label>
                        <select class="form-select" id="sortBy">
                            <option value="relevance">Relevance</option>
                            <option value="price-low">Price: Low to High</option>
                            <option value="price-high">Price: High to Low</option>
                        </select>
                    </div>
                </div>
            </aside>
            <section class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2><i class="fas fa-mobile-alt"></i> iPhones</h2>
                    <div>
                        <span id="productCount"><?php echo count($products); ?> products</span>
                    </div>
                </div>
                <div class="row" id="productsContainer">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card bg-dark text-white">
                                <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>" onerror="this.src='https://via.placeholder.com/300x200?text=Image+Not+Found'">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <p class="card-text"><?php echo $product['specs']; ?></p>
                                    <p class="card-text"><strong>₹<?php echo number_format($product['price']); ?></strong></p>
                                    <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
                                    <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary"><i class="fas fa-cart-plus"></i> Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </main>

    <!-- Specifications Comparison Section -->
    <section id="specs" class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Compare iPhone Specifications</h2>
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Model</th>
                            <th>Chip</th>
                            <th>Storage</th>
                            <th>Display</th>
                            <th>Camera</th>
                            <th>Battery</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>iPhone 15 Pro Max</strong></td>
                            <td>A17 Pro</td>
                            <td>256GB-1TB</td>
                            <td>6.7" Super Retina XDR</td>
                            <td>48MP Pro camera system</td>
                            <td>Up to 29 hrs video</td>
                            <td>₹1,59,900</td>
                        </tr>
                        <tr>
                            <td><strong>iPhone 15 Pro</strong></td>
                            <td>A17 Pro</td>
                            <td>128GB-1TB</td>
                            <td>6.1" Super Retina XDR</td>
                            <td>48MP Pro camera system</td>
                            <td>Up to 27 hrs video</td>
                            <td>₹1,29,900</td>
                        </tr>
                        <tr>
                            <td><strong>iPhone 15 Plus</strong></td>
                            <td>A16 Bionic</td>
                            <td>128GB-512GB</td>
                            <td>6.7" Super Retina XDR</td>
                            <td>48MP Main camera</td>
                            <td>Up to 26 hrs video</td>
                            <td>₹89,900</td>
                        </tr>
                        <tr>
                            <td><strong>iPhone 15</strong></td>
                            <td>A16 Bionic</td>
                            <td>128GB-512GB</td>
                            <td>6.1" Super Retina XDR</td>
                            <td>48MP Main camera</td>
                            <td>Up to 20 hrs video</td>
                            <td>₹79,900</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Customer Reviews Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5 text-white">What Our Customers Say</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card bg-black text-white border-secondary">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Amazing camera quality and the A17 Pro chip makes everything so smooth. Best iPhone I've ever owned!"</p>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Rahul Sharma</h6>
                                    <small class="text-secondary">iPhone 15 Pro Max Owner</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-black text-white border-secondary">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Dynamic Island is a game changer. Battery life is incredible and the display is stunning."</p>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Priya Patel</h6>
                                    <small class="text-secondary">iPhone 15 Plus Owner</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card bg-black text-white border-secondary">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <p class="card-text">"Compact yet powerful. The A15 Bionic chip handles everything I throw at it. Perfect size!"</p>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Amit Kumar</h6>
                                    <small class="text-secondary">iPhone SE Owner</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Accessories Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Essential Accessories</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <img src="./image/AIR PODS.jpg" class="card-img-top" alt="AirPods Pro" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">AirPods Pro (2nd gen)</h6>
                            <p class="card-text">₹24,900</p>
                            <a href="accessories.php" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <img src="./image/MagSafe Charger.webp" class="card-img-top" alt="MagSafe Charger" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">MagSafe Charger</h6>
                            <p class="card-text">₹3,900</p>
                            <a href="accessories.php" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <img src="./image/iPhone Case.webp" class="card-img-top" alt="iPhone Case" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">Leather Case</h6>
                            <p class="card-text">₹4,900</p>
                            <a href="accessories.php" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card bg-dark text-white">
                        <img src="./image/Lightning Cable.jpg" class="card-img-top" alt="Lightning Cable" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h6 class="card-title">USB-C to Lightning Cable</h6>
                            <p class="card-text">₹1,900</p>
                            <a href="accessories.php" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="accessories.php" class="btn btn-outline-light btn-lg">View All Accessories</a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Why Choose Our iPhones?</h2>
            <div class="row text-center">
                <div class="col-md-3 mb-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h5 class="text-white">Genuine Products</h5>
                    <p class="text-secondary">100% authentic Apple products with warranty</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-truck fa-3x text-success"></i>
                    </div>
                    <h5 class="text-white">Free Delivery</h5>
                    <p class="text-secondary">Free shipping on orders above ₹50,000</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-tools fa-3x text-warning"></i>
                    </div>
                    <h5 class="text-white">Expert Support</h5>
                    <p class="text-secondary">24/7 customer support for all your queries</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="feature-icon mb-3">
                        <i class="fas fa-exchange-alt fa-3x text-info"></i>
                    </div>
                    <h5 class="text-white">Easy Exchange</h5>
                    <p class="text-secondary">Hassle-free exchange within 30 days</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="text-white mb-3">Stay Updated</h3>
                    <p class="text-secondary mb-4">Get the latest news about new iPhone releases, exclusive deals, and Apple updates.</p>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="email" class="form-control form-control-lg" placeholder="Enter your email">
                        <button class="btn btn-primary btn-lg" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5><i class="fab fa-apple"></i> iPhone Store</h5>
                    <p class="text-secondary">Your trusted source for authentic Apple products in India.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Products</h6>
                    <ul class="list-unstyled">
                        <li><a href="products.php" class="text-secondary">iPhones</a></li>
                        <li><a href="accessories.php" class="text-secondary">Accessories</a></li>
                        <li><a href="#" class="text-secondary">Compare</a></li>
                        <li><a href="#" class="text-secondary">Trade-in</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Support</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-secondary">Contact Us</a></li>
                        <li><a href="#" class="text-secondary">Warranty</a></li>
                        <li><a href="#" class="text-secondary">FAQ</a></li>
                        <li><a href="#" class="text-secondary">Service Centers</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h6>Follow Us</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-secondary"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-secondary"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-secondary"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-secondary"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-secondary mb-0">&copy; 2024 iPhone Store. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-secondary">Made with <i class="fas fa-heart text-danger"></i> for Apple fans</small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>


