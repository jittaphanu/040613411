<html>
    <head><meta charset = "utf-8"></head>
    <body>
        <?php include "connect.php"?>    
        <?php
            $stmt = $pdo->prepare("SELECT * FROM member");
            $stmt->execute();
            while($row = $stmt->fetch()){
        ?>
            ชื่อสมาชิก: <?=$row["name"]?><br>
            ที่อยู่: <?=$row["address"]?><br>
            อีเมล: <?=$row["email"]?><br>
            <img src="img/<?=$row["id"]?>.jpg" width="100"><br>
            <a href='./lab9no6.php?username=<?=$row["username"]?>'>ลบ</a>
            <hr>
        <?php }?>
    </body>
</html>