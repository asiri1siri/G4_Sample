<?php

    include("connectToDB.php");

    //if id is not null
    if (is_null($_GET['id']))
    {
        header("Location: Display.php");
    }
    else
    {
        //1. get id to enable
        $idToEnable = $_GET['id'];

        //2. enable user
        $sql = "update users set enabled = 1 where id = " . $idToEnable;
        mysql_query($sql);

        //3. redirect back to display
        header("Location: Display.php");
    }

?>