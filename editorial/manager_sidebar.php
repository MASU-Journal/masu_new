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
                <a href="dashboard-analytics.html" class="navbar-brand d-flex align-items-center">
                    <img src="../images/masu_logo.jpg" alt="image" height="50" width="50">
                    <span>MASU</span>
                </a>
            </div>
            <div class="sidemenu-body">
                <ul class="sidemenu-nav metisMenu h-100" id="sidemenu-nav" data-simplebar>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'manager')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="manager.php" class="nav-link">
                            <span class="icon"><i class='si-text-primary bx bx-home-circle'></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/pending_journals|m-sent-back-to-author|m-sent-to-chief|m-under-review/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='si-text-success bx bxs-pencil'></i></span>
                            <span class="menu-title"><strong>New Submissions</strong></span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'pending_journals')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="pending_journals.php" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-florist"></i></span>
                                    <span class="menu-title">New Manuscripts</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-sent-back-to-author')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-sent-back-to-author.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-arrow-from-right"></i></span>
                                    <span class="menu-title">Sent back to Author</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-sent-to-chief')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-sent-to-chief.php" class="nav-link">
                                    <span class="icon"><i class="si-text-info bx bx-show-alt"></i></span>
                                    <span class="menu-title">Sent to Chief</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-under-review')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-under-review.php" class="nav-link">
                                    <span class="icon"><i class="si-text-pink bx bx-edit"></i></span>
                                    <span class="menu-title">Under Review</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/m-need-revision|m-under-re-review/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='si-text-danger bx bx-rotate-right'></i></span>
                            <span class="menu-title"><strong>Revisions</strong></span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-need-revision')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-need-revision.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-info-circle"></i></span>
                                    <span class="menu-title">Revised Manuscripts</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-revised-sent-to-chief.php')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-revised-sent-to-chief.php" class="nav-link">
                                    <span class="icon"><i class="si-text-info bx bx-show-alt"></i></span>
                                    <span class="menu-title">Sent to Chief</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-under-re-review')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-under-re-review.php" class="nav-link">
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
                        if (preg_match('/m_published_journals|m-final-reject|m-withdrawn/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">                    
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded;?>">
                            <span class="icon"><i class='si-text-primary bx bxs-check-square'></i></span>
                            <span class="menu-title"><strong>Completed</strong></span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                            $active = (strpos($_SERVER['REQUEST_URI'],'m_published_journals')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m_published_journals.php" class="nav-link">
                                    <span class="icon"><i class='si-text-success bx bxs-check-shield'></i></span>
                                    <span class="menu-title">Published List</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-withdrawn')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-withdrawn.php" class="nav-link">
                                    <span class="icon"><i class="si-text-pink bx bx-x-circle"></i></span>
                                    <span class="menu-title">Withdrawn</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'m-final-reject')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="m-final-reject.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-x-circle"></i></span>
                                    <span class="menu-title">Rejected</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'publish-journal')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="publish-journal.php" class="nav-link">
                            <span class="icon"><i class='si-text-success bx bx-wifi'></i></span>
                            <span class="menu-title">Publish Article</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'excel-publish')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="excel-publish.php" class="nav-link">
                            <span class="icon"><i class='si-text-danger bx bxs-layer-plus'></i></span>
                            <span class="menu-title">Archive</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'add_editors')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="add_editors.php" class="nav-link">
                            <span class="icon"><i class='si-text-warning bx bxs-user-plus'></i></span>
                            <span class="menu-title">Add Editors/ Reviewers </span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'profile')) ? 'mm-active' : '';
                    ?>
                    <!-- <li class="nav-item <?php echo $active; ?>">
                        <a href="profile.php" class="nav-link">
                            <span class="icon"><i class="bx bx-user-circle"></i></span>
                            <span class="menu-title">My Profile</span>
                        </a>
                    </li> -->

                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'all-journals')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="m-all-journals.php" class="nav-link">
                            <span class="icon"><i class="si-text-pink bx bx-list-ol"></i></span>
                            <span class="menu-title">All Articles </span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'publication-documents')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="m-publication-documents.php" class="nav-link">
                            <span class="icon"><i class="si-text-pink bx bxs-layer-plus"></i></span>
                            <span class="menu-title">Publication Documents </span>
                        </a>
                    </li>
                     <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'home-flash-news')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="home-flash-news.php" class="nav-link">
                            <span class="icon"><i class="si-text-danger bx bxs-news"></i></span>
                            <span class="menu-title">Flash News </span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'news-event')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="news-event.php" class="nav-link">
                            <span class="icon"><i class="si-text-primary bx bx-news"></i></span>
                            <span class="menu-title">News & Event </span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'add_members')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="add_members.php" class="nav-link">
                            <span class="icon"><i class="si-text-primary bx bx-news"></i></span>
                            <span class="menu-title">Add Members</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'list-members')) ? 'mm-active' : '';
                    ?>
                     <li class="nav-item <?php echo $active; ?>">
                        <a href="list-members.php" class="nav-link">
                            <span class="icon"><i class="si-text-success bx bx-news"></i></span>
                            <span class="menu-title">List Members</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>