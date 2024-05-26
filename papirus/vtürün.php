<?php
$ürünlistesi = array(); // $ürünlistesi değişkenini boş bir dizi olarak tanımlayın

// Veritabanından ürünleri çekin ve $ürünlistesi değişkenine atayın
$sql = "SELECT * FROM ürünler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($ürün = $result->fetch_assoc()) {
    $ürünlistesi[] = $ürün; // Her bir ürünü $ürünlistesi dizisine ekleyin
  }
}
?>
