<?php 

ob_start();
session_start();

// connect to db
include 'db_connection.php';

$conn = OpenCon();

if (isset($_POST['submit']))
{
    $user = $_POST['user'];
    $admin = $_POST['admin'];

    if( $user == "")
    {
        echo 'Please fill in all fields';
    }

    // reset admin variable
    if ($admin == '1')
    {
        $admin = 'Admin';
    }
    else
    {
        $admin = 'User';
    }

        if ($result = $conn->query("SELECT * FROM users WHERE USERNAME = '$user' AND USERTYPE = '$admin'"))
        {
            // display records if there are records to display
            if ($result->num_rows > 0)
            {
                if ($admin == 'Admin')
                {
                    //instead of just redirecting we can use sessions here, but admin page would 
                    //still be viewable just by typing in url, so is it necessary?
                    header("Location: /practice/users.php");
                }
                else 
                {  
                    //instead of just redirecting we can use sessions here, but admin page would 
                    //still be viewable just by typing in url, so is it necessary?
                    header("Location: /practice/items2.php");
                    exit;
                }
            }
            else
            {
                echo 'Error: Invalid login credentials. Please try again.';
            }
        }
        else
        {
            echo 'Error: Database connection error.';
        }
}

CloseCon($conn);

?>

<html>
<form method = 'post' action = '?'>
  <fieldset>
    <legend><h1>Login</h1></legend>
    <label class='login'>Username:</label><input type='text' name='user' /><br />
    <label class='login'>Password:</label><input type='password' name='pass' /><br />
    <label class='login'>Admin?:</label><input type='checkbox' value='1' name='admin' /><br/>
    <input type='submit' name='submit' value='Login' />
  </fieldset>
</form>
</html>