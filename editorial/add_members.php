<?php
include_once('manager_header.php');
$departments = getDepartments();
?>
<style type="text/css">
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #ff4365;
    }
    .d-flex{
      display: block !important;
    }
    .card {
      display: block !important;
    }
    .card .card-header{
      margin-bottom: 0px;
    }
    .journal-info{
      margin-bottom: 10px;
    }
    .manuscript-span{
      background-color: #FF686B;
      width : 20%;
      height : 50px;
      display: inline-block;
      color : white;
      padding: 10px 5px 10px 20px;
      font-weight: bold;
      font-size: 21px;
    }
    .title-span {
      width : 75%;
      height: 50px;
      display: inline-block;
      color : #195143;
      padding-left : 20px;
      font-weight: bold;
      font-size: 17px;
    }
    .header-card{
      width : 100%;
      background-color: #84DCC6;
      height : 50px;
    }
    .j-btn-section{
      margin : 20px 30px;
    }
    .validation-error{
      color : red;
      font-weight : bold;
      font-size : 12px;
      display : none;
    }
    input[type=file]{    
        width: 100%;
        padding: 8px;
        border: 1px dashed;
    }
    .doc{
        background-color: #d5eeff;
    }
</style>
<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Add Bulk Members</h1>
</div>
<?php if(!empty($_SESSION['form_error'])){ ?>
  <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
<?php unset($_SESSION['form_error']); } ?>
<?php if(!empty($_SESSION['form_success'])){ ?>
  <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
<?php unset($_SESSION['form_success']); } ?>
<?php if(!empty($_SESSION['form_warning'])){ ?>
  <div class="alert alert-warning" role="alert"><?php echo $_SESSION['form_warning']; ?></div>
<?php unset($_SESSION['form_warning']); } ?>
<div>

<div class="card mb-30">
    <div class="card-body">
    <div class="row" id="resub_title">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
          <form id='add_life_member_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
            <input type="hidden" name='main_action' value="addMembers"/>
            <input type="hidden" name='action' value="addLifeMemberAction"/>
            <div class="row">
              <div class="file-field form-group col-12">
                  <h6 class="sub-title">Life Members : Excel File</h6>
                  <input class="doc" type="file" id="ai-1-doc" name="bulk-file">
                  <span class="validation-errorc" id="bulk-file-error"></span>
              </div>
            </div>
            <div class="row">
              <div class="pull-right form-group col-lg-4 col-md-4 col-xs-12 col-sm-12">
                  <input type="submit" id="add_life_member_submit_btn" name="add_editor_submit_btn" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">
              </div>
            </div>
            </form> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
          <form id='add_annual_member_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
            <input type="hidden" name='main_action' value="addMembers"/>
            <input type="hidden" name='action' value="addAnnualMemberAction"/>
            <div class="row">
              <div class="file-field form-group col-12">
                  <h6 class="sub-title">Annual Members : Excel File</h6>
                  <input class="doc" type="file" id="ai-1-doc" name="ai-1-doc">
                  <span class="validation-errorc" id="ai-1-doc-error"></span>
              </div>
            </div>
            <div class="row">
              <div class="pull-right form-group col-lg-4 col-md-4 col-xs-12 col-sm-12">
                  <input type="submit" id="add_annaul_member_submit_btn" name="add_editor_submit_btn" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">
              </div>
            </div>
            </form> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide mt-4">
          <form id='add_institution_member_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
            <input type="hidden" name='main_action' value="addMembers"/>
            <input type="hidden" name='action' value="addInstitutionMemberAction"/>
            <div class="row mt-4">
              <div class="file-field form-group col-12">
                  <h6 class="sub-title">Institution Members : Excel File</h6>
                  <input class="doc" type="file" id="ai-1-doc" name="ai-1-doc">
                  <span class="validation-errorc" id="ai-1-doc-error"></span>
              </div>
            </div>
            <div class="row">
              <div class="pull-right form-group col-lg-4 col-md-4 col-xs-12 col-sm-12">
                  <input type="submit" id="add_institution_member_submit_btn" name="add_editor_submit_btn" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">
              </div>
            </div>
            </form> 
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide mt-4">
          <form id='add_student_member_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
            <input type="hidden" name='main_action' value="addMembers"/>
            <input type="hidden" name='action' value="addStudentMemberAction"/>
            <div class="row mt-4">
              <div class="file-field form-group col-12">
                  <h6 class="sub-title">Students : Excel File</h6>
                  <input class="doc" type="file" id="ai-1-doc" name="ai-1-doc">
                  <span class="validation-errorc" id="ai-1-doc-error"></span>
              </div>
            </div>
            <div class="row">
              <div class="pull-right form-group col-lg-4 col-md-4 col-xs-12 col-sm-12">
                  <input type="submit" id="add_student_member_submit_btn" name="add_editor_submit_btn" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">
              </div>
            </div>
            </form> 
        </div>
    </div>
    </div>
  </div>
