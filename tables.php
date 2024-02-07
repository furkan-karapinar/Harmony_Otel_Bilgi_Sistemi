<?php

include_once("./connection.php");

function add_data($id, $ad, $soyad, $tc, $tel, $adres, $dogum, $plaka, $p_or_m_management, $del)
{
    return '                                        <tr>
    <td>' . $ad . '</td>
    <td>' . $soyad . '</td>
    <td>' . $tc . '</td>
    <td>' . $tel . '</td>
    <td>' . $adres . '</td>
    <td>' . $dogum . '</td>
    <td>' . $plaka . '</td>
    <td>' . buttons_($id, $p_or_m_management, $del) . '</td>
</tr>';
}

function add_data2($id, $ad, $soyad,$tel, $plaka,$oda_no)
{
    return '                                        <tr>
    <td>' . $ad . '</td>
    <td>' . $soyad . '</td>
    <td>' . $tel . '</td>
    <td>' . $plaka . '</td>
    <td>' . $oda_no . '</td>
    <td>' . kayit_guncelle_($id,$oda_no) . '</td>
</tr>';
}

function add_data3($id, $ad, $soyad,$tel, $plaka,$oda_no)
{
    return '                                        <tr>
    <td>' . $ad . '</td>
    <td>' . $soyad . '</td>
    <td>' . $tel . '</td>
    <td>' . $plaka . '</td>
    <td>' . $oda_no . '</td>
    <td>' . kayit_bitir_($id,$oda_no) . '</td>
</tr>';
}

function buttons_($id, $p_or_m_management, $del)
{
    $a = "";
    if ($del == 1) {
        $a = '<a type="button" class="btn btn-danger"
        href="' . $p_or_m_management . '.php?id=' . $id . '&func=del">Sil</a>';
    }

    return '                                    <div class="col-md-1 mt-4">
<a type="button" href="' . $p_or_m_management . '.php?id=' . $id . '&func=edt" class="btn btn-primary">Düzenle</a>
</div>
<div class="col-md-1 mt-4">' . $a . '

</div>';
}


function kayit_guncelle_($id,$oda_no)
{
    return '<form action="m_guncelle.php" method="GET">
    <input type="hidden" id="id" name="id" value="'.$id.'" required>
    <label for="odaNo">Oda No:</label>
    <select class="js-example-basic-single" id="upt"  name="upt">'.select_box_lister(3).'</select>
    <input type="submit" class="btn btn-primary ml-4" value="Güncelle">
</form>';



}


function kayit_bitir_($id,$oda_no)
{
    $veri = oda_ucret($id);
    return '<form action="otel_kayit.php" method="GET">
    <input type="hidden" id="id" name="id" value="'.$id.'" required>
    <select id="odeme" name="odeme">
    <option value="1" selected>Nakit</option>
            <option value="2">Kredi Kartı</option>
        </select>
    <label for="odaNo">Çıkış Yapılırsa Tutar: '.$veri.'</label>
    <input type="submit" class="btn btn-danger ml-4" value="Çıkışı Tamamla">
</form>';



}

function get_personal_data_from_database($value)
{
    global $connection;

    $rslt = "";
    $sql = "SELECT * FROM `kullanicilar_tablosu` WHERE kullanici_tipi = 3";
    $result = $connection->query($sql);

    // Verileri işle
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Veri işlemleri burada yapılabilir
            // Örnek olarak, verileri ekrana yazdırıyorum, istediğiniz işlemi yapabilirsiniz.
            $rslt .= add_data($row["kullanici_id"], $row["adi"], $row["soyadi"], $row["tc_no"], $row["tel_no"], $row["adres"], $row["dogum_tarihi"], $row["plaka_no"], "p_management", $value);
        }
    } else {

    }

    // Bağlantıyı kapat
    $connection->close();

    return $rslt;
}

