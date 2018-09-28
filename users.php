<!DOCTYPE HTML>
<html>
<head>
<style>
a.fixed {
    position: fixed;
    right: 0;
    top: 0;
    width: 260px;
}
</style>
<title>View Users</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Users</h1>
<a class="fixed" href= "logout.php" >Logout</a>

<p><b>View Users</b> | <a href="items.php">View Items</a> </p>

<?php
// connect to db
include 'db_connection.php';
 
$conn = OpenCon();
 
// get records from db
if ($result = $conn->query("SELECT * FROM users ORDER BY ID"))
{

// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>Enabled</th><th>Name</th><th>Username</th><th>User Type</th><th>Email</th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->ID . "</td>";
echo "<td>" . $row->ENABLED . "</td>";
echo "<td>" . $row->NAME . "</td>";
echo "<td>" . $row->USERNAME . "</td>";
echo "<td>" . $row->USERTYPE . "</td>";
echo "<td>" . $row->EMAIL . "</td>";
echo "<td><a href='edit_user.php?id=" . $row->ID . "'>Edit</a></td>";
// echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
// echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}

// show an error if there is an issue with the database query
else
{
echo "Error: " . $conn->error;
}
 
CloseCon($conn);

?>

</body>
</html>