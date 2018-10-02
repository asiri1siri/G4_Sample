<?php
    // connect to the database
    include('db_connection.php');

    $conn = OpenCon();

function renderForm($ENABLED, $ID, $NAME, $USERNAME, $USERTYPE, $EMAIL, $error)
{
    ?>
    <?php
    // if there are any errors, display them

    if ($error != '')
    {
        echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
    }

    ?>

    <!DOCTYPE HTML>
    <html>
        <head>
            <title>Add User</title>
            <h1>Add User</h1>
            <link rel="stylesheet" href="css.css">
        </head>
        <body>
            <form action="" method="post">
                <div>
                    <strong>Enabled: *</strong> <input type="text" name="ENABLED" value="<?php echo $ENABLED; ?>" /><br/>
                    <strong>ID: *</strong> <input type="text" name="ID" value="<?php echo $ID; ?>" /><br/>
                    <strong>Name: *</strong> <input type="text" name="NAME" value="<?php echo $NAME; ?>" /><br/>
                    <strong>Userame: *</strong> <input type="text" name="USERNAME" value="<?php echo $USERNAME; ?>" /><br/>
                    <strong>Usertype: *</strong> <input type="text" name="USERTYPE" value="<?php echo $USERTYPE; ?>" /><br/>
                    <strong>Email: *</strong> <input type="text" name="EMAIL" value="<?php echo $EMAIL; ?>" /><br/>
                    <p>* required</p>
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>
        </body>
    </html>
    <?php
    }
    
    // check if the form has been submitted. If it has, start to process the form and save it to the database
    if (isset($_POST['submit']))
    {
        $conn = OpenCon();

        // get form data, making sure it is valid
        $ENABLED = htmlentities($_POST['ENABLED'], ENT_QUOTES);
        $ID = htmlentities($_POST['ID'], ENT_QUOTES);
        $NAME = htmlentities($_POST['NAME'], ENT_QUOTES);
        $USERNAME = htmlentities($_POST['USERNAME'], ENT_QUOTES);
        $USERTYPE = htmlentities($_POST['USERTYPE'], ENT_QUOTES);
        $EMAIL = htmlentities($_POST['EMAIL'], ENT_QUOTES);

        // check to make sure all fields are entered
        if ($ENABLED == '' || $ID == '' || $NAME == '' || $USERNAME == ''|| $USERTYPE == '' || $EMAIL == '')
        {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
            // if either field is blank, display the form again
            renderForm($ENABLED, $ID, $NAME, $USERNAME, $USERTYPE, $EMAIL, $error);
        }
        else
        {
            }
            // save the data to the database
            $sql = "INSERT INTO users VALUES (" . $ENABLED . ", " . $ID . ", '". $NAME . "', '" . $USERNAME . "', '" . $USERTYPE . "', '" . $EMAIL . "')";
            if ($conn->query($sql))
            header("Location: /G4/practice/users.php");
            else {
                echo "fail";
            }
        }

    

    else
    // if the form hasn't been submitted, display the form
    {
        renderForm('','','','','','','');
    }
    
    CloseCon($conn);
?>