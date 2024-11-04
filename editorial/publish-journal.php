<?php
include_once('manager_header.php');
?>
<style type="text/css">
    .no-margin {
        margin: 0 !important;
    }

    .sub-title {
        font-weight: bold;
        color: #ff4365;
    }

    .d-flex {
        display: block !important;
    }

    .card {
        display: block !important;
    }

    .card .card-header {
        margin-bottom: 0px;
    }

    .journal-info {
        margin-bottom: 10px;
    }

    .manuscript-span {
        background-color: #FF686B;
        width: 20%;
        height: 50px;
        display: inline-block;
        color: white;
        padding: 10px 5px 10px 20px;
        font-weight: bold;
        font-size: 21px;
    }

    .title-span {
        width: 75%;
        height: 50px;
        display: inline-block;
        color: #195143;
        padding-left: 20px;
        font-weight: bold;
        font-size: 17px;
    }

    .header-card {
        width: 100%;
        background-color: #84DCC6;
        height: 50px;
    }

    .j-btn-section {
        margin: 20px 30px;
    }

    .validation-error {
        color: red;
        font-weight: bold;
        font-size: 12px;
        display: none;
    }

    .page {
        margin: 20px 0;
        border: 1px solid #ccc;
        padding: 10px;
        position: relative;
        width: 100%;
        /* Adjust based on PDF page size */
        height: auto;
        /* Adjust based on PDF page height */
    }

    .page span {
        /* position: absolute; */
        /* display: inline-block; */
        /* white-space: pre-wrap; */
        /* Preserve spaces and line breaks */
    }

    .custom-modal-dialog {
        width: 100%;
        max-width: 80%;
    }

    .rich-text-editor {
        height: 100%;
    }
</style>
<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Publish Journals</h1>
    <ol class="breadcrumb">
        <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
        <li class="item">To Publish Approved Journals</li>
    </ol>
