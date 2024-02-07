<?php
$db_host="localhost";
$db_user= "root";
$db_pass= "";
$db_name= "otel_database";




$connection = mysqli_connect($db_host,$db_user,$db_pass, $db_name);

if (!$connection) {
    die("Bağlantı Sağlanamadı -- ". mysqli_connect_error());
}
else {

}


function login($username, $password)
{
    global $connection;

    $stmt = $connection->prepare("SELECT k.* FROM kullanicilar_tablosu k INNER JOIN giris_bilgileri_tablosu g ON g.giris_bilgileri_id = k.giris_bilgileri_id WHERE g.kullanici_adi = '$username' AND g.sifre ='$password'");

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc())
        {
        // İstediğiniz diğer bilgileri burada işleyebilirsiniz
            $tam_adi = $row["adi"]." ".$row["soyadi"];
            $kullanici_id = $row["kullanici_id"];
            $yetki = $row["kullanici_tipi"];

            if ($yetki == 2)
            {
                 // Yeni Session Dashboard'a yönlendiren -- Admin
                echo " Var";
                return array(1,$tam_adi,$kullanici_id);
            }
            elseif ($yetki == 3)
            {
                // Yeni Session Personel Sayfasına yönlendirme -- Personel
                echo " Yok";
                return array(2,$tam_adi,$kullanici_id);
            }
            else
            {
                echo " YYok";
                return array(0,NULL,NULL);
            }

            
        }
    } 
    else 
    {
    echo "Giriş bilgileri eşleşmedi veya kullanıcı bulunamadı.";
    return NULL;
    }

    $connection->close();
    
} 

?>