<?php

include("./sidebar.php");
include("./navbar.php");
include("./footer.php");
require_once("./tables.php");
include("./logout.php");
include("./settings.php");

session_start();
$a = 0;
// Kullanıcının yetkili no , kullanıcı adı ve id numarasını alınır ve yetkili mi kontrol eder
if (isset($_SESSION['yetki']) && isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $yetki = $_SESSION['yetki'];
    $username = $_SESSION['username'];
    $password = $_SESSION['id'];
    $a = 1;

    if ($yetki != 1 && $yetki != 2) {
        $a = 0;
        $yetki = "";
        $username = "";
        $password = "";
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
$yap=0;
if (isset($_GET['id']) && isset($_GET['odeme'])) {
    $id_ = $_GET['id'];
    $odeme = $_GET['odeme'];
        if (m_cikis($id_,$odeme) == 1)
        {$yap = 1;}

    }






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



                    <!-- DataTales Example -->
                    <?php

                 
                        echo '                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kayıtlı Müşteriler Listesi</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                            <th>Telefon No</th>
                                            <th>Araç Plakası</th>
                                            <th>Oda No</th>
                                            <th>Özellikler</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Adı</th>
                                            <th>Soyadı</th>
                                            <th>Telefon No</th>
                                            <th>Araç Plakası</th>
                                            <th>Oda No</th>
                                            <th>Özellikler</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        ' . get_customer_data_from_database_for_pay(0) . '
                                    </tbody>
                                </table>
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

                    //window.location.href = 'm_guncelle.php';
                }
            });
        }
    </script>


    <?php

 if ($yap == 1)
 {
    echo "<script>bip('Başarılı','Çıkış İşlemi Başarılı','success');</script>";
 }



    ?>

</body>

</html>