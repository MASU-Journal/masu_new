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
                    $active = (strpos($_SERVER['REQUEST_URI'],'editor-dashboard')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="editor-dashboard.php" class="nav-link">
                            <span class="icon"><i class='bx bx-home-circle'></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'e-all-articles')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="e-all-articles.php" class="nav-link">
                            <span class="icon"><i class="bx bx-receipt"></i></span>
                            <span class="menu-title">All Articles</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'chat')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="chat-editor.php" class="nav-link">
                            <span class="icon"><i class="bx bx-receipt"></i></span>
                            <span class="menu-title">Comments</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'e-upload-ceditor')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="e-upload-ceditor.php" class="nav-link">
                            <span class="icon"><i class="bx bx-receipt"></i></span>
                            <span class="menu-title">Comments to Chief Editor</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'publish-journal')) ? 'mm-active' : '';
                    ?>
                    <!-- <li class="nav-item <?php echo $active; ?>">
                        <a href="publish-journal.php" class="nav-link">
                            <span class="icon"><i class='bx bxs-florist'></i></span>
                            <span class="menu-title">Publish Journal</span>
                        </a>
                    </li> -->
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'profile')) ? 'mm-active' : '';
                    ?>
                    <!-- <li class="nav-item <?php echo $active; ?>">
                        <a href="profile.php" class="nav-link">
                            <span class="icon"><i class="bx bx-user-circle"></i></span>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>