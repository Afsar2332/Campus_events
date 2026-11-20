
<?php
include "db.php";

$message = "";

if (isset($_POST['register'])) {
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO students (student_id, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_id, $email, $password);

    if ($stmt->execute()) {
        $message = "Registration Successful!";
    } else {
        $message = "Registration Failed! Student ID or Email may already exist.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
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

<h2>Student Registration</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    <input type="text" name="student_id" placeholder="Student ID" required>
    <br><br>

    <input type="email" name="email" placeholder="Email" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit" name="register">Register</button>
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
