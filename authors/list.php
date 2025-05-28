<?php
include '../db.php';
$result = $conn->query("SELECT * FROM authors");
?>
<!DOCTYPE html>
<html>
<head>
    <title>作者列表</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>作者列表</h2>
    <a href="create.php" class="btn btn-success mb-2">添加作者</a>
    <table class="table table-bordered">
        <tr><th>ID</th><th>姓名</th><th>操作</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">编辑</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">删除</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>