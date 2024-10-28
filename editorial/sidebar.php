<style type="text/css">
    .si-text-success{
        color : #2ec4b6;
    }
    .si-text-danger{
        color : #e71d36;
    }
    .si-text-primary{
        color : #0077b6;
    }
    .si-text-warning{
        color : #fb5607;
    }
    .si-text-pink{
        color : #ff006e;
    }
    .si-text-info{
        color : #00b4d8;
    }
</style>
<!-- Start Sidemenu Area -->
        <div class="sidemenu-area">
            <div class="sidemenu-header">
                <a href="dashboard.php" class="navbar-brand d-flex align-items-center">
                    <img src="../images/masu_logo.jpg" alt="image" height="50" width="50">
                    <span>MASU</span>
                </a>                
            </div>
            <div class="sidemenu-body">
                <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/Ndw58ApP0hguIKpvVYsvTjdnv|1oMf2Drqj57h9IQOd4pB0sRlQ|Rm7MhJUq5QQwioxEOc4QtcPQe/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='bx bxs-pencil'></i></span>
                            <span class="menu-title">New Submissions</span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'submit-paper')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="submit-paper.php" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-florist"></i></span>
                                    <span class="menu-title">Submit New Manuscripts</span>
                                </a>
                            </li>
                            <?php
                                $active = (empty($_GET['position'])) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-florist"></i></span>
                                    <span class="menu-title">Recent Submitted</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'Ndw58ApP0hguIKpvVYsvTjdnv')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=Ndw58ApP0hguIKpvVYsvTjdnv" class="nav-link">
                                    <span class="icon"><i class="si-text-primary bx bxs-zoom-in"></i></span>
                                    <span class="menu-title">Under QC</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'1oMf2Drqj57h9IQOd4pB0sRlQ')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=1oMf2Drqj57h9IQOd4pB0sRlQ" class="nav-link">
                                    <span class="icon"><i class="si-text-info bx bx-show-alt"></i></span>
                                    <span class="menu-title">Under Review</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'Rm7MhJUq5QQwioxEOc4QtcPQe')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=Rm7MhJUq5QQwioxEOc4QtcPQe" class="nav-link">
                                    <span class="icon"><i class="si-text-pink bx bx-edit"></i></span>
                                    <span class="menu-title">Need Corrections</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/iqXgWHco161uPaBWIpiGB7WwH|C6wz9n9rN0NktshxesPS1rPhz/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='bx bx-rotate-right'></i></span>
                            <span class="menu-title">Revisions</span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'iqXgWHco161uPaBWIpiGB7WwH')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=iqXgWHco161uPaBWIpiGB7WwH" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-info-circle"></i></span>
                                    <span class="menu-title">Need Revision</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'C6wz9n9rN0NktshxesPS1rPhz')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=C6wz9n9rN0NktshxesPS1rPhz" class="nav-link">
                                    <span class="icon"><i class="si-text-primary bx bx-show-alt"></i></span>
                                    <span class="menu-title">Under Re-review</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/5DGHF8rsGowUJMZrWQbi1uTyd|9rN0nWSsyBdlMUoamDqR9mVMH|8k9zJLWMRNriRZLHgut46fnqe/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='bx bxs-check-square'></i></span>
                            <span class="menu-title">Completed</span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'5DGHF8rsGowUJMZrWQbi1uTyd')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=5DGHF8rsGowUJMZrWQbi1uTyd" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-flag-checkered"></i></span>
                                    <span class="menu-title">Published</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'9rN0nWSsyBdlMUoamDqR9mVMH')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=9rN0nWSsyBdlMUoamDqR9mVMH" class="nav-link">
                                    <span class="icon"><i class="si-text-pink bx bx-x-circle"></i></span>
                                    <span class="menu-title">Withdrawn</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'8k9zJLWMRNriRZLHgut46fnqe')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="dashboard.php?position=8k9zJLWMRNriRZLHgut46fnqe" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-x-circle"></i></span>
                                    <span class="menu-title">Rejected</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'chat')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="chat.php" class="nav-link">
                            <span class="icon"><i class='bx bxs-chat'></i></span>
                            <span class="menu-title">Comments</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'profile')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="profile.php" class="nav-link">
                            <span class="icon"><i class="bx bx-user-circle"></i></span>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>