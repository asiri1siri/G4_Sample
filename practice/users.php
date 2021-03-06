<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="css.css">
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
<input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search ">
<input type="radio" name="input" value="2"> Name
<input type="radio" name="input" value="3"> UserName
<input type="radio" name="input" value="5"> Email
</br>
</br>

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
echo "<table border='1' cellpadding='10' id='table'>";

// set table headers
echo "<tr><th>ID</th><th>Enabled</th><th>Name</th><th>Username</th><th>User Type</th><th>Email</th><th>Actions</th></tr>";

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

<!-- Add Button -->
<br>
<form>
<input type="button" value="Add User" onclick="window.location.href='/G4/practice/add_user.php'" />
</form>

</body>
</html>

<script>
//@Mario
// simple general search box 
function myFunction() {
 
  var input, filter, table, tr, td, i, index, radios;
  input = document.getElementById("search_input");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  
  //check which value is selected to get the index for search
radios = document.getElementsByTagName('input');
for (var i = 0; i < radios.length; i++) {
    if (radios[i].type === 'radio' && radios[i].checked) {
      // should there be a default value?
        index = radios[i].value;       
    }
}
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[index];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
