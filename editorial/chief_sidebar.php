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
                        <a href="chief.php" class="nav-link">
                            <span class="icon"><i class='bx bxs-layout'></i></span>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/c-pending-journals|c-sent-back-to-author|c-under-qc|c-reviewer-requested|c-reviewer-declined/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded; ?>">
                            <span class="icon"><i class='bx bxs-pencil'></i></span>
                            <span class="menu-title">New Submission</span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-pending-journals')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-pending-journals.php" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-florist"></i></span>
                                    <span class="menu-title">New Manuscripts</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-sent-back-to-author')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-sent-back-to-author.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-log-out-circle"></i></span>
                                    <span class="menu-title">Sent back to Author</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-under-qc')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-under-qc.php" class="nav-link">
                                    <span class="icon"><i class="si-text-primary bx bxs-zoom-in"></i></span>
                                    <span class="menu-title">Under QC</span>
                                </a>
                            </li>
                            <?phpc-reviewer-requested
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-reviewer-requested.php" class="nav-link">
                                    <span class="icon"><i class="si-text-warning bx bxl-telegram"></i></span>
                                    <span class="menu-title">Reviewer Requested</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-under-review')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-under-review.php" class="nav-link">
                                    <span class="icon"><i class="si-text-info bx bx-show-alt"></i></span>
                                    <span class="menu-title">Under Review</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-reviewer-declined')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-reviewer-declined.php" class="nav-link">
                                    <span class="icon"><i class="bx bxs-low-vision"></i></span>
                                    <span class="menu-title">Reviewer Declined</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/c-reviewer-revised|c-revised-sent-back-to-author|c-resubmitted-journals|c-revised-reviewer-requested|c-under-re-review|c-revised-reviewer-declined/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded; ?>">
                            <span class="icon"><i class='bx bx-undo'></i></span>
                            <span class="menu-title">Revision</span>
                        </a>
                        <ul class="sidemenu-nav-second-level  <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-reviewer-revised')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-reviewer-revised.php" class="nav-link">
                                    <span class="icon"><i class="si-text-primary bx bxs-file-import"></i></span>
                                    <span class="menu-title">Revised by Reviewer</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-revised-sent-back-to-author')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">                              
                                <a href="c-revised-sent-back-to-author.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-arrow-from-right"></i></span>
                                    <span class="menu-title">Sent back to Author</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-resubmitted-journals')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-resubmitted-journals.php" class="nav-link">
                                    <span class="icon"><i class="si-text-success bx bxs-arrow-from-left"></i></span>
                                    <span class="menu-title">Resubmitted by Author</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-revised-reviewer-requested')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-revised-reviewer-requested.php" class="nav-link">
                                    <span class="icon"><i class="si-text-warning bx bxl-telegram"></i></span>
                                    <span class="menu-title">Reviewer Requested</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-under-re-review')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-under-re-review.php" class="nav-link">
                                    <span class="icon"><i class="si-text-info bx bx-show-alt"></i></span>
                                    <span class="menu-title">Re-Assigned</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-revised-reviewer-declined')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-revised-reviewer-declined.php" class="nav-link">
                                    <span class="icon"><i class="bx bxs-low-vision"></i></span>
                                    <span class="menu-title">Reviewer Declined</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                        $aria_expanded = 'false';
                        $active = '';
                        $ul_classes = '';
                        if (preg_match('/c-review-completed|c-chief-accepted|c-chief-rejected/i', $_SERVER['REQUEST_URI'])){
                            $aria_expanded = 'true';
                            $active = 'mm-active';
                            $ul_classes = 'mm-collapse mm-show';
                        }
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="#" class="collapsed-nav-link nav-link" aria-expanded="<?php echo $aria_expanded; ?>">
                            <span class="icon"><i class='bx bxs-check-circle'></i></span>
                            <span class="menu-title">Completed</span>
                        </a>
                        <ul class="sidemenu-nav-second-level <?php echo $ul_classes; ?>">
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-review-completed')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-review-completed.php" class="nav-link">
                                    <span class="icon"><i class="si-text-warning bx bx-check-circle"></i></span>
                                    <span class="menu-title">Review Completed</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-chief-accepted')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-chief-accepted.php" class="nav-link">
                                    <span class="icon">
                                        <i class="si-text-primary bx bxs-check-circle"></i>
                                    </span>
                                    <span class="menu-title">Accepted by Chief</span>
                                </a>
                            </li>
                            <?php
                                $active = (strpos($_SERVER['REQUEST_URI'],'c-chief-rejected')) ? 'mm-active' : '';
                            ?>
                            <li class="nav-item <?php echo $active; ?>">
                                <a href="c-chief-rejected.php" class="nav-link">
                                    <span class="icon"><i class="si-text-danger bx bxs-x-circle"></i></span>
                                    <span class="menu-title">Rejected by Chief</span>
                                </a>
                            </li>
                        </ul>
                    </li>                   
                    <!-- <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'specific-journals')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="c-specific-journals.php" class="nav-link">
                            <span class="icon"><i class="bx bx-receipt"></i></span>
                            <span class="menu-title">Specific Journals</span>
                        </a>
                    </li> -->
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'chat')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="chat-chief-editor.php" class="nav-link">
                            <span class="icon"><i class="bx bxs-chat"></i></span>
                            <span class="menu-title">Comments</span>
                        </a>
                    </li>
                    <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'all-journals')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="c-all-journals.php" class="nav-link">
                            <span class="icon"><i class="bx bx-list-check"></i></span>
                            <span class="menu-title">All Articles</span>
                        </a>
                    </li>
                     <?php
                    $active = (strpos($_SERVER['REQUEST_URI'],'c-view-reviewer-doc')) ? 'mm-active' : '';
                    ?>
                    <li class="nav-item <?php echo $active; ?>">
                        <a href="c-view-reviewer-doc.php" class="nav-link">
                            <span class="icon"><i class="bx bx bxs-receipt"></i></span>
                            <span class="menu-title">View Reviewer Document</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>