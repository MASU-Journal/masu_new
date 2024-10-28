<?php
include_once('manager_header.php');
$doc_data = $db->query("SELECT *  FROM tbl_news_event where status='active'");

?>

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
 

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
                <h1>News & Event</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="dashboard-analytics.html"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item"></li>
                </ol>
            </div>
            <div>
              <div class="row">
                <div class="col-md-12">
               <?php if(!empty($_SESSION['form_error'])){ ?>
                                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['form_error']; ?></div>
                                    <?php unset($_SESSION['form_error']); } ?>
                                    <?php if(!empty($_SESSION['form_success'])){ ?>
                                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['form_success']; ?></div>
                                    <?php unset($_SESSION['form_success']); } ?> 
          <form id='newsEventForm' method="POST" action="../manager_functions.php" enctype="multipart/form-data">
            <input type="hidden" name='action'  value="newsEvent" />
            <div class="file-field input-field" id="resub_file">
                           
                            <input type="text" style="width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="newsevent" name="newsevent" required placeholder="Enter News">
                          
                            
                        </div>
                        <br/>
                        <div class="file-field input-field" id="resub_file">
                            <div class="admin-upload-btn">
                            <input type="file" style="background-color: #EAF6FF;width: 100%;padding: 8px;border: 1px solid #BFE3FF;" id="docFile" name="docFile">
                            </div>
                            <p class="text-muted">PDF File only (Maximum 5 MB)</p>
                        </div>
                        <span style="color:green" class="successMsg"></span>
                        <span style="color:red" class="errorMsg"></span>
                        <br />
                        <div class="text-right">
                            <button type="button" id="newsEventSubmit" class="btn btn-success">Save</button>
                        </div>
          </form>                    

                </div>
              </div>
            </div>
            <br/><br/>
            <hr/>
            <div class="row">
                <div class="col-md-12">
               		    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>News</th>
                                <th>Status</th>
                                <th>Action</th>
                               
                                
                            </tr>
                        </thead>
                         <tbody>
                        <?php 
if (!empty($doc_data->rows)) {
    $i = 1; // Initialize the serial number outside the loop
    foreach ($doc_data->rows as $index => $data) {
?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data->details; ?></td>
            <td><?php echo $data->status; ?></td>
            <td style="text-align: center"><a href="#" onclick="deleteNews(<?php echo $data->id; ?>)"><img src="assets/img/deleteicon.png" style="width:16px"  /></a></td>
        </tr>
<?php
        $i++; // Increment the serial number
    }
}
?>
                        </tbody>
                        
                    </table>               

                </div>
            </div>
           
   <?php include_once('footer.php');?>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>      
<script>
$(document).ready(function() {
    $('#example').DataTable()

    ;
    $("#newsEventSubmit").click(function(e){
                e.preventDefault();
                var newsVal = $('#newsevent').val();
                console.log(newsVal);
                //return false;
                $('.successMsg').html('');
                 $('.errorMsg').html('');
                
                if(newsVal ==''){
                  $('.errorMsg').html('Please Enter news');
                  return false;
                }
              

                $(".loader-mask").show();
            $(".validation-error").empty().hide();
            var error = 0;
            
             $doc_file = "[^.*$]{1,}";
            if(!$("#docFile").val().match($doc_file)) {
               $(".errorMsg").html("Please select a file").show();
               error = 1;
            }
            
            if(error == 1){
                $(".loader-mask").hide();
                e.preventDefault();
                return false;
            } else {
                $("#newsEventForm").submit();
            }
    });
   
} );


function deleteNews(newsId){

  if (confirm("Are you sure want to delete this News?")) {
        $.ajax({
                    type: 'POST',
                    url: '../manager_functions.php',
                    data: {
                        newsId : newsId,
                        action : 'newsEventDelete'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                       // $("#verified-and-approve").attr("disabled");
                    },
                    success : function(response){ 
                      console.log(response);
                        $('.successMsg').html("News Deleted Successfully");
                         $('#flashnews').val('');
                         location.reload();
                    },
                    error : function(response){
                        console.log(response);
                     
                    }
                });
    }
    return false;

}
</script>