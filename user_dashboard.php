<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details
$user_id = $_SESSION['id'];
$sql = "SELECT name, payment_status, due_date, workout_sessions FROM members WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            overflow-y: auto;
            max-height: 90vh;
        }
        h2, h3 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h3 {
            margin: 0;
        }
        .logout-btn {
            background-color: #ff4c4c;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 4px;
        }
        .logout-btn:hover {
            background-color: #e60000;
        }
        .user-info {
            text-align: center;
            margin: 20px 0;
        }
        .workout-sessions {
            margin: 20px 0;
        }
        .workout-sessions label {
            display: block;
            margin: 10px 0;
        }
        .session-checkboxes {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .session-checkboxes label {
            flex: 1 1 calc(50% - 10px);
            display: flex;
            align-items: center;
        }
        .session-checkboxes input[type="checkbox"] {
            margin-right: 10px;
        }
        .payment-info {
            margin: 20px 0;
            text-align: center;
        }
        .payment-info p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>User Dashboard</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="user-info">
            <h3>Welcome, <?php echo htmlspecialchars($user_data['name']); ?>!</h3>
        </div>

        <div class="payment-info">
            <h3>Payment Details</h3>
            <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($user_data['payment_status']); ?></p>
            <p><strong>Due Date:</strong> <?php echo htmlspecialchars($user_data['due_date']); ?></p>
            <p><strong>Next Payment Date:</strong> <?php echo date('Y-m-d', strtotime($user_data['due_date'] . ' +30 days')); ?></p>
        </div>

        <div class="workout-sessions">
            <h3>Your Workout Sessions</h3>
            <div class="session-checkboxes">
                <?php 
                $workout_sessions = explode(',', $user_data['workout_sessions']);
                $all_sessions = ['Aerobics', 'Zumba', 'Yoga', 'Weight Training', 'Cardio'];
                foreach ($all_sessions as $session): ?>
                    <label>
                        <input type="checkbox" name="sessions[]" value="<?php echo htmlspecialchars($session); ?>" disabled
                        <?php if (in_array($session, $workout_sessions)) echo 'checked'; ?>>
                        <?php echo htmlspecialchars($session); ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>
