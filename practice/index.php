<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css.css">
<title>Index</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Index</h1>

<p><b>View Index</b> | <a href="users.php">View Users</a> | <a href="items.php">View Items</a></p>

<?php
include 'db_connection.php';
 
$conn = OpenCon();
 
echo "Connected Successfully";
 
CloseCon($conn);
 
?>

</body>
</html>
