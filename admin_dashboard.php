
<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    $stmt = $conn->prepare(
        "INSERT INTO events (title, description, event_date, location)
         VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $title, $description, $event_date, $location);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="admin-dashboard">

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



<form method="POST">
    <input type="text" name="title" placeholder="Event Title" required>
    <br><br>

    <textarea name="description" placeholder="Event Description"></textarea>
    <br><br>

    <input type="date" name="event_date" required>
    <br><br>

    <input type="text" name="location" placeholder="Event Location" required>
    <br><br>

    <button type="submit" name="add_event">Add Event</button>
</form>

<a href="admin_logout.php">Logout</a>
<a href="admin_registrations.php">View All Registrations</a>

<hr>
<h3>All Events</h3>
<hr>
<?php while ($event = $result->fetch_assoc()) { ?>

    <h4><?php echo htmlspecialchars($event['title']); ?></h4>
    <p>Date: <?php echo htmlspecialchars($event['event_date']); ?></p>
    <p>Location: <?php echo htmlspecialchars($event['location']); ?></p>

    <a href="edit_event.php?id=<?php echo $event['id']; ?>">Edit</a> |
    <a href="delete_event.php?id=<?php echo $event['id']; ?>"
       onclick="return confirm('Are you sure you want to delete this event?')">
       Delete
    </a>

    <hr>

<?php } ?>

</body>
</html>
