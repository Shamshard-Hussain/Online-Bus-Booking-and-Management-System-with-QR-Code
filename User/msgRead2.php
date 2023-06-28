<?php
include '../connect.php';

if ( isset( $_GET[ 'id' ] ) ) {
 $NID=mysqli_real_escape_string( $connect,  $_GET[ 'id' ] );
 $query = mysqli_query
 ( $connect, "update notifications set status='read' where nid=$NID " );
 
    ?><script>window.location.href='Notifications.php';</script><?php
}else{
 header( "location:Notifications.php" );
}

                                  
 ?>