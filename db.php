<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "book_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>