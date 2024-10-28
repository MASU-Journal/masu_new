<?php
include_once('editor-header.php');
$assigned_journals = array();
$assigned_date = array();
$assigned_query = $db->query("SELECT journal_id,assigned_date FROM tbl_journal_assigned WHERE assigned_to='".$_SESSION['admin_id']."' AND status='0'");
// pre($_SESSION,0);
// pre($assigned_query,1);
if($assigned_query->count > 0){
  foreach($assigned_query->rows as $index => $data){
    $assigned_journals[] = $data->journal_id;
    $assigned_date[$data->journal_id] = $data->assigned_date;
  }
}
if(!empty($assigned_journals)){
  $journal_data = $db->query("SELECT id, title, 	journal_random_name, author, affiliation, subject, type, year, status, manuscript_id, resubmitted FROM tbl_journal WHERE status='5' AND id IN ('".implode("','",$assigned_journals)."')");
  $autor_data = $db->query("SELECT co.first_name, co.last_name,tj.id FROM tbl_journal tj INNER JOIN tbl_co_author co ON (tj.id = co.journal_id) WHERE tj.status = '1'");
  $authors = array();
  if(!empty($autor_data->rows)){
    foreach($autor_data->rows as $index => $data){
      $authors[$data->id][] = $data->first_name." ".$data->last_name;
    }
  }
}

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
      color : white;
      padding: 10px 5px 10px 20px;
      font-weight: bold;
      font-size: 18px;
    }
    .title-span {
      margin-top : 5px;
      margin-bottom : 5px;
      color : #195143;
      font-weight: normal;
      font-size: 17px;
    }
    .header-card{
      width : 100%;
      background-color: #ffffff;
    }
    .j-btn-section{
      margin : 20px 30px;
    }
    .btn-row{
      margin-top : 10px;
      padding-right : 50px;
      margin-bottom: 20px;
    }
    .actn-btns{
      width : 100%;
      margin-top : 10px;
      font-size : 13px;
    }
    .editor-notes{
      font-weight: bold;
      color: #233d4d;
    }
    .editor-imp-notes{
      font-weight: bolder;
    }
    .info-sno{
      text-align: right;
    }
    .info-rows{
      margin-top:10px;
    }
</style>
            <!-- Breadcrumb Area -->
            <div class="breadcrumb-area">
                <h1>Pending Journals</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="dashboard-analytics.html"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item">Pending Approval</li>
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
<?php 
$article_count = 0;
if(!empty($assigned_journals) && !empty($journal_data->rows)){
    foreach($journal_data->rows as $index => $data){ 
      $article_count++;

      ?>
      <div>
            <div class="card mb-30" style="display: block;padding: 0px;">
                <div class="card-header d-flex justify-content-between align-items-center journal-title">
                  <div class="header-card">
                    <div class="row">
                      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 manuscript-span sub-title">
                        <span><?php echo $data->manuscript_id; ?></span>
                      </div>
                      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 title-span sub-title">
                        <div class="row">
                          <div class="col-9">
                            <span class="no-margin">
                              <p><strong>Title : </strong><?php echo $data->title; ?></p>
                              <p><strong>Assigned On : </strong><?php echo date("d-m-Y", strtotime($assigned_date[$data->id])); ?></p>
                            </span>
                          </div>
                          <div class="col-3">
                            <div class="col-12">
                              <a href="chat-editor.php?ref=<?php echo $data->manuscript_id; ?>">
                                    <button class="actn-btns btn btn-danger">View Comments</button>
                                </a>
                            </div>
                            <div class="col-12">
                              <a href="e-view-journal.php?manuscript=<?php echo $data->id; ?>"><button class="actn-btns btn btn-success">View Article</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
   <?php }
} else { ?>
            <div class="card mb-30" style="display: block;min-height:300px;">
              <div class="mt-30 card-header d-flex justify-content-between align-items-center journal-title" style="text-align: center;margin-top:80px;">
                  <h3>No Journals are available to check</h3>
              </div>                
            </div>

<?php
}
?>
<?php
  $notes_margin = 0;
  if($article_count == 1){
    $notes_margin = 200;
  } else if($article_count == 2){
    $notes_margin = 100;
  } else if($article_count == 3){
    $notes_margin = 50;
  }

?>

<div class="card mb-30" style="display: block;min-height:100px;margin-top:<?php echo $notes_margin;?>px;background-color: #fcd5ce;">
  <div class="mt-30 card-header d-flex justify-content-between journal-title" style="background-color: #fcd5ce;">
    <div class="row"><div class="col-12"><span class="editor-notes" style="font-size:18px;font-weight:bolder;text-decoration: underline;">Note to reviewer:</span><br><br></div></div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">A)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes">click on <span class="editor-imp-notes"><button class="btn btn-success">View Article</button> ,<button class="btn btn-primary">Download</button> </span>  the article ,mark your reviews on the soft copy(Reviewer document).</span>
      </div>
    </div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">B)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes">click on <span class="editor-imp-notes"><button class="btn btn-danger">View Comments</button>  ,</span>Provide your comments on the chat box, if the question is not applicable to the article ,then please mention NA.</span>
      </div>
    </div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">C)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes">Choose file in the <span class="editor-imp-notes">UPLOAD DOCUMENT TO AUTHOR</span> section, upload your reviewer document.</span>
      </div>
    </div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">D)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes"><span class="editor-imp-notes"><button class="btn btn-warning">Revision Required</button></span> -If the article  requires further revision,upload your comments in the chat box and reviewer document in <span class="editor-imp-notes">UPLOAD DOCUMENT TO AUTHOR</span> section and then click on <span class="editor-imp-notes">Revision Required.</span></span>
      </div>
    </div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">E)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes"><span class="editor-imp-notes"><button class="btn btn-success">Recommended to Publish</button></span> -If the article is satisfactory, Provide your comments on the chat box and click on  <span class="editor-imp-notes">Recommended to Publish.</span></span>
      </div>
    </div>
    <div class="row info-rows">
      <div class="col-1 info-sno">
        <span class="editor-notes">F)</span>
      </div>
      <div class="col-11">
        <span class="editor-notes"><span class="editor-imp-notes"><button class="btn btn-danger">Not Recommended to Publish</button></span>-If the article does not satisfy the standards, state the reason in the chat box and click on <span class="editor-imp-notes">Not Recommended to Publish.</span></span>
      </div>
    </div>
  </div>             
</div>

<?php include_once('footer.php');