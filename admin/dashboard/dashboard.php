<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Document Links -->
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp" rel="stylesheet">

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
                    <img src="../../images/logo.png" alt="logo">
                    <h2>Access <span class="logo-span">Solution</span></h2>
                </div>

                <div class="close" id="closeBtn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <!-- Top section of the side bar ending -->


            <!-- Actual Side Bar Menu/Links -->
            <div class="sidebar">
                
                <a href="#" class="active">
                    <span class="material-symbols-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="#" >
                    <span class="material-symbols-sharp">dns</span>                    
                    <h3>Domain</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-sharp">bring_your_own_ip</span>
                    <h3>Registrars</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">notifications</span>
                    <h3>Messages</h3>
                    <span class="notification-count">18</span>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Settings</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">add</span>
                    <h3>Add Domain</h3>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
                

            </div>
            <!------------------- Actual Side Bar Menu ending ------------------------->

        </aside>
        <!---------------------- Collapsable Side Bar Ending --------------------------->



        <main>

            <h1>Dashboard</h1>

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


        </main>


    </div>
    
</body>


</html>