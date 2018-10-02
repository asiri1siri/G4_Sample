<?php
    // connect to the database
    include('db_connection.php');

    $conn = OpenCon();

function renderForm($ID, $DELETED, $NAME, $DESCRIPTION, $ITEMTYPE, $COND, $IS_CONTAINER, $PARENT_ID, $error)
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
            <title>Add Item</title>
            <h1>Add Item</h1>
            <link rel="stylesheet" href="css.css">
        </head>
        <body>
            <form action="" method="post">
                <div>
                    <strong>ID: *</strong> <input type="text" name="ID" value="<?php echo $ID; ?>" /><br/>
                    <strong>DELETED: *</strong> <input type="text" name="DELETED" value="<?php echo $DELETED; ?>" /><br/>
                    <strong>NAME: *</strong> <input type="text" name="NAME" value="<?php echo $NAME; ?>" /><br/>
                    <strong>DESCRIPTION: *</strong> <input type="text" name="DESCRIPTION" value="<?php echo $DESCRIPTION; ?>" /><br/>
                    <strong>ITEMTYPE: *</strong> <input type="text" name="ITEMTYPE" value="<?php echo $ITEMTYPE; ?>" /><br/>
                    <strong>CONDITION: *</strong> <input type="text" name="COND" value="<?php echo $COND; ?>" /><br/>
                    <strong>IS CONTAINER: *</strong> <input type="text" name="IS CONTAINER" value="<?php echo $IS_CONTAINER; ?>" /><br/>
                    <strong>PARENT ID: *</strong> <input type="text" name="PARENT ID" value="<?php echo $PARENT_ID; ?>" /><br/>
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
        $ID = htmlentities($_POST['ID'], ENT_QUOTES);
        $DELETED = htmlentities($_POST['DELETED'], ENT_QUOTES);
        $NAME = htmlentities($_POST['NAME'], ENT_QUOTES);
        $DESCRIPTION = htmlentities($_POST['DESCRIPTION'], ENT_QUOTES);
        $ITEMTYPE = htmlentities($_POST['ITEMTYPE'], ENT_QUOTES);
        $COND = htmlentities($_POST['COND'], ENT_QUOTES);
        $IS_CONTAINER = htmlentities($_POST['IS_CONTAINER'], ENT_QUOTES);
        $PARENT_ID = htmlentities($_POST['PARENT_ID'], ENT_QUOTES);
//        $ENTERED = htmlentities($_POST['ENTERED'], ENT_QUOTES);
//        $UPDATED = htmlentities($_POST['UPDATED'], ENT_QUOTES);

        // check to make sure all fields are entered
        if ($ID == '' || $DELETED == '' || $NAME == '' || $DESCRIPTION == ''|| $ITEMTYPE == '' || $COND == '' || $IS_CONTAINER == '' || $PARENT_ID == '')
        {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
            // if either field is blank, display the form again
            renderForm($ID, $DELETED, $NAME, $DESCRIPTION, $ITEMTYPE, $COND, $IS_CONTAINER, $PARENT_ID, $error);
        }
        else
        {
            $sql = "INSERT INTO items (DELETED, ID, NAME, DESCRIPTION, ITEMTYPE, COND, IS_CONTAINER, PARENT_ID) VALUES (" . $DELETED . ", " . $ID . ", '". $NAME . "', '" . $DESCRIPTION . "', '" . $ITEMTYPE . "', '" . $COND . "', " . $IS_CONTAINER . ", " . $PARENT_ID . ")"; 
            if ($conn->query($sql))
            header("Location: /G4/practice/items.php");
            else {
                echo "fail";
            }
        }

            // save the data to the database
            
    }

    

    else
    // if the form hasn't been submitted, display the form
    {
        renderForm('','','','','','','','','');
    }

    CloseCon($conn);
?>