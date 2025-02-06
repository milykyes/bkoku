<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO claims_info (student_id, claim_type, amount) 
        VALUES (?, ?, ?)"
    );
    $stmt->execute([
        $_POST['student_id'], $_POST['claim_type'], $_POST['amount']
    ]);
    header('Location: claim_success.php');
}
?>
