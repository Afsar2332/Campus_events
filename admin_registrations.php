
<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$sql = "
    SELECT
        students.student_id,
        students.email,
        events.title,
        events.event_date,
        registrations.id AS registration_id
    FROM registrations
    JOIN students ON registrations.student_id = students.id
    JOIN events ON registrations.event_id = events.id
    ORDER BY events.event_date ASC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Registrations</title>
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
<h2>Student Event Registrations</h2>

<a href="admin_dashboard.php">Admin Dashboard</a> |
<a href="admin_logout.php">Logout</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Student ID</th>
        <th>Email</th>
        <th>Event Name</th>
        <th>Event Date</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['student_id']); ?></td>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
        <td><?php echo htmlspecialchars($row['title']); ?></td>
        <td><?php echo htmlspecialchars($row['event_date']); ?></td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
