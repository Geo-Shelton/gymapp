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

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$field = $_POST['field'];
$year_of_experience = $_POST['experience'];
$age = $_POST['age'];
$time = $_POST['time'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO trainers (name, phone, gender, field, year_of_experience, age, time) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssdis", $name, $phone, $gender, $field, $year_of_experience, $age, $time);

// Execute the statement
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();
?>
