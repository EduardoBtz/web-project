<?php

/* Database credentials*/
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'pcfactory');
$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Define variables and initialize with empty values
$fname = $lname = $country = $subject = "" ;
$fname_err = $lname_err = $country_err = $subject_err = "" ;

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate first name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter first name";
    } else{
      $fname = trim($_POST["fname"]);
      $fname_err = "";
    }

    // Validate password
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter last name";
    } else{
        $lname = trim($_POST["lname"]);
        $lname_err = "";
    }

    // Validate country
    if(empty(trim($_POST["country"]))){
      $country_err = "Please enter your country";
    } else{
        $country = trim($_POST["country"]);
        $country_err = "";
    }

    // Validate subject
    if(empty(trim($_POST["subject"]))){
      $subject_err = "Please enter the subject";
    } else{
        $subject = trim($_POST["subject"]);
        $subject_err = "";
    }

    // Check input errors before inserting in database (not working atm)
    if(empty($fname_err) && empty($lname_err) && empty($country_err) && empty($subject_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO comments (fname, lname, country, subject) VALUES ('$fname','$lname','$country','$subject');";

        if (mysqli_query($connect, $sql))
        {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }

      }
      // Close connection
    mysqli_close($connect);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PCFactory Home</title>

    <!-- Bootstrap core CSS -->
    <link href="styles/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles/customStyles.css" rel="stylesheet">
    <!--    <link href="styles/cartStyle.css" rel="stylesheet">-->
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">PCFactory</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="index.php">Home</a>
        <a class="p-2 text-dark" href="aboutUs.php">About Us</a>
        <a class="p-2 text-dark" href="contact.php">Contact</a>
    </nav>
    <a class="btn btn-outline-primary" href="shoppingCart.php">Shopping Cart</a>
</div>


<div class="welcome-banner">
    <div class="welcome-text">
        <h1 style="font-size:50px">Contact us</h1>
    </div>
</div>
<br />

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

  <div class="container">
    <h1>Contact us!</h1>
    <p>Please fill this form to send us any question/feedback!</p>
  </div>

  <div class="container <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
    <label>First name</label>
    <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
    <span class="help-block"><?php echo $fname_err; ?></span>
  </div>

  <div class="container <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
    <label>Last name</label>
    <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
    <span class="help-block"><?php echo $lname_err; ?></span>
  </div>

  <div class="container <?php echo (!empty($country_err)) ? 'has-error' : ''; ?>">
    <label>Country</label>
    <input type="text" name="country" class="form-control" value="<?php echo $country; ?>">
    <span class="help-block"><?php echo $country_err; ?></span>
  </div>

  <div class="container <?php echo (!empty($subject_err)) ? 'has-error' : ''; ?>">
  <label>Feedback</label>
  <input type="textarea rows="4" cols="50"" name="subject" class="form-control" value="<?php echo $subject; ?>">
  <span class="help-block"><?php echo $subject_err; ?></span>
  </div>

  <div class="container">
    <input type="submit" class="btn btn-primary" value="Submit">
  </div>

  </form>

<div class="container">
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="../../assets/brand/bootstrap-solid.svg" alt="" width="24" height="24">
                <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Cool stuff</a></li>
                    <li><a class="text-muted" href="#">Random feature</a></li>
                    <li><a class="text-muted" href="#">Team feature</a></li>
                    <li><a class="text-muted" href="#">Stuff for developers</a></li>
                    <li><a class="text-muted" href="#">Another one</a></li>
                    <li><a class="text-muted" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                    <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                    <li><a class="text-muted" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
</body>

</html>
