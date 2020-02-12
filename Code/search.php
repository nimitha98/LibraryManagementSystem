<?php
include "header.php";
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css"/>
</head>
<body>
<div id="container">
<font color="white">
<?php
	include('connection.php');
	
	if (isset($_GET['search']))
	    $data=$_GET['search'];
	else 
		$data='';
	
	echo $data;
	
	$query= " Select B.Isbn, B.Title, A.Name from book B INNER JOIN book_authors BA ON B.Isbn=BA.Isbn INNER JOIN authors A on BA.Author_id=A.Author_id where B.Isbn LIKE '%" . $data . "%' OR B.Title LIKE '%" . $data ."%' OR A.Name LIKE '%".$data."%'";
	//echo $query;
	$result = mysqli_query($con,$query);
	if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

	
	?>
<table id="t">
        <tr>
        <thead>ISBN</thead>
        <thead>Title</thead>
        <thead>Author Name</thead>
        </tr>
        <tbody>
 
    
    <?php
    while($row = mysqli_fetch_array($result))
            {
?>
        <tr>
        <td style="width:10%"></td>
        <td style=";width:10%;text-align:left;font-weight:200">
		<?php echo $row['Isbn']?></td>
		<td><?php echo $row['Title']?></td>
		<td><?php echo $row['Name']?></td>
		<?php 
			}
			?>
	</tr>
    </tbody>
    </table>
	</font>
</div>
</body>
<?php
include 'footer.php'
?>
</html>