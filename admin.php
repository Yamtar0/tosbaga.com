<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$conn = new mysqli("localhost", "root", "", "bize_ulasin");

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanına bağlanılamadı: " . $conn->connect_error);
}

// Veri çekme sorgusu
$sql = "SELECT * FROM iletisim ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>Admin Paneli</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background-color: #f8f8f8;
    }
    h1 {
      color: #333;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px;
      text-align: left;
    }
    th {
      background-color: #eee;
    }
  </style>
</head>
<body>

<h1>Gelen Mesajlar</h1>

<?php if ($result && $result->num_rows > 0): ?>
<table>
  <tr>
    <th>ID</th>
    <th>İsim</th>
    <th>Mesaj</th>
    <th>Tarih</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['ad_soyad'] ?? '') ?></td>
    <td><?= htmlspecialchars($row['mesaj'] ?? '') ?></td>
    <td><?= htmlspecialchars($row['tarih'] ?? '') ?></td>
  </tr>
  <?php endwhile; ?>
</table>
<?php else: ?>
<p>Henüz mesaj yok.</p>
<?php endif; ?>

<?php $conn->close(); ?>

</body>
</html>
