<?php
include_once('chief_header.php');

$data['pending_submission'] = 0;
$data['submitted'] = 0;
$data['pending_approval'] = 0;
$data['approved_by_manager'] = 0;
$data['approved_by_chief'] = 0;
$data['rejected_by_manager'] = 0;
$data['rejected_by_chief'] = 0;
$data['assigned'] = 0;
$data['total_resubmitted'] = 0;
$data['resubmitted_pending'] = 0;
$data['published'] = 0;
$data['pending_chief_approval'] = 0;
$count_qry = $db->query("SELECT status,resubmitted FROM tbl_journal");
if(!empty($count_qry->rows)){
  foreach($count_qry->rows as $key => $row){
    if($row->status == '0'){
      $data['pending_submission']++;
    } else {
      $data['submitted']++;
    }

    if($row->resubmitted > '0'){
      $data['total_resubmitted']++;
      if($row->status == '0'){
        $data['resubmitted_pending']++;
      }
    }    

    if($row->status == '0'){
      $data['pending_approval']++;
    } else if($row->status == '1'){
      $data['approved_by_manager']++;
      $data['pending_chief_approval']++;
    } else if($row->status == '3'){
      $data['approved_by_chief']++;
    } else if($row->status == '5'){
      $data['assigned']++;
    } else if($row->status == '2'){
      $data['rejected_by_manager']++;
    } else if($row->status == '4' || $row->status == '6'){
      $data['rejected_by_chief']++;
    } else if($row->status == '10'){
      $data['published']++;
    }
  }
}

//pre($data,1);
//pre($journal_data,1);
?>
<style type="text/css">
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
                    <li class="item">Dashboard</li>
                </ol>
            </div>

              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>New Submission</h3>
                        </div>

                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                  <div class="pr-4 border-right">
                                        <p class="mb-1 font-weight-bold text-info">Submission Pending</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['pending_submission']; ?></span>
                                        </h5>
                                    </div>
                                    <div class="px-4">
                                        <p class="mb-1 font-weight-bold text-info">Submitted Journals</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['submitted']; ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Revision / Resent</h3>
                        </div>

                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                    <div class="pr-4 border-right">
                                        <p class="mb-1 font-weight-bold text-danger">Pending for Manager</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['pending_approval']; ?></span>
                                        </h5>
                                    </div>
                                    <div class="px-4">
                                        <p class="mb-1 font-weight-bold text-danger">Pending for Chief Editor</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['pending_chief_approval']; ?></span>
                                        </h5>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Assigned</h3>
                        </div>

                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                    <div class="pr-4 font-weight-bold text-success">
                                        <p class="mb-1">Assigned to Editors</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['assigned']; ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Rejected</h3>
                        </div>

                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                    <div class="pr-4 border-right w50">
                                        <p class="mb-1 font-weight-bold text-danger">by Manager</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['rejected_by_manager']; ?></span>
                                        </h5>
                                    </div>

                                    <div class="px-4 w50">
                                        <p class="mb-1 font-weight-bold text-danger">by Chief</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['rejected_by_chief']; ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Accepted</h3>
                        </div>
                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                    <div class="pr-4 border-right w50">
                                        <p class="mb-1 font-weight-bold text-success">Approved by Manager</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['approved_by_manager']; ?></span>
                                        </h5>
                                    </div>
                                    <div class="px-4 w50">
                                        <p class="mb-1 font-weight-bold text-success">Approved by Chief Editor</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['approved_by_chief']; ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card mb-30">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3>Resubmitted</h3>
                        </div>

                        <div class="card-body">
                            <div class="revenue-summary-content">
                                <div class="d-sm-flex">
                                    <div class="pr-4 font-weight-bold text-info">
                                        <p class="mb-1">Total Resubmitted</p>
                                        <h5 class="mb-0">
                                            <span class="font-weight-bold"><?php echo $data['total_resubmitted']; ?></span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  
                
              </div>
            
<?php 
if(!empty($journal_data->rows)){
    foreach($journal_data->rows as $index => $data){ ?>
            <div class="card mb-30" style="display: block;">
                <div class="card-header d-flex justify-content-between align-items-center journal-title">
                    <h3><?php echo $data->title; ?></h3>
                </div>
                <div class="card-body">
                    <p class="text-justify no-margin"><span class="sub-title">Author : </span><br><?php echo $data->author; ?></p>
                    <p class="text-justify no-margin"><span class="sub-title">Affiliation : </span><br><?php echo $data->affiliation; ?></p>
                </div>
                <div class="card-header d-flex justify-content-between align-items-center journal-title" style="margin-top : 15px; margin-bottom: 0px;">
                    <h6 class="sub-title">Status</h6>
                </div>
                <div class="card-body">
                  <div class="card-body mb-30">
                      <div style="display: block;" class="checkout-wrap">
                        <ul class="checkout-bar">
                          <li class="first visited">
                            <a href="#">Submitted</a>
                          </li>                        
                          <li class="visited">Quality Check</li>
                          <li class="active">Assigned</li>
                          <li class="">Journal Approved</li>
                          <li class="">Published</li>
                        </ul>
                      </div>
                    </div><br><br>
                    <p class="text-right no-margin"><button class="btn btn-success">View Forum</button></p>
                </div>
            </div>
   <?php }
}
?>
<?php include_once('footer.php');