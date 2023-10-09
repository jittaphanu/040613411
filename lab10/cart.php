<?php

session_start();

include "./connect.php";
    if (!empty($_GET["ord_id"])) {
    $ord_id = $_GET["ord_id"];
    $stmt2 = $pdo->prepare("SELECT orders.ord_id,member.username,product.pname,item.quantity,product.pid,product.price FROM product JOIN item ON product.pid = item.pid JOIN orders ON orders.ord_id = item.ord_id JOIN member ON member.username = orders.username WHERE orders.ord_id=?" );
    $stmt2->bindParam(1, $ord_id);
    $stmt2->execute();
    while ($row2 = $stmt2->fetch()) { 
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
            }
            $pid = $row2["pid"];
            $pname=$row2["pname"];
            $price = $row2["price"];
            $qty = $row2["quantity"];
            $cart_item = array(
                'pid' => $pid,
                'pname' => $pname,
                'price' => $price,
                'qty' => $qty
                );
            // ถ้ายังไม่มีสินค้าใดๆในรถเข็น
            if(empty($_SESSION['cart']))
                $_SESSION['cart'] = array();

            // ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
            if(array_key_exists($pid, $_SESSION['cart'])){
                $_SESSION['cart'][$pid]['qty'] = $qty;

            }

            // หากยังไม่เคยเลือกสินค้นนั้นจะ
            else
                $_SESSION['cart'][$pid] = $cart_item;


   }
    }
?> <?php




// เพิ่มสินค้า
if ($_GET["action"]=="add") {

	$pid = $_GET['pid'];

	$cart_item = array(
 		'pid' => $pid,
		'pname' => $_GET['pname'],
		'price' => $_GET['price'],
		'qty' => $_POST['qty']
	);

	// ถ้ายังไม่มีสินค้าใดๆในรถเข็น
	if(empty($_SESSION['cart']))
    	$_SESSION['cart'] = array();
 
	// ถ้ามีสินค้านั้นอยู่แล้วให้บวกเพิ่ม
	if(array_key_exists($pid, $_SESSION['cart']))
		$_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
 
	// หากยังไม่เคยเลือกสินค้นนั้นจะ
	else
	    $_SESSION['cart'][$pid] = $cart_item;

// ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"]=="update") {
	$pid = $_GET["pid"];     
	$qty = $_GET["qty"];
	$_SESSION['cart'][$pid]['qty'] = $qty;

// ลบสินค้า
} else if ($_GET["action"]=="delete") {
	
	$pid = $_GET['pid'];
	unset($_SESSION['cart'][$pid]);
}
?>

<html>
<head>
<script>
	// ใช้สำหรับปรับปรุงจำนวนสินค้า
	function update(pid) {
		var qty = document.getElementById(pid).value;
		// ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
		document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
	}
</script>
</head>
<body>
<form>
<table border="1">
<?php 
	$sum = 0;
	foreach ($_SESSION["cart"] as $item) {
		$sum += $item["price"] * $item["qty"];
?>
	<tr>
		<td><?=$item["pname"]?></td>
		<td><?=$item["price"]?></td>
		<td>			
			<input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1" max="9">
			<a href="#" onclick="update(<?=$item["pid"]?>)">แก้ไข</a>
			<a href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
		</td>
	</tr>
<?php } ?>
<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
</table>
</form>

<a href="index.php">< เลือกสินค้าต่อ</a>
</body>
</html>