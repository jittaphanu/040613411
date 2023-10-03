<?php 

include "connect2.php";
 
$targetDir = "./img/"; 
if(isset($_POST["submit"])){ 
    $txtName = $_POST["namess"];
    $txtEmail = $_POST["email"];
    $txtAddress = $_POST["address"];
    $txtPhone = $_POST["moblie"];
    $txtUsername = $_POST["username"];
    $txtpassword = $_POST["password"];
    $insert = "INSERT INTO `member` (`username`, `password`, `name`, `address`, `mobile`,`email`) VALUES ('$txtUsername', '$txtpassword', '$txtName', '$txtAddress', '$txtPhone', '$txtEmail')";
    $rs = mysqli_query($con,$insert);
    $insertedId = mysqli_insert_id($con);
    if(!empty($_FILES["file"]["name"])){ 
        //get file name
        $fileName = basename($_FILES["file"]["name"]); 
        $editfilename = $insertedId . '.jpg';
        $targetFilePath = $targetDir . $editfilename;  
            // Upload file to server 
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                //$insert = $con->query("INSERT INTO member (username, password, name, address, mobile, email) VALUES ('$txtUsername', '$txtpassword', '$txtName', '$txtAddress', '$txtPhone', '$txtEmail')");
                if($rs){ 
                    header("location: ./lab9no8.php");
                }else{ 
                    echo "File upload failed, please try again."; 
                }  
            }else{ 
                echo "Sorry, there was an error uploading your file."; 
            } 
        
    }else{ 
        echo 'Please select a file to upload.'; 
    } 




}


 

?>  