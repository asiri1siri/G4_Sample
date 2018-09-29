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
<title>View Items</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>

<h1>View Items</h1>
<a class="fixed" href= "logout.php" >Logout</a>

<p> <b>View Items</b> </p>
<input type="text" id="search_input" onkeyup="myFunction()" placeholder="Search ">
<input type="radio" name="input" value="0"> ID
<input type="radio" name="input" value="2"> Name
<input type="radio" name="input" value="3"> Description
<input type="radio" name="input" value="4"> Item Type
</br>
</br>

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
echo "<table border='1' cellpadding='10' id='table'>";

// set table headers
echo "<tr><th>ID</th><th>Hidden</th><th>Name</th><th>Description</th><th>Item Type</th><th>Condition</th><th>Entered</th><th>Updated</th><th>Parent ID</th><th>Is Container</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->ID . "</td>";
echo "<td>" . $row->DELETED . "</td>";
echo "<td>" . $row->NAME . "</td>";
echo "<td>" . $row->DESCRIPTION . "</td>";
echo "<td>" . $row->ITEMTYPE . "</td>";
echo "<td>" . $row->COND . "</td>";
echo "<td>" . $row->ENTERED . "</td>";
echo "<td>" . $row->UPDATED . "</td>";
echo "<td>" . $row->PARENT_ID . "</td>";
echo "<td>" . $row->IS_CONTAINER . "</td>";

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

