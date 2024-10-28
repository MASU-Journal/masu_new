<?php
include_once('manager_header.php');
include_once('controller/PublisherController.php');
$data = getAllPublishedPapers();
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
</style>
            <!-- Breadcrumb Area -->
            
            <?php if(!empty($_SESSION['form_error'])){ ?>
              <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
            <?php unset($_SESSION['form_error']); } ?>
            <?php if(!empty($_SESSION['form_success'])){ ?>
              <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
            <?php unset($_SESSION['form_success']); } ?>
            <?php if(!empty($_SESSION['form_warning'])){ ?>
              <div class="alert alert-warning" role="alert"><?php echo $_SESSION['form_warning']; ?></div>
            <?php unset($_SESSION['form_warning']); } ?>
            <div class="card mb-30 collapse-card-box">
                <div class="row card-header justify-content-between">
                    <div style="display: inline-block;" class="col-8"><h3>Published Journals</h3></div>
                    <div style="display: inline-block;" class="col-4">
                      <div class="form-group">
                        <input class="form-control" type="text" name="search" id="search" placeholder="Type here to Search..">
                      </div>
                    </div>
                </div><br>
                <div class="card-body">
                    <div class="faq-accordion p-0">
                        <ul class="accordion">
                          <?php foreach($data as $index => $row) { ?>
                            <li class="accordion-item articles" data="<?php if(!empty($row->manuscript_id)) { ?><?php echo strtolower($row->manuscript_id); ?> - <?php } echo strtolower($row->title); ?>">
                                <a class="accordion-title" href="javascript:void(0)">
                                    <i style="background-color: #2ec4b6;" class="bx bx-plus"></i>
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php if(!empty($row->manuscript_id)) { ?><span style="color:#619b8a;"><?php echo $row->manuscript_id; ?></span> - <?php } echo $row->title; ?>
                                      </div>
                                    </div>
                                </a>
                                <p class="accordion-content">
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Author
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->authors; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Manuscript ID
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->manuscript_id; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Volume
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->volume; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Issue
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->issue; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Abstract
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->abstract; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Keywords
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->keywords; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        DOI
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo $row->doi; ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        Published At
                                      </span>
                                      <span class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <?php echo date("d-m-Y", strtotime($row->created_at)); ?>
                                      </span>
                                    </span>
                                    <span class="row">
                                      <span style="text-align: right;" class="col-lg-12 col-md-12 col-sm-2 col-xs-2">
                                        <a href="edit-published-journal.php?journal-id=<?php echo $row->id; ?>">
                                          <button type="button" class="btn btn-danger">Edit Paper</button>
                                        </a>
                                      </span>
                                    </span>
                                </p>
                            </li>
                          <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
              $(document).ready(function(){
                  function isEmpty(value){
                      value = $.trim(value);
                      if(value != '' && value != null && value != undefined){
                          return false;
                      }
                      return true;
                  }
                  $("#search").keyup(function(){
                      var needle = $(this).val().toLowerCase();
                      if(isEmpty(needle)){
                        $( ".articles" ).show();  
                      } else {
                        $( ".articles" ).hide();
                        $( ".articles" ).each(function( index ) {
                            var hayStack = $(this).attr('data');
                            if(hayStack.includes(needle)){
                              $(this).show();
                            }
                        });
                      }
                  });
              });
            </script>
<?php include_once('footer.php');