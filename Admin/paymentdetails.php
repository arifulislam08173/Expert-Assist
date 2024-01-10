<?php
define('TITLE', 'payment details');
define('PAGE', 'paymentdetails');
include('includes/header.php'); 
include('../dbConnection.php');
session_start();
 if(isset($_SESSION['is_adminlogin'])){
  $aEmail = $_SESSION['aEmail'];
 } else {
  echo "<script> location.href='login.php'; </script>";
 }
?>
<div class="col-sm-9 col-md-10 mt-5 text-center">
  <!--Table-->
  <p class=" bg-dark text-white p-2">List of Technicians</p>
  <?php
    $sql = "SELECT * FROM payment_tb";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
 echo '<table class="table">
  <thead>
   <tr>
    <th scope="col">Payment ID</th>
    <th scope="col">User ID</th>
    <th scope="col">Name</th>
 
    <th scope="col">Account</th>
    <th scope="col">Mobile</th>
    <th scope="col">Amount</th>
    <th scope="col">Transaction</th>
   </tr>
  </thead>
  <tbody>';
  while($row = $result->fetch_assoc()){
   echo '<tr>';
    echo '<th scope="row">'.$row["ID"].'</th>';
    echo '<td>'. $row["rid"].'</td>';
    echo '<td>'.$row["uname"].'</td>';
    echo '<td>'.$row["uaccount"].'</td>';
   
    echo '<td>'.$row["unumber"].'</td>';
    echo '<td>'.$row["ucost"].'</td>';
    echo '<td>'.$row["utransaction"].'</td>';
    echo '<td><form action="editemp.php" method="POST" class="d-inline"> <input type="hidden" name="id" value='. $row["ID"] .'> <form action="" method="POST" class="d-inline"><input type="hidden" name="id" value='. $row["ID"] .'><button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button></form></td>
   </tr>';
  }

 echo '</tbody>
 </table>';
} else {
  echo "0 Result";
}
if(isset($_REQUEST['delete'])){
  $sql = "DELETE FROM payment_tb WHERE ID = {$_REQUEST['id']}";
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
</div>

</div>

<?php
include('includes/footer.php'); 
?>