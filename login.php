<?php
session_start();

$hostname = "localhost";
$username = "root";
$password = "";  // Replace with your MySQL password
$dbname = "blood_bank";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $userType = $_POST['reg_userType'];

    // Perform basic validation (you should enhance this)
    if (empty($username) || empty($password) || empty($userType)) {
        $reg_error = "Please fill in all the fields.";
    } else {
        // Hash the password (you should use password_hash() in production)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password, user_type) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashedPassword, $userType);

        if ($stmt->execute()) {
            $reg_success = "Registration successful. You can now <a href='home.php'>go to the home page</a>.";
        } else {
            $reg_error = "Registration failed. Please try again.";
        }

        $stmt->close();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];

    // Validate login credentials
    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ? AND user_type = ?");
    $stmt->bind_param("ss", $username, $userType);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $dbUsername, $dbPassword);
        $stmt->fetch();

        // Validate the password (consider using password_hash() in a real-world scenario)
        if (password_verify($password, $dbPassword)) {
            $_SESSION['user'] = array('username' => $username, 'type' => $userType);
            header("Location: home.php");
            exit();
        }
    }

    $error = "Invalid login credentials. Please try again.";

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Management System</title>
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 400px;
            max-width: 100%;
            box-sizing: border-box;
        }

        .form-header {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .form-body {
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            opacity: 0.8;
        }

        .toggle-form {
            color: #4CAF50;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        .toggle-form:hover {
            color: #333;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Login</h2>
        </div>
        <div class="form-body">
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <label for="userType">Login as:</label>
                <select id="userType" name="userType" required>
                    <option value="donor">Donor</option>
                    <option value="receiver">Receiver</option>
                </select>

                <button type="submit" name="login">Login</button>
            </form>

            <p class="toggle-form" onclick="toggleForms()">Don't have an account? Sign up here.</p>

            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-container" style="display: none;">
        <div class="form-header" style="background-color: #333;">
            <h2 style="color: #fff;">Sign Up</h2>
        </div>
        <div class="form-body">
            <?php if (isset($reg_error)): ?>
                <p style="color: red;"><?php echo $reg_error; ?></p>
            <?php endif; ?>

            <?php if (isset($reg_success)): ?>
                <p style="color: #4CAF50;"><?php echo $reg_success; ?></p>
            <?php endif; ?>

            <form method="post" action="">
                <label for="reg_username">Username:</label>
                <input type="text" id="reg_username" name="reg_username" required>

                <label for="reg_password">Password:</label>
                <input type="password" id="reg_password" name="reg_password" required>

                <label for="reg_userType">Sign up as:</label>
                <select id="reg_userType" name="reg_userType" required>
                    <option value="donor">Donor</option>
                    <option value="receiver">Receiver</option>
                </select>

                <button type="submit" name="register">Sign Up</button>
            </form>

            <p class="toggle-form" onclick="toggleForms()">Already have an account? Login here.</p>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.querySelector('.form-container:not([style*="display: none"])');
            const registrationForm = document.querySelector('.form-container[style*="display: none"]');

            loginForm.style.display = 'none';
            registrationForm.style.display = 'block';
        }
    </script>

</body>
</html>
