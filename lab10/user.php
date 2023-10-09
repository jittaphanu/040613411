<?php
    if(isset($_POST['submit'])){
        session_start();
        $_SESSION['name'] = ($_POST['name']);
        $_SESSION['email'] = ($_POST['email']);

        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        
        
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
    <h4>ยินดีต้อนรับคุณ <?php echo $name;?> ด้วยemail <?php echo $email;?></h4>
    <a href="index3.php">ไปปปปป</a>
</body>
</html>