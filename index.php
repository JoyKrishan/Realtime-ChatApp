<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> SockIM </title>
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <section class="form signup">
                <header>SockIM</header>
                <form action="#" enctype="multipart/form-data">
                    <div class="error-txt"> </div>
                    <div class="user-fields">
                        <div class="user_name">
                        <div class="field input">
                            <label>First Name</label>
                            <input type="text" placeholder="Your first name" name="firstname" required>
                        </div>
                          <div class="field  input">
                            <label>Last Name</label>
                            <input type="text" placeholder="Your last name" name="lastname" required>
                        </div>
                        </div>
                          <div class="field input">
                              <label>Email Address</label>
                            <input type="text" placeholder="Email address" name="email" required>
                        </div>
                         <div class="field input">
                            <label>Password</label>
                            <input type="password" placeholder="Password" name="password" required>
                      
                        </div>
                        <div class="field image">
                            <label>Select Image</label>
                            <input type="file" name="image" required>
                        </div>
                        <div class="field button">
                            <input type="submit" value="Create account">   
                        </div>
                    </div>
                </form>
                <div class="link"> Already signed up? <a href="login.php">Login Now </a></div>
            </section>
        </div>
        <script src="javascript/signup.js"></script>
    </body>
</html>