function personel_kayitla($adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka, $k_tipi, $k_adi, $k_sifre)
{

    if (
        empty($adi) || empty($soyadi) || empty($tc_no) || empty($tel_no) ||
        empty($adres) || empty($email) || empty($dogum) || empty($cinsiyet) ||
        empty($uyruk) || empty($ulke) || empty($sehir) ||
        empty($k_tipi) || empty($k_adi) || empty($k_sifre)
    ) {
        return "Lütfen tüm alanları doldurun";
    } else {
        global $connection;
        $yeniId = 0;

        $sql = "SELECT * FROM giris_bilgileri_tablosu WHERE kullanici_adi = '$k_adi'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            return "Bu giriş bilgileri zaten mevcut";
        } else {
            $sql = "INSERT INTO giris_bilgileri_tablosu (kullanici_adi, sifre) VALUES ('$k_adi', '$k_sifre')";

            if ($connection->query($sql) === TRUE) {
                $yeniId = $connection->insert_id; // Yeni eklenen kaydın ID'sini al

                //
                $sql = "INSERT INTO `kullanicilar_tablosu` ( `kullanici_tipi`, `adi`
                , `soyadi`, `tc_no`, `tel_no`, `adres`, `e_mail`, `dogum_tarihi`, `cinsiyet_id`, 
                `uyruk_id`, `ulke_id`, `sehir_id`, `plaka_no`, `giris_bilgileri_id` , `kullanici_id`) 
                VALUES ('$k_tipi', '$adi', '$soyadi', '$tc_no', '$tel_no', '$adres', '$email', '$dogum', '$cinsiyet', '$uyruk', '$ulke', '$sehir', '$plaka', '$yeniId' , '$yeniId')";
                if ($connection->query($sql) === TRUE) {
                    return "Yeni kayıt başarıyla eklendi.";
                } else {
                    $sql = "DELETE FROM giris_bilgileri_tablosu WHERE giris_bilgileri_id = $yeniId";

                    if ($connection->query($sql) === TRUE) {
                        echo "Kayıt başarıyla silindi";
                    } else {
                        echo "Hata oluştu";
                    }
                    return "Hata";
                }
            }
        }
        // Bağlantıyı kapat
        $connection->close();
    }



}

function personel_guncelle($id, $adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka, $k_tipi, $k_adi, $k_sifre)
{

    if (!empty($id) && !empty($adi) && !empty($soyadi) && !empty($tc_no) && !empty($tel_no) && !empty($adres) && !empty($email) && !empty($dogum) && !empty($cinsiyet) && !empty($uyruk) && !empty($ulke) && !empty($sehir) && !empty($k_tipi) && !empty($k_adi) && !empty($k_sifre)) {

        global $connection;


        $sql = "UPDATE `kullanicilar_tablosu` SET 
        `adi` = '$adi',
        `soyadi` ='$soyadi',
        `tc_no` ='$tc_no',
        `tel_no` ='$tel_no',
        `adres` ='$adres',
        `e_mail` ='$email',
        `dogum_tarihi` ='$dogum',
        `cinsiyet_id` ='$cinsiyet',
        `uyruk_id` ='$uyruk',
        `ulke_id` ='$ulke',
        `sehir_id` ='$sehir',
        `plaka_no` ='$plaka',
        `kullanici_tipi` = '$k_tipi'
        WHERE `kullanici_id` = '$id'";

        // Sorguyu hazırla ve parametreleri bağla
        $stmt = $connection->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            // Bağlantıyı kapat
            $stmt->close();
        } else {
            return 2;
        }

        // Sorgu başarılı bir şekilde çalıştı mı kontrol et

       // $sqlt = "UPDATE `giris_bilgileri_tablosu` SET `kullanici_adi` = '$k_adi',`sifre` = '$k_sifre' WHERE `giris_bilgileri_id` = '$id'";

        // Sorguyu hazırla ve parametreleri bağla
      //  $stmt = $connection->prepare($sqlt);
       // if ($stmt) {
         //   $stmt->execute();

            // Sorgu başarılı bir şekilde çalıştı mı kontrol et
         //   if ($stmt->affected_rows > 0) {
         //       $stmt->close();
                return 1;
         //   } else {
                $stmt->close();
         //       return 1;
         //   }

            // Bağlantıyı kapat

       // } else {
         //   return 2;
       // }

    } else {

    }



}

