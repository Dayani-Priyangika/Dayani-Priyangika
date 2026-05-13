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
  <title>Grade 11 - Class Resources</title>
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #e3f2fd;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      color: #333;
    }

    h1 {
      color: #0d47a1;
      margin-bottom: 25px;
      font-size: 2rem;
      font-weight: 700;
      text-align: center;
      max-width: 800px;
      width: 100%;
    }

    ul {
      list-style: none;
      padding-left: 0;
      margin-bottom: 30px;
      max-width: 800px;
      width: 100%;
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
    }

    li {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 15px 20px;
      flex: 1 1 220px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      transition: box-shadow 0.3s ease;
    }

    li:hover {
      box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    a {
      color: #0d47a1;
      font-weight: bold;
      font-size: 16px;
      text-decoration: none;
      display: block;
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

    /* Responsive */
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
  <h1>Grade 11 - Class Resources</h1>

  <ul>
    <li><a href="pdfs/grade11-math.pdf" target="_blank" rel="noopener">📘 Mathematics PDF</a></li>
    <li><a href="pdfs/grade11-english.pdf" target="_blank" rel="noopener">📗 English PDF</a></li>
    <li><a href="pdfs/grade11-science.pdf" target="_blank" rel="noopener">📙 Science PDF</a></li>
  </ul>

  <video controls>
    <source src="videos/grade11-video.mp4" type="video/mp4" />
    Your browser does not support the video tag.
  </video>

  <ul>
    <li><a href="pdfs/grade11-math.pdf" target="_blank" rel="noopener">📘 Mathematics PDF</a></li>
    <li><a href="pdfs/grade11-english.pdf" target="_blank" rel="noopener">📗 English PDF</a></li>
    <li><a href="pdfs/grade11-science.pdf" target="_blank" rel="noopener">📙 Science PDF</a></li>
  </ul>

  <ul>
    <li><a href="pdfs/grade11-math.pdf" target="_blank" rel="noopener">📘 Mathematics PDF</a></li>
    <li><a href="pdfs/grade11-english.pdf" target="_blank" rel="noopener">📗 Eng_
