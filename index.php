
<?php
include "db.php";

$result = $conn->query(
    "SELECT * FROM events WHERE event_date >= CURDATE()
     ORDER BY event_date ASC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Campus Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

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

<section class="hero">
    <h1>Discover Campus Events</h1>

    <p>
        Explore exciting events, connect with students
        and participate in campus activities.
    </p>

    <a href="#events" class="btn">Explore Events</a>
    <a href="register.php" class="btn">Join Now</a>
</section>

<section id="events" class="events-section">

    <h2>Upcoming Events</h2>

    <div class="event-container">

    <?php if ($result->num_rows > 0) { ?>

        <?php while ($event = $result->fetch_assoc()) { ?>

            <div class="event">
                <h3><?php echo htmlspecialchars($event['title']); ?></h3>

                <p><?php echo htmlspecialchars($event['description']); ?></p>

                <p>Date: <?php echo htmlspecialchars($event['event_date']); ?></p>

                <p>Location: <?php echo htmlspecialchars($event['location']); ?></p>

                <a href="login.php" class="btn">Register Now</a>
            </div>

        <?php } ?>

    <?php } else { ?>

        <p>No upcoming events available.</p>

    <?php } ?>

    </div>
</section>

<section id="about" class="about">
    <h2>About Campus Events</h2>

    <p>
        Campus Events is a platform where students can
        discover upcoming university events and register
        for their favorite activities.
    </p>
</section>

<footer>
    <p>© 2026 Campus Events. All Rights Reserved.</p>
</footer>

</body>
</html>
