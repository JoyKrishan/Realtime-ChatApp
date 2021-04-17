<?php
    include_once "config.php";
    
    $outgoing_id = $conn->real_escape_string(filter_input(INPUT_POST, 'outgoing_id'));
    $incoming_id = $conn->real_escape_string(filter_input(INPUT_POST, 'incoming_id'));
    $message = $conn->real_escape_string(filter_input(INPUT_POST, 'input-field'));
    
    echo $message.$outgoing_id." ".$incoming_id;
    if(!empty($message)){
        //echo $message."22";
        //INSERT INTO `messages`(`msg_id`, `outgoing_id`, `incoming_id`, `msg`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $insert_sql = $conn->query("INSERT INTO messages (outgoing_id, incoming_id, msg) VALUES ('$outgoing_id', '$incoming_id', '$message')") or die();
        echo "successful";
       
    }
  
?>

