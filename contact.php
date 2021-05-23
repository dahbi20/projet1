<?php include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	include 'connect.php';
	if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
		# code...
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$msg = $_POST['message'];

		$sql = "insert into contact(name,email,subject,msg) values('$name','$email','$subject','$msg')";
		if ($conn->query($sql) === true) {
			# code...
			$sub = "Contact from Website - EcoMyWay";
			$body = "name: $name\nEmail: $email\nSubject: $subject\nMessage: $msg";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= "From: $name <$email>" . "\r\n";

			$header = "From: arpit73891@gmail.com"."\r\n"."Reply-To: $email";
			mail('arpit73891@gmail.com',$sub,$body,$header);
			?>
			<script>
				alert("Merci! Veuillez nous donner 24 heures pour revenir en arrière.");
			</script>
			<?php
		}else {
			?>
			<script>
				alert("Pardon! il y a eu une erreur de serveur. Veuillez réessayer.");
			</script>
			<?php
		}
	}
}

?>

<!--contact start here-->
<div class="contact">
	<div class="container">
		<div class="contact-main">
			<div class="contact-top">
				<h2>Contact</h2>
				<p>Mon interaction avec vous ne se limite pas seulement aux conférences vidéo. Vous êtes libre de me contacter via les plateformes de médias sociaux suivantes.</p>
			</div>
			<div class="contact-block1">
			 	<div class="col-md-6 contact-address">
			 	<h3>Coordonnées</h3>
			 	<p>N’hésitez pas à me contacter en cas de doutes, de requêtes et de suggestions.</p>
			 	<ul>
			    	<li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span><p>Avenue Abou Maachar Al Balkhi B.P 1317 Guelmim</p></li>
			    	<li><span class="glyphicon glyphicon-phone" aria-hidden="true"> </span><p>0528772746</p></li>
			    	<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span><p><a href="mailto:arpit73891@gmail.com">serv.etud.estg@gmail.com</a></p></li>
			    </ul>
			 	</div>
			 	<div class="col-md-6 contact-block-left">
				 	<form action="#" method="post">
				 		<input type="text" placeholder="nom" required="" name="name">
	                    <input type="text" class="email" placeholder="Email" name="email">
	                    <input type="text" class="Objet" placeholder="Subject" name="subject">
	                    <textarea placeholder="Message" name="message"></textarea>
	                    <input type="submit" value="Envoyer">
				 	</form>
			 	</div>
			 	<div class="clearfix"> </div>
			 </div>

		</div>
	</div>
</div>
<!--contact end here-->

<?php include 'footer.php'; ?>
