<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>
table{
	margin: 20px;
	left-padding: 20px;
	top-padding: 20px;
}
th, td{
  padding: 20px;
  text-align: left;
  color: white;
}
p{
	margin: 30px;
	text-align: left;
  color: white;
}
</style>
</head>
<body>
<div id="container">
<?php
include('connection.php');
	
	if (isset($_GET['isbn']))
	    $data1=$_GET['isbn'];
		
	elseif (isset($_POST['isbn'])) 
        $data1=$_POST['isbn'];
	else $data1 = '';
	
		
		if (isset($_GET['card_no']))
	    $data2=$_GET['card_no'];
		
		else $data2='';
		
		if(isset($_GET['submit1']))
			$data3=true;
		else 
			$data3=false;
		
 
	
?>

<form action="checkout.php" >
<table>

<tr style="font-size:20px"><td>Enter the following details for checking out: </td></tr>
<tr><td>ISBN :</td><td> <input type="text" name ="isbn" id="isbn" value=<?php echo $data1?> ></td></tr>
<tr><td>Card Number:</td><td> <input type="text" name= "card_no" id="card_no" value=<?php echo $data2?> ></td></tr>
<tr><td><button type="submit" name="submit1"> Check-Out</button></td></tr>
</table>
<?php
if($data3==true)
//query

{	$query1= " Select * from BOOK where Isbn = '".$data1."'";
	//echo $query1;
	$result1 =mysqli_query($con,$query1);	
    $count1=mysqli_num_rows($result1);
			 //echo "1";
	
    $query2= "SELECT * FROM borrower WHERE Card_no = '".$data2."'";
	//echo $query2;
	$result2 =mysqli_query($con,$query2);	
    $count2=mysqli_num_rows($result2);
	//echo "2";		 
		 
		if ( $count1 == 0)
		//if ( $count1 < 0)
		 {echo '<script language="javascript"> alert("Enter the Correct ISBN to check-out a book.. ") </script>';}
		elseif (  $count2 == 0)
		//if ( $count1 < 0)
		 {echo '<script language="javascript"> alert("Enter the Correct Card Number  to check-out a book.. ") </script>';}
		     else
			 { 
			      //query
				   $query3=" SELECT * FROM BOOK_LOANS where Card_no = '".$data2."'AND Date_in= '0000-01-01' ";
				   $result3 = mysqli_query($con,$query3);
				   $count3=mysqli_num_rows($result3);
				   //echo $query3;
				   //echo "3";
				   if ( $count3 >= 3)
				   echo '<script language="javascript"> alert("You cannot check out the book as you already have 3 loans ") </script>';
			 
				        else{ 
						     //query
							 $query4="SELECT No_of_copies FROM BOOK WHERE Isbn = '".$data1."'";
							 $result4 =mysqli_query($con,$query4);
							 $count4=mysqli_fetch_array($result4);
							 
							 $query5=" SELECT * FROM BOOK_LOANS where Book_id ='".$data1."' AND Date_in = '0000-01-01' ";
							 $result5 =mysqli_query($con,$query5);
							 $count5=mysqli_num_rows($result5);
							 	
							 $available_copies=$count4['No_of_copies'] - $count5; 
							  if ( $available_copies <= 0 )
							   echo '<script language="javascript"> alert("Sorry !! No available copies at the moment for checking out.") </script>';
							    else
									 {
									 
									$query6="Select count(*) from book_loans where card_no='".$data2."' and Book_id ='".$data1."' and Date_in = '0000-01-01'";
									$result6=mysqli_query($con, $query6);
									$row6=mysqli_fetch_array($result6);
									if($row6['count(*)']==0)
									{
										$query7="Select count(*) from book_loans bl inner join fines f on bl.loan_id=f.loan_id where card_no = '".$data2."' and bl.loan_id in (select loan_id from fines where fine_amt>0 AND paid is false)";
									//echo $query7;
									$result7=mysqli_query($con, $query7);
									$row7=mysqli_fetch_array($result7);
									//echo $row7['count(*)'];
									if($row7['count(*)']==0)
									{
							 $insert_query=" Insert into BOOK_LOANS (book_id, card_no, date_out, due_date, date_in) values('".$data1."','".$data2."','".date("Y/m/d")."',"."DATE_add(date_out,INTERVAL 14 DAY)".",'0000-01-01')";    
							//echo ($insert_query); 
							
							//mysqli_query($con,'Use Project');
							mysqli_query($con,'SET FOREIGN_KEY_CHECKS = 0');
                            $result_query=mysqli_query($con,$insert_query);
							
							echo '<script language="javascript"> alert("Book Checked-out successfully.") </script>';
							//echo ($insert_query);
									}
									else
									{
										echo '<script language="javascript"> alert("you have unpaid fines, so cant checkout books")</script>';
										
									}
									}
									else
									{
										echo '<script language="javascript"> alert("You have already checked out this book!!")</script>';
									}
}}}}

					   
						
                   
						
						
						
	?>		   
	
	

</form>
</div>
</body><?php
include 'footer.php'
?>
</html>