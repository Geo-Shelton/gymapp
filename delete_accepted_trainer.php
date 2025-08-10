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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    // Delete the record from the trainers table
    $sql = "DELETE FROM trainers WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Trainer deleted successfully.";
    } else {
        echo "Error deleting trainer: " . $conn->error;
    }
}

$conn->close();
header("Location: accepted_trainers.php");
exit();
?>
