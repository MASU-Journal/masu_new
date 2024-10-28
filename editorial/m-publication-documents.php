<?php
include_once('manager_header.php');
?>
<style type="text/css">
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #006d77;
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
    .pdf{
        /*background-color: #ffe5d9;*/
        background-color: #d5eeff;
    }
</style>
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area">
        <h1>Publication Menu Documents</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">To Update existing Documents</li>
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
        <!-- Author Instruction Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Author Instructions : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="ai-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Main Document MAJ Template: DOC File</h6>
                            <input class="doc" type="file" id="ai-1-doc" name="ai-1-doc">
                            <span class="validation-errorc" id="ai-1-doc-error"></span>
                        </div>
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Main Document MAJ Template: PDF File</h6>
                            <input class="pdf" type="file" id="ai-1-pdf" name="ai-1-pdf">
                            <span class="validation-errorc" id="ai-1-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Title Page MAJ Template: DOC File</h6>
                            <input class="doc" type="file" id="ai-2-doc" name="ai-2-doc">
                            <span class="validation-errorc" id="ai-2-doc-error"></span>
                        </div>
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Title Page MAJ Template: PDF File</h6>
                            <input class="pdf" type="file" id="ai-2-pdf" name="ai-2-pdf">
                            <span class="validation-errorc" id="ai-2-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" name="ai-submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Author cum Reviewer Instruction Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Author cum Reviewer Instructions : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="acri-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="acri-pdf" name="acri-pdf">
                            <span class="validation-errorc" id="acri-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Certificate Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Certificate: </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="cert-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="cert-pdf" name="cert-pdf">
                            <span class="validation-errorc" id="cert-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Student Declaration Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Student Declaration: </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="sd-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="sd-pdf" name="sd-pdf">
                            <span class="validation-errorc" id="sd-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Conflict Of Interest Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Conflict Of Interest: </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="coi-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="coi-pdf" name="coi-pdf">
                            <span class="validation-errorc" id="coi-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Copyright Info Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Copyright: </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="ci-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Copyright : DOC File</h6>
                            <input class="doc" type="file" id="ci-1-doc" name="ci-1-doc">
                            <span class="validation-errorc" id="ci-1-doc-error"></span>
                        </div>
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Copyright : PDF File</h6>
                            <input class="pdf" type="file" id="ci-1-pdf" name="ci-1-pdf">
                            <span class="validation-errorc" id="ci-1-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Copyright-Transfer-FORM_MAJ: DOC File</h6>
                            <input class="doc" type="file" id="ci-2-doc" name="ci-2-doc">
                            <span class="validation-errorc" id="ci-2-doc-error"></span>
                        </div>
                        <div class="file-field form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <h6 class="sub-title">Copyright-Transfer-FORM_MAJ: PDF File</h6>
                            <input class="pdf" type="file" id="ci-2-pdf" name="ci-2-pdf">
                            <span class="validation-errorc" id="ci-2-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Peer Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Peer : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="peer-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="peer-pdf" name="peer-pdf">
                            <span class="validation-errorc" id="peer-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- Ethics Malpractice Statements Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Ethics Malpractice Statements : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="emps-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="emps-pdf" name="emps-pdf">
                            <span class="validation-errorc" id="emps-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Membership Subscription Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Membership Subscription : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="ms-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="ms-pdf" name="ms-pdf">
                            <span class="validation-errorc" id="ms-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Plagarism Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Plagarism : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="plagarism-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="plagarism-pdf" name="plagarism-pdf">
                            <span class="validation-errorc" id="plagarism-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Open Access Statement Documents-->
        <div class="card mb-30">
            <div class="card-body">
                <h5 style="font-weight: bold; color: #ef233c">Open Access Statement : </h5>
                <div class="card">
                <form method="POST" action="../publication_documents.php" enctype="multipart/form-data" >
                <input type="hidden" name='publication-documents' value="open-access-statement-docs"/>
                    <div class="row">
                        <div class="file-field form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <h6 class="sub-title">PDF File</h6>
                            <input class="pdf" type="file" id="open-access-statement-pdf" name="open-access-statement-pdf">
                            <span class="validation-errorc" id="open-access-statement-pdf-error"></span>
                        </div>
                    </div>
                    <div class="row" style="float:right;">
                        <div class="form-group col-12" style="margin: auto;">
                            <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:100%;">       
                            <button type="submit" class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">Submit</button></i>
                        </div>
                    </div>
                </form>
                </div>
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
            $(".loader-mask").show();
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
            //Keywords Validation
            // $keyword_regex = "^.{5,}$";
            // if(!$("#keywords").val().match($keyword_regex)) {
            //    $("#authors-name-error").html("Keywords must contain atleast 5 characters").show();
            //    error = 1;
            // }
            //File Validation
            //$file_regex = "";
            if(error == 1){
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php include_once('footer.php');