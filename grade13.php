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
  <title>Grade 10 Resources</title>
  <style>
    /* Reset and base */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #e3f2fd;
      margin: 0;
      padding: 20px;
      color: #333;
      line-height: 1.5;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      color: #0d47a1;
      margin-bottom: 20px;
      text-align: center;
      max-width: 800px;
      width: 100%;
      font-weight: 700;
      font-size: 2rem;
    }

    ul {
      list-style: none;
      padding-left: 0;
      max-width: 800px;
      width: 100%;
      margin-bottom: 30px;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
    }

    li {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px 20px;
      border-radius: 8px;
      flex: 1 1 220px; /* grow, shrink, basis */
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s;
    }

    li:hover {
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    a {
      text-decoration: none;
      color: #0d47a1;
      font-weight: bold;
      font-size: 16px;
      display: block; /* full li clickable */
    }

    a:hover,
    a:focus {
      text-decoration: underline;
    }

    video {
      max-width: 800px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
      margin-bottom: 40px;
      outline: none;
    }

    /* Responsive: smaller tablets and phones */
    @media (max-width: 600px) {
      ul {
        flex-direction: column;
        align-items: center;
      }

      li {
        flex: none;
        width: 100%;
      }

      h1 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <h1>Grade 13 - Class Resources</h1>

  <ul>
    <li><a href="pdfs/grade10-math.pdf" target="_blank" rel="noopener">📘 Mathematics PDF</a></li>
    <li><a href="pdfs/grade10-english.pdf" target="_blank" rel="noopener">📗 English PDF</a></li>
    <li><a href="pdfs/grade10-science.pdf" target="_blank" rel="noopener">📙 Science PDF</a></li>
  </ul>

  <video controls>
    <source src="videos/grade10-video.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <!-- You can add more resource lists or sections below if needed -->

</body>
</html>
