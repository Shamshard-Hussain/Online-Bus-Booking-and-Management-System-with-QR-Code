<?php
include '../connect.php';

if ( isset( $_GET[ 'id' ] ) ) {
 $UID=mysqli_real_escape_string( $connect,  $_GET[ 'id' ] );
 $query = mysqli_query
 ( $connect, "update notifications set status='read' where UserID=$UID " );
 
    ?><script>window.location.href='Notifications.php';</script><?php
}else{
 header( "location:Notifications.php" );
}

                                  
 ?>