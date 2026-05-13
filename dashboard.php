<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bolana Education Center - Dashboard</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background-color: #f0f4fa;
      color: #333;
      overflow: hidden;
      flex-direction: row;
    }

    /* Sidebar styles */
    .sidebar {
      width: 300px;
      background-color: #243a73;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px;
      height: 100vh;
      overflow-y: auto;
      flex-shrink: 0;
    }

    .sidebar img {
      width: 150px;
      margin-bottom: 20px;
      align-self: center;
    }

    .sidebar h2 {
      margin-bottom: 40px;
      text-align: center;
      font-weight: 700;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      margin: 10px 0;
      display: block;
      padding: 10px 15px;
      border-radius: 5px;
      transition: background-color 0.3s, padding-left 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #1b2d5c;
      padding-left: 25px;
    }

    /* Main content area */
    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
      overflow-y: auto;
      padding: 20px 40px;
    }

    .header {
      background-color: #1976d2;
      color: white;
      padding: 20px;
      border-radius: 8px;
      margin-bottom: 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-shrink: 0;
    }

    .header h1 {
      font-size: 24px;
    }

    .dashboard {
      flex: 1;
      overflow-y: auto;
    }

    .section-title {
      font-size: 22px;
      color: #243a73;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .course-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 25px;
    }

    .course-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      transition: transform 0.2s;
      cursor: pointer;
      color: inherit;
      text-decoration: none;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .course-card:hover {
      transform: scale(1.05);
    }

    .course-card h3 {
      font-size: 18px;
      color: #243a73;
      margin-bottom: 10px;
    }

    .course-card p {
      font-size: 14px;
      color: #555;
      flex-grow: 1;
    }

    /* Responsive: tablets and smaller */
    @media (max-width: 900px) {
      body {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        padding: 10px 20px;
        overflow-x: auto;
        align-items: center;
      }

      .sidebar img {
        margin-bottom: 0;
        margin-right: 20px;
      }

      .sidebar h2 {
        margin-bottom: 0;
        margin-right: 30px;
        white-space: nowrap;
        font-size: 18px;
      }

      .sidebar a {
        margin: 0 15px 0 0;
        padding: 10px 15px;
        white-space: nowrap;
        border-radius: 6px;
      }

      .sidebar a:hover,
      .sidebar a.active {
        padding-left: 15px;
      }

      .main {
        padding: 15px 20px;
      }

      .header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
      }

      .dashboard {
        overflow-y: visible;
      }

      .course-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
    }

    /* Responsive: phones */
    @media (max-width: 480px) {
      .header h1 {
        font-size: 20px;
      }

      .sidebar h2 {
        font-size: 16px;
      }

      .course-card h3 {
        font-size: 16px;
      }

      .course-card p {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <img src="images/h.png" alt="Logo" />
    <h2>Bolana Education Center</h2>
    <a href="#" class="active">Dashboard</a>
    <a href="student.html">Students</a>
    <a href="teachers3.php">Teachers</a>
    <a href="courses2.html">Courses</a>
    <a href="notices.html">Notices</a>
    <a href="contact2.html">Contact</a>
    <a href="logout.php">Log Out</a>
  </div>

  <div class="main">
    <div class="header">
      <h1>Dashboard</h1>
      <p>Admin</p>
    </div>

    <div class="dashboard">
      <div class="section-title">Recently Accessed Courses</div>
      <div class="course-grid">
        <a href="grade10.php" class="course-card" style="background-color:#bbdefb;">
          <h3>Grade 10</h3>
          <p>You can download Grade 10 Resources here</p>
        </a>

        <a href="grade11.php" class="course-card" style="background-color:#c5cae9;">
          <h3>Grade 11</h3>
          <p>You can download Grade 11 Resources here</p>
        </a>

        <a href="grade12.php" class="course-card" style="background-color:#b2dfdb;">
          <h3>Grade 12</h3>
          <p>You can download Grade 12 Resources here</p>
        </a>
      </div>

      <div class="section-title" style="margin-top:30px;">Course Overview</div>
      <div class="course-grid">
        <a href="grade6.php" class="course-card" style="background-color:#e3f2fd;">
          <h3>Grade 6</h3>
          <p>You can download Grade 6 Resources here</p>
        </a>

        <a href="grade7.php" class="course-card" style="background-color:#ffe082;">
          <h3>Grade 7</h3>
          <p>You can download Grade 7 Resources here</p>
        </a>

        <a href="grade8.php" class="course-card" style="background-color:#d1c4e9;">
          <h3>Grade 8</h3>
          <p>You can download Grade 8 Resources here</p>
        </a>

        <a href="grade9.php" class="course-card" style="background-color:#f0d1d1;">
          <h3>Grade 9</h3>
          <p>You can download Grade 9 Resources here</p>
        </a>

        <a href="grade10.php" class="course-card" style="background-color:#f0d1d1;">
          <h3>Grade 10</h3>
          <p>You can download Grade 10 Resources here</p>
        </a>

        <a href="grade11.php" class="course-card" style="background-color:#b09ed0;">
          <h3>Grade 11</h3>
          <p>You can download Grade 11 Resources here</p>
        </a>

        <a href="grade12.php" class="course-card" style="background-color:#d1c4e9;">
          <h3>Grade 12</h3>
          <p>You can download Grade 12 Resources here</p>
        </a>

        <a href="grade13.php" class="course-card" style="background-color:#d1c4e9;">
          <h3>Grade 13</h3>
          <p>You can download Grade 13 Resources here</p>
        </a>
      </div>
    </div>
  </div>

</body>
</html>
