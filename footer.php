<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>footer</title>
</head>

<body>
   <section class="wed-hom-footer">
      <div class="container">
         <div class="row wed-foot-link-1">
            <div class="col-md-6 foot-tc-mar-t-o">
               <h4 style="padding-left:30%;font-size:18px;font-family: serif;">Get In Touch</h4>
               <div class="col-md-6 foot-tc-mar-t-o">
                  <p style="font-size:14px;color:#bdbdc1;">For MASU related issues : <br><span
                        style="text-align: center;color:#bdbdc1;margin-left:20%;"><b>PUBLISHER</b></span><br><b>SECRETARY</b><br>Madras
                     Agricultural Students Union<br>Tamil Nadu Agricultural University<br>Coimbatore - 641 003
                     <br />Tamil Nadu, India.
                  </p>
               </div>
               <div class="col-md-6 foot-tc-mar-t-o">
                  <p style="font-size:14px;color:#bdbdc1;">For MAJ related issues : <br><b>CHIEF EDITOR</b><br>Madras
                     Agricultural Students Union<br>Tamil Nadu Agricultural University<br>Coimbatore - 641 003
                     <br />Tamil Nadu, India.
                  </p>
               </div>
            </div>
            <div class="col-md-4">
               <a href="https://portal.issn.org/resource/ISSN/0024-9602" target="blank">
                  <h6 style="font-size:18px;font-family: serif;color:#bdbdc1;">ISSN : 0024-9602</h6>
               </a>
               <a href="https://portal.issn.org/resource/ISSN/2582-5321" target="blank" ;>
                  <h6 style="font-size:18px;font-family: serif;color:#bdbdc1;">eISSN : 2582-5321</h6>
               </a><br>
               <h4 style="font-size:18px;font-family: serif;">Contact Us</h4>
               <p style="font-size:14px;color:#bdbdc1;">Office: <a href="tel:918300947681"
                     style="font-size:14px;color:#bdbdc1;">0422-2966781</a><br>Mobile: +91 8300947681</p>
               <p style="font-size:14px;color:#bdbdc1;">Email: <a href="#!"
                     style="font-size:14px;color:#bdbdc1;">masutnau@gmail.com<br>masu@tnau.ac.in , maj@tnau.ac.in</a>
               </p>
            </div>
            <div class="col-md-2">

               <a rel="license" href="https://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License"
                     style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />This work
               is licensed under a <a rel="license" href="https://creativecommons.org/licenses/by/4.0/">Creative Commons
                  Attribution 4.0 International License</a>.


               <style>
                  tamil-socialmedia>a {
                     font-size: 20px;
                     color: white;
                  }

                  .tamil-socials {
                     padding: 15px;
                  }
               </style>

               <div class="tamil-socialmedia">
                  <h4 style="font-size:20px;font-family: serif;">Social Media</h4>
                  <a href="https://www.facebook.com/madrasagriculturaljournal.masu/" target="blank">
                     <div class="fa fa-facebook tamil-socials"></div>
                  </a>
                  <a href="https://www.linkedin.com/in/maj-madras-agricultural-journal-41b9a41b5/" target="blank">
                     <div class="fa fa-linkedin tamil-socials"></div>
                  </a>
                  <a href="https://twitter.com/JournalMadras" target="blank">
                     <div class="fa fa-twitter tamil-socials"></div>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- COPY RIGHTS -->
   <section class="wed-rights">
      <div class="container">
         <div class="column">
            <div class="copy-right">
               <p>Copyright @ 2023 Madras Agricultural Journal |<a href="http://masujournal.org/" target="_blank"
                     style="color:white;"><i> Masu Journal</i> </a> All right reserved.</p>
            </div>
         </div>
      </div>
   </section>
   <!--SECTION LOGIN, REGISTER AND FORGOT PASSWORD-->
   <section>
      <!-- LOGIN SECTION -->
      <div id="loginpopup" class="modal fade">
         <div class="log-in-pop" style="background: url('../images/slider/loginimg.jpg'); ">
            <div class="log-in-pop-right">
               <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
               </a>
               <h4 style="text-align:center;">Login</h4>
               <div class="row">
                  <div class="col-12 alert-box">
                     <p id="alert-content"></p>
                  </div>
               </div>
               <img src="images/logo.png" alt="" style="margin-left: 63px;width: 156px;" />
               <form id="loginform">
                  <div>
                     <div class="input-field s12">
                        <input type="email" data-ng-model="name1" id="ins_username" name="lname" class="validate"
                           required>
                        <label>Email</label>
                     </div>
                  </div>
                  <div>
                     <div class="input-field s12">
                        <input type="password" class="validate" name="lpass" id="ins_pass">
                        <label>Password</label>
                     </div>
                  </div>
                  <div>
                     <div class="input-field s4">
                        <button type="button" class="waves-effect waves-light log-in-btn" name="lsub"
                           id="btn_submit">Login</button>
                     </div>
                  </div>
                  <div>
                     <a href="javascript:void(0)" id="adminloginopener" data-toggle="modal"
                        data-target="#adminloginpopup">Admin Sign In</a> &nbsp&nbsp
                     <a href="javascript:void(0)" id="#" data-toggle="modal" data-target="#forgot_pass">Forgot
                        Password</a>
                     <div class="input-field s12"> <a class='login_closer' href="#" data-dismiss="modal"
                           data-toggle="modal" data-target="#editboar" aria-label="close">New User Register ? Signup</a>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!------editorial board----------------->
      <div id="editboar" class="modal fade">
         <div class="modal-dialog modal-lg">
            <div class="log-in-pop" style="width: 90%;">
               <div class="log-in-pop-right">
                  <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
                  </a>
                  <h5 style="text-align:center;">Life/Annuals Members</h5>
                  <img src="images/logo.png" alt="" style="margin-left: 63px;width: 156px;" /><br>
                  <form id="loginform">
                     <div class="row">
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>FullName</b></label>
                           <div class="input-field s6" style="margin-top:0rem;">
                              <input type="text" data-ng-model="name1" id="lfname" name="lfname" class="validate"
                                 placeholder="fullname" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Email Id</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <input type="email" data-ng-model="name1" id="lfemail" name="lfemail" class="validate"
                                 placeholder="Email Id" required>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Contact No</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <input type="text" data-ng-model="name1" id="lfphone" name="lfphone" class="validate"
                                 placeholder="Phone No" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Specialization</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <input type="text" data-ng-model="name1" id="lfcommunication" name="lfcommunication"
                                 placeholder="Specialization" class="validate" required>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Password</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <input type="password" class="validate" name="lfpass" placeholder="Password" id="lfpass">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Confirm Password</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <input type="password" class="validate" name="lfconpass" placeholder="Confirm Password"
                                 id="lfconpass">
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Address For Communication</b></label>
                           <div class="input-field s12" style="margin-top:0rem;">
                              <textarea rows="4" cols="6" type="text" data-ng-model="name1" id="lfaddress"
                                 name="lfaddress" class="validate" placeholder="Address" required></textarea>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <label style="font-size:15px"><b>Select Membership</b></label>
                           <select name="Life/Annul Member" id="lfannual" class="input-control">
                              <option value="" selected="">Selects</option>
                              <option value="non_number" selected="">Non Member </option>
                              <option value="institute_member" selected="">Institute Member</option>
                              <option value="Life" selected="">Life Member</option>
                              <option value="Annual" selected="">Annual Member</option>
                           </select>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="input-field s4">
                           <button type="button" class="waves-effect waves-light log-in-btn" name="lsub"
                              id="lfsubmit">Sign Up</button>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="input-field s12"> <a class='login_closer' href="#" data-dismiss="modal"
                              data-toggle="modal" data-target="#loginpopup" aria-label="close">Are you a already member
                              ? Login</a> </div>
                     </div>
               </div>

               </form>
            </div>
         </div>
      </div>
      <!---end editorial board---------------------->
      <!---end student board---------------------->
      <div id="adminloginpopup" class="modal fade">
         <div class="log-in-pop">
            <div class="log-in-pop-right">
               <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
               </a>
               <h5 style="text-align:center;">Admin Login</h5>
               <img src="images/logo.png" alt="" style="margin-left: 63px;width: 156px;" />
               <form id="adminloginform">
                  <div>
                     <div class="input-field s12">
                        <input type="text" data-ng-model="name1" id="adminname" name="adminname" class="validate"
                           required>
                        <label>User name</label>
                     </div>
                  </div>
                  <input type="hidden" data-ng-model="adminlogin" id="adminlogin" name="adminlogin" value='admins'>
                  <div>
                     <div class="input-field s12">
                        <input type="password" class="validate" name="adminpass" id="adminpass">
                        <label>Password</label>
                     </div>
                  </div>
                  <div>
                     <div class="input-field s4">
                        <button type="button" class="waves-effect waves-light log-in-btn" name="admin_btn_submit"
                           id="admin_btn_submit">Login</button> &nbsp&nbsp
                        <a href="javascript:void(0)" id="ad-fp-button" data-toggle="modal"
                           data-target="#forgot_pass">Forgot Password</a>
                     </div>
                  </div>
                  <!-- <div>
                  <div class="input-field s12"> <a class='login_closer' href="#" data-dismiss="modal" data-toggle="modal" data-target="#modal1" aria-label="close">Are you a already member ? Login</a> </div>
                  </div>--->
               </form>
            </div>
         </div>
      </div>

      <!-- REGISTER SECTION -->
      <div id="modal2" class="modal fade" role="dialog">
         <div class="log-in-pop">
            <div class="log-in-pop-right">
               <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
               </a>
               <h4>Create an Account</h4>
               <img src="images/logo.png" alt="" style="margin-left: 63px;width: 156px;" />
               <form method="post" id="instutionpopup" action="">
                  <div class="event-head-sub">
                     <ul>
                        <h6 style="text-align:justify; font-size:15px; color:red;">INSTITUTION MEMBER:</h6>
                        <li><a href="Institutionregister.php"><i class="fa fa-dot-circle-o"
                                 style="color:yellow"></i><b>&nbsp&nbsp InstitutionMember (IM form
                                 Rs:3000)&nbsp;</b></a></li>
                        <br>
                        <h6 style="text-align:left; font-size:15px; color:red;">MEMBERS:</h6>
                        <li><a data-toggle="modal" data-dismiss="modal" data-target="#editboar"><i
                                 class="fa fa-dot-circle-o" style="color:yellow"></i><b>&nbsp&nbsp Life (6000 Rs
                                 )/Annual Members (1500 Rs)</b></a></li>
                     </ul>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- FORGOT SECTION -->
      <div id="forgot_pass" class="modal fade" role="dialog">
         <div class="log-in-pop">
            <div class="log-in-pop-right">
               <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
               </a>
               <h4>Forgot password</h4>
               <p>Please provide the registered email ID</p>
               <form id="form_forgot_password" class="s12" method="post">
                  <div>
                     <div class="row">
                        <div class="col-12 fp-alert-box">
                           <p id="fp-alert-content"></p>
                        </div>
                     </div>
                     <div class="input-field s12">
                        <input type="text" name="email" data-ng-model="name3" class="validate" id="fp-email">
                        <label>Email id</label>
                        <input type="hidden" name="from_admin" value="0" id="fp-from-admin">
                     </div>
                  </div>
                  <div>
                     <div class="input-field s4">
                        <input type="submit" value="Reset Password" class="waves-effect waves-light log-in-btn">
                     </div>
                  </div>
                  <div>
                     <div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal"
                           data-target="#modal1">Are you a already member ? Login</a> | <a href="#" data-dismiss="modal"
                           data-toggle="modal" data-target="#modal2">Create a new account</a> </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <a href="javascript:void(0)" style="display:none;" id="trigger_rpd" data-toggle="modal"
         data-target="#reset_pass">Reset Password</a>
      <div id="reset_pass" class="modal fade" role="dialog">
         <div class="log-in-pop">
            <div class="log-in-pop-right">
               <a href="#" class="pop-close" data-dismiss="modal"><img src="images/cancel.png" alt="" />
               </a>
               <h4>Reset password</h4>
               <p>Please enter the new password</p>
               <form id="form_reset_password" class="s12" method="post">
                  <div>
                     <div class="row">
                        <div class="col-12 rp-alert-box">
                           <p id="rp-alert-content"></p>
                        </div>
                     </div>
                     <div class="input-field s12">
                        <input type="password" name="password" class="validate" id="rp-password">
                        <label>Password</label>
                     </div>
                     <div class="input-field s12">
                        <input type="password" name="cpassword" class="validate" id="rp-cpassword">
                        <label>Confirm Password</label>
                     </div>
                     <input type="hidden" name="rp_token" value="" id="rp-token">
                  </div>
                  <div>
                     <div class="input-field s4">
                        <input type="submit" value="Reset Password" class="waves-effect waves-light log-in-btn">
                     </div>
                  </div>
                  <div>
                     <div class="input-field s12"> <a href="#" data-dismiss="modal" data-toggle="modal"
                           data-target="#modal1">Are you a already member ? Login</a> | <a href="#" data-dismiss="modal"
                           data-toggle="modal" data-target="#modal2">Create a new account</a> </div>
                  </div>
               </form>
            </div>
         </div>
      </div>

      <div id="bannerModal" class="modal fade" role="dialog" style="text-align:center">


         <span class="close" data-dismiss="modal" aria-label="Close"
            style="opacity: .9;margin-right:20px;margin-top:20px;color:#FFF">&times;</span>
         <?php
         $filePath =  APP_URL . "store_file" . DIRECTORY_SEPARATOR . "poup_images" . DIRECTORY_SEPARATOR;
         ?>

         <img class="modal-content" id="" style="width:80%"
            src="<?php echo $filePath ?>July_WEBINAR_SPGS_Invit_29_07.jpg">


      </div>

   </section>
   <script src="js/main.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/materialize.min.js"></script>
   <script src="assets/js/scripts.js"></script>
   <script src="js/custom.js">
   </script>
</body>

</html>
<script>
   //jQuery('#modalClick').click();
</script>
</body>

</html>