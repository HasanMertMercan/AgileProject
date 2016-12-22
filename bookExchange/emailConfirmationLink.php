<?php
include("config.php");

if (empty($_GET["token"])) {
    echo 'Missing required information';
    return;
}

$token = htmlentities($_GET["token"]);

    $sql = "SELECT id FROM emailTokens WHERE token = '$token'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result);

if(empty($row["id"])) {
	echo 'User with this token is not found';
	return;
}

else {

    $sql2 = "UPDATE users SET emailConfirmed = '1' WHERE  '".$row['id']."'";

    $result2 = mysqli_query($db, $sql2);

    if($result2) {
        
    echo 'Thank You! Your email is now confirmed';        
         
    }
}
?>
