<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header("Location: dashboard.php?message=" . urlencode("Invalid student ID."));
    exit;
}

$stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);

header("Location: dashboard.php?message=" . urlencode("Student deleted successfully."));
exit;
?>
