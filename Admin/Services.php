<?php    
define('TITLE', 'Services');
define('PAGE', 'Services');
include('includes/header.php'); 
include('../dbConnection.php');

if(session_id() == '') {
  session_start();
}
if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
 echo "<script> location.href='login.php'; </script>";
}

 //  Assign work Order Request Data going to submit and save on db assignwork_tb table
 if(isset($_REQUEST['assign'])){
  // Checking for Empty Fields
  if(($_REQUEST['Service_Name'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
    // Assigning User Values to Variable
    //$rid = $_REQUEST['request_id'];
    $sname = $_REQUEST['Service_Name'];
   
    $sql = "INSERT INTO services_tb (Service_Name) VALUES ('$sname')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Work Assigned Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Assign Work </div>';
    }
  }
  }
 // Assign work Order Request Data going to submit and save on db assignwork_tb table [END]
 ?>
<div class="col-sm-4 mt-5 jumbotron">
  <!-- Main Content area Start Last -->
  <form action="" method="POST">
    <h5 class="text-center">Add services</h5>
   
    <div class="form-group">
      <label for="Service_Name">Service Name</label>
      <input type="text" class="form-control" id="Service_Name" name="Service_Name">
    </div>
    <div class="float-right">
      <button type="submit" class="btn btn-success" name="assign">Add</button>
      <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
    
  </form>
  <!-- below msg display if required fill missing or form submitted success or failed -->
  <?php if(isset($msg)) {echo $msg; } ?>
</div> <!-- Main Content area End Last -->


<div class="col-sm-5 mt-5">
  <!--Table-->
  <p class=" bg-dark text-white p-2">List of Services</p>
  <?php
    $sql = "SELECT * FROM services_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table">
  <thead>
   <tr>
    <th scope="col">Service ID</th>
    <th scope="col">Service Name</th>
    <th scope="col">Action</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["ID"].'</th>';
    echo '<td>'. $row["Service_Name"].'</td>';
    echo '<td><form action="editservice.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["ID"] .'><button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button></form>  
    <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["ID"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }

 echo '</tbody>
 </table>';
} else {
  echo "0 Result";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM services_tb WHERE ID = {$_REQUEST['id']}";
  if($conn->query($sql) === TRUE){
    // echo "Record Deleted Successfully";
    // below code will refresh the page after deleting the record
    echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
    } else {
      echo "Unable to Delete Data";
    }
  }
?>
</div>

<!-- Only Number for input fields -->
<?php 
  include('includes/footer.php'); 

?>