<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $bloodGroup = $_POST["blood_group"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $height = $_POST["height"];
    $hb = $_POST["hb"];
    $contact = $_POST["contact"];
    $address = $_POST["address"];
    $division = $_POST["division"];

    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donordb"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $sql = "INSERT INTO donor_details (name, blood_group, age, weight, height, hb, contact, address, division) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiidsss", $name, $bloodGroup, $age, $weight, $height, $hb, $contact, $address, $division);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
        }

        h2 {
            color: #4CAF50; /* Green color for headings */
            text-align: center;
        }

        form {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #4CAF50; /* Green border color on focus */
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease-in-out;
            display: block; /* Ensure the button is a block-level element */
            margin: auto; /* Center the button horizontally */
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }
    </style>
</head>
<body>

    <h2>Donor Details Form</h2>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="blood_group">Blood Group:</label>
        <select id="blood_group" name="blood_group" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
        </select>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required>

        <label for="height">Height (cm):</label>
        <input type="number" id="height" name="height" required>

        <label for="hb">Hemoglobin (HB):</label>
        <input type="number" step="0.1" id="hb" name="hb" required>

        <label for="contact">Contact Number:</label>
        <input type="tel" id="contact" name="contact" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea>

        <label for="division">Division:</label>
        <input type="text" id="division" name="division" required>

        <button type="submit">Submit</button>
    </form>

</body>
</html>
