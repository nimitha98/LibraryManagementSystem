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
<a href="index.php" id="aa">BACK TO HOMEPAGE</a>
 <?php
	   
	   
	   	   include ( "connection.php");
	 

        //query
		
		$query= " SELECT * from book_loans where (date_in = '0000-01-01' and '".date("y/m/d")."' > due_date) OR ( date_in <> '0000-01-01' AND date_in > due_date)";
		//echo $query;
		$result =mysqli_query($con,$query);
		
			while($row=mysqli_fetch_array($result))
				{
					 //query
					 
					 if($row['Date_in']=='0000-01-01')
					 {
						 $date1=new DateTime($row['Due_date']);
						 $date2=new DateTime(date("Y/m/d"));
						 $diff=date_diff($date1,$date2);
						 $diff1=$diff->format("%R%a days");
						 //echo $diff1;
						 $diff2=explode("+",$diff1);
						 $diff3=explode(" ",$diff2[1]);
						 $fine=$diff3[0]*0.25; 
						 
						 
						 
						 
					 }
					 else
					 {
						 $date1=new DateTime($row['Due_date']);
						 $date2=new DateTime($row['Date_in']);
						 $diff=date_diff($date1,$date2);
						 $diff1=$diff->format("%R%a days");
						 $diff2=explode("+",$diff1);
						 $diff3=explode(" ",$diff2[1]);
						 $fine=$diff3[0]*0.25; 
						  
						 
						 
					 }
					  
					 $query1= " Select count(*) from FINES where loan_id='".$row['Loan_id']."'";
					 $result1 =mysqli_query($con,$query1);
					 $count1=mysqli_fetch_array($result1);
					 $count=$count1['count(*)'];
					 
					 if ($count > 0 )
					 {
					 
					 	
							 $query2= " Select * from FINES where loan_id='".$row['Loan_id']."'";
							 $result2 =mysqli_query($con,$query2);
							 $row2=mysqli_fetch_array($result2);
					 
					 		if($row2['Paid']==0)
					 
					 { 
					 
					 //query to update the fine 
					   $query2="UPDATE FINES SET fine_amt= ".$fine." where loan_id=".$row['Loan_id'];
					   //echo $query2;
					   $result2 =mysqli_query($con,$query2);
					 }
					 
					 
						 
						 
				}
					 
					 
					 
			  else 
			       {
					   
					   //query
					   
					   $query2= " Insert into FINES (loan_id, fine_amt, Paid) values (".$row['Loan_id'].",".$fine.",'0' )";
					   //echo $query2;
						 $result2 =mysqli_query($con,$query2);
							      
				
				
				
				
				
				
				
				}
								   
							    
				}
				
				?>
		<script language="javascript">
		alert("All records updated with latest fine");
		window.location.href = "index.php";
	</script>
	
	</div>
	
</body>

<?php 
include "footer.php";
?>
</html>