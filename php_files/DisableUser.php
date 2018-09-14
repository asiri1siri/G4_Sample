<?php

    include("connectToDB.php");

    //if id is not null
    if (is_null($_GET['id']))
    {
        header("Location: Display.php");
    }
    else
    {
        //1. get id to disable
        $idToDisable = $_GET['id'];

        //2. disable user
        $sql = "update users set enabled = 0 where id = " . $idToDisable;
        mysql_query($sql);

        //3. redirect back to display
        header("Location: Display.php");
    }

?>