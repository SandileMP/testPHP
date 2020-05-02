<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
 ?>
<!DOCTYPE html>
<html lang="EN" class="no-js no-svg">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Contact Us - e-Interview</title>
<link rel="profile" href="http://gmpg.org/xfn/11"/>
<!-- Stylesheets -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,900" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"/>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
<style>
	button:disabled{
		background: #999 linear-gradient(to bottom, #999 50%, #666 55%);
	}
	button:disabled:hover{
		background: #666 linear-gradient(to bottom, #666 50%, #999 55%);
	}
</style>
</head>
<body>
<script type="text/javascript">
	$(document).ready(function(){
		$("#openNav").click(function(){
			$("header nav").slideToggle();
		});
	});
</script>
<div class="wrapper">
<header>
<div class="row">
<div class="col-4 col-sm-6">
<div class="logo">
<a href="index.php"><img src="assets/images/logo.png" alt="E-Interview"></a>
</div>
</div>
<div class="col-8 col-sm-6">
<div class="nav-mobile" id="openNav"><i class="icon fa fa-bars"></i></div>
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="services.php">Clientization</a></li>
		<li class="active"><a href="contact.php">Contact Us</a></li>
		<li><a href="https://e-interview.co.za/logins/" target="_blank">Login</a>
			<div class="login-popup">
				<form action="#" method="POST">
					<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="name" id="email" class="form-style" placeholder="Email address">
					</div>
					<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-style" placeholder="Password">
					</div>
					<div class="btn-login">Sign in</div>
					<div class="forgot"><a href="#">Forgot password?</a></div>
				</form>
			</div>
		</li>
	</ul>
</nav>
</div>
</div>
</header>
<div class="content-wrap">

<div class="main-content">
<div class="heading-content">
<h1 class="heading"><i class="far fa-envelope"></i> Contact Us</h1>
</div>

<div class="row">
<div class="col-5 col-md-12 col-sm-12">
<div class="contact-card">
<img src="assets/images/contact-us-banner.jpg" alt="Contact Us" style="width:100%;">
</div>
</div>
<div class="col-7 col-md-12 col-sm-12">
<h3 class="t-center-sm">Get in touch</h3>
<p>Please don't hesitate to contact us for more information.</p>

<?php
$recaptchaSiteKey = '6LedhJMUAAAAAHulK5VlqA2-ktLFO7Wcn7bGJ_8m';
if (isset($_POST['name'])) {
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$surname = isset($_POST['surname']) ? $_POST['surname'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$company = isset($_POST['company']) ? $_POST['company'] : '';
	$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
	$message = isset($_POST['message']) ? $_POST['message'] : '';

	if ($name != '' && $surname != '' && $email != '' && $subject != '' && $message != '') {
		require_once 'RecapchaVerify.php';
		$RecapchaVerify = new RecapchaVerify();
		if($RecapchaVerify->verifyReCapcha($_POST['g-recaptcha-response'])){
			// Send mail
			$to = 'contact@e-interview.co.za';
			// $to = 'mitulmlakhani99@gmail.com';
			$sub = $subject . 'e-Interview Contact';
			$message = '<br> <strong>Name :</strong> ' . $name . ' (' . $surname . ')<br> <strong>Company :</strong> ' . $company . '<br> <strong>Subject :</strong> ' . $subject . '<br> <strong>Message :</strong> ' . $message;

			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: $email" . "\r\n";
			$headers .= 'Reply-To: ' . $to . "\r\n";

			if (mail($to, $sub, $message, $headers)) {
				$notice = '<div class="alert alert-success">Thank you, your message has been successfully sent. We will respond as soon as possible.</div>';
			} else {
				$notice = 'Failed';
			}

		} else {
			$notice = '<div class="alert alert-danger">Please ensure you are not robot.</div>';	
		}

	} else {
		$notice = '<div class="alert alert-danger">Please fill all required fields.</div>';
	}
}
?>
<?=isset($notice) ? $notice : '';?>
<div class="contact-form">
<form action="contact.php" method="POST">
<div class="row-sm">
<div class="col-6 col-sm-12">
<input type="text" name="name" placeholder="Name *" class="contact-style">
</div>
<div class="col-6 col-sm-12">
<input type="text" name="surname" placeholder="Surname *" class="contact-style">
</div>
</div>
<input type="email" name="email" placeholder="Email Address *" class="contact-style">
<input type="text" name="company" placeholder="Company Name" class="contact-style">
<input type="text" name="subject" placeholder="Subject *" class="contact-style">
<textarea name="message" class="contact-style" placeholder="Your message goes here..  *"></textarea>
<div class="g-recaptcha" data-sitekey="<?= $recaptchaSiteKey ?>" data-callback="enableBtn"></div>
<button type="submit" id="btn-contact-submit" class="btn-contact-submit" disabled><i class="fa fa-paper-plane"></i> Send Email</button>
<div class="fiel-required">* is required fields</div>
</form>
</div>

</div>
</div>


<div class="interseted">
<h2>Interested to use <span>e-Interview platform?</span></h2>
<a href="contact.php"><div class="register-btn">Register Now</div></a>
</div>


<footer>
	<ul class="link-footer">
		<li><a href="index.php">Home</a></li>
		<li><a href="services.php">Clientization</a></li>
		<li><a href="contact.php">Register</a></li>
		<li><a href="contact.php">Contact Us</a></li>
	</ul>
	<div class="copy">
	Copyright &copy; 2018 &middot; <a href="index.php">e-Interview</a> &middot; All Rights Reserved
	</div>
</footer>


</div>

</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
	function enableBtn(){
		document.getElementById('btn-contact-submit').removeAttribute('disabled');
	}
</script>
</body>
</html>