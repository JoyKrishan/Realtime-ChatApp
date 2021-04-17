<!-- model -->
<?php
session_start();
if(!isset($_SESSION['unique_id'])){
    header("location:login.php");
}


?>
<!-- view -->
<?php include_once "common.php"; ?>
        <body>
            <div class="container">
                <section class="chat-area">
                    <header>
                        <?php 
                            include_once "php/config.php";
                            $user_id = $conn->real_escape_string(filter_input(INPUT_GET, 'user_id'));
                            // echo $user_id;
                            $sql = $conn->query("SELECT * FROM users WHERE unique_id = '$user_id'");
                            if($sql->num_rows > 0){
                                $row = $sql->fetch_assoc();
                            
                            }
                        ?>
                    <div class="content">
                        <a href="users.php"><i class="fa fa-arrow-left"></i></a>
                        <img src="images/<?= $row['image']; ?>" alt="alt"/>
                        <div class="details">
                            <span><?= $row['first_name']." ".$row['last_name']; ?></span>
                            <p><?= $row['status']; ?></p>
                        </div>   
                    </div>
                       
                        </header>
                    <div class="chat-box">
                        <!-- Getting all the chats -->
             
                    </div>
                    <form action="#" class="typing-area">
                        <input type="text" name="incoming_id" value="<?= $user_id; ?>" hidden>  <!-- other_user -->
                        <input type="text" name="outgoing_id" value="<?= $_SESSION['unique_id']; ?>" hidden>  <!-- session_user -->
                        <input class="input-field" type="text" name="input-field" placeholder="Type message here..">
                        <button><i class="fa fa-envelope"></i></button>
                        </form>
         
                </section>
            </div>
            <script src="javascript/chats.js" ></script>
        </body>
    </html>
