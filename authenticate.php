
<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header("Location: login.php?error=" . urlencode("Please fill in all fields."));
    exit;
}

$stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username LIMIT 1");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header("Location: dashboard.php");
    exit;
} else {
    header("Location: login.php?error=" . urlencode("Invalid username or password."));
    exit;
}
?>