<?php
session_start();
require_once 'connection.php';

// Check if the admin is already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $admin_key = $_POST['admin_key']; // Match the name attribute in the form

    // Check if the admin exists in the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND status = 'admin'");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin) {
        // Validate admin registration key
        if ($admin_key === $admin['admin_key']) {
            // Set session variable
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];

            // Redirect to admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid registration key.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - OKU Student Financial System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

            :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
            --error-color: #ff3333;
            --background-dark: #121212;
            --input-bg: #2C2C2C;
            --text-light: #ffffff;
            --text-gray: #aaaaaa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('images/home.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            color: var(--text-light);
            line-height: 1.6;
        }

        nav {
            background-color: var(--background-dark);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--primary-color);
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 74px);
            padding: 2rem;
        }

        .login-form {
            background-color: var(--background-dark);
            border-radius: 15px;
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-light);
            font-size: 1.8rem;
            font-weight: 600;
        }

        .icon-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .icon-header i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 38px;
            color: var(--text-gray);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-light);
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 2px solid #333333;
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-light);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.1);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            text-align: center;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: var(--primary-dark);
        }

        @media (max-width: 600px) {
            .container {
                padding: 1rem;
            }

            .login-form {
                padding: 2rem;
            }

            nav {
                padding: 1rem;
            }

            .logo {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-universal-access"></i>
            OKU Student Financial System
        </div>
    </nav>

    <div class="container">
        <form method="POST" action="admin_login.php" class="login-form">
            <div class="icon-header">
                <i class="fas fa-user-shield"></i>
                <h2>Admin Login</h2>
            </div>
            
            <?php if (!empty($error)) : ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Username</label>
                <i class="fas fa-user"></i>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="admin_key">Admin Key</label>
                <i class="fas fa-key"></i>
                <input type="password" id="admin_key" name="admin_key" required>
            </div>

            <button type="submit" class="submit-btn">
                Login <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </button>

            <div class="back-link">
                <a href="index.php"><i class="fas fa-arrow-left"></i> Back to Home</a>
            </div>
        </form>
    </div>
</body>
</html>