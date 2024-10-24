<?php
session_start();
include 'includes/db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password); // "ss" indicates the type of the parameters
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['admin'] = $username; // Set session variable
        header("Location: dashboard.php");
        exit(); // Make sure to exit after header redirection
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* General styles for the page */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(45deg, #3498db, #2ecc71); /* Background gradient */
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0;
}

/* Container for the login form */
.login-form {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Drop shadow for form */
    padding: 40px;
    width: 350px;
    text-align: center;
    animation: fadeIn 1s ease-in-out; /* Smooth fade-in effect */
}

/* Heading styling */
.login-form h2 {
    color: #333;
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
}

/* Input field styling */
.login-form input[type="text"],
.login-form input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

/* Change border color on focus */
.login-form input[type="text"]:focus,
.login-form input[type="password"]:focus {
    border-color: #3498db;
    outline: none;
}

/* Submit button styling */
.login-form button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

/* Hover effect for the submit button */
.login-form button:hover {
    background-color: #2980b9;
}

/* Error message styling */
.login-form p {
    color: red;
    font-size: 14px;
    margin: 10px 0;
}

/* Responsive behavior for smaller screens */
@media (max-width: 400px) {
    .login-form {
        width: 90%;
    }
}

/* Smooth fade-in effect */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

    </style>
</head>
<body>
    <div class="login-form">
        <h2>Admin Login</h2>
        <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
