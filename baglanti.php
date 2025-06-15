<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "bize_ulasin";

// Bağlantı oluşturuluyor
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı hatasını kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>