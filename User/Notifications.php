<?php include('user-header.php');

include '../connect.php';?>

<br><br>
   <div class="msg_body">
    <div class="msg_container">
      <div class="msg_header">
        <div class="notif_box">
          <h2 class="title">Notifications</h2>
          <span id="notifes"></span>
        </div>
        <a href="msgRead.php?id=<?php echo $_SESSION[ 'userid' ]; ?>"><p id="mark_all">Mark all as read</p></a>
      </div>
      <div class="mag_main">
       
       <?php
    $sql_notify = "SELECT *  FROM notifications WHERE UserID='{$_SESSION[ 'userid' ]}' ";
    $req = mysqli_query( $connect, $sql_notify );
    //count Rows
    $count = mysqli_num_rows( $req );

    if ( $count > 0 ) {

      while ( $row = mysqli_fetch_assoc( $req ) ) {
       $msg_id=$row['nid'];
        $msg_status = $row[ 'status' ];
        $msg=$row['Notifications'];
        $msg_time=$row['timedate'];
       $Subject=$row['Type'];
           
          if($msg_status=='unread'){
            ?>
           <div class="notif_card unread">
            <img src="../img/bg-img/Beyaztop-logo2.png" alt="avatar" />
            <a href="msgRead2.php?id=<?php echo $msg_id; ?>"><div class="description">
              <p class="user_activity "><strong><?php echo $Subject; ?> </strong><?php echo $msg; ?>
              </p><p class="time"><?php echo $msg_time; ?></p>
             </div></a>
           </div>
           <?php
           }else{
            ?>
           <div class="notif_card ">
            <img src="../img/bg-img/Beyaztop-logo2.png" alt="avatar" />
            <div class="description">
              <p class="user_activity"><strong><?php echo $Subject; ?>  </strong><?php echo $msg; ?></p>
               <p class="time"><?php echo $msg_time; ?></p>
             </div>
           </div>
           <?php
           }
      }
    } else{
     echo ' <div class="message"><p>Look like your have not reserved any notification yet.</p></div></div>';
    } ?>


       
     <!--  <div>
          <div class="notif_card ">
          <div class="message_card">
            <img
            src="./assets/images/avatar-rizky-hasanuddin.webp"
            alt="avatar"
          />
          <div class="description">
            <p class="user_activity">
              <strong>Rizky Hasanuddin</strong> sent you a private message
            </p>
            <p class="time">5 days ago</p>
          </div>
          </div>
        </div>
         
        <div class="message">
              <p>
                Hello, thanks for setting up the Chess Club. I've been a member
                for a few weeks now and I'm already having lots of fun and
                improving my game.
              </p>
            </div>
        </div>
        

       
      <div class="notif_card">
          <img src=""  />
          <div class="description">
            <p class="user_activity">
              <strong>Kimberly Smith</strong> commented on your picture
            </p>
            <p class="time">1 week ago</p>
          </div>
          <img src="../img/bg-img/Beyaztop-logo2.png" class="chess_img" alt="chess" />
        </div>-->
       
      </div>
    </div>

    <script src="../js/msg.js"></script>
</div>
<?php include('user-footer.php');?>