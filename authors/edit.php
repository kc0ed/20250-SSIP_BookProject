<?php
include '../db.php';
$id = $_GET['id'];
$author = $conn->query("SELECT * FROM authors WHERE id = $id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $stmt = $conn->prepare("UPDATE authors SET name=? WHERE id=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();
    header("Location: list.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>编辑作者</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
    <h2>编辑作者</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">姓名</label>
            <input type="text" name="name" class="form-control" value="<?= $author['name'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">保存</button>
        <a href="list.php" class="btn btn-secondary">取消</a>
    </form>
</body>
</html>