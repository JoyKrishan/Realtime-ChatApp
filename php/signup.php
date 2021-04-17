<?php
    include_once "config.php";
    session_start();
    $fname = $conn->real_escape_string(filter_input(INPUT_POST, 'firstname'));
    $lname = $conn->real_escape_string(filter_input(INPUT_POST, 'lastname'));
    $email = $conn->real_escape_string(filter_input(INPUT_POST, 'email'));
    $password = $conn->real_escape_string(filter_input(INPUT_POST, 'password'));
    
    $extensions = ['png', 'jpeg', 'jpg'];
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if( filter_var($email, FILTER_VALIDATE_EMAIL)){ //if email is valid
            // check if the email already exists in the database
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email= '$email' ");
            if ($sql->num_rows> 0){ //if the email already exists
                echo "$email - This email already exists!";
            }
            else{
                // if the email is validate and not registered, checking if file uploaded.
                
                if(isset($_FILES['image'])){ // if the user uploaded a file
                    $img_name = $_FILES['image']['name'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $name_arr = explode('.', $img_name);
                    $img_extn = end($name_arr);
                    //echo "Image name is".$img_extn;
                    
                    if(in_array($img_extn, $extensions) === true){
                        $time = time(); 
                        $new_image_name = $time.$img_name;
                        $moved = move_uploaded_file($tmp_name, "../images/".$new_image_name);
                        #echo "The new location".$tmp_name;
                        if($moved){
                            $status ="Active now";
                            $rand_id = rand(time(), 1000000000);   
                            // Everything is perfect so now we can insert the data
                         
                            //INSERT INTO `users`(`unique_id`, `first_name`, `last_name`, `email`, `password`, `image`, `status`) VALUES (3273292,'joy','das','joykrishan10@gmail.com','023922','ncvjcxz','Active now')
                            $insert_sql = $conn->query("INSERT INTO users (unique_id, first_name, last_name, email, password, image, status) VALUES ( '$rand_id', '$fname', '$lname', '$email', '$password', '$new_image_name', '$status')");
                    
                    
                            if($insert_sql){
                                $get_sql = $conn->query("SELECT * FROM users WHERE email= '$email'");
                                
                                if($get_sql->num_rows > 0){
                                    $row = mysqli_fetch_assoc($get_sql);
                                    $_SESSION['unique_id'] = $row['unique_id'];
                                    echo "success";
                                }
                            }else{
                                echo "Something went wrong";
                            }    
                                    
                        }
                    }else{
                        echo "Please select an image file";
                    }
                    
                }else{
                    echo "Please upload your image";
                }
                
            }
        }else{
            echo "$email - This is not valid email";
        }
    }else{
        echo "All input fields are required";
    }
    
?>