<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['etmsaid']==0)) {
  header('location:logout.php');
  } else{

// Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from tblemployee where ID=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage-employee.php'</script>";     


}

  ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      
      <title>Employee Task Management System || Manage Employee</title>
   
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <!-- site css -->
      <link rel="stylesheet" href="style.css" />
      <!-- responsive css -->
      <link rel="stylesheet" href="css/responsive.css" />
      <!-- color css -->
      <link rel="stylesheet" href="css/colors.css" />
      <!-- select bootstrap -->
      <link rel="stylesheet" href="css/bootstrap-select.css" />
      <!-- scrollbar css -->
      <link rel="stylesheet" href="css/perfect-scrollbar.css" />
      <!-- custom css -->
      <link rel="stylesheet" href="css/custom.css" />
      <!-- calendar file css -->
      <link rel="stylesheet" href="js/semantic.min.css" />
      <!-- fancy box js -->
      <link rel="stylesheet" href="css/jquery.fancybox.css" />
      
   </head>
   <body class="inner_page tables_page">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
          <?php include_once('includes/sidebar.php');?>
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
              <?php include_once('includes/header.php');?>
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Manage Employee</h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                     
                      
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2>Search Employee</h2>
                                 </div>
                              </div>
                              
                              <div class="table_section padding_infor_info">
                                 <h4>Search Employee by Employee ID/Name/Department </h4>
                 <br>
               <form id="basic-form" method="post">
                                <div class="form-group">
                                   
                                    <input id="searchdata" type="text" name="searchdata" required="true" class="form-control" placeholder="Enter Employee ID/Name/Department"></div>
                                
                              
                                <button type="submit" class="btn btn-primary" name="search" id="submit">Search</button>
                            </form>
                                 <div class="table-responsive-sm">
                                    <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>S.No</th>
                                             <th>Department Name</th>
                                             <th>Employee Name</th>
                                             <th>Employee ID</th>
                                             <th>Employee Email</th>
                                             <th>Employee Contact Number</th>
                                             <th>Date of Joining</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php
$sql="SELECT tbldepartment.ID as did, tbldepartment.DepartmentName,tblemployee.ID as eid,tblemployee.DepartmentID,tblemployee.EmpName,tblemployee.EmpId,tblemployee.EmpEmail,tblemployee.EmpContactNumber,tblemployee.EmpDateofjoining from tblemployee join tbldepartment on tbldepartment.ID=tblemployee.DepartmentID where tblemployee.EmpId like '$sdata%' || tblemployee.EmpName like '$sdata%' || tbldepartment.DepartmentName like '$sdata%'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?> 
                                          <tr>
                                              
                                             <td><?php echo htmlentities($cnt);?></td>
                                             <td><?php  echo htmlentities($row->DepartmentName);?></td>
                                             <td><?php  echo htmlentities($row->EmpName);?></td>
                                             <td><?php  echo htmlentities($row->EmpId);?></td>
                                             <td><?php  echo htmlentities($row->EmpEmail);?></td>
                                             <td><?php  echo htmlentities($row->EmpContactNumber);?></td>
                                             <td><?php  echo htmlentities($row->EmpDateofjoining);?></td>
                                             <td width="200"><a href="edit-employee.php?editid=<?php echo htmlentities ($row->eid);?>" class="btn btn-primary btn-sm">View</a>
                                                <a href="manage-employee.php?delid=<?php echo ($row->eid);?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-sm">Delete</a></td>
                                          </tr>
                                          <?php 
$cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
  <?php } }?>

                                         
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- footer -->
                 <?php include_once('includes/footer.php');?>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
         <!-- model popup -->
       
      </div>
      <!-- jQuery -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- wow animation -->
      <script src="js/animate.js"></script>
      <!-- select country -->
      <script src="js/bootstrap-select.js"></script>
      <!-- owl carousel -->
      <script src="js/owl.carousel.js"></script> 
      <!-- chart js -->
      <script src="js/Chart.min.js"></script>
      <script src="js/Chart.bundle.min.js"></script>
      <script src="js/utils.js"></script>
      <script src="js/analyser.js"></script>
      <!-- nice scrollbar -->
      <script src="js/perfect-scrollbar.min.js"></script>
      <script>
         var ps = new PerfectScrollbar('#sidebar');
      </script>
      <!-- fancy box js -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/jquery.fancybox.min.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- calendar file css -->    
      <script src="js/semantic.min.js"></script>
   </body>
</html><?php } ?>