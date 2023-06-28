<?php include('Admin-nav.php');


include '../connect.php';?>

<!-- Table section starts  -->
<div id="page-wrap">
  <h1>Bus details</h1>
  <p>All Bus Informations Mentioned below</p>
  <table>
    
   <?php 
     //sql Query to get data
     $sql="SELECT * FROM bus_details";
      $res=mysqli_query($connect,$sql);
     //count Rows
     $count=mysqli_num_rows($res);
     
     if($count>0)
     {
      ?>
   <tr>
      <th>Bus Id</th>
      <th>Owner_First_name</th>
      <th>Owner_Last_name</th>
      <th>Owner Nic Number</th>
      <th>Phone Number</th>
      <th>licences Number</th>
      <th>Permit Number</th>
      <th>Seats Count</th>
      <th>Options</th>
      <th></th>
    </tr>
   
   
   <?Php
      
       while($row=mysqli_fetch_assoc($res))
       {
         $id = $row[ 'Bus_id' ];
    $fname = $row[ 'Owner_First_name' ];
    $lname = $row[ 'Owner_Last_name' ];
    $Phone = $row[ 'Phone_Number' ];
    $Lumber = $row[ 'licences_Number' ];
    $NicNumber = $row[ 'Nic_number' ];
    $BPnumber = $row[ 'Permit_Number' ];
    $Snumber = $row[ 'Seats_Count' ];
        
        ?>
     <tr>
       
      
    <td><?php echo $id;?></td>
    <td><?php echo $fname;?></td>
    <td><?php echo $lname;?></td>
    <td><?php echo $NicNumber;?></td>  
    <td><?php echo $Phone;?></td>
    <td><?php echo $Lumber;?></td>
    <td><?php echo $BPnumber;?></td>
    <td><?php echo $Snumber;?></td>
      
  <td><a class="btn_update"href="Admin-Bus-Details-update.php?id=<?php echo $id;?>& busNumbr=<?php echo $Lumber;?>">Update</a></td>
  <td><a class="btn_Delete"href="Admin-Bus-Details-Delete.php?id=<?php echo $id;?>& Seat_data=<?php echo $Lumber;?>">Delete</a></td>
   </tr>
     
        <?php
       }
    }else{
       echo "<tr> <td colspan='7' class 'error'>Bus Details not add yet.</td></tr>";
       }

     ?>
    
   </table>
  </div>

   
<!-- Table section ends  -->

<?php include('Admin-footer.php');?>