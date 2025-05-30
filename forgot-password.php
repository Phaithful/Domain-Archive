<!DOCTYPE html>
<html lang="en">


<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Archive</title>

     <!-- Document Links -->
    <link rel="stylesheet" href="forgot-password.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <!-- Document Links End -->


</head>


<body>
    
    <!-- Nab Bar Beginning -->
    <nav class="nav-bar">

        <div class="left-nav">
            <a href="https://accessng.com/" >
                <img src="images/logo.png" alt="logo" width="50" height="46">
                <p class="name-txt">Access Solutions Limited</p>
            </a>
        </div>

        <div class="right-nav">
            <p>Don't have an account? <a href="index.php">Sign up</a></p>
        </div>

    </nav>
    <!-- Nav Bar Ending -->


    <!-- Body Section -->
    <section class="hero">
        
        <img src="images/icons/forgot-password.png" alt="Forgot Password Icon" class="forgot-img">

        <h1>Forgot your password?</h1>
        <p>Enter your Email so we can send you a password reset code</p>

        <div class="inputs-div">
            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
        </div>

        <input type="submit" id="submit_btn" name="submit" value="Send Email" class="submit">

        <a href="login.php" class="back-to-login">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#323842" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
            </svg>
            <p> Back to Login</p>
        </a>
        <p class="no-account">Don't have an account? <a href="index.php">Sign In</a></p>
            
    </section>
    <!-- Body Section Ending -->

</body>

<!-- JQuesy CDN Link-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Linking JavaScript file -->
<script src="forgot-password.js"></script>


</html>