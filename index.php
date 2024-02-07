<?php
//include("./variables.php");
include("./sidebar.php");
include("./navbar.php");
include("./footer.php");
include("./charts.php");
include("./logout.php");
include("./settings.php");




session_start();

 // Kullanıcının yetkili no , kullanıcı adı ve id numarasını alınır ve yetkili mi kontrol eder
if (isset($_SESSION['yetki']) && isset($_SESSION['username']) && isset($_SESSION['id'])) {
    $yetki = $_SESSION['yetki'];
    $username = $_SESSION['username'];
    $password = $_SESSION['id'];


    if ($yetki != 1 && $yetki !=2)
    {
        $yetki = "";
        $username = "";
        $password = "";
        session_destroy();
        header("location: login.php");
        exit;
    }


    if ($yetki == 2)
    {
      header("location: m_management.php");
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
              <?= navbar('Gösterge Paneli',$username); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Bu Ayın Toplam Kazancı</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= get_month_earning()." TL"; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Bu Yılın Toplam Kazancı</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= get_yearly_earning()." TL"; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Boş Oda Sayısı</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= get_empty_room_count(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Dolu Oda Sayısı</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= get_full_room_count(); ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Raporlar</h6>
                                    
                                </div>
                                <!-- Card Body -->
                               
                                
                                
                                <div class="row">
                                    <!-- İlk kart -->
                                    
                                    <div class="card-body col-lg-5">
                                        <div class="card shadow">
                                            <h5 class="m-0 font-weight-bold text-center text-primary mt-3 mb-3">Sezonlara Göre Müşteri Yoğunluğu</h5>
                                            <div class="mb-4 mx-3" id="pie_chart" style="height: 400%"></div>
                                        </div>
                                    </div>

                                    <!-- İkinci kart -->
                                    <!--   başka grafik   -->
                                    <div class="card-body">
                                        <div class="card shadow">
                                        <h5 class="m-0 font-weight-bold text-center text-primary mt-3 mb-3">Bu Ayın Müşteri Ülke Dağılımı</h5>
                                            <div class="mb-4 mx-3" id="ulke_chart" style="height: 400%"></div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                                                        <!-- İkinci kart -->
                                                                        <div class="card-body">
                                        <div class="card shadow">
                                        <h5 class="m-0 font-weight-bold text-center text-primary mt-3 mb-3">Aylık Tercih Edilen Oda Tipleri</h5>
                                            <div class="mb-4 mx-3" id="chart" style="height: 400%"></div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>


                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bu Ayki Müşterilerin Ödeme Tipi Tercihi</h6>
                                </div>
                                <div class="card-body">
                                <div class="mb-2 mx-1" id="pie_chart3" style="height: 300%"></div>
                                </div>
                            </div>

                            <!-- Color System -->
                            

                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Bu Ayın Müşteri Cinsiyet Oranı</h6>
                                </div>
                                <div class="card-body">

                                <div class="mb-2 mx-1" id="pie_chart2" style="height: 300%"></div>
                                    <div class="text-left">
                                   
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                    </div>

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
      <?= logout("index.php",$yetki); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script src="vendor/chart.js/Chart.js"></script>


    <script type="text/javascript" src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
    <script type="text/javascript">
    var dom = document.getElementById('pie_chart');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  title: {
    text: '',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Rezervasyon',
      type: 'pie',
      radius: '50%',
      data: [<?php echo $csayilar ?>],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>


<script type="text/javascript">
    var dom = document.getElementById('pie_chart2');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  title: {
    text: '',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Cinsiyet',
      type: 'pie',
      radius: '50%',
      data: [<?= get_gender_list(); ?>],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>


<script type="text/javascript">
    var dom = document.getElementById('pie_chart3');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  title: {
    text: '',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Yüzde',
      type: 'pie',
      radius: '50%',
      data: [<?= get_cash_type_list(); ?>],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>

<script type="text/javascript">
    var dom = document.getElementById('chart');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  title: {
    text: ''
  },
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross',
      label: {
        backgroundColor: '#6a7985'
      }
    }
  },
  legend: {
    data: [ <?= get_room_types(); ?> ] //['Standart', 'Union Ads', 'Video Ads', 'Direct', 'Search Engine']
  },
  toolbox: {
    feature: {
      saveAsImage: {}
    }
  },
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: [
    {
      type: 'category',
      boundaryGap: false,
      data: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs','Haziran','Temmuz', 'Ağustos', 'Eylül','Ekim','Kasım','Aralık']
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    {
      name: <?= get_room_type(0) ?>,
      type: 'line',
      stack: 'Total',
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,0); ?>,<?= get_room_type_value(2,0); ?>,<?= get_room_type_value(3,0); ?>,<?= get_room_type_value(4,0); ?>,
      <?= get_room_type_value(5,0); ?>,<?= get_room_type_value(6,0); ?>,<?= get_room_type_value(7,0); ?>,<?= get_room_type_value(8,0); ?>,
      <?= get_room_type_value(9,0); ?>,<?= get_room_type_value(10,0); ?>,<?= get_room_type_value(11,0); ?>,<?= get_room_type_value(12,0); ?>]
    },
    {
      name: <?= get_room_type(1) ?>,
      type: 'line',
      stack: 'Total',
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,1); ?>,<?= get_room_type_value(2,1); ?>,<?= get_room_type_value(3,1); ?>,<?= get_room_type_value(4,1); ?>,
      <?= get_room_type_value(5,1); ?>,<?= get_room_type_value(6,1); ?>,<?= get_room_type_value(7,1); ?>,<?= get_room_type_value(8,1); ?>,
      <?= get_room_type_value(9,1); ?>,<?= get_room_type_value(10,1); ?>,<?= get_room_type_value(11,1); ?>,<?= get_room_type_value(12,1); ?>]
    },
    {
      name: <?= get_room_type(2) ?>,
      type: 'line',
      stack: 'Total',
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,2); ?>,<?= get_room_type_value(2,2); ?>,<?= get_room_type_value(3,2); ?>,<?= get_room_type_value(4,2); ?>,
      <?= get_room_type_value(5,2); ?>,<?= get_room_type_value(6,2); ?>,<?= get_room_type_value(7,2); ?>,<?= get_room_type_value(8,2); ?>,
      <?= get_room_type_value(9,2); ?>,<?= get_room_type_value(10,2); ?>,<?= get_room_type_value(11,2); ?>,<?= get_room_type_value(12,2); ?>]
    },
    {
      name: <?= get_room_type(3) ?>,
      type: 'line',
      stack: 'Total',
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,3); ?>,<?= get_room_type_value(2,3); ?>,<?= get_room_type_value(3,3); ?>,<?= get_room_type_value(4,3); ?>,
      <?= get_room_type_value(5,3); ?>,<?= get_room_type_value(6,3); ?>,<?= get_room_type_value(7,3); ?>,<?= get_room_type_value(8,3); ?>,
      <?= get_room_type_value(9,3); ?>,<?= get_room_type_value(10,3); ?>,<?= get_room_type_value(11,3); ?>,<?= get_room_type_value(12,3); ?>]
    },
    {
      name: <?= get_room_type(4) ?>,
      type: 'line',
      stack: 'Total',
      label: {
        show: true,
        position: 'top'
      },
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,4); ?>,<?= get_room_type_value(2,4); ?>,<?= get_room_type_value(3,4); ?>,<?= get_room_type_value(4,4); ?>,
      <?= get_room_type_value(5,4); ?>,<?= get_room_type_value(6,4); ?>,<?= get_room_type_value(7,4); ?>,<?= get_room_type_value(8,4); ?>,
      <?= get_room_type_value(9,4); ?>,<?= get_room_type_value(10,4); ?>,<?= get_room_type_value(11,4); ?>,<?= get_room_type_value(12,4); ?>]
    }
    ,
    {
      name: <?= get_room_type(5) ?>,
      type: 'line',
      stack: 'Total',
      label: {
        show: true,
        position: 'top'
      },
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,5); ?>,<?= get_room_type_value(2,5); ?>,<?= get_room_type_value(3,5); ?>,<?= get_room_type_value(4,5); ?>,
      <?= get_room_type_value(5,5); ?>,<?= get_room_type_value(6,5); ?>,<?= get_room_type_value(7,5); ?>,<?= get_room_type_value(8,5); ?>,
      <?= get_room_type_value(9,5); ?>,<?= get_room_type_value(10,5); ?>,<?= get_room_type_value(11,5); ?>,<?= get_room_type_value(12,5); ?>]
    },
    {
      name: <?= get_room_type(6) ?>,
      type: 'line',
      stack: 'Total',
      label: {
        show: true,
        position: 'top'
      },
      areaStyle: {},
      emphasis: {
        focus: 'series'
      },
      data: [<?= get_room_type_value(1,6); ?>,<?= get_room_type_value(2,6); ?>,<?= get_room_type_value(3,6); ?>,<?= get_room_type_value(4,6); ?>,
      <?= get_room_type_value(5,6); ?>,<?= get_room_type_value(6,6); ?>,<?= get_room_type_value(7,6); ?>,<?= get_room_type_value(8,6); ?>,
      <?= get_room_type_value(9,6); ?>,<?= get_room_type_value(10,6); ?>,<?= get_room_type_value(11,6); ?>,<?= get_room_type_value(12,6); ?>]
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>

<script type="text/javascript">
    var dom = document.getElementById('ulke_chart');
    var myChart = echarts.init(dom, null, {
      renderer: 'canvas',
      useDirtyRect: false
    });
    var app = {};
    
    var option;

    option = {
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    }
  },
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: [
    {
      type: 'category',
      data: [<?= "'".get_country_from_customer(0,0)."'"; ?>, <?= "'".get_country_from_customer(1,0)."'"; ?>, <?= "'".get_country_from_customer(2,0)."'"; ?>, <?= "'".get_country_from_customer(3,0)."'"; ?>, <?= "'".get_country_from_customer(4,0)."'"; ?>],
      axisTick: {
        alignWithLabel: true
      }
    }
  ],
  yAxis: [
    {
      type: 'value'
    }
  ],
  series: [
    {
      name: 'Sayı',
      type: 'bar',
      barWidth: '60%',
      data: [<?= get_country_from_customer(0,1); ?>, <?= "'".get_country_from_customer(1,1)."'"; ?>,<?= "'".get_country_from_customer(2,1)."'"; ?>, <?= "'".get_country_from_customer(3,1)."'"; ?>, <?= "'".get_country_from_customer(4,1)."'"; ?>]
    }
  ]
};

    if (option && typeof option === 'object') {
      myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
  </script>


    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>




</body>

</html>