</div>
<?php if(!empty($_SESSION['form_error'])) { ?>
<div class="alert alert-danger" role="alert">
    <?php echo $_SESSION['form_error']; ?>
</div>
<?php unset($_SESSION['form_error']);
} ?>
<?php if(!empty($_SESSION['form_success'])) { ?>
<div class="alert alert-success" role="alert">
    <?php echo $_SESSION['form_success']; ?>
</div>
<?php unset($_SESSION['form_success']);
} ?>
<?php if(!empty($_SESSION['form_warning'])) { ?>
<div class="alert alert-warning" role="alert">
    <?php echo $_SESSION['form_warning']; ?>
</div>
<?php unset($_SESSION['form_warning']);
} ?>
<div>
    <div class="card mb-30">
        <div class="card-body">
            <?php if(!empty($_SESSION['form_error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['form_error']; ?>
            </div>
            <?php unset($_SESSION['form_error']);
            } ?>
            <?php if(!empty($_SESSION['form_success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['form_success']; ?>
            </div>
            <?php unset($_SESSION['form_success']);
            } ?>
            <form id='journal_publish_form' method="POST" action="../backend.php" enctype="multipart/form-data">
                <input type="hidden" name='publish_journal_submit' value="aPanel.php" />
                <div class="row" id="resub_title">
                    <h6>Journal Title:</h6>
                    <div class="col-12 form-group formhide">
                        <input type="text" id="journal-title" name="journal-title" placeholder="Journal Title"
                            class="form-control validate" value="">
                        <span class="validation-error" id="journal-title-error"></span>
                    </div>
                </div>
                <div class="row" id="resub_title">
                    <div class="form-group col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <h6>Authors Name:</h6>
                        <input type="text" id="authors-name" name="authors-name"
                            placeholder="Authors Name (separated by commas)" class="form-control validate" value="">
                        <span class="validation-error" id="authors-name-error"></span>
                    </div>
                    <div class="form-group col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <h6>Manuscript ID : </h6>
                        <input type="text" id="manuscript-id" name="manuscript-id" placeholder="Manuscript ID"
                            class="form-control col-md-12 validate" value="">
                        <span class="validation-error" id="manuscript-id-error"></span>
                    </div>
                </div>
                <div class="row" id="resub_title">
                    <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <h6>Volume:</h6>
                        <select class="form-control" name="volume" id='volume'>
                            <?php
                                $yArray = ["2017" => "104"];
$current_year = '2018';
for($i=-1;$i<10;$i++) {
    $yr = $current_year + $i;
    $diff = $yr - 2017;
    $currentvol = $yArray["2017"] + $diff;
    $slct = ('2022' == $yr) ? 'selected' : '';
    ?>
                            <option
                                value="<?php echo $currentvol; ?>"
                                <?php echo $slct;?>
                                ><?php echo $currentvol; ?></option>
                            <?php
}
?>
                        </select>
                        <span class="validation-error" id="volume-error"></span>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <h6>Issue:</h6>
                        <select class="form-control" name="issue" id='issue'>
                            <option value="March">1-3 [March]</option>
                            <option value="June">4-6 [June]</option>
                            <option value="September">7-9 [September]</option>
                            <option value="December">10-12 [December]</option>
                            <option value="Special">Special</option>
                        </select>
                        <span class="validation-error" id="issue-error"></span>
                    </div>


                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <h6>DOI : </h6>
                        <div class="form-group">
                            <input type="text" id="doi" name="doi" placeholder="DOI"
                                class="form-control col-md-12 validate" value="">
                            <span class="validation-error" id="doi-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <h6>Start Page : </h6>
                        <div class="form-group">
                            <input type="text" id="page_start" name="page_start" placeholder="Start"
                                class="form-control col-md-12 validate" value="">
                            <span class="validation-error" id="page_start-error"></span>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <h6>End Page : </h6>
                        <div class="form-group">
                            <input type="text" id="page_end" name="page_end" placeholder="End"
                                class="form-control col-md-12 validate" value="">
                            <span class="validation-error" id="page_end-error"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="abstract_row" style="padding:15px;">
                    <h6>Abstract:</h6>
                    <textarea class="form-control col-md-12" name="abstract" id="abstract"></textarea>
                    <span class="validation-error" id="abstract-error"></span>
                </div>
                <div class="row" id="resub_title">
                    <h6>Keywords : </h6>
                    <div class="form-group col-12 formhide">
                        <input type="text" id="keywords" name="keywords" placeholder="Keywords (separated by commas)"
                            class="form-control validate" value="">
                        <span class="validation-error" id="keywords-error"></span>
                    </div>
                </div>
                <div class="row formhide" id="id4">
                    <h6>Journal File:</h6>
                    <div class="file-field form-group col-md-12" id="resub_file">
                        <div class="col-md-12 admin-upload-btn">
                            <input type="file"
                                style="background-color: #d5eeff;width: 100%;padding: 8px;border: 1px dashed;"
                                id="journal-file" name="journal-file" accept=".pdf,.doc,.docx">
                            <span class="validation-error" id="journal-file-error"></span>
                        </div>
                        <p>Note:(doc,docs,pdf only Can upload )</p>
                    </div>
                </div>
                <div class="modal fade" id="pdf-preview">
                    <div class="modal-dialog custom-modal-dialog">
                        <div class="modal-content p-4">
                            <textarea id="myEditor" class="rich-text-editor" name="journal-file-html"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col s12 d-sm-flex justify-content-between">
                        <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:45%;">
                            <input type="button" data-target="#pdf-preview" id="preview-button" data-toggle="modal"
                                class="btn btn-info" style="color:white;width:100%;" value="Show HTML" disabled>
                        </i>
                        <i class="waves-effect waves-light btn-large waves-input-wrapper" style="width:45%;">
                            <input type="submit" id="publish_journal_submit_btn" name="journal_submit_button"
                                class="btn" style="color:white;min-width:30%;background-color: #FF005B;width:100%;">
                        </i>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.getElementById('journal-file').addEventListener('change', function(e) {
        $(".loader-mask").show();
        var file = e.target.files[0];
        var formData = new FormData();
        formData.append('file', file);

        $.ajax({
            url: './upload.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.htmlContent) {
                    tinymce.get('myEditor').setContent(response.htmlContent);
                    document.getElementById('preview-button').disabled = false;
                }
                $(".loader-mask").hide();
            },
            error: function(error) {
                console.log(error);
                tinymce.get('myEditor').setContent("");
                document.getElementById('preview-button').disabled = true;
                $(".loader-mask").hide();
            }
        });

    });


    $(document).ready(function() {

        tinymce.init({
            selector: '#myEditor',
            height: "700px",
            statusbar: false,
            content_style: "div { position: relative; margin: 1em 0px; } p { position: absolute; white-space: pre; margin: 0 }",
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });

        $(".validation-error").prev().keyup(function() {
            $(this).next().hide();
            $(".form-error, .form-success").hide();
        });
        $("#journal-file").change(function() {
            $(".form-error, .form-success").hide();
        });
        $('#journal_publish_form').submit(function(e) {
            $(".loader-mask").show();
            $(".validation-error").empty().hide();
            var error = 0;
            //Title validation
            $title_regex = "[^.*$]{5,}";
            if (!$("#journal-title").val().match($title_regex)) {
                $("#journal-title-error").html("Journal title must contain atleast 5 characters")
                    .show();
                error = 1;
            }
            //Authors Validation
            $author_regex = "[^.*$]{5,}";
            if (!$("#authors-name").val().match($author_regex)) {
                $("#authors-name-error").html("Authors name must contain atleast 3 characters").show();
                error = 1;
            }
            //Volume validation
            $volume_regex = "^[0-9]{3,5}$";
            if (!$("#volume").val().match($volume_regex)) {
                $("#volume-error").html("Volume is numeric and must contain atleast 3 characters")
                    .show();
                error = 1;
            }
            //Issue Validation
            $issue_regex = "[^.*$]{3,}";
            if (!$("#issue").val().match($issue_regex)) {
                $("#issue-error").html("Issue must contain atleast 5 characters").show();
                error = 1;
            }
            //Abstract Validation
            $abstract_regex = "[^.*$]{100,}";
            var abstract = $.trim($("#abstract").val());
            if (!abstract.match($abstract_regex)) {
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
            if (error == 1) {
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php include_once('footer.php');
?>
