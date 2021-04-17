<?php   
    include_once "config.php";
    session_start();
    $email = $conn->real_escape_string(filter_input(INPUT_POST, "email"));
    $password = $conn->real_escape_string(filter_input(INPUT_POST, "password"));
    
    #echo "Hi from Login Page";
    if ( !empty($email) && !empty($password) ){
        $search_sql = $conn->query("SELECT * FROM users WHERE email = '$email' AND password= '$password'");
        if($search_sql-> num_rows >0){
            $row = $search_sql->fetch_assoc();
            //update the "status" when the user logs in
            $status="Active now";
            $sql2= "UPDATE users SET status = '$status' WHERE unique_id = {$row['unique_id']}";
            $update_status_query = $conn->query($sql2);
            if($update_status_query){
            $_SESSION['unique_id'] = $row['unique_id'];
            echo "success";
            }
        }else{
            echo "Email or Password is incorrect";
        }
    }
    else{
        echo "All input fields required";
    }
?>

