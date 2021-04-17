<?php 
    session_start();
    include_once "config.php";
    $output="";
    $sql = "SELECT * FROM users WHERE status='Active now' AND NOT unique_id={$_SESSION['unique_id']}";
    $search = $conn->query($sql);
    
    if($search->num_rows==1){ // Online one user active that is the user itself;
        $output .= "<p>No users are available to chat</p>";
        
    }elseif($search->num_rows>1){
        while($row = $search->fetch_assoc()){
        $msg_sql = "SELECT * FROM messages WHERE incoming_id = {$row['unique_id']}";
        $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                       <div class="content">
                      <img src="images/'.$row['image'].'" alt="#">
                       <div class="details">
                      <span>'.$row['first_name']." ".$row['last_name'].'</span>
                       
                                  
                        </div>
                        </div>
                        <div class="status-dot"><i class="fa fa-circle"></i></div>
                        </a>';
        }
    }
    echo $output;
    

?>