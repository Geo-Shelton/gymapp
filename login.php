<?php
session_start();

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

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inputName = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Array of tables to check
    $tables = [
        'members' => 'user_dashboard.php',
        'silver_members' => 'silver_dashboard.php',
        'gold_members' => 'gold_dashboard.php'
    ];

    foreach ($tables as $table => $redirectPage) {
        // Prepare and execute the statement
        $stmt = $conn->prepare("SELECT id, password FROM $table WHERE name = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("s", $inputName);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($inputPassword, $hashed_password)) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $inputName;
                $_SESSION['id'] = $id;
                $_SESSION['user_type'] = $table; // Store the table name to identify membership type
                header("Location: $redirectPage");
                exit();
            } else {
                $error = "Incorrect password.";
            }
        }
        $stmt->close();
    }

    if ($error === "") {
        $error = "No user found with that username.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(logimg.jfif);
            background-repeat: no-repeat;
            background-size: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            padding: 20px;
            border-radius: 8px;
            
            max-width: 400px;
            width: 80%;
            text-align: center;
            
        }
        h1, h2 {
            margin-bottom: 20px;
            color: #fffbfb;
        }
        input[type="text"], input[type="password"], input[type="submit"], a {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 3px solid #6ed4fc;
            border-radius: 10px;
            box-sizing: border-box;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            text-align: center;
            background-color: white;
            color: #030303;
            font-size: 20px;
        }
        .buttonlogin {
            display: flex;
            flex-direction: row;
        }
        input[type="text"], input[type="password"] {
            color: #000000; 
            font-size: 20px;
        }
        input[type="submit"]:hover, a:hover {
            background-color: #f18930;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Welcome to</h1>
        <h2>User Login</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="buttonlogin">
                <input type="submit" value="LOGIN"> <a href="index.php">BACK</a>
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
