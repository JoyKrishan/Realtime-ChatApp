<?php
    $conn = mysqli_connect("localhost", "root","", "sockim" );
    if($conn){
        
    }else{
        echo "Error" . $conn->connect_error;
    }
?>

