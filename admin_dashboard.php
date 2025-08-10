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

// Fetch visitor count
$visitor_count_sql = "SELECT COUNT(*) AS count FROM members where due_date";
$visitor_count_result = $conn->query($visitor_count_sql);
$visitor_count = $visitor_count_result->fetch_assoc()['count'];

// Fetch data from database for visitors registration details
$sql = "SELECT id, name, email, phone FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
            max-width: 800px;
            width: 100%;
            position: relative; /* Added position relative */
        }

        h2, h3 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .visitor-count {
            text-align: center;
            margin-bottom: 20px;
        }

        .member-management {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .member-management button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin: 5px 0;
        }

        .member-management button:hover {
            background-color: #0056b3;
        }

        .membership-holders {
            text-align: center;
            margin-top: 20px;
        }

        .membership-holders label {
            font-size: 18px;
            color: #555;
            display: block;
            margin-bottom: 10px;
        }

        .membership-holders .buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .registration-details {
            text-align: center;
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
            position: absolute; /* Added position absolute */
            top: 20px; /* Adjusted top position */
            right: 20px; /* Added right position */
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        
        <a href="logout.php">LOGOUT</a> <!-- Moved logout link to top right corner -->
        
        <div class="visitor-count">
            <h3>Number of july Fee payed Members: <?php echo $visitor_count; ?></h3>
        </div>
        
        <div class="member-management">
            <button onclick="location.href='new_members.php'">New Members Details</button>
            <div class="membership-holders">
                <label>Membership Holders</label>
                <div class="buttons">
                    <button onclick="location.href='silver_members.php'">Silver Members</button>
                    <button onclick="location.href='gold_members.php'">Gold Members</button>
                    <button onclick="location.href='personal_trainer_details.php'">Personal Trainers</button>
                </div>
            </div>
        </div>
        
        <div class="registration-details">
            <h3>Visitor Registration Details</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                <td>
                                    <form action='delete_user.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                                        <input type='submit' value='Delete'>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }
                $conn->close();
                ?>
            </table>
        </div>
    </div>
</body>
</html>
