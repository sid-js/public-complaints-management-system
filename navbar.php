<!-- Navbar Component -->

<head>
  <style>
    /* Navbar CSS */
    .navbar {
      overflow: hidden;
      padding: 20px 30px;
      background-color: #f0f0f0;
      /* Example background color */
    }

    .navbar a {
      float: left;
      display: block;
      color: black;
      text-align: center;
      padding: 14px 16px;
      border-radius: 5px;
      text-decoration: none;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
    }

    .admin-dashboard-link a {
      float: right;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <a href="#home">Home</a>
    <a href="/public-complaints/map">Map</a>
    <a href="#about">About</a>
    <div class="admin-dashboard-link">
      <a href="/public-complaints/admin/dashboard">Admin Dashboard</a>
    </div>
  </div>
</body>