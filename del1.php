<body>
<?php
$carno=$_GET['del'];
$con = mysqli_connect('localhost','root',null,'park');
$qry="Delete from park1 where carno='$carno'";
$s=mysqli_query($con,$qry);
if ($s)
	echo "<script>location.replace('parkingorg.php')</script>";
else
	echo "Connection Failed";

?>
</body>