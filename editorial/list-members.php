<?php
include_once('manager_header.php');
$qry = "SELECT * FROM tbl_user where 1=1";
$doc_data = $db->query($qry);
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
                <h1>Members List</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="#"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item"></li>
                </ol>
            </div>
            <div class="row" style="background-color: white;">
                <div class="col-md-12">
               		    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Join Date</th>
                                <th>Valid Till</th>
                                <th>Address</th>
                                <th>Bill Number</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if(!empty($doc_data->rows)){
                            $i = 1;
                            foreach($doc_data->rows as $index => $data){
                                
                             ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data->user_instutename;?></td>
                                <td><?php echo $data->user_email;?></td>
                                <td><?php echo $data->user_contact;?></td>
                                <td><?php echo date("d-m-Y", strtotime($data->created_date));?></td>
                                <td><?php echo date("d-m-Y", strtotime($data->valid_date));?></td>
                                <td><?php echo $data->user_address;?></td>
                                <td><?php echo (empty($data->stud_id)) ? "" : $data->stud_id;?></td>
                            </tr>
                            
                           <?php $i++; } } ?>
                        </tbody>
                        
                    </table>               

                </div>
            </div>
           
   <?php include_once('footer.php');?>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>      
<script>
$(document).ready(function() {
    $('#example').DataTable();

    $("#newsSubmit").click(function(){
           
                var newsVal = $('#flashnews').val();
                console.log(newsVal);
                //return false;
                $('.successMsg').html('');
                 $('.errorMsg').html('');
                
                if(newsVal !=''){
                $.ajax({
                    type: 'POST',
                    url: '../manager_functions.php',
                    data: {
                        newsVal : newsVal,
                        action : 'flashNewsUpdate'
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend : function(){
                       // $("#verified-and-approve").attr("disabled");
                    },
                    success : function(response){ 
                      console.log(response);
                        $('.successMsg').html("News Added Successfully");
                         $('#flashnews').val('');
                         location.reload();
                    },
                    error : function(response){
                        console.log(response);
                     
                    }
                });
              }
              else{
 $('.errorMsg').html('Please Enter news');
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
                        action : 'flashNewsDelete'
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