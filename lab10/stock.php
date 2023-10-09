<?php
include "connect.php";
?>
<?php
		$stmt = $pdo->prepare("SELECT * FROM product");
		$stmt->execute();
		while ($row = $stmt->fetch()) { 
	?>
		<div style="padding: 15px; display:block;">
			<a href="detail.php?pid=<?=$row["pid"]?>">
				<img src='img/<?=$row["pid"]?>.jpg' width='100'></a><br>
			<?=$row ["pname"]?><br><?=$row ["price"]?> บาท<br>	
			คงเหลือ: <?=$row["quantity"]?>
		</div>
	<?php } ?>
	</div>
<html>
    <body>
        <a href="user-home.php">Backtohome</a>
    </body>
</html>