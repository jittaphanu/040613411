<?php
    include "./connect.php"; 
?>
<html>
    <head><meta charset="utf-8"></head>
    <body>
        <?php
            $stmt = $pdo->prepare("DELETE FROM member WHERE username=?");
            $stmt->bindParam(1,$_GET["username"]);
            if($stmt->execute()){
                echo "ลบข้อมูลจากurlสำเร็จ";
                // header("location: ./lab8_8.php");
            } 
        ?>
    </body>
</html>