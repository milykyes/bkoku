<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_name = htmlspecialchars($_SESSION['admin_name']); // Sanitize the output
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f5f5f5;
        }

        .navbar {
            background: #333;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 1.5rem;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.2s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card h3 {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
<nav class="navbar">
    <h1>Admin Dashboard</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
</nav>

<div class="container">
    <div class="welcome-card">
        <h2>Welcome, <?php echo $admin_name; ?>!</h2>
        <p>Here's your admin dashboard overview</p>
    </div>

    <div class="stats-grid">
        <!-- New clickable cards -->
        <a href="manage-users.php" class="stat-card">
            <h3>Manage users</h3>
            <p>View</p>
        </a>
        <a href="manage-personal-info.php" class="stat-card">
            <h3>Manage Personal Information</h3>
            <p>View</p>
        </a>
        <a href="manage-academic-info.php" class="stat-card">
            <h3>Manage Academic Information</h3>
            <p>View</p>
        </a>
        
    </div>
</div>
</body>
</html>
