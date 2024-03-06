<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedbackType = $_POST["feedback_type"];
    $comments = $_POST["comments"];

    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "feedback"; // Replace with your actual database name

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO feedback (name, email, feedback_type, comments)
            VALUES ('$name', '$email', '$feedbackType', '$comments')";

    if ($conn->query($sql) === TRUE) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Receiver Feedback Form</title>
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

    <h2>Blood Receiver Feedback Form</h2>

    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="feedback_type">Feedback Type:</label>
        <select id="feedback_type" name="feedback_type" required>
            <option value="Suggestion">Suggestion</option>
            <option value="Complaint">Complaint</option>
            <option value="Appreciation">Appreciation</option>
        </select>

        <label for="comments">Comments:</label>
        <textarea id="comments" name="comments" rows="4" required></textarea>

        <button type="submit">Submit Feedback</button>
    </form>

</body>
</html>
