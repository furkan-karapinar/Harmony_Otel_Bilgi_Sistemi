<?php

include("./sidebar.php");
include("./navbar.php");
include("./footer.php");
require_once("./tables.php");
include("./logout.php");
include("./settings.php");
session_start();
$a = 0;

//$_SESSION['musteri_list'] = null;

// Kullanıcının yetkili no , kullanıcı adı ve id numarasını alınır ve yetkili mi kontrol eder
if (isset($_SESSION['yetki']) && isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $yetki = $_SESSION['yetki'];
    $username = $_SESSION['username'];
    $password = $_SESSION['id'];
    $a = 1;



    

    if(isset($_SESSION['yetki'])) {
        $yetki = $_SESSION['yetki'];
    } else {
        // $_SESSION['yetki'] değeri tanımlı değilse veya boşsa, varsayılan olarak 2 değerini atıyoruz
        $yetki = 2;
    }

    if ($yetki != 1 && $yetki != 2) {
        $a = 0;
        session_destroy();
        header("location: login.php");
        exit;
    }
}
$rst = -1;
    // Çıkış
    if (isset($_GET['logout'])) {

          $yetki = "";
          $username = "";
          $password = "";
          session_destroy();
      
          header("location: login.php");
          exit;}

$deneme = 0;
$islem_ = 0;

if (isset($_GET['id']) && isset($_GET['func'])) {
    $id_ = $_GET['id'];
    $name_ = $_GET['func'];

    if ($name_ == "del") {
        unset($_SESSION['musteri_list'][$id_]);

    }
}

if (isset($_GET['islem'])) {
    $islem_ = $_GET['islem'];
}


if (isset($_POST['kaydetButton'])) {


    if (isset($_SESSION['musteri_list'])) {
        $ml_id = 0;
        foreach ($_SESSION['musteri_list'] as $musteri) {
            $rst = customer_kayitla($musteri[0],$musteri[1],$musteri[2] ,$musteri[3] ,$musteri[4], $musteri[5], $musteri[6], $musteri[7], $musteri[8], $musteri[9], $musteri[10], $musteri[11], $musteri[12], $musteri[13]);

            $ml_id++;
        }
    }

    unset($_POST);
    $_SESSION['musteri_list'] = array();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al

    if (
        empty($_POST["adi"]) || empty($_POST["soyadi"]) || empty($_POST["tcNo"]) ||
        empty($_POST["telNo"]) || empty($_POST["adres"]) || empty($_POST["email"]) ||
        empty($_POST["dogumTarihi"]) || empty($_POST["cinsiyet"]) || empty($_POST["uyruk"]) ||
        empty($_POST["ulke"]) || empty($_POST["sehir"]) ||
        empty($_POST["oda"]) || empty($_POST["sezon"])
    ) {
        echo "Lütfen tüm alanları doldurun.";
    } else {
        // Tüm alanlar doluysa devam edebilirsiniz
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
        $oda_no = $_POST["oda"];
        $sezon = $_POST["sezon"];


        $yeni_musteri = array($adi, $soyadi, $tc_no, $tel_no, $adres, $email, $dogum, $cinsiyet, $uyruk, $ulke, $sehir, $plaka, $oda_no, $sezon);

        // Eğer daha önce müşteri listesi tanımlanmamışsa oluştur
        if (!isset($_SESSION['musteri_list'])) {
            $_SESSION['musteri_list'] = array();
        }
            $_SESSION['musteri_list'][] = $yeni_musteri;

            unset($_POST);
    }



   

    


}





?>

