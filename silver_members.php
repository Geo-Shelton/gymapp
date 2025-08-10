<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create_member'])) {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password
        $workout_sessions = isset($_POST['workout_sessions']) ? implode(',', $_POST['workout_sessions']) : '';
        $trainer_phone = $_POST['trainer_phone'];

        // Get the next ID
        $result = $conn->query("SELECT MAX(id) AS max_id FROM silver_members");
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] + 1;

        $sql = "INSERT INTO silver_members (id, name, phone, password, due_date, workout_sessions, personal_trainer_phone)
                VALUES ($next_id, '$name', '$phone', '$password', CURDATE(), '$workout_sessions', '$trainer_phone')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "New member created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_member'])) {
        $id = $_POST['id'];
        $name = $_POST['edit_name'];
        $phone = $_POST['edit_phone'];
        $due_date = $_POST['edit_due_date'];
        $workout_sessions = isset($_POST['edit_workout_sessions']) ? implode(',', $_POST['edit_workout_sessions']) : '';
        $trainer_phone = $_POST['edit_trainer_phone'];

        $sql = "UPDATE silver_members SET name='$name', phone='$phone', due_date='$due_date', workout_sessions='$workout_sessions', personal_trainer_phone='$trainer_phone' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Member updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['delete_member'])) {
        $id = $_POST['id'];

        $sql = "DELETE FROM silver_members WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Member deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['update_payment'])) {
        $id = $_POST['id'];

        // Fetch current payment status
        $result = $conn->query("SELECT payment_status FROM silver_members WHERE id=$id");
        $row = $result->fetch_assoc();
        $current_status = $row['payment_status'];

        // Toggle payment status
        $new_status = ($current_status == 'Paid') ? 'Unpaid' : 'Paid';

        $sql = "UPDATE silver_members SET payment_status='$new_status' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Payment status updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$members_sql = "SELECT id, name, phone, due_date, payment_status, workout_sessions, personal_trainer_phone FROM silver_members";
$members_result = $conn->query($members_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Silver Members Management</title>
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
        .btn-back {
            position: sticky;
            top: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            z-index: 1000;
            margin-left: auto;
        }
        .btn-back:hover {
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
        <h2>Silver Members Management</h2>

        <div class="new-member-form">
            <h3>Create New Member</h3>
            <form action="silver_members.php" method="post">
                <div class="row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="row">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" required maxlength="10" pattern="\d{10}">
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
                        <label><input type="checkbox" name="workout_sessions[]" value="Gymnastics"> Gymnastics</label>
                    </div>
                </div>
                <div class="row">
                    <label for="trainer_phone">Personal Trainer Phone:</label>
                    <input type="text" id="trainer_phone" name="trainer_phone" required maxlength="10" pattern="\d{10}">
                </div>
                <input type="submit" name="create_member" value="Create Member">
            </form>
        </div>

        <div class="members-list">
            <h3>Manage Existing Members</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Due Date</th>
                    <th>Payment Status</th>
                    <th>Workout Sessions</th>
                    <th>Trainer Phone</th>
                    <th>Actions</th>
                </tr>
                <?php
                if ($members_result->num_rows > 0) {
                    while($row = $members_result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['due_date']}</td>
                                <td>{$row['payment_status']}</td>
                                <td>{$row['workout_sessions']}</td>
                                <td>{$row['personal_trainer_phone']}</td>
                                <td>
                                    <form action='silver_members.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <input type='submit' name='delete_member' value='Delete'>
                                    </form>
                                    <form action='silver_members.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <input type='submit' name='update_payment' value='Mark as " . ($row['payment_status'] == 'Paid' ? 'Unpaid' : 'Paid') . "'>
                                    </form>
                                    <a href='edit_silver_member.php?id={$row['id']}'>Edit</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No members found</td></tr>";
                }
                ?>
            </table>
        </div>
        <?php
        if ($success_message) {
            echo "<div class='success-message'>$success_message</div>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
