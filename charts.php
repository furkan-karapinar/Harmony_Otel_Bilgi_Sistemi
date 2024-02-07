<?php

include("./connection.php");

$conn = new mysqli("localhost", "root","","otel_database");
$sql = "SELECT COUNT(*) AS adet, s.sezon_adi
FROM otel_kayit_tablosu ok
INNER JOIN sezon_tablosu s ON ok.sezon_id = s.sezon_id
WHERE YEAR(ok.giris_tarihi) = YEAR(NOW())
GROUP BY ok.sezon_id, s.sezon_adi
HAVING COUNT(*) > 1";
$result = mysqli_query($conn, $sql);
    
$csayilar="";
$odalar="";

//---------------------------------------------------------------//
//---------------Sezonlara Göre Müşteri Yoğunluğu----------------//

if(mysqli_num_rows($result) != 0){
        
        while($row = mysqli_fetch_array($result))
        {
        $csayilar .= "{ value: " . $row['adet'] . ", name: '" . $row['sezon_adi'] . "' }, ";
        }
        
    }
    // Son virgülü kaldırmak için rtrim kullanıyoruz
    $csayilar = rtrim($csayilar, ', ');	

//---------------------------------------------------------------//
//---------------------------------------------------------------//

function get_room_types()
{
    global $conn;
    $sql = "SELECT oda_tipi FROM oda_tipi_tablosu";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    $odaTipleri = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $odaTipleri[] = "'".$row["oda_tipi"]."'";
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    $odaTipleriString = implode(', ', $odaTipleri);
    
        return $odaTipleriString;

}

function get_room_type($number)
{
    global $conn;
    $sql = "SELECT oda_tipi FROM oda_tipi_tablosu";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    $odaTipleri = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $odaTipleri[] = "'".$row["oda_tipi"]."'";
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return $odaTipleri[$number];

}


function get_room_type_value($month,$room_type)
{
    global $conn;
    $sql = "SELECT ott.oda_tipi, COUNT(okt.oda_id) AS kullanim_sayisi, MONTH(okt.giris_tarihi) AS ay, YEAR(okt.giris_tarihi) as yil 
    FROM oda_tipi_tablosu ott LEFT JOIN oda_tablosu ot ON ott.oda_tipi_id = ot.oda_tipi_id 
    LEFT JOIN otel_kayit_tablosu okt ON ot.oda_id = okt.oda_id 
    WHERE YEAR(okt.giris_tarihi) = YEAR(NOW()) GROUP BY ott.oda_tipi, MONTH(okt.giris_tarihi)";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    $odaTipleri = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            if ("'".$row['oda_tipi']."'" == get_room_type($room_type) && $row['ay'] == $month)
            {
                return $row['kullanim_sayisi'];
            }


        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}

function get_country_from_customer($row_num ,$return_switch)
{
    global $conn;
    $sql = "SELECT ut.ulke_adi, COUNT(okt.kullanici_id) AS sayi
    FROM kullanicilar_tablosu kt
    INNER JOIN ulke_tablosu ut ON kt.ulke_id = ut.ulke_id
    LEFT JOIN otel_kayit_tablosu okt ON kt.kullanici_id = okt.kullanici_id
    WHERE YEAR(okt.giris_tarihi) = YEAR(NOW()) AND MONTH(okt.giris_tarihi) = MONTH(NOW()) 
    GROUP BY ut.ulke_adi LIMIT 5";
    $result = $conn->query($sql);
    $r_num=-1;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $r_num++;

            if ($r_num == $row_num)
            {
                 if ($return_switch == 0)
            {
                return $row['ulke_adi'];
            }
            else
            {
                return $row['sayi'];
            }
            }

           
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}


function get_month_earning()
{
    global $conn;
    $sql = "SELECT SUM(tutar) AS toplam_satis FROM otel_kayit_tablosu WHERE YEAR(giris_tarihi) = YEAR(NOW()) AND MONTH(giris_tarihi) = MONTH(NOW());";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['toplam_satis'];
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}

function get_yearly_earning()
{
    global $conn;
    $sql = "SELECT SUM(tutar) AS toplam_satis FROM otel_kayit_tablosu WHERE YEAR(giris_tarihi) = YEAR(NOW());";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['toplam_satis'];
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}


function get_empty_room_count()
{
    global $conn;
    $sql = "SELECT (SELECT COUNT(*) FROM oda_tablosu) - (SELECT COUNT(*) FROM otel_kayit_tablosu WHERE odendi_mi != 1) AS kalan_oda";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['kalan_oda'];
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}


function get_full_room_count()
{
    global $conn;
    $sql = "SELECT COUNT(*) AS kalan_oda FROM otel_kayit_tablosu WHERE odendi_mi != 1";
    $result = $conn->query($sql);

// Değerleri diziye aktar
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $row['kalan_oda'];
        }
    } else {
        echo "Kayıt bulunamadı.";
    }

    return 0;

}


function get_gender_list()
{
    global $conn;
    $sql = "SELECT ct.cinsiyet_adi, COUNT(kt.kullanici_id) AS kullanici_sayisi
    FROM kullanicilar_tablosu kt
    INNER JOIN cinsiyet_tablosu ct ON kt.cinsiyet_id = ct.cinsiyet_id
    INNER JOIN otel_kayit_tablosu okt ON kt.kullanici_id = okt.kullanici_id
    WHERE YEAR(okt.giris_tarihi) = YEAR(NOW()) AND MONTH(okt.giris_tarihi) = MONTH(NOW())
    GROUP BY ct.cinsiyet_adi";
    $result = $conn->query($sql);
    
// Değerleri diziye aktar
    $typ = "";
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result))
        {
        $typ .= "{ value: " . $row['kullanici_sayisi'] . ", name: '" . $row['cinsiyet_adi'] . "' }, ";
        }
        
    }
    // Son virgülü kaldırmak için rtrim kullanıyoruz
    $typs = rtrim($typ, ', ');	

    
    echo $typs;
}



function get_cash_type_list()
{
    global $conn;
    $sql = "SELECT ott.odeme_tipi_adi, COUNT(okt.odeme_tipi_id) AS odeme_sayisi, 
    FLOOR((COUNT(okt.odeme_tipi_id) / (SELECT COUNT(*) FROM otel_kayit_tablosu)) * 100) AS yuzde_orani 
    FROM otel_kayit_tablosu okt INNER JOIN odeme_tipi_tablosu ott ON okt.odeme_tipi_id = ott.odeme_tipi_id 
    WHERE ott.odeme_tipi_adi IN ('nakit', 'kredi kartı') GROUP BY ott.odeme_tipi_adi";
    $result = $conn->query($sql);
    
// Değerleri diziye aktar
    $typ = "";
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result))
        {
        $typ .= "{ value: " . $row['yuzde_orani'] . ", name: '" . $row['odeme_tipi_adi'] . "' }, ";
        }
        
    }
    // Son virgülü kaldırmak için rtrim kullanıyoruz
    $typs = rtrim($typ, ', ');	

    
    echo $typs;
}

//---------------------------------------------------------------//
//--------------- En Çok Tercih Edilen Oda Türleri---------------//


    $sql = "SELECT DISTINCT ot.oda_id AS 'ID', ott.oda_tipi AS 'TUR'
    FROM otel_kayit_tablosu ot JOIN oda_tablosu odt ON ot.oda_id = odt.oda_id 
    JOIN oda_tipi_tablosu ott ON odt.oda_tipi_id = ott.oda_tipi_id";
    $result = mysqli_query($conn, $sql);


    if(mysqli_num_rows($result) != 0){
        
        while($row = mysqli_fetch_array($result))
        {
        $odalar .= "{ value: " . $row['ID'] . ", name: '" . $row['TUR'] . "' }, ";
        }
        
    }
    // Son virgülü kaldırmak için rtrim kullanıyoruz
    $odalar = rtrim($odalar, ', ');	

//---------------------------------------------------------------//
//---------------------------------------------------------------//









?>