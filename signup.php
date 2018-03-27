<?php

		use PHPMailer\PHPMailer;
	  use PHPMailer\Exception;
		require 'PHPMailer/Exception.php';
		require 'PHPMailer/PHPMailer.php';
		require 'PHPMailer/SMTP.php';


if (isset($_POST['submit'])) {

		$con = new mysqli('localhost', 'user', 'password', 'dbname');

		$name = $con->real_escape_string($_POST['name']);
		$email = $con->real_escape_string($_POST['email']);
		$password = $con->real_escape_string($_POST['password']);


if ($name == "" || $email == "" ||  $password == "")

			$message = "Please check your inputs!";

		else {

			$sql = $con->query("SELECT id FROM users WHERE email='$email'");

	if ($sql->num_rows > 0) {
				$message = "Email already exists in the database!";
		} else {

				$token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
				$token = substr($token, 0, 10);
				$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

				$con->query("INSERT INTO users (name,email,password,isEmailConfirmed,token)
					VALUES ('$name', '$email', '$hashedPassword', '0', '$token');
				");


                 require_once 'autoload.php';
                 $mail = new PHPMailer\PHPMailer();

                try{
  	        		 $mail->isSMTP();
  	    	 	  	 $mail->SMTPDebug = 0;
  			      	 $mail->SMTPAuth = true;

						     $mail->Host = 'smtp.gmail.com';
						     $mail->SMTPSecure = 'ssl';
						     $mail->Port = 465;
						     $mail->Username = 'johndoe1234@gmail.com';
						     $mail->Password = '</Password.>';
						     $mail->setFrom('johndoe1234@gmail.com', 'john');
					     	 $mail->addAddress($email, $name);
					     	 $mail->isHTML(true);
	                 $mail->Subject = "Please verify email!";
	                 $mail->Body = "  Please click on the link below:<br><br>

     // Please change the <a href =" Link according to your directory location to confirm.php "/</a>

                  				 <a href='https://localhost/confirm.php?email=$email&token=$token'>Click Here</a> ";

             		 $mail->send();

		       						$message = "You have been registered! Please verify your email!";

                }catch (Exception $e) {  $message = "Something wrong happened! Please try again!"; }





			}
		}
	}


?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="css/style.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

</head>

<body>
    <section class="right-container">

        <span><h2 class="logo"></h2></span>

        <form method="post" action="signup.php" method="post" enctype="multipart/form-data">

            <div class="button-wrapper">
                <button id="google-btn">  <a href="#"> <i class="fab fa-google" style="color:white;" ></i>&nbsp;Login With google </a></button>
                <button id="facebook-btn"> <a  href="#"> <i class="fab fa-facebook-f" style="color:white;" >&nbsp;</i>Login with Fb</a></button>

            </div>

            <strong class="line-thru">or</strong>

            <div class="input-group">
                <span class="font"><i class="far fa-user"></i></span>
                <input class="controls" aria-hidden="true" type="text" name="name" placeholder="enter your full name" autocomplete="off" required>
            </div>

            <div class="input-group">
                <span class="font"><i class="far fa-envelope"></i></span>
                <input class="controls" type="email" name="email" placeholder="your e-mail goes here.." autocomplete="off" required>
            </div>

            <div class="input-group">
                <span class="font"> <i class="fas fa-unlock-alt"></i></span>
                <input class="controls" type="password" name="password" placeholder="******" required>
            </div>

            <br/>
            <div class="message">
                <?php if(isset($message)) { echo $message; }  ?>
            </div>
             <br/>

            <div class="button-wrapper">
                <button type="submit" name=submit id="login-btn">Sign Up</button>
            </div>

            <p class="highlight">Already Have account?.<a href="index.php" style="color:#1bc0f7;">  LogIn</a></p>
        </form>


    </section>

    <footer>


        </footer>


</body>

</html>
