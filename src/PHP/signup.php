<?php
// connecting to mysql database
$conn = mysql_connect("localhost","project","password");
$db = mysql_select_db("storage",$conn);
// checking whether the signup page is submitted or not
if (isset($POST['signup']))

{
// initialising an array
$error = array(); 
//storing the name in an variable                                                                                                          
$f1=$_POST['Name'];
// verifying whether the entered email address is valid or not
if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['e-mail']))   
            
{
// if the email address is valid
$f2=$_POST['Email'];
}
// if the email address is not valid
else
{
$error[]='invalid email address';
echo "enter a valid email address";
}
// to confirm whether the confirm password and the password entered matches or not
if ($_POST['Password'] == $_POST['Confirm_Password']) 
{
// if passwords match then store the password in a variable
$f3=$_POST['Password'];
}
// if passwords does not match
else 
{
$error[]='password does not match';
echo "entered passwords does not match";
}
// data transfer and retrivel from data starts form here if there are no errors stored in the declared array
if (empty($error)
{
         // Make sure the email address is available:                                                                                                                    
        $verify_email = "SELECT * FROM data  WHERE Email ='$f2'";
        $result_verify_email = mysql_query($verify_email);
        if (!$result_verify_email)
        { 
		// if there is no previous user 
        if (mysql_num_rows($result_verify_email) == 0)
        {   
		// query to mysql database		
$in= "insert into data(Name, Email, Password) values ('$f1', '$f2', '$f3')";
$in1=mysql_query($in);
// if query fails
if(!$in1)
{
die(mysql_error());
}
// if query is successfull
else 
if (mysql_affected_rows($db) == 1)                                                                                     //  this means that data is inserted into the table in database 
{
echo "<script>alert('Account created successfully. Email is sent to your mail with login credentials.')</script>";
                   // Send the email:
                $message = " your account is activated.\n\n Login credentials are Email:'$f2' and Password:'$f3'";
				mail($f2, 'Accont Confirmation', $message, 'From: kksrikasyap@gmail.com');
}
}
}
}
}

// PHP code ends here..................................................................................................................................................................
 ?>

