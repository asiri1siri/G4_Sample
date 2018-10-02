<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("db_connection.php");
$conn = OpenCon();

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($enable = '', $first = '', $user ='', $type = '', $email = '', $error = '', $id = '')
{ ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" href="css.css">
<title>
<?php if ($id != '') { echo "Edit User"; } else { echo "New User"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit User"; } else { echo "New User"; } ?></h1>
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

<strong>Enable: *</strong> <input type="text" name="Enable"
value="<?php echo $enable; ?>"/><br/>
<strong>First Name: *</strong> <input type="text" name="FirstName"
value="<?php echo $first; ?>"/><br/>
<strong>User Name: *</strong> <input type="text" name="UserName"
value="<?php echo $user; ?>"/><br/>
<strong>User Type: *</strong> <input type="text" name="UserType"
value="<?php echo $type; ?>"/><br/>
<strong>Email: *</strong> <input type="text" name="Email"
value="<?php echo $email; ?>"/><br/>
<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT USER

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
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
$Enable = htmlentities($_POST['Enable'], ENT_QUOTES);
$FirstName = htmlentities($_POST['FirstName'], ENT_QUOTES);
$UserName = htmlentities($_POST['UserName'], ENT_QUOTES);
$UserType = htmlentities($_POST['UserType'], ENT_QUOTES);
$Email = htmlentities($_POST['Email'], ENT_QUOTES);


// check that firstname, username, and email are not empty
if ($Enable == '' || $FirstName == '' || $UserName == '' || $UserType == ''|| $Email == '' )
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($Enable, $FirstName, $UserName, $UserType, $Email, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $conn->prepare("UPDATE users SET  ENABLED = ?, NAME = ?, USERNAME = ?, USERTYPE = ?, EMAIL = ? WHERE ID = ?"))
{
$stmt->bind_param("issssi", $Enable, $FirstName, $UserName, $UserType, $Email, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: users.php");
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

// get from the database
if($stmt = $conn->prepare("SELECT * FROM users WHERE ID=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($Enable, $id, $FirstName, $UserName, $UserType, $Email);
$stmt->fetch();

// show the form
renderForm($Enable, $FirstName, $UserName, $UserType, $Email, NULL, $id);

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
header("Location: /G4/practice/users.php");
}
}
}

else
{
renderForm();
}

// close the mysqli connection
//$mysqli->close();
CloseCon($conn);
?>