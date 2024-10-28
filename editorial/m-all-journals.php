<?php
include_once('manager_header.php');

$manuscript_id = '';
$status = '';
$man_cond = '';
$status_cond = " AND status > '-1'";
if(!empty($_GET['ref'])){
  $manuscript_id = trim($_GET['ref']);
  $man_cond = " AND manuscript_id = '$manuscript_id'";
}

if(!empty($_GET['article_position'])){
  $article_position = trim($_GET['article_position']);
  if($article_position == 'ns') $status = '0';
  else if($article_position == 'ma') $status = '1';
  else if($article_position == 'sbtam') $status = '2';
  else if($article_position == 'wba') $status = '3';
  else if($article_position == 'sbtac') $status = '4';
  else if($article_position == 'rrtr') $status = '12';
  else if($article_position == 'rdtr') $status = '11';
  else if($article_position == 'atr') $status = '5';
  else if($article_position == 'rr') $status = '6';
  else if($article_position == 'cr') $status = '7';
  else if($article_position == 'ra') $status = '8';
  else if($article_position == 'frbc') $status = '9';
  else if($article_position == 'abc') $status = '10';
  $status_cond = " AND status = '$status'";
}

$journal_data = $db->query("SELECT id, title, author, affiliation, subject, type, year, status, manuscript_id, resubmitted FROM tbl_journal WHERE 1=1 $man_cond $status_cond");

$autor_data = $db->query("SELECT co.first_name, co.last_name,tj.id FROM tbl_journal tj INNER JOIN tbl_co_author co ON (tj.id = co.journal_id) WHERE  tj.status > '-1'");
$authors = array();
if(!empty($autor_data->rows)){
  foreach($autor_data->rows as $index => $data){
    $authors[$data->id][] = $data->first_name." ".$data->last_name;
  }
}
//pre($authors,1);
if(!empty($journal_data->rows)){
  foreach($journal_data->rows as $index => $data){
    $assigned_qry = $db->query("SELECT ta.admin_name,tja.journal_id FROM tbl_journal_assigned AS tja INNER JOIN tbl_admin AS ta ON (ta.admin_id = tja.assigned_to) WHERE tja.journal_id = '".$data->id."' AND tja.status='0'");
    if(!empty($assigned_qry->count)){
      foreach($assigned_qry->rows as $k => $rw){
        $assigned_data[$rw->journal_id][] = $rw->admin_name;
      }
    }
  }
}
?>
<style type="text/css">
    .modal{
      z-index : 999999999 !important;
    }
    .no-margin{
        margin : 0 !important;
    }
    .sub-title{
        font-weight: bold;
        color : #29B187;
    }
    .breadcrumb-area .breadcrumb .item {
        display: inline-flex;
        align-items: center;
    }
    .breadcrumb-area .breadcrumb .item::before{
        top : 11px;
    }

/*Progress Bar*/
@-webkit-keyframes myanimation {
  from {
    left: 0%;
  }
  to {
    left: 50%;
  }
}

.checkout-wrap {
  color: #444 !important;
  font-family: 'PT Sans Caption', sans-serif !important;
  margin: 40px auto !important;
  max-width: 1200px !important;
  position: relative !important;
}

ul.checkout-bar {
  margin: 0 20px !important;
}
ul.checkout-bar li {
  color: #ccc !important;
  display: block !important;
  font-size: 16px !important;
  font-weight: 600 !important;
  padding: 14px 20px 14px 80px !important;
  position: relative !important;
}
ul.checkout-bar li:before {
  -webkit-box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
  box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
  background: #ddd !important;
  border: 2px solid #FFF !important;
  border-radius: 50% !important;
  color: #fff !important;
  font-size: 16px !important;
  font-weight: 700 !important;
  left: 20px !important;
  line-height: 37px !important;
  height: 35px !important;
  position: absolute !important;
  text-align: center !important;
  text-shadow: 1px 1px rgba(0, 0, 0, 0.2) !important;
  top: 4px !important;
  width: 35px !important;
  z-index: 999 !important;
}
ul.checkout-bar li.active {
  color: #8bc53f !important;
  font-weight: bold !important;
}
ul.checkout-bar li.active:before {
  background: #8bc53f !important;
  z-index: 99999 !important;
}
ul.checkout-bar li.rejected {
  color: #f71735 !important;
  font-weight: bold !important;
}
ul.checkout-bar li.rejected:before {
  background: #f71735 !important;
  z-index: 99999 !important;
}
ul.checkout-bar li.visited {
  background: #ECECEC !important;
  color: #57aed1 !important;
  z-index: 99999 !important;
}
ul.checkout-bar li.visited:before {
  background: #57aed1 !important;
  z-index: 99999 !important;
}
ul.checkout-bar li:nth-child(1):before {
  content: "1" !important;
}
ul.checkout-bar li:nth-child(2):before {
  content: "2" !important;
}
ul.checkout-bar li:nth-child(3):before {
  content: "3" !important;
}
ul.checkout-bar li:nth-child(4):before {
  content: "4" !important;
}
ul.checkout-bar li:nth-child(5):before {
  content: "5" !important;
}
ul.checkout-bar li:nth-child(6):before {
  content: "6" !important;
}
ul.checkout-bar a {
  color: #57aed1 !important;
  font-size: 16px !important;
  font-weight: 600 !important;
  text-decoration: none !important;
}

