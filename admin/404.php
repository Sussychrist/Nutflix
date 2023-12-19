<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>You Have Lost Your Power</title>
  <style>
    body {
      background-image: url('https://i.pinimg.com/736x/57/28/11/5728114c287132d379f1e296486a1609.jpg'); /* Replace 'background-image.jpg' with your image URL */
      background-size: auto;
      background-repeat: no-repeat;
      background-position: center center;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
    }
    .button-container {
      margin-left: 170px;
      display: flex;
      gap: 20px;
    }
    h1 {
      justify-content: center;
      align-items: center;
      font-size: 4rem;
      z-index: 0;
      color: #fff;
      text-align: center;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    button {
      
      background-color: #ff4343;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 1.2rem;
      cursor: pointer;
      z-index: 1;
    }
  </style>
</head>
<body>
  <div class="button-container">
  <a href="admin_login.php">
    <button id="button1">Back to Admin</button>
  </a>
  <a href="../index.php">
    <button id="button2">Back to Web</button>
  </a>
  </div>
</body>
</html>
