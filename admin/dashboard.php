<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Document Links -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <!-- Document Links End -->

</head>


<body>
    
    
    <div class="container">



        <!----------------- Collapsable Side Bar ----------------------->
        <aside>

            <!-- Top section of the side bar [Logo & Company Name]-->
            <div class="top">
                <div class="logo">
                    <img src="../images/logo.png" alt="logo">
                    <h2>Access <span class="logo-span">Solution</span></h2>
                </div>

                <div class="close" id="closeBtn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>
            <!-- Top section of the side bar ending -->


            <!-- Actual Side Bar Menu/Links -->
            <div class="sidebar">
                
                <a href="#" class="active">
                    <span class="material-symbols-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="all-domains.php" >
                    <span class="material-symbols-sharp">dns</span>                    
                    <h3>Domain</h3>
                </a>

                <a href="add-domain.php">
                    <span class="material-symbols-sharp">add</span>
                    <h3>Add Domain</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">bring_your_own_ip</span>
                    <h3>Registrars</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">notifications</span>
                    <h3>Messages</h3>
                    <span class="notification-count">18</span>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">settings</span>
                    <h3>Settings</h3>
                </a>


                <a href="auth/logout.php">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
                

            </div>
            <!------------------- Actual Side Bar Menu ending ------------------------->

        </aside>
        <!---------------------- Collapsable Side Bar Ending --------------------------->


        <!---------- Main Section --------------------->
        <main>

            <h1>Dashboard</h1>

            <!------------------ Insight End --------------------->
            <div class="insights">

                <!--------------- Active Card ----------------->
                <div class="active">
                    <span class="material-symbols-sharp">domain</span>
                    
                    <div class="middle">
                        <div class="left">
                            <h3>Active</h3>
                            <h1>45</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38'cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>56.25%</p>
                            </div>
                        </div>
                    </div>

                    <small class="text-muted">
                        last 24 Hours
                    </small>
                </div>
                <!--------------- Active Card End ----------------->


                <!--------------- Expire Soon Card ----------------->
                <div class="soon">
                    <span class="material-symbols-sharp">domain_disabled</span>
                    
                    <div class="middle">
                        <div class="left">
                            <h3>Expire Soon</h3>
                            <h1>10</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38'cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>12.5%</p>
                            </div>
                        </div>
                    </div>

                    <small class="text-muted">
                        last 24 Hours
                    </small>
                </div>
                <!--------------- Expire Soon Card End ----------------->


                <!--------------- Expired Card ----------------->
                <div class="expired">
                    <span class="material-symbols-sharp">warning</span>
                    
                    <div class="middle">
                        <div class="left">
                            <h3>Expired</h3>
                            <h1>25</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx='38'cy='38' r='36'></circle>
                            </svg>
                            <div class="number">
                                <p>31.25%</p>
                            </div>
                        </div>
                    </div>

                    <small class="text-muted">
                        last 24 Hours
                    </small>
                </div>
                <!--------------- Expired Card End ----------------->

            </div>
            <!------------------ Insight End --------------------->


            <div class="recent-domains">
                <h2>Recent Domains Added</h2>
                <table>

                    <thead>
                        <tr>
                            <th>Domain Name</th>
                            <th>Status</th>
                            <th>Expiry Date</th>
                            <th>Auto Renew</th>
                            <th>Registrar</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php include 'auth/recent-domains.php'; ?>
                    </tbody>


                </table>
                <a href="#">Show All</a>
            </div>


        </main>
        <!---------- Main Section Ending --------------------->


        <div class="right">

            <!-- Top of right section -->
            <div class="top">

                <button id="menuBtn">
                    <span class="material-symbols-sharp">segment</span>
                </button>

                <div class="theme-toggler">
                    <span class="material-symbols-sharp active">light_mode</span>
                    <span class="material-symbols-sharp">dark_mode</span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p style="display: flex;">Hey<b>, Faithful</b></p>
                        <small class="text-muted">Admin</small>
                    </div>

                    <div class="profile-photo">
                        <img src="../images/profile/male.png" alt="">
                    </div>

                </div>

            </div>
            <!----------- Top of right section Ending ---------------->


            <!-------------- Domain Analytics --------------->
            <div class="domain-analytics">

                <h2>Domain Analytics</h2>

                <div class="item active">
                    <div class="icon">
                        <span class="material-symbols-sharp">domain</span>
                    </div>
                
                    <div class="right">
                        <div class="info">
                            <h3>Active</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="success">56.25%</h5>
                        <h3>45</h3>
                    </div>
                </div>

                <div class="item expire-soon">
                    <div class="icon">
                        <span class="material-symbols-sharp">domain_disabled</span>
                    </div>
                
                    <div class="right">
                        <div class="info">
                            <h3>Expire Soon</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="warning">12.5%</h5>
                        <h3>10</h3>
                    </div>
                </div>

                <div class="item expired">
                    <div class="icon">
                        <span class="material-symbols-sharp">warning</span>
                    </div>
                
                    <div class="right">
                        <div class="info">
                            <h3>Expired</h3>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <h5 class="danger">31.25%</h5>
                        <h3>25</h3>
                    </div>
                </div>



                <div class="item add-domain">
                    <a href="add-domain.php">
                        <span class="material-symbols-sharp">add</span>
                        <h3>Add Domain</h3>
                    </a>
                </div>

            </div>


            <!---------- Recent Updates ---------->
            <div class="recent-updates">
                <h2>Recent Updates</h2>
                <div class="updates">

                    <div class="update" >
                        <div class="profile-photo">
                            <span class="material-symbols-sharp">person</span>
                        </div>
                        <div class="message">
                            <p><b>Edited Your Profile </b>You Changed your
                            Profile Photo</p>
                            <small class="text-muted">3 Hours Ago</small>
                        </div>
                    </div>

                    <div class="update" >
                        <div class="profile-photo">
                            <span class="material-symbols-sharp">password</span>
                        </div>
                        <div class="message">
                            <p><b>Changed Password </b>You Changed your
                            Login Password</p>
                            <small class="text-muted">17 Minutes Ago</small>
                        </div>
                    </div>

                    <div class="update" >
                        <div class="profile-photo">
                            <span class="material-symbols-sharp">delete</span>
                        </div>
                        <div class="message">
                            <p><b>Deleted Domain </b>You Deleted the 
                            Gouni.ed.ng Domain</p>
                            <small class="text-muted">1 Day Ago</small>
                        </div>
                    </div>
                    
                </div>
            </div>

            <!---------- End of Recent Updates ----------->

        </div>


    </div>
    
    <!-- <script src="assets/js/domain-list.js"></script> -->
    <script src="assets/js/dashboard.js"></script>
    

    
</body>


</html>