<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$sehir = trim($_GET['sehir']);
$semt = trim($_GET['semt']);

$baglanti = new mysqli("localhost", "root", "", "tamirciler");
if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

if (!empty($semt)) {
    $stmt = $baglanti->prepare("SELECT * FROM yedek_parca WHERE sehir = ? AND semt = ?");
    $stmt->bind_param("ss", $sehir, $semt);
} else {
    $stmt = $baglanti->prepare("SELECT * FROM yedek_parca WHERE sehir = ?");
    $stmt->bind_param("s", $sehir);
}

$stmt->execute();
$sonuc = $stmt->get_result();

if ($sonuc->num_rows > 0) {
    echo '<div class="row">';
    while ($row = $sonuc->fetch_assoc()) {
        echo '
        <div class="col-md-4">
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 22px; color: white; text-transform: uppercase;">
    '. htmlspecialchars($row['isim']) .'
                    </h5>
                    <p class="card-text"><strong>Adres:</strong> '. htmlspecialchars($row['adres']) .'</p>
                    <p class="card-text"><strong>Telefon:</strong> '. htmlspecialchars($row['telefon']) .'</p>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
} else {
    echo "<div class='alert alert-warning'>Bu konumda kayıtlı tamirci bulunamadı.</div>";
}

$stmt->close();
$baglanti->close();
?>
