
<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$result = $conn->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="page-background">

    <h2 class="dashboard-title">Welcome to Campus Events</h2>

    <div class="dashboard-nav">
        <a href="my_registrations.php" class="auth-link">My Registrations</a>
        <a href="logout.php" class="auth-link">Logout</a>
    </div>

    <h3 class="dashboard-heading">Upcoming Events</h3>

    <?php if ($result && $result->num_rows > 0) { ?>

        <?php while ($event = $result->fetch_assoc()) { ?>

           <div class="event">

                <h3><?php echo htmlspecialchars($event['title']); ?></h3>

                <p>
                    <?php echo htmlspecialchars($event['description']); ?>
                </p>

                <p>
                    <strong>Date:</strong>
                    <?php echo htmlspecialchars($event['event_date']); ?>
                </p>

                <p>
                    <strong>Location:</strong>
                    <?php echo htmlspecialchars($event['location']); ?>
                </p>

                <a href="register_event.php?id=<?php echo $event['id']; ?>" class="btn">
                    Register for Event
                </a>

            </div>

        <?php } ?>

    <?php } else { ?>

        <p class="no-events">No upcoming events available right now.</p>

    <?php } ?>

</body>
</html>
