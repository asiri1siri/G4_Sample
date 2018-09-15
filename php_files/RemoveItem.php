<?php

    include("connectToDB.php");

    //if id is not null and is a number
    if (is_numeric($_GET['id']) && !is_null($_GET['id']))
    {
        //1. get id to 'remove'
        $idToRemove = $_GET['id'];

        //2. command to change to hidden
        //mysql_query("update 'table-name' set '' = '' where id = $idToRemove");
        $sql = "update items set deleted=1 where id = " . $idToRemove;
        $conn->query($sql);

        //3. redirect back to display (Display.php is a placeholder)
        header("Location: Display.php");
    }
    else
    {
        header("Location: Display.php");
    }

?>