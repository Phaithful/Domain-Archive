<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Domains</title>

    <!-- Linking Files Documents -->
    <link rel="stylesheet" href="assets/css/add-domain.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <!-- Linking Documents Ending -->

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
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
            <!-- Top section of the side bar ending -->


            <!-- Actual Side Bar Menu/Links -->
            <div class="sidebar">
                
                <a href="dashboard.php">
                    <span class="material-symbols-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a href="#" >
                    <span class="material-symbols-sharp">dns</span>                    
                    <h3>Domain</h3>
                </a>

                <a href="add-domain.php" class="active">
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


                <a href="auth/logout.php" class="logout">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
                

            </div>
            <!------------------- Actual Side Bar Menu ending ------------------------->

        </aside>
        <!---------------------- Collapsable Side Bar Ending --------------------------->


        <!---------- Main Section --------------------->
        <main>

            <!-- Top of right section -->
            <div class="top-right">

                <div class="top">

                    <button id="menu-btn">
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

            </div>




            <div class="main-section">
                <h1>Add Domain</h1>
            <div class="recent-domains">
                <h2>All Domains Added</h2>
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

        </div>

    </div>



        </main>
        <!---------- Main Section Ending --------------------->


    


    </div>
<script src="assets/js/add-domain.js"></script>
</body>


</html>