<?php include "./connect.php" ?>

<html>
    <head><meta charset="utf-8"></head>
    <?php
        $stmt = $pdo->prepare("SELECT * FROM product WHERE pid LIKE ?");
            if(!empty($_GET)){
                $value = '%' .$_GET["pid"]. '%';
            }
            $stmt->bindParam(1,$value);
            $stmt->execute();
            $row = $stmt->fetch()
    ?>

        <div style="display:flex">
            <div><img src="img/product_photo/<?=$row["pid"]?>.jpg" width="200"><br></div>
                <div style="padding: 15px;">
                <h2><?=$row["pname"]?></h2><br>
                รายละเอียดสินค้า: <?=$row["pdetail"]?><br>
                ราคาขาย: <?=$row["price"]?> บาท<br><br>
                ซื้อวันนี้ลด 10% เหลือ <?=$row["price"]*0.9?>

            </div>
        </div>
        
</html>  