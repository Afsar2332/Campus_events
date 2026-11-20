
<?php
session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();

        if (password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Wrong Password!";
        }
    } else {
        $message = "Student ID not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
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

<h2>Student Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">
    <input type="text" name="student_id" placeholder="Student ID" required>
    <br><br>

    <input type="password" name="password" placeholder="Password" required>
    <br><br>

    <button type="submit" name="login">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>

</body>
</html>
