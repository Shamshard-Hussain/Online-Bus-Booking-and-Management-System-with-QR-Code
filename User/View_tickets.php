<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" ></script>
<?php
include('user-header.php');
include '../connect.php';

if ( isset( $_GET[ 'U-Tid' ] ) ) {
 
 $Ticket_no=mysqli_real_escape_string( $connect,  $_GET[ 'U-Tid' ] );
 
  $sql2="SELECT * FROM Ticket WHERE Tid='$Ticket_no'";
  $res2=mysqli_query($connect,$sql2);
 
  $row2 = mysqli_fetch_assoc($res2);
  $Issue_Date = $row2['Issue_Date'];
  $Time=$row2['Departure_Time'];
  $Destination = $row2['Route'];
  $Seat_Name = $row2['Seat_id'];
  $Bus_L_NO = $row2['Bus_number'];
  $Qr_Image_Name = $row2['Qr_code'];
 ?>

<body>
 <script>
        async function generatePDF() {
            //document.getElementById("downloadButton").innerHTML = "Currently downloading, please wait";
            //Downloading
            var downloading = document.getElementById("ticket");
            var doc = new jsPDF('p', 'pt','c6');
            await html2canvas(downloading, {
                allowTaint: true,
                useCORS: true,
               // width: 990
            }).then((canvas) => {
                //Canvas (convert to PNG)
                doc.addImage(canvas.toDataURL("image/png"), 'PNG', 5, 5,314,450);
            })

            doc.save("Document.pdf");

            //End of downloading
           // document.getElementById("downloadButton").innerHTML = "Click to download";
        }
    </script>
 

 
 <!-- Download button --> 
 <br>
<div class="download-button" >
  <button type="button" class="button" onClick="javascript:generatePDF()" >
<span class="button__text"><a href="javascript:generatePDF()" id="downloadButton">Download</a></span>
<span class="button__icon">
<ion-icon name="cloud-download-outline"></ion-icon>
</span>
</button>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
 </div>
<!-- Download button end --> 
 
 
 
 
<!-- Ticket body --> 
<div class=" ticket-wrap"  >
  <div class="ticket" id="ticket" >
    <div class="ticket__header">
      <div class="ticket__co">
       <img class="ticket__co-icon" src="../img/bg-img/Beyaztop-logo.png"/>
        <span class="ticket__co-name">Bus Ticket</span> <span class="u-upper ticket__co-subname">Powered by Beyazatop</span> </div>
    </div>
   
    <div class="ticket__body">
      <p class="ticket__route"><?php echo $Destination;  ?></p>
      
      <div class="ticket__timing">
        <p> <span class="u-upper ticket__small-label">Date</span> <span class="ticket__detail"><?php echo $Issue_Date;  ?></span> </p>
        <p> <span class="u-upper ticket__small-label">Time</span> <span class="ticket__detail"><?php echo $Time;  ?></span> </p>
        <p> <span class="u-upper ticket__small-label">Bus-No</span> <span class="ticket__detail"><?php echo $Bus_L_NO; ?></span> </p>
      </div>
     <p class="ticket__description">Available on day issue only</p>
     
     <img class="ticket__qrcode" src="../qrcode/temp/<?php echo $Qr_Image_Name  ?>" alt="Qr code" /> 

   <div class="ticket__timing">
        
        <p> <span class="u-upper ticket__small-label">Ticket- Id</span> <span class="ticket__detail">#<?php echo $Ticket_no?></span> </p>
        <p> <span class="u-upper ticket__small-label">Seat Code</span> <span class="ticket__detail"><?php  echo $Seat_Name;?></span> </p>
        <p> <span class="u-upper ticket__small-label">Price</span> <span class="ticket__detail">Rs.200.00/=</span> </p>
      </div>
     
   </div>
   <p class="ticket__fine-print">Thank you, Have Safe Journey!</p>
   <br>
  </div>
</div>

</body>


<?php
}else{
  ?><script>window.location.href='User-Bookin-Details.php';</script><?php
}

 include('user-footer.php');?>
