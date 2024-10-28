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
</style>
<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Add Editor</h1>
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
<form id='add_editor_form' method="POST" action="../manager_functions.php" enctype="multipart/form-data" >
    <input type="hidden" name='add_editor_action' value="add_editors.php"/>
    <div class="row" id="resub_title">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group formhide">
        <h6>Name:</h6>
            <input type="text" id="name" name="name"  placeholder="Editor Name" class="form-control validate" required value="">
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
            <h6>Category:</h6>        
            <select class="form-control" name="category" id='category'>
                <option value="1">Associate Editor</option>
                <option value="2" selected>Technical Editor</option>
                <option value="6">Executive Editor</option>
                <option value="3">Refree</option>
            </select>
            <span class="validation-error" id="category-error"></span>
        </div>
    </div>
    <div class="row">        
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group formhide">
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
        <div class="form-group col s12">
            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
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
        $("#add_editor_form").submit(function(){
          $("#add_editor_submit_btn").attr("disabled", "disabled");
        });
    });
</script>
<?php include_once('footer.php');