<?php
require("DBconnected.php");

$email=$_POST["email"];
$query="SELECT * FROM mail WHERE email='$email'";
$result=mysqli_query($link,$query);

if(mysqli_num_rows($result)){
    echo "<script type='text/javascript'>";
    echo "alert('您已訂閱過');";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content='0; url=emailSubscription.php'>";
}else{
    $SQL="INSERT INTO mail (email) VALUES ('$email')";
    if(mysqli_query($link, $SQL)){
    echo "<script type='text/javascript'>";
    echo "alert('成功加入訂閱');";
    echo "</script>";
    echo "<meta http-equiv='Refresh' content='0; url=emailSend.php'>";
    }
}

?>