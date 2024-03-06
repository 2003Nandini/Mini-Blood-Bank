<?php
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

// Fetch donor details from the database
$sql = "SELECT * FROM donor_details";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Details</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>

    <h2>Donor Details</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Blood Group</th>
                <th>Age</th>
                <th>Weight (kg)</th>
                <th>Height (cm)</th>
                <th>Hemoglobin (HB)</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Division</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["blood_group"]; ?></td>
                    <td><?php echo $row["age"]; ?></td>
                    <td><?php echo $row["weight"]; ?></td>
                    <td><?php echo $row["height"]; ?></td>
                    <td><?php echo $row["hb"]; ?></td>
                    <td><?php echo $row["contact"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["division"]; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No donor details found.</p>
    <?php endif; ?>

</body>
</html>
