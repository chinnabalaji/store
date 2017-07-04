<?php
// PHP CODE starts here ..................................................................................
// connecting database ...........
$con=mysql_connect("localhost","project","password");
$db=mysql_select_db("storage",$con);
// checking whether the id is passed or not                                           
if(isset($_GET['id']))
{
// Get the ID
    $id = intval($_GET['id']);
 // Make sure the ID is in fact a valid ID
    if($id <= 0) 
{
        die('The ID is invalid!');
    }
         // Fetch the file information from the database
        $query = "
            SELECT name, mime, size, created
            FROM hello
            WHERE id = {$id}";
        $result = mysql_query($query);
        // checking the result
        if($result)
        {
            // Make sure the result is valid
            if(mysql_num_rows == 1)
              // if the result is true and valid 
 {
            // Get the row
                $row = mysql_fetch_assoc($result);
  // Print headers

                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
 // Print data
                echo $row['data'];
            }
             // if the id passed does not match....
            else
 {
                echo 'Error! No image exists with that ID.';
            }
             // Free the mysql resources
            mysql_free($result);
        }
        // if the query failed
        else
 {
            echo "Error! Query failed: <pre>{$mysql_error}</pre>";
        }
         // closing the database
        mysql_close($db);
    }
    // if no id is passed
else
 {
    echo 'Error! No ID was passed.';
}
// PHP CODE ends here...........................................................................................

?>