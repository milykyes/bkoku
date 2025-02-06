<?php 
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = $_POST['user_type'];
    $confirm_password = $_POST['confirm_password'];

    // First, validate passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
        $error_type = "password";
    } else {
        // Check if email is already registered
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = "Email is already registered.";
            $error_type = "email";
        } else {
            // Check if username is already registered
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = "Username is already registered.";
                $error_type = "username";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                try {
                    if ($status === 'admin') {
                        $admin_registration_key = $_POST['admin_key'];
                        $hashed_key = password_hash($admin_registration_key, PASSWORD_BCRYPT);
                        
                        $stmt = $pdo->prepare("INSERT INTO users (full_name, username, email, password, admin_key, status) VALUES (?, ?, ?, ?, ?, 'admin')");
                        $stmt->execute([$full_name, $username, $email, $hashed_password, $hashed_key]);
                        $is_admin = true;
                    } else {
                        // Regular user registration
                        $stmt = $pdo->prepare("INSERT INTO users (full_name, username, email, password, status) VALUES (?, ?, ?, ?, 'user')");
                        $stmt->execute([$full_name, $username, $email, $hashed_password]);
                        $is_admin = false;
                    }
                } catch (PDOException $e) {
                    $error = "Registration failed: " . $e->getMessage();
                    $error_type = "system";
                }
            }
        }
    }
}
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Status - Disabilities Student Scholarship</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
            --error-color: #ff4444;
            --success-color: #00C851;
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
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 20px;
            text-align: center;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success .status-icon {
            color: var(--success-color);
        }

        .error .status-icon {
            color: var(--error-color);
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        .button {
            display: inline-block;
            padding: 1rem 2rem;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .back-link {
            display: inline-block;
            margin-top: 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: white;
            text-decoration: underline;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        @media (max-width: 480px) {
            .container {
                padding: 2rem;
            }

            h1 {
                font-size: 2rem;
            }

            .button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container <?php echo isset($error) ? 'error' : 'success'; ?>">
        <div class="status-icon">
            <?php echo isset($error) ? '❌' : '✅'; ?>
        </div>
        
        <?php if (isset($error)): ?>
            <h1>Registration Failed</h1>
            <p><?php echo htmlspecialchars($error); ?></p>
            <div class="buttons">
                <a href="register.html" class="button">Try Again</a>
                <a href="login.php" class="button" style="background-color: rgba(255, 255, 255, 0.2);">Back to Login</a>
            </div>
        <?php else: ?>
            <h1><?php echo $is_admin ? 'Admin' : 'User'; ?> Registration Successful!</h1>
            <p>Welcome, <?php echo htmlspecialchars($full_name); ?>! Your account has been created successfully.</p>
            <div class="buttons">
                <a href="<?php echo $is_admin ? 'admin_login.php' : 'login.php'; ?>" class="button">Login Now</a>
                <a href="index.php" class="button" style="background-color: rgba(255, 255, 255, 0.2);">Back to Home</a>
            </div>
        <?php endif; ?>
        
        <a href="index.php" class="back-link">Return to Homepage</a>
    </div>

    <script>
        // Auto-redirect after successful registration (optional)
        <?php if (!isset($error)): ?>
        setTimeout(function() {
            window.location.href = '<?php echo $is_admin ? "admin_login.php" : "login.php"; ?>';
        }, 5000);  // Redirect after 5 seconds
        <?php endif; ?>
    </script>
</body>
</html>