<?php
include 'connection.php';
include 'db.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$role_id=$_SESSION['role_id'];
$user_id=$_SESSION['admin_id'];

$journal_sql = "SELECT tjd.title, tj.journal_id, tj.journal_path, 
                tj.journal_year, tj.user_id, tja.created_date, tja.is_notification_view
                FROM tbl_journal_assign as tja 
                INNER JOIN tbl_journal as tj ON (tja.journal_id = tj.journal_id)
                INNER JOIN tbl_journal_details as tjd ON (tja.journal_id = tjd.journal_id)
                WHERE tja.is_deleted = '0'
                AND tj.is_deleted = '0'
                AND tja.admin_id = '$user_id'
                ORDER BY tja.assign_id DESC";
$journal_data=$db->query($journal_sql);
if(isset($_SESSION['admin_id'])&&$_SESSION['admin_id']!="") {
    include_once 'admin_headers.php' ;
} else {
    include_once 'header.php' ;
}
?>
<title>REVIEWER</title>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
      </div>
      <div class="pull-left info">
        <center>
          <p style="color:#fff"><b>Reviewer</b></p>
        </center>
        <!--<p style="margin-top: -10px;"><a ><i class="fa fa-circle text-success"></i> Online</a></p>-->
      </div>
    </div>
  </section>
  <!-- /.sidebar -->
</aside>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Dashboard<small></small></h1>
    <!--<ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>-->
  </section>
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <!-- TABLE: LATEST ORDERS -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">LATEST REVIEWS</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
            <div class="row filter-row">
              <div class="col-12">
                <button type="button" class="btn btn-default date-filter-btn btn-df-selected" filter-class="df-1"> All
                  Reviews
                </button>
                <button type="button" class="btn btn-default date-filter-btn" filter-class="df-2"> Assigned Today
                </button>
                <button type="button" class="btn btn-default date-filter-btn" filter-class="df-3"> within 7 days
                </button>
                <button type="button" class="btn btn-default date-filter-btn" filter-class="df-4"> within 30 days
                </button>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead style="background-color:#000">
                  <tr>
                    <th style="color:#fff; text-align:center"><b>TITLE</b></th>
                    <th style="color:#fff;text-align:center"><b>COMMANDS</b></th>
                    <th style="color:#fff;text-align:center"><b>ACTION</b></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(count($journal_data->rows)> 0) {
                      foreach($journal_data->rows as $index=>$val) {
                          $new_html = '';
                          $filter_class = "df-1 ";
                          $today = date("Y-m-d");
                          $this_week = date('Y-m-d', strtotime('-7 days'));
                          $this_month = date('Y-m-d', strtotime('-30 days'));
                          $assigned_date = date("Y-m-d", strtotime($val->created_date));
                          if($assigned_date == $today) {
                              $filter_class .= "df-2 ";
                              $new_html = "<span class=\"label label-success\">New</span>";
                          }
                          if($assigned_date > $this_week) {
                              $filter_class .= "df-3 ";
                          }
                          if($assigned_date > $this_month) {
                              $filter_class .= "df-4";
                          }
                        
                          ?>
                  <tr
                    class="all-reviews <?php echo $filter_class; ?>">
                    <td>
                      <?php echo $val->title."  ".$new_html; ?>
                    </td>
                    <td>
                      <a
                        href="<?php echo "review_comments.php?view=journal_commentview&journal_id=".$val->journal_id; ?>" />Command</a>
                    </td>
                    </td>
                    <td><a
                        href="<?php echo 'store_file/user_'.$val->user_id.'_file/'.$val->journal_year.'/'.$val->journal_path; ?>"
                        class="ad-st-view">Download</a></td>
                  </tr>
                  <?php }
                      } else { ?>
                  <tr>
                    <td>There is No Journals Assigneds for You</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include_once 'admin_footer.php'; ?>