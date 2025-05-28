<?php
include '../db.php';
$result = $conn->query("SELECT books.id, books.title, authors.name AS author, categories.name AS category, books.published_year
                        FROM books
                        JOIN authors ON books.author_id = authors.id
                        JOIN categories ON books.category_id = categories.id");
?>
<!DOCTYPE html>
<html>
<head>
    <title>图书列表</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>图书列表</h2>
    <a href="create.php" class="btn btn-success mb-2">添加图书</a>
    <table class="table table-bordered">
        <tr>
            <th>书名</th>
            <th>作者</th>
            <th>分类</th>
            <th>出版年份</th>
            <th>操作</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['title'] ?></td>
            <td><?= $row['author'] ?></td>
            <td><?= $row['category'] ?></td>
            <td><?= $row['published_year'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">编辑</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">删除</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>