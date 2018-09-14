<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>View Records</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Users</h1>

<p><b>View All Users</b> | <a href="items.php"> View All Items</a> </p> 

<?php
// connect to the database
include('db.php');

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM Users ORDER BY ID"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>First Name</th><th>User Name</th><th>Email</th><th>Enable</th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->FirstName . "</td>";
echo "<td>" . $row->UserName . "</td>";
echo "<td>" . $row->Email . "</td>";
echo "<td>" . $row->Enable . "</td>";
//Enable 0 or 1 
//UserType
echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";

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
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>


</body>
</html>