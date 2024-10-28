<?php
include_once('chief_header.php');
$doc_data = $db->query("SELECT *  FROM tbl_reviwer_ceditor_doc WHERE ceditor_id='83' AND status = 'Active'");
$filePath =  APP_URL."store_file".DIRECTORY_SEPARATOR."reviwer_upload".DIRECTORY_SEPARATOR;
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
                <h1>Reviwer Documents</h1>
                <ol class="breadcrumb">
                    <li class="item"><a href="dashboard-analytics.html"><i class='bx bx-home-alt'></i></a></li>
                    <li class="item"></li>
                </ol>
            </div>
            
            <div class="row">
                <div class="col-md-12">
               		    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Document Name</th>
                                <th>Date</th>
                                <th>View Doc</th>
                                <th>Download</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                        <?php 
                        
                        
                        if(!empty($doc_data->rows)){
                            foreach($doc_data->rows as $index => $data){
                             
                                $i = "1";
                             ?>
                                         
                       
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data->doc_name;?></td>
                                <td><?php echo $data->created_date;?></td>
                                <td style="text-align: center"><img src="assets/img/doc-icon.png" data-toggle="modal" data-target="#view-doc" style="width:16px" /></td>
                                <td style="text-align: center"><a href="<?php echo $filePath?><?php echo $data->doc_name;?>" target="_blank"><img src="assets/img/download.png" style="width:16px"  /></a></td>
                               
                              
                            </tr>
                            
                           <?php $i++; } } ?>
                        </tbody>
                        
                    </table>               

                </div>
            </div>
           
   <div class="modal fade" id="view-doc" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document" style="max-width:70%">
        <div class="modal-content">
            <div class="modal-header">
               
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
             <iframe style='width: 900px; height: 900px;' src='https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $filePath;?>MAJ_work_flow_0643451949253558.docx' width='320' height='240' frameborder='0'></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                
            </div>
        </div>
    </div>
</div>   
<?php include_once('footer.php');?>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>      
<script>
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>