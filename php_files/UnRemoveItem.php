<?php

    //if id is not null and is a number
    if (is_numeric($_POST['id']) && !is_null($_POST['id']))
    {
        //1. get id to 'unremove'
        $idToUnRemove = $_POST['id'];

        //2. command to change to unhidden
        mysql_query("update 'table-name' set '' = '' where id = $idToUnRemove");

        //3. redirect back to display (Display.php is a placeholder)
        header("Location: Display.php");
    }
    else
    {
        header("Location: Display.php");
    }

?>