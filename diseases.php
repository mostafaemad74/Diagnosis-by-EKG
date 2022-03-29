<?php 

	include 'connection.php';

	if(isset($_GET['search'])){

		$stmt = $con->prepare('SELECT * FROM diseases WHERE name like ?');
	    $stmt->execute(array('%'. $_GET['search'] .'%'));
	    $diseases = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    
	}else{
		$stmt = $con->prepare('SELECT * FROM diseases');
	    $stmt->execute();
	    $diseases = $stmt->fetchAll(PDO::FETCH_ASSOC);	
	}
	

?>

<!DOCTYPE HTML>
<!--
	Landed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
							<li><a href="index.html"style="font-family:'Algerian';font-size:20px;">Home</a></li>
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
							<h2>Some heart diseases</h2>
							<p>If you want to know information about some heart diseases, you can look for it here</p>
							<form action="<?php echo $_SERVER['PHP_SELF']?>">
								<input placeholder="Search for diseases" type="text" name="search" style="margin-bottom: 20px;">
								<input type="submit" >
							</form>
						</header>
						<div class="row gtr-150">
							<div class="col-4 col-12-medium">

								<!-- Sidebar -->
										<section>
											<a  class="image fit"><img src="images/8.jpg" alt="" /></a>
											<h3>Other diseases</h3>
											<p>You can find some other heart diseases by clicking on 'Learn More'</p>
											<footer>
												<ul class="actions">
													<li><a href="https://www.webteb.com/heart/diseases" class="button">Learn More</a></li>
												</ul>
											</footer>
										</section>
									</section>

							</div>
							<div class="col-8 col-12-medium imp-medium">

								<!-- Content -->
									<section id="content">
										<?php 
											foreach ($diseases as $disease) {?>
											<a href="#" class="image fit"><img src="images/<?php echo $disease['image'] ?>" alt="" /></a>
												<h2><?php echo $disease['name'] ?></h2>
												<h4>Symptoms (الأعراض)</h4>
												<p><?php echo $disease['symptoms'] ?></p>
												<h4>Causes (الأسباب)</h4>
												<p><?php echo $disease['causes'] ?></p>
												<h4>Treatment (العلاج)</h4>
												<p><?php echo $disease['treatment'] ?></p>
											<?php }
										?>
										
									</section>

							</div>
						</div>
					</div>
				</div>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon brands alt fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
						<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon solid alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
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