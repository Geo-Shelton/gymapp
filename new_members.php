<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin.html");
    exit();
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";

// Handle new member creation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_member'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $due_date = date('Y-m-d', strtotime('+30 days'));
    $workout_sessions = isset($_POST['workout_sessions']) ? implode(',', $_POST['workout_sessions']) : '';

    $stmt = $conn->prepare("INSERT INTO members (name, phone, password, due_date, workout_sessions) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $phone, $password, $due_date, $workout_sessions);

    if ($stmt->execute()) {
        $success_message = "New member created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle member update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_member'])) {
    $id = $_POST['id'];
    $name = $_POST['edit_name'];
    $phone = $_POST['edit_phone'];
    $due_date = $_POST['edit_due_date'];
    $workout_sessions = isset($_POST['edit_workout_sessions']) ? implode(',', $_POST['edit_workout_sessions']) : '';

    $stmt = $conn->prepare("UPDATE members SET name = ?, phone = ?, due_date = ?, workout_sessions = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $phone, $due_date, $workout_sessions, $id);

    if ($stmt->execute()) {
        $success_message = "Member details updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle payment update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_payment'])) {
    $id = $_POST['id'];
    $new_due_date = date('Y-m-d', strtotime('+30 days'));

    $stmt = $conn->prepare("UPDATE members SET payment_status = 'Paid', due_date = ? WHERE id = ?");
    $stmt->bind_param("si", $new_due_date, $id);

    if ($stmt->execute()) {
        $success_message = "Payment status updated successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle member deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_member'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $success_message = "Member deleted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch members data
$members_sql = "SELECT id, name, phone, due_date, payment_status, workout_sessions FROM members";
$members_result = $conn->query($members_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Members</title>
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
            max-width: 1000px;
            width: 100%;
            overflow-y: auto;
            max-height: 90vh;
            position: relative;
        }
        .container .btn-back {
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
            display: inline-block;
        }
        .container .btn-back:hover {
            background-color: #0056b3;
        }
        h2, h3 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        .new-member-form, .members-list {
            margin-bottom: 20px;
        }
        .new-member-form form, .members-list form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            margin-top: 10px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 600px;
        }
        .row label, .row input {
            flex: 1;
            margin: 5px;
        }
        input[type="text"], input[type="password"], input[type="date"], input[type="submit"], select {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            max-width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        .checkbox-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            margin: 10px 0;
        }
        .checkbox-group label {
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_dashboard.php" class="btn-back">Back to Admin Dashboard</a>
        <h2>New Members Management</h2>

        <div class="new-member-form">
            <h3>Create New Member</h3>
            <form action="new_members.php" method="post">
                <div class="row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="row">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="row">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="row">
                    <label>Workout Sessions:</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="workout_sessions[]" value="Aerobics"> Aerobics</label>
                        <label><input type="checkbox" name="workout_sessions[]" value="Zumba"> Zumba</label>
                        <label><input type="checkbox" name="workout_sessions[]" value="Yoga"> Yoga</label>
                        <label><input type="checkbox" name="workout_sessions[]" value="Cross Fitness"> Cross Fitness</label>
                    </div>
                </div>
                <input type="submit" name="create_member" value="Create Member">
            </form>
            <?php if (!empty($success_message)): ?>
                <p class="success-message"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>
        </div>

        <div class="members-list">
            <h3>New Members Details</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Payment Due Date</th>
                    <th>Payment Status</th>
                    <th>Workout Sessions</th>
                    <th>Action</th>
                </tr>
                
                <?php
                if ($members_result->num_rows > 0) {
                    while ($row = $members_result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                <td>" . htmlspecialchars($row['due_date']) . "</td>
                                <td>" . htmlspecialchars($row['payment_status']) . "</td>
                                <td>" . htmlspecialchars($row['workout_sessions']) . "</td>
                                <td>
                                    <form action='new_members.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                        <input type='text' name='edit_name' value='" . htmlspecialchars($row['name']) . "' required>
                                        <input type='text' name='edit_phone' value='" . htmlspecialchars($row['phone']) . "' required>
                                        <input type='date' name='edit_due_date' value='" . htmlspecialchars($row['due_date']) . "' required>
                                        <div class='checkbox-group'>
                                            <label><input type='checkbox' name='edit_workout_sessions[]' value='Aerobics' " . (strpos($row['workout_sessions'], 'Aerobics') !== false ? 'checked' : '') . "> Aerobics</label>
                                            <label><input type='checkbox' name='edit_workout_sessions[]' value='Zumba' " . (strpos($row['workout_sessions'], 'Zumba') !== false ? 'checked' : '') . "> Zumba</label>
                                            <label><input type='checkbox' name='edit_workout_sessions[]' value='Yoga' " . (strpos($row['workout_sessions'], 'Yoga') !== false ? 'checked' : '') . "> Yoga</label>
                                            <label><input type='checkbox' name='edit_workout_sessions[]' value='Cross Fitness' " . (strpos($row['workout_sessions'], 'Cross Fitness') !== false ? 'checked' : '') . "> Cross Fitness</label>
                                        </div>
                                        <input type='submit' name='update_member' value='Update'>
                                    </form>
                                    <form action='new_members.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                        <input type='submit' name='update_payment' value='Paid'>
                                    </form>
                                    <form action='new_members.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                        <input type='submit' name='delete_member' value='Delete'>
                                    </form>
                                </td>
                              </tr>";
                    } 
                } else {
                    echo "<tr><td colspan='6'>No members found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
