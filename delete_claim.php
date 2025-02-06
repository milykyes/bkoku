<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $delete_id = $_POST['student_id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM claims_info WHERE id = ?");
        $stmt->execute([$delete_id]);
        $success_message = "Claim deleted successfully!";
    } catch (PDOException $e) {
        $error_message = "Error deleting claim: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Claim</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
            --background-dark: #121212;
            --input-bg: #2C2C2C;
            --text-light: #ffffff;
            --text-gray: #aaaaaa;
            --error-color: #ff3333;
            --success-color: #4CAF50;
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

        nav {
            background-color: var(--background-dark);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .card {
            background-color: var(--background-dark);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid var(--primary-color);
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-light);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-back {
            background-color: #666;
        }

        /* Form-specific styles */
        .form-group {
            margin-bottom: 1.5rem; /* Added space between student ID and buttons */
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-gray);
        }

        .form-control {
            width: 100%; /* Make input wider */
            max-width: 400px; /* Maximum width for student ID input */
            padding: 0.75rem;
            background-color: var(--input-bg);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 5px;
            color: var(--text-light);
        }

        .btn-delete, .btn-cancel {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            color: var(--text-light);
            min-width: 120px; /* Ensure buttons match back button width */
            justify-content: center;
        }

        .btn-delete {
            background-color: #f44336; /* Red color for delete */
        }

        .btn-cancel {
            background-color: #2196F3; /* Blue color for cancel */
        }

        .form-group-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .delete-warning {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
        }

        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .form-group-buttons {
                flex-direction: column;
            }

            .btn-delete, .btn-cancel {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-trash"></i>
            Delete Claim
        </div>
        <a href="manage-claim-info.php" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="page-header">
                <h2 class="page-title">Confirm Claim Deletion</h2>
            </div>

            <?php if (isset($success_message)): ?>
    <div class="alert-success">
        <i class="fas fa-check-circle"></i>
        <?php echo htmlspecialchars($success_message); ?>
    </div>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <div class="alert-error">
        <i class="fas fa-exclamation-circle"></i>
        <?php echo htmlspecialchars($error_message); ?>
    </div>
<?php endif; ?>
            <div class="delete-warning">
                <strong>Warning:</strong> You are about to permanently delete a claim.
            </div>

            <form method="POST" action="">
                <div class="form-group">
                    <label>Claim ID</label>
                    <input type="text" class="form-control" name="student_id" value="<?php echo htmlspecialchars($student_id ?? ''); ?>" required>
                </div>

                <div class="form-group form-group-buttons">
                    <button type="submit" name="confirm_delete" class="btn-delete">
                        <i class="fas fa-trash"></i>
                        Confirm Delete
                    </button>
                    <a href="manage-claim-info.php" class="btn-cancel">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>