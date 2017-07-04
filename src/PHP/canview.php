<?php
	
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$userId=$_SESSION['user'];
	$res=mysql_query("SELECT * FROM users WHERE userId!=$userId");
	$userRow=mysql_fetch_array($res);
	
	
	$userId=$_SESSION['user'];
	$re=mysql_query("SELECT * FROM users WHERE userId=$userId");
	$userRo=mysql_fetch_array($re);
	//insert into database
	if($_SERVER['REQUEST_METHOD']=='POST')
	
{  
    $file=$_POST['file'];
	$sender=$_POST['sender'];
	$reciver_name=$_POST['reciver_name'];
	$sender_name=$_POST['sender_name'];
	
		if(!empty($file)&&!empty($sender))
{
	
    $SQL ="INSERT INTO can_view (sender,sender_name,reciver,reciver_name,file_id) VALUES ('$userId','$sender_name','$sender','$reciver_name','$file')";
        mysql_real_escape_string($SQL);
        $result = mysql_query($SQL) or die (mysql_error());
	
}
		
	}

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Uploading With PHP and MySql</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<div class="container">
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BTH</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="view.php">My files</a></li>
			<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">sent files <span class="caret"></span></a>
          <ul class="dropdown-menu">
           <li><a href="view_send.php">can view</a></li>
			<li><a href="edit_send.php">can edit</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">recived files <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="view_recive.php">can view</a></li>
			<li><a href="edit_recive.php">can edit</a></li>
          </ul>
        </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
	</div>
	<br>
	<br>
	<br>
	<div class="container-fluid">
  <h2>Can View</h2>
</div
	
	<div class="container-fluid">
<div class="col-md-4">
<form   method="POST" action="canview.php">
		
<?php
  $query = "SELECT * from users where userId!=$userId";
$result = mysql_query($query) or die(mysql_error()."[".$query."]");?>
<div class="form-group">
<label> Reciver</label>
    <select class="form-control" name='sender'>
<?php while ($row = mysql_fetch_array($result)){
?>
   <option value="<?php echo $row['userId'];?>">
     <?php echo $row['userName']; ?>
    </option>
<?php
}
?>       
</select>

 </div>
 <?php
  $query = "SELECT * from users where userId!=$userId";
$result = mysql_query($query) or die(mysql_error()."[".$query."]");?>
	<div class="form-group">
<label>Confirm Reciver</label>
 <select class="form-control" name='reciver_name'>
<?php while ($row = mysql_fetch_array($result)){
?>
   <option value="<?php echo $row['userName'];?>">
     <?php echo $row['userName']; ?>
    </option>
<?php
}
?>        
</select>
</div>

 <?php
  $query = "SELECT * from users where userId=$userId";
$result = mysql_query($query) or die(mysql_error()."[".$query."]");?>
	<div class="form-group">
<label>Sender</label>
 <select class="form-control" name='sender_name'>
<?php while ($row = mysql_fetch_array($result)){
?>
   <option value="<?php echo $row['userName'];?>">
     <?php echo $row['userName']; ?>
    </option>
<?php
}
?>        
</select>
</div>
 
 <?php
  $query = "SELECT * from tbl_uploads where userId=$userId";
  $result = mysql_query($query) or die(mysql_error()."[".$query."]");?>
<div class="form-group">
<label>Select File</label>
    <select class="form-control" name="file" >
<?php while ($row = mysql_fetch_array($result)){
?>
   <option value="<?php echo $row['file'];?>">
     <?php echo $row['file'];?>
    </option>
<?php
}
?>        
</select>

<br>
  <input class="form-control" type="submit" value="submit" >
</form>

 </div>
 </div>
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>

