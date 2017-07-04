<?php
ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	
	$id=$_GET["id"];
	$res=mysql_query("DELETE from tbl_uploads where id=$id");
	?>
		<script type="text/javascript">
		
           window.location="view.php";
		</script>
	 