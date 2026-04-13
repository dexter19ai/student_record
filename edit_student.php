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

$stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);
$student = $stmt->fetch();

if (!$student) {
    header("Location: dashboard.php?message=" . urlencode("Student not found."));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $course = trim($_POST['course'] ?? '');

    if (empty($name) || empty($email) || empty($course)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $updateStmt = $pdo->prepare("
            UPDATE students
            SET name = :name, email = :email, course = :course
            WHERE id = :id
        ");

        $updateStmt->execute([
            'name' => $name,
            'email' => $email,
            'course' => $course,
            'id' => $id
        ]);

        header("Location: dashboard.php?message=" . urlencode("Student updated successfully."));
        exit;
    }
} else {
    $name = $student['name'];
    $email = $student['email'];
    $course = $student['course'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }

        button, a {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 6px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #2563eb;
            color: white;
        }

        a {
            background: #64748b;
            color: white;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Student</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

            <label>Course</label>
            <input type="text" name="course" value="<?php echo htmlspecialchars($course); ?>" required>

            <div class="actions">
                <button type="submit">Update</button>
                <a href="dashboard.php">Back</a>
            </div>
        </form>
    </div>
</body>
</html>