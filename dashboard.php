<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SDG 1.4 Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa; /* light gray background */
        margin: 0;
    }

    /* Sidebar */
    #sidebar {
        height: 100vh;
        background-color: #b71c1c; /* hint of red */
        color: white;
        padding-top: 20px;
        min-width: 220px;
    }

    #sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 12px 20px;
        transition: 0.3s;
    }

    #sidebar a:hover {
        background-color: #d32f2f; /* slightly brighter red on hover */
        border-radius: 5px;
    }

    /* Content */
    #content {
        flex-grow: 1;
        padding: 30px;
    }

    /* Cards */
    .card-summary {
        background-color: #fff3f3; /* very light red/pink */
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .card-summary:hover {
        box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    }

    /* Buttons */
    .btn-red {
        background-color: #b71c1c;
        border-color: #b71c1c;
        color: white;
    }

    .btn-red:hover {
        background-color: #d32f2f;
        border-color: #d32f2f;
    }

    /* Tabs */
    .tab-content {
        display: none;
    }

    .profile-card {
        background-color: #fff3f3; /* soft red */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    }

    h2 {
        color: #b71c1c;
        margin-bottom: 20px;
    }
    /* Cards with colored backgrounds */
.card-summary {
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 3px 6px rgba(0,0,0,0.1);
    transition: 0.3s;
    color: #333;
    font-weight: bold;
}

.card-donations {
    background-color: #2983b8; /* soft red/pink */
}

.card-beneficiaries {
    background-color: #22ad6c; /* soft orange */
}

.card-projects {
    background-color: #e6c42ee5; /* soft green */
}

.card-summary:hover {
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
}

</style>
</head>
<body>

<div class="d-flex">

  <!-- Sidebar -->
  <div id="sidebar" class="flex-shrink-0 p-3">
    <h4 class="text-center mb-4">SDG 1.4 Admin</h4>
    <a href="#dashboard-tab" class="tab-link">Dashboard</a>
    <a href="#management-tab" class="tab-link">Management</a>
    <a href="#settings-tab" class="tab-link">Settings</a>
    <a href="#" id="logout-btn">Logout</a>
  </div>

  <!-- Main Content -->
  <div id="content">

    <!-- Dashboard Tab -->
    <div id="dashboard-tab" class="tab-content">
      <h2>Dashboard Overview</h2>
      <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card-summary card-donations">
            <h5>Total Donations</h5><p>$7,520</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-summary card-beneficiaries">
            <h5>Beneficiaries</h5><p>320 People</p>
          </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-summary card-projects">
            <h5>Active Projects</h5><p>12</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Management Tab -->
    <div id="management-tab" class="tab-content">
      <h2>Management</h2>
      <div class="mb-3">
        <button class="btn btn-red me-2">Add New Project</button>
        <button class="btn btn-red me-2">Manage Donors</button>
        <button class="btn btn-red">Manage Beneficiaries</button>
      </div>
      <table class="table table-striped mt-3">
        <thead>
          <tr>
            <th>Project</th>
            <th>Donors</th>
            <th>Beneficiaries</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Food Supplies Drive</td>
            <td>50</td>
            <td>120</td>
            <td>Active</td>
            <td><button class="btn btn-sm btn-red">Edit</button></td>
          </tr>
          <tr>
            <td>Clean Water Access</td>
            <td>30</td>
            <td>80</td>
            <td>Active</td>
            <td><button class="btn btn-sm btn-red">Edit</button></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Settings Tab -->
    <div id="settings-tab" class="tab-content">
      <h2>Admin Profile</h2>
      <div class="profile-card">
        <p><strong>Username:</strong> admin1</p>
        <p><strong>Email:</strong> admin@example.com</p>
        <button class="btn btn-red">Update Profile</button>
      </div>
    </div>

  </div>
</div>

<script>
  // Check login status
  if(localStorage.getItem('loggedIn') !== 'true'){
    window.location.href = 'login.php';
  }

  // Tab switching
  const tabs = document.querySelectorAll('.tab-link');
  const tabContents = document.querySelectorAll('.tab-content');

  tabs.forEach(tab => {
    tab.addEventListener('click', function(e){
      e.preventDefault();
      tabContents.forEach(tc => tc.style.display = 'none');
      const target = document.querySelector(this.getAttribute('href'));
      target.style.display = 'block';
    });
  });

  // Show dashboard by default
  tabContents.forEach(tc => tc.style.display = 'none');
  document.getElementById('dashboard-tab').style.display = 'block';

  // Logout
  document.getElementById('logout-btn').addEventListener('click', function(e){
    e.preventDefault();
    localStorage.removeItem('loggedIn');
    window.location.href = 'login.php';
  });
</script>

</body>
</html>
