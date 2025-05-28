<?php
include '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM authors WHERE id = $id");
header("Location: list.php");
?>