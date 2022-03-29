<?php
session_start();

if(isset($_SESSION['username'])){
    include '../connection.php';

// Doctor
    if(isset($_POST['deleteDoctor'])){
        $docID = $_POST['docID'];
        $stmt2 = $con->prepare('DELETE FROM `doctors` WHERE `id` = ?');
        $stmt2->execute(array($docID));
    }
    $stmt = $con->prepare('SELECT * FROM doctors ORDER BY id DESC');
    $stmt->execute();
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);


// End Doctor

    // Hospital
    if(isset($_POST['deleteHospital'])){
        $hospitalID = $_POST['hospitalID'];
        $stmt2 = $con->prepare('DELETE FROM `hospitals` WHERE `id` = ?');
        $stmt2->execute(array($hospitalID));
    }
    $stmt = $con->prepare('SELECT * FROM hospitals ORDER BY id DESC');
    $stmt->execute();
    $hospitals = $stmt->fetchAll(PDO::FETCH_ASSOC);


// End Hospital

    // Diseases
    if(isset($_POST['deleteDisease'])){
        // echo 'dafs';
        // exit();
        $diseaseID = $_POST['diseaseID'];
        $stmt2 = $con->prepare('DELETE FROM `diseases` WHERE `id` = ?');
        $stmt2->execute(array($diseaseID));
    }
    $stmt = $con->prepare('SELECT * FROM diseases ORDER BY id DESC');
    $stmt->execute();
    $diseases = $stmt->fetchAll(PDO::FETCH_ASSOC);


// End Diseases

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
              <li><a href="../index.php">Home</a></li>
              <li><a href="../diseases.php">Heart diseases</a></li>
              <li><a href="../diagnosis.HTML">Diagnosis</a></li>
              <li><a href="../doctors.php">Doctors</a></li>
              <li><a href="../hospitals.php">Hospitals</a></li>
                             
                           
              <li><a href="logout.php" class="button primary">Loguot</a></li>
            </ul>
          </nav>
        </header>

<div class="w3-center w3-animate-opacity"><br> <br>
      <img src="../images/18.jpg" alt="Avatar" style="width:20%" class="w3-circle w3-margin-top">
    </div>

    <div class="w3-container ">
      <div class="w3-section">
        <div>
            <div>
                <h3 style="float: left;font-family:Tahoma; font-size:40px; color:RED;">Doctors</h3>
                <a href="addDoctor.php" class="button" style="float: right ;">Add Doctor</a>
            </div>
        
            <table>
                <tr>
                    <th>Name</th>
                    <th>Specialty</th>
                    <th>Waiting</th>
                    <th>Action</th>
                </tr>
                
                    <?php

                        foreach ($doctors as $doctor) {?>
                            <tr>
                                <td><?php echo $doctor['name']; ?></td>
                                <td><?php echo $doctor['specialty']; ?></td>
                                <td><?php echo $doctor['waiting']; ?> minute</td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                        <input type="hidden" name="docID" value="<?php echo $doctor['id'] ?>">
                                        <input type="submit" value="Delete" name="deleteDoctor">
                                    </form>
                                </td>
                            </tr>
                        <?php }
                    ?>
            </table>
      </div>

      <div>
            <div>
                <h3 style="float: left;font-family:Tahoma; font-size:40px; color:RED;">Hospitals</h3>
                <a href="addHospital.php" class="button" style="float: right;">Add Hospital</a>
            </div>
        
            <table>
                <tr>
                    <th>Name</th>
                    <th>location</th>
                    <th>Action</th>
                </tr>
                
                    <?php

                        foreach ($hospitals as $hospital) {?>
                            <tr>deleteHospital
                                <td><?php echo $hospital['name']; ?></td>
                                <td><?php echo $hospital['location']; ?> </td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                        <input type="hidden" name="hospitalID" value="<?php echo $hospital['id'] ?>">
                                        <input type="submit" value="Delete" name="deleteHospital">
                                    </form>
                                </td>
                            </tr>
                        <?php }
                    ?>
            </table>
      </div>
      <div>
            <div>
                <h3 style="float: left;font-family:Tahoma; font-size:40px; color:RED;">Diseases</h3>
                <a href="addDisease.php" class="button" style="float: right;">Add Disease</a>
            </div>
        
            <table>
                <tr>
                    <th>Name</th>
                    <th>Symptoms</th>
                    <th>Causes</th>
                    <th>Treatment</th>
                    <th>Action</th>
                </tr>
                
                    <?php

                        foreach ($diseases as $disease) {?>
                            <tr>deleteHospital
                                <td><?php echo $disease['name']; ?></td>
                                <td><?php echo $disease['symptoms']; ?> </td>
                                <td><?php echo $disease['causes']; ?></td>
                                <td><?php echo $disease['treatment']; ?> </td>
                                <td>
                                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                        <input type="hidden" name="diseaseID" value="<?php echo $disease['id'] ?>">
                                        <input type="submit" value="Delete" name="deleteDisease">
                                    </form>
                                </td>
                            </tr>
                        <?php }
                    ?>
            </table>
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