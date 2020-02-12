<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>
#tt{
	padding: 20px;
	margin: 40px;
	
}
th, td {
  padding: 20px;
  text-align: left;
  color: white;
}
p{
	margin: 30px;
	text-align: left;
  color: white;
}
.but1
{
	margin: 40px;
}
	
</style>
</head>
<body>
<div id="container">
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
		
	
?>
<form action="checkin.php" >
<font color="white">
<b><h3><p>Enter the following details for checking in: </p></h3></b>
<br>
<table>
<tr>
<td>Book Id :</td><td> <input type="text" name ="book_id" id="book_id" value="<?php echo $data1?>" required></td>
</tr>
<tr>
<td>Card no:</td><td> <input type="text" name= "card_no" id="card_no" value="<?php echo $data2?>" required></td>
</tr>
<tr>
<td>Borrower First Name:</td><td> <input type="text" name= "fname" id="fname" value="<?php echo $data3?>"></td>
</tr>
<tr>
<td><button type="submit" name="sub">Show filtered books</button></td>
</tr>
</table>	
                

	<br><br><h3><p>All Checked Out Books</p></h3>		


				


<?php

//query

$query=" SELECT * FROM BOOK_LOANS BL INNER JOIN BOOK B ON BL.book_id=B.Isbn inner join Borrower C on C.card_no = BL.card_no where B.Isbn LIKE '%" . $data1 . "%' and BL.card_no LIKE '%" . $data2 ."%' AND C.fname LIKE '%".$data3."%' AND BL.Date_in ='0000=01=01'";
	//echo $query;
	
	$result =mysqli_query($con,$query);
	?>
	<table id="tt" border= "1"	>
	<tr>
	<th width="25%">ISBN</th>
	<th width="25%">Card No</th>
	<th width="25%">First Name</th>
	
	</tr>
	<?php 
	
    while($row=mysqli_fetch_array($result))
	{
?>		
				<tr>
				<td><?php echo $row['Isbn']?></td>
				<td><?php echo $row['Card_no']?></td>
				<td><?php echo $row['Fname']?></td>
				</tr>
				
				
           <?php
	}
	?> 
	</table>
	
	<br>
	<?php
	if(isset($_GET['sub']))
	{
		?>
		<button class="but1" id ="<?php echo $data1.$data2.$data3 ?>" data-data1="<?php echo $data1;?>" data-data2="<?php echo $data2;?>" data-data3="<?php echo $data3;?>" onclick="myFunction(this.id)"> Click to CheckIN </button>	
	<?php 
	}
	?>

            
                
<script>

function myFunction(x) {
	x = document.getElementById(x);
  	var data1=x.getAttribute("data-data1");
	var data2=x.getAttribute("data-data2");
	var data3=x.getAttribute("data-data3");
	var url='checkinResults.php?book_id=' + data1 + '&card_no=' + data2 + '&fname=' + data3;
	
    setTimeout(function(){document.location.href = url},1);
	}
	
</script>
     </div>           
</body>
<?php
include 'footer.php'
?>
</html>

