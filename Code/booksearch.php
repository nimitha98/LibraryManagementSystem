<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
<style>

#tt{
	padding: 5px;
	margin: 5px;
	
}
th, td {
	
	padding: 5px;
  color: white;
  text-align: left;
}
table {
    width: 100%;
    display:block;
}

tbody
{
	height: 500px;
    display: inline-block;
    width: 100%;
    overflow: auto;
}

#checkout_form
{
	float: right;
  clear: both;
} 

</style>
</head>
<body>
<div id="container1">
<?php
	include('connection.php');
	
	if (isset($_GET['keyword']))
	    $data=$_GET['keyword'];
	else 
		$data='';
	
	//echo $data;
	
	$query= " Select B.Isbn, B.Title, A.Name from book B INNER JOIN book_authors BA ON B.Isbn=BA.Isbn INNER JOIN authors A on BA.Author_id=A.Author_id where B.Isbn LIKE '%" . $data . "%' OR B.Title LIKE '%" . $data ."%' OR A.Name LIKE '%".$data."%'";
	//echo $query;
	$result = mysqli_query($con,$query);
	if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

	
	?>
<form action="booksearch.php" id="f1">
<input type="text" id="search" name="keyword" value=<?php echo $data?> >
<input type="submit" id="submit" value="SEARCH" name="searchsubmit">
</form>

<table id="tt" border="1">
	<tbody>
		<tr>
		<th>ISBN</th>
        <th>Title</th>
        <th>Author Name</th>
		<th>CheckOut</th>
		</tr>
     <?php
    while($row = mysqli_fetch_array($result))
            {
	?>
        
		<tr>
        <td>
		<?php echo $row['Isbn']?></td>
		<td><?php echo $row['Title']?></td>
		<td><?php echo $row['Name']?></td>
		<td><input type = "radio" id= "selected" name = "check" onclick = "alertok(this)" value ="<?php echo $row['Isbn'] ?>"></td>
		</tr>
		<?php 
			if (isset($_POST['check'])){
				echo $_POST['check']; // Displays value of checked checkbox.
			}
			}
			?>
	</tbody>

    </table>
	
	<form action = "./checkout.php" method = "post" id = "checkout_form">
	
	
	<input type = "submit" name = "checkout" onclick = "submitisbn()" id = "submit" value = "checkout">
	<input type = "text" name = "isbn" id="selectedis" value="10" placeholder = "Card Number" style = "display:none;"/>
	</form>


</div>
</body>
<script>
var isbn = "";
function alertok(c)
{
	//alert(documet.getElementById("select").value);
	isbn = c.value;
}
function submitisbn()
{
	if(isbn == "")
	{
		alert("please select a book");
		return false;
	}
	else{
		alert(isbn);
		document.getElementById("selectedis").value = isbn;
		return true;
		
	}
	       
}

</script>
</html>