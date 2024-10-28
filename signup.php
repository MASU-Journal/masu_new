<!DOCTYPE html>
<html> 
  <title>Welcome to Madras Agriculture Journal</title>
    <!-- META TAGS -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">
    <meta name="keyword" content="">
    <!-- FAV ICON(BROWSER TAB ICON) -->
    <link rel="shortcut icon" href="images/slider/ic.jpg" type="image/x-icon">
    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CJosefin+Sans:600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!-- FONTAWESOME ICONS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- ALL CSS FILES -->
    <link href="css/materialize.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/style-mob.css" rel="stylesheet" />
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
.sf-submit input {
   
    font-weight: 200;
    padding: 11px;
}
</style>
<body>
<?php include 'header.php' ;?>


<div class="container">
  <!--<h1>Personal Information</h1>-->
  <!-- One "tab" for each step in the form: -->
            <div class="sb2-2-3">
                    <div class="row">
                        <div class="col-md-12">
						<div class="box-inn-sp admin-form">
                                <div class="inn-title">
                                    <h4>SIGNUP</h4>
                                    <p></p>
                                </div>
                                <div class="tab-inn">
								   <form action="#" class="popup-form" id="institutionregister">
                                        <div class="row">
								
											<div class="input-field col s6">
											<h5><b>Name</b></h5>
											<input type="text" class="validate" id="reg_institution">
											<input type="hidden" class="validate"  id="category_id" value=1 />
											<input type="hidden" class="validate"  id="type_id" value=1 />
											</div>
											<div class="input-field col s6">
											<h5><b>Designation:</b></h5>
											<input type="text" class="validate" id="reg_postal">
											</div>
										</div>
										<div class="row">
								            <div class="input-field col s6">
											<h5><b>Address:</b></h5>
											<input type="text" class="validate" id="reg_institution">
											<input type="hidden" class="validate"  id="category_id" value=1 />
											<input type="hidden" class="validate"  id="type_id" value=1 />
											</div>
											<div class="input-field col s6">
											<h5><b>Departments:</b></h5>
											<input type="text" class="validate" id="reg_postal">
											</div>
										</div>
										<div class="row">
										    <div class="input-field col s6">
											<h5><b>Email Address:</b></h5>
                                                <input type="email" class="validate" id="reg_email" onblur="validateEmail(this);">
                                                <!--<label class="">Title</label>-->
                                            </div>
											<div class="file-field input-field col s6">
											<h5><b>Contact Number:</b></h5>
												 <input type="insnumber" onkeypress="return isNumberKey(event)" class="validate" id ="reg_contact" maxlength="10">
											
											</div>
										 </div>   
										<!--<div class="row">
											<div class="input-field col s12">
											<h5><b>Postal Address:</b></h5>
											<input type="text" class="validate" id="reg_postal">
											</div>
										</div>
										
                                        <div class="row">
										
                                            <div class="input-field col s6">
											<h5><b>Email Address:</b></h5>
                                                <input type="email" class="validate" id="reg_email">
                                                <!--<label class="">Title</label>-->
                                           <!-- </div>
											<div class="file-field input-field col s6">
											<h5><b>Contact Number:</b></h5>
												 <input type="insnumber" onkeypress="return isNumberKey(event)" class="validate" id ="reg_contact" maxlength="10">
											
											</div>
										</div>-->
										<div class="row">
                                           <!--<div class="input-field col s6">
												<h5><b>Year</b></h5>
												<select id="reg_year" class='validate form-control' >
												<option value= selected>select</option>
												<?php $year = intval(date("Y"));  for($i=0;$i<7;$i++) { ?>
													<option value="<?php echo $i;  ?>"><?php echo $year+$i  ?></option>
												<?php } ?>
												</select>
                                            </div> -->
                                            <div class="input-field col s6">
											 <h5><b>Password</b></h5>
                                                <input name="password" type="password" id="txtPassword">
                                                <!--<label class="">Title</label>-->
                                            </div>
                                            <div class="input-field col s6">
											<h5><b>Confirm Password</b></h5>
                                                <input type="password" name="txtConfirmPassword" id="txtConfirmPassword">
                                                <!--<label class="">Title</label>-->
                                            </div>
                                            <!---<div class="row">
											 <div class="input-field col s12">
											<h5><b>Confirm Password</b></h5>
                                                <input type="password" class="validate" id="con_password">
                                                <!--<label class="">Title</label>-->
                                            <!--</div>
                                            </div>-->
										</div>
										<div class="row">
										    <div class="input-field col s6">
                                                <h5><b>Membership</b></h5>
                                                <select id="membership" class='validate form-control' >
												<option value= selected>Annual Membership</option>
												<option value= selected>Life Membership</option>
												<option value= selected>Institute Membership</option>
												</select>
                                            </div>  
                                           <div class="input-field col s6">
												<h5><b>Year</b></h5>
												<select id="reg_year" class='validate form-control' >
												<option value= selected>select</option>
												<?php $year = intval(date("Y"));  for($i=0;$i<7;$i++) { ?>
													<option value="<?php echo $i;  ?>"><?php echo $year+$i  ?></option>
												<?php } ?>
												</select>
                                            </div>
                                        </div>
								        <div class="row">
                                             <div class="input-field col s6">
										        <i class="waves-effect waves-light btn-large waves-input-wrapper" style="">
                                                   <input type="submit" class="waves-button-input" id="Submit" value="Submit"></i>
                                            </div>
                                        </div>
                                    </form>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
   </div>


   <!--SECTION START-->
    <section>
        <div class="full-bot-book">
            <div class="container">
                <div class="row">
                    <div class="bot-book">
                        <div class="col-md-2 bb-img">
                            <img src="images/3.png" alt="">
                        </div>
                        <div class="col-md-7 bb-text">
                            <h4>therefore always free from repetition</h4>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                        </div>
                        <div class="col-md-3 bb-link">
                            <a href="course-details.html">Book This Course</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--SECTION END-->

 <?php include 'footer.php' ;?>

    

    <!--Import jQuery before materialize.js-->
    <script src="js/main.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
	<script>
	  function isNumberKey(evt)
               {
                  var charCode = (evt.which) ? evt.which : event.keyCode
                  if (charCode > 31 && (charCode < 48 || charCode > 57))
                     return false;
         
                  return true;
               }
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#Submit").click(function () {
            var password = $("#txtPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }
            return true;
        });
    });
    function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
            alert('Invalid Email Address');
            return false;
        }

        return true;

}
</script>
</body>
</html>
