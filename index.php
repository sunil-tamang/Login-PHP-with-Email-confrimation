<?php   session_start(); ?>
<?php


// Log-in
    if (isset($_POST['submit']) || isset($_POST['name']) || isset($_POST['password']) ){

         $con = new mysqli('localhost', 'user', 'password', 'dbname');

          $email = $con->real_escape_string($_POST['email']);
          $password = $con->real_escape_string($_POST['password']);

          if ($email == "" || $password == "")
    			$message = "Please check your inputs!";

    		else {
    			$sql = $con->query("SELECT id, password, isEmailConfirmed FROM users WHERE email='$email'");

    			if ($sql->num_rows > 0) {

                    $data = $sql->fetch_array();

                    if (password_verify($password, $data['password'])) {

                        if ($data['isEmailConfirmed'] == 0)

    	                    $message = "Please verify your email!";

                        else {

      			              $_SESSION['email'] = $email;
      			              header("Location: profile.php");
                        }
                    } else
    	                $message = "Please check your inputs!";
    			} else {
    				$message = "Please check your inputs!";
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

    <!--Right Container-->
    <section class="right-container">

        <!--Logo-->
        <span><h2 class="logo"></h2>
       </span>

        <!--Form container-->
        <form method="post" action="index.php">

            <div class="button-wrapper">

                <button id="google-btn">  <a href="#"> <i class="fab fa-google" style="color:white;" ></i>&nbsp;Login With google </a></button>
                <button id="facebook-btn"> <a  href="#"> <i class="fab fa-facebook-f" style="color:white;" >&nbsp;</i>Login with Fb</a></button>

            </div>

            <strong class="line-thru">or</strong>

            <div class="input-group">
                <span class="font"> <i class="far fa-envelope"></i> </span>
                <input class="controls" type="email" name="email" placeholder="Email Address..." autocomplete="off" required>
            </div>

            <div class="input-group">
                <span class="font"> <i class="fas fa-lock-open"></i></span>
                <input class="controls" type="password" name="password" placeholder="******" required>
            </div>
            <br/>
            <!-- Message  Succesful or Error -->
            <div class="message">
                <?php if(isset($message)) { echo $message; } ?> </div> &nbsp;

            <!--- Log-in Btn -->
            <div class="button-wrapper">

                <button id="login-btn" type="submit" name=submit> Log in</button>

            </div>

            <p class="highlight"><a href="forget-password.php" style="color:#1bc0f7;"> Forgot Your Password?</a></p>

            <p class="highlight">Didn't Have account?.<a href="signup.php" style="color:#1bc0f7;">Register</a></p>



        </form>

    </section>


</body>

</html>
