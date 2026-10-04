<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
</head>
<body style='background-image: url("car-1.jpeg"); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;'>
<div class='container'>
<div class="card">
  <div class="card-header  text-white">
    <h1 align='center' style='color:red'>
	 <u><b>YOGA'S PARKING SYSTEM</b></u></h1>
	 <div style="text-align: center;">
    <button type='button' id='demo' data-toggle='modal' 
	 data-target='.modal'  class='p-2 mb-3 btn btn-primary'>
	<A href='#' class='text-light'>ADD NEW</A>
	</button>
	</div>
  </div>
  <div class="card-body" style='background-color:lightgreen'>
    <table class='table table-hover table-bordered table-dark'>
<thead>
<tr>
  <th>S.No</th>
  <th>Car.No</th>
  <th>Car Name</th>
  <th>Car Owner</th>
  <th>Charges</th>
</tr>
</thead>
<tbody style='color:black; font-size:14pt;font: Cursive bold 16px/1.5 Arial,sans-serif;'>
<?php
$con = mysqli_connect('localhost','root',null,'park');
$qry ="select * from park1";
$res=mysqli_query($con,$qry);
$sno=1;
while ($row=mysqli_fetch_array($res))
{
	$carno = $row['carno'];   //$row[0]
	$carn = $row[1];      //$row['name']
	$caro = $row['caro'];   //$row['rate']
	      //$row['stock']
	$charge=$row['charge'];
?>	
 <form action='#' method='post'>
 <tr class='table-secondary'>	
  <td><?php echo $sno++; ?></td>
  <td><input type='text' name='carno' size=5 value='<?php echo $carno; ?>'readonly </td>
  <td><input type='text' name='carn' size=5 value='<?php echo $carn; ?>'</td>
  <td><input type='text' name='caro' size=5 value='<?php echo $caro; ?>'</td>
  <td><input type='text' name='charge' size=5 value='<?php echo $charge; ?>'</td>
  <td>
  <button type='submit' class= 'btn btn-secondary' style='margin-right:25' name='edit'>
	<a href='#' class='text-light' 
	onclick='return confirm("Are You Edit")'>UPDATE</a>
	</button>
	<button type='button' class='btn btn-danger'>
	<a href='del1.php ?del="<?php echo $carno; ?>"' class='text-light' 
	onclick='return confirm("Are You Delete")'>DELETE</a>
	</button>
 </td>
 </form>
 <tr>
<?php } ?>
</tbody>
</table>
<div class="card-footer" style='color:red
;'>
<h6> <?php echo date("d/M/Y"),'<br>'; 
           date_default_timezone_set("Asia/kolkata");
            echo date("h:i:sa");
      ?></h6>
<h6 align=right> Thank you! Visit again!!</h6>
  </div>

 </div>
</div>
</div>

<script>
 $('#demo').click(function() {
	 $('#test').draggable();
 });
</script>

<div class='modal' id='test'>
<div class ='modal-dialog'>
<div class='modal-content'>
<div class='modal-header' style='background-color:green'>
<h5>Add New Items</h5>
</div>
<div class='modal-body' style='background-color:blue'>
<form action='#' method='post'>
 <div class="form-group">
    <input type='number' name='carno' class="form-control" required placeholder='Enter Car Code: '>
 </div>
 <div class="form-group">
     <input type='text' name='carn' class="form-control" required placeholder='Enter Car Name: '>
 </div>
 <div class="form-group">
     <input type='text' name='caro' class="form-control" required placeholder='Enter Car Owner Name: '>
 </div>
 <div class="form-group">
      <input type='number' name='charge' class="form-control" required placeholder='Enter The Charge: '>
 </div>
 
    <button type="submit" name='submit' class="btn btn-warning">Register</button>
</form>
</div>
<div class='modal-footer'style='background-color:red'>
<button type='button' class='btn btn-secondary' data-dismiss='modal' >Close</button>
</div>
</div>
</div>
</div>
<?php
if(isset($_POST['submit'])) {
$carno=$_POST['carno'];
$carn=$_POST['carn'];
$caro=$_POST['caro'];
$charge=$_POST['charge'];
$con = mysqli_connect('localhost','root',null,'park');
$query= "Insert into park1 values('$carno','$carn','$caro','$charge')";
if(mysqli_query($con, $query))
  echo '<script> location.replace("parkingorg.php")</script>';
else
  echo "Invalid Connection!";
}
?>
<?php
if(isset($_POST['edit'])) {
$carno=$_POST['carno'];
$carn=$_POST['carn'];
$caro=$_POST['caro'];
$charge=$_POST['charge'];
$con = mysqli_connect('localhost','root',null,'park');
$query= "Update park1 set carn='$carn',caro='$caro',charge='$charge' where 
carno='$carno'";
if(mysqli_query($con, $query))
  echo '<script> location.replace("parkingorg.php")</script>';
else
  echo "Invalid Connection!";
}
?>
</body>
