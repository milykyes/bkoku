<?php
session_start();
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username']; // Collect the username input
    $password = $_POST['password']; // Collect the password input

    // Fetch the user from the database
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // If user exists, verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, set up the session
        $_SESSION['user_id'] = $user['id']; // Save user ID in session
        header('Location: home.php'); // Redirect to the home page
        exit;
    } else {
        // Invalid credentials
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
        background-image: url('images/home.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: Arial, sans-serif;
        color: #ffffff;
        }
</style>
</head>
<body>
<nav>
        <div class="logo">Disabilities Student Scholarship</div>
        <div class="nav-links">
            <a href="logout.php" class="nav-link logout">Logout</a>
        </div>
    </nav>
    
    <div class="container">
        <form method="POST" action="login_process.php" class="register-form">
            <h2>Log In</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn">Sign in</button>
            <p class="login-link">Don't have an account? <a href="register.html">Create account here</a></p>
        </form>
    </div>
</body>
</html>
