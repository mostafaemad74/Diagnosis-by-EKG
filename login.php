<?php

// $password = password_hash('123456', PASSWORD_DEFAULT);

// echo $password;
// if(password_verify('123456', $password)){
//   echo 'yes';
// }
// exit();
session_start();
if(isset($_SESSION['username'])){
  header('location: admin/index.php');
  exit();
}

include 'connection.php';
if (isset($_POST['log'])){
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $stmt = $con->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute(array($username));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $userCount = $stmt->rowCount();

  if($userCount == 1 ){
    $hashedPasswordCheck = password_verify($password, $row['password']);
    if($hashedPasswordCheck){
        $_SESSION['username'] = $row['username'];
        header('location: admin/index.php');
        exit();
    }else
        $error_msg[] = 'Password not matched';
  }else
      $error_msg[] = 'Invelid username';

}
?>

<!DOCTYPE html>
<html>
<title>Login</title>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="w3-theme-black.css">
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
<style>

@media only screen and (max-width: 601px) {.w3-top {position:static;}}

</style>
<body id="myPage">
<header id="header">
          <h1 id="logo"><a href="index.html" style="font-family:'Vivaldi';font-size:40px;">Heart disease</a></h1>
          <nav id="nav">
            <ul>
              <li><a href="index.html"style="font-family:'Algerian';font-size:20px;">Home</a></li>
              <li><a href="login.php" class="button primary">Admin</a></li>
            </ul>
          </nav>
        </header>




<div class="w3-center w3-animate-opacity"><br> <br>
      <img src="images/18.jpg" alt="Avatar" style="width:20%" class="w3-circle w3-margin-top">
    </div>



    <div class="w3-container ">
      <div class="w3-section">
        <div>
          <?php
            if(isset($error_msg)){
                if(empty(!$error_msg)){
                    echo '<div>';
                    echo '<ul>';
                    foreach ($error_msg as $error){
                        echo '<li style = "color:red">' ;
                        echo $error;
                        echo '</li>' ;
                    }
                    echo '</ul>';
                    echo   '</div>';
                }
            }
            ?>
        </div>
        

        <form action="login.php"  method="POST">
          <label><b>Username</b></label>
          <input  class="w3-input w3-border w3-margin-bottom"  type="text" placeholder="Enter UserName" name="username" required><br>

          <label><b>Password</b></label>
          <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="password" required><br>
          
          <input type="submit" class="w3-btn w3-btn-block w3-green w3-section" name="log" value="Login">
        </form> 
      </div>
    </div>
    
    






<footer id="footer">
          <ul class="icons">
            <li><a href="https://twitter.com/Mostafa_Emad74" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="https://www.facebook.com/mostafaemad.emad.5" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
            <li><a href="https://www.instagram.com/mostafa_tata99/" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
            <li><a href="#" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
          </ul>
          <ul class="copyright">
            <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="https://www.facebook.com/mostafaemad.emad.5">Mostafa Emad</a></li>
          </ul>
</footer>










<script>
function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.width = "300px";
    document.getElementsByClassName("w3-sidenav")[0].style.textAlign = "center";
    document.getElementsByClassName("w3-sidenav")[0].style.fontSize = "40px";
    document.getElementsByClassName("w3-sidenav")[0].style.paddingTop = "10%";
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
}

function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
}
</script>

</body>
</html>