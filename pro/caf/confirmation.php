<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admission - Confirmation</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h3>Review Your Application</h3>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Store signature and declaration in session
            $_SESSION['declaration'] = isset($_POST['declaration']) ? 'Yes' : 'No';
            $_SESSION['signature'] = htmlspecialchars($_POST['signature']);
            $_SESSION['signature_date'] = htmlspecialchars($_POST['signature_date']);

            // Retrieve all data from session
            $first_name = $_SESSION['first_name'];
            $last_name = $_SESSION['last_name'];
            $email = $_SESSION['email'];
            $phone = $_SESSION['phone'];
            $address = $_SESSION['address'];
            $city = $_SESSION['city'];
            $state = $_SESSION['state'];
            $zip = $_SESSION['zip'];
            $dob = $_SESSION['dob'];
            $gender = $_SESSION['gender'];
            $citizenship = $_SESSION['citizenship'];
            $emergency_contact = $_SESSION['emergency_contact'];
            $emergency_phone = $_SESSION['emergency_phone'];
            $high_school = $_SESSION['high_school'];
            $graduation_year = $_SESSION['graduation_year'];
            $gpa = $_SESSION['gpa'];
            $sat_score = $_SESSION['sat_score'];
            $act_score = $_SESSION['act_score'];
            $intended_major = $_SESSION['intended_major'];
            $start_term = $_SESSION['start_term'];
            $how_heard = $_SESSION['how_heard'];
            $declaration = $_SESSION['declaration'];
            $signature = $_SESSION['signature'];
            $signature_date = $_SESSION['signature_date'];
        ?>
        <form action="success.php" method="POST">
            <div class="confirmation-details">
                <h4>Personal Information</h4>
                <p><strong>First Name:</strong> <?php echo $first_name; ?></p>
                <p><strong>Last Name:</strong> <?php echo $last_name; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $phone; ?></p>
                <p><strong>Address:</strong> <?php echo $address . ', ' . $city . ', ' . $state . ' ' . $zip; ?></p>
                <p><strong>Date of Birth:</strong> <?php echo $dob; ?></p>
                <p><strong>Gender:</strong> <?php echo $gender; ?></p>
                <p><strong>Citizenship:</strong> <?php echo $citizenship; ?></p>
                <p><strong>Emergency Contact:</strong> <?php echo $emergency_contact . ' (' . $emergency_phone . ')'; ?></p>

                <h4>Academic Background</h4>
                <p><strong>High School:</strong> <?php echo $high_school; ?></p>
                <p><strong>Graduation Year:</strong> <?php echo $graduation_year; ?></p>
                <p><strong>GPA:</strong> <?php echo $gpa; ?></p>
                <p><strong>SAT Score:</strong> <?php echo $sat_score ?: 'Not provided'; ?></p>
                <p><strong>ACT Score:</strong> <?php echo $act_score ?: 'Not provided'; ?></p>
                <p><strong>Intended Major:</strong> <?php echo $intended_major; ?></p>
                <p><strong>Start Term:</strong> <?php echo $start_term; ?></p>
                <p><strong>How Heard:</strong> <?php echo $how_heard ?: 'Not specified'; ?></p>

                <h4>Declaration & Signature</h4>
                <p><strong>Declaration:</strong> <?php echo $declaration; ?></p>
                <p><strong>Signature:</strong> <?php echo $signature; ?></p>
                <p><strong>Date:</strong> <?php echo $signature_date; ?></p>
            </div>

            <button type="submit" class="submit-btn">Confirm and Submit</button>
        </form>
        <?php
        } else {
            echo "<p>No data submitted.</p>";
        }
        ?>
    </div>
</body>
</html>