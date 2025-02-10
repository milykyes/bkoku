<?php
session_start();
require_once 'connection.php';

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle Delete Record
if (isset($_POST['delete_record'])) {
    $id = $_POST['id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM academic_info WHERE id = ?");
        $stmt->execute([$id]);
        $success_message = "Record deleted successfully";
    } catch (PDOException $e) {
        $error_message = "Error deleting record: " . $e->getMessage();
    }
}

// Handle Add/Edit Record
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_record'])) {
    $id = $_POST['id'] ?? null;
    $student_id = $_POST['student_id'];
    $education_level = $_POST['education_level'];
    $course_name = $_POST['course_name'];
    $institution_name = $_POST['institution_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $current_semester = $_POST['current_semester'];
    $study_duration = $_POST['study_duration'];
    $months_per_semester = $_POST['months_per_semester'];
    $study_mode = $_POST['study_mode'];
    $cgpa = $_POST['cgpa'];
    $funding_source = $_POST['funding_source'];
    $sponsor_name = $_POST['sponsor_name'];
    
    try {
        if ($id) { // Update existing record
            $stmt = $pdo->prepare("UPDATE academic_info SET 
                student_id = ?, education_level = ?, course_name = ?, 
                institution_name = ?, start_date = ?, end_date = ?,
                current_semester = ?, study_duration = ?, months_per_semester = ?,
                study_mode = ?, cgpa = ?, funding_source = ?, sponsor_name = ? 
                WHERE id = ?");
            $stmt->execute([
                $student_id, $education_level, $course_name, $institution_name,
                $start_date, $end_date, $current_semester, $study_duration,
                $months_per_semester, $study_mode, $cgpa, $funding_source,
                $sponsor_name, $id
            ]);
            $success_message = "Record updated successfully";
        } else { // Add new record
            $stmt = $pdo->prepare("INSERT INTO academic_info (
                student_id, education_level, course_name, institution_name,
                start_date, end_date, current_semester, study_duration,
                months_per_semester, study_mode, cgpa, funding_source,
                sponsor_name
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $student_id, $education_level, $course_name, $institution_name,
                $start_date, $end_date, $current_semester, $study_duration,
                $months_per_semester, $study_mode, $cgpa, $funding_source,
                $sponsor_name
            ]);
            $success_message = "Record added successfully";
        }
    } catch (PDOException $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}

// Fetch all records
try {
    $stmt = $pdo->query("SELECT * FROM academic_info");
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    $error_message = "Error fetching records: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Academic Information</title>
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

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
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

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        th, td {
            padding: 0.75rem;
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
            z-index: 1000;
        }

        .modal-content {
            background-color: var(--background-dark);
            padding: 2rem;
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            Manage Academic Information
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
            <h2>Add New Academic Record</h2>
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label>Student ID:</label>
                        <input type="text" name="student_id" required>
                    </div>
                    <div class="form-group">
                        <label>Education Level:</label>
                        <input type="text" name="education_level" required>
                    </div>
                    <div class="form-group">
                        <label>Course Name:</label>
                        <input type="text" name="course_name" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Institution Name:</label>
                        <input type="text" name="institution_name" required>
                    </div>
                    <div class="form-group">
                        <label>Start Date:</label>
                        <input type="date" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label>End Date:</label>
                        <input type="date" name="end_date" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Current Semester:</label>
                        <input type="number" name="current_semester" required>
                    </div>
                    <div class="form-group">
                        <label>Study Duration (Years):</label>
                        <input type="number" name="study_duration" required>
                    </div>
                    <div class="form-group">
                        <label>Months per Semester:</label>
                        <input type="number" name="months_per_semester" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Study Mode:</label>
                        <select name="study_mode" required>
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>CGPA:</label>
                        <input type="number" step="0.01" name="cgpa" required>
                    </div>
                    <div class="form-group">
                        <label>Funding Source:</label>
                        <input type="text" name="funding_source" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sponsor Name:</label>
                    <input type="text" name="sponsor_name" required>
                </div>
                <button type="submit" name="submit_record" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Record
                </button>
            </form>
        </div>

        <div class="card">
            <h2>Academic Records</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Student ID</th>
                            <th>Education Level</th>
                            <th>Course Name</th>
                            <th>Institution</th>
                            <th>Study Mode</th>
                            <th>CGPA</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?php echo $record['id']; ?></td>
                                <td><?php echo htmlspecialchars($record['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($record['education_level']); ?></td>
                                <td><?php echo htmlspecialchars($record['course_name']); ?></td>
                                <td><?php echo htmlspecialchars($record['institution_name']); ?></td>
                                <td><?php echo htmlspecialchars($record['study_mode']); ?></td>
                                <td><?php echo htmlspecialchars($record['funding_source']); ?></td>
                                <td><?php echo htmlspecialchars($record['cgpa']); ?></td>
                                <td>
                                    <button class="btn btn-edit" onclick="editRecord(<?php echo htmlspecialchars(json_encode($record)); ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form action="" method="POST" style="display: inline;">
                                        <input type="hidden" name="id" value="<?php echo $record['id']; ?>">
                                        <button type="submit" name="delete_record" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">
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
    <!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <h2>Edit Academic Record</h2>
        <form action="" method="POST">
            <input type="hidden" name="id" id="edit_id">
            <div class="form-row">
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="text" name="student_id" id="edit_student_id" required>
                </div>
                <div class="form-group">
                    <label>Education Level:</label>
                    <input type="text" name="education_level" id="edit_education_level" required>
                </div>
                <div class="form-group">
                    <label>Course Name:</label>
                    <input type="text" name="course_name" id="edit_course_name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Institution Name:</label>
                    <input type="text" name="institution_name" id="edit_institution_name" required>
                </div>
                <div class="form-group">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" id="edit_start_date" required>
                </div>
                <div class="form-group">
                    <label>End Date:</label>
                    <input type="date" name="end_date" id="edit_end_date" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Current Semester:</label>
                    <input type="number" name="current_semester" id="edit_current_semester" required>
                </div>
                <div class="form-group">
                    <label>Study Duration (Years):</label>
                    <input type="number" name="study_duration" id="edit_study_duration" required>
                </div>
                <div class="form-group">
                    <label>Months per Semester:</label>
                    <input type="number" name="months_per_semester" id="edit_months_per_semester" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Study Mode:</label>
                    <select name="study_mode" id="edit_study_mode" required>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>CGPA:</label>
                    <input type="number" step="0.01" name="cgpa" id="edit_cgpa" required>
                </div>
                <div class="form-group">
                    <label>Funding Source:</label>
                    <input type="text" name="funding_source" id="edit_funding_source" required>
                </div>
            </div>
            <div class="form-group">
                <label>Sponsor Name:</label>
                <input type="text" name="sponsor_name" id="edit_sponsor_name" required>
            </div>
            <button type="submit" name="submit_record" class="btn btn-primary">
                <i class="fas fa-save"></i> Update Record
            </button>
            <button type="button" class="btn btn-danger" onclick="closeEditModal()">
                <i class="fas fa-times"></i> Cancel
            </button>
        </form>
    </div>
</div>


<script>
function editRecord(record) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('edit_id').value = record.id;
    document.getElementById('edit_student_id').value = record.student_id;
    document.getElementById('edit_education_level').value = record.education_level;
    document.getElementById('edit_course_name').value = record.course_name;
    document.getElementById('edit_institution_name').value = record.institution_name;
    document.getElementById('edit_start_date').value = record.start_date;
    document.getElementById('edit_end_date').value = record.end_date;
    document.getElementById('edit_current_semester').value = record.current_semester;
    document.getElementById('edit_study_duration').value = record.study_duration;
    document.getElementById('edit_months_per_semester').value = record.months_per_semester;
    document.getElementById('edit_study_mode').value = record.study_mode;
    document.getElementById('edit_cgpa').value = record.cgpa;
    document.getElementById('edit_funding_source').value = record.funding_source;
    document.getElementById('edit_sponsor_name').value = record.sponsor_name;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    let modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>
</body>
</html>