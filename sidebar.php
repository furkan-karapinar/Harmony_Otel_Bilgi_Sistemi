<?php

function sidebar($yetki)
{
 $a = "";
    if ($yetki == 1)
    {
        $a = '    <div class="sidebar-heading">Admin Paneli</div>
        <hr class="sidebar-divider">
    
        <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Gösterge Paneli</span></a>
    </li>
    
    <li class="nav-item">
    <a class="nav-link" href="p_management.php">
        <i class="fas fa-fw fa-cog"></i>
        <span>Personel Yönetimi</span></a>
    </li>
    <hr>
    ';
    }

    echo '        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <i class="fas"><img src="web_logo.png" style="background-position: center; width: 100%; height: 40px;"></i>
        <div class="sidebar-brand-text mx-3">Harmony Otel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    <hr>'.$a.'

<div class="sidebar-heading">Personel Paneli</div>
<hr class="sidebar-divider">

<li class="nav-item">
<a class="nav-link" href="m_management.php">
    <i class="fas fa-fw fa-cog"></i>
    <span>Oda Rezervasyonu</span></a>
</li>

<li class="nav-item">
<a class="nav-link" href="m_guncelle.php">
    <i class="fas fa-fw fa-cog"></i>
    <span>Rezervasyon Güncelle</span></a>
</li>

<li class="nav-item">
<a class="nav-link" href="otel_kayit.php">
    <i class="fas fa-fw fa-cog"></i>
    <span>Rezervasyon Çıkışı</span></a>
</li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    

   
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    

</ul>';
}

/*    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Gösterge Paneli</span></a>
    </li>*/


    /*    <li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#admin_panel"
    aria-expanded="true" aria-controls="admin_panel">
        <i class="fas fa-fw fa-cog"></i>
        <span>Admin Paneli</span></a>
        <div id="admin_panel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Admin Paneli</h6>
            <a class="collapse-item" href="index.php">Gösterge Paneli</a>
            <a class="collapse-item" href="p_management.php">Personel Yönetimi</a>
            <a class="collapse-item" href="m_management.php">Müşteri Yönetimi</a>
        </div>
    </div>
    </li> */

?>