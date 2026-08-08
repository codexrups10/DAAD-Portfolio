<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <h1 class="h4 mb-0"><a href="index.php" class="text-white text-decoration-none">iPhone</a></h1>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search iPhones...">
                </div>
                <div class="col-md-3 text-end">
                    <a href="cart.php" class="btn btn-outline-light">Cart (<?php echo count($_SESSION['cart'] ?? []); ?>)</a>
                </div>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">iPhones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Accessories</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        <h1>Shopping Cart</h1>
        <?php
        session_start();
        include 'products.php';
        $cart = $_SESSION['cart'] ?? [];
        if (empty($cart)) {
            echo '<p>Your cart is empty.</p>';
        } else {
            $total = 0;
            echo '<table class="table">';
            echo '<thead><tr><th>Product</th><th>Price</th><th>Action</th></tr></thead><tbody>';
            foreach ($cart as $id) {
                foreach ($products as $p) {
                    if ($p['id'] == $id) {
                        echo '<tr>';
                        echo '<td>' . $p['name'] . '</td>';
                        echo '<td>₹' . $p['price'] . '</td>';
                        echo '<td><a href="remove_from_cart.php?id=' . $id . '" class="btn btn-danger btn-sm">Remove</a></td>';
                        echo '</tr>';
                        $total += $p['price'];
                        break;
                    }
                }
            }
            echo '</tbody></table>';
            echo '<h3>Total: ₹' . $total . '</h3>';
            echo '<a href="#" class="btn btn-success">Checkout</a>';
        }
        ?>
    </main>

    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p>&copy; 2023 iPhone Store. All rights reserved.</p>
        </div>
    </footer>

    <!-- Chatbot -->
    <div id="chatbot" class="chatbot">
        <div class="chatbot-header">
            <span>iPhone Assistant</span>
            <button id="close-chat" class="btn-close"></button>
        </div>
        <div class="chatbot-body" id="chat-messages">
            <div class="message bot">Hi! I'm here to help you choose the perfect iPhone. What's your budget?</div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="chat-input" placeholder="Type your message...">
            <button id="send-chat" class="btn btn-primary">Send</button>
        </div>
    </div>
    <div id="chat-toggle" class="chat-toggle">
        <span>💬</span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>