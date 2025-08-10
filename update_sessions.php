<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header("Location: admin_login.html");
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $workout_sessions = implode(',', $_POST['sessions']);

    $sql = "UPDATE members SET workout_sessions = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $workout_sessions, $user_id);
    if ($stmt->execute()) {
        $message = "Workout sessions updated successfully.";
    } else {
        $message = "Error updating workout sessions: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Workout Sessions</title>
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
        .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }
        .error {
            text-align: center;
            color: red;
            margin-bottom: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Workout Sessions</h2>
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="update_sessions.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">
            <div class="session-checkboxes">
                <?php 
                $all_sessions = ['Aerobics', 'Zumba', 'Yoga', 'Weight Training', 'Cardio'];
                foreach ($all_sessions as $session): ?>
                    <label>
                        <input type="checkbox" name="sessions[]" value="<?php echo htmlspecialchars($session); ?>">
                        <?php echo htmlspecialchars($session); ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <div style="text-align: center; margin-top: 20px;">
                <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
