<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch product data - adjust this based on your database structure
$product = null;
$products = [];

// Example: Fetch from database or use sample data
if (isset($_GET['id'])) {
    // TODO: Replace this with your actual database query
    // $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = " . $_GET['id']));
    
    // Sample data for testing
    $product = [
        'id' => $_GET['id'],
        'name' => 'iPhone 15 Pro',
        'price' => 99999,
        'image' => 'images/iphone.png',
        'specs' => 'Latest Apple iPhone with advanced features'
    ];
    $products = [$product];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name'] ?? 'iPhone Details'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Essential Animations that cannot be done with inline styles */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(0,113,227,0.2); }
            50% { box-shadow: 0 0 20px rgba(0,113,227,0.6); }
        }
        .floating-img { animation: float 6s ease-in-out infinite; }
        .gradient-text {
            background: linear-gradient(90deg, #0071e3, #2997ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 30px;
        }
        .color-selector {
            width: 25px; height: 25px; border-radius: 50%; cursor: pointer;
            transition: transform 0.2s; border: 2px solid transparent;
        }
        .color-selector:hover { transform: scale(1.3); border-color: #fff; }
    </style>
</head>
<body 
style="background-color: #000; color: #f5f5f7; font-family: -apple-system, BlinkMacSystemFont, sans-serif;">

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
                    <li class="nav-item"><a class="nav-link active" href="./index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./products.php"><i class="fas fa-mobile-alt"></i> iPhones</a></li>
                    <li class="nav-item"><a class="nav-link" href="./accessories.php"><i class="fas fa-headphones"></i> Accessories</a></li>
                    <li class="nav-item"><a class="nav-link" href="./about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="./contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#"><i class="fas fa-heart"></i> Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                    <li class="nav-item"><a class="nav-link" href="./login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

   

    <main class="container my-5">
        <?php if ($products): ?>
        <div class="row g-5 align-items-center">
            
            <div class="col-lg-7">
                <div class="glass-card p-5 text-center position-relative overflow-hidden" style="min-height: 500px; display: flex; align-items: center; justify-content: center;">
                    <div style="position: absolute; width: 300px; height: 300px; background: rgba(0,113,227,0.15); filter: blur(100px); border-radius: 50%; z-index: 0;"></div>
                    
                    <img src="<?php echo $product['image']; ?>" 
                         class="img-fluid floating-img position-relative" 
                         style="z-index: 1; filter: drop-shadow(0 20px 30px rgba(0,0,0,0.5)); max-height: 450px;"
                         alt="iPhone">

                    <div class="glass-card px-3 py-2 position-absolute" style="top: 15%; right: 10%; font-size: 0.8rem; font-weight: bold;">
                        <i class="fas fa-microchip text-primary"></i> A17 Pro Chip
                    </div>
                    <div class="glass-card px-3 py-2 position-absolute" style="bottom: 15%; left: 10%; font-size: 0.8rem; font-weight: bold;">
                        <i class="fas fa-camera text-primary"></i> 48MP Camera
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div style="padding-left: 20px;">
                    <span style="color: #0071e3; letter-spacing: 2px; font-weight: bold; font-size: 0.75rem;">NEW RELEASE</span>
                    <h1 class="display-4 fw-bold mb-3" style="letter-spacing: -1px;"><?php echo $product['name']; ?></h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <h2 class="gradient-text fw-bold mb-0">₹<?php echo number_format($product['price']); ?></h2>
                        <span class="ms-3 badge rounded-pill bg-success" style="font-size: 0.7rem;">In Stock</span>
                    </div>

                    <p style="color: #86868b; font-size: 1.1rem; line-height: 1.6;">
                        <?php echo $product['specs']; ?>. Experience the most powerful iPhone yet with Aerospace-grade Titanium.
                    </p>

                    <hr style="border-color: rgba(255,255,255,0.1); margin: 30px 0;">

                    <div class="mb-4">
                        <p class="small fw-bold mb-3">Finish. <span style="color: #86868b;">Titanium Colors</span></p>
                        <div class="d-flex gap-3">
                            <div class="color-selector" style="background: #4b4c4e;"></div>
                            <div class="color-selector" style="background: #e1e2e2;"></div>
                            <div class="color-selector" style="background: #8e8c87;"></div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <p class="small fw-bold mb-3">Storage. <span style="color: #86868b;">How much do you need?</span></p>
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="glass-card p-3 text-center border-primary" style="cursor: pointer; border-width: 2px;">
                                    <div class="fw-bold">128 GB</div>
                                    <div class="small text-secondary">Included</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card p-3 text-center" style="cursor: pointer;">
                                    <div class="fw-bold">256 GB</div>
                                    <div class="small text-secondary">+ ₹10,000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="post" action="add_to_cart.php" class="d-grid gap-3">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold py-3 shadow" style="background: #0071e3; border: none; animation: glow 3s infinite;">
                            Add to Bag
                        </button>
                        <button type="button" class="btn btn-outline-light btn-lg rounded-pill fw-bold py-3">
                            <i class="far fa-heart"></i> Save for Later
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </main>

    <section style="background: #0d0d0d; padding: 100px 0;">
        <div class="container">
            <h2 class="text-center display-5 fw-bold mb-5">Go deeper on the details.</h2>
            
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="glass-card p-5 h-100">
                        <i class="fas fa-bolt fa-3x mb-4" style="color: #0071e3;"></i>
                        <h4 class="fw-bold">A17 Pro</h4>
                        <p class="text-secondary">Up to 20% faster GPU for high-level gaming.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-5 h-100">
                        <i class="fas fa-video fa-3x mb-4" style="color: #0071e3;"></i>
                        <h4 class="fw-bold">Pro Camera</h4>
                        <p class="text-secondary">Seven pro lenses in your pocket with 5x Telephoto.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-5 h-100">
                        <i class="fas fa-shield-alt fa-3x mb-4" style="color: #0071e3;"></i>
                        <h4 class="fw-bold">Action Button</h4>
                        <p class="text-secondary">A shortcut to your favorite feature.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 80px 0; background-color: #000;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="glass-card" style="padding: 60px; height: 100%; position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center;">
                    <div style="position: relative; z-index: 2;">
                        <h2 style="font-size: 3.5rem; font-weight: 800; color: #fff; line-height: 1.1;">Titanium.<br>Strong. Light. Pro.</h2>
                        <p style="color: #86868b; font-size: 1.25rem; max-width: 500px; margin-top: 20px;">iPhone 15 Pro is the first iPhone to feature an aerospace‑grade titanium design, using the same alloy that spacecraft use for missions to Mars.</p>
                    </div>
                    <div style="position: absolute; top: -10%; right: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(0,113,227,0.15) 0%, transparent 70%); z-index: 1;"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card" style="padding: 40px; height: 100%; text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <i class="fas fa-microchip" style="font-size: 3rem; color: #2997ff; margin-bottom: 20px;"></i>
                    <h3 style="color: #fff; font-weight: 700;">A17 Pro chip.</h3>
                    <p style="color: #86868b;">A monster win for gaming. A huge leap for performance.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card" style="padding: 40px; height: 100%; text-align: center;">
                    <span style="font-size: 4rem; font-weight: 800; display: block;" class="gradient-text">29hrs</span>
                    <p style="color: #fff; font-weight: 600; margin-top: 10px;">Video Playback</p>
                    <p style="color: #86868b; font-size: 0.9rem;">iPhone 15 Pro Max has the best battery life of any iPhone ever.</p>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="glass-card" style="padding: 40px; height: 100%; display: flex; align-items: center; gap: 30px;">
                    <div style="flex: 1;">
                        <h3 style="color: #fff; font-weight: 700;">The most powerful Pro camera system ever.</h3>
                        <p style="color: #86868b; margin-bottom: 0;">From more flexibility to next-generation portraits, see what you can do with our most advanced camera system.</p>
                    </div>
                    <div style="width: 100px; height: 100px; background: rgba(255,255,255,0.05); border-radius: 20px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-camera" style="font-size: 2.5rem; color: #fff;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 100px 0; background-color: #080808;">
    <div class="container text-center">
        <h2 style="font-size: 3rem; font-weight: 700; color: #fff; margin-bottom: 60px;">Explore the design.</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div style="background: #121212; border-radius: 30px; padding: 20px; transition: transform 0.3s ease;" 
                     onmouseover="this.style.transform='scale(1.05)'" 
                     onmouseout="this.style.transform='scale(1)'">
                    <img src="https://via.placeholder.com/400x600/121212/888888?text=Side+View" alt="Side View" class="img-fluid" style="border-radius: 20px;">
                    <p style="color: #86868b; margin-top: 20px; font-weight: 500;"> Aerospace-grade Titanium</p>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: #121212; border-radius: 30px; padding: 20px; transition: transform 0.3s ease;"
                     onmouseover="this.style.transform='scale(1.05)'" 
                     onmouseout="this.style.transform='scale(1)'">
                    <img src="https://via.placeholder.com/400x600/121212/888888?text=Back+View" alt="Back View" class="img-fluid" style="border-radius: 20px;">
                    <p style="color: #86868b; margin-top: 20px; font-weight: 500;">Textured Matte Glass</p>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: #121212; border-radius: 30px; padding: 20px; transition: transform 0.3s ease;"
                     onmouseover="this.style.transform='scale(1.05)'" 
                     onmouseout="this.style.transform='scale(1)'">
                    <img src="https://via.placeholder.com/400x600/121212/888888?text=Front+View" alt="Front View" class="img-fluid" style="border-radius: 20px;">
                    <p style="color: #86868b; margin-top: 20px; font-weight: 500;">Ceramic Shield Front</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="padding: 80px 0; background-color: #000;">
    <div class="container">
        <h3 style="font-weight: 700; color: #fff; margin-bottom: 40px;">Essential Accessories</h3>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="glass-card" style="padding: 20px; text-align: center; border-radius: 20px;">
                    <img src="https://via.placeholder.com/200?text=MagSafe+Case" class="img-fluid mb-3" alt="Case">
                    <h6 style="color: #fff; font-weight: 600; font-size: 0.9rem;">FineWoven Case</h6>
                    <p style="color: #0071e3; font-weight: bold; margin-bottom: 15px;">₹5,900</p>
                    <button class="btn btn-sm btn-primary rounded-pill w-100" style="font-size: 0.8rem;">Add to Bag</button>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card" style="padding: 20px; text-align: center; border-radius: 20px;">
                    <img src="https://via.placeholder.com/200?text=MagSafe+Charger" class="img-fluid mb-3" alt="Charger">
                    <h6 style="color: #fff; font-weight: 600; font-size: 0.9rem;">MagSafe Charger</h6>
                    <p style="color: #0071e3; font-weight: bold; margin-bottom: 15px;">₹4,500</p>
                    <button class="btn btn-sm btn-primary rounded-pill w-100" style="font-size: 0.8rem;">Add to Bag</button>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card" style="padding: 20px; text-align: center; border-radius: 20px;">
                    <img src="https://via.placeholder.com/200?text=AirPods+Pro" class="img-fluid mb-3" alt="AirPods">
                    <h6 style="color: #fff; font-weight: 600; font-size: 0.9rem;">AirPods Pro (2nd Gen)</h6>
                    <p style="color: #0071e3; font-weight: bold; margin-bottom: 15px;">₹24,900</p>
                    <button class="btn btn-sm btn-primary rounded-pill w-100" style="font-size: 0.8rem;">Add to Bag</button>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="glass-card" style="padding: 20px; text-align: center; border-radius: 20px;">
                    <img src="https://via.placeholder.com/200?text=20W+Adapter" class="img-fluid mb-3" alt="Adapter">
                    <h6 style="color: #fff; font-weight: 600; font-size: 0.9rem;">20W USB-C Adapter</h6>
                    <p style="color: #0071e3; font-weight: bold; margin-bottom: 15px;">₹1,900</p>
                    <button class="btn btn-sm btn-primary rounded-pill w-100" style="font-size: 0.8rem;">Add to Bag</button>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>