<?php
require_once __DIR__ . '/config.php';

if (isset($_GET['del1']) && !empty($_GET['del1']) && $connected) {
    $carno = mysqli_real_escape_string($con, trim($_GET['del1']));
    $qry = "DELETE FROM park1 WHERE carno = '$carno'";
    mysqli_query($con, $qry);
}

header("Location: index.php?msg=deleted");
exit();
?>