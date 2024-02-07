<?php
function navbar($header,$username)
{
    echo '  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    
    <!-- Topbar Search -->
    <div class="d-sm-flex align-items-center ">
        <h1 class="h3 mb-0 text-gray-800">'.$header.'</h1>
        
    </div>
    
    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
    
    <div class="d-sm-flex align-items-center ">
      
    </div>
    
        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        
    
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
    
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                
            </div>
        </li>
    
    
    
        <div class="topbar-divider d-none d-sm-block"></div>
    
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">'.$username.'</span>
                <img class="img-profile rounded-circle"
                    src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">

                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Çıkış Yap
                </a>
            </div>
        </li>
    
    </ul>
    
    </nav>';
    
}


/*                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>
                <div class="dropdown-divider"></div>*/
?>