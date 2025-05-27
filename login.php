<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domain Archive</title>

    <!-- Document Links -->
    <link rel="stylesheet" href="login.css">
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
                <img src="images/logo.png" alt="logo image">
            </div>
            <h1>Access Solutions <br> Limited</h1>
            <h2>Domain Archive</h2>
            <hr class="underline">
            <p>Welcome back to your Domain Archive where your domain are securely stored, organized, and monitored. All your domain names in one Archive, it gives you a clean, categorized overview of your entire Domain List</p>
            <a href="index.php">Don't have an Account? <span>Sign Up</span></a>

            
            
        </div>
        <!-- Details div Ending -->

        
        <!-- Form div -->
        <div class="container form-div">
            <h1 class="welcome-txt">WELCOME BACK!</h1>
            <hr class="welcome-line">

            <div class="form-bg">
                <h1>Log <span>In</span></h1>
                <form action="">
                    <div class="inputs-div">
                        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail / User Name">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password">
                    </div>

                    <div>
                        <input type="submit" name="submit" value="SUBMIT" class="submit">
                    </div>

                    <a href="#">Forgot Password?</span></a>
                </form>
            </div>
            
        </div>
        <!-- Form div Ending -->

    </section>

</body>


</html>