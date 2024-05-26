<?php
$oyuncaklar = array(); // $ürünlistesi değişkenini boş bir dizi olarak tanımlayın

// Veritabanından ürünleri çekin ve $ürünlistesi değişkenine atayın
$sql = "SELECT * FROM oyuncaklar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($oyuncak = $result->fetch_assoc()) {
    $oyuncaklar[] = $oyuncak; // Her bir ürünü $ürünlistesi dizisine ekleyin
  }
}
?>