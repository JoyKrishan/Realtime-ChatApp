<!-- model -->
<?php
    session_start();
    if (!isset($_SESSION['unique_id']) ) {
        header("location:login.php");
    }
?>


<!--view-->
<?php include_once "common.php"; ?>
        <body>
            <div class="container">
                <section class="users">
                    <header>
                         <?php 
                        include_once "php/config.php";  
                         // Select the user with session_id;
                         $sql = $conn->query("SELECT * FROM users WHERE unique_id= {$_SESSION['unique_id']}");
                         if($sql->num_rows>0){
                            $row = $sql->fetch_assoc();
                         }
                        ?>
                    <div class="content">
                        <img src="images/<?= $row['image']; ?>" alt="alt"/>
                        <div class="details">
                            <span><?= $row["first_name"]." ".$row["last_name"]; ?></span>
                            <p><?= $row["status"]; ?></p>
                        </div>   
                    </div>
                        <a href="logout.php?user_id=<?= $row['unique_id']; ?>" class="logout">Logout</a>
                        </header>
                  <!-- Not using the search option in this version -->
                    <div class="search" style="display:none" >
                        <span class="text">Select an user to chat</span>
                        <input type="text" placeholder="Search with name..">
                        <button><i class="fa fa-search"></i></button>
                    </div>
                    <div class="active-users">
                        <h4>Select an user to chat</h4>
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="users-list">
                        
                        <!-- Making it Dynamic from here -->
                        
                    </div>
                </section>
            </div>
            <script src="javascript/users.js"></script>
            
        </body>
    </html>