function get_data($id, $istenilen, $switch)
{
    global $connection;

    $sql = "";
    if ($switch == 1) {
        $sql = "SELECT * FROM kullanicilar_tablosu WHERE kullanici_id = $id";
    } else {
        $sql = "SELECT * FROM giris_bilgileri_tablosu WHERE giris_bilgileri_id = $id";
    }


    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Veri bulunduysa, her bir satırı döngüyle alıp işleyebilirsiniz
        while ($row = $result->fetch_assoc()) {
            $rst_ = $row["$istenilen"];
            return $rst_;
        }
    } else {
        echo "Veri bulunamadı";
    }

    // Bağlantıyı kapat
    $connection->close();
}

function personel_sil($id)
{

    global $connection;
    $giris_bilgileri_id = 0;

    // Bağlantıyı oluşturun
    // ...

    // Kullanıcı bilgisini alın
    $sql = "SELECT giris_bilgileri_id FROM kullanicilar_tablosu WHERE kullanici_id = $id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Veri bulunduysa
        $row = $result->fetch_assoc();
        $giris_bilgileri_id = $row["giris_bilgileri_id"];

        // Transaksiyon başlat
        $connection->begin_transaction();

        // İlk tablodan silme işlemi
        $delete_user_query = "DELETE FROM kullanicilar_tablosu WHERE kullanici_id = $id";
        if ($connection->query($delete_user_query) === TRUE) {
            // İkinci tablodan silme işlemi
            $delete_giris_query = "DELETE FROM giris_bilgileri_tablosu WHERE giris_bilgileri_id = $giris_bilgileri_id";
            if ($connection->query($delete_giris_query) === TRUE) {
                // İşlemleri tamamla (commit)
                $connection->commit();
                return 1;
            } else {
                // Hata durumunda işlemleri geri al (rollback)
                $connection->rollback();
                return 0;
            }
        } else {
            // Hata durumunda işlemleri geri al (rollback)
            $connection->rollback();
            return 0;
        }
    } else {
        // Veri bulunamadıysa
        return 0;
    }







}


//--------------------------------------
// Müşteri //
//--------------------------------------

function get_customer_data_from_database($del)
{
    global $connection;

    $rslt = "";
    $sql = "SELECT kullanicilar_tablosu.* , o.oda_id FROM kullanicilar_tablosu INNER JOIN otel_kayit_tablosu o ON kullanicilar_tablosu.kullanici_id = o.kullanici_id WHERE kullanicilar_tablosu.kullanici_tipi = 1 AND o.odendi_mi = 0;
";
    $result = $connection->query($sql);

    // Verileri işle
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Veri işlemleri burada yapılabilir
            // Örnek olarak, verileri ekrana yazdırıyorum, istediğiniz işlemi yapabilirsiniz.
            $rslt .= add_data2($row["kullanici_id"], $row["adi"], $row["soyadi"], $row["tel_no"], $row["plaka_no"],$row["oda_id"]);
        }
    } else {

    }

    // Bağlantıyı kapat
    $connection->close();

    return $rslt;
}

function get_customer_data_from_database_for_pay($del)
{
    global $connection;

    $rslt = "";
    $sql = "SELECT kullanicilar_tablosu.* , o.oda_id FROM kullanicilar_tablosu INNER JOIN otel_kayit_tablosu o ON kullanicilar_tablosu.kullanici_id = o.kullanici_id WHERE kullanicilar_tablosu.kullanici_tipi = 1 AND o.odendi_mi = 0;
";
    $result = $connection->query($sql);

    // Verileri işle
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Veri işlemleri burada yapılabilir
            // Örnek olarak, verileri ekrana yazdırıyorum, istediğiniz işlemi yapabilirsiniz.
            $rslt .= add_data3($row["kullanici_id"], $row["adi"], $row["soyadi"], $row["tel_no"], $row["plaka_no"],$row["oda_id"]);
        }
    } else {

    }

    // Bağlantıyı kapat
    $connection->close();

    return $rslt;
}

