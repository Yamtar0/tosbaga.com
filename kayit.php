<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "kayıt_ol";

$conn = new mysqli($servername, $username, $password, $database);

// Bağlantı hatasını kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>