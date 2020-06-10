<?php
    include('../db_con.php');
    session_start();
    if(!isset($_GET['bcq']) && isset($_GET['id'])) {
        header("../index.php");
    }
    $bcq = $_GET['bcq'];
    $id = $_GET['id'];
    $sid = $_GET['sid'];

    $deleteCheckout = mysqli_query($con, "DELETE FROM before_checkout WHERE id='$id'");
    if($deleteCheckout) {
        $getQuantityFromStock = mysqli_query($con, "SELECT quantity FROM stock WHERE id='$sid'");
        $row = mysqli_fetch_array($getQuantityFromStock);
        $stockQuantity = $row['quantity'];
        $new_q = $stockQuantity + $bcq;
        $updateStock = mysqli_query($con, "UPDATE stock SET quantity = '$new_q' WHERE id='$sid'");
        if($updateStock) header("Location: checkout.php");
    } else echo "Couldn't be rmeoved";

?>