<?php include './connect.php'; 
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username=?");
    $stmt->bindParam(1,$_POST["username"]);
    $stmt->execute();
    $row=$stmt->fetch();
?>
<html>
    <head><meta charset="utf-8"></head>
    <body>
        <form action="./lab9no9_b.php" method="post" enctype="multipart/form-data">
            <h2>แก้ไขmember:</h2><br>
            แก้ไขภาพ: <input type="file" name="file"><br>
            <img src="img/<?=$row["id"]?>.jpg" width="100"><br>
            <input type="hidden" name="id" value="<?=$row["id"]?>">
            Username:<input type="text" name="username" value="<?=$row["username"]?>"><br>
            Password:<input type="password" name="password" value="<?=$row["password"]?>"><br>
            Name: <input type="text" name="namess"value="<?=$row["name"]?>"><br>
            Address: <textarea name="address" rows="3" cols="40" ><?=$row["address"]?></textarea><br>
            mobile: <input type="text" name="moblie" value="<?=$row["mobile"]?>"><br>
            email: <input type="text" name="email" value="<?=$row["email"]?>"><br>
            <input type="submit" name="submit" value="แก้ไข">
        </form>
    </body>

</html>