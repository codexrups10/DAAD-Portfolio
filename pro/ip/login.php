<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle login
$login_error = '';
$login_success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Simple validation (in a real app, check against database)
    if (!empty($email) && !empty($password)) {
        // For demo purposes, accept any email/password combination
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $email;
        $_SESSION['user_name'] = explode('@', $email)[0]; // Extract name from email
        $login_success = 'Login successful! Welcome back.';
        // Redirect after successful login
        header('Location: index.php');
        exit();
    } else {
        $login_error = 'Please enter both email and password.';
    }
}

// Handle registration
$register_error = '';
$register_success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    $name = trim($_POST['reg_name']);
    $email = trim($_POST['reg_email']);
    $password = trim($_POST['reg_password']);
    $confirm_password = trim($_POST['reg_confirm_password']);

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $register_error = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $register_error = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $register_error = 'Password must be at least 6 characters long.';
    } else {
        // In a real app, save to database
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = $email;
        $_SESSION['user_name'] = $name;
        $register_success = 'Registration successful! Welcome to iPhone Store.';
        header('Location: index.php');
        exit();
    }
}

// Handle forgot password
$forgot_error = '';
$forgot_success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['forgot_password'])) {
    $email = trim($_POST['forgot_email']);

    if (empty($email)) {
        $forgot_error = 'Please enter your email address.';
    } else {
        // In a real app, send reset email
        $forgot_success = 'Password reset instructions have been sent to your email.';
    }
}

