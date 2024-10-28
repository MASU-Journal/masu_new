<?php
include 'connection.php';
require_once("pagination.class.php");

$perPage = new PerPage();
$sql=$_POST['sql'];

$paginationlink = "pagination.php?page=";
$pagination_setting ="getall";
$page = 1;
if(!empty($_GET["page"])) {
$page = $_GET["page"];
}

$start = ($page-1)*$perPage->perpage;
if($start < 0) $start = 0;

$query =  $sql . " limit " . $start . "," . $perPage->perpage; 
echo $query;
die;
//$faq = $db_handle->runQuery($query);
$package_result=mysqli_query($con,$query);
$package_qry=mysqli_query($con,$sql);

if(empty($_GET["rowcount"])) {
$_GET["rowcount"] = $package_qry->num_rows;
}

if($pagination_setting == "prev-next") {
	$perpageresult = $perPage->getPrevNext($_GET["rowcount"], $paginationlink,$pagination_setting);	
} else {
	$perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);	
}
?>
                
						<div class="property-wrap mb-20">
                            <?php if($package_result->num_rows > 0 ) { while ($row=mysqli_fetch_assoc($package_result)){	?>
                                <div class="ppt-list list-vw mb-30">
									<figure>
										<span class="tag left text-uppercase bg-dark">Rs <?php echo $row['price']; ?></span>
										<span class="tag right text-uppercase bg-blue">for <?php echo $row['main_category_name']; ?></span>
										<a href="<?php echo 'propertyview.php?package_id='.$row['property_id']; ?>" class="image-effect overlay">
											 <img src="<?php echo 'backend/'.$row['image_file']; ?>" alt="" />
										</a>
									</figure>
                                <!--fig-->
							
									<div class="content">
										<h4 class="mb-0"><a href="#"><?php echo $row['project_name']; ?></a></h4>
										<div class="mb-15"><?php echo  $row['locality'].'/'.$row['city_name']; ?></div>
										<div class="content-wrap">
											<?php if($row['category_id']==1 ||  $row['category_id']==2) { ?>
											   <div class="form-group1 select">
												 <label>BUILD AREA</label>
												   <p><?php echo $row['build_feet_name']; ?></p>
												</div>
												<div class="form-group1 select">
												 <label>CARPET AREA</label>
												   <p><?php echo $row['carpet_feet_name']; ?></p>
												</div>
											<?php } ?>
											<?php if($row['category_id']==3) { ?>
											   <div class="form-group2 select">
												 <label>PLOT AREA</label>
												   <p><?php echo $row['plot_feet_name']; ?></p>
												</div>
											<?php } ?>
										  <?php if($row['category_id']==1 ||  $row['category_id']==2) { ?>
										   <div class="form-group1 select">
											 <label>STATUS</label>
											   <p><?php echo $row['construction_status_name']; ?></p>
										  </div>
										  <div class="form-group1 select">
											   <label>FLOOR</label>
											   <p><?php echo $row['floor_num']; ?> out of <?php echo $row['floor']; ?> floor</p>
										  </div>
										  <?php } ?>
										</div>
										<!--content-->

										<a href="<?php echo 'propertyview.php?package_id='.$row['property_id']; ?>" class="btn btn-sucess faa-parent animated-hover" style="margin-top: 12px;color: black;background-color: #ef6c36;">
											View Details <i class="fa fa-long-arrow-right faa-passing"></i>
										</a>
									</div>
                                <!--content-->

									<div class="info">
										<?php if($row['category_id']==1 ||  $row['category_id']==2) { ?>
										<ul>
											
											<li>Furnished Status &nbsp;&nbsp;-&nbsp;&nbsp; <span><?php echo $row['furnishing_name']; ?></span></li>
											<li>Facing &nbsp;&nbsp;-&nbsp;&nbsp; <span><?php echo $row['facing_name']; ?></span></li>
											<li>Bathroom &nbsp;&nbsp;-&nbsp;&nbsp; <span><?php echo $row['bathroom']; ?> </span></li>
											<li>Bedroom &nbsp;&nbsp;-&nbsp;&nbsp; <span></span><?php echo $row['bedroom']; ?></span> </li>
										</ul>
										<?php } ?>
										<a  href="javascript:void(0);" id='<?php echo $row['agent_email']; ?>' class="btn btn-link pull-right agent_eng_send">
										<input type='hidden' value="<?php echo $row['title']; ?>" name="property" id='propert_name' />
											<i class="fa fa-user"><?php echo ' '.$row['agent_role']; ?> </i>
										</a>
										
									</div>
                            </div>
							<?php } } else {?>
				            <div class="property-wrap mb-20">
					           <div class="alert alert-info">
						         <strong>Sorry!</strong>  No Results Found
					           </div>
				            </div>
			                <?php } ?>
                            <!--single property-->
                        <!--property list-->
                        
                           <div id="pagination"><?php echo $perpageresult; ?></div>
							<div id="pagination-result" style="display:none" >
							<?php echo $_GET["rowcount"]; ?>
							</div>
							
                       </div>
						
				