<?php

require_once("./tables.php");

session_start();

// Kullanıcının yetkili no , kullanıcı adı ve id numarasını alınır ve yetkili mi kontrol eder
if (isset($_SESSION['yetki']) && isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $yetki = $_SESSION['yetki'];
    $username = $_SESSION['username'];
    $password = $_SESSION['id'];


    if ($yetki != 1) {
        $yetki = "";
        $username = "";
        $password = "";
        session_destroy();
        header("location: login.php");
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_ = $_POST["id"];

    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $tc_no = $_POST["tcNo"];
    $tel_no = $_POST["telNo"];
    $adres = $_POST["adres"];
    $email = $_POST["email"];
    $dogum = $_POST["dogumTarihi"];
    $cinsiyet = $_POST["cinsiyet"];
    $uyruk = $_POST["uyruk"];
    $ulke = $_POST["ulke"];
    $sehir = $_POST["sehir"];
    $plaka = $_POST["plakam"];
    $rst = customer_guncelle($id_,$adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka);

    
    if ($rst == 1) {header("Location: m_management.php?islem=1"); exit();}
    else {header("Location: m_management.php?islem=2"); exit();}

}

?>