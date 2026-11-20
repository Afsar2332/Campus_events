
<?php
session_start();
include "db.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$stmt = $conn->prepare("
    SELECT registrations.id, events.title, events.event_date, events.location
    FROM registrations
    JOIN events ON registrations.event_id = events.id
    WHERE registrations.student_id = ?
");

$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registrations</title>
     <link rel="stylesheet" href="style.css">
</head>
<body class="page-background">
<h2>My Registered Events</h2>

<a href="dashboard.php">Dashboard</a> |
<a href="logout.php">Logout</a>

<?php if ($result->num_rows > 0) { ?>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <hr>
        <h3><?php echo htmlspecialchars($row['title']); ?></h3>

        <p>Date: <?php echo htmlspecialchars($row['event_date']); ?></p>

        <p>Location: <?php echo htmlspecialchars($row['location']); ?></p>

        <a href="cancel_registration.php?id=<?php echo $row['id']; ?>">
            Cancel Registration
        </a>

    <?php } ?>

<?php } else { ?>

    <p>You have not registered for any events.</p>

<?php } ?>

</body>
</html>
