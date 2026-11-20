
<?php
session_start();
include "db.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $registration_id = intval($_GET['id']);
    $student_id = $_SESSION['student_id'];

    $stmt = $conn->prepare(
        "DELETE FROM registrations WHERE id = ? AND student_id = ?"
    );

    $stmt->bind_param("ii", $registration_id, $student_id);
    $stmt->execute();
}

header("Location: my_registrations.php");
exit();
?>
