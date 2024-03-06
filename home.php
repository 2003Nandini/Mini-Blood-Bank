<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Home</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #4CAF50; /* Set the color to green or a color that stands out */
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px; /* Adjust the right property as needed */
            background-color: #ff5050; /* Red color for contrast */
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            z-index: 1; /* Ensure the button is above other content */
        }

        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            transition: transform 0.3s ease-in-out;
        }

        .button img {
            width: 50%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .button:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
<a href="login.php" class="logout-button">Log Out</a>

    <h1>Welcome to the Blood Bank</h1>

    <div class="button-container">
        <a href="ddetails.php" class="button">
            <img src="a.png" alt="Donors">
            Available Donors
        </a>

        <a href="feedback.php" class="button">
            <img src="b.jpeg" alt="Feedback">
            Feedback
        </a>

        <a href="donor.php" class="button">
            <img src="c.jpeg" alt="Donate Blood">
            Donate Blood
        </a>

        <a href="map.php" class="button">
            <img src="d.jpeg" alt="Find Nearest Hospital">
            Find Nearest Hospital
        </a>
        <a href="profile.php" class="button">
            <img src="e.jpeg" alt="Profile Analysis">
            Blood Groups Analysis
        </a>
    </div>

</body>
</html>
