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
.container {
  display: flex;
  max-width: 1200px;
  margin: 20px auto;
  gap: 20px;
  flex-wrap: wrap;
}


.sidebar {
  flex: 1;
  min-width: 220px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.main-content {
  flex: 3;
  background: rgba(255,255,255,0.15);
  backdrop-filter: blur(8px);
  padding: 30px;
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}
.main-content h1 {
  margin-bottom: 15px;
  font-size: 2em;
  text-shadow: 1px 2px 6px rgba(0,0,0,0.3);
}

.main-content p {
  margin-bottom: 15px;
  line-height: 1.6;
}


.blog {
  margin-top: 30px;
}

.blog h2 {
  margin-bottom: 15px;
  text-shadow: 1px 2px 6px rgba(0,0,0,0.3);
}
.blog-card {
  background: rgba(255,255,255,0.1);
  backdrop-filter: blur(6px);
  border-radius: 12px;
  overflow: hidden;
  margin-bottom: 20px;
  display: flex;
  flex-direction: column;
  box-shadow: 0 6px 20px rgba(0,0,0,0.2);
  transition: transform 0.3s;
}
.blog-card:hover {
  transform: translateY(-5px);
}

.blog-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}

.blog-card-content {
  padding: 15px;
}

.blog-card-content h3 {
  margin-bottom: 10px;
  font-size: 1.4em;
}

.blog-card-content p {
  font-size: 0.95em;
  line-height: 1.5;
}footer {
  background: rgba(255,255,255,0.15);
  backdrop-filter: blur(8px);
  text-align: center;
  padding: 20px;
  margin-top: 40px;
  border-radius: 12px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

footer a {
  color: #fff;
  text-decoration: underline;
}
@media (max-width: 700px) {
  .container {
    flex-direction: column;
  }
  .sidebar {
    flex-direction: row;
    justify-content: space-around;
  }
  .btn {
    width: 120%;
  }
  .blog-card {
    flex-direction: column;
  }
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
            <form action=""><button type="submit" class="btn">Want to Donate?</button></form>
            <form action=""><button type="submit" class="btn">Looking for Donner?</button></form>
            <form action=""><button type="submit" class="btn">Donation History</button></form>

        </div>
        <div class="main-content">
            <h1>Welcome to Your Blood Donation Portal</h1>
        <p>The Blood Donation Portal is your personal platform for managing your blood donation journey. Track your donation history, monitor your eligibility, and request blood when needed.</p>
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
</div>
    
    <footer>
        <p>contact us:</p>
    </footer>

</body>
</html>