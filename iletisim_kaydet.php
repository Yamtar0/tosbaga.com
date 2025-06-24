<?php
var_dump($_POST);
ob_start();
include("baglanti.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // POST verilerini al
    $ad_soyad = $_POST["ad_soyad"] ?? '';
    $mesaj = $_POST["mesaj"] ?? '';
    $telefon = $_POST["telefon"] ?? '';

    
    if (empty($ad_soyad) || empty($mesaj) || empty($telefon)) {
        echo "Lütfen tüm alanları doldurunuz.";
        exit;
    }

   
    $sql = "INSERT INTO iletisim (ad_soyad, mesaj, telefon) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Hazırlama hatası: " . $conn->error);
    }

    $stmt->bind_param("sss", $ad_soyad, $mesaj, $telefon);

    if ($stmt->execute()) {
        
        
        header("Location: index1.html");
        exit;
    } else {
        echo "Kayıt hatası: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
