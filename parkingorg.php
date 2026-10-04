<?php
/**
 * YOGA'S PARKING SYSTEM
 * Main Parking Page
 *
 * Database connection:
 * config.php
 * Supports:
 * - Local XAMPP
 * - TiDB Cloud
 * - Vercel
 */

require_once 'config.php';

if (!$con) {
    die("Database Connection Failed: " . mysqli_connect_error());
}


/* =========================================================
   ADD NEW CAR
   ========================================================= */

if (isset($_POST['submit'])) {

    $carno  = mysqli_real_escape_string($con, $_POST['carno']);
    $carn   = mysqli_real_escape_string($con, $_POST['carn']);
    $caro   = mysqli_real_escape_string($con, $_POST['caro']);
    $charge = mysqli_real_escape_string($con, $_POST['charge']);

    $query = "INSERT INTO park1
              (carno, carn, caro, charge)
              VALUES
              ('$carno', '$carn', '$caro', '$charge')";

    if (mysqli_query($con, $query)) {

        header("Location: parkingorg.php");
        exit;

    } else {

        $error_message = "Unable to add car: " . mysqli_error($con);
    }
}


/* =========================================================
   UPDATE CAR
   ========================================================= */

if (isset($_POST['edit'])) {

    $carno  = mysqli_real_escape_string($con, $_POST['carno']);
    $carn   = mysqli_real_escape_string($con, $_POST['carn']);
    $caro   = mysqli_real_escape_string($con, $_POST['caro']);
    $charge = mysqli_real_escape_string($con, $_POST['charge']);

    $query = "UPDATE park1
              SET carn='$carn',
                  caro='$caro',
                  charge='$charge'
              WHERE carno='$carno'";

    if (mysqli_query($con, $query)) {

        header("Location: parkingorg.php");
        exit;

    } else {

        $error_message = "Unable to update car: " . mysqli_error($con);
    }
}


/* =========================================================
   GET PARKING DATA
   ========================================================= */

$qry = "SELECT * FROM park1 ORDER BY carno";

$res = mysqli_query($con, $qry);

if (!$res) {
    die("Unable to load parking data: " . mysqli_error($con));
}

