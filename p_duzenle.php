<?php

include("./sidebar.php");
include("./navbar.php");
include("./footer.php");
require_once("./tables.php");
include("./logout.php");
include("./settings.php");

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

    // Çıkış
    if (isset($_GET['logout'])) {
 
          $yetki = "";
          $username = "";
          $password = "";
          session_destroy();
      
          header("location: login.php");
          exit;}

$id_=0;
if (isset($_GET['id'])) {
    $id_ = $_GET['id'];

    $adi = get_data($id_,"adi",1);
$soyadi = get_data($id_,"soyadi",1);
$tc_no = get_data($id_,"tc_no",1);
$tel_no = get_data($id_,"tel_no",1);
$adres = get_data($id_,"adres",1);
$email = get_data($id_,"e_mail",1);
$dogum = get_data($id_,"dogum_tarihi",1);
$cinsiyet = get_data($id_,"cinsiyet_id",1);
$uyruk = get_data($id_,"uyruk_id",1);
$ulke = get_data($id_,"ulke_id",1);
$sehir = get_data($id_,"sehir_id",1);
$plaka = get_data($id_,"plaka_no",1);
$k_tipi = get_data($id_,"kullanici_tipi",1);
$k_adi = get_data($id_,"kullanici_adi",0);
$k_sifre = get_data($id_,"sifre",0);
}
else {
    header("Location: p_management.php"); exit();
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
                <?= navbar("Personel Yönetimi", $username); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Personel Güncelle</h6>
                        </div>
                        
                        <div class="col-md-11 m-4 d-flex justify-content-center">
                            <form method="POST" action="islem.php" id="myForm">
                            <input type="hidden" class="form-control" value="<?= $id_ ?>" name="id">
                                <div class="row g-2 mb-4">
                                    <div class="col-md-3">
                                        <label for="adi" class="form-label">Adı</label>
                                        <input type="text" class="form-control" value="<?= $adi ?>" onkeypress="return onlyAlphabets(event)"
                                            name="adi">
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="soyadi" class="form-label">Soyadı</label>
                                        <input type="text" class="form-control" value="<?= $soyadi ?>"
                                            onkeypress="return onlyAlphabets2(event)" name="soyadi">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tcNo" class="form-label">TC No</label>
                                        <input type="text" class="form-control" value="<?= $tc_no ?>" onkeypress="return isNumber(event)"
                                            name="tcNo">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="telNo" class="form-label">Telefon No</label>
                                        <input type="text" class="form-control" value="<?= $tel_no ?>" onkeypress="return isNumber(event)"
                                            name="telNo">
                                    </div>
                                </div>


                                <div class="row g-2 mb-4">

                                    <div class="col-md-6">
                                        <label for="adres" class="form-label">Adres</label>
                                        <textarea class="form-control" name="adres" rows="3"><?= $adres ?></textarea>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="eMail" class="form-label">E-Mail</label>
                                        <input type="email" class="form-control" value="<?= $email ?>" name="email">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dogumTarihi" class="form-label">Doğum Tarihi</label>
                                        <input type="date" class="form-control" value="<?= $dogum ?>" name="dogumTarihi">
                                    </div>
                                </div>

                                <div class="row g-2 mb-4">


                                    <div class="col-md-3">
                                        <label for="kullaniciTipi" class="form-label">Kullanıcı Tipi</label>
                                        <select class="js-example-basic-single" name="kullaniciTipi" id="k_tipi" value="<?= $k_tipi ?>"
                                            aria-label="Kullanıcı Tipi">
                                            <option value="3">Personel</option>
                                            <option value="2">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="cinsiyet" class="form-label">Cinsiyet</label>
                                        <select class="js-example-basic-single" name="cinsiyet" aria-label="Cinsiyet">
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
                                <div class="col-md-6">
                                        <label for="ulke" class="form-label">Ülke</label>
                                        <select class="js-example-basic-single" name="ulke" aria-label="Ülke">
                                        <?= select_box_lister(2); ?>
                                            <!-- Diğer ülke seçenekleri -->
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="sehir" class="form-label">Şehir</label>
                                        <select class="js-example-basic-single" name="sehir" aria-label="Şehir">
                                            <?= select_box_lister(1); ?>
                                            <!-- Diğer şehir seçenekleri -->
                                        </select>
                                    </div>
                                </div>

                                <div class="row g-2 mb-4">
                                    <div class="col-md-6">
                                        <label for="plaka" class="form-label">Plaka</label>
                                        <input type="text" class="form-control" value="<?= $plaka ?>" name="plakam">
                                    </div>
                                </div>

                                <div class="row g-2 md-4">
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" value="<?= $k_adi ?>" name="kullaniciAdi">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="hidden" class="form-control" value="<?= $k_sifre ?>" name="sifre">
                                    </div>
                                </div>


                                <div class="row g-2 md-4">
                                    <div class="col-md-1 mt-4">
                                        <button type="submit" class="btn btn-primary">Düzenle</button>
                                    </div>
                                    <div class="col-md-1 mt-4 ml-3">
                                        <a type="button" class="btn btn-danger"
                                            href="p_management.php">İptal</a>
                                    </div>
                                </div>

                            </form>
                        </div>


                        <div class="mb-4 mx-3"></div>
                    </div>



                    <!-- DataTales Example -->


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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




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
            var charCode = event.which ? event.which : event.keyCode;
            if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122)) {
                return false;
            }
            return true;
        }
        function select_box(element_id , e_value)
        {
            var secim = document.getElementById(element_id);
            secim.value = e_value;
        }
    </script>



    <?php

        echo "<script>select_box("."'k_tipi',"."'$k_tipi'".");</script>";
        echo "<script>select_box("."'sehir',"."'$sehir'".");</script>";
        echo "<script>select_box("."'uyruk',"."'$uyruk'".");</script>";
        echo "<script>select_box("."'ulke',"."'$ulke'".");</script>";
        echo "<script>select_box("."'cinsiyet',"."'$cinsiyet'".");</script>";

    ?>

</body>

</html>