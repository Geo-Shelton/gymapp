<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

// Check if the user is logged in and has the correct membership type
if (!isset($_SESSION['loggedin']) || $_SESSION['user_type'] != 'gold_members') {
    header("Location: login.php");
    exit();
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM gold_members WHERE name='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold User Login Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('goldimg.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .dashboard-container {
            padding: 20px;
            border-radius: 8px;
            
            max-width: 800px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            text-align: center;
            position: relative;
        }
        .btn-logout {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-logout:hover {
            background-color: #0056b3;
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .info {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <a href="logout.php" class="btn-logout">Logout</a>
        <h1>Golden Membership Holder</h1>
        <h2>Welcome, <?= htmlspecialchars($user['name']) ?></h2>
        <div class="info">
            <p>You can access all workout sessions and the steam bath.</p>
            <p><strong>Personal Trainer Phone:</strong> <?= htmlspecialchars($user['personal_trainer_phone']) ?></p>
            <p><strong>Payment Status:</strong> <?= htmlspecialchars($user['payment_status']) ?></p>
            <p><strong>Due Date:</strong> <?= htmlspecialchars($user['due_date']) ?></p>
            <p><strong>Workout Sessions:</strong> <?= htmlspecialchars($user['workout_sessions']) ?></p>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
