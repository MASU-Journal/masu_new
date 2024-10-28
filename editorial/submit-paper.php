<?php
include_once('header.php');
if((isset($_SESSION['user_id']) && $_SESSION['user_id']!="")){  
    $user_id=$_SESSION['user_id'];
    $user_ins_name=$_SESSION['user_ins_name'];
    $user_email=$_SESSION['user_email'];
    $sql="SELECT * FROM  tbl_user where user_id=".$user_id;
    $user_data=$db->query($sql);
    $user_details=$user_data->rows;
}
?>
<style type="text/css">
    .validation-error{
        color : red;
    }
    .ecommerce-stats-area{
        padding: 10px 5px !important;
        background-color: #FFFBED;
        border : 1px solid #FFC199;
    }
    .close-co-btn{
        border-radius: 50%;
        padding : 5px 8px;
        margin-bottom: 10px;
    }
    .co-author-section{
        display: none;
    }
    .close-co-btn{
        cursor: pointer;
    }
    #journal_submit_form input:active{
        border: 1px solid blue !important;
    }
    .questionnaire-section{
        padding : 20px;
    }
    .questionnaire-section .row{
        padding: 10px;
        background-color: #FFFFFF;
        border: 1px solid #AA96AD !important;
        margin-bottom: 10px;
    }
    .questionnaire-section .row .col-md-6{
        height: 27px;
    }
    .questionnaire-section .row .validation-error{
        margin-left:20px;
    }
    #alert-section{
        display: none;
    }
</style>
            <!-- Breadcrumb Area -->
            <!-- <div class="breadcrumb-area">
                <h1>Add Paper</h1>

                <ol class="breadcrumb">
                    <li class="item"><a href="dashboard-analytics.html"><i class='bx bx-home-alt'></i></a></li>

                    <li class="item">Add Paper</li>
                </ol>
            </div> -->
            <div class="card mb-30" id="submit-form-section">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Add Paper</h3>
                </div>
                <div class="card-body">
                    <?php if(!empty($_SESSION['form_error'])){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
                                    <?php unset($_SESSION['form_error']); } ?>
                                    <?php if(!empty($_SESSION['form_success'])){ ?>
                                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
                                    <?php unset($_SESSION['form_success']); } ?>
                    <form id='journal_submit_form' method="POST" action="../journal_submit.php" enctype="multipart/form-data" >
                        <input type="hidden" name='student_submit_profile_id'  value="<?php echo $user_details[0]->user_id; ?>" />
                        <input type="hidden" name='journal_submit'  value="db-institutionprofile.php" />
                        <div class="row">
                        <div class="form-group col-md-6">
                            <!-- <label>Subject</label> -->
                            <select name="subject" id='journal_subject' name="journal_subject" class="form-control">
                                <option value="--" selected>-- Select Subject --</option>
                                <option value="Agriculture" selected>Agriculture</option>
                                <option value="Horticulture">Horticulture</option>
                                <option value="Agriculture Engineering">Agriculture Engineering</option>
                                <option value="Foof Science" >Food Science</option>
                                <option value="Sericulture" >Sericulture</option>
                                <option value="Forestry" >Forestry</option>
                            </select>
                            <span class="validation-error" id="journal_subject-error"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <!-- <label>Article Type</label> -->
                            <select name="journal_type" id='journal_type' name="journal_type" class="form-control">
                                <option value="--" selected>-- Select Article Type --</option>
                                <option value="Original Research" selected>Original Research</option>
                                <option value="Review Article">Review Article</option>
                                <option value="Conference Paper">Conference Paper</option>
                            </select>
                            <span class="validation-error" id="journal_type-error"></span>
                        </div>
                    </div>
                        <div class="form-group">
                            <!-- <label>Title</label> -->
                            <input type="text" id="journal_title" name="journal_title" value="" placeholder="Title" class="validate form-control">
                            <span class="validation-error" id="journal_title-error"></span>  
                        </div>
                        
<div class="author-section">
    <h6 id="author-header"><b>Corresponding Author : </b><br></h6>
    <div class="row">
        <div class="form-group col">
            <!-- <label>Author</label> -->
            <input type="text" id="journal_author" name="journal_author" value="" placeholder="First Name" class="validate form-control">
            <span class="validation-error" id="journal_author-error"></span>
        </div>
        <div class="form-group col">
            <!-- <label>Author</label> -->
            <input type="text" id="author_last_name" name="author_last_name" value="" placeholder="Last Name" class="validate form-control">
            <span class="validation-error" id="author_last_name-error"></span>
        </div>
    </div>
    <div class="form-group">
        <!-- <label>Affiliation</label> -->
        <input type="text" id="affiliation" name="affiliation" value="" placeholder=" Affiliation Details" class="validate form-control">
        <span class="validation-error" id="affiliation-error"></span> 
    </div>
