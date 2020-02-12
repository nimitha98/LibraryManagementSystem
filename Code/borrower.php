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
th, td {
  padding: 15px;
  text-align: left;
  color: white;
}
</style>
</head>
<body>
<div id="container">
<table>
<form class="form" method="get" action="borrower.php">

	<tr>
	<td>Please enter SSN</td>
    <td><input type="text" name="ssn" placeholder="SSN" required></td>
    </tr>
	
	<tr>
	<td>Please enter first name.</td>
    <td><input type="text" name="fname" placeholder="First Name" required></td>
	</tr>
	
	<tr>
	<td>Please enter last name</td>
    <td><input type="text" name="lname" placeholder="Last Name" required></td>
    </tr>
	
	 <tr>
	<td>Please enter  email address</td>
    <td><input type="text" name="emailaddress" placeholder="email Address" required></td>
    </tr>
	
     <tr>
	<td>Please enter address</td>
    <td><input type="text" name="address" placeholder="Address" required></td>
    </tr>
	
	<tr>
	<td>Please enter city</td>
    <td><input type="text" name="city" placeholder="City" required></td>
    </tr>
	
    <tr>
	<td>Please enter State</td>
    <td><input type="text" name="state" placeholder="State" required></td>
    </tr>

	<tr>
	<td>Please enter Phone Number</td>
    <td><input type="text" name="phone" placeholder="Phone Number" required></td>
    </tr>
	
    <tr><td><input type="submit" value="ADD" name="submit"></td></tr>
  </form>
  </table>
	<?php


		include('connection.php');
	
		if (isset($_GET['ssn']))
	    $data1=$_GET['ssn'];
		
		else $data1='';
		
		if (isset($_GET['fname']))
	    $data2=$_GET['fname'];
		
		else $data2='';
		
		if (isset($_GET['lname']))
	    $data3=$_GET['lname'];
		
		else $data3='';
		
		if (isset($_GET['emailaddress']))
	    $data4=$_GET['emailaddress'];
		
		else $data4='';
		
		
		if (isset($_GET['address']))
	    $data5=$_GET['address'];
		
		else $data5='';
		
		if (isset($_GET['city']))
	    $data6=$_GET['city'];
		
		else $data6='';
		
		if (isset($_GET['state']))
	    $data7=$_GET['state'];
		
		else $data7='';
		
		if (isset($_GET['phone']))
	    $data8=$_GET['phone'];
		
		else $data8='';
		
		if(isset($_GET['submit']))
			$data9=true;
		else
			$data9=false;
		
		
		if($data8)
		{
			$query1="Select count(*) as borrower_count from  borrower where Ssn='".$data1."'";
		$result1=mysqli_query($con,$query1);
		$row=mysqli_fetch_array($result1);
		$count=$row['borrower_count'];
		if($count>0)
		{	
		?>
			<script language="javascript">
			alert("Borrower already exists.");
			window.location.href = "borrower.php";
			</script>
		<?php
		}
		else
		{	
			 {echo '<script language="javascript"> alert("Entered the query ") </script>';}
			$insert_query="Insert into borrower (Ssn, fname, lname, email, address, city, state, phone) values('".$data1."','".$data2."','".$data3."','".$data4."','".$data5."','".$data6."','".$data7."', '".$data8."')";
			$result=mysqli_query($con,$insert_query);
			 {echo '<script language="javascript"> alert($result) </script>';}
			if($result)
			{
			?>
				<script language="javascript">
				alert("Borrower added successfully.");
				window.location.href = "index.php";
				</script>
			<?php
			}
			else
			{
				?>
				<script language="javascript">
				alert("Borrower could not be registered.");
				window.location.href = "borrower.php";
				</script>
			<?php
			}
		}
		}
?>

</div>
  </body>
  <?php
include 'footer.php'
?>
  </html>