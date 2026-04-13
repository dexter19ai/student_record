<?php
require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$username = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields.";
    } elseif (strlen($username) < 3) {
        $error = "Username must be at least 3 characters long.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Check if username exists
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $checkStmt->execute(['username' => $username]);
        $existingUser = $checkStmt->fetch();

        if ($existingUser) {
            $error = "Username already exists.";
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert user
            $insertStmt = $pdo->prepare("
                INSERT INTO users (username, password)
                VALUES (:username, :password)
            ");

            $insertStmt->execute([
                'username' => $username,
                'password' => $hashedPassword
            ]);

            // ✅ Redirect to login after success
            header("Location: login.php?success=" . urlencode("Registration successful! Please log in."));
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Record System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-box {
            background: white;
            padding: 30px;
            width: 380px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            background: #16a34a;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #15803d;
        }

        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }

        .link {
            text-align: center;
            margin-top: 15px;
        }

        .link a {
            color: #2563eb;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="register-box">
        <h2>Register</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Register</button>
        </form>

        <div class="link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>