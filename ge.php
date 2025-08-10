<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
       
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 8cm;
            height: 13cm;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            box-sizing: border-box;
        }
        .form-container h1 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2em;
            text-align: center;
        }
        .form-row {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
        }
        .form-row input[type="text"], 
        .form-row input[type="number"], 
        .form-row select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-row input[type="radio"] {
            margin: 0 5px;
        }
        .form-row .radio-group {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }
        .form-row .radio-group label {
            margin-right: 10px;
        }
        .form-row .option-list {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .form-row .option-list label {
            margin: 5px 0;
        }
        .form-container .message {
            margin-top: 15px;
            color: green;
            text-align: center;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function handleSubmit(event) {
            event.preventDefault(); // Prevent the default form submission

            var form = event.target;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "process_registration.php", true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('message').innerText = "Registration successful!";
                    form.reset(); // Clear the form fields
                } else {
                    document.getElementById('message').innerText = "Error occurred. Please try again.";
                }
            };
            xhr.send(formData);
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>APPLY NOW</h1>
        <form onsubmit="handleSubmit(event)">
            <div class="form-row">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-row">
                <input type="text" id="phone" name="phone" placeholder="Phone Number" required maxlength="10" pattern="\d{10}">
            </div>
            <div class="form-row">
                <div class="radio-group">
                    <label><input type="radio" id="male" name="gender" value="Male" required> Male</label>
                    <label><input type="radio" id="female" name="gender" value="Female" required> Female</label>
                </div>
            </div>
            <div class="form-row">
                <select id="field" name="field" required>
                    <option value="Aerobics Trainer">Aerobics Trainer</option>
                    <option value="Zumba Trainer">Zumba Trainer</option>
                    <option value="Yoga Trainer">Yoga Trainer</option>
                    <option value="Cross Fitness">Cross Fitness</option>
                    <option value="Gymnastics Trainer">Gymnastics Trainer</option>
                </select>
            </div>
            <div class="form-row">
                <input type="number" id="experience" name="experience" placeholder="Year of Experience" min="0" required>
            </div>
            <div class="form-row">
                <input type="number" id="age" name="age" placeholder="Age" min="0" required>
            </div>
            <div class="form-row">
                <select id="time" name="time" required>
                    <option value="Part Time">Part Time</option>
                    <option value="Full Time">Full Time</option>
                </select>
            </div>
            <div class="form-row">
                <input type="submit" value="Submit">
            </div>
            <div id="message" class="message"></div>
        </form>
    </div>
</body>
</html>
