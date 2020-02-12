<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>
</style>
</head>
<body>
<div id="container">
<?php

include('connection.php');


if (isset($_GET['card_no']))
	    $data1=$_GET['card_no'];
		
		else $data1='';
		
		
		$query="Select count(*) from book_loans where card_no='".$data1."' and date_in='0000-01-01'";
		$result=mysqli_query($con, $query);
		$row=mysqli_fetch_array($result);
		if($row['count(*)']>0)
		{
			?>
         <script language="javascript"> 
		 alert("You have not returned all the books. Kindly return all the books to pay the fine");
		 window.location.href = "index.php"; 
		 </script>
            
            <?php
			
		}
		else
		{
				
				$query="Update fines set paid=1 where loan_id in (Select loan_id from book_loans where card_no='".$data1."')";
				$result=mysqli_query($con, $query);
				
				
				?>
                <script language="javascript"> 
				alert("You have successfully paid your fine."); 
				window.location.href = "index.php"; 
				</script>
                <?php
		}
			



?>