<?php

    include("db_connection.php");

    $conn = OpenCon();

    //function to write the html page
    function writeForm($numItems, $numContainers, $errorSameItem = '', $errorNoItemsSelected = '', $errorNoContainerSelected = '')
    {
        $conn = OpenCon();

        if ($numItems > 0 && $numContainers > 0)
        {?>
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
                    <?php
                        echo "<input type='hidden' name='numItems' value='". $numItems ."' />";
                        echo "<input type='hidden' name='numContainers' value='". $numContainers ."' />";
                    ?>
                    Select Items To Move<br>
                    <table class="table table-striped">
                        <tr><th>Select</th><th>ID</th><th>Name</th><th>Description</th></tr>
                        <?php
                            //list all enabled items
                            $items = $conn->query('SELECT ID, NAME, DESCRIPTION FROM items where deleted = false and parent_id = 0');

                                foreach ($items as $row)
                                {
                                    echo "<tr><td><input type='checkbox' NAME='check_list[]' value='". $row['ID'] ."'/></td>";
                                    echo "<td>" . $row['ID'] . "</td>";
                                    echo "<td>" . $row['NAME'] . "</td>";
                                    echo "<td>" . $row['DESCRIPTION'] . "</td>";
                                    echo "</tr>";
                                }

                        ?>
                    </table><br>
                    </div>
                    <div class="container">
                    Select Where to Store Items<br>
                    <table class="table table-striped">
                        <tr><th>Select</th><th>ID</th><th>Name</th><th>Description</th></tr>
                        <?php
                            //list all enabled items that are containers
                            $items = $conn->query('SELECT ID, NAME, DESCRIPTION FROM items where is_container = true and deleted = false');
                            
                            foreach ($items as $row)
                            {
                                echo "<tr><td><input type='radio' NAME='select' value='". $row['ID'] ."' /></td>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['NAME'] . "</td>";
                                echo "<td>" . $row['DESCRIPTION'] . "</td>";
                                echo "</tr>";
                            }

                        ?>
                    </table>
                    <button type='submit' class="btn btn-success" NAME='submit'>Submit</button>

                     <!-- ASIRI - Back Button -->
                    <input type="button" value="Back" onclick="window.location.href='/G4/practice/items.php'" />
                    
                    <p>
                    <?php
                    //echo errors
                        if ($errorSameItem != '')
                        {
                            echo $errorSameItem . "<br>";
                        }
                        if ($errorNoItemsSelected != '')
                        {
                            echo $errorNoItemsSelected . "<br>";
                        }
                        if ($errorNoContainerSelected != '')
                        {
                            echo $errorNoContainerSelected;
                        }
                    ?>
                    </p>
                    </div>
                </form>
            </body>
            </html>
        <?php }

        else if ($numItems == 0)
        {?>
            <!DOCTYPE html>
            <html>
            <head>
            <title>Move Items</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            </head>
            <body>
            <div class="container">
                <p>Ain't no items in here, chief.</p><br>
                <?php
                    if (isset($_GET['admin']))
                    echo "<a href='/G4/practice/items.php'>Back</a>";
                    else
                    echo "<a href='/G4/practice/items2.php'>Back</a>";
                ?>
            </div>
            </body>
            </html>
        <?php }

        else
        {?>
            <!DOCTYPE html>
            <html>
            <head>
            <title>Move Items</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            </head>
            <body>
            <div class="container">
                <p>Ain't no containers in here, chief.</p><br>
                <?php
                    if (isset($_GET['admin']))
                    echo "<a href='/G4/practice/items.php'>Back</a>";
                    else
                    echo "<a href='/G4/practice/items2.php'>Back</a>";
                ?>
            </div>
            </body>
            </html>
        <?php }
    }

    //if user submitted info
    if (isset($_POST['submit']))
    {
        $errorSameItem = '';
        $errorNoItemsSelected = '';
        $errorNoContainerSelected = '';
        //if some error, fix
            //1. any selected item is same container to go in
            //2. if no values are selected

        if (!(isset($_POST['check_list'])))
        {
            $errorNoItemsSelected = "ERROR: You've got to select one or more items!";
        }
        else
        {
            if (!(isset($_POST['select'])))
            {
                $errorNoContainerSelected = "ERROR: You've got to select a container!";
            }
            else
            {
                foreach ($_POST['check_list'] as $entry)
                {
                    if ($entry == $_POST['select'])
                    {
                        $errorSameItem = "ERROR: It's against the laws of nature to put an item inside itself.";
                    }
                }
            }        
        }

        //if error is apparent, rewrite page
        if ($errorSameItem != '' || $errorNoItemsSelected != '' || $errorNoContainerSelected != '')
        {
            writeForm($_POST['numItems'], $_POST['numContainers'], $errorSameItem, $errorNoItemsSelected, $errorNoContainerSelected);
        }
        else
        {
            //else proceed as normal
            foreach ($_POST['check_list'] as $entry)
            {
                $sql = "update items set parent_id = " . $_POST['select'] . ", updated = NOW() where ID = " . $entry;
                $conn->query($sql);
            }

            if (isset($_GET['admin']))
            header("Location: /G4/practice/items.php");
            else
            header("Location: /G4/practice/items2.php");
        }
    }

    //else they must be new; write the page
    else
    {
        $items = $conn->query('SELECT ID, NAME, DESCRIPTION FROM items where deleted = false and parent_id = 0');
        $containers = $conn->query('SELECT ID, NAME, DESCRIPTION FROM items where is_container = true and deleted = false');

        $numItems = $items->num_rows;
        $numContainers = $containers->num_rows;
        writeForm($numItems, $numContainers);
    }

?>