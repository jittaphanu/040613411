<?php
    $username = $_GET["user"];
    $con = mysqli_connect('localhost','root','','workshoplab8');
    $sql = "SELECT * FROM member WHERE username LIKE '%$username%'";
    $result = mysqli_query($con,$sql);
?>
<table border="1">
    <?php while($row = mysqli_fetch_array($result)):?>
        <th>
        image
        
        </th>

        <th>
            username          
        </th>
        <th>
            name          
        </th>
        <th>
            address          
        </th>




        <tr>
            <td><img src="./image/<?php echo $row["id"]?>.jpg" width="100"></td>
            <td><?php echo $row["username"]?></td>
            <td><?php echo $row["name"]?></td>
            <td><?php echo $row["address"]?></td>
        </tr>
        <?php endwhile;?>


</table>