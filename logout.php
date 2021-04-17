<?php
    include_once "php/config.php";
    session_start();
    $user_id = $conn->real_escape_string(filter_input(INPUT_GET, 'user_id'));
    echo $user_id.'  1';
    if(!empty($user_id)){
        $status = "Offline now";
        echo $user_id.'  2';
        $sql = "UPDATE users SET status = '$status' WHERE unique_id = '$user_id'";
        echo $sql;
        $up_status = $conn->query($sql);
        if($up_status){
            session_unset();
            session_destroy();
            header("location:login.php");
        }
    }
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

