<?php include "connect.php" ?>
<html>
    <head><meta charset="utf-8"></head>
    <body>
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
            if(!empty($_GET)){
                $value = '%' .$_GET["username"]. '%';

            }
            $stmt->bindParam(1,$value);
            $stmt->execute();
            $row = $stmt->fetch()
        ?>
        ชื่อสมาชิก: <?=$row["name"]?><br>
        ที่อยู่: <?=$row["address"]?><br>
        เบอร์โทรศัพท์: <?=$row["mobile"]?><br>
        mail: <?=$row["email"]?><br>
    </body>
</html>