</div>
<div class="co-author-section">
    <h6 id="co-author-header"><b>Co-Author : </b><br></h6>
</div>
                        <div class="text-right" style="margin-bottom:10px;">
                        <button class="add-co-author btn btn-warning text-white text-bold"><strong>Add Co-Author</strong></button>
                        </div>
                        <div class="form-group">
                            <!-- <label>Affiliation</label> -->
                            <input type="text" id="keywords" name="keywords" value="" placeholder="Keywords" class="validate form-control">
                            <span class="validation-error" id="keywords-error"></span> 
                        </div>
                        <div class="form-group">
                            <!-- <label>Affiliation</label> -->
                            <textarea rows="4" type="text" id="abstract" name="abstract" value="" placeholder="Abstract" class="validate form-control"></textarea>
                            <span class="validation-error" id="abstract-error"></span> 
                        </div>

                        <div class="row" id="id4">
    <div class="col-md-6" style="width: 50%;">
        <h6><b>Title page with cover letter  : </b></h6>
        <div class="file-field input-field" id="resub_file">
            <div class="  admin-upload-btn">
            <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="journal-file2" name="journal-file2">
            </div>
            <p class="text-muted">Word File only (Maximum 2 MB)</p>
        </div>
        <span class="validation-error" id="journal-file2-error"></span>
    </div>
    <div class="col-md-6" style="width: 50%;">
        <h6><b>Blinded Manuscript : </b></h6>
        <div class="file-field input-field" id="resub_file">
            <div class="admin-upload-btn">
            <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="journal-file" name="journal-file">
            </div>
            <p class="text-muted">Word File only (Maximum 5 MB)</p>
        </div>
        <span class="validation-error" id="journal-file-error"></span>
    </div>
    
</div>
<h6><b>Questionnaire : </b><br></h6>
<div class="questionnaire-section">
    <div class="row ">
        <div class="col-md-6">
            <p class="text-left">1. Has this Article been published or submitted anywhere else?</p>
        </div>
        <div class="col-md-6">
            <span style="margin-right: 50px;"> : </span>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q1" id="q1-1" value="1" checked>
                <label class="form-check-label" for="q1-1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q1" id="q1-2" value="0">
                <label class="form-check-label" for="q1-2">No</label>
            </div>
        </div>
        <span class="validation-error" id="q1-error"></span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="text-left">2. Has this Article been submitted here before?</p>
        </div>
        <div class="col-md-6">
            <span style="margin-right: 50px;"> : </span>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q2" id="q2-1" value="1" checked>
                <label class="form-check-label" for="q2-1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q2" id="q2-2" value="0">
                <label class="form-check-label" for="q2-2">No</label>
            </div>
        </div>
        <span class="validation-error" id="q2-error"></span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="text-left">3. Do you have any conflict of interest?</p>
        </div>
        <div class="col-md-6">
            <span style="margin-right: 50px;"> : </span>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q3" id="q3-1" value="1" checked>
                <label class="form-check-label" for="q3-1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q3" id="q3-2" value="0">
                <label class="form-check-label" for="q3-2">No</label>
            </div>
        </div>
        <span class="validation-error" id="q3-error"></span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="text-left">4. Does the research meets ethical guidelines?</p>
        </div>
        <div class="col-md-6">
            <span style="margin-right: 50px;"> : </span>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4-1" value="1" checked>
                <label class="form-check-label" for="q4-1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q4" id="q4-2" value="0">
                <label class="form-check-label" for="q4-2">No</label>
            </div>
        </div>
        <span class="validation-error" id="q4-error"></span>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="text-left">5. Did all the authors read and approve the manuscript?</p>
        </div>
        <div class="col-md-6">
            <span style="margin-right: 50px;"> : </span>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q5" id="q5-1" value="1" checked>
                <label class="form-check-label" for="q5-1">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="q5" id="q5-2" value="0">
                <label class="form-check-label" for="q5-2">No</label>
            </div>
        </div>
        <span class="validation-error" id="q5-error"></span>
    </div>
</div>
<div class="text-right">
    <button type="button" id="journal_submit" class="btn btn-success">Submit</button>
</div>

                    </form>
                </div>
            </div>



