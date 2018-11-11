<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $name = $username = $email = $ciudad = "";
$username_err = $password_err = $name_err = $username_err = $email_err =  $ciudad_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  //echo "Connected successfully 2";
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
      $username = trim($_POST["username"]);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate name
    if(empty(trim($_POST["name"]))){
      $name_err = "Please enter a name.";     
    } elseif(strlen(trim($_POST["name"])) < 6){
        $name_err = "Name must have atleast 6 characters.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
      $email_err = "Please enter an email.";     
    } elseif(strlen(trim($_POST["email"])) < 6){
        $email_err = "Email must have atleast 6 characters.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate city
    if(empty(trim($_POST["ciudad"]))){
      $ciudad_err = "Please enter a city.";     
    } elseif(strlen(trim($_POST["ciudad"])) < 6){
        $ciudad_err = "City must have atleast 6 characters.";
    } else{
        $ciudad = trim($_POST["ciudad"]);
    }
  
    
    // Check input errors before inserting in database (not working atm)
    /*if(empty($username_err) && empty($password_err) && empty($name_err) && empty($email_err)){*/
      echo "Connected successfully 3";
      echo htmlspecialchars($_SERVER["PHP_SELF"]);
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, name, email, ciudad) VALUES ('$username','$password','$name','$email', '$ciudad');";
         
        if (mysqli_query($link, $sql)) 
        {
          //echo "New record created successfully";
          header("location: welcome.php");
          exit;
        } else {
          //echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }    
        
      /*}*/
  
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="CSS/loginstyle.css">
    <h1>Hector Ortiz Garza A01032773</h1>
    <h3>10/22/2018  5:00 pm</h3>
  </head>

  <body>
  <main>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill this form to create an account.</p>
  </div>

  <div class="container <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
    <label>Username</label>
    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
    <span class="help-block"><?php echo $username_err; ?></span>
  </div>   

  <div class="container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <label>Password</label>
    <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
    <span class="help-block"><?php echo $password_err; ?></span>
  </div>
            
  <div class="container <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
    <span class="help-block"><?php echo $name_err; ?></span>
  </div>

  <div class="container <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
  <label>Email</label>
  <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
  <span class="help-block"><?php echo $email_err; ?></span>
  </div>

  <div class="container <?php echo (!empty($ciudad_err)) ? 'has-error' : ''; ?>">
  <label>Ciudad</label>
  <input type="text" name="ciudad" class="form-control" value="<?php echo $ciudad; ?>">
  <span class="help-block"><?php echo $ciudad_err; ?></span>
  </div>
            
  <div class="container">
    <input type="submit" class="btn btn-primary" value="Submit">
    <input type="reset" class="btn btn-default" value="Reset">
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
  </div>
  
  </form>

  </main>

  <script type="text/javascript" src="js/script.js"></script>
</body>
</html>

