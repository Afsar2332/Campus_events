
<?php
session_start();

$message = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === "admin" && $password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $message = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-background">
    <header class="navbar">
     <div class="logo-area">
        <img src="logo.jpg" alt="Campus Events Logo">
        <h2>CAMPUS EVENTS</h2>
    </div>

    <nav>
        <a href="index.php">Home</a>
        <a href="#events">Events</a>
        <a href="#about">About</a>
        <a href="login.php">Student Login</a>
        <a href="register.php">Register</a>
        <a href="admin_login.php">Admin</a>
    </nav>
</header>
<h2>Admin Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    <input type="text" name="username" placeholder="Admin Username" required>
    <br><br>

    <input type="password" name="password" placeholder="Admin Password" required>
    <br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
