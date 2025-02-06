<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #45a049;
            --background-dark: #1E1E1E;
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
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--text-light);
            line-height: 1.6;
        }

        nav {
            background-color: #121212;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
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
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .logout {
            background-color: #ff3333;
            color: white;
        }

        .logout:hover {
            background-color: #cc0000;
            transform: translateY(-2px);
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem;
            gap: 2rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .content-box, .contact-box {
            background-color: var(--background-dark);
            border-radius: 15px;
            padding: 2.5rem;
            width: 100%;
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

        .content-box h1, .contact-title {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-light);
            font-size: 1.8rem;
            font-weight: 600;
            position: relative;
            padding-bottom: 1rem;
        }

        .content-box h1::after, .contact-title::after {
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

        .button {
            width: 100%;
            padding: 1rem;
            margin: 1rem 0;
            background-color: rgba(255,255,255,0.1);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .button:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .button i {
            font-size: 1.2rem;
        }

        .contact-content {
            display: none;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .contact-content.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .contact-info {
            color: var(--text-gray);
            font-size: 0.9rem;
        }

        .contact-item {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .contact-item i {
            color: var(--primary-color);
            margin-top: 5px;
        }

        .contact-item a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .address-block {
            margin-bottom: 1rem;
        }

        @media (max-width: 600px) {
            .container {
                padding: 1rem;
            }

            .content-box, .contact-box {
                padding: 1.5rem;
            }

            nav {
                padding: 1rem;
            }

            .logo {
                font-size: 1.2rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
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
            <a href="index.php" class="nav-link">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="logout.php" class="nav-link logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="content-box">
            <h1>Welcome to MyOKU:Financial Aid Registration System for Disable Students</h1>
            
            <form action="personal_form.php" method="post">
                <button type="submit" class="button">
                    <i class="fas fa-user"></i>
                    Personal Information Form
                </button>
            </form>

            <form action="academic_form.php" method="post">
                <button type="submit" class="button">
                    <i class="fas fa-graduation-cap"></i>
                    Academic Information Form
                </button>
            </form>

            <form action="claim_form.php" method="post">
                <button type="submit" class="button">
                    <i class="fas fa-file-invoice"></i>
                    Claim Information Form
                </button>
            </form>
        </div>
    
        <div class="contact-box">
            <h2 class="contact-title">Contact Us</h2>
            <button class="button" onclick="toggleContact()">
                <i class="fas fa-address-book"></i>
                Show Contact Information
            </button>

            <div class="contact-content" id="contactContent">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-building"></i>
                        <div class="address-block">
                            Kementerian Pengajian Tinggi,<br>
                            Bahagian Biasiswa,<br>
                            Unit Pra Perkhidmatan,<br>
                            Aras 2, No. 2, Menara 2,<br>
                            Jalan P5/6, Presint 5,<br>
                            62200 Wilayah Persekutuan Putrajaya.
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>No Hotline: 03-8888 1616</div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            Rosnidah Binti Ab.Rahim: <a href="mailto:rosnidah@mohe.gov.my">rosnidah@mohe.gov.my</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            Kalaivani A/P M Vadivelu: <a href="mailto:kalaivani@mohe.gov.my">kalaivani@mohe.gov.my</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            Nor Hidayah Binti Harun @ Zakaria: <a href="mailto:hidayah.harun@mohe.gov.my">hidayah.harun@mohe.gov.my</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleContact() {
            const content = document.getElementById('contactContent');
            const button = content.previousElementSibling;
            
            content.classList.toggle('show');
            
            if (content.classList.contains('show')) {
                button.innerHTML = '<i class="fas fa-times"></i> Hide Contact Information';
            } else {
                button.innerHTML = '<i class="fas fa-address-book"></i> Show Contact Information';
            }
        }
    </script>
</body>
</html>