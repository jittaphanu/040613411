<?php
include "connect.php";
session_start();
if(empty($_SESSION["username"])){
    header("location: login-form.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM product");
    $stmt->execute();
    if($_SESSION["role"] === 'member'){
        echo "<h1>สวัสดี" . $_SESSION["fullname"] . "</h1>";
        echo "<h3>สิทธิ์ของผู้ใช้ " . $_SESSION["role"] . "</h3>";
        echo "<h2>รายการสินค้า</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ชื่อสินค้า</th><th>ราคา (บาท)</th></tr>";
    while($row = $stmt->fetch()){
        echo "<tr>";
        echo "<td>" . $row["pname"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<a href='login-form.php'>ไปหน้า login </a>";
}
    ?>

    <?php
    $stmt = $pdo->prepare("SELECT orders.ord_id,member.username,product.pname,SUM(item.quantity)AS quantity,product.price FROM product JOIN item ON product.pid = item.pid JOIN orders ON orders.ord_id = item.ord_id JOIN member ON member.username = orders.username  GROUP BY orders.ord_id;");
    $stmt->execute();
    if($_SESSION["role"] ==='admin'){
        // echo "<h1>สวัสดี . $_SESSION['fullname'] . </h1>";
        echo "<h1>สวัสดี" . $_SESSION["fullname"] . "</h1>";
        echo "<h3>สิทธิ์ของผู้ใช้ " . $_SESSION["role"] . "</h3>";
        echo "<h2>รายการออร์เดอร์</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ออร์เดอร์</th><th>ชื่อผู้ใช้</th><th>สินค้า</th><th>จำนวน</th><th>ราคา (บาท)</th></tr>";
        while($row = $stmt->fetch()){
            if(isset($_SESSION['cart'])){
                unset($_SESSION['cart']);             
            }
            echo "<tr>";
            echo "<td><a href='cart.php?action=&ord_id=" . $row["ord_id"] . "'>" . $row["ord_id"] . "</a></td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["pname"] . "</td>";
            echo "<td>" . $row["quantity"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='login-form.php'>ไปหน้า login </a><br>";
        echo "<a href='stock.php'>ดูสินค้าในstock </a>";
    }
    ?>
</body>
</html>