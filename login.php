<?php include 'header.php';

if (isset($_SESSION['login'])) {
  # code...
  ?>
  <script>
    alert("Déjà connecté. Redirigez-vous vers le tableau de bord.");
    window.location.assign("dashboard.php");
  </script>
  <?php
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  # code...
  include 'connect.php';
  if (isset($_POST['email']) && isset($_POST['pass'])) {
    # code...
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['pass']);
    $sql = "select * from user where email='$email' and password='$pass'";
    $sql1 = "select * from teacher where temail= '$email' and password ='$pass'";
    $result = $conn->query($sql);
    $res = $conn->query($sql1);

    //Initier session login teacher
    $_SESSION['login-teacher'] = 'yes';

    //Initier session login student
    $_SESSION['login'] = 'yes';

    if ($result->num_rows > 0) {
      ?>
      <script>
        window.location.assign("log.php?in=<?php echo $email; ?>");
      </script>
      <?php
    }elseif ($res->num_rows>0) {
      ?>
      <script>
        window.location.assign("log.php?te=<?php echo $email; ?>")
      </script>
    }
      <?php
    }else {
      ?>
      <script>
        alert("mauvais détails. Veuillez vérifier soigneusement la saisie de vos détails.");
      </script>
      <?php
    }
  }else {

    ?>
    <script>
      alert("Les champs ne peuvent pas être laissés vides, veuillez remplir vos détails ");
    </script>
    <?php
  }
}


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<div class="login-form">
<center>
  <h2> Connexion à votre compte </h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <input type="email" placeholder="E-Mail" name="email" autocomplete="off" required="yes" />
    <input type="password" placeholder="Password" name="pass" autocomplete="off" required="yes" />
    <button type="submit">Connexion</button>
  </form>
  <h3>Mot de passe oublié?</h3>
  <a href="register.php"><button>Vous n’êtes pas inscrit? Inscrivez-vous ici</button></a>
</center>
</div>

<?php include 'footer.php'; ?>
