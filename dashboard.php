<?php
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Record System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        h2 {
            margin: 0;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 6px;
            color: white;
            font-size: 14px;
        }

        .btn-add {
            background: #16a34a;
        }

        .btn-logout {
            background: #dc2626;
        }

        .btn-edit {
            background: #2563eb;
            padding: 6px 10px;
            font-size: 13px;
        }

        .btn-delete {
            background: #ef4444;
            padding: 6px 10px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        .message {
            padding: 10px;
            background: #dcfce7;
            color: #166534;
            border-radius: 6px;
            margin-top: 15px;
        }

        .empty {
            text-align: center;
            color: #666;
            margin-top: 20px;
        }

        form.inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top-bar">
            <div>
                <h2>Student Record System</h2>
                <p>Welcome, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></p>
            </div>

            <div class="actions">
                <a href="add_student.php" class="btn btn-add">+ Add Student</a>
                <a href="logout.php" class="btn btn-logout">Logout</a>
            </div>
        </div>

        <?php if (isset($_GET['message'])): ?>
            <div class="message"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <?php if (count($students) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['id']); ?></td>
                            <td><?php echo htmlspecialchars($student['name']); ?></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td><?php echo htmlspecialchars($student['course']); ?></td>
                            <td><?php echo htmlspecialchars($student['created_at']); ?></td>
                            <td>
                                <a class="btn btn-edit" href="edit_student.php?id=<?php echo $student['id']; ?>">Edit</a>
                                <a class="btn btn-delete"
                                   href="delete_student.php?id=<?php echo $student['id']; ?>"
                                   onclick="return confirm('Are you sure you want to delete this student?');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty">No student records found.</div>
        <?php endif; ?>
    </div>
</body>
</html>