<?php
// Database bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bilisimdeneme";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} ?>