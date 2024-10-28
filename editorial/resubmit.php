<?php
include_once('header.php');
if(empty($_GET['ref'])){
    header("Location:dashboard.php");exit;
    ob_end_clean();
}
$id = trim($_GET['ref']);
$que_qry = $db->query("SELECT status,manuscript_id FROM tbl_journal WHERE id='$id'");
if(!empty($que_qry->count)){
    if($que_qry->row->status != '2' && $que_qry->row->status != '4' && $que_qry->row->status != '7'){
        header("Location:dashboard.php");exit;
        ob_end_clean();
    }
} else {
    header("Location:dashboard.php");exit;
    ob_end_clean();
}
?>
<style type="text/css">
    .notification-btn .badge-secondary{
        background: #e1000a;
        -webkit-animation: pulse-secondary 1.5s infinite;
        animation: pulse-secondary 1.5s infinite;
        -webkit-box-shadow: 0 0 0 rgba(255, 0, 10, 0.9);
        box-shadow: 0 0 0 rgba(255, 0, 10, 0.9);
    }
    .notification-btn .badge {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 50%;
        font-size: 9px;
        line-height: 12px;
    }
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #ff4365;
    }
    /*.journal-title{
        border-bottom: 1px solid #101010 !important;
    }*/
</style>
    <!-- Breadcrumb Area -->
    <div class="breadcrumb-area">
        <h1>Dashboard</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="dashboard-analytics.html"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Resubmit Form</li>
        </ol>
    </div>
    <div class="card mb-30">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Resubmit Journal - <?php echo $que_qry->row->manuscript_id; ?></h3>
        </div>
        <div class="card-body">
            <?php if(!empty($_SESSION['form_error'])){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
            <?php unset($_SESSION['form_error']); } ?>
            <?php if(!empty($_SESSION['form_success'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
            <?php unset($_SESSION['form_success']); } ?>
            <form id="resubmit-form" method="post" action="../journal_submit.php" enctype="multipart/form-data">
                <input type="hidden" name="journal_resubmit" value="1">
                <input type="hidden" name="journal_id" value="<?php echo $id;?>">
                <div class="alert alert-warning" role="alert">
                Kindly highlight the changes in revised manuscript (<span class="text-danger"><b>RED</b></span> color text)
                </div>
                <h6><b>Title File : </b></h6>
                <div class="file-field input-field" id="title_file">
                    <div class="admin-upload-btn">
                    <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="title-file" name="title-file">
                    </div>
                    <p class="text-muted">Word only</p>
                </div>
                <h6><b>Blinded Manuscript : </b></h6>
                <div class="file-field input-field" id="resub_file">
                    <div class="admin-upload-btn">
                    <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="journal-file" name="journal-file">
                    </div>
                    <p class="text-muted">Word only</p>
                </div>
                <div class="alert alert-primary" role="alert">
                <span class="text-danger"><b>Mandatory Note : </b></span> Kindly reply to the reviewer's comment on the <a href="chat.php?ref=<?php echo $que_qry->row->manuscript_id; ?>">chatbox</a>
                </div>
                <div class="col-md-12 text-right">
                    <a href="dashboard.php"><button type="button" class="btn btn-info" id="back-2-dashboard">Cancel</button></a>
                    <button type="submit" class="btn btn-success" id="resubmit-btn">Resubmit Article</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End -->
    <div class="flex-grow-1"></div>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#journal-file").change(function(){
                $(".alert-danger").css("display","none");
            });
            $("#title-file").change(function(){
                $(".alert-danger").css("display","none");
            });
        });
    </script>
<?php include_once('footer.php');