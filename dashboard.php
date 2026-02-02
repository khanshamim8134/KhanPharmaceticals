<?php
// Check if user is logged in
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit();
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'User';
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <link rel="shortcut icon" href="Shamim.jpg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
     href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Dashboard - KHAN Pharmaceuticals PLC.Bangladesh</title>
    <style>
        .dashboard_container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .dashboard_header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }
        .dashboard_header h2 {
            color: rgb(88, 88, 189);
            font-size: 28px;
            margin-bottom: 10px;
        }
        .user_info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .user_info p {
            margin: 8px 0;
            font-size: 16px;
            color: #333;
        }
        .user_info strong {
            color: rgb(88, 88, 189);
        }
        .dashboard_content {
            margin: 30px 0;
        }
        .section_title {
            font-size: 20px;
            color: rgb(88, 88, 189);
            margin: 20px 0 15px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid rgb(88, 88, 189);
        }
        .content_box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .btn-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        .btn-primary {
            background: rgb(88, 88, 189);
            color: white;
        }
        .btn-primary:hover {
            background: rgb(70, 70, 150);
        }
        .btn-secondary {
            background: #dc3545;
            color: white;
        }
        .btn-secondary:hover {
            background: #c82333;
        }
    </style>
  </head>
<body>
    <script src="project.js"></script>
    <div class="header_area">
<header class="head">
    <a href="">KHAN Pharmaceuticals PLC.<br>Bangladesh (KHAN_Group_LTD)</a>
   </header> 
   <nav id="main_menu">
    <ul>
        <li><a href="Project.html">Home</a></li>
        <li><a href="">About us</a>
          <ul>
            <li><a href="https://khanshamim8134.github.io/Portfolio/">Founder's Profile</a></li>
            <li><a href="">Board of Directors</a></li>
            <li><a href="">Mission & Vision</a></li>
            <li><a href="">Milestone of Excellence</a></li>
          </ul>
        </li>
        <li><a href="quality.html">Quality</a></li>
        <li><a href="">Products</a><ul>
            <li><a href="">All Products</a></li>
            <li><a href="">Pharma Products</a></li>
            <li><a href="">Herbal Products</a></li>
            <li><a href="">Oncology Products</a></li>
            <li><a href="">Ophtha Products</a></li>
          </ul>
         </li>
        <li><a href="https://www.google.com/maps/@23.249862,90.68544,15z?entry=ttu&g_ep=EgoyMDI1MTExNy4wIKXMDSoASAFQAw%3D%3D">Export Market</a></li>
        <li><a href="">News & Event</a>
         <ul>
            <li><a href="">Latest News</a></li>
            <li><a href="">Medical Periodicals</a></li>
            <li><a href="">Latest Medical Development</a></li>
         </ul>
        </li>
        <li><a href="career.html">Career</a></li>
        <li><a href="https://khanshamim8134.github.io/Portfolio/">Contact Owner</a></li>
    </ul>
   </nav>
    </div>

<section id="content">
    <div class="dashboard_container">
        <div class="dashboard_header">
            <h2>Welcome to Your Dashboard</h2>
            <p style="color: #666; font-size: 14px;">You are logged in successfully</p>
        </div>
        
        <div class="user_info">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user_name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user_email); ?></p>
            <p><strong>Login Time:</strong> <?php echo date('Y-m-d H:i:s', $_SESSION['login_time']); ?></p>
        </div>
        
        <div class="dashboard_content">
            <h3 class="section_title">Your Profile</h3>
            <div class="content_box">
                <p>Welcome to KHAN Pharmaceuticals dashboard! Here you can manage your account, view your information, and access our services.</p>
                <p style="margin-top: 15px;">You are now logged in as a registered user. You can access exclusive features and updates related to our pharmaceutical products and services.</p>
            </div>
            
            <h3 class="section_title">Available Services</h3>
            <div class="content_box">
                <p>✓ View Product Catalog<br>
                ✓ Check Quality Standards<br>
                ✓ Access Medical Resources<br>
                ✓ Contact Support Team<br>
                ✓ Download Documents</p>
            </div>
        </div>
        
        <div class="btn-group">
            <a href="Project.html" class="btn btn-primary">← Back to Home</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </div>
    </div>
</section>


<div class="footer_area">
    <div class="div0">
   <h3>Extra Links</h3>
   <h4>About Us</h4>
   <h4>Contact us</h4>
    </div>
   

    <div class="div1">

    
    <ul>
        <li><a href="Project.html">Home</a></li>
        <li><a href="">About us</a></li>
        <li><a href="quality.html">Quality</a></li>
        <li><a href="">Products</a></li>
    </ul>
    </div>

    <div class="div2">
    <ul>
        <li><a href="career.html">Career</a></li>
        <li><a href="">Export Market</a></li>
        <li><a href="">News & Event</a></li>
        <li><a href="">Contact Owner</a></li>
    </ul>
    </div>
    <div class="div4">
        <p>KHAN Pharmaceuticals PLC. is one of the top 10 <br>pharmaceutical companies in Bangladesh.The company<br> started its journey in 2025 with the honest promise<br> to provide quality medicines at affordable prices<br>to the countrymen.</p>
    </div>
    <div class="div5">
        <ul>
           <b> <address>Address , Phone , E-mail , Social Media:</address></b>
            <li class="address" style="color:#fff">Kashipur matpara, Jibannagar, Chuadanga,Khulna,Bangladesh.</li>
            <li class="phone" style="color:#fff">Mob: 01723355140</li>
            <li class="email" style="color:#fff">E-mail: khanshamim8134@gmail.com</li>
            <li>Social Media: <a href="https://www.facebook.com/shamimkhan1981">facebook</a></li>

        </ul>
    </div>
    <div class="div3">
            <ul>
                <li><a href="">© 2025. KHAN Pharmaceuticals PLC. All rights reserved.</a></li>
            </ul>
    </div>
</div>

</body>
</html>
