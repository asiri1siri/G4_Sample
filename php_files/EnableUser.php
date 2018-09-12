<?php

    //if id is not null
    if (is_null($_POST['id']))
    {
        header("Location: Display.php");
    }
    else
    {
        //1. get id to enable
        $idToEnable = $_POST['id'];

        //2. enable user
        mysql_query("update 'table-name' set '' = '' where id = $idToEnable");

        //3. redirect back to display
        header("Location: Display.php");
    }

?>