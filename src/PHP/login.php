<?php
// connection to mysql database......
$conn = mysql_connect("localhost","project","password");
$db = mysql_select_db("storage",$conn);

//checking whether the login form is submitted or not......
if (isset($_POST['formsubmitted'])) 
{
    // Initialize a session:
session_start();
    $error = array();//this array will store all error messages
    
// checking whether the email is entered or not in the login form
    if (empty($_POST['e-mail'])) {//if the email supplied is empty 
        $error[] = 'You forgot to enter  your Email ';
    } 
  
    // checking whether the  entered email address is valid or not ....
    else
     {

        if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail']))
          // if entered email is valid
         {           
            $Email = $_POST['e-mail'];
        } 
         // if entered email is not valid
        else {
             $error[] = 'Your EMail Address is invalid'; 
      }
    }
    // checking whether the password is entered or not in the login form
    if (empty($_POST['Password']))
     {
        $error[] = 'Please Enter Your Password ';
    }
    else {
        $Password = $_POST['Password'];
    }
     // if there are no errors while entering login credentials
       if (empty($error)) //if the array is empty , it means no error found
    { 
    // query to mysql database
$query_check_credentials = "SELECT * FROM data_users WHERE (Email='$Email' and password='$Password')";
 // if query failed
        if(!$result_check_credentials)
        {                                                                                            //If the QUery Failed 
            echo 'Query Failed ';
        }
        // if query is successfull
        if (@mysql_num_rows($result_check_credentials) == 1)//if Query is successfull 
        { // A match was made.

            $_SESSION = mysql_fetch_array($result_check_credentials, MYSQL_ASSOC);//Assign the result of this query to SESSION Global Variable
           
            header("Location: page.php");  
        }
         // if there is any error
        else
        { 
            
            $msg_error= 'Either Your Account is inactive or Email address /Password is Incorrect';
        }
 mysql_close($db);

}

?>
   
?>