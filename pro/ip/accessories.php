<?php 
session_start();
// This connects to the data page you provided earlier
include 'accessories_data.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        body { background-color: #000; color: #f5f5f7; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; overflow-x: hidden; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 25px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .glass-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(0, 113, 227, 0.5);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .img-box {
            background: #f5f5f7; 
            border-radius: 20px; 
            overflow: hidden; 
            margin-bottom: 20px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-apple {
            background: #0071e3;
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
        }
        .btn-apple:hover { background: #0077ed; transform: scale(1.05); color: white; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in-up { animation: fadeIn 0.8s ease forwards; }

        .category-card {
            transition: all 0.3s ease;
            border-color: rgba(255,255,255,0.1) !important;
        }
        .category-card:hover {
            transform: translateY(-5px);
            border-color: rgba(0,113,227,0.5) !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .compatibility-list .fa-check-circle { color: #28a745; }
        .compatibility-list .fa-info-circle { color: #ffc107; }

        .bundle-items { min-height: 80px; }
        .price-section { margin: 20px 0; }

        .maintenance-card {
            transition: all 0.3s ease;
            border-color: rgba(255,255,255,0.1) !important;
        }
        .maintenance-card:hover {
            border-color: rgba(0,113,227,0.3) !important;
            background: rgba(0,113,227,0.05) !important;
        }

        .favorite-item {
            transition: all 0.3s ease;
        }
        .favorite-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        }

        .warranty-card {
            transition: all 0.3s ease;
        }
        .warranty-card:hover {
            transform: translateY(-5px);
        }
        .warranty-card:hover i {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
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
                    <li class="nav-item"><a class="nav-link" href="./products.php"><i class="fas fa-mobile-alt"></i> iPhones</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./accessories.php"><i class="fas fa-headphones"></i> Accessories</a></li>
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

    <section style="background: linear-gradient(180deg, #1d1d1f 0%, #000 100%); padding: 80px 0; text-align: center;">
        <div class="container fade-in-up">
            <h2 style="font-size: 0.9rem; letter-spacing: 2px; color: #0071e3; font-weight: 700; text-transform: uppercase;">Essential additions</h2>
            <h1 style="font-size: 4rem; font-weight: 700; margin-bottom: 20px;">Mix. Match. <br><span style="background: linear-gradient(90deg, #0071e3, #2997ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">MagSafe.</span></h1>
        </div>
    </section>

    <main class="container my-5">
        <div class="row g-4">
            <?php foreach ($accessories as $item): ?>
                <div class="col-lg-3 col-md-6 fade-in-up">
                    <div class="glass-card p-3 text-center">
                        <div class="img-box">
                            <img src="<?php echo $item['image']; ?>" class="img-fluid p-4" alt="<?php echo $item['name']; ?>" 
                                 style="transition: 0.5s ease;" 
                                 onmouseover="this.style.transform='scale(1.1)'" 
                                 onmouseout="this.style.transform='scale(1)'"
                                 onerror="this.src='https://via.placeholder.com/300x300?text=Apple+Accessory'">
                        </div>
                        <h5 style="font-weight: 600; margin-bottom: 10px;"><?php echo $item['name']; ?></h5>
                        <p style="color: #86868b; font-size: 0.85rem; height: 40px; overflow: hidden;"><?php echo $item['description']; ?></p>
                        <p style="font-size: 1.2rem; font-weight: 700; color: #fff; margin: 15px 0;">₹<?php echo number_format($item['price']); ?></p>
                        
                        <a href="product.php?id=<?php echo $item['id']; ?>&type=accessory" class="btn-apple w-100">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Accessory Categories Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Explore Categories</h2>
            <div class="row g-4">
                <div class="col-md-3 mb-4">
                    <div class="category-card text-center p-4 bg-dark rounded-3 border">
                        <i class="fas fa-headphones fa-3x text-primary mb-3"></i>
                        <h5 class="text-white">Audio</h5>
                        <p class="text-secondary mb-3">AirPods, EarPods & Headphones</p>
                        <a href="#audio" class="btn btn-outline-primary btn-sm">Explore</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card text-center p-4 bg-dark rounded-3 border">
                        <i class="fas fa-shield-alt fa-3x text-success mb-3"></i>
                        <h5 class="text-white">Protection</h5>
                        <p class="text-secondary mb-3">Cases, Screen Protectors & Covers</p>
                        <a href="#protection" class="btn btn-outline-success btn-sm">Explore</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card text-center p-4 bg-dark rounded-3 border">
                        <i class="fas fa-bolt fa-3x text-warning mb-3"></i>
                        <h5 class="text-white">Charging</h5>
                        <p class="text-secondary mb-3">Cables, Adapters & Wireless Chargers</p>
                        <a href="#charging" class="btn btn-outline-warning btn-sm">Explore</a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="category-card text-center p-4 bg-dark rounded-3 border">
                        <i class="fas fa-wifi fa-3x text-info mb-3"></i>
                        <h5 class="text-white">Connectivity</h5>
                        <p class="text-secondary mb-3">Adapters, Hubs & Accessories</p>
                        <a href="#connectivity" class="btn btn-outline-info btn-sm">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Compatibility Guide Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Compatibility Guide</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h4 class="text-white mb-4">Which Accessories Work With Your iPhone?</h4>
                    <div class="compatibility-list">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong class="text-white">MagSafe Accessories</strong>
                                <p class="text-secondary mb-0">Compatible with iPhone 12 and later</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong class="text-white">Lightning Cables</strong>
                                <p class="text-secondary mb-0">Works with all iPhones (except iPhone 15 series)</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <div>
                                <strong class="text-white">USB-C Accessories</strong>
                                <p class="text-secondary mb-0">Designed for iPhone 15 series</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-info-circle text-warning me-3"></i>
                            <div>
                                <strong class="text-white">Wireless Charging</strong>
                                <p class="text-secondary mb-0">iPhone 8 and later (check wattage compatibility)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="./image/a17.png" alt="iPhone Compatibility" class="img-fluid rounded shadow" style="max-height: 300px;" onerror="this.src='https://via.placeholder.com/300x200?text=iPhone+Compatibility'">
                </div>
            </div>
        </div>
    </section>

    <!-- Bundle Deals Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Bundle Deals</h2>
            <div class="row g-4">
                <div class="col-lg-4 mb-4">
                    <div class="card bg-dark text-white border-secondary h-100">
                        <div class="card-header text-center bg-primary text-white">
                            <h5 class="mb-0">Essential Bundle</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="bundle-items mb-3">
                                <p class="mb-1"><i class="fas fa-check text-success"></i> MagSafe Charger</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> USB-C Cable</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> Screen Protector</p>
                            </div>
                            <div class="price-section">
                                <span class="text-decoration-line-through text-secondary">₹8,900</span>
                                <h4 class="text-primary mb-3">₹6,900</h4>
                                <span class="badge bg-success">Save ₹2,000</span>
                            </div>
                            <button class="btn btn-primary w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card bg-dark text-white border-secondary h-100">
                        <div class="card-header text-center bg-success text-white">
                            <h5 class="mb-0">Audio Bundle</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="bundle-items mb-3">
                                <p class="mb-1"><i class="fas fa-check text-success"></i> AirPods Pro</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> MagSafe Case</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> Cleaning Kit</p>
                            </div>
                            <div class="price-section">
                                <span class="text-decoration-line-through text-secondary">₹31,900</span>
                                <h4 class="text-success mb-3">₹27,900</h4>
                                <span class="badge bg-success">Save ₹4,000</span>
                            </div>
                            <button class="btn btn-success w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card bg-dark text-white border-secondary h-100">
                        <div class="card-header text-center bg-warning text-dark">
                            <h5 class="mb-0">Protection Bundle</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="bundle-items mb-3">
                                <p class="mb-1"><i class="fas fa-check text-success"></i> Leather Case</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> Privacy Screen</p>
                                <p class="mb-1"><i class="fas fa-check text-success"></i> Ring Stand</p>
                            </div>
                            <div class="price-section">
                                <span class="text-decoration-line-through text-secondary">₹12,900</span>
                                <h4 class="text-warning mb-3">₹9,900</h4>
                                <span class="badge bg-success">Save ₹3,000</span>
                            </div>
                            <button class="btn btn-warning w-100 mt-3">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Care & Maintenance Tips Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Care & Maintenance Tips</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <div class="maintenance-card p-4 bg-black rounded-3 border">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-mobile-alt fa-2x text-primary me-3 mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">iPhone Care</h5>
                                <ul class="text-secondary mb-0 small">
                                    <li>Use genuine Apple accessories for best performance</li>
                                    <li>Avoid extreme temperatures</li>
                                    <li>Keep ports clean and dry</li>
                                    <li>Update to latest iOS regularly</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="maintenance-card p-4 bg-black rounded-3 border">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-headphones fa-2x text-success me-3 mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Audio Accessories Care</h5>
                                <ul class="text-secondary mb-0 small">
                                    <li>Store AirPods in case when not in use</li>
                                    <li>Clean ear tips regularly</li>
                                    <li>Avoid contact with liquids</li>
                                    <li>Keep firmware updated</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="maintenance-card p-4 bg-black rounded-3 border">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-bolt fa-2x text-warning me-3 mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Charging Accessories Care</h5>
                                <ul class="text-secondary mb-0 small">
                                    <li>Use MFi certified chargers</li>
                                    <li>Avoid overloading circuits</li>
                                    <li>Don't use damaged cables</li>
                                    <li>Store in cool, dry place</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <div class="maintenance-card p-4 bg-black rounded-3 border">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-shield-alt fa-2x text-info me-3 mt-1"></i>
                            <div>
                                <h5 class="text-white mb-2">Case & Protection Care</h5>
                                <ul class="text-secondary mb-0 small">
                                    <li>Clean cases regularly</li>
                                    <li>Replace worn screen protectors</li>
                                    <li>Avoid sharp objects</li>
                                    <li>Check fit periodically</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How to Choose Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">How to Choose the Right Accessory</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion" id="accessoryGuide">
                        <div class="accordion-item bg-dark border-secondary">
                            <h2 class="accordion-header">
                                <button class="accordion-button bg-dark text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    <i class="fas fa-question-circle me-2"></i> What should I consider when buying a case?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accessoryGuide">
                                <div class="accordion-body text-secondary">
                                    Consider your lifestyle, protection needs, and style preferences. For maximum protection, choose rugged cases. For a premium feel, opt for leather or premium materials. Ensure the case is specifically designed for your iPhone model.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-dark border-secondary">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-dark text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="fas fa-question-circle me-2"></i> Which wireless charger should I buy?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accessoryGuide">
                                <div class="accordion-body text-secondary">
                                    Choose MFi certified chargers for best compatibility. MagSafe chargers offer precise alignment and faster charging. Consider wattage (higher is better) and whether you need portable or desktop charging solutions.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-dark border-secondary">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-dark text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="fas fa-question-circle me-2"></i> Are all Lightning cables the same?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accessoryGuide">
                                <div class="accordion-body text-secondary">
                                    No, cable quality varies significantly. Choose MFi certified cables for reliable performance and safety. Higher quality cables support faster charging and data transfer speeds. Length and durability are also important factors.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-dark border-secondary">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed bg-dark text-white border-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="fas fa-question-circle me-2"></i> How do I choose the right screen protector?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accessoryGuide">
                                <div class="accordion-body text-secondary">
                                    Consider clarity, touch sensitivity, and protection level. Tempered glass offers better protection than plastic films. Privacy screens protect against visual hacking. Ensure it's designed for your specific iPhone model for perfect fit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Favorites Section -->
    <section class="py-5 bg-dark">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Customer Favorites</h2>
            <div class="row g-4">
                <div class="col-md-6 mb-4">
                    <div class="favorite-item p-4 bg-black rounded-3 border border-primary">
                        <div class="d-flex align-items-center mb-3">
                            <img src="./image/AIR PODS.jpg" alt="AirPods Pro" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/60x60?text=AirPods'">
                            <div>
                                <h5 class="text-white mb-1">AirPods Pro (2nd gen)</h5>
                                <div class="rating mb-1">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="text-secondary ms-2">4.9/5</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-secondary mb-2">"Best wireless earbuds I've ever used. The noise cancellation is incredible!"</p>
                        <small class="text-primary">Most Popular • 2,500+ reviews</small>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="favorite-item p-4 bg-black rounded-3 border border-success">
                        <div class="d-flex align-items-center mb-3">
                            <img src="./image/MagSafe Charger.webp" alt="MagSafe Charger" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/60x60?text=Charger'">
                            <div>
                                <h5 class="text-white mb-1">MagSafe Charger</h5>
                                <div class="rating mb-1">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star-half-alt text-warning"></i>
                                    <span class="text-secondary ms-2">4.7/5</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-secondary mb-2">"Fast, reliable charging with perfect magnetic alignment. A must-have!"</p>
                        <small class="text-success">Best Seller • 1,800+ reviews</small>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="favorite-item p-4 bg-black rounded-3 border border-warning">
                        <div class="d-flex align-items-center mb-3">
                            <img src="./image/iPhone Case.webp" alt="Leather Case" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/60x60?text=Case'">
                            <div>
                                <h5 class="text-white mb-1">Leather Case</h5>
                                <div class="rating mb-1">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="text-secondary ms-2">4.8/5</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-secondary mb-2">"Premium feel and excellent protection. The leather ages beautifully!"</p>
                        <small class="text-warning">Top Rated • 950+ reviews</small>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="favorite-item p-4 bg-black rounded-3 border border-info">
                        <div class="d-flex align-items-center mb-3">
                            <img src="./image/Lightning Cable.jpg" alt="USB-C Cable" class="me-3 rounded" style="width: 60px; height: 60px; object-fit: cover;" onerror="this.src='https://via.placeholder.com/60x60?text=Cable'">
                            <div>
                                <h5 class="text-white mb-1">USB-C to Lightning Cable</h5>
                                <div class="rating mb-1">
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <span class="text-secondary ms-2">4.9/5</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-secondary mb-2">"Durable, fast charging cable. Much better than the stock one!"</p>
                        <small class="text-info">Editor's Choice • 1,200+ reviews</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Warranty & Support Section -->
    <section class="py-5 bg-black">
        <div class="container">
            <h2 class="text-center mb-5 text-white">Warranty & Support</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="warranty-card p-4">
                        <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                        <h5 class="text-white">1 Year Warranty</h5>
                        <p class="text-secondary">All accessories come with comprehensive warranty coverage</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="warranty-card p-4">
                        <i class="fas fa-tools fa-3x text-success mb-3"></i>
                        <h5 class="text-white">Expert Support</h5>
                        <p class="text-secondary">24/7 technical support for all your accessory needs</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="warranty-card p-4">
                        <i class="fas fa-exchange-alt fa-3x text-warning mb-3"></i>
                        <h5 class="text-white">Easy Returns</h5>
                        <p class="text-secondary">30-day return policy on all accessories</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <div class="container">
            <div class="glass-card p-5 text-center">
                <h3 style="font-weight: 700;">Stay updated on the latest arrivals.</h3>
                <form class="d-flex justify-content-center mt-4 mx-auto" style="max-width: 450px;">
                    <input type="email" class="form-control rounded-pill me-2 bg-dark border-secondary text-white px-4" placeholder="Email address">
                    <button class="btn-apple" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </section>

</body>
</html>