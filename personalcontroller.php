<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO personal_info (program, full_name, student_id, birth_date, age, jkm_number, race, gender, disability, address, home_phone, mobile_phone, bank_account_number, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['program'], $_POST['full_name'], $_POST['student_id'], $_POST['birth_date'],
        $_POST['age'], $_POST['jkm_number'], $_POST['race'], $_POST['gender'], $_POST['disability'],
        $_POST['address'], $_POST['home_phone'], $_POST['mobile_phone'], $_POST['bank_account_number'], $_POST['email']
    ]);
    header('Location: personasuccess.php');
}
?>
