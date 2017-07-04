<?php
// including login.php file 
include "home_page.php";
// connecting to data base.....
$conn = mysql_connect("localhost","project","password");
$db = mysql_select_db("storage",$conn);

//checking whether the form is submitted or not
{
if(isset($_POST[Submit]))
{
//Declare An Array to store any error message 
$error = array(); 
   // checking whether the email address is entered or not..........
    if (empty($_POST['e-mail'])) 
{
$error[] = 'Please Enter your Email ';
} 
// checking whether the user entered valid email or not
else 
{
//regular expression for email validation
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail']))
 // if email provided is valid
 {                                                                          
$Email = $_POST['Email'];
 } 
 // if invalid email
else 
{
$error[] = 'Your EMail Address is invalid  ';
 }
}
// checking whether the current password is entered or not
 if (empty($_POST['old_Password'])) 
{
   $error[] = 'Please Enter Your Password ';
  }
  else
{
$old = $_POST['old_Password'] ;
}
// checking whether the new password is entered or not
if (empty($_POST['new_Password'])) 
{
   $error[] = 'Please Enter Your Password ';
  }
  // checking whether the new password is re-entered or not
if (empty($_POST['Confirm_Password']))
{
$error[]='Please re-enter the password';
}
// checking whether the new password and re-entered password matches or not
        if ($_POST['new_Password'] == $_POST['Confirm_Password'])
{

$new = $_POST['new_Password'] ;
}
//send to Database if there's no error 
    if (empty($error)) 
    //query to database
    {                                                                                       
    // If everything's OK... &&  // query to update the new password
$p1= "update hello set Password = '$new' where Email='$Email'";      
$p2=mysql_query($p1);
// if query is successfull
if($p2)
{
echo "<script>alert('Password changed successfully')</script>";
}
// if query fails
else 
{
die(mysql_error());
}
}
}
}
// closing database........
mysql_close();
// PHP code ends here .............................................................................................................
?>