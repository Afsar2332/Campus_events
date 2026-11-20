
<?php
session_start();
include "db.php";

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

$id = intval($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if (!$event) {
    die("Event not found!");
}

if (isset($_POST['update_event'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    $stmt = $conn->prepare(
        "UPDATE events SET title=?, description=?, event_date=?, location=? WHERE id=?"
    );

    $stmt->bind_param("ssssi", $title, $description, $event_date, $location, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event</h2>

<form method="POST">

    <input type="text" name="title"
        value="<?php echo htmlspecialchars($event['title']); ?>" required>
    <br><br>

    <textarea name="description"><?php echo htmlspecialchars($event['description']); ?></textarea>
    <br><br>

    <input type="date" name="event_date"
        value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
    <br><br>

    <input type="text" name="location"
        value="<?php echo htmlspecialchars($event['location']); ?>" required>
    <br><br>

    <button type="submit" name="update_event">Update Event</button>

</form>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
