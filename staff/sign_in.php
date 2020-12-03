<!DOCTYPE html>
<html>
<head>
	<title>เข้าสู่ระบบ</title>
	<link rel="stylesheet" type="text/css" href="css/signinstyle.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<!-- <img class="wave" src="img/wave.png"> -->
	<div class="container">
		<!-- <div class="img">
			<img src="img/bg.svg">
		</div> -->
		<div class="login-content">
			<form action="check_signin.php" method="POST">
				<img src="img/icon.png">
				<h4 class="title">เข้าสู่ระบบสำหรับเจ้าหน้าที่</h4>
           		<div class="input-div pass">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
                      </div>
           		    <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="username">
                    </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
                </div>
                <!-- <div><a href="#">ลืมรหัสผ่าน?</a></div>
				<div><a href="register.php">สมัคร</a></div> -->
				<br>
            	<input type="submit" class="btn" value="LOGIN">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/signin.js"></script>
</body>
</html>