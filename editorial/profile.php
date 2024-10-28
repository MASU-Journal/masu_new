<?php
include_once('header.php');
$user_data = $db->query("SELECT user_id, user_instutename, user_email, user_contact, user_address, created_date, specialization FROM tbl_user WHERE user_id = '".$_SESSION['user_id']."' AND is_deleted = '0'");
// pre($user_data,1);
?>
<!-- Start Profile Area -->
            <section class="profile-area">
                <div class="profile-header mb-30">
                    <div class="user-profile-images">
                        <img src="assets/img/profile-banner.png" class="cover-image" alt="image">

                        <!-- <div class="upload-cover-photo">
                            <a href="#"><i class='bx bx-camera'></i> <span>Update Cover Photo</span></a>
                        </div> -->

                        <div class="profile-image">
                            <img src="assets/img/user.png" alt="image">

                            <!-- <div class="upload-profile-photo">
                                <a href="#"><i class='bx bx-camera'></i> <span>Update</span></a>
                            </div> -->
                        </div>

                        <div class="user-profile-text">
                            <h3><?php echo ucwords($user_data->row->user_instutename); ?></h3>
                            <span class="d-block">Author</span>
                        </div>
                    </div>

                    <div class="user-profile-nav">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="about-tab" data-toggle="tab" href="#about" role="tab" aria-controls="about" aria-selected="true">My Info</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Edit My Info</a>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card user-info-box mb-30">
                                            <div class="card-header d-flex justify-content-between align-items-center">
                                                <h3>Info</h3>
                                            </div>                            
                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-flex">
                                                        <i class="bx bx-briefcase mr-2"></i>
                                                        <span class="d-inline-block">Full Name : <a href="#" class="d-inline-block"><?php echo ucwords($user_data->row->user_instutename); ?></a></span>
                                                    </li>
                                                    <li class="d-flex">
                                                        <i class="bx bx-briefcase mr-2"></i>
                                                        <span class="d-inline-block">Specialization : <a href="#" class="d-inline-block"><?php echo $user_data->row->specialization; ?></a></span>
                                                    </li>
                                                    <!-- <li class="d-flex">
                                                        <i class='bx bxs-graduation mr-2'></i>
                                                        <span class="d-inline-block">Email ID<a href="#" class="d-inline-block">ABC University</a></span>
                                                    </li>
                                                    <li class="d-flex">
                                                        <i class='bx bxs-graduation mr-2'></i>
                                                        <span class="d-inline-block">Went to <a href="#" class="d-inline-block">Government High School, USA</a></span>
                                                    </li> -->
                                                    <!-- <li class="d-flex">
                                                        <i class='bx bx-home-circle mr-2'></i>
                                                        <span class="d-inline-block">Lives in <a href="#" class="d-inline-block">USA</a></span>
                                                    </li> -->
                                                    <li class="d-flex">
                                                        <i class='bx bx-map mr-2'></i>
                                                        <span class="d-inline-block">From : <a href="#" class="d-inline-block"><?php echo $user_data->row->user_address; ?></a></span>
                                                    </li>
                                                    <!-- <li class="d-flex">
                                                        <i class='bx bx-wifi mr-2'></i>
                                                        <span class="d-inline-block">Followed by <a href="#" class="d-inline-block">111 people</a></span>
                                                    </li> -->
                                                    <li class="d-flex">
                                                        <i class='bx bx-phone mr-2'></i>
                                                        <span class="d-inline-block">Phone : <a href="#" class="d-inline-block"><?php echo $user_data->row->user_contact; ?></a></span>
                                                    </li>
                                                    <li class="d-flex">
                                                        <i class='bx bx-envelope mr-2'></i>
                                                        <span class="d-inline-block">Email : <a href="#" class="d-inline-block"><?php echo $user_data->row->user_email; ?></a></span>
                                                    </li>
                                                    <li class="d-flex">
                                                        <i class='bx bx-calendar mr-2'></i>
                                                        <span class="d-inline-block">Joined : <a href="#" class="d-inline-block"><?php echo $user_data->row->created_date; ?></a></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="card user-settings-box mb-30">
                                    <div class="card-body">
                                        <form>
                                            <h3><i class='bx bx-user-circle'></i> Personal Info</h3>
        
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter first name">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter last name">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Job</label>
                                                        <input type="text" class="form-control" placeholder="Enter job name">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Bio</label>
                                                        <textarea cols="30" rows="5" placeholder="Write something..." class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Joined Date</label>
                                                        <input type="text" class="form-control" placeholder="dd/mm/yy">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Date of Birth</label>
                                                        <input type="text" class="form-control" placeholder="dd/mm/yy">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Enter email address">
                                                        <span class="form-text text-muted d-block">
                                                            <small>If you want to change email please <a href="#" class="d-inline-block">click</a> here.</small>
                                                        </span>
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control" placeholder="Enter phone number">
                                                        <span class="form-text text-muted d-block">
                                                            <small>If you want to change phone number please <a href="#" class="d-inline-block">click</a> here.</small>
                                                        </span>
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input type="password" class="form-control" placeholder="Enter password">
                                                        <span class="form-text text-muted d-block">
                                                            <small>If you want to change password please <a href="#" class="d-inline-block">click</a> here.</small>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3><i class='bx bx-building'></i> Company Info</h3>
        
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <input type="text" class="form-control" placeholder="Enter company name">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <input type="text" class="form-control" placeholder="Enter website url">
                                                    </div>
                                                </div>
                                            </div>

                                            <h3><i class='bx bx-world'></i> Social</h3>
        
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" class="form-control" placeholder="Enter facebook url">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <input type="text" class="form-control" placeholder="Enter twitter url">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Instagram</label>
                                                        <input type="text" class="form-control" placeholder="Enter instagram url">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Linkedin</label>
                                                        <input type="text" class="form-control" placeholder="Enter linkedin url">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Pinterest</label>
                                                        <input type="text" class="form-control" placeholder="Enter pinterest url">
                                                    </div>
                                                </div>
        
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Stack Overflow</label>
                                                        <input type="text" class="form-control" placeholder="Enter stack overflow url">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="btn-box text-right">
                                                <button type="submit" class="submit-btn"><i class='bx bx-save'></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-lg-3">
                        <div class="card user-trends-box mb-30">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>Trends for you</h3>
            
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class='bx bx-dots-horizontal-rounded' ></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class='bx bx-show'></i> View
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class='bx bx-edit-alt'></i> Edit
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class='bx bx-trash'></i> Delete
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class='bx bx-printer'></i> Print
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class='bx bx-download'></i> Download
                                        </a>
                                    </div>
                                </div>
                            </div>
            
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#">
                                            Trending in New York
                                            <span>#WordPress</span>
                                            1.16M Tweets
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Trending in USA
                                            <span>#DigitalMarketing</span>
                                            10.29M Tweets
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Trending in Canada
                                            <span>#Coding</span>
                                            15.54M Tweets
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> -->
                </div>
            </section>
            <!-- End Profile Area -->
            <!-- Vendors Min JS -->
        <script src="assets/js/vendors.min.js"></script>
<?php
include_once('footer.php');
?>