<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $claim_type = $_POST['claim_type'];
    $amount = $_POST['amount'];

    try {
        $stmt = $pdo->prepare("INSERT INTO claims_info (student_id, claim_type, amount) VALUES (?, ?, ?)");
        $stmt->execute([$student_id, $claim_type, $amount]);
        $success_message = "Claim created successfully!";
    } catch (PDOException $e) {
        $error_message = "Error creating claim: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Claim</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Reuse the same style from manage-claims.php */
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
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
            background-image: url('images/home.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--text-light);
        }

        .container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
        }

        .card {
            background-color: var(--background-dark);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-light);
            position: relative;
            padding-bottom: 1rem;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-light);
        }

        input, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 5px;
            background-color: var(--input-bg);
            color: var(--text-light);
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-back {
            background-color: #666;
            color: white;
            text-decoration: none;
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .message {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .success {
            background-color: rgba(76,175,80,0.1);
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .error {
            background-color: rgba(255,0,0,0.1);
            border: 1px solid #ff0000;
            color: #ff0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Create New Claim</h2>

            <?php if (isset($success_message)): ?>
                <div class="message success">
                    <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_message)): ?>
                <div class="message error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="student_id">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" required>
                </div>

                <div class="form-group">
                    <label for="claim_type">Claim Type:</label>
                    <select id="claim_type" name="claim_type" required>
                        <option value="Tuition Fee">Tuition Fee</option>
                        <option value="Allowance">Allowance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount (RM):</label>
                    <input type="number" id="amount" name="amount" step="0.01" required>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Create Claim
                    </button>
                    <a href="manage-claim-info.php" class="btn btn-back">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>