<?php
    session_start();
    include_once "config.php";
    if (!isset($_SESSION['unique_id'])){
        header("location:../login.php");
    }
    $outgoing_id = $conn->real_escape_string(filter_input(INPUT_POST, 'outgoing_id'));
    $incoming_id = $conn->real_escape_string(filter_input(INPUT_POST, 'incoming_id'));
    
    $output="";
    
    $sql = "SELECT * FROM messages WHERE outgoing_id='$outgoing_id' AND incoming_id='$incoming_id'
            OR outgoing_id='$incoming_id' AND incoming_id='$outgoing_id' ORDER BY msg_id ASC";
    
    $query = $conn->query($sql);
    if($query->num_rows > 0){
        $picture_sql = $conn->query("SELECT image FROM users LEFT JOIN messages ON users.unique_id = '$incoming_id'");
        $image_name = $picture_sql->fetch_assoc()["image"];
        while($row = $query->fetch_assoc()){
            if($row['outgoing_id'] === $outgoing_id){ //user text
                $output .=   '<div class="chat outgoing">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
            }else{  // opponent text
                $output .=  '<div class="chat incoming">
                            <img src="images/'.$image_name.'" alt="">
                            <div class="details">
                                <p>'.$row['msg'].'</p>
                            </div>
                            </div>';
            }
                
            }
     
    }
    echo $output;

?>
