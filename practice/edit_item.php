<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("db_connection.php");
 $conn = OpenCon();

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($hidden = '', $name = '', $description ='', $item = '', $status = '', 
					$container = '', $parent = '', $error = '', $id = '')
{ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> 
<link rel="stylesheet" href="css.css">
<title>
<?php if ($id != '') { echo "Edit Items"; } else { echo "error"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Items"; } else { echo "ERROR"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>

<strong>Delete: *</strong> <input type="text" name="hidden"
value="<?php echo $hidden; ?>"/><br/>
<strong>Name: *</strong> <input type="text" name="name"
value="<?php echo $name; ?>"/><br/>
<strong>Description: *</strong> <input type="text" name="description"
value="<?php echo $description; ?>"/><br/>
<strong>Item Type: *</strong> <input type="text" name="item"
value="<?php echo $item; ?>"/><br/>
<strong>Cond: *</strong> <input type="text" name="status"
value="<?php echo $status; ?>"/><br/>
<strong>Is Container: *</strong> <input type="text" name="is_container"
value="<?php echo $container; ?>"/><br/>
<strong>Parent ID: *</strong> <input type="text" name="parent_id"
value="<?php echo $parent; ?>"/><br/>


<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT ITEM

*/
// if the 'id' variable is set in the URL, we know that we need to edit 
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$hidden = htmlentities($_POST['hidden'], ENT_QUOTES);
$name = htmlentities($_POST['name'], ENT_QUOTES);
$description = htmlentities($_POST['description'], ENT_QUOTES);
$item_type = htmlentities($_POST['item'], ENT_QUOTES);
$status = htmlentities($_POST['status'], ENT_QUOTES);
$is_container = htmlentities($_POST['is_container'], ENT_QUOTES);
$parent_id = htmlentities($_POST['parent_id'], ENT_QUOTES);
$entered = htmlentities($_POST['entered'], ENT_QUOTES);
$updated = htmlentities($_POST['updated'], ENT_QUOTES);

// check if feilds are not empty
if ($hidden == '' || $name == '' || $description == '' || $item_type == '' ||
	$status == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($hidden, $name, $description, $item_type, 
			$status, $is_container, $parent_id, $error, $id);
}
else
{
// if everything is fine, update the items in the database
if ($stmt = $conn->prepare("UPDATE items SET DELETED = ?, NAME = ?, DESCRIPTION = ?, ITEMTYPE = ?, COND = ?, IS_CONTAINER = ?, PARENT_ID = ? WHERE ID = ?"))
{
$stmt->bind_param("issssiii", $hidden, $name, $description, $item_type, $status, 
	$is_container, $parent_id, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: items.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $conn->prepare("SELECT * FROM items WHERE ID=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($hidden, $id, $name, $description, $item_type, $status,
  $is_container, $parent_id, $entered, $updated);
$stmt->fetch();

// show the form
renderForm($hidden, $name, $description, $item_type, $status, $is_container, $parent_id, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: /G4/practice/itmes.php");
}
}
}

else
{
renderForm();
}

// close the mysqli connection
CloseCon($conn);
?>