// Check if user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - iPhone Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-hero {
            background: linear-gradient(135deg, #000 0%, #1a1a1a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white;
        }
        .auth-hero::before {
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
        .auth-hero .container {
            position: relative;
            z-index: 2;
        }
        .auth-card {
            background: linear-gradient(135deg, #2a2a2a 0%, #3a3a3a 100%);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
            border: 1px solid rgba(0,113,227,0.2);
            color: white;
            overflow: hidden;
        }
        .auth-header {
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
            padding: 2rem;
            text-align: center;
        }
        .auth-body {
            padding: 2rem;
        }
        .form-control {
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            border-radius: 10px;
            padding: 0.75rem 1rem;
        }
        .form-control:focus {
            background: #1a1a1a;
            border-color: #0071e3;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(0,113,227,0.25);
        }
        .form-control::placeholder {
            color: #cccccc;
        }
        .form-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .btn-auth {
            background: linear-gradient(135deg, #0071e3 0%, #2997ff 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,113,227,0.3);
        }
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        .social-btn {
            flex: 1;
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.1);
            color: white;
            border-radius: 10px;
            padding: 0.75rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .social-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
        }
        .social-btn.google { border-color: #ea4335; }
        .social-btn.google:hover { background: rgba(234, 67, 53, 0.2); }
        .social-btn.facebook { border-color: #1877f2; }
        .social-btn.facebook:hover { background: rgba(24, 119, 242, 0.2); }
        .social-btn.apple { border-color: #000000; }
        .social-btn.apple:hover { background: rgba(0, 0, 0, 0.3); }
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #cccccc;
        }
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255,255,255,0.2);
        }
        .divider::before { margin-right: 1rem; }
        .divider::after { margin-left: 1rem; }
        .auth-tabs {
            display: flex;
            margin-bottom: 2rem;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 0.25rem;
        }
        .auth-tab {
            flex: 1;
            padding: 0.75rem;
            border: none;
            background: transparent;
            color: #cccccc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .auth-tab.active {
            background: #0071e3;
            color: white;
        }
        .auth-content {
            display: none;
        }
        .auth-content.active {
            display: block;
        }
        .forgot-password {
            text-align: center;
            margin-top: 1rem;
        }
        .forgot-password a {
            color: #0071e3;
            text-decoration: none;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .register-benefits {
            background: rgba(0,113,227,0.1);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .benefit-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }
        .benefit-item i {
            color: #0071e3;
            margin-right: 0.5rem;
            width: 16px;
        }
        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.875rem;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
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
                    <li class="nav-item"><a class="nav-link" href="compare.php"><i class="fas fa-balance-scale"></i> Compare</a></li>
                    <li class="nav-item"><a class="nav-link active" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="auth-hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="auth-card">
                        <div class="auth-header">
                            <i class="fas fa-mobile-alt fa-3x mb-3"></i>
                            <h2>Welcome to iPhone Store</h2>
                            <p class="mb-0">Sign in to your account or create a new one</p>
                        </div>

                        <div class="auth-tabs">
                            <button class="auth-tab active" onclick="switchTab('login')">Login</button>
                            <button class="auth-tab" onclick="switchTab('register')">Register</button>
                        </div>

                        <!-- Login Form -->
                        <div id="login-content" class="auth-content active">
                            <div class="auth-body">
                                <div class="social-login">
                                    <a href="#" class="social-btn google">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                    <a href="#" class="social-btn facebook">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a href="#" class="social-btn apple">
                                        <i class="fab fa-apple"></i> Apple
                                    </a>
                                </div>

                                <div class="divider">or continue with email</div>

                                <?php if ($login_error): ?>
                                    <div class="alert alert-danger"><?php echo $login_error; ?></div>
                                <?php endif; ?>

                                <?php if ($login_success): ?>
                                    <div class="alert alert-success"><?php echo $login_success; ?></div>
                                <?php endif; ?>

                                <form method="post">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="remember">
                                        <label class="form-check-label" for="remember">Remember me</label>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-auth w-100">Sign In</button>
                                </form>

                                <div class="forgot-password">
                                    <a href="#" onclick="switchTab('forgot')">Forgot your password?</a>
                                </div>
                            </div>
                        </div>

                        <!-- Register Form -->
                        <div id="register-content" class="auth-content">
                            <div class="auth-body">
                                <div class="register-benefits">
                                    <h6 class="mb-3"><i class="fas fa-star text-warning"></i> Join iPhone Store Today</h6>
                                    <div class="benefit-item">
                                        <i class="fas fa-check"></i> Exclusive deals and early access
                                    </div>
                                    <div class="benefit-item">
                                        <i class="fas fa-check"></i> Free shipping on orders over $500
                                    </div>
                                    <div class="benefit-item">
                                        <i class="fas fa-check"></i> Priority customer support
                                    </div>
                                    <div class="benefit-item">
                                        <i class="fas fa-check"></i> Extended warranty options
                                    </div>
                                </div>

                                <div class="social-login">
                                    <a href="#" class="social-btn google">
                                        <i class="fab fa-google"></i> Google
                                    </a>
                                    <a href="#" class="social-btn facebook">
                                        <i class="fab fa-facebook-f"></i> Facebook
                                    </a>
                                    <a href="#" class="social-btn apple">
                                        <i class="fab fa-apple"></i> Apple
                                    </a>
                                </div>

                                <div class="divider">or create account</div>

                                <?php if ($register_error): ?>
                                    <div class="alert alert-danger"><?php echo $register_error; ?></div>
                                <?php endif; ?>

                                <?php if ($register_success): ?>
                                    <div class="alert alert-success"><?php echo $register_success; ?></div>
                                <?php endif; ?>

                                <form method="post">
                                    <div class="mb-3">
                                        <label for="reg_name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="reg_name" name="reg_name" placeholder="Enter your full name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="Enter your email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="Create a password" required onkeyup="checkPasswordStrength()">
                                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('reg_password')">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <div id="password-strength" class="password-strength"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="reg_confirm_password" name="reg_confirm_password" placeholder="Confirm your password" required>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="terms" required>
                                        <label class="form-check-label" for="terms">
                                            I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#" class="text-primary">Privacy Policy</a>
                                        </label>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="newsletter_reg">
                                        <label class="form-check-label" for="newsletter_reg">Subscribe to our newsletter for exclusive offers</label>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-auth w-100">Create Account</button>
                                </form>
                            </div>
                        </div>

                        <!-- Forgot Password Form -->
                        <div id="forgot-content" class="auth-content">
                            <div class="auth-body">
                                <div class="text-center mb-4">
                                    <i class="fas fa-key fa-3x text-primary mb-3"></i>
                                    <h4>Reset Your Password</h4>
                                    <p>Enter your email address and we'll send you instructions to reset your password.</p>
                                </div>

                                <?php if ($forgot_error): ?>
                                    <div class="alert alert-danger"><?php echo $forgot_error; ?></div>
                                <?php endif; ?>

                                <?php if ($forgot_success): ?>
                                    <div class="alert alert-success"><?php echo $forgot_success; ?></div>
                                <?php endif; ?>

                                <form method="post">
                                    <div class="mb-3">
                                        <label for="forgot_email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="forgot_email" name="forgot_email" placeholder="Enter your email" required>
                                    </div>
                                    <button type="submit" name="forgot_password" class="btn btn-auth w-100">Send Reset Instructions</button>
                                </form>

                                <div class="text-center mt-3">
                                    <a href="#" onclick="switchTab('login')" class="text-primary">Back to Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h5>Secure Shopping</h5>
                    <p>Your personal information and payment details are always protected with bank-level security.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-truck fa-3x text-success mb-3"></i>
                    <h5>Fast Delivery</h5>
                    <p>Free shipping on orders over $500. Express delivery available for urgent orders.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-headset fa-3x text-info mb-3"></i>
                    <h5>24/7 Support</h5>
                    <p>Our expert support team is available around the clock to help with any questions.</p>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        function switchTab(tab) {
            // Hide all content
            document.querySelectorAll('.auth-content').forEach(content => {
                content.classList.remove('active');
            });
            document.querySelectorAll('.auth-tab').forEach(tabBtn => {
                tabBtn.classList.remove('active');
            });

            // Show selected content
            document.getElementById(tab + '-content').classList.add('active');
            event.target.classList.add('active');
        }

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            const password = document.getElementById('reg_password').value;
            const strengthIndicator = document.getElementById('password-strength');

            let strength = 0;
            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^A-Za-z0-9]/)) strength++;

            strengthIndicator.className = 'password-strength';

            if (strength <= 2) {
                strengthIndicator.classList.add('strength-weak');
                strengthIndicator.textContent = 'Weak password';
            } else if (strength <= 4) {
                strengthIndicator.classList.add('strength-medium');
                strengthIndicator.textContent = 'Medium strength';
            } else {
                strengthIndicator.classList.add('strength-strong');
                strengthIndicator.textContent = 'Strong password';
            }
        }

        // Auto-switch to register tab if register error exists
        <?php if ($register_error || $register_success): ?>
            document.addEventListener('DOMContentLoaded', function() {
                switchTab('register');
            });
        <?php endif; ?>

        // Auto-switch to forgot password tab if forgot error/success exists
        <?php if ($forgot_error || $forgot_success): ?>
            document.addEventListener('DOMContentLoaded', function() {
                switchTab('forgot');
            });
        <?php endif; ?>
    </script>
</body>
</html>