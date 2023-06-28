<?php include('Admin-nav.php');
//sql Query to get data
include '../connect.php';?>

<!--Body section-->
 
	<div id="page-wrap">

	<h1>Passenger details</h1>
	
	<p>All names and Advance Passenger Informations Mentioned below</p>
		
	
   <?php 
     //sql Query to get data
     $sql="SELECT * FROM passenger";
      $res=mysqli_query($connect,$sql);
     //count Rows
     $count=mysqli_num_rows($res);
      
      
      $sn=1;//creat variable and assign the valu
     if($count>0)
     {
      ?>
  <table>
		<tr>
      <th>P.No</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Phone Number</th>
      <th>Join_On</th>
    </tr>
  
      <?php
       while($row=mysqli_fetch_assoc($res))
       {
        $id = $row[ 'UserID' ];
         $fname = $row[ 'First_Name' ];
        $lname = $row[ 'Last_Name' ];
    $email = $row[ 'Email' ];
    $Phone = $row[ 'Phone' ];
    $Join = $row[ 'Joined_on' ];
        
        ?>
     <tr>
      
    <td><?php echo $sn++;?></td>
    <td><?php echo $fname;?></td>
      <td><?php echo $lname;?></td>
    <td><?php echo $email;?></td>  
    <td><?php echo $Phone;?></td>
    <td><?php echo $Join;?></td>
   </tr>
        <?php 
       }
      
    }else{
       echo "<tr> <td colspan='7' class 'error'>User not registered yet.</td></tr>";
       }
     ?>
    
   </table>
  </div>
<!-- Table section ends  -->


<?php include('Admin-footer.php');?>