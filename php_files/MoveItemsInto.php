<?php

    include("connectToDB.php");

    function writeForm()
    {

?>

<!DOCTYPE html>
<html>
<head>
<title>Move Items</title>
</head>
<body>
    <h2>Move Items</h2>
    <form action='' method='post'>
    Select Items To Move<br>
    <table border='1' cellpadding='2'>
        <tr><th>Select</th><th>ID</th><th>Name</th><th>Description</th></tr>
        <?php

        include("connectToDB.php");
            
        $items = $conn->query('SELECT id, name, description FROM items');

            while ($row = $items->fetch_object())
            {
                echo "<tr><td><input type='checkbox' name='check_list[]' value='$row->id' /></td>";
                echo "<td>" . $row->id . "</td>";
                echo "<td>" . $row->name . "</td>";
                echo "<td>" . $row->description . "</td>";
                echo "</tr>";
            }

        ?>
    </table><br>
    Select Where to Store Items<br>
    <table border='1' cellpadding='2'>
        <?php

        include("connectToDB.php");
            
        $items = $conn->query('SELECT id, name, description FROM items');
        
        while ($row = $items->fetch_object())
        {
            echo "<tr><td><input type='radio' name='select' value='$row->id' /></td>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->name . "</td>";
            echo "<td>" . $row->description . "</td>";
            echo "</tr>";
        }

        ?>
    </table>
    <button type='submit' name='submit'>Submit</button>
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
            $sql = "update items set parent_id = " . $_POST['select'] . " where id = " . $entry;
            $conn->query($sql);
        }

        header("Location: Display.php");
    }    

?>