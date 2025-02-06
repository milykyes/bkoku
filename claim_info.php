<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Claim Information</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <form action="claim_controller.php" method="POST">
        <h2>Claim Information</h2>
        <label>Student ID:</label> <input type="number" name="student_id" required><br>
        <label>Claim Type:</label>
        <select name="claim_type">
            <option value="Tuition Fee">Tuition Fee</option>
            <option value="Allowance">Allowance</option>
        </select><br>
        <label>Amount (RM):</label> <input type="number" step="0.01" name="amount" required><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
