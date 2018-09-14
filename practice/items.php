<!DOCTYPE HTML>
<html>
<head>
<title>View Items</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Items</h1>

<p><a href="index.php">View Index</a> | <a href = "users.php"> View Users</a> | <b>View Items</b> </p>

<?php
// connect to db
include 'db_connection.php';
 
$conn = OpenCon();
 
// get records from db
if ($result = $conn->query("SELECT * FROM items ORDER BY id"))
{

// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>Hidden</th><th>Name</th><th>Description</th><th>Item Type</th><th>Condition</th><th>Entered</th><th>Updated</th><th>Parent ID</th><th>Is Container</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->hidden . "</td>";
echo "<td>" . $row->name . "</td>";
echo "<td>" . $row->description . "</td>";
echo "<td>" . $row->item_type . "</td>";
echo "<td>" . $row->condition . "</td>";
echo "<td>" . $row->entered . "</td>";
echo "<td>" . $row->updated . "</td>";
echo "<td>" . $row->parent_id . "</td>";
echo "<td>" . $row->is_container . "</td>";

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
