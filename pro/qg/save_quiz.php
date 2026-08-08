<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['quiz_title'];
    $questions = $_POST['q'];
    
    // For a production app, we would use MySQL. 
    // For this lightweight version, we store in a JSON file as a flat-file database.
    $db_file = 'quizzes.json';
    $current_data = json_decode(file_get_contents($db_file), true);
    
    $new_quiz = [
        "id" => uniqid(),
        "title" => $title,
        "data" => $_POST
    ];
    
    $current_data[] = $new_quiz;
    file_put_contents($db_file, json_encode($current_data));
    
    header("Location: index.php?success=1");
}
?>