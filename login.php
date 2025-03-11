<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & SignUp</title>
    <link rel="stylesheet" type="css" href="loginstyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


    <script>
        function login() {
            document.getElementById("login").style.display = "block";
            document.getElementById("register").style.display = "none";
            document.getElementById("log").style.color = "#fff";
            document.getElementById("reg").style.color = "#000";
        }

        function register() {
            document.getElementById("login").style.display = "none";
            document.getElementById("register").style.display = "block";
            document.getElementById("log").style.color = "#000";
            document.getElementById("reg").style.color = "#fff";
        }

        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;

            if (password !== confirm_password) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" id="log" onclick="login()" style="color: #fff;">Log In</button>
            <button type="button" class="toggle-btn" id="reg" onclick="register()">Register</button>
        </div>
        <div class="social-icons">
            <img src="images/icon/fb2.png" alt="Facebook">
            <img src="images/icon/insta2.png" alt="Instagram">
            <img src="images/icon/tt2.png" alt="Twitter">
        </div>

        <!-- Show error or success messages -->
        <?php if (isset($_SESSION['error'])): ?>
    <p id="message" style="color: red; text-align: center; font-weight: bold;">
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <p id="message" style="color: green; text-align: center; font-weight: bold;">
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </p>
<?php endif; ?>

        <!-- Login Form -->
        <form id="login" class="input-group" action="process.php" method="POST">
            <div class="inp">
                <img src="images/icon/user.png" alt="User">
                <input type="text" name="email" class="input-field" placeholder="Email Address" required>
            </div>
            <div class="inp">
                <img src="images/icon/password.png" alt="Password">
                <input type="password" name="password" class="input-field" placeholder="Password" required>
            </div>
            <input type="checkbox" class="check-box"> Remember Password
            <button type="submit" name="login" class="submit-btn">Log In</button>
        </form>

        <!-- Registration Form -->
        <form id="register" class="input-group" action="process.php" method="POST" onsubmit="return validatePassword()">
            <input type="text" name="fullname" class="input-field" placeholder="Full Name" required>
            <input type="email" name="email" class="input-field" placeholder="Email Address" required>
            <input type="password" id="password" name="password" class="input-field" placeholder="Create Password" required>
            <input type="password" id="confirm_password" name="confirm_password" class="input-field" placeholder="Confirm Password" required>
            <input type="checkbox" class="check-box" required> I agree to the Terms & Conditions
            <button type="submit" name="register" class="submit-btn reg-btn">Register</button>
        </form>
    </div>

    <script>
        login(); // Ensure login form is displayed first by default
    </script>

    
<script>
    // Hide message after 3 seconds
    setTimeout(function() {
        let message = document.getElementById("message");
        if (message) {
            message.style.display = "none";
        }
    }, 3000);
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    let btn = document.getElementById("btn");
    let loginBtn = document.getElementById("login-btn");
    let registerBtn = document.getElementById("register-btn");
    let loginForm = document.getElementById("login");
    let registerForm = document.getElementById("register");

    registerBtn.addEventListener("click", function () {
        btn.style.left = "50%"; // Move toggle background
        loginBtn.classList.remove("active-btn");
        registerBtn.classList.add("active-btn");
        loginForm.style.display = "none";
        registerForm.style.display = "block";
    });

    loginBtn.addEventListener("click", function () {
        btn.style.left = "0"; // Move toggle background back
        registerBtn.classList.remove("active-btn");
        loginBtn.classList.add("active-btn");
        registerForm.style.display = "none";
        loginForm.style.display = "block";
    });
});


</script>


</body>
</html>