<div class="card mb-30" id="confirmation-section" style="display: none;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>
            Submit
        </h3>
    </div>
   <!-- <div class="col-md-12 embed-section">
    </div>-->
    <div class="col-md-12" id="alert-section">
        <div class="alert alert-warning" role="alert">The uploaded files cannot be shown here because of the compression techniques. Please click "Submit" button if the uploaded files are correct.</div>
    </div>
    <div class="col-md-12 text-right">
        <button class="btn btn-info" id="back-2-form">Back to form</button>
        <button class="btn btn-success" id="verified-and-submit">Submit</button>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        // File type validation
        $("#journal-file").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            console.log(fileType);
            //var match = ['application/pdf'];
            // var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            var match = ['application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            //alert(fileType);
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only Word files are allowed to upload.');
                //$("#journal-file").val('');
                //return false;
            }
        });
        $("#journal-file2").change(function() {
            var file = this.files[0];
            var fileType = file.type;
            //alert(fileType);
            //var match = ['application/pdf'];
            var match = ['application/msword', 'application/vnd.ms-office','application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                alert('Sorry, only Word files are allowed to upload.');
                //$("#journal-file2").val('');
                //return false;

            }
        });
        $(".validation-error").prev().keyup(function(){
            $(this).next().hide();
            $(".form-error, .form-success").hide();
        });
        $(".validation-error").prev().change(function(){
            $(this).next().hide();
            $(".form-error, .form-success").hide();
            $(".validation-error").hide();
        });
        $("#journal-file").change(function(){
            $(".form-error, .form-success").hide();
            $(".validation-error").hide();
        });
        $("#journal-file2").change(function(){
            $(".form-error, .form-success").hide();
            $(".validation-error").hide();
        });
        $('#journal_submit').click(function(e){
            $(".loader-mask").show();
            $(".validation-error").empty().hide();
            var error = 0;
            //Title validation
            $title_regex = "[^.*$]{1,}";
            if(!$("#journal_title").val().match($title_regex)) {
               $("#journal_title-error").html("Please enter journal title").show();
               error = 1;
            }
            //Authors Validation
            $author_regex = "[^.*$]{1,}";
            if(!$("#journal_author").val().match($author_regex)) {
               $("#journal_author-error").html("Please enter author names").show();
               error = 1;
            }
            //Volume validation
            $journal_subject = "[^.*$]{3,}";
            if(!$("#journal_subject").val().match($journal_subject)) {
               $("#journal_subject-error").html("Please choose Journal Subject").show();
               error = 1;
            }
            //Affiliation validation
            $affiliation = "[^.*$]{1,}";
            if(!$("#affiliation").val().match($affiliation)) {
               $("#affiliation-error").html("Please enter affiliation details").show();
               error = 1;
            }
            //keywords validation
            $keywords = "[^.*$]{1,}";
            if(!$("#keywords").val().match($keywords)) {
               $("#keywords-error").html("Please enter keywords details").show();
               error = 1;
            }
            //abstract validation
            $abstract = "[^.*$]{1,}";
            if(!$("#abstract").val().match($abstract)) {
               $("#abstract-error").html("Please enter abstract details").show();
               error = 1;
            }
            //Issue Validation
            $journal_type = "[^.*$]{3,}";
            if(!$("#journal_type").val().match($journal_type)) {
               $("#journal_type-error").html("Please choose journal type").show();
               error = 1;
            }
            //File Validation
            $journal_file = "[^.*$]{1,}";
            if(!$("#journal-file").val().match($journal_file)) {
               $("#journal-file-error").html("Please select a file").show();
               error = 1;
            }
            $journal_file2 = "[^.*$]{1,}";
            if(!$("#journal-file2").val().match($journal_file2)) {
               $("#journal-file2-error").html("Please select a file").show();
               error = 1;
            }
            if(!($('input:radio[name=q1][id=q1-1]').prop('checked') || $('input:radio[name=q1][id=q1-2]').prop('checked'))){
                error = 1;
                $("#q1-error").html("Please choose any option").show();
            }
            if(!($('input:radio[name=q2][id=q2-1]').prop('checked') || $('input:radio[name=q2][id=q2-2]').prop('checked'))){
                error = 1;
                $("#q2-error").html("Please choose any option").show();
            }
            if(!($('input:radio[name=q3][id=q3-1]').prop('checked') || $('input:radio[name=q3][id=q3-2]').prop('checked'))){
                error = 1;
                $("#q3-error").html("Please choose any option").show();
            }
            if(!($('input:radio[name=q4][id=q4-1]').prop('checked') || $('input:radio[name=q4][id=q4-2]').prop('checked'))){
                error = 1;
                $("#q4-error").html("Please choose any option").show();
            }
            if(!($('input:radio[name=q5][id=q5-1]').prop('checked') || $('input:radio[name=q5][id=q5-2]').prop('checked'))){
                error = 1;
                $("#q5-error").html("Please choose any option").show();
            }
            if(error == 1){
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            } else {
                $("#journal_submit_form").submit();
            }
        });

        //Form Submit
        $("#journal_submit_form").submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '../journal_submit.php',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    $('.journal_submit').attr("disabled","disabled");
                },
                success: function(response){ //console.log(response);
                    $(".loader-mask").hide();
                    $(".submitBtn").removeAttr("disabled");
                    if(response.status == 'success'){
                        var titleVal = $('#journal_title').val();
                        $("#submit-form-section").hide();
                        $("#confirmation-section").show();
                        $("#confirmation-section h3").html('Title: '+titleVal);
                        $("#verified-and-submit").attr("manuscript-id",response.data.manuscript_id);
                       // $(".embed-section").empty().html('<embed class="mb-30" id="merged_pdf" src="'+response.data.merged_file+'" width="100%" height="720px" />')
                    } else if(response.status == 'warning'){
                        $("#submit-form-section").hide();
                        $("#confirmation-section").show();
                        $("#verified-and-submit").attr("manuscript-id",response.data.manuscript_id);
                       // $(".embed-section").empty().html('<embed class="mb-30" id="merged_pdf" src="'+response.data.info_pdf+'" width="100%" height="720px" />');
                        $("#alert-section").show();
                    } else if(response.status == 'error'){
                        $(".loader-mask").hide();
                        alert(response.submission_error);
                        $(".submitBtn").removeAttr("disabled");
                    }

                },
                error: function(response){
                    alert("Issue with File uploading.. Please check the file sizes and try again..");
                   console.log(response);
                    $(".loader-mask").hide();
                    $(".submitBtn").removeAttr("disabled");
                }
            });
        });


        //Co-Author Dynamic addition and removal
        var co_author_count = 0;
        var individual_count = 0;
        var max_co_author_limit = 10;
        $(".add-co-author").click(function(e){
            e.preventDefault();
            if(co_author_count >= 10){
                alert("Sorry.. You can add only 10 co-authors");
                return false;
            }
            co_author_count += 1;
            individual_count += 1;
            if(co_author_count > 0){
                $("#co-author-header").show();
                $(".co-author-section").css("display", "block").append('<div class="ecommerce-stats-area" id="co-author-section_'+individual_count+'"> <div class="row"> <div class="col-md-12 text-right"> <span count="'+individual_count+'" class="close-co-btn badge badge-danger">x</span> </div><div class="col-md-4"> <div class="form-group"> <input type="text" name="co_firstname[]" value="" placeholder="First Name" class="validate form-control"> </div></div><div class="col-md-4"> <div class="form-group"> <input type="text" name="co_lastname[]" value="" placeholder="Last Name" class="validate form-control"> </div></div><div class="col-md-4"> <div class="form-group"> <input type="email" name="co_email[]" value="" placeholder="Email" class="validate form-control"> </div></div><div class="col-md-6"> <div class="form-group"> <input type="text" name="co_affiliation[]" value="" placeholder="Affiliation" class="validate form-control"> </div></div><div class="col-md-6"> <div class="form-group"> <input type="text" name="co_country[]" value="" placeholder="Country" class="validate form-control"> </div></div></div></div>');
            }
        });
        $(document).on("click",".close-co-btn",function(e){
            e.preventDefault();
            co_author_count = co_author_count - 1;
            if(co_author_count < 1){
                co_author_count = 0;
                $("#co-author-header").hide();
                $('.ecommerce-stats-area').remove();
            } else {
                var count = $(this).attr("count");
                $("#co-author-section_"+count).remove();
            }            
        });
        $("#back-2-form").click(function(){
            $("#merged_pdf").removeAttr("src");
            $("#verified-and-submit").removeAttr("manuscript-id");
            $("#confirmation-section").hide();
            $("#submit-form-section").show();
        });
        $("#verified-and-submit").click(function(){
            var manuscript_id = $(this).attr("manuscript-id");
            if(manuscript_id == undefined || manuscript_id == null || manuscript_id == ''){
                return false;
            }
            $(".loader-mask").show();
            $.ajax({
                type: 'POST',
                url: '../journal_submit.php',
                data: {
                    manuscript_id : manuscript_id,
                    action : 'submit_confirmation'
                },
                dataType: 'json',
                cache: false,
                beforeSend: function(){
                    $("#verified-and-submit").attr("disabled");
                },
                success: function(response){ //console.log(response);
                    $(".loader-mask").hide();
                    window.location.href = "dashboard.php";
                },
                error: function(response){
                    alert(response);
                    $(".loader-mask").hide();
                    $("#verified-and-submit").removeAttr("disabled");
                }
            });
        });
    });
</script>

<?php include_once('footer.php'); ?>