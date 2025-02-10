<?php
session_start();
require_once 'connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Delete User
if (isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $success_message = "User deleted successfully";
    } catch (PDOException $e) {
        $error_message = "Error deleting user: " . $e->getMessage();
    }
}

// Handle Add/Edit User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_user'])) {
    $user_id = $_POST['user_id'] ?? null;
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    
    try {
        if ($user_id) { // Update existing user
            $stmt = $pdo->prepare("UPDATE users SET full_name = ?, username = ?, email = ?, status = ? WHERE id = ?");
            $stmt->execute([$full_name, $username, $email, $_POST['user_type'], $user_id]);
            $success_message = "User updated successfully";
        } else { // Add new user
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$status = $_POST['user_type']; // Get the value from form but use status in DB
$stmt = $pdo->prepare("INSERT INTO users (full_name, username, email, password, status) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$full_name, $username, $email, $password, $status]);
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch all users
// Fetch all users
try {
    $stmt = $pdo->query("SELECT id, full_name, username, email, status FROM users");
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "Error fetching users: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
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

        .card h2 {
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-color);
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        th {
            background-color: rgba(255,255,255,0.05);
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
            gap: 5px;
            color: white;
        }

        .btn-primary {
            background-color: var(--primary-color);
        }

        .btn-danger {
            background-color: var(--error-color);
        }

        .btn-edit {
            background-color: #2196F3;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 5px;
            background-color: var(--input-bg);
            color: var(--text-light);
        }

        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: rgba(76,175,80,0.1);
            border: 1px solid var(--success-color);
            color: var(--success-color);
        }

        .alert-error {
            background-color: rgba(255,51,51,0.1);
            border: 1px solid var(--error-color);
            color: var(--error-color);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--background-dark);
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 500px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            th, td {
                padding: 0.5rem;
            }

            .btn {
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-universal-access"></i>
            Manage Users
        </div>
        <div>
            <a href="admin_dashboard.php" class="btn">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </div>
    </nav>

    <div class="container">
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2>Add New User</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="full_name" required>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>User Type:</label>
                    <select name="user_type" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="submit_user" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add User
                </button>
            </form>
        </div>

        <div class="card">
            <h2>User List</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['status']); ?></td>
                                <td>
                                    <button class="btn btn-edit" onclick="editUser(<?php echo $user['id']; ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="" method="POST" style="display: inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" name="delete_user" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form action="" method="POST">
                <input type="hidden" name="user_id" id="edit_user_id">
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="full_name" id="edit_full_name" required>
                </div>
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" id="edit_username" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" id="edit_email" required>
                </div>
                <div class="form-group">
                    <label>User Type:</label>
                    <select name="user_type" id="edit_user_type" required>
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" name="submit_user" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <button type="button" class="btn btn-danger" onclick="closeModal()">
                    <i class="fas fa-times"></i> Cancel
                </button>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('editModal');

        function editUser(userId) {
            // In a real application, you would fetch user data from the server
            // For now, we'll just show the modal
            modal.style.display = 'flex';
            document.getElementById('edit_user_id').value = userId;
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>