<?php
    session_start();
    include 'new-connection.php';
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
        $query = "SELECT * FROM user WHERE id ='" . $userid . "'";
        $userinfo = fetch_record($query);
        $email = $userinfo['email'];
        $first = $userinfo['first_name'];
        $last = $userinfo['last_name'];
    } elseif (isset($_SESSION['error'])) {
        $values = $_SESSION['values'];
        $errors = $_SESSION['error'];
        if(isset($_SESSION['email'])){
             $email = $_SESSION['email'];
        } else {
                $email = null;
        }
        $first = null;
        $last = null;
        $status = $_SESSION['status'];
        $userid = null;
        $email = null;
    } else{
        $values = array('first'=>"", 'last'=>"", 'email'=>"");
        $errors = array('first'=>"", 'last'=>"", 'email'=>"", 'password'=>"", 'passwordconf'=>"");
        $status = "";
        $userid = null;
        $email = null;
        $first = null;
        $last = null;
    }
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<title>CodingDojo Crime Watch</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="css.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                $("<p class='standout'>Please verify this information, there was an error verifying this entry.</p>").insertBefore(".errors");
            });
    </script>
</head>
<body>
<div id="container">
	<div id="wrapper">
		<div id="title">
        <h1>Coding Dojo Crime Watch</h1>
            <div id="user">
                <?php 
                    if(isset($user)){
                        echo "<h6>Welcome " . $first . "!  </h6>";
                        echo "<a href='logoff.php' class='button blue'>Log off</a>";
                    }else{
                        echo "<a href='index.php' class='button blue'>Log in</a>";
                    } 
                ?>
            </div>
        </div>
        <div id="welcome">
            <h2>Welcome to the Coding Dojo Crime Watch!</h2>
            <h3>Hide your bikes, hide your flipflops and eat some bacon.</h3>
            <div id="register" class='column'>
                <?php
                    if($status=="error"){
                        echo "<h3 class='error'>There was an error with your submission please verify your registration information and resubmit.</h3>";
                    }
                ?>
                <form action='regprocess.php' method='post'>
                    <label>First Name:</label>
                    <input type="text" name="first"
                        <?php 
                            if($errors['first']==TRUE){
                                echo "value='" . $values['first'] . "' class='errors'";
                            } else {
                                echo "value='" . $values['first'] . "'";
                            }
                        ?>
                    >
                    <label>Last Name:</label>
                    <input type="text" name="last"
                        <?php 
                            if($errors['last']==TRUE){
                                echo "value='" . $values['last'] . "' class='errors'";
                            } else {
                                echo "value='" . $values['last'] . "'";
                            }
                        ?>
                    >
                    <label>E-mail:</label>
                    <input type="text" name="email"
                        <?php 
                            if($errors['last']==TRUE){
                                echo "value='" . $values['email'] . "' class='errors'";
                            } else {
                                echo "value='" . $values['email'] . "'";
                            }
                        ?>
                    >
                    <label>Password:</label>
                    <input type="password" name="password"
                        <?php 
                            if($errors['password']==TRUE){
                                echo "class='errors'";
                            } 
                        ?>
                    >
                    <label>Password Confirmation:</label>
                    <input type="password" name="passwordconf"
                        <?php 
                            if($errors['passwordconf']==TRUE){
                                echo "class='errors'";
                            } 
                        ?>
                    >
                    <input type="submit" name="secure" value="Create Account" class="button blue width">
                </form>
            </div>
            <div id="login" class='column'>
                <?
                    if(isset($_SESSION['status'])){
                        if($_SESSION['status']=="success"){
                            echo "<h3 class='success'>Congratulations, your account has been created please login.</h3>";
                        }
                        if($_SESSION['status']=="logoff"){
                            echo "<h3 class='success'>You have been logged off.  See you next time!</h3>";
                        }
                    }
                    if($errors['email']==TRUE){
                        echo "<h3 class='error'>There was an error verifying your e-mail, please try to log-in again or <a href='register.php'>create a new account</a>.</h3>";
                    }
                    if($errors['password']==TRUE){
                        echo "<h3 class='error'>There was an error verifying your password, please try to log-in again.</h3>";
                    }
                ?>
	        	<form action='login.php' method='post'>
                    <label>E-mail:</label>
                    <input type="text" name="email" 
					<?php
					   if($errors['email']==TRUE){
					       echo "value='" . $email . "' class='errors'";
					   } else {
					       echo "value='" . $email . "'";
					   }
                	?>
			        >
                    <label>Password:</label>
                    <input type="password" name="password" 
                        <?php
                            if($errors['password']==TRUE){
								echo "class='errors'";
					       }
                		?>
				    >
                    <input type="submit" name="secure" value="Log-In" class="button blue width">
	        	</form>
        	</div>
        </div>
        <div id="footer">
        </div>
        </div>
	</div>
</div>
</body>
</html>
<?php
    $_SESSION = array();
?>