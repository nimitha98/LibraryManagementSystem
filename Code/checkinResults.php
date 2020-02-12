<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>
table td{
	color: white;
}
</style>
</head>
<body>
<?php
	
	include('connection.php');
	
  if (isset($_GET['book_id']))
	    $data1=$_GET['book_id'];
		
		else $data1='';		
			
	if (isset($_GET['card_no']))
	    $data2=$_GET['card_no'];
		 
		else $data2='';
		
		if (isset($_GET['fname']))
	    $data3=$_GET['fname'];
		
		else $data3='';
		
	$query=" UPDATE BOOK_LOANS SET date_in='" .date("Y/m/d"). "' where book_id='".$data1."' and card_no='".$data2."' AND Date_in ='0000-01-01'";
	//echo $query;	
	
	$result =mysqli_query($con,$query);
	
	if(mysqli_affected_rows($con) > 0 ){
		?>
		<script language="javascript">
		alert("Book Checked-in successfully.");
		window.location.href = "checkin.php";
	</script>
	<?php
	}
	else{
		?>
		<script language="javascript">
		alert("Book Check-in failed.");
		window.location.href = "checkin.php";
		</script>
		<?php
	}
	?>
	</body>
	<?php
include 'footer.php'
?>
</html>