<?php
$baglanti = new mysqli("localhost", "root", "", "tamirciler");
if ($baglanti->connect_error) {
    die("Veritabanı bağlantı hatası: " . $baglanti->connect_error);
}

$sehirler = [
    'Adana','Adıyaman','Afyonkarahisar','Ağrı','Amasya','Ankara','Antalya','Artvin','Aydın','Balıkesir',
    'Bilecik','Bingöl','Bitlis','Bolu','Burdur','Bursa','Çanakkale','Çankırı','Çorum','Denizli',
    'Diyarbakır','Edirne','Elazığ','Erzincan','Erzurum','Eskişehir','Gaziantep','Giresun','Gümüşhane','Hakkari',
    'Hatay','Isparta','Mersin','İstanbul','İzmir','Kars','Kastamonu','Kayseri','Kırklareli','Kırşehir',
    'Kocaeli','Konya','Kütahya','Malatya','Manisa','Kahramanmaraş','Mardin','Muğla','Muş','Nevşehir',
    'Niğde','Ordu','Rize','Sakarya','Samsun','Siirt','Sinop','Sivas','Tekirdağ','Tokat',
    'Trabzon','Tunceli','Şanlıurfa','Uşak','Van','Yozgat','Zonguldak','Aksaray','Bayburt','Karaman',
    'Kırıkkale','Batman','Şırnak','Bartın','Ardahan','Iğdır','Yalova','Karabük','Kilis','Osmaniye',
    'Düzce'
];

foreach ($sehirler as $index => $sehir) {
    $isim = sprintf("%02d Mekanikçi %s", $index + 1, $sehir);
    $semt = "Merkez";
    $adres = "$semt Mah. No:" . ($index + 1);
    $telefon = "0" . rand(200, 599) . " " . rand(100, 999) . " " . rand(1000, 9999);

    $stmt = $baglanti->prepare("INSERT INTO oto_tamircileri (isim, sehir, semt, adres, telefon) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $isim, $sehir, $semt, $adres, $telefon);
    $stmt->execute();
}

echo "81 şehir için çekici kayıtları başarıyla eklendi.";

$baglanti->close();
?>
