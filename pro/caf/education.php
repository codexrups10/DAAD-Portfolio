<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admission - Educational Details</title>
    <link rel="stylesheet" href="form.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="form-container">
        <h3>Step 2: Academic Background</h3>
        <?php
        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Store personal details in session
            $_SESSION['first_name'] = htmlspecialchars($_POST['first_name']);
            $_SESSION['last_name'] = htmlspecialchars($_POST['last_name']);
            $_SESSION['email'] = htmlspecialchars($_POST['email']);
            $_SESSION['phone'] = htmlspecialchars($_POST['phone']);
            $_SESSION['address'] = htmlspecialchars($_POST['address']);
            $_SESSION['city'] = htmlspecialchars($_POST['city']);
            $_SESSION['state'] = htmlspecialchars($_POST['state']);
            $_SESSION['zip'] = htmlspecialchars($_POST['zip']);
            $_SESSION['dob'] = htmlspecialchars($_POST['dob']);
            $_SESSION['gender'] = htmlspecialchars($_POST['gender']);
            $_SESSION['citizenship'] = htmlspecialchars($_POST['citizenship']);
            $_SESSION['emergency_contact'] = htmlspecialchars($_POST['emergency_contact']);
            $_SESSION['emergency_phone'] = htmlspecialchars($_POST['emergency_phone']);
        }
        ?>
        <form action="./signature.php" method="POST">
            <div class="form-group">
                <label for="high_school">High School Name:</label>
                <input type="text" id="high_school" name="high_school" required>
            </div>

            <div class="form-group">
                <label for="graduation_year">Graduation Year:</label>
                <input type="number" id="graduation_year" name="graduation_year" min="2000" max="2030" required>
            </div>

            <div class="form-group">
                <label for="gpa">GPA (out of 4.0):</label>
                <input type="number" id="gpa" name="gpa" step="0.01" min="0" max="4.0" required>
            </div>

            <div class="form-group">
                <label for="sat_score">SAT Score (optional):</label>
                <input type="number" id="sat_score" name="sat_score" min="400" max="1600">
            </div>

            <div class="form-group">
                <label for="act_score">ACT Score (optional):</label>
                <input type="number" id="act_score" name="act_score" min="1" max="36">
            </div>

            <div class="form-group">
                <label for="intended_major">Intended Major/Program:</label>
                <input type="text" id="intended_major" name="intended_major" required>
            </div>

            <div class="form-group">
                <label for="start_term">Preferred Start Term:</label>
                <select id="start_term" name="start_term" required>
                    <option value="">Select Term</option>
                    <option value="fall">Fall</option>
                    <option value="spring">Spring</option>
                    <option value="summer">Summer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="how_heard">How did you hear about us?</label>
                <select id="how_heard" name="how_heard">
                    <option value="">Select</option>
                    <option value="website">Website</option>
                    <option value="social_media">Social Media</option>
                    <option value="friend">Friend/Family</option>
                    <option value="school_counselor">School Counselor</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Next</button>
        </form>
    </div>
</body>
</html>