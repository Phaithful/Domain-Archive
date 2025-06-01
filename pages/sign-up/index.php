<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Archive</title>

    <!-- Document Links -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com"> <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <!-- Document Links End -->


</head>
<body>
    
    <section class="hero">
        <!-- dividing the home page into 2 sections, one for details and one for the actual form -->

        <!-- Details div -->
        <div class="container details-div">
            <div class="logo">
                <img src="../../images/logo.png" alt="logo image">
            </div>
            <h1>Access Solutions <br> Limited</h1>
            <h2>Domain Archive</h2>
            <hr class="underline">
            <p>The Domain Archive is a centralized platform designed to securely store, organize, and monitor all your domain names in one place. Whether you own 5 or 500 domains, it gives you a clean, categorized overview of your entire Domain List</p>
            <a href="../login/login.php">Already have an account? <span>Log In</span></a>       
            
        </div>
       <!-- Details div Ending -->

        
        <!-- Form div -->
        <div class="container form-div">
            <div class="form-bg">
                <h1>Sign <span>Up</span></h1>
        <form action="auth/signup.php" method="post">
            <div class="inputs-div">
                <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name">
                <input class="form-control" type="text" name="lname" id="lname" placeholder="Last Name">
                <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
            </div>
            <div>
                <input type="submit" name="submit" value="SUBMIT" class="submit">
            </div>
        </form>

            </div>
            
        </div>
        <!-- Form div Ending -->

    </section>

</body>


</html>