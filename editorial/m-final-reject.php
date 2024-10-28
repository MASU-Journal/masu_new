<?php
include_once('manager_header.php');
$journal_data = $db->query("SELECT id, title, author, affiliation, subject, type, year, status, manuscript_id, resubmitted FROM tbl_journal WHERE status='9'");
$autor_data = $db->query("SELECT co.first_name, co.last_name,tj.id FROM tbl_journal tj INNER JOIN tbl_co_author co ON (tj.id = co.journal_id) WHERE tj.status = '0'");
$authors = array();
if(!empty($autor_data->rows)){
  foreach($autor_data->rows as $index => $data){
    $authors[$data->id][] = $data->first_name." ".$data->last_name;
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
</style>
            <!-- Breadcrumb Area -->
            <div class="breadcrumb-area">
                <h1>Pending Journals</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="manager.php"><i class='bx bx-home-alt'></i></a></li>
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
if(!empty($journal_data->rows)){
    foreach($journal_data->rows as $index => $data){ ?>
      <div>
            <div class="card mb-30" style="display: block;padding: 0px;">
                <div class="card-header d-flex justify-content-between align-items-center journal-title">
                  <div class="header-card">
                    <div class="manuscript-span sub-title">
                      <span <?php if(strlen($data->title) > 90) echo ' 
                      style="position: absolute;"'; ?>><?php echo $data->manuscript_id; ?></span>
                    </div>
                    <div class="title-span sub-title">
                      <span class="no-margin">
                        <?php echo $data->title; ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="card-body" style="padding: 10px 25px;">
                    <div class="row journal-info">
                      <div class="col-md-2">
                        <span class="text-justify no-margin">
                          <span class="sub-title">Author : </span>
                        </span>
                      </div>
                      <div class="col-md-10">
                          <span class="text-justify no-margin">
                              <?php echo $data->author; ?>
                              <?php
                              if(!empty($authors[$data->id])){
                                $temp = implode(" , ",$authors[$data->id]);
                                echo " , ".$temp;
                              }
                              ?>
                          </span>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-2">
                        <span class="text-justify no-margin">
                          <span class="sub-title">Affiliation : </span>
                        </span>
                      </div>
                      <div class="col-md-10">
                          <span class="text-justify no-margin">
                              <?php echo $data->affiliation; ?>
                          </span>
                        </div>
                      </div>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center journal-title" style="margin-top : 15px; margin-bottom: 0px;padding : 5px 25px;">
                    <div class="row">
                      <div class="col-md-2">
                        <span class="text-justify no-margin">
                          <span class="sub-title"></span>
                        </span>
                      </div>
                      <div class="col-md-10 text-right">
                          <span class="text-right">
                              <!-- <a href="chat.php?ref=<?php echo $data->manuscript_id; ?>">
                                  <button class="btn btn-danger">View Comments</button>
                              </a> -->
                              <a href="view-journal.php?manuscript=<?php echo $data->id; ?>"><button class="btn btn-success">View Article</button></a>
                          </span>
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
<?php include_once('footer.php');