<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}
$admin_name = htmlspecialchars($_SESSION['admin_name']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: rgb(13, 13, 14);
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: rgba(236, 240, 241, 0.8);
            --card-color: rgba(255, 255, 255, 0.9);
        }

        body {
            background-image: url('images/home.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .navbar {
            background: var(--primary-color);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .navbar h1 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar h1 i {
            font-size: 1.8rem;
        }

        .logout-btn {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .container {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .welcome-card {
            background: var(--card-color);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            border-left: 5px solid var(--secondary-color);
        }

        .welcome-card h2 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .welcome-card p {
            color: #333;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: var(--card-color);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--secondary-color);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .stat-card:hover::before {
            transform: scaleX(1);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        .stat-card h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .stat-card p {
            font-size: 1rem;
            color: #333;
            margin-bottom: 1rem;
        }

        .stat-card .actions {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .stat-card .action-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .action-btn.view {
            background: #3498db;
            color: white;
        }

        .action-btn.edit {
            background: #2ecc71;
            color: white;
        }

        .action-btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
                padding: 1rem;
            }

            .container {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1><i class="fas fa-shield-alt"></i> Admin Dashboard</h1>
        <a href="logout.php" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>

    <div class="container">
        <div class="welcome-card">
            <h2><i class="fas fa-user-circle"></i> Welcome, <?php echo $admin_name; ?>!</h2>
            <p>Manage your system's data and user information from this dashboard.</p>
        </div>

        <div class="stats-grid">
            <a href="manage-users.php" class="stat-card">
                <i class="fas fa-users"></i>
                <h3>Manage Users</h3>
                <p>Handle user accounts and permissions</p>
                <div class="actions">
                    <button class="action-btn view">View All</button>
                    <button class="action-btn edit">Add New</button>
                </div>
            </a>

            <a href="manage-personal-info.php" class="stat-card">
                <i class="fas fa-id-card"></i>
                <h3>Manage Personal Information</h3>
                <p>Process and update personal information details</p>
                <div class="actions">
                    <button class="action-btn view">View Records</button>
                    <button class="action-btn edit">Add New</button>
                </div>
            </a>

            <a href="manage_academic.php" class="stat-card">
                <i class="fas fa-graduation-cap"></i>
                <h3>Manage Academic Information</h3>
                <p>Update academic records and details</p>
                <div class="actions">
                    <button class="action-btn view">View Records</button>
                    <button class="action-btn edit">Add Record</button>
                </div>
            </a>

            <a href="manage-claim-info.php" class="stat-card">
                <i class="fas fa-file-invoice-dollar"></i>
                <h3>Manage Claim Information</h3>
                <p>Process and update claim details</p>
                <div class="actions">
                    <button class="action-btn view">View Claims</button>
                    <button class="action-btn edit">New Claim</button>
                </div>
            </a>
        </div>
    </div>
</body>
</html>