<div class="breadcrumb-area">
    <h1>Add a Single Member</h1>
</div>
<div class="card mb-30">
    <div class="card-body">
<form id='add_member_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
    <input type="hidden" name='action' value="add_single_member_action"/>
    <div class="row" id="resub_title">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
        <h6>Name:</h6>
            <input type="text" id="name" name="name"  placeholder="Member Name" class="form-control validate" required value="">
            <span class="validation-error" id="name-error"></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
            <h6>Email:</h6>
            <input type="email" id="email" name="email"  placeholder="Email" class="form-control validate" required value="">
            <span class="validation-error" id="email-error"></span>
        </div>
    </div>
    <div class="row">        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
            <h6>Phone:</h6>        
            <input type="text" id="phone" name="phone"  placeholder="Phone" class="form-control validate" required value="">
            <span class="validation-error" id="phone-error"></span>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
            <h6>Department:</h6>
            <select name="department" class="form-control" id="department">
                <?php if(!empty($departments)) { 
                    foreach($departments as $d_id => $d_name){ ?>
                        <option selected value="<?php echo $d_id; ?>"><?php echo $d_name; ?></option>
                <?php    }
                 } ?>
                 <option value="0">Other</option>
            </select>      
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group formhide">
            <h6>Address:</h6>
            <input class="form-control" type="text" name="address" id="address" value="">  
        </div>      
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
            <h6>Join Date:</h6>
            <input class="form-control" type="text" name="join-date" id="join-date" value="" placeholder="dd-mm-yyyy">  
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
            <h6>Bill Number:</h6>
            <input class="form-control" type="text" name="bill-no" id="bill-no" value="" placeholder="Bill Number">  
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group formhide">
            <h6>Member Type:</h6>
            <select name="member_type" class="form-control" id="member_type">
                <option selected value="addLifeMemberAction">Life Member</option>
                <option value="addAnnualMemberAction">Annual Member</option>
                <option value="addInstitutionMemberAction">Institution Member</option>
                <option value="addStudentMemberAction">Student</option>
            </select>      
        </div>
        <div id="student_year" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide" style="display: none;">
            <input type="text" id="st_year" name="st_year"  placeholder="Student's Year" class="form-control validate" value="">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group formhide">
            <input type="text" id="other_department" name="other_department"  placeholder="Other/New Department" class="form-control validate" value="" style="display: none;">
            <span class="validation-error" id="department-error"></span>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group formhide">
            <input type="text" id="other_institute" name="other_institute"  placeholder="Other Institute" class="form-control validate" value="" style="display: none;">
            <span class="validation-error" id="other-institue-error"></span>
        </div>
        
    </div> 
    <div class="row">
        <div class="pull-right form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <input type="submit" id="add_editor_submit_btn" name="add_editor_submit_btn" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;"></i>
        </div>
    </div>
</form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $(".validation-error").prev().keyup(function(){
            $(this).next().hide();
            $(".form-error, .form-success").hide();
        });
        $("#department").change(function(){
            if($(this).val() == '0'){
                $("#other_department").empty().show();
                $("#other_institute").empty().show();
            }
        });
        $("#member_type").change(function(){
           var mType = $(this).val();
           if(mType == 'addStudentMemberAction'){
             $("#student_year").show();
           } else {
              $("#student_year").hide();
           }
        });
    });
</script>
<?php include_once('footer.php');