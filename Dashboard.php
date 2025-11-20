<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Care</title>

  <style>
  
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    
    body {
      min-height: 100vh;
      background: 
        linear-gradient(rgba(150, 0, 0, 0.45), rgba(40, 0, 0, 0.6)),
        url('https://previews.123rf.com/images/houbacze/houbacze1609/houbacze160900006/62250635-blood-donation-red-vector-blood-donation-flat-vector-blood-donation-background-blood-donation.jpg')
        no-repeat center center;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding-left: 8%;
      color: #fff;
    }

    
    .container {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(15px);
      border-radius: 16px;
      padding: 50px 40px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 8px 25px rgba(0,0,0,0.25);
      animation: fadeIn 0.8s ease-in-out;
    }

    .container h2 {
      font-size: 2em;
      font-weight: 600;
      margin-bottom: 10px;
      letter-spacing: 1px;
    }

    .container p {
      font-size: 15px;
      margin-bottom: 30px;
      opacity: 0.9;
    }

    .container h3 {
      font-size: 1.3em;
      color: #fff;
      margin-bottom: 25px;
      font-weight: 500;
    }

    
    .btn {
      display: block;
      width: 100%;
      padding: 14px;
      margin: 10px 0;
      border: none;
      border-radius: 6px;
      background: linear-gradient(135deg, #e63946, #b71c1c);
      color: white;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: linear-gradient(135deg, #c62828, #9e1b1b);
      transform: translateY(-3px);
    }

    .btn:active {
      transform: scale(0.98);
    }

   
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    
    @media (max-width: 768px) {
      body {
        justify-content: center;
        padding: 20px;
        background-position: center;
      }
      .container {
        padding: 35px 25px;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <h2>Blood Bank Dashboard</h2>
    <p>Your trusted platform for saving lives</p>

    <h3>Select Your Portal</h3>

   >
    <form action="">
      <button type="submit" class="btn" name="User">User</button>
    </form>

    <form action="">
      <button type="submit" class="btn" name="Admin">Admin</button>
    </form>

    <form action="">
      <button type="submit" class="btn" name="Blood">Blood Bank</button>
    </form>
  </div>

</body>
</html>