<?php
session_start();
require_once 'connection.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$claim_id = isset($_GET['id']) ? $_GET['id'] : null;


try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // First, fetch the existing claim data
    $stmt = $pdo->prepare("SELECT * FROM claims_info WHERE id = ?");
    if (!$stmt->execute([$claim_id])) {
        throw new Exception("Failed to fetch claim data");
    }
    
    $claim = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$claim) {
        header("Location: manage-claim-info.php");
        exit();
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate inputs
        if (empty($_POST['student_id']) || empty($_POST['claim_type']) || !isset($_POST['amount'])) {
            throw new Exception("All fields are required");
        }
        
        $updateStmt = $pdo->prepare("UPDATE claims_info SET 
            student_id = ?,
            claim_type = ?,
            amount = ?
            WHERE id = ?");
            
        $result = $updateStmt->execute([
            $_POST['student_id'],
            $_POST['claim_type'], 
            $_POST['amount'],
            $claim_id
        ]);
        
        if ($result && $updateStmt->rowCount() > 0) {
            // Refresh the claim data after successful update
            $stmt->execute([$claim_id]);
            $claim = $stmt->fetch(PDO::FETCH_ASSOC);
            $success_message = "Claim updated successfully!";
        } else {
            $error_message = "No changes were made or claim not found";
        }
    }
} catch (Exception $e) {
    $error_message = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Claim</title>
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
            max-width: 800px;
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-light);
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--text-light);
        }

        .btn-back {
            background-color: #666;
        }

        .btn-submit {
            background-color: var(--primary-color);
            color: white;
            width: 100%;
            justify-content: center;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-edit"></i>
            Update Claim
        </div>
        <a href="manage-claim-info.php" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="page-header">
                <h2 class="page-title">Update Claim #<?php echo htmlspecialchars($claim_id); ?></h2>
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

            <form method="POST">
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text"
                           id="student_id"
                           name="student_id"
                           class="form-control"
                           value="<?php echo htmlspecialchars($claim['student_id'] ?? ''); ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="claim_type">Claim Type</label>
                    <select id="claim_type" name="claim_type" class="form-control" required>
                        <option value="Tuition Fee" <?php echo ($claim['claim_type'] ?? '') === 'Tuition Fee' ? 'selected' : ''; ?>>Tuition Fee</option>
                        <option value="Allowance" <?php echo ($claim['claim_type'] ?? '') === 'Allowance' ? 'selected' : ''; ?>>Allowance</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount (RM)</label>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($claim['amount'] ?? ''); ?>" 
                           step="0.01" 
                           min="0" 
                           required>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-save"></i>
                        Update Claim
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>