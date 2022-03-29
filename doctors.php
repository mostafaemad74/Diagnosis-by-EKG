<?php 

	include 'connection.php';
	if(isset($_GET['search'])){

		$stmt = $con->prepare('SELECT * FROM doctors WHERE name like ?');
	    $stmt->execute(array('%'. $_GET['search'] .'%'));
	    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    
	}else{
		// echo "test";
		// exit();
		$stmt = $con->prepare('SELECT * FROM doctors');
	    $stmt->execute();
	    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Heart disease</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="index.html" style="font-family:'Vivaldi';font-size:40px;">Heart diseases</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html" style="font-family:'Algerian';font-size:20px;">Home</a></li>
							<li>
								<a href="#"style="font-family:'Algerian';font-size:20px;">Services</a>
								<ul>
									<li><a href="diseases.php">Heart diseases</a></li>
									<li><a href="diagnosis.HTML">Diagnosis</a></li>
									<li><a href="doctors.php">Doctors</a></li>
									<li><a href="hospitals.php">Hospitals</a></li>
									<li><a href="food.HTML">Diet for heart patients</a></li>
								</ul>
							</li>
							<li><a href="login.php" class="button primary">Admin</a></li>
						</ul>
					</nav>
					
				</header>

			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>Some cardiologists in Egypt</h2>
							<p>If you want information about cardiologists in Egypt, you can find it here.</p>
							<form action="<?php echo $_SERVER['PHP_SELF']?>">
								<input placeholder="Search for a doctor " type="text" name="search" style="margin-bottom: 20px;">
								<input type="submit" >
							</form>
						</header>

						<!-- Content -->
							<section id="content">
								<h2>cardiologists in Egypt</h2>
								<a  class="image fit"><img src="images/1212.jpg" alt="" /></a>
								<?php 
									foreach ($doctors as $doctor) {?>
										<div>
											<br>
											<h3><?php echo $doctor['name'] ?></h3>
											<p><span class="image right"><img src="images/<?php echo $doctor['image'] ?>" alt="" /></span></p>
											<h4>أستاذ و استشارى القلب و الأوعية الدموية و القسطرة - جامعة الأزهر</h4>
											<ul >
												<li><?php echo $doctor['specialty'] ?></li>
												<li><?php echo $doctor['waiting'] ?> minute</li>
												<li><?php echo $doctor['about'] ?></li>
											</ul>
										</div>
									<?php }

								?>
								
							</section>
					</div>
				</div>

			<!-- Footer -->
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

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>