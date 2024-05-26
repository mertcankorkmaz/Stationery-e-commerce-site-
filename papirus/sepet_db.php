<?php
include "baglanti.php";
$db = new PDO("mysql:host=localhost;dbname=papirus", "root", "");
session_start();

function getCart()
{
    if (isset($_SESSION["shoppingCart"]["summary"]["total_count"])) {
        return $_SESSION["shoppingCart"]["summary"]["total_count"];
    } else {
        return 0;
    }
}

function addToCart($urun_item, $category)
{
    if (!isset($_SESSION["shoppingCart"])) {
        $_SESSION["shoppingCart"] = array(
            "ürünlistesi" => array(),
            "oyuncaklar" => array(),
            "kitaplar" => array(),
            "summary" => array("total_price" => 0.0, "total_count" => 0)
        );
    }

    $shoppingCart = &$_SESSION["shoppingCart"];
    $shoppingCart[$category] = isset($shoppingCart[$category]) ? $shoppingCart[$category] : array();

    $urun_item->count = 1;
    $urun_item->category = $category;

    if (array_key_exists($urun_item->id, $shoppingCart[$category])) {
        $shoppingCart[$category][$urun_item->id]->count++;
    } else {
        $shoppingCart[$category][$urun_item->id] = $urun_item;
    }

    updateCartSummary();
}

function removeFromCart($urun_id, $category)
{
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = &$_SESSION["shoppingCart"];
        if (array_key_exists($urun_id, $shoppingCart[$category])) {
            unset($shoppingCart[$category][$urun_id]);
            updateCartSummary();
            return true;
        }
    }
    return false;
}

function incCount($urun_id, $category)
{
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = &$_SESSION["shoppingCart"];
        if (array_key_exists($urun_id, $shoppingCart[$category])) {
            $shoppingCart[$category][$urun_id]->count++;
            updateCartSummary();
            return true;
        }
    }
    return false;
}

function decCount($urun_id, $category)
{
    if (isset($_SESSION["shoppingCart"])) {
        $shoppingCart = &$_SESSION["shoppingCart"];
        if (array_key_exists($urun_id, $shoppingCart[$category])) {
            if ($shoppingCart[$category][$urun_id]->count > 1) {
                $shoppingCart[$category][$urun_id]->count--;
            } else {
                unset($shoppingCart[$category][$urun_id]);
            }
            updateCartSummary();
            return true;
        }
    }
    return false;
}

function clearCart()
{
    unset($_SESSION["shoppingCart"]);
}

function updateCartSummary()
{
    $shoppingCart = &$_SESSION["shoppingCart"];
    $total_price = 0.0;
    $total_count = 0;

    foreach (["ürünlistesi", "oyuncaklar", "kitaplar"] as $category) {
        foreach ($shoppingCart[$category] as $urun) {
            $urun->total_price = $urun->count * $urun->fiyat;
            $total_price += $urun->total_price;
            $total_count += $urun->count;
        }
    }

    $shoppingCart["summary"]["total_price"] = $total_price;
    $shoppingCart["summary"]["total_count"] = $total_count;
}

if (isset($_POST["p"])) {
    $islem = $_POST["p"];
    $urun_id = $_POST["urun_id"] ?? null;
    $category = $_POST["category"] ?? null;

    if ($islem == "addToCart") {
        $table = $category == "kitaplar" ? "kitaplar" : ($category == "oyuncaklar" ? "oyuncaklar" : "ürünler");
        $urun = $db->query("SELECT *, '$category' AS category FROM $table WHERE id={$urun_id}", PDO::FETCH_OBJ)->fetch();
        if ($urun) {
            addToCart($urun, $category);
            echo getCart();
        } else {
            echo "Ürün bulunamadı.";
        }
    } else if ($islem == "remove") {
        if (removeFromCart($urun_id, $category)) {
            echo "Ürün sepetten çıkarıldı.";
        } else {
            echo "Ürün sepetten çıkarılamadı.";
        }
    } else if ($islem == "getCart") {
        echo getCart();
    } else if ($islem == "inc") {
        if (incCount($urun_id, $category)) {
            echo "Ürün adedi artırıldı.";
        } else {
            echo "Ürün adedi artırılamadı.";
        }
    } else if ($islem == "dec") {
        if (decCount($urun_id, $category)) {
            echo "Ürün adedi azaltıldı.";
        } else {
            echo "Ürün adedi azaltılamadı.";
        }
    } else if ($islem == "clearCart") {
        clearCart();
        echo "Sepet boşaltıldı.";
    }
}

if (isset($_GET["p"])) {
    $islem = $_GET["p"];
    $urun_id = $_GET["urun_id"] ?? null;
    $category = $_GET["category"] ?? null;

    if ($islem == "incCount") {
        if (incCount($urun_id, $category)) {
            header("Location:sepet.php");
        }
    } else if ($islem == "decCount") {
        if (decCount($urun_id, $category)) {
            header("Location:sepet.php");
        }
    }
}
?>
