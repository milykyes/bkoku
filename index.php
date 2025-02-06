<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Financial System</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    :root {
      --secondary-color: #2ecc71;
      --text-color: #ffffff;
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
      color: var(--text-color);
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }

    .welcome-box {
      background-color: #121212;
      padding: 50px;
      border-radius: 20px;
      text-align: center;
      max-width: 700px;
      width: 100%;
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
      animation: fadeIn 1s ease-out;
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

    h1 {
      font-size: 2.5em;
      margin-bottom: 20px;
      font-weight: 700;
      color: #ffffff;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    p {
      font-size: 1.2em;
      margin-bottom: 30px;
      color: rgba(255, 255, 255, 0.9);
      font-weight: 300;
    }

    .register {
      padding: 15px 40px;
      font-size: 1.1em;
      cursor: pointer;
      text-decoration: none;
      border-radius: 50px;
      transition: all 0.3s ease;
      font-weight: 500;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      background: var(--secondary-color);
      color: white;
      border: none;
    }

    .register:hover {
      background: #27ae60;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(46, 204, 113, 0.4);
    }

    @media (max-width: 768px) {
      .welcome-box {
        padding: 30px;
        margin: 20px;
      }

      h1 {
        font-size: 2em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="welcome-box">
      <h1>Welcome to MyOKU: Financial Aid Registration System for Disabled Students</h1>
      <p>Empowering students with smart financial management</p>
      <a href="register.html" class="register">
        <i class="fas fa-user-plus"></i>
        Get Started
      </a>
    </div>
  </div>
</body>
</html>