<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information</title>
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
            max-width: 900px;
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
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-light);
            font-weight: 500;
            font-size: 0.95rem;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid #333333;
            border-radius: 8px;
            background-color: var(--input-bg);
            color: var(--text-light);
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(76,175,80,0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
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

    <form action="personalcontroller.php" method="POST">
        <h2>Personal Information</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>Program:</label>
                <input type="text" name="program" required>
            </div>
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" required>
            </div>
            <div class="form-group">
                <label>Student ID:</label>
                <input type="text" name="student_id" required>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" name="birth_date" required>
            </div>
            <div class="form-group">
                <label>Age:</label>
                <input type="number" name="age" required>
            </div>
            <div class="form-group">
                <label>JKM Number:</label>
                <input type="text" name="jkm_number">
            </div>
            <div class="form-group">
                <label>Race:</label>
                <input type="text" name="race">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Disability:</label>
                <input type="text" name="disability">
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label>Address:</label>
                <textarea name="address"></textarea>
            </div>
            <div class="form-group">
                <label>Home Phone:</label>
                <input type="text" name="home_phone">
            </div>
            <div class="form-group">
                <label>Mobile Phone:</label>
                <input type="text" name="mobile_phone" required>
            </div>
            <div class="form-group">
                <label>Bank Account Number:</label>
                <input type="text" name="bank_account_number">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
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