<!-- Start Sidemenu Area -->
        <div class="sidemenu-area">
            <div class="sidemenu-header">
                <a href="dashboard-analytics.html" class="navbar-brand d-flex align-items-center">
                    <img src="../images/masu_logo.jpg" alt="image" height="50" width="50">
                    <span>MASU</span>
                </a>
            </div>
            <div class="sidemenu-body">
                <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'press-publish-article')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="press-publish-article..php" class="nav-link">
                            <span class="icon"><i class='bx bx-home-circle'></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    
                      </ul>
            </div>
        </div>