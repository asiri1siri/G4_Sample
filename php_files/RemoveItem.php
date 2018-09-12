<?php

    //if id is not null and is a number
    if (is_numeric($_POST['id']) && !is_null($_POST['id']))
    {
        //1. get id to 'remove'
        $idToRemove = $_POST['id'];

        //2. command to change to hidden
        mysql_query("update 'table-name' set '' = '' where id = $idToRemove");

        //3. redirect back to display (Display.php is a placeholder)
        header("Location: Display.php");
    }
    else
    {
        header("Location: Display.php");
    }

?>