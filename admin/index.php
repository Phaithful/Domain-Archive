<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Domain Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body data-theme="light">
  <div class="container-fluid">
    <div class="row">
    <div class="col-md-2 sidebar p-0">
    <!-- Logo Section -->
    <div class="logo-wrapper bg-white text-center py-3">
        <img src="assets/images/access-solutions-logo.png" alt="Company Logo" style="height: 50px;">
    </div>

    <!-- Sidebar Heading -->
    <h4 class="text-center py-3">Access Admin</h4>

        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-globe"></i> Domains</a>
        <a href="#"><i class="fas fa-users"></i> Users</a>
        <a href="#"><i class="fas fa-coins"></i> Subscriptions</a>
        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 p-4">
        <!-- Navbar -->
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3>Dashboard Overview</h3>
          <button class="btn btn-outline-dark" onclick="toggleTheme()">
            <i class="fas fa-adjust"></i> Toggle Theme
          </button>
        </div>

        <!-- Dashboard Cards -->
        <div class="row dashboard-cards g-4">
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Total Domains</h5>
              <p class="fs-4">1,250</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Expiring Soon</h5>
              <p class="fs-4">120</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Active Users</h5>
              <p class="fs-4">4,750</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center p-3">
              <h5>Total Revenue</h5>
              <p class="fs-4">$32,000</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/main.js"></script>
  </script>

</body>

</html>
