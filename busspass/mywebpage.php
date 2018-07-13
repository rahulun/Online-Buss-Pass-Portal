
<?php

    session_start();

    $error = "";  
	$success = "";

    if (array_key_exists("logout", $_GET)) {
        
      unset($_SESSION);
        setcookie("id", "", time() - 60*60);
         $_COOKIE["id"] = "";  
        
        session_destroy();
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedinpage.php");
        
  }	

    if (array_key_exists("submit", $_POST)) {
        
        include("connection.php");
        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['pass']) {
            
            $error .= "A password is required<br>";
            
        } 
		  
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
          if ($_POST['signUp'] == '1') {
            
            $query = "SELECT id FROM `customer` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

              $result = mysqli_query($link, $query);

           if (mysqli_num_rows($result) > 0) {

                   $error = "That email
				   address is taken.";

             } else {

                 $query = "INSERT INTO `customer` (`email`, `pass`, `user`,`father`, `dob`, `phone`, `source`, `destination`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['pass'])."',  '".mysqli_real_escape_string($link, $_POST['user'])."', '".mysqli_real_escape_string($link, $_POST['father'])."',  '".mysqli_real_escape_string($link, $_POST['dob'])."','".mysqli_real_escape_string($link, $_POST['phone'])."',  '".mysqli_real_escape_string($link, $_POST['source'])."',  '".mysqli_real_escape_string($link, $_POST['destination'])."')";

                 if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    }else {

                        $query = "UPDATE `customer` SET pass = '".md5(md5(mysqli_insert_id($link)).$_POST['pass'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        
                        $id = mysqli_insert_id($link);
                        
                        mysqli_query($link, $query);

                        $_SESSION['id'] = $id;

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", $id, time() + 60*60*24*365);

                            setcookie("id", $id, time() - 60*60*24*365);

                        } 
                            
                       $success = "<p>Signed Up Successfully</p>";

                    }

            } 
                
              } else {
                    
                    $query = "SELECT * FROM `customer` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                  if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['id']).$_POST['pass']);
                        
                      if ($hashedPassword == $row['pass']) {
                            
                            $_SESSION['id'] = $row['id'];
                            
                            if (isset($_POST['stayLoggedIn']) AND $_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24*365);

                            } 

                            header("Location: loggedinpage.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {	
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                    
                    }
            
          }
        
        
    }


?>

<?php include("header.php"); ?>
<nav class="navbar navbar-light bg-faded navbar-fixed-top " style="background-color: grey;">
  

  

    <div class="pull-xs-left">
     <a class="navbar-brand" href="home.php">
    <img src="icon3.png" width="30" height="30" >
  </a>

 <a href ='mywebpage.php'>

        <button class="btn btn-primary-outline fa fa-thumbs-up" ><span style="color:white">Register</span></button></a>


        <a href ='jot.php'>

        <button class="btn btn-primary-outline fa fa-thumbs-up" ><span style="color:white">Contact us</span></button></a>

    </div>

</nav>

<br>
<br>
     
      <div class="container">

      <br>
    <h1>BUSS PASS</h1>
          
          
          <div id="error"><?php if ($error!="") {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    
} ?></div>
<div id="success"><?php if ($success!="") {
    echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
    
} ?></div>

<div class="mr">

<form method="post" id = "signUpForm">
    
    <p>Sign up now to make your buss pass</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Your email address">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control" type="password" name="pass" placeholder="Password">
        
    </fieldset>
	
	<fieldset class="form-group">
    
        <input class="form-control" type="text" name="user" placeholder="eg:yourname123456789">
        
    </fieldset>
	
	<fieldset class="form-group">
    
        <input class="form-control" type="text" name="father" placeholder="Father's name">
        
    </fieldset>
	
	<fieldset class="form-group">
    
        <input class="form-control" type="date" name="dob" placeholder="yyyy-mm-dd">
        
    </fieldset>
	
	<fieldset class="form-group">
    
        <input class="form-control" type="text" name="phone" placeholder="Phone Number">
        
    </fieldset>
	
	
	
	<fieldset class="form-group">
    
        <input class="form-control" type="text" name="source" placeholder="eg:Source city">
        
    </fieldset>
	
	<fieldset class="form-group">
    
        <input class="form-control" type="text" name="destination" placeholder="eg:Destination city">
        
    </fieldset>
	
	
	
	
    
    <div class="checkbox">
    
        <label>
    
        <input type="checkbox" name="stayLoggedIn" value=1> Continue
            
        </label>
        
    </div>
    
    <fieldset class="form-group">
    
        <input type="hidden" name="signUp" value="1">
        
        <input class="btn btn-primary" type="submit" name="submit"  id="btn" value="Sign Up!">
        
    </fieldset>
    
    <p><a class="toggleForms" style = "color:green;">Log in</a></p>

</form>

<form method="post" id = "logInForm">
    
    <p>Log in to see your pass</p>
    
    <fieldset class="form-group">

        <input class="form-control" type="email" name="email" placeholder="Your email address">
        
    </fieldset>
    
    <fieldset class="form-group">
    
        <input class="form-control"type="password" name="pass" placeholder="Password">
        
    </fieldset>
    
    <div class="checkbox">
    
        <label>
    
            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
            
        </label>
        
    </div>
        
        <input type="hidden" name="signUp" value="0">
    
    <fieldset class="form-group">
        
        <input class="btn btn-primary"  type="submit" name="submit" id="btn" value="Log In!">
        
    </fieldset>
    
    <p><a class="toggleForms  ">Sign up</a></p>

</form>
</div>
          
      </div>
	  </div>

<?php include("footer.php"); 

?>


