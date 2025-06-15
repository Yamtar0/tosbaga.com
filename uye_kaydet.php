<?php
$e_posta = $_POST["logemail"];
$sifre = $_POST["logpass"];

if (empty($e_posta) || empty($sifre)) {
    die("Lütfen e-posta ve şifre alanlarını doldurunuz.");
}

$sifre_hash = password_hash($sifre, PASSWORD_DEFAULT);

$kayit = new mysqli("localhost", "root", "", "kayit");

if ($kayit->connect_error) {
    die("Bağlantı hatası: " . $kayit->connect_error);
}

$stmt = $kayit->prepare("INSERT INTO kayıt_ol (e_posta, sifre) VALUES (?, ?)");
$stmt->bind_param("ss", $eposta, $sifre_hash);

  if ($stmt->execute()) {
        // Başarılıysa yönlendir
        
        header("Location: index1.html");
        exit;
    } else {
        echo "Kayıt hatası: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

?>
