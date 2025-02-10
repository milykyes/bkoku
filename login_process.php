<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists in the database
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Verify the entered password against the hashed password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start the session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            header('Location: home.php'); // Redirect to home
            exit;
        } else {
            // Invalid password
            header('Location: login.php?error=Invalid password.');
            exit;
        }
    } else {
        // Username not found
        header('Location: login.php?error=Username not found.');
        exit;
    }
}
?>
