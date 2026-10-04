<?php
require_once __DIR__ . '/config.php';

// Handle Add Vehicle Form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    if ($connected) {
        $carno  = mysqli_real_escape_string($con, trim($_POST['carno']));
        $carn   = mysqli_real_escape_string($con, trim($_POST['carn']));
        $caro   = mysqli_real_escape_string($con, trim($_POST['caro']));
        $charge = mysqli_real_escape_string($con, trim($_POST['charge']));

        $query = "INSERT INTO park1 (carno, carn, caro, charge) VALUES ('$carno', '$carn', '$caro', '$charge')";
        if (mysqli_query($con, $query)) {
            header("Location: index.php?msg=added");
            exit();
        } else {
            $error = "Error adding record: " . mysqli_error($con);
        }
    }
}

// Handle Update Form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    if ($connected) {
        $carno  = mysqli_real_escape_string($con, trim($_POST['carno']));
        $carn   = mysqli_real_escape_string($con, trim($_POST['carn']));
        $caro   = mysqli_real_escape_string($con, trim($_POST['caro']));
        $charge = mysqli_real_escape_string($con, trim($_POST['charge']));

        $query = "UPDATE park1 SET carn='$carn', caro='$caro', charge='$charge' WHERE carno='$carno'";
        if (mysqli_query($con, $query)) {
            header("Location: index.php?msg=updated");
            exit();
        } else {
            $error = "Error updating record: " . mysqli_error($con);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Yoga's Parking System</title>
  
  <!-- CSS Dependencies -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- JS Dependencies -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    * {
      box-sizing: border-box;
    }
    body {
      background: linear-gradient(rgba(8, 10, 15, 0.72), rgba(8, 10, 15, 0.85)), url("car-1.jpeg") no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      color: #e2e8f0;
      display: flex;
      flex-direction: column;
    }
    .main-container {
      padding: 40px 15px;
      flex: 1;
    }
    .card {
      background: rgba(15, 20, 30, 0.82) !important;
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(255, 255, 255, 0.12) !important;
      border-radius: 20px !important;
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8);
      overflow: hidden;
    }
    .card-header {
      background: rgba(255, 255, 255, 0.03) !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
      padding: 28px 24px 22px !important;
    }
    .system-title {
      color: #ff3b4e;
      font-weight: 700;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-size: 28px;
      text-shadow: 0 0 25px rgba(255, 59, 78, 0.5), 0 2px 6px rgba(0, 0, 0, 0.9);
      margin-bottom: 18px;
    }
    .btn-add-new {
      background: linear-gradient(135deg, #e50914, #b20710);
      border: none;
      color: #fff !important;
      font-weight: 600;
      letter-spacing: 1px;
      padding: 10px 30px;
      border-radius: 30px;
      box-shadow: 0 4px 18px rgba(229, 9, 20, 0.45);
      transition: all 0.3s ease;
      cursor: pointer;
      text-decoration: none !important;
      display: inline-block;
    }
    .btn-add-new:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 25px rgba(229, 9, 20, 0.7);
      color: #fff !important;
    }
    .card-body {
      background: transparent !important;
      padding: 28px 24px;
    }
    .table-responsive {
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .table {
      margin-bottom: 0;
      background: rgba(10, 14, 22, 0.65) !important;
    }
    .table thead th {
      background: rgba(18, 24, 38, 0.95) !important;
      color: #f1f5f9;
      font-weight: 600;
      border: none !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 1px;
      padding: 14px 12px;
      text-align: center;
    }
    .table tbody tr {
      background: rgba(255, 255, 255, 0.02) !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
      transition: background 0.25s ease;
    }
    .table tbody tr:hover {
      background: rgba(255, 59, 78, 0.08) !important;
    }
    .table tbody td {
      border: none !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
      color: #e2e8f0;
      vertical-align: middle;
      text-align: center;
      padding: 12px 8px;
      font-size: 14px;
    }
    .table input[type='text'], .table input[type='number'] {
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 6px;
      color: #fff;
      padding: 6px 10px;
      text-align: center;
      font-weight: 500;
      width: 100%;
      max-width: 140px;
      transition: all 0.2s ease;
    }
    .table input[type='text']:focus, .table input[type='number']:focus {
      border-color: #ff3b4e;
      outline: none;
      background: rgba(255, 255, 255, 0.14);
      box-shadow: 0 0 0 2px rgba(255, 59, 78, 0.25);
    }
    .table input[readonly] {
      background: rgba(255, 255, 255, 0.04);
      border-color: rgba(255, 255, 255, 0.08);
      color: #94a3b8;
      cursor: not-allowed;
    }
    .btn-action-update {
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      border: none;
      color: #fff !important;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: 500;
      font-size: 13px;
      letter-spacing: 0.5px;
      transition: all 0.2s ease;
      cursor: pointer;
    }
    .btn-action-update:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
    .btn-action-delete {
      background: linear-gradient(135deg, #dc2626, #b91c1c);
      border: none;
      color: #fff !important;
      padding: 6px 14px;
      border-radius: 6px;
      font-weight: 500;
      font-size: 13px;
      letter-spacing: 0.5px;
      transition: all 0.2s ease;
      cursor: pointer;
      text-decoration: none !important;
      display: inline-block;
    }
    .btn-action-delete:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
      color: #fff !important;
    }
    .card-footer {
      background: rgba(10, 14, 22, 0.8) !important;
      border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
      color: #94a3b8 !important;
      padding: 16px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }
    .card-footer h6 {
      color: #f87171;
      margin: 0;
      font-size: 14px;
      font-weight: 500;
    }
    .footer-thankyou {
      color: #cbd5e1 !important;
      font-style: italic;
    }
    .modal-content {
      background: rgba(18, 24, 38, 0.96);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 18px;
      color: #f1f5f9;
      box-shadow: 0 25px 50px rgba(0, 0, 0, 0.85);
    }
    .modal-header {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 18px 24px;
    }
    .modal-header h5 {
      color: #ff4d5a;
      font-weight: 600;
      margin: 0;
    }
    .modal-footer {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 14px 24px;
    }
    .modal-body {
      padding: 24px;
    }
    .modal-body .form-control {
      background: rgba(255, 255, 255, 0.07);
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #fff;
      border-radius: 8px;
      padding: 10px 14px;
    }
    .modal-body .form-control:focus {
      background: rgba(255, 255, 255, 0.12);
      border-color: #ff3b4e;
      color: #fff;
      box-shadow: 0 0 0 3px rgba(255, 59, 78, 0.25);
    }
    .modal-body .form-control::placeholder {
      color: #94a3b8;
    }
    .btn-register {
      background: linear-gradient(135deg, #e50914, #b20710);
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 10px 24px;
      border-radius: 8px;
      width: 100%;
      box-shadow: 0 4px 15px rgba(229, 9, 20, 0.4);
      transition: all 0.2s ease;
    }
    .btn-register:hover {
      box-shadow: 0 6px 20px rgba(229, 9, 20, 0.6);
      color: #fff;
    }
    .alert-banner {
      background: rgba(239, 68, 68, 0.2);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #fca5a5;
      border-radius: 10px;
      padding: 12px 16px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
<div class="container main-container">
  <div class="card">
    <div class="card-header text-white">
      <h1 class="text-center system-title">
        <u><b>YOGA'S PARKING SYSTEM</b></u>
      </h1>
      <div class="text-center">
        <button type="button" id="demo" data-toggle="modal" data-target="#test" class="btn-add-new">
          <i class="fa fa-plus-circle mr-1"></i> ADD NEW
        </button>
      </div>
    </div>

    <div class="card-body">
      <?php if (!$connected): ?>
        <div class="alert-banner">
          <i class="fa fa-exclamation-triangle mr-2"></i>
          <strong>Database Notice:</strong> Unable to connect to MySQL database. 
          <?php if (isset($db_error)) echo "<br><small>" . htmlspecialchars($db_error) . "</small>"; ?>
          <br><small>If deploying on Vercel, please set DB_HOST, DB_USER, DB_PASS, and DB_NAME in your Vercel Environment Variables.</small>
        </div>
      <?php endif; ?>

      <?php if (isset($error)): ?>
        <div class="alert-banner">
          <i class="fa fa-times-circle mr-2"></i> <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Car No</th>
              <th>Car Name</th>
              <th>Car Owner</th>
              <th>Charges (Rs.)</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if ($connected) {
              $qry = "SELECT * FROM park1 ORDER BY carno ASC";
              $res = mysqli_query($con, $qry);
              $sno = 1;
              if ($res && mysqli_num_rows($res) > 0) {
                  while ($row = mysqli_fetch_assoc($res)) {
                      $carno  = $row['carno'];
                      $carn   = $row['carn'];
                      $caro   = $row['caro'];
                      $charge = $row['charge'];
          ?>
            <tr>
              <form action="index.php" method="POST">
                <td><?php echo $sno++; ?></td>
                <td><input type="text" name="carno" value="<?php echo htmlspecialchars($carno); ?>" readonly></td>
                <td><input type="text" name="carn" value="<?php echo htmlspecialchars($carn); ?>" required></td>
                <td><input type="text" name="caro" value="<?php echo htmlspecialchars($caro); ?>" required></td>
                <td><input type="number" name="charge" value="<?php echo htmlspecialchars($charge); ?>" required></td>
                <td>
                  <button type="submit" name="edit" class="btn-action-update mr-1" onclick="return confirm('Are you sure you want to update this record?')">
                    UPDATE
                  </button>
                  <a href="del1.php?del1=<?php echo urlencode($carno); ?>" class="btn-action-delete" onclick="return confirm('Are you sure you want to delete car #<?php echo htmlspecialchars($carno); ?>?')">
                    DELETE
                  </a>
                </td>
              </form>
            </tr>
          <?php
                  }
              } else {
                  echo '<tr><td colspan="6" class="text-center py-4 text-muted">No vehicles currently registered. Click "ADD NEW" above to add one.</td></tr>';
              }
          } else {
              echo '<tr><td colspan="6" class="text-center py-4 text-muted">Database disconnected. Please configure connection settings.</td></tr>';
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card-footer">
      <h6>
        <i class="fa fa-clock mr-1"></i>
        <?php 
          date_default_timezone_set("Asia/Kolkata");
          echo date("d/M/Y") . ' &bull; ' . date("h:i:s A"); 
        ?>
      </h6>
      <h6 class="footer-thankyou">Thank you! Visit again!!</h6>
    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="test" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-car mr-2"></i>Add New Vehicle</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="POST">
          <div class="form-group">
            <label class="small text-light">Car Number / Code</label>
            <input type="number" name="carno" class="form-control" required placeholder="e.g. 101">
          </div>
          <div class="form-group">
            <label class="small text-light">Car Name / Model</label>
            <input type="text" name="carn" class="form-control" required placeholder="e.g. Tesla Model 3">
          </div>
          <div class="form-group">
            <label class="small text-light">Owner Name</label>
            <input type="text" name="caro" class="form-control" required placeholder="e.g. John Doe">
          </div>
          <div class="form-group">
            <label class="small text-light">Parking Charges</label>
            <input type="number" name="charge" class="form-control" required placeholder="e.g. 50">
          </div>
          <button type="submit" name="submit" class="btn-register mt-2">
            <i class="fa fa-check-circle mr-1"></i> Register Vehicle
          </button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#test').draggable({
      handle: ".modal-header"
    });
  });
</script>
</body>
</html>
