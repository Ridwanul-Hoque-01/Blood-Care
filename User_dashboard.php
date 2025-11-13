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
  font-family: 'Poppins', sans-serif;
}

body {
  min-height: 100vh;
  background: linear-gradient(135deg, rgba(230, 57, 70, 0.8), rgba(244, 180, 180, 0.8));
  color: #fff;
}
.header {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(8px);
  border-radius: 12px;
  padding: 20px 30px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 20px auto;
  max-width: 1200px;
  
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}
.header h2 {
  font-size: 2em;
  text-shadow: 1px 2px 6px rgba(0,0,0,0.3);
}

.header p {
  font-size: 0.9em;
  margin-top: 4px;
}
.btn{
    height: 50px;
    width: 200px;
    background: #e63946;
    border: 0;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all .3s;
}
.btn:hover{
    background: #b71c1c;
}
    </style>
</head>
<body>
    <div class="header">
        <div>
            <h2>Hello</h2>
            <p>ID:</p>
        </div>
        <form action="">
            <button type="submit" class="btn">Logout</button>
        </form>
    </div>
    <div class="container">
        <div class="sidebar">
            <form action="">test</form>
            <form action="">test</form>
            <form action="">test</form>

        </div>
        <div class="blog">
            <h2>Blood Donation Blogs</h2>

            <div class="blog-card">
                <div class="blog-card-content">
                    <h3>lalalala</h3>
                    <p>dfdfdfd</p>
                </div>
            </div>

            <div class="blog-card">
                <div class="blog-card-content">
                    <h3>lalalala</h3>
                    <p>dfdfdfd</p>
                </div>
            </div>

            <div class="blog-card">
                <div class="blog-card-content">
                    <h3>lalalala</h3>
                    <p>dfdfdfd</p>
                </div>
            </div>

        </div>
    </div>
    
    <footer>
        <p>contact us:</p>
    </footer>

</body>
</html>