<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $siteBasligi ?></title>
<?php ikon(); ?>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= sidebar($yetki); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?= navbar("Oda Rezervasyonu", $username); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Yeni Oda Rezervasyonu</h6>
                        </div>
                        <div class="col-md-11 m-4 d-flex justify-content-center">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="myForm">
                                <div class="row g-2 mb-4">
                                    <div class="col-md-3">
                                        <label for="adi" class="form-label">Adı</label>
                                        <input type="text" class="form-control" onkeypress="return onlyAlphabets(event)"
                                            name="adi">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="soyadi" class="form-label">Soyadı</label>
                                        <input type="text" class="form-control"
                                            onkeypress="return onlyAlphabets2(event)" name="soyadi">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tcNo" class="form-label">TC No</label>
                                        <input type="text" class="form-control" onkeypress="return isNumber(event)"
                                            name="tcNo">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="telNo" class="form-label">Telefon No</label>
                                        <input type="text" class="form-control" onkeypress="return isNumber(event)"
                                            name="telNo">
                                    </div>
                                </div>


                                <div class="row g-2 mb-4">

                                    <div class="col-md-6">
                                        <label for="adres" class="form-label">Adres</label>
                                        <textarea class="form-control" name="adres" rows="3"></textarea>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="eMail" class="form-label">E-Mail</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dogumTarihi" class="form-label">Doğum Tarihi</label>
                                        <input type="date" class="form-control" name="dogumTarihi">
                                    </div>
                                </div>

                                <input type="hidden" class="form-select" name="kullaniciTipi" value="1"
                                    aria-label="Kullanıcı Tipi" disabled>
                                </input>

                                <div class="row g-2 mb-4">

                                    <div class="col-md-3">
                                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                                        <select class="js-example-basic-single" style="width: 50%" name="cinsiyet" aria-label="Cinsiyet">
                                            <option value="1">Erkek</option>
                                            <option value="2">Kadın</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="uyruk" class="form-label">Uyruk</label>
                                        <select class="js-example-basic-single" name="uyruk" aria-label="Uyruk">
                                            <?= select_box_lister(0); ?>
                                            <!-- Diğer uyruk seçenekleri -->
                                        </select>
                                    </div>

                                </div>

                                <div class="row g-2 mb-4">



                                    <div class="col-md-7">
                                        <label for="ulke" class="form-label">Ülke</label>
                                        <select class="js-example-basic-single" name="ulke" aria-label="Ülke">
                                            <?= select_box_lister(2); ?>
                                            <!-- Diğer ülke seçenekleri -->
                                        </select>
                                    </div>

                                    <div class="col-md-5">
                                        <label for="sehir" class="form-label">Şehir</label>
                                        <select class="js-example-basic-single" name="sehir" aria-label="Şehir">
                                            <?= select_box_lister(1); ?>
                                            <!-- Diğer şehir seçenekleri -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-4">


                                    <div class="col-md-2">
                                        <label for="odaNo" class="form-label">Oda No</label>
                                        <select id="odaNo" class="js-example-basic-single" onchange="room_status()"
                                            style="width: 110%" name="oda" aria-label="Oda">
                                            <?= select_box_lister(3); ?>
                                            <!-- Diğer şehir seçenekleri -->
                                        </select>
                                    </div>

                                    <div class="col-md-2 ml-4">
                                        <label for="sezon" class="form-label">Sezon</label>
                                        <select class="js-example-basic-single" name="sezon" aria-label="Sezon">
                                            <option value="1">Yaz</option>
                                            <option value="2">Kış</option>
                                            <option value="3">İlkbahar</option>
                                            <option value="4">Sonbahar</option>
                                            <!-- Diğer şehir seçenekleri -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dogumTarihi" class="form-label">Plaka</label>
                                        <input type="text" class="form-control" name="plakam">
                                    </div>

                                </div>

                                <div class="row g-2 mb-4">

                                </div>

                                <div class="row g-2 md-4">
                                </div>


                                <div class="row g-2 md-4">
                                    <div class="col-md-1 mt-4">
                                        <button type="submit" class="btn btn-primary">Ekle</button>
                                    </div>
                                    <div class="col-md-1 mt-4">
                                        <button type="button" class="btn btn-danger"
                                            onclick="temizleForm()">Temizle</button>
                                    </div>
                                </div>

                            </form>
                        </div>


                        <div class="mb-4 mx-3"></div>
                    </div>

                    <!-- DataTales Example -->
                    <?php

                    echo '                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kayıtlanacak Müşteriler Listesi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                            <th>TC</th>
                                            <th>Telefon No</th>
                                            <th>Adres</th>
                                            <th>Doğum Tarihi</th>
                                            <th>Oda No</th>
                                            <th>Özellikler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                            <th>TC</th>
                                            <th>Telefon No</th>
                                            <th>Adres</th>
                                            <th>Doğum Tarihi</th>
                                            <th>Oda No</th>
                                            <th>Özellikler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        ';

                    // Session'dan müşteri listesini al
                    if (isset($_SESSION['musteri_list'])) {
                        $ml_id = 0;
                        foreach ($_SESSION['musteri_list'] as $musteri) {
                            echo '<tr>';
                            echo '<td>' . $musteri[0] . '</td>';
                            echo '<td>' . $musteri[1] . '</td>';
                            echo '<td>' . $musteri[2] . '</td>';
                            echo '<td>' . $musteri[3] . '</td>';
                            echo '<td>' . $musteri[4] . '</td>';
                            echo '<td>' . $musteri[6] . '</td>';
                            echo '<td>' . $musteri[12] . '</td>';
                            echo '<td><a type="button" class="btn btn-danger"
                            href="m_management.php?id=' . $ml_id . '&func=del">Sil</a></td>';
                            // Diğer sütunlar için aynı şekilde devam edebilirsiniz
                            echo '</tr>';
                            $ml_id++;
                        }
                    }
                    echo '
                                    </tbody>
                                </table>

                                <form method="post">
        <!-- Form alanları burada -->
        <input type="submit" class="btn btn-primary mt-4" name="kaydetButton" value="Kaydet">
    </form>
                            </div>
                        </div>
                    </div>';


                    ?>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?= footer(); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?= logout(); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function room_status() {
            d = document.getElementById("odaNo").value;
            
        }
    </script>


    <script>$(document).ready(function () {
            $('.js-example-basic-single').select2();
        });</script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        function temizleForm() {
            document.getElementById("myForm").reset();
        }
    </script>



    <script>
        function onlyAlphabets(event) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode !== 32) {
                return false;
            }
            return true;
        }
    </script>
    <script>
        function isNumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    <script>
        function onlyAlphabets2(event) {
    var char = event.key;
    var regex = /[a-zA-ZğüşıöçĞÜŞİÖÇ]/; // Türkçe harflerle birlikte İngilizce harfleri de kontrol etmek için regex

    if (!regex.test(char)) {
        return false;
    }
    return true;
}
    </script>
    <script>function bip(tte, msj, status) {
            Swal.fire({
                title: tte,
                text: msj,
                icon: status,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Tamam',

            }).then((result) => {
                if (result.isConfirmed) {
                    // Buraya atama işlemlerini gerçekleştirecek olan kodları ekleyebilirsiniz.
                    window.location.href = 'm_management.php';
                }
            });
        }
    </script>


    <?php

    if ($rst == "Yeni kayıt başarıyla eklendi.") {
        echo "<script>bip('Başarılı','$rst','success');</script>";
    } elseif ($rst == "Lütfen tüm alanları doldurun") {
        echo "<script>bip('Başarısız','$rst','error');</script>";
    } elseif ($rst == "Bu giriş bilgileri zaten mevcut") {
        echo "<script>bip('Başarısız','$rst" . " veya kayıt hatası" . "','error');</script>";
    } else {
    }

    runn($deneme, 1);
    runn($islem_, 2);
    function runn($i, $j)
    {
        if ($i == 1 && $j == 1) {
            echo "<script>bip('Başarılı','Kayıt Silme İşlemi Başarılı','success');</script>";
        } elseif ($i == 2 && $j == 1) {
            echo "<script>bip('Başarısız','Kayıt Silme İşlemi Başarısız','error');</script>";
        }

        if ($i == 1 && $j == 2) {
            echo "<script>bip('Başarılı','Kayıt Düzenleme İşlemi Başarılı','success');</script>";
        } elseif ($i == 2 && $j == 2) {
            echo "<script>bip('Başarısız','Kayıt Düzenleme İşlemi Başarısız','error');</script>";
        }
    }



    ?>

</body>

</html>