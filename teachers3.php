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
  <title>Bolana Education Center - Teachers</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh; /* allow page to grow */
      background-color: #f0f4fa;
    }

    nav img {
      width: 150px;
    }

    .sidebar {
      width: 300px;
      background-color: #243a73;
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px;
      flex-shrink: 0;
    }

    .sidebar h2 {
      margin-bottom: 40px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      margin: 15px 0;
      display: block;
      padding: 8px 12px;
      border-radius: 4px;
      transition: background-color 0.3s, padding-left 0.3s;
    }

    .sidebar a:hover {
      background-color: #1b2d5c;
      padding-left: 20px;
    }

     .sidebar img {
      width: 150px;
      margin-bottom: 20px;
      align-self: center;
    }

    .main {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    .header {
      background-color: #1976d2;
      color: white;
      padding: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-shrink: 0;
    }

    .header h1 {
      font-size: 24px;
    }

    .dashboard {
      padding: 20px;
      width: 100%;
      box-sizing: border-box;
      flex-grow: 1;
    }

    /* Teacher directory styles */
    .section-title {
      font-size: 20px;
      color: #243a73;
      margin-bottom: 15px;
      border-bottom: 3px solid #1976d2;
      display: inline-block;
      padding-bottom: 5px;
    }

    .teacher-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 15px;
    }

    .teacher-card {
      background: white;
      border-radius: 10px;
      padding: 15px 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .teacher-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .teacher-card h3 {
      margin-bottom: 10px;
      color: #00509e;
    }

    .teacher-card p {
      margin: 5px 0;
      font-size: 14px;
    }

    .teacher-card strong {
      color: #333;
    }

  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <img src="images/h.png" alt="Logo" />
    <h2><center>Bolana Education Center</center></h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="student.html">Students</a>
    <a href="teachers3.php" style="background-color: #1b2d5c;">Teachers</a>
    <a href="courses3.html">Courses</a>
    <a href="notices.html">Notices</a>
    <a href="contact2.html">Contact</a>
  </div>

  <!-- Main content -->
  <div class="main">
    <div class="header">
      <h1>Teachers</h1>
      <p>Admin</p>
    </div>

    <div class="dashboard">
      <div class="section-title">Our Teachers</div>
      <div class="teacher-grid">
        <div class="teacher-card">
          <h3>Mr. Sampath Perera</h3>
          <p><strong>Subject:</strong> Mathematics</p>
          <p><strong>Email:</strong> sampath@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Ms. Nadeesha Fernando</h3>
          <p><strong>Subject:</strong> English</p>
          <p><strong>Email:</strong> nadeesha@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Mr. Kusal Wijesinghe</h3>
          <p><strong>Subject:</strong> Science</p>
          <p><strong>Email:</strong> kusal@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Ms. Shani Rajapaksha</h3>
          <p><strong>Subject:</strong> History</p>
          <p><strong>Email:</strong> shani@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Mr. Ruwan Silva</h3>
          <p><strong>Subject:</strong> ICT</p>
          <p><strong>Email:</strong> ruwan@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Ms. Hiruni Madushani</h3>
          <p><strong>Subject:</strong> Sinhala</p>
          <p><strong>Email:</strong> hiruni@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Mr. Janaka Weerasinghe</h3>
          <p><strong>Subject:</strong> Geography</p>
          <p><strong>Email:</strong> janaka@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Ms. Dilani Jayasuriya</h3>
          <p><strong>Subject:</strong> Buddhism</p>
          <p><strong>Email:</strong> dilani@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Mr. Nuwan Ranasinghe</h3>
          <p><strong>Subject:</strong> Tamil</p>
          <p><strong>Email:</strong> nuwan@bolanaedu.lk</p>
        </div>
        <div class="teacher-card">
          <h3>Ms. Piumi Lakshani</h3>
          <p><strong>Subject:</strong> Art</p>
          <p><strong>Email:</strong> piumi@bolanaedu.lk</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
