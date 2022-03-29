<?php

session_start();

if(isset($_SESSION['username'])){
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '../connection.php';
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $symptoms = filter_var($_POST['symptoms'], FILTER_SANITIZE_STRING);
    $causes = filter_var($_POST['causes'], FILTER_SANITIZE_STRING);
    $treatment = filter_var($_POST['treatment'], FILTER_SANITIZE_STRING);
    
// upload image
  $image = '';
  if(isset($_FILES['image']) && $_FILES['image']['name'] !=''){
    $filename = $_FILES['image']['name'];
    $fileTempName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];

    $fileExtension = explode('.', $filename);
    $fileExt = strtolower(end($fileExtension));
    $allowed = ['jpg', 'jpeg', 'png'];

    if(in_array($fileExt, $allowed)){
      if($fileSize < 2000000){
          $image = uniqid('', true) . '.' . $fileExt;
          $fileDestination = '../images/'. $image;
          move_uploaded_file($fileTempName, $fileDestination);
      }else
          $error ='Your file is too big';
    }else
        $error ='You can\'t upload file of this type';
  }


    $stmt2 = $con->prepare('INSERT INTO `diseases` ( `name`, `symptoms`, `causes`, `treatment`, `image`) VALUES (?, ?, ?, ?, ?);');
    $stmt2->execute(array($name, $symptoms, $causes, $treatment, $image));
    $success = "Disease added successfully";

  }   

}else{
    header('location: ../login.php');
}




?>

<!DOCTYPE html>
<html>
<title>Login</title>


<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../w3.css">
<link rel="stylesheet" href="../w3-theme-black.css">
<link rel="stylesheet" href="../../cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="../assets/css/main.css" />
    <noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
<style>

@media only screen and (max-width: 601px) {.w3-top {position:static;}}

</style>
<body id="myPage">
<header id="header">
          <h1 id="logo"><a href="../index.html" style="font-family:'Vivaldi';font-size:40px;">Heart disease</a></h1>
          <nav id="nav">
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="../diseases.php">Heart diseases</a></li>
              <li><a href="../diagnosis.HTML">Diagnosis</a></li>
              <li><a href="../doctors.php">Doctors</a></li>
              <li><a href="../hospitals.php">Hospitals</a></li>
              <li><a href="logout.php" class="button primary">Loguot</a></li>
            </ul>
          </nav>
        </header>

<div class="w3-center w3-animate-opacity"><br><br>
      <img src="../images/18.jpg" alt="Avatar" style="width:20%" class="w3-circle w3-margin-top">
    </div>

    <div class="w3-container ">
      <div class="w3-section">
        <div>

          <?php 
            if(isset($success)){?>
              <div style="color: #fff;padding: 10px;text-align: center;background: green;"><?php echo $success ?></div>
            <?php }

           ?>


          <form action="<?php echo $_SERVER['PHP_SELF']?>"  method="POST" enctype="multipart/form-data">
            <label><b>Name</b></label>
            <input  class="w3-input w3-border w3-margin-bottom"  type="text" placeholder="Enter Diseases Name" name="name" required><br>
            <label><b>Symptoms</b></label>
            <input  class="w3-input w3-border w3-margin-bottom"  type="text" placeholder="Enter Diseases Symptoms" name="symptoms" required><br>
            <label><b>Causes</b></label>
            <input  class="w3-input w3-border w3-margin-bottom"  type="text" placeholder="Enter Diseases Causes" name="causes" required><br>

            <label><b>Treatment</b></label>
            <input  class="w3-input w3-border w3-margin-bottom"  type="text" placeholder="Enter Doctor Treatment" name="treatment" required><br>
            <input type="file"  name="image" ><br>
            <input type="submit" class="w3-btn w3-btn-block w3-green w3-section" name="log" value="Add">
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