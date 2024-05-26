<?php 

if(isset($_GET["del_user"]))
{
    //Bağlantıyı dahil ediyoruz
    include("baglanti.php");
    $sql=$conn->prepare('DELETE FROM kullanicilar WHERE id=?');
    $result=$sql->execute([$_GET['del_user']]);
    if($result){
        header("Location:table.php"); 
    }
    else
        echo("Kayıt silinemedi.");
}


if(isset($_GET["del_message"]))
{
    //Bağlantıyı dahil ediyoruz
    include("baglanti.php");
    $sql2=$conn->prepare('DELETE FROM iletisim1 WHERE id=?');
    $result2=$sql2->execute([$_GET['del_message']]);
    if($result2){
        header("Location:table.php"); 
    }
    else
        echo("Kayıt silinemedi.");
}
 
?>