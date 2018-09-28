<?php

    include("db_connection.php");
    
    $conn = OpenCon();

    function writeForm()
    {
        $conn = OpenCon();

?>
<!DOCTYPE html>
<html>
<head>
<title>Move Items</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <h2>Move Items</h2>
    <form action='' method='post'>    
    Select Items To Move Out<br>
    <table class="table table-striped">
        <tr><th>Select</th><th>ID</th><th>Name</th><th>Description</th></tr>
        <?php
            
        //get id, name, description of all items that are in containers
        $items = $conn->query('SELECT ID, NAME, DESCRIPTION FROM items where PARENT_ID != 0');

            //list each items in its own row
            foreach ($items as $row)
            {
                echo "<tr><td><input type='checkbox' NAME='check_list[]' value='". $row['ID'] ."' /></td>";
                echo "<td>" . $row['ID'] . "</td>";
                echo "<td>" . $row['NAME'] . "</td>";
                echo "<td>" . $row['DESCRIPTION'] . "</td>";
                echo "</tr>";
            }

        ?>
    </table><br>
    <button type='submit' class="btn btn-success" NAME='submit'>Submit</button>
    </div>
    </form>
</body>
</html>
<?php

    }

    writeForm();

    if (isset($_POST['submit']))
    {

        foreach ($_POST['check_list'] as $entry)
        {
            $sql = "update items set PARENT_ID = 0, updated = NOW() where ID = " . $entry;
            $conn->query($sql);
        }

        if (isset($_GET['admin']))
        header("Location: /practice/items.php");
        else
        header("Location: /practice/items2.php");
    }    

?>