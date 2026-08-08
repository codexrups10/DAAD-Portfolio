<?php
session_start();
$conn = new mysqli("localhost", "root", "", "quiz_db");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Simple Signup (Checks if exists, else creates)
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $pass);
    if($stmt->execute()){
        $_SESSION['user_id'] = $conn->insert_id;
        header("Location: index.php");
    } else {
        // Handle login logic if user exists
    }
}
?>
<div style="text-align: center; margin-top: 100px;">
    <h1>Create Profile / Login</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit">Let's Play</button>
    </form>
</div>