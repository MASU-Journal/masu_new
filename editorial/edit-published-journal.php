<?php
include_once('manager_header.php');
if(empty($_GET['journal-id'])){
    exit;
}
$journal_id = trim($_GET['journal-id']);
include_once('controller/PublisherController.php');
$data = getPublishedPaper($journal_id);
if(empty($data)){
    exit;
}
//pre($data,1);
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
                <h1>Edit Published Journals</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item">To edit already published Journals</li>
                </ol>
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
                    <form id='journal_publish_form' method="POST" action="controller/PublisherController.php" enctype="multipart/form-data" >
                    <input type="hidden" name='edit_published_journal' value="1"/>
                    <input type="hidden" name='journal_id' value="<?php echo $journal_id; ?>"/>

                        <div class="row" id="resub_title">
                            <h6>Journal Title:</h6>
                            <div class="col-12 form-group formhide">
                                <input type="text" id="journal-title" name="journal-title"  placeholder="Journal Title" class="form-control validate"
                                                value="<?php echo $data->title; ?>">
                                <span class="validation-error" id="journal-title-error"></span>
                            </div>
                        </div>
                        <div class="row" id="resub_title">
                            <div class="form-group col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                <h6>Authors Name:</h6>
                                <input type="text" id="authors-name" name="authors-name"  placeholder="Authors Name (separated by commas)" class="form-control validate" value="<?php echo $data->authors; ?>">
                                <span class="validation-error" id="authors-name-error"></span>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h6>Manuscript ID : </h6>
                                <input type="text" id="manuscript-id" name="manuscript-id" placeholder="Manuscript ID" class="form-control col-md-12 validate" value="<?php echo $data->manuscript_id;?>">
                                <span class="validation-error" id="manuscript-id-error"></span>
                            </div>
                        </div>                            
                        <div class="row" id="resub_title">
                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h6>Volume:</h6>
                                <select class="form-control" name="volume" id='volume'>
                                    <?php
                                        $yArray = ["2017" => "104"];
                                        //$current_year = date("Y");
                                        $current_year = '2018';
                                        for($i=-1;$i<7;$i++){
                                            $yr = $current_year + $i;
                                            $diff = $yr - 2017;
                                            $currentvol = $yArray["2017"] + $diff;
                                            $slct = ($data->volume == $currentvol) ? 'selected' : '';
                                    ?>
                                    <option value="<?php echo $currentvol; ?>" <?php echo $slct;?> ><?php echo $currentvol; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="validation-error" id="volume-error"></span>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h6>Issue:</h6>
                                <select class="form-control" name="issue" id='issue'>
                                    <option <?php echo ($data->issue == "march") ? "Selected" : "";?> value="March">1-3 [March]</option>
                                    <option <?php echo ($data->issue == "June") ? "Selected" : "";?> value="June">4-6 [June]</option>
                                    <option <?php echo ($data->issue == "September") ? "Selected" : "";?> value="September">7-9 [September]</option>
                                    <option <?php echo ($data->issue == "December") ? "Selected" : "";?> value="December">10-12 [December]</option>
                                    <option <?php echo ($data->issue == "Special") ? "Selected" : "";?> value="Special">Special</option>
                                </select>
                                <span class="validation-error" id="issue-error"></span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <h6>DOI : </h6>
                                <div class="form-group">
                                    <input type="text" id="doi" name="doi" placeholder="DOI" class="form-control col-md-12 validate" value="<?php echo $data->doi;?>">
                                    <span class="validation-error" id="doi-error"></span>
                                </div>
                            </div>
                            <div class= col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h6>Start Page : </h6>
                                <div class="form-group">
                                    <input type="text" id="page_start" name="page_start" placeholder="Start" class="form-control col-md-12 validate" value="<?php echo $data->page_start;?>">
                                    <span class="validation-error" id="page_start-error"></span>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                <h6>End Page : </h6>
                                <div class="form-group">
                                    <input type="text" id="page_end" name="page_end" placeholder="End" class="form-control col-md-12 validate" value="<?php echo $data->page_end;?>">
                                    <span class="validation-error" id="page_end-error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="abstract_row" style="padding:15px;">
                            <h6>Abstract:</h6>
                            <textarea class="form-control col-md-12" name="abstract" id="abstract">
                                <?php echo $data->abstract;?>
                            </textarea>
                            <span class="validation-error" id="abstract-error"></span>
                        </div>
                        <div class="row" id="resub_title">
                            <h6>Keywords : </h6>
                            <div class="form-group col-12 formhide">
                                <input type="text" id="keywords" name="keywords" placeholder="Keywords (separated by commas)" class="form-control validate"
                                                    value="<?php echo $data->keywords;?>">
                                <span class="validation-error" id="keywords-error"></span>
                            </div>
                        </div>
                        <div class="row formhide" id="id4">
                            <h6>Journal File:</h6>
                            <div class="file-field form-group col-md-12" id="resub_file">
                                <div class="col-md-12 admin-upload-btn">
                                    <input type="file" style="background-color: #d5eeff;width: 100%;padding: 8px;border: 1px dashed;" id="journal-file" name="journal-file">
                                    <span class="validation-error" id="journal-file-error"></span>
                                </div>
                                <p>Note:(doc,docs,pdf only Can upload  )</p>
                                <p>Previously Uploaded File Name: <?php echo $data->file;?></p>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="form-group col s12">
                                <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                                <input type="submit" id="publish_journal_submit_btn" name="journal_submit_button" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;"></button></i>
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
        $("#journal-file").change(function(){
            $(".form-error, .form-success").hide();
        });
        $('#journal_publish_form').submit(function(e){
            $(".validation-error").empty().hide();
            var error = 0;
            //Title validation
            $title_regex = "[^.*$]{5,}";
            if(!$("#journal-title").val().match($title_regex)) {
               $("#journal-title-error").html("Journal title must contain atleast 5 characters").show();
               error = 1;
            }
            //Authors Validation
            $author_regex = "[^.*$]{5,}";
            if(!$("#authors-name").val().match($author_regex)) {
               $("#authors-name-error").html("Authors name must contain atleast 3 characters").show();
               error = 1;
            }
            //Volume validation
            $volume_regex = "^[0-9]{3,5}$";
            if(!$("#volume").val().match($volume_regex)) {
               $("#volume-error").html("Volume is numeric and must contain atleast 3 characters").show();
               error = 1;
            }
            //Issue Validation
            $issue_regex = "[^.*$]{3,}";
            if(!$("#issue").val().match($issue_regex)) {
               $("#issue-error").html("Issue must contain atleast 5 characters").show();
               error = 1;
            }
            //Abstract Validation
            $abstract_regex = "[^.*$]{100,}";
            var abstract = $.trim($("#abstract").val());
            if(!abstract.match($abstract_regex)) {
               $("#abstract-error").html("Abstract must contain atleast 100 characters").show();
               error = 1;
            }
            //Page Start Validation
            $page_regex = "[^.*$]{1,}";
            if(!$("#page_start").val().match($page_regex)) {
               $("#page_start-error").html("Page-Start must contain atleast 1 number").show();
               error = 1;
            }
            //Keywords Validation
            // $keyword_regex = "^.{5,}$";
            // if(!$("#keywords").val().match($keyword_regex)) {
            //    $("#authors-name-error").html("Keywords must contain atleast 5 characters").show();
            //    error = 1;
            // }
            //File Validation
            //$file_regex = "";
            if(error == 1){
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php include_once('footer.php');