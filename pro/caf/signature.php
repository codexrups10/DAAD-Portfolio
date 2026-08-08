<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admission - Signature</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h3>Step 3: Declaration & Signature</h3>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Store educational details in session
            $_SESSION['high_school'] = htmlspecialchars($_POST['high_school']);
            $_SESSION['graduation_year'] = htmlspecialchars($_POST['graduation_year']);
            $_SESSION['gpa'] = htmlspecialchars($_POST['gpa']);
            $_SESSION['sat_score'] = htmlspecialchars($_POST['sat_score']);
            $_SESSION['act_score'] = htmlspecialchars($_POST['act_score']);
            $_SESSION['intended_major'] = htmlspecialchars($_POST['intended_major']);
            $_SESSION['start_term'] = htmlspecialchars($_POST['start_term']);
            $_SESSION['how_heard'] = htmlspecialchars($_POST['how_heard']);
        }
        ?>
        <form action="confirmation.php" method="POST">
            <div class="form-group">
                <label>
                    <input type="checkbox" id="declaration" name="declaration" required>
                    I declare that the information provided is true and accurate to the best of my knowledge.
                </label>
            </div>

            <div class="form-group">
                <label for="signature">Please type your full name as electronic signature:</label>
                <input type="text" id="signature" name="signature" required placeholder="Type your full name here">
            </div>

            <div class="form-group">
                <label for="signature_date">Date:</label>
                <input type="date" id="signature_date" name="signature_date" required>
            </div>

            <button type="submit" class="submit-btn">Submit Application</button>
        </form>
    </div>
</body>
</html>