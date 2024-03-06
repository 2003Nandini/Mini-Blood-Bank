<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Group Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }

        h2 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 20px;
        }

        canvas {
            max-width: 800px;
            margin: auto;
            display: block;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            margin-top: 20px;
            width: 100%;
            text-align: center;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        caption {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>Blood Group Analysis</h2>

    <?php
    // Database connection details
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "donordb";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get blood group data
    $sql = "SELECT blood_group, COUNT(*) AS count FROM donor_details GROUP BY blood_group";
    $result = $conn->query($sql);

    // Process data for Chart.js
    $labels = [];
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['blood_group'];
            $data[] = $row['count'];
        }
    }
    ?>

    <canvas id="bloodGroupChart"></canvas>

    <script>
        // Prepare data for Chart.js
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;

        // Create a bar chart
        var ctx = document.getElementById('bloodGroupChart').getContext('2d');
        var bloodGroupChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Number of Donors',
                    data: data,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0', '#795548'],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>

    <!-- Display a table with total counts -->
    <table border="1">
        <caption>Total Donors Count by Blood Group</caption>
        <thead>
            <tr>
                <th>Blood Group</th>
                <th>Total Donors</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the results and display a row for each blood group
            foreach ($labels as $index => $bloodGroup) {
                echo "<tr>";
                echo "<td>{$bloodGroup}</td>";
                echo "<td>{$data[$index]}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
