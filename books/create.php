<?php
include '../db.php';
$authors = $conn->query("SELECT * FROM authors");
$categories = $conn->query("SELECT * FROM categories");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $year = $_POST['published_year'];

    $stmt = $conn->prepare("INSERT INTO books (title, author_id, category_id, published_year) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $title, $author_id, $category_id, $year);
    $stmt->execute();
    header("Location: list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>添加图书</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>添加图书</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">书名</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">作者</label>
            <select name="author_id" class="form-select" required>
                <?php while($a = $authors->fetch_assoc()): ?>
                    <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">分类</label>
            <select name="category_id" class="form-select" required>
                <?php while($c = $categories->fetch_assoc()): ?>
                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">出版年份</label>
            <input type="number" name="published_year" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">提交</button>
        <a href="list.php" class="btn btn-secondary">返回</a>
    </form>
</body>
</html>