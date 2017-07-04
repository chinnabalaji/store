 <?php
// PHP code starts here .............................................................................................................

// connection to database

$conn=mysql_connect("localhost","project","password");                      
$db=mysql_select_db("storage",$conn);

// create a table if not exists for the user to store files
 
 $table = "CREATE TABLE IF NOT EXISTS hello (                       
    id        Int Unsigned Not Null Auto_Increment,
    name      VarChar(255) Not Null,
    mime      VarChar(50) Not Null,
    size      BigInt Unsigned Not Null,
    data      MediumBlob Not Null,
    created   DateTime Not Null,
    PRIMARY KEY (id))";
    
$table1=mysql_query($table);
                                                                                     // Check if a file has been uploaded
if(isset($_FILES['uploaded_file'])) 
{
 // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) 
    {
                                                                                           
       
        $name = mysql_real_escape_string($_FILES['uploaded_file']['name']);
        $mime = mysql_real_escape_string($_FILES['uploaded_file']['type']);
        $data = mysql_real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);
  // Create the SQL query to insert the file to mysql database
  $query = "INSERT INTO hello (name, mime, size, data, created)
            VALUES ('$name', '$mime', '$size', '$data', NOW())";
 // Execute the query
        $result = mysql_query($query);
         // Check if it was successfull
        if($result) {
            echo "<script>alert('Success! Your file was successfully added!')</script>";
        }
        else {
            echo 'Error! Failed to insert the file' . "<pre>{$db->error}</pre>";
        }
    }
    else {
        echo 'An error accured while the file was being uploaded. ' . 'Error code: '. intval($_FILES['uploaded_file']['error']);
    }
     // Close the mysql connection
    mysql_close();
}

// PHP code ends here .............................................................................................................. 
 ?>