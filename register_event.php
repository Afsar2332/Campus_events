
<?php
session_start();
include "db.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $event_id = intval($_GET['id']);
    $student_id = $_SESSION['student_id'];

    $stmt = $conn->prepare(
        "INSERT INTO registrations (student_id, event_id) VALUES (?, ?)"
    );

    $stmt->bind_param("ii", $student_id, $event_id);

    if ($stmt->execute()) {
        header("Location: my_registrations.php");
        exit();
    } else {
        echo "You are already registered for this event or registration failed.";
    }
} else {
    echo "Invalid Event!";
}
?>
<br>
<a href="dashboard.php">Back to Dashboard</a>
