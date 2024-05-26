<?php
$kitaplar = array(); // $ürünlistesi değişkenini boş bir dizi olarak tanımlayın

// Veritabanından ürünleri çekin ve $ürünlistesi değişkenine atayın
$sql = "SELECT * FROM kitaplar";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($kitap = $result->fetch_assoc()) {
    $kitaplar[] = $kitap; // Her bir ürünü $ürünlistesi dizisine ekleyin
  }
}
?>