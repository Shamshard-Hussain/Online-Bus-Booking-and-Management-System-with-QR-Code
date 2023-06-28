<!doctype html>
<html>
 <?php
session_start();
if ($_SESSION['log'] == '')
{
    header("location:../Home.php");
}
?>
<head>
<meta charset="utf-8">
<title>Beyaztop</title>
</head>

<body>
 
 <?php
session_destroy();
header("location:../Home.php");
?>
 
 
 
</body>
</html>