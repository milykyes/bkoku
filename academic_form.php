<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academic Information</title>
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
            line-height: 1.6;
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
            color: var(--text-light);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-link {
            color: var(--text-light);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .logout {
            background-color: #ff3333;
        }

        .logout:hover {
            background-color: #cc0000;
        }

        form {
            background-color: var(--background-dark);
            border-radius: 15px;
            padding: 2.5rem;
            max-width: 800px;
            margin: 2rem auto;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
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

        form h2 {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-light);
            font-size: 1.8rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 1rem;
        }

        form h2::after {
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 12px;
            top: 38px;
            color: var(--text-gray);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-light);
            font-weight: 500;
            font-size: 0.95rem;
        }

        input, select {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 2px solid #333333;
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-light);
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76,175,80,0.1);
        }

        .button-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 2rem;
        }

        .submit-btn, .back-button {
            padding: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: white;
        }

        .submit-btn {
            background-color: var(--primary-color);
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76,175,80,0.3);
        }

        .back-button {
            background-color: #666;
        }

        .back-button:hover {
            background-color: #555;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            form {
                margin: 1rem;
                padding: 1.5rem;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <i class="fas fa-universal-access"></i>
            Disabilities Student Scholarship
        </div>
        <div class="nav-links">
            <a href="home.php" class="nav-link">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="logout.php" class="nav-link logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <form action="academic_controller.php" method="POST">
        <h2>Academic Information</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>Student ID:</label>
                <i class="fas fa-id-card"></i>
                <input type="number" name="student_id" required>
            </div>

            <div class="form-group">
                <label>Education Level:</label>
                <i class="fas fa-graduation-cap"></i>
                <select name="education_level">
                    <option value="Certificate">Certificate</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Bachelor">Bachelor</option>
                    <option value="Master">Master</option>
                    <option value="PhD">PhD</option>
                </select>
            </div>

            <div class="form-group">
                <label>Course Name:</label>
                <i class="fas fa-book"></i>
                <input type="text" name="course_name" required>
            </div>

            <div class="form-group">
                <label>Institution Name:</label>
                <i class="fas fa-university"></i>
                <input type="text" name="institution_name">
            </div>

            <div class="form-group">
                <label>Start Date:</label>
                <i class="fas fa-calendar-alt"></i>
                <input type="date" name="start_date">
            </div>

            <div class="form-group">
                <label>End Date:</label>
                <i class="fas fa-calendar-check"></i>
                <input type="date" name="end_date">
            </div>

            <div class="form-group">
                <label>Current Semester:</label>
                <i class="fas fa-clock"></i>
                <input type="number" name="current_semester">
            </div>

            <div class="form-group">
                <label>Study Duration (in years):</label>
                <i class="fas fa-hourglass-half"></i>
                <input type="number" name="study_duration">
            </div>

            <div class="form-group">
                <label>Months Per Semester:</label>
                <i class="fas fa-calendar"></i>
                <input type="number" name="months_per_semester">
            </div>

            <div class="form-group">
                <label>Study Mode:</label>
                <i class="fas fa-user-graduate"></i>
                <select name="study_mode">
                    <option value="Full-Time">Full-Time</option>
                    <option value="Part-Time">Part-Time</option>
                    <option value="Distance Learning">Distance Learning</option>
                    <option value="Online">Online</option>
                </select>
            </div>

            <div class="form-group">
                <label>CGPA:</label>
                <i class="fas fa-chart-line"></i>
                <input type="number" step="0.01" name="cgpa">
            </div>

            <div class="form-group">
                <label>Funding Source:</label>
                <i class="fas fa-money-bill-wave"></i>
                <select name="funding_source">
                    <option value="Scholarship">Scholarship</option>
                    <option value="Employer Sponsorship">Employer Sponsorship</option>
                    <option value="Loan">Loan</option>
                    <option value="Self-funded">Self-funded</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label>Sponsor Name:</label>
                <i class="fas fa-handshake"></i>
                <input type="text" name="sponsor_name">
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="submit-btn">
                <i class="fas fa-save"></i> Submit Information
            </button>
            <button type="button" class="back-button" onclick="window.location.href='home.php'">
                <i class="fas fa-arrow-left"></i> Back to Home
            </button>
        </div>
    </form>
</body>
</html>