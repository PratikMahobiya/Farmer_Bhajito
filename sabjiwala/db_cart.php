<?php
    include("../db_con.php");
    session_start();
    if(isset($_GET['submit'])) {
        $cust_id = $_SESSION['id'];
        $id = $_GET['id'];
        $quantity = $_GET['quantity'];
        $q = $_GET['q'];
        // if($quantity > $q) header("Location: db_cart.php?id=$id");
        $insert = mysqli_query($con, "INSERT INTO before_checkout(stock_id, quantity, cust_id) VALUES($id, $quantity, $cust_id)");
        if($insert) {
            $res = mysqli_query($con, "SELECT quantity FROM stock WHERE id='$id'");
            if($r = mysqli_fetch_array($res)) {
                $q = $r['quantity'];
                // echo $q;
                $new_q = ($q - $quantity);
                $run = mysqli_query($con, "UPDATE stock SET quantity = $new_q WHERE id = '$id'");
                if ($run) header("Location: checkout.php");
                else echo "Couldn't add order";
            }
             header("Location: checkout.php");
        }
        else header("Location: db_cart.php?inv=true");
    }
?>

<?php
    $id = $_GET['id'];
    $result = mysqli_query($con, "SELECT * FROM stock WHERE id='$id'");
    if($row = mysqli_fetch_array($result)) {
?>
    <form class="form" method="get" action="db_cart.php">
        Item Name: <span><?php echo $row['name']; ?></span><br>
        Item Price: <span><?php echo $row['price']; ?></span><br>
        <input type="text" name="quantity" style="width: 30%;" onchange = "checkQ()" class="form-control checkQuantity" placeholder="Enter less than or equal to <?php echo $row['quantity']; ?> KG">
        <input type="hidden" name="q" class="maxQ" value="<?php echo $row['quantity']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <input type="submit" name="submit" class="submit form-control btn btn-primary" value="Order">
    </form>
<?php
    }
?>

<script>
    function checkQ() {
        var form = document.getElementsByClassName('form');
        var q = document.getElementsByClassName('checkQuantity')[0].value;
        var max = document.getElementsByClassName('maxQ')[0].value;
        console.log(q + " " + max);
        // if(q < max) {
        //     console.log(q + " " + max);
        //     alert("Not enough stock available");
        // }
    }
</script>