function customer_kayitla($adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka, $oda_no, $sezon)
{
    global $connection;

    // Gerekli alanların dolu olup olmadığını kontrol et
    $requiredFields = array($adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $oda_no, $sezon);
    if (in_array('', $requiredFields)) {
        return 2;
    }
    if (in_array('', array($plaka))) {
        $plaka = "";
    }

    $kullanici_id = 0;

    $sql = "SELECT kullanici_id FROM kullanicilar_tablosu WHERE tc_no = '$tc_no'";
    $result = $connection->query($sql);

    // Eğer eşleşen bir kayıt varsa, kullanici_id değerini döndür
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kullanici_id = $row["kullanici_id"];
        echo "Eşleşen kullanıcı ID: " . $kullanici_id;
    } else {
        // Eğer eşleşen bir kayıt yoksa, yeni bir kayıt ekle
        $sql = "INSERT INTO `kullanicilar_tablosu` ( `kullanici_tipi`, `adi`
        , `soyadi`, `tc_no`, `tel_no`, `adres`, `e_mail`, `dogum_tarihi`, `cinsiyet_id`, 
        `uyruk_id`, `ulke_id`, `sehir_id`, `plaka_no`) 
        VALUES ('1', '$adi', '$soyadi', '$tc_no', '$tel_no', '$adres', '$email', '$dogum', '$cinsiyet', '$uyruk', '$ulke', '$sehir', '$plaka')";
        if ($connection->query($sql) === TRUE) {
            $kullanici_id = $connection->insert_id; // Yeni eklenen kaydın ID'sini al
            echo "Yeni kullanıcı ID: " . $kullanici_id;
        } else {
            echo "Kayıt eklenirken bir hata oluştu: " . $connection->error;
        }
    }

    $sql = "INSERT INTO otel_kayit_tablosu (giris_tarihi, kullanici_id, oda_id, sezon_id) VALUES (NOW(), '$kullanici_id', '$oda_no', '$sezon' )";



    // Sorguyu çalıştırma
    if ($connection->query($sql) === TRUE && $kullanici_id != 0) {
        return "Yeni kayıt başarıyla eklendi.";
    } else {
        return "Bu giriş bilgileri zaten mevcut";
    }
}


function customer_guncelle($kullanici_id, $adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka, $oda_no, $sezon)
{
    global $connection;

    // Gerekli alanların dolu olup olmadığını kontrol et
    $requiredFields = array($adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $oda_no, $sezon);
    if (in_array('', $requiredFields)) {
        return 2; // Eksik alan var
    }

    $sql = "UPDATE `kullanicilar_tablosu` SET 
            `adi` = '$adi', 
            `soyadi` = '$soyadi', 
            `tc_no` = '$tc_no', 
            `tel_no` = '$tel_no', 
            `adres` = '$adres', 
            `e_mail` = '$email', 
            `dogum_tarihi` = '$dogum', 
            `cinsiyet_id` = '$cinsiyet', 
            `uyruk_id` = '$uyruk', 
            `ulke_id` = '$ulke', 
            `sehir_id` = '$sehir', 
            `plaka_no` = '$plaka' 
            WHERE `kullanici_id` = $kullanici_id";

    if ($connection->query($sql) === TRUE) {
        $sql = "UPDATE `otel_kayit_tablosu` SET
                `oda_id` = '$oda_no', 
                `sezon_id` = '$sezon'
                WHERE `kullanici_id` = $kullanici_id AND odendi_mi = 0";

        if ($connection->query($sql) === TRUE) {
            return 1; // Başarıyla güncellendi
        } else {
            return 0; // Otel kaydı güncellenirken hata
        }
    } else {
        return 0; // Kullanıcı bilgileri güncellenirken hata
    }
}


function customer_sil($id)
{

    global $connection;

    // 1. Adım: NULL yapılacak olan kullanıcıların kullanıcı ID'lerini bul
    $sql_update = "UPDATE otel_kayit_tablosu okt
INNER JOIN kullanicilar_tablosu kt ON okt.kullanici_id = kt.kullanici_id
SET okt.kullanici_id = NULL
WHERE kt.kullanici_id = '$id'";

    if ($connection->query($sql_update) === TRUE) {
        echo "otel_kayit_tablosu tablosundaki kullanici_id NULL olarak güncellendi.<br>";
    } else {
        echo "Güncelleme hatası: " . $connection->error;
    }

    // 2. Adım: Kullanıcı tablosundaki ilgili veriyi sil
    $sql_delete = "DELETE FROM kullanicilar_tablosu WHERE kullanici_id = '$id'";

    if ($connection->query($sql_delete) === TRUE) {
        echo "Kullanicilar_tablosu tablosundaki ilgili veri silindi.";
    } else {
        echo "Silme hatası: " . $connection->error;
    }








}


function select_box_lister($type)
{
    $ress = "";
    $row_id = "";
    $row_value = "";
    global $connection;


    if ($type == 1) {
        $sql = "SELECT * FROM `sehir_tablosu` ORDER BY `sehir_id` ASC";
        $row_id = "sehir_id";
        $row_value = "sehir_adi";
    } else if ($type == 2) {
        $sql = "SELECT * FROM `ulke_tablosu` ORDER BY `ulke_id` ASC";
        $row_id = "ulke_id";
        $row_value = "ulke_adi";
    } else if ($type == 3) {
        $sql = "SELECT DISTINCT oda_tablosu.oda_id
        FROM oda_tablosu
        LEFT JOIN otel_kayit_tablosu ON oda_tablosu.oda_id = otel_kayit_tablosu.oda_id
        WHERE otel_kayit_tablosu.odendi_mi = 1 OR otel_kayit_tablosu.odendi_mi IS NULL  
        ORDER BY `oda_tablosu`.`oda_id` ASC";
        $row_id = "oda_id";
        $row_value = "oda_id";
    } else {
        $sql = "SELECT * FROM `uyruk_tablosu` ORDER BY `uyruk_id` ASC";
        $row_id = "uyruk_id";
        $row_value = "uyruk_adi";
    }




    // Sorguyu çalıştırma
    $result = $connection->query($sql);

    // Sonuçları kontrol etme ve gösterme
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sehir_id = $row[$row_id];
            $sehir_adi = $row[$row_value];
            $ress .= "  <option value=" . $sehir_id . ">" . $sehir_adi . "</option>";

        }
    } else {
        echo "Kayıt bulunamadı";
    }
    return $ress;

}

function m_oda_guncelle($k_id,$new_oda_id)
{ global $connection;
    $sql = "UPDATE otel_kayit_tablosu SET oda_id = $new_oda_id WHERE kullanici_id = $k_id";

if ($connection->query($sql) === TRUE) {
    return 1;
} else {
    return 0;
}

}


function oda_ucret($id__)
{
    global $connection;
    $sql = "SELECT oda_tipi_tablosu.oda_ucreti * 
    CASE 
        WHEN DATEDIFF(CURDATE(), otel_kayit_tablosu.giris_tarihi) = 0 THEN 1
        ELSE DATEDIFF(CURDATE(), otel_kayit_tablosu.giris_tarihi)
    END as toplam_tutar
FROM otel_kayit_tablosu
INNER JOIN oda_tablosu ON otel_kayit_tablosu.oda_id = oda_tablosu.oda_id
INNER JOIN oda_tipi_tablosu ON oda_tablosu.oda_tipi_id = oda_tipi_tablosu.oda_tipi_id
WHERE otel_kayit_tablosu.kullanici_id = '$id__';
";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        return $row["toplam_tutar"];
    }
} else {
    return 0;
}
}

function m_cikis($id__,$odeme_tur)
{
    global $connection;
    
    $sql = "UPDATE otel_kayit_tablosu SET cikis_tarihi = CURDATE(), odendi_mi = 1 , odeme_tipi_id = $odeme_tur  , tutar = ". oda_ucret($id__) ." WHERE kullanici_id = $id__";

if ($connection->query($sql) === TRUE) {
    return 1;
} else {
   return 0;
}

}


?>