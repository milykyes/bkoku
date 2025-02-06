<?php
session_start();
require_once 'connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT claims_info.* FROM claims_info ORDER BY id DESC");
    $stmt->execute();
    $claims = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($claims)) {
        $error_message = "No claims found in database.";
    }
} catch (PDOException $e) {
    $error_message = "Error fetching claims: " . $e->getMessage();
}

$total_amount = 0;
if (!empty($claims)) {
    foreach ($claims as $claim) {
        $total_amount += $claim['amount'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Claims</title>
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

        .summary-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-item {
            padding: 1.5rem;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            text-align: center;
        }

        .stat-item h3 {
            font-size: 0.9rem;
            color: var(--text-gray);
            margin-bottom: 0.5rem;
        }

        .stat-item p {
            font-size: 1.5rem;
            font-weight: 600;
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

        .search-box {
            position: relative;
            width: 300px;
        }

        .search-box input {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 2px solid #333;
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-gray);
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        th {
            background-color: rgba(255,255,255,0.05);
            font-weight: 600;
            font-size: 0.9rem;
        }

        tbody tr {
            transition: background-color 0.3s ease;
        }

        tbody tr:hover {
            background-color: rgba(255,255,255,0.05);
        }

        .claim-amount {
            font-family: monospace;
            font-size: 1.1rem;
            font-weight: 500;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-edit {
            background-color: #2196F3;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--text-gray);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .page-header {
                flex-direction: column;
                gap: 1rem;
            }

            .search-box {
                width: 100%;
            }

            .table-container {
                margin: 0 -1rem;
            }

            th, td {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .stat-item {
                padding: 1rem;
            }

            .stat-item p {
                font-size: 1.2rem;
            }
        }
        </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-file-invoice"></i>
            View Claims
        </div>
        <a href="manage-claim-info.php" class="btn btn-back">
            <i class="fas fa-arrow-left"></i>
            Back
        </a>
    </nav>

    <div class="container">
        <div class="card">
            <div class="summary-stats">
                <div class="stat-item">
                    <h3>Total Claims</h3>
                    <p><?php echo count($claims); ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Amount (RM)</h3>
                    <p><?php echo number_format($total_amount, 2); ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="page-header">
                <h2 class="page-title">Claims List</h2>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" placeholder="Search claims...">
                </div>
            </div>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-error">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if (empty($claims)): ?>
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h3>No Claims Found</h3>
                    <p>There are no claims in the system yet.</p>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th width="20%">ID</th>
                                <th width="30%">Student ID</th>
                                <th width="25%">Claim Type</th>
                                <th width="25%">Amount (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($claims as $claim): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($claim['id']); ?></td>
                                    <td><?php echo htmlspecialchars($claim['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($claim['claim_type']); ?></td>
                                    <td class="claim-amount">
                                        <?php echo number_format($claim['amount'], 2); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');

            tableRows.forEach(row => {
                const cells = row.getElementsByTagName('td');
                let found = false;

                for (let cell of cells) {
                    const text = cell.textContent.toLowerCase();
                    if (text.includes(searchValue)) {
                        found = true;
                        break;
                    }
                }

                row.style.display = found ? '' : 'none';
            });
        });
    </script>
</body>
</html>