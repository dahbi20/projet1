	<?php 
	//initiate session
	session_start();
	
	//Filtrer l'acces a la page
	if (!isset($_SESSION['login-teacher'])){
		header("Location: http://localhost/online/register.php");
	}
	?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>

		<title>Télécharger Video</title>
		<link href="css/bootstrapvideo.css" rel="stylesheet" type="text/css" media="screen">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
		<!-- <link rel="stylesheet" type="text/css" href="css/style1/css"> -->
		<?php include "connect.php"; ?>
	</head>
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/bootstrap.js" type="text/javascript"></script>


	<body>

		<div class="login">
		<ul>
				<?php
				if (isset($_SESSION['login-teacher']) && $_SESSION['login-teacher'] == "yes") {
				?>
					<a href="teacher_dashboard.php">
						<li>Accueil</li>
					</a>
					<a href="log.php?out">
						<li>Déconnexion</li>
					</a>
				<?php
				} else {
				?>
					<a href="login.php">
						<li>connexion</li>
					</a>
					<select value="sel" onchange="JavaScript:location.href=this.value" style="background-color: transparent;border-color: black;border:0px;color:black;background-position-x:70 px; padding-right:10px; margin-right: -20px;width: 88px; ">
						<option>Register</option>
						<option value="register_teacher.php">
							I'm a Teacher
						</option>
						<option value="register.php">
							I'm a Student
						</option>
					</select>

				<?php
				}
				?>
			</ul>


			<?php
			if (isset($_POST['topic']) && ($_GET['t'])) {
				$naam = $_POST['topic'];
				$cht = $_GET['t'];
				$url = $_REQUEST['url'];
				$step1 = explode('v=', $url);
				$step2 = explode('&', $step1[1]);
				$vedio_id = $step2[0];
				$link = "https://www.youtube.com/embed/$vedio_id";
				$vid = "insert into videos(cid,name,link,book) values ($cht,'$naam','$link',1)";
				$result_micro = mysqli_query($conn, $vid) or die(mysqli_error($conn));
			}

			?>
			<div class="clearfix"> </div>
		</div>
		<div style="margin-left: 200px;padding-top: 50px;">
			<form method="POST">
				<input type="text" name="topic" placeholder="Entrez le sujet" required="yes" autocomplete="off" /><br>
				<input type="text" name="url" placeholder="Entrez l’URL" autocomplete="off" />
				<input type="submit" name="upload-video" value=" Cliquez pour télécharger l’URL" onclick="alert('video uploaded Successfully')" style="margin-left: 50px;padding-bottom:2px;margin-bottom: 10px;">
			</form>
		</div>




		<div class="row-fluid">
			<div class="span12">
				<div class="container">
					<br>
					<br>
					<form method="post" enctype="multipart/form-data">
						<?php
						include 'dbconn.php';
						if (isset($_FILES['file'])) {

							$name = $_FILES['file']['name'];
							$extension = explode('.', $name);
							$extension = end($extension);
							$type = $_FILES['file']['type'];
							$size = $_FILES['file']['size'] / 1024 / 1024;
							$random_name = rand();
							$tmp = $_FILES['file']['tmp_name'];


							if ((strtolower($type) != "video/mpg") && (strtolower($type) != "video/wma") && (strtolower($type) != "video/mov")
								&& (strtolower($type) != "video/flv") && (strtolower($type) != "video/mp4") && (strtolower($type) != "video/avi")
								&& (strtolower($type) != "video/qt") && (strtolower($type) != "video/wmv") && (strtolower($type) != "video/wmv")
							) {
								$message = "Video Format Not Supported !";
							} else {
								move_uploaded_file($tmp, 'upload/' . $random_name . '.' . $extension);
								$conn->query("insert into videos (title,location) values ('$name','$random_name.$extension')");
								$message = "Video Uploaded Successfully!";
							}

						?>
							<?php
							echo "<script type='text/javascript'>alert('$message\\n\\nUpload: $name\\nSize: $size\\nType: $type\\nStored in: uploads/$name');</script>";
							?>

						<?php
						}

						?>


						<h4> Sélectionnez une vidéo :</h4>
						<input name="UPLOAD_MAX_FILESIZE" value="20971520" type="hidden" />
						<input type="file" name="file" id="file" />

						<input type="submit" value="Cliquez pour télécharger" />
					</form>

					<hr>

					<!-- List of Videos -->
					<h4>Liste des vidéos téléchargées:</h4>


					<ul>
						<?php
						$query = $conn->query("SELECT * FROM videos");
						while ($row = $query->fetch_assoc()) {
							$video_id = $row['vid'];
						?>

							<a href="#adredour<?php echo $video_id; ?>" data-toggle="modal"><?php echo $row['name']; ?> </a><br>
							<?php include('video_modal.php'); ?>
						<?php
						}
						?>
					</ul>

				</div>
			</div>
		</div>


	</body>

	</html>