<?php
session_start();
include('conn.php'); // Ensure this file connects to your database

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration process
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // Check if passwords match
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match!";
            header("Location: login.php");
            exit();
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if email already exists
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $check_email);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Email already registered!";
            header("Location: login.php");
            exit();
        }

        // Insert into database
        $query = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Registration successful! You can now log in.";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }

        header("Location: login.php");
        exit();
    }

    if (isset($_POST['login'])) {
        // Login process
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Fetch user data
        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['fullname'];
                $_SESSION['success'] = "Login successful!";
                header("Location: index.html"); // Redirect to index page after login
                exit();
            } else {
                $_SESSION['error'] = "Invalid password!";
            }
        } else {
            $_SESSION['error'] = "No account found with that email!";
        }

        header("Location: login.php");
        exit();
    }
}
?>
