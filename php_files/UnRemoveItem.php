<?php

    include("connectToDB.php");

    //if id is not null and is a number
    if (is_numeric($_GET['id']) && !is_null($_GET['id']))
    {
        //1. get id to 'unremove'
        $idToUnRemove = $_GET['id'];

        //2. command to change to unhidden
        // mysql_query("update 'table-name' set '' = '' where id = $idToUnRemove");
        $sql = "update items set deleted=0 where id = " . $idToUnRemove;
        $conn->query($sql);

        //3. redirect back to display (Display.php is a placeholder)
        header("Location: Display.php");
    }
    else
    {
        header("Location: Display.php");
    }

?>