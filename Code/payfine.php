<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>
table, td{
	margin: 20px;
	left-padding: 20px;
	top-padding: 20px;
	padding: 20px;
	color: white;
}
#tt{
	padding: 20px;
	margin: 40px;
	font-size: 30;
	
}
</style>
</head>
<body>
<div id="container">
<?php
		
		include ( "connection.php");
		   
		   if (isset($_GET['card_no']))
	    $data1=$_GET['card_no'];
		
		else $data1='';
		
		
		
		?>
<table>
<form class="form" method="get" action="payfine.php">

	<tr>
	<td>CARD NUMBER</td>
    <td><input type="text" name="card_no" value="<?php echo $data1?>" required></td>
    </tr>
	<tr><td><button type="submit" name="button">Check Fine</button></td></tr>
	</table>
	
<?php
	   
	   
	   	   
		//query
	if(isset($_GET['button']))	
	{
		$query=" SELECT * FROM BOOK_LOANS BL INNER JOIN FINES F ON BL.loan_id=F.loan_id where card_no ='".$data1."' and F.paid = 0 ";
		$result =mysqli_query($con,$query);
		$row=mysqli_fetch_array($result);
		
		if($row['Fine_amt'] > 0)
		
		{
			
		?>
		
		<table id="tt">
		<tr><td>Fine Amount: </td> <td><?php echo $row['Fine_amt'];?> </td></tr>
		
       <tr ><td> <a  id="aa" href="fineprocess.php?card_no=<?php echo $data1?>">CLICK HERE TO PAY FINE </a></td></tr>
	   </table>
		 
		<?php
		
		}
		else
		{
		?>   
	     
         <script language="javascript"> alert("You dont have any pending fine. Thanks!")</script>
         
         
         <?php
		 
		}
	}
		?>
		
		</div></body>
		<?php
include 'footer.php'
?>
</html>