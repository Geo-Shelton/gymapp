<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$trainer = null;
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['accept'])) {
        $id = $_POST['id'];
        // Fetch details for accepted trainer from the trainer_applications table
        $sql = "SELECT * FROM trainers WHERE id=$id";
        $result = $conn->query($sql);
        $trainer = $result->fetch_assoc();

        // Insert accepted trainer into trainers table
        $sql = "INSERT INTO trainer_applications (name, phone, gender, field, year_of_experience, age, time) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssiii', $trainer['name'], $trainer['phone'], $trainer['gender'], $trainer['field'], $trainer['year_of_experience'], $trainer['age'], $trainer['time']);
        if ($stmt->execute()) {
            // Delete the accepted trainer from the trainers table
            $sql = "DELETE FROM trainers WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                $success_message = 'Trainer accepted successfully.';
            }
        }
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];
        // Delete the record from the trainers table
        $sql = "DELETE FROM trainers WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $success_message = 'Trainer deleted successfully.';
        }
    }
}

// Fetch all trainer applications
$sql = "SELECT * FROM trainers";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Trainer Details</title>
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
            position: relative;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: auto;
            text-align: center;
            width: 80%;
            max-width: 1200px;
        }
        .btn-back {
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
        .btn-back:hover {
            background-color: #0056b3;
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .btn-star-trainers {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin: 0 auto 20px auto;
        }
        .btn-star-trainers:hover {
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
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .action-buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-buttons button:hover {
            background-color: #0056b3;
        }
        .success-message {
            margin-top: 20px;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="admin_dashboard.php" class="btn-back">Back to Admin Dashboard</a>
        <h1>Personal Trainer Details</h1>
        <button class="btn-star-trainers" onclick="window.location.href='accepted_trainers.php';">Star GYM Trainers</button>
        <h2>Personal Trainer Applications</h2>
        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Field</th>
                    <th>Year of Experience</th>
                    <th>Age</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['field']); ?></td>
                    <td><?php echo htmlspecialchars($row['year_of_experience']); ?></td>
                    <td><?php echo htmlspecialchars($row['age']); ?></td>
                    <td><?php echo htmlspecialchars($row['time']); ?></td>
                    <td class="action-buttons">
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="accept">Accept</button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