@media all and (min-width: 800px) {
  .checkout-bar li.active:after {
    -webkit-animation: myanimation 3s 0 !important;
    background-size: 35px 35px !important;
    background-color: #8bc53f !important;
    background-image: -webkit-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    -webkit-box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    content: "" !important;
    height: 15px !important;
    width: 100%;
    left: 50% !important;
    position: absolute !important;
    top: -50px !important;
    z-index: 0 !important;
  }

  .checkout-wrap {
    /*margin: 80px auto !important;*/
  }

  ul.checkout-bar {
    -webkit-box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    background-size: 35px 35px !important;
    background-color: #EcEcEc !important;
    background-image: -webkit-linear-gradient(-45deg, rgba(255, 255, 255, 0.4) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.4) 75%, transparent 75%, transparent) !important;
    background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.4) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.4) 50%, rgba(255, 255, 255, 0.4) 75%, transparent 75%, transparent) !important;
    border-radius: 15px !important;
    height: 15px !important;
    margin: 0 auto !important;
    padding: 0 !important;
    position: absolute !important;
    width: 100% !important;
  }
  ul.checkout-bar:before {
    background-size: 35px 35px !important;
    background-color: #57aed1 !important;
    background-image: -webkit-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    -webkit-box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    border-radius: 15px !important;
    content: " " !important;
    height: 15px !important;
    left: 0 !important;
    position: absolute !important;
    width: 10% !important;
  }
  ul.checkout-bar li {
    display: inline-block !important;
    margin: 50px 0 0 !important;
    padding: 0 !important;
    text-align: center !important;
    width: 19% !important;
  }
  ul.checkout-bar li:before {
    height: 45px !important;
    left: 40% !important;
    line-height: 45px !important;
    position: absolute !important;
    top: -65px !important;
    width: 45px !important;
    z-index: 99 !important;
  }
  ul.checkout-bar li.visited {
    background: none !important;
  }
  ul.checkout-bar li.visited:after {
    background-size: 35px 35px !important;
    background-color: #57aed1 !important;
    background-image: -webkit-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    background-image: -moz-linear-gradient(-45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent) !important;
    -webkit-box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    box-shadow: inset 2px 2px 2px 0px rgba(0, 0, 0, 0.2) !important;
    content: "" !important;
    height: 15px !important;
    left: 50% !important;
    position: absolute !important;
    top: -50px !important;
    width: 100%;
    z-index: 99 !important;
  }
  .last:after {
    width : 68% !important;
  }
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
        <h1>All Manuscripts</h1>
        <ol class="breadcrumb" style="width: 100%;">            
            <li class="item text-right" style="width: 100%;">
                <form action="#" method="get" style="width: 100%;">
                    <input placeholder="Search by Manuscript ID" class="col-lg-3 col-md-3 col-xs-12 col-sm-12 form-control d-inline-block" type="text" name="ref" id="manuscript_id" value="">
                    <select class="col-lg-3 col-md-3 col-xs-12 col-sm-12 form-control d-inline-block" name="article_position">
                      <option value="">--Search by Status--</option>
                      <option value="ns">Newly Submitted</option>
                      <option value="ma">Manager Approved</option>
                      <option value="sbtam">Sent back to author(From Manager)</option>
                      <option value="wba">Withdrawn by Author</option>
                      <option value="sbtac">Sent back to author(From Chief)</option>
                      <option value="rrtr">Reviewer Requested to Review</option>
                      <option value="rdtr">Reviewer Declined to Review</option>
                      <option value="atr">Assigned to Reviewers</option>
                      <option value="rr">Reviewer Revised</option>
                      <option value="cr">Chief Revised</option>
                      <option value="ra">Reviewer Approved</option>
                      <option value="frbc">Final Reject by Chief</option>
                      <option value="abc">Approved by Chief(Published)</option>
                    </select>
                    <button class="d-inline-block btn btn-info" type="submit">Search</button>
                </form>
            </li>
        </ol>
      </div>
            <?php if(!empty($_SESSION['form_error'])){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
            <?php unset($_SESSION['form_error']); } ?>
            <?php if(!empty($_SESSION['form_success'])){ ?>
                <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
            <?php unset($_SESSION['form_success']); } ?>
            
