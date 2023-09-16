<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - A Pen by Mohithpoojary</title>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
<link rel="stylesheet" href="loginsty.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form class="login" action= "index.php" method="post">
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" class="login__input" placeholder="User name" name="username">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" class="login__input" placeholder="Password" name="password">
				</div>
				<button class="button login__submit" name="login_Btn">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
				<button class="button login__submit" name="reg_Btn">
					<span class="button__text">Register</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
<!-- partial -->
  
</body>
</html>
<?php
$conn = mysqli_connect("localhost", "root", "");
if(isset($_POST['login_Btn'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$sql= "SELECT * FROM login.logindetails WHERE username = '$username'";
	$result = mysqli_query($conn,$sql);
	while ($row = mysqli_fetch_assoc($result)){
		$resultPassword = $row['password'];
		if ($password == $resultPassword){
			header('Location: portfolio.html');
		}else{
			echo "<script>
			alert('Login unsuccessful');
			</script>";
		}
	}
}
if(isset($_POST['reg_Btn'])){
    // Establish a connection to the database
    $conn = mysqli_connect("localhost", "root", "", "login");

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get user input from the registration form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists in the database
    $checkUsernameQuery = "SELECT * FROM logindetails WHERE username = '$username'";
    $checkResult = mysqli_query($conn, $checkUsernameQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>
                alert('Username already exists. Please choose a different username.');
              </script>";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO logindetails (username, password) VALUES ('$username', '$password')";

        if (mysqli_query($conn, $insertQuery)) {
            echo "<script>
                    alert('Registration successful. You can now log in.');
                  </script>";
        } else {
            echo "<script>
                    alert('Error: " . mysqli_error($conn) . "');
                  </script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
}

?>