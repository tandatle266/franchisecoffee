<?php
	session_start();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Shiny</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../resources/css/style-login.css">
	<!-- favicons-->
	<link rel="apple-touch-icon" sizes="180x180" href="../resources/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../resources/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../resources/favicons/favicon-16x16.png">
        <link rel="manifest" href="../resources/favicons/site.webmanifest">
        <link rel="mask-icon" href="../resources/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="../resources/favicons/favicon.ico">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="msapplication-config" content="../resources/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!--/favicons-->
	
</head>
<body>
    <div class="limiter">
		<div class="container-login">
			<div class="wrap-login">
				<div class="login-pic " data-tilt>
					<img src="../resources/img/img-01.png" alt="IMG">
				</div>
				
				
						
				<form action="./code.php" method="POST" class="login-form validate-form">
				
					<span class="login-form-title">
						Shiny Login
					</span>
					<?php
                    if(isset($_SESSION['status']) && $_SESSION['status'] !='') 
                    {
                        echo '<h3 class="text-white"> '.$_SESSION['status'].' </h3>';
                        unset($_SESSION['status']);
                    }
                ?>
					<div class="wrap-input validate-input" data-validate = "User is required">
						<input class="input" type="text" name="user_name" placeholder="User Name">
						<span class="symbol-input">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input validate-input" data-validate = "Password is required">
						<input class="input" type="password" name="password" placeholder="Password">
						<span class="symbol-input">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login-form-btn">
						<button type="submit" class="login-form-btn" name="login_btn">
							Login
						</button>
					</div>

					

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#" onclick="Clickme()">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#" onclick="Clickme()">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</body>
<script>
    function Clickme(){
        alert("CONTACT TO ADMINITRATOR FOR INFORMATION");
    }

</script>
</html>