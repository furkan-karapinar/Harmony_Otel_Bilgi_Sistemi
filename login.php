<?php
include('./connection.php');
include("./settings.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hpass = md5($password);

    $login_result = login($email, $hpass);

    if ($login_result[0] != 0) {

        $post_data = ['yetki' => $login_result[0],'username' => $login_result[1],'id' => $login_result[2]];
        
        $query_string = http_build_query($post_data); 
        

        session_start();

        $_SESSION['yetki'] = $login_result[0];
        $_SESSION['username'] = $login_result[1];
        $_SESSION['id'] = $login_result[2];



        echo $login_result[0]." ".$login_result[1]." ".$login_result[2];
        if ($login_result[0] == 1) // Admin
        {  
            header("Location: index.php");
        }
        elseif ($login_result[0] == 2) // Personal
        {   
            header("Location: index.php");
        }
        exit;
    } else {;
        header('Location: login.php');
        exit;
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

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg" style="background-image: url('login.png'); background-size: 80%; background-position: center; width: 100%; height: 300px;"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Hoşgeldiniz</h1>
                                    </div>
                                    <form class="user" method="post" action="login.php">
    <div class="form-group">
        <input type="text" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Kullanıcı Adı">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Şifre">
    </div>
    <div class="form-group">
        <div class="custom-control custom-checkbox small">

        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">Giriş</button>
    <hr>
</form>

                                    <hr>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>