?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Yoga's Parking System</title>


    <!-- Bootstrap -->

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">


    <!-- jQuery -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>


    <!-- Popper -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3RnW7gPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>


    <!-- Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>


    <!-- jQuery UI -->

    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>


    <style>

        body {

            background:
            linear-gradient(
                rgba(8, 10, 15, 0.65),
                rgba(8, 10, 15, 0.78)
            ),
            url("car-1.jpeg")
            no-repeat
            center
            center
            fixed;

            background-size: cover;

            min-height: 100vh;

            margin: 0;

            font-family:
            'Poppins',
            -apple-system,
            BlinkMacSystemFont,
            'Segoe UI',
            Roboto,
            sans-serif;

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


        .card-header {

            background-color: #000000;

        }


        .parking-title {

            color: red;

            text-align: center;

            text-shadow:
            0 0 5px red,
            0 0 10px red,
            0 0 20px red;

        }


        .add-button {

            background-color: #ff0000;

            border: none;

            border-radius: 30px;

            padding: 12px 30px;

            font-weight: bold;

            box-shadow:
            0 0 10px red,
            0 0 20px red;

        }


        .add-button:hover {

            background-color: #cc0000;

        }


        .parking-body {

            background-color: rgba(144, 238, 144, 0.95);

        }


        .table {

            margin-bottom: 0;

        }


        .table input {

            border-radius: 5px;

            border: 1px solid #555;

            padding: 5px;

        }


        .modal-header {

            background-color: green;

            color: white;

        }


        .modal-body {

            background-color: red;

        }


        .modal-footer {

            background-color: blue;

        }


        .btn-register {

            background-color: white;

            color: red;

            border: none;

            padding: 10px 20px;

            border-radius: 5px;

            font-weight: bold;

        }


        .error-message {

            background-color: #8b0000;

            color: white;

            padding: 15px;

            margin-bottom: 15px;

            border-radius: 5px;

        }

    </style>

</head>


<body>

<div class="container">

    <div class="card" id="parkingCard">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="card-header text-white">

            <h1 class="parking-title">

                <u>

                    <b>

                        YOGA'S PARKING SYSTEM

                    </b>

                </u>

            </h1>


            <div style="text-align:center;">

                <button
                    type="button"
                    id="demo"
                    data-toggle="modal"
                    data-target="#test"
                    class="p-2 mb-3 btn btn-primary add-button">

                    <a href="#"
                       class="text-light"
                       style="text-decoration:none;">

                        <b>⊕ ADD NEW</b>

                    </a>

                </button>

            </div>

        </div>


        <!-- =================================================
             BODY
        ================================================== -->

        <div class="card-body parking-body">


            <?php

            if (isset($error_message)) {

                echo "<div class='error-message'>"
                     . htmlspecialchars($error_message)
                     . "</div>";

            }

            ?>


            <!-- =================================================
                 PARKING TABLE
            ================================================== -->

            <table id="parkingTable"
                   class="table table-hover table-bordered table-dark">


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


                <tbody style="
                    color:black;
                    font-size:14pt;
                    font-family:Cursive, Arial, sans-serif;
                ">


                <?php

                $sno = 1;


                while ($row = mysqli_fetch_assoc($res)) {

                    $carno  = $row['carno'];

                    $carn   = $row['carn'];

                    $caro   = $row['caro'];

                    $charge = $row['charge'];

                ?>


                <tr class="table-secondary">


                    <!-- S.NO -->

                    <td>

                        <?php echo $sno++; ?>

                    </td>


                    <!-- CAR NUMBER -->

                    <td>

                        <input
                            type="text"
                            name="carno"
                            size="5"
                            value="<?php
                            echo htmlspecialchars($carno);
                            ?>"
                            readonly>

                    </td>


                    <!-- CAR NAME -->

                    <td>

                        <input
                            type="text"
                            name="carn"
                            size="10"
                            value="<?php
                            echo htmlspecialchars($carn);
                            ?>"
                            readonly>

                    </td>


                    <!-- CAR OWNER -->

                    <td>

                        <input
                            type="text"
                            name="caro"
                            size="10"
                            value="<?php
                            echo htmlspecialchars($caro);
                            ?>"
                            readonly>

                    </td>


                    <!-- CHARGE -->

                    <td>

                        <input
                            type="text"
                            name="charge"
                            size="8"
                            value="<?php
                            echo htmlspecialchars($charge);
                            ?>"
                            readonly>

                    </td>


                    <!-- ACTION -->

                    <td>


                        <!-- UPDATE -->

                        <form
                            action=""
                            method="post"
                            style="display:inline-block;">

                            <input
                                type="hidden"
                                name="carno"
                                value="<?php
                                echo htmlspecialchars($carno);
                                ?>">


                            <input
                                type="hidden"
                                name="carn"
                                value="<?php
                                echo htmlspecialchars($carn);
                                ?>">


                            <input
                                type="hidden"
                                name="caro"
                                value="<?php
                                echo htmlspecialchars($caro);
                                ?>">


                            <input
                                type="hidden"
                                name="charge"
                                value="<?php
                                echo htmlspecialchars($charge);
                                ?>">


                            <button
                                type="submit"
                                class="btn btn-secondary"
                                name="edit"
                                onclick="
                                return confirm('Are You Edit?')
                                ">

                                UPDATE

                            </button>

                        </form>


                        <!-- DELETE -->

                        <a
                            href="del1.php?del1=<?php
                            echo urlencode($carno);
                            ?>"
                            class="btn btn-danger"
                            style="margin-left:10px;"
                            onclick="
                            return confirm('Are You Delete?')
                            ">

                            DELETE

                        </a>


                    </td>


                </tr>


                <?php

                }

                ?>


                </tbody>

            </table>


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <div class="card-footer"
                 style="color:red;">


                <?php

                date_default_timezone_set("Asia/Kolkata");

                ?>


                <h6>

                    <?php

                    echo date("d/M/Y");

                    echo "<br>";

                    echo date("h:i:sa");

                    ?>

                </h6>


                <h6 align="right">

                    Thank you! Visit again!!

                </h6>


            </div>


        </div>

    </div>

</div>


<!-- =========================================================
     ADD NEW CAR MODAL
========================================================= -->

<div class="modal"
     id="test"
     tabindex="-1"
     role="dialog">


    <div class="modal-dialog"
         role="document">


        <div class="modal-content">


            <!-- MODAL HEADER -->

            <div class="modal-header">

                <h5 class="modal-title">

                    Add New Car Details

                </h5>


                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close">

                    <span aria-hidden="true">

                        &times;

                    </span>

                </button>

            </div>


            <!-- MODAL BODY -->

            <div class="modal-body">


                <form
                    action=""
                    method="post">


                    <!-- CAR NUMBER -->

                    <div class="form-group">

                        <input
                            type="number"
                            name="carno"
                            class="form-control"
                            required
                            placeholder="Enter Car Code:">

                    </div>


                    <!-- CAR NAME -->

                    <div class="form-group">

                        <input
                            type="text"
                            name="carn"
                            class="form-control"
                            required
                            placeholder="Enter Car Name:">

                    </div>


                    <!-- CAR OWNER -->

                    <div class="form-group">

                        <input
                            type="text"
                            name="caro"
                            class="form-control"
                            required
                            placeholder="Enter Car Owner Name:">

                    </div>


                    <!-- CHARGE -->

                    <div class="form-group">

                        <input
                            type="number"
                            name="charge"
                            class="form-control"
                            required
                            placeholder="Enter The Charge:">

                    </div>


                    <!-- SUBMIT -->

                    <button
                        type="submit"
                        name="submit"
                        class="btn-register">

                        Register

                    </button>


                </form>

            </div>


            <!-- MODAL FOOTER -->

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal">

                    Close

                </button>

            </div>


        </div>

    </div>

</div>


<!-- =========================================================
     JAVASCRIPT
========================================================= -->

<script>

$(document).ready(function() {


    /*
     * Make parking card draggable
     */

    $('#parkingCard').draggable({

        containment: "body"

    });


    /*
     * Make modal draggable
     */

    $('#demo').click(function() {

        $('#test').draggable();

    });


});

</script>


</body>

</html>