<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Details - Elite University</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    

    <main>
        <div class="form-container">
            <h3>Confirm Your Details</h3>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $first_name = htmlspecialchars($_POST['first_name']);
                $last_name = htmlspecialchars($_POST['last_name']);
                $dob = htmlspecialchars($_POST['dob']);
                $email = htmlspecialchars($_POST['email']);
                $phone = htmlspecialchars($_POST['phone']);
                $address = htmlspecialchars($_POST['address']);
                $city = htmlspecialchars($_POST['city']);
                $state = htmlspecialchars($_POST['state']);
                $zip = htmlspecialchars($_POST['zip']);
                $gender = htmlspecialchars($_POST['gender']);
                $emergency_contact = htmlspecialchars($_POST['emergency_contact']);
            ?>
            <form action="success.php" method="POST">
                <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
                <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
                <input type="hidden" name="dob" value="<?php echo $dob; ?>">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                <input type="hidden" name="address" value="<?php echo $address; ?>">
                <input type="hidden" name="city" value="<?php echo $city; ?>">
                <input type="hidden" name="state" value="<?php echo $state; ?>">
                <input type="hidden" name="zip" value="<?php echo $zip; ?>">
                <input type="hidden" name="gender" value="<?php echo $gender; ?>">
                <input type="hidden" name="emergency_contact" value="<?php echo $emergency_contact; ?>">

                <div class="confirmation-details">
                    <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $last_name; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
                    <p><strong>Email:</strong> <?php echo $email; ?></p>
                    <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                    <p><strong>Address:</strong> <?php echo $address . ', ' . $city . ', ' . $state . ' ' . $zip; ?></p>
                    <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                    <p><strong>Emergency Contact:</strong> <?php echo $emergency_contact; ?></p>
                </div>

                <button type="submit" class="submit-btn">Confirm and Submit</button>
            </form>
            <?php
            } else {
                header("Location: form.html");
                exit();
            }
            ?>
        </div>
    </main>

    <footer>
        <div class="footer-container">
            <p>&copy; 2025 Elite University. All rights reserved.</p>
            <p>Contact: admissions@eliteuniversity.edu | Phone: (123) 456-7890</p>
        </div>
    </footer>
</body>
</html>