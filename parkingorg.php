<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3RnW7gPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
</head>
<body style='background-size: cover;background-repeat: no-repeat;background-attachment: fixed;background-position: center;'>
<div class='container'>
<div class="card" id="parkingCard">
<div class="card-header text-white"  style='background-color:black'>
<h1 align='center' style='color:red'>
<u><b>YOGA'S PARKING SYSTEM</b></u></h1>
<div style="text-align: center;">
<button type='button'id='demo'data-toggle='modal'data-target='#test'class='p-2 mb-3 btn btn-primary'>
<a href='#' class='text-light'>ADD NEW</a>
</button>
</div>
</div>
<div class="card-body" style='background-color:lightgreen'>
<table id='parkingTable' class='table table-hover table-bordered table-dark'>
<thead>
<tr>
	<th>S.No</th>
	<th>Car.No</th>
	<th>Car Name</th>
	<th>Car Owner</th>
	<th>Charges</th>
	<th>Action</th>
</tr>
</thead>
<tbody style='color:black; font-size:14pt; font-family:Cursive, Arial, sans-serif;'>
<?php
$con = mysqli_connect('localhost','root','','park');
if (!$con)
{
    die("Database Connection Failed: " . mysqli_connect_error());
}
$qry = "SELECT * FROM park1";
$res = mysqli_query($con,$qry);
$sno = 1;
while ($row = mysqli_fetch_assoc($res))
{
    $carno  = $row['carno'];
    $carn   = $row['carn'];
    $caro   = $row['caro'];
    $charge = $row['charge'];
?>
<tr class='table-secondary'>
<form action='#' method='post'>
<td>
<?php echo $sno++; ?>
</td>
<td>
<input type='text'
name='carno'
size='5'
value='<?php echo htmlspecialchars($carno); ?>'
readonly>
</td>
<td>
<input type='text'
name='carn'
size='10'
value='<?php echo htmlspecialchars($carn); ?>'>
</td>
<td>
<input type='text'
name='caro'
size='10'
value='<?php echo htmlspecialchars($caro); ?>'>
</td>
<td>
<input type='text'name='charge'size='8'value='<?php echo htmlspecialchars($charge); ?>'>
</td>
<td>
<button type='submit'class='btn btn-secondary'style='margin-right:25px'name='edit'
onclick='return confirm("Are You Edit?")'>UPDATE</button>
<a href='del1.php? del1=<?php echo urlencode($carno); ?>'class='btn btn-danger'
onclick='return confirm("Are You Delete?")'>DELETE</a>
</td>
</form>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="card-footer" style='color:red;'>
<?php
date_default_timezone_set("Asia/Kolkata");
?>
<h6>
<?php
echo date("d/M/Y");
echo '<br>';
echo date("h:i:sa");
?>
</h6>
<h6 align=right>
Thank you! Visit again!!
</h6>
</div>
</div>
</div>
</div>
<script>
$('#demo').click(function()
{
    $('#test').draggable();
});
</script>
<div class='modal' id='test'>
<div class ='modal-dialog'>
<div class='modal-content'>
<div class='modal-header' style='background-color:green'>
<h5>Add New Car Details</h5>
</div>
<div class='modal-body' style='background-color:red'>
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
 
    <button type="submit" name='submit' class="btn-register">Register</button>
</form>
</div>
<div class='modal-footer' style='background-color:blue'>
<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
</div>
</div>
</div>
</div>
<?php
if(isset($_POST['submit']))
{
    $carno  = mysqli_real_escape_string($con,$_POST['carno']);
    $carn   = mysqli_real_escape_string($con,$_POST['carn']);
    $caro   = mysqli_real_escape_string($con,$_POST['caro']);
    $charge = mysqli_real_escape_string($con,$_POST['charge']);
    $query = "Insert INTO park1
              (carno,carn,caro,charge)
              VALUES
              ('$carno','$carn','$caro','$charge')";
    if(mysqli_query($con,$query))
    {
        echo '<script>
        location.replace("parkingorg.php");
        </script>';
    }
    else
    {
        echo "Invalid Connection! " . mysqli_error($con);
    }
}
if(isset($_POST['edit']))
{
    $carno  = mysqli_real_escape_string($con,$_POST['carno']);
    $carn   = mysqli_real_escape_string($con,$_POST['carn']);
    $caro   = mysqli_real_escape_string($con,$_POST['caro']);
    $charge = mysqli_real_escape_string($con,$_POST['charge']);
    $query = "UPDATE park1
              SET carn='$carn',
                  caro='$caro',
                  charge='$charge'
              WHERE carno='$carno'";
    if(mysqli_query($con,$query))
    {
        echo '<script>
        location.replace("parkingorg.php");
        </script>';
    }
    else
    {
        echo "Invalid Connection! " . mysqli_error($con);
    }
}
?>
<style>
body {
    background: linear-gradient(rgba(8, 10, 15, 0.65), rgba(8, 10, 15, 0.78)), url("car-1.jpeg") no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    margin: 0;
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: #e2e8f0;
  }
#parkingCard {
    cursor: move;
}
#parkingCard .card-body,
#parkingCard input,
#parkingCard button,
#parkingCard a {
    cursor: default;
}
</style>
<script>

$(document).ready(function()
{
    $('#parkingCard').draggable({
        containment: "body"
    });
});
</script>
</body>