<?php 
if(!empty($journal_data->rows)){
    foreach($journal_data->rows as $index => $data){ ?>
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
                      <?php if(!empty($assigned_data[$data->id])){ ?>
                      <div class="row">
                      <div class="col-md-2">
                        <span class="text-justify no-margin">
                          <span class="sub-title">Assigned to : </span>
                        </span>
                      </div>
                      <div class="col-md-10">
                          <span class="text-justify no-margin">
                              <?php                              
                                echo implode(" , ",$assigned_data[$data->id]);
                              ?>
                          </span>
                        </div>
                      </div>
                    <?php } ?>
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
                            
                              <a href="view-journal.php?manuscript=<?php echo $data->id; ?>">
                                <button class="btn btn-success">View Article</button>
                              </a>
                            </span>
                        </div>
                      </div>
                </div>
                <div class="card-body" style="padding : 5px 25px; background-color: #FFFFFF;">
                  <div class="card-body mb-30">
                      <div style="display: block;" class="checkout-wrap">
                        <ul class="checkout-bar">
                          <?php
                          $c1 = $c2 = $c3 = $c4 = $c5 = '';
                          $c1_text = ($data->resubmitted > 0) ? "Resubmitted" : "Submitted";
                          $c2_text = "Quality Check";
                          $c4_text = "Article Approved";
                          $c3_text = "Assigned";
                          if($data->status == 2 || $data->status == 4){
                            $c1 = "visited";
                            $c2 = "rejected";
                            $c2_text = "Rejected at QC";
                          } else if($data->status < 3){
                            $c1 = "active";
                          } else if($data->status == 12){
                            $c1 = "visited";
                            $c2 = "active";
                            $c2_text = "Reviewer Requested";
                          } else if($data->status == 11){
                            $c1 = "visited";
                            $c2 = "rejected";
                            $c2_text = "Reviewer Declined";
                          } else if($data->status == 11 || $data->status == 12){
                            $c1 = "visited";
                            $c2 = "active";
                          } else if($data->status == 9){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "visited";
                            $c4 = "rejected";
                            $c4_text = "Article Rejected";
                          } else if($data->status == 5){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "active";
                          } else if($data->status == 6){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "rejected";
                            $c3_text = "Reviewer Revised";
                          } else if($data->status == 7){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "rejected";
                            $c3_text = "Revised to Author";
                          } else if($data->status >= 8 && $data->status < 10){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "visited";
                            $c4 = "active";
                          } else if($data->status >= 10){
                            $c1 = "visited";
                            $c2 = "visited";
                            $c3 = "visited";
                            $c4 = "visited";
                            $c5 = "active";
                           
                          }
                          ?>
                          <li class="first <?php echo $c1; ?>">
                            <a href="#"><?php echo $c1_text; ?></a>
                          </li>                        
                          <li class="<?php echo $c2; ?>"><?php echo $c2_text; ?></li>
                          <li class="<?php echo $c3; ?>"><?php echo $c3_text; ?></li>
                          <li class="<?php echo $c4; ?>"><?php echo $c4_text; ?></li>
                          <li class="<?php echo $c5; ?> last">Published</li>
                        </ul>
                      </div>
                    </div>
                    <div class="text-right j-btn-section">
                      <button class="btn btn-success" style="visibility: hidden;">View Forum</button>
                    </div>
                </div>
            </div>
   <?php }
} else { ?>
            <div class="card mb-30" style="display: block;min-height:300px;">
              <div class="mt-30 card-header d-flex justify-content-between align-items-center journal-title" style="text-align: center;margin-top:80px;">
                  <h3>No Articles Available..!</h3>
              </div>                
            </div>

<?php
}
?>
<?php include_once('footer.php');