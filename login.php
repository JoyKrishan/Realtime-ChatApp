    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width , initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title> SockIM </title>
            <link rel="stylesheet" href="style.css"/>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>
        <body>
            <div class="container">
                <section class="form login">
                    <header>SockIM</header>
                    <form action="#">
                        <div class="error-txt"> This is an error message! </div>
                        <div class="user-fields">

                            <div class="field input">
                                 <label>Email Address</label>
                                <input type="text" placeholder="Email address" name="email" required>
                            </div>
                             <div class="field input">
                                <label>Password</label>
                                <input type="password" placeholder="password" name="password" required>
                             </div>
                          
                            <div class="field button">
                                <input type="submit" value="Continue to Chat">   
                            </div>
                        </div>
                    </form>
                    <div class="link"> Not yet signed? <a href="index.php">Sign Up </a></div>
                   
                </section>
                
                <script src="javascript/login.js"> </script>
               
            </div>
    
        </body>
    </html>
