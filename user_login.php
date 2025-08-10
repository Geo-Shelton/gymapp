<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sgym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputName = $_POST['username'];
    $inputPassword = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM members WHERE name = ?");
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
            header("Location: user_dashboard.php");
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No user found with that username.";
    }
    $stmt->close();
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
            background-image: url(imabacklog.jfif);
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 80%;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* added background color */
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
        <form action="user_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="buttonlogin">
                <input type="submit" value="LOGIN"> <a href="index.html">BACK</a>
            </div>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
