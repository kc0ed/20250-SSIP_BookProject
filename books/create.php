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
    <title>Add Book | Book Management System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
</head>
<body>
    <!-- 导航栏 -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="list.php">
                <i class="bi bi-book"></i> Book Management System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="create.php">Add Book</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Book</h4>
            </div>
            <div class="card-body">
                <form method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required
                                   placeholder="Enter book title">
                            <div class="invalid-feedback">
                                Please enter a book title
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Author</label>
                            <select name="author_id" class="form-select" required>
                                <option value="">Select an author</option>
                                <?php while($a = $authors->fetch_assoc()): ?>
                                    <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select an author
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select a category</option>
                                <?php while($c = $categories->fetch_assoc()): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a category
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Published Year</label>
                            <input type="number" name="published_year" class="form-control" required
                                   min="1900" max="<?= date('Y') ?>" placeholder="YYYY">
                            <div class="invalid-feedback">
                                Please enter a valid year
                            </div>
                        </div>
                    </div>
                    <div class="text-end mt-3">
                        <a href="list.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Save Book
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // 表单验证脚本
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
</body>
</html>