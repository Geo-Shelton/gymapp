

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

$id = $_GET['id'];
$sql = "SELECT name, phone, due_date, workout_sessions, personal_trainer_phone FROM gold_members WHERE id = $id";
$result = $conn->query($sql);
$member = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $due_date = $_POST['due_date'];
    $workout_sessions = isset($_POST['workout_sessions']) ? implode(',', $_POST['workout_sessions']) : '';
    $personal_trainer_phone = $_POST['personal_trainer_phone'];

    $update_sql = "UPDATE gold_members SET name='$name', phone='$phone', due_date='$due_date', workout_sessions='$workout_sessions', personal_trainer_phone='$personal_trainer_phone' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: gold_members.php");
    } else {
        echo "Error: " . $update_sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Gold Member</title>
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

.btn-back {
display: inline-block;
background-color: #007bff;
color: #fff;
padding: 10px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
text-decoration: none;
margin-bottom: 20px;
}

.btn-back:hover {
background-color: #0056b3;
}

h2 {
margin-bottom: 20px;
color: #333;
text-align: center;
}

form {
display: flex;
flex-direction: column;
align-items: center;
}

.row {
display: flex;
justify-content: space-between;
align-items: center;
width: 100%;
max-width: 400px;
margin-bottom: 10px;
}

.row label {
flex: 1;
margin: 5px;
}

.row input[type="text"], 
.row input[type="date"], 
.row select {
flex: 2;
padding: 10px;
margin: 5px;
width: calc(100% - 20px);
border: 1px solid #ccc;
border-radius: 4px;
}

.checkbox-group {
display: flex;
flex-direction: column;
align-items: flex-start;
width: 100%;
}

.checkbox-group label {
margin: 5px 0;
}

input[type="submit"] {
background-color: #007bff;
color: #fff;
cursor: pointer;
padding: 10px 20px;
border: none;
border-radius: 4px;
margin-top: 20px;
}

input[type="submit"]:hover {
background-color: #0056b3;
}

</style>
</head>
<body>
    <div class="container">
        <h2>Edit Gold Member</h2>
        <form action="edit_gold_member.php?id=<?php echo $id; ?>" method="post">
            <div class="row">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $member['name']; ?>" required>
            </div>
            <div class="row">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo $member['phone']; ?>" required maxlength="10" pattern="\d{10}">
            </div>
            <div class="row">
                <label for="due_date">Due Date:</label>
                <input type="date" id="due_date" name="due_date" value="<?php echo $member['due_date']; ?>" required>
            </div>
            <div class="row">
                <label>Workout Sessions:</label>
                <div class="checkbox-group">
                    <?php
                    $sessions = ['Aerobics', 'Zumba', 'Yoga', 'Cross Fitness', 'Gymnastics', 'Steam Bath'];
                    $selected_sessions = explode(',', $member['workout_sessions']);
                    foreach ($sessions as $session) {
                        $checked = in_array($session, $selected_sessions) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='workout_sessions[]' value='$session' $checked> $session</label>";
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <label for="personal_trainer_phone">Personal Trainer Phone:</label>
                <input type="text" id="personal_trainer_phone" name="personal_trainer_phone" value="<?php echo $member['personal_trainer_phone']; ?>" required maxlength="10" pattern="\d{10}">
            </div>
            <input type="submit" value="Update Member">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
