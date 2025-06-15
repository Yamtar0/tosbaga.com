<?php
$sehir = trim($_GET['sehir']);
$semt = trim($_GET['semt']);

// Veritabanı bağlantısı
$baglanti = new mysqli("localhost", "root", "", "tamirciler");
if ($baglanti->connect_error) {
    die("Bağlantı hatası: " . $baglanti->connect_error);
}

// Hazırlanan sorgu
if (!empty($semt)) {
    $stmt = $baglanti->prepare("SELECT * FROM oto_tamircileri WHERE sehir = ? AND semt = ?");
    $stmt->bind_param("ss", $sehir, $semt);
} else {
    $stmt = $baglanti->prepare("SELECT * FROM oto_tamircileri WHERE sehir = ?");
    $stmt->bind_param("s", $sehir);
}

$stmt->execute();
$sonuc = $stmt->get_result();

echo "<h2>Sonuçlar:</h2>";
if ($sonuc->num_rows > 0) {
    echo "<ul>";
    while ($row = $sonuc->fetch_assoc()) {
        echo "<li><strong style='font-size: 20px; color: darkblue; text-transform: uppercase;'>{$row['isim']}</strong><br>";
        echo "Adres: {$row['adres']}<br>";
        echo "Telefon: {$row['telefon']}</li><br>";
    }
    echo "</ul>";
} else {
    echo "<p>Bu konumda kayıtlı tamirci bulunamadı.</p>";
}

$stmt->close();
$baglanti->close();
?>
