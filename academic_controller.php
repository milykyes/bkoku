<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prepare the INSERT query for academic_info table
    $stmt = $pdo->prepare(
        "INSERT INTO academic_info 
        (student_id, education_level, course_name, institution_name, start_date, end_date, current_semester, study_duration, months_per_semester, study_mode, cgpa, funding_source, sponsor_name) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    // Execute the statement with form inputs
    $stmt->execute([
        $_POST['student_id'],
        $_POST['education_level'],
        $_POST['course_name'],
        $_POST['institution_name'],
        $_POST['start_date'],
        $_POST['end_date'],
        $_POST['current_semester'],
        $_POST['study_duration'],
        $_POST['months_per_semester'],
        $_POST['study_mode'],
        $_POST['cgpa'],
        $_POST['funding_source'],
        $_POST['sponsor_name'],
    ]);

    // Redirect after successful insertion
    header('Location: academicsuccess.php');
    exit();
}
?>
