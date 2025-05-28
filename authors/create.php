<?php
include '../db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO authors (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    header("Location: list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>添加作者</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>添加作者</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">姓名</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">提交</button>
        <a href="list.php" class="btn btn-secondary">返回</a>
    </form>
</body>
</html>