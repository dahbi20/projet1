<?php include 'header.php';

// Si QQ un est dejq inscrit -> dashboard
if (isset($_SESSION['login'])) {
  # code...
?>
  <script>
    alert("Déjà connecté. Vous redirige vers le tableau de bord.");
    window.location.assign("dashboard.php");
  </script>
  <?php
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  # code...
  include 'connect.php';
  if (isset($_POST['name']) && isset($_POST['num']) && isset($_POST['select']) && isset($_POST['email']) && isset($_POST['pass'])) {
    # code...
    $all_ok = 1;
    $msg = "";
    $name = $_POST['name'];
    $num = $_POST['num'];
    $sel = $_POST['select'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    //Initier la session du nouveau inscrit
    $_SESSION['login'] = 'yes';
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $all_ok = 0;
      $msg = "EMAIL INVALIDE.";
    }

    if (!(strlen($num) == 10)) {
      # code...
      $all_ok = 0;
      $msg = "NUMÉRO INVALIDE.";
    }

    if ($all_ok == 1) {
      # code...
      $insert = "insert into user(name,phone,email,password,status) values('$name',$num,'$email','$pass',0)";
      if ($conn->query($insert) === true) {
        # code...
  ?>
        <script>
          alert("Enregistré avec succès. Veuillez sélectionner votre domaine d'intérêt.");
          window.location.assign("dashboard.php");
        </script>
      <?php
      } else {
        echo $conn->error;
      ?>
        <script>
          alert("Vous semblez déjà inscrit. Veuillez vous connecter ou utiliser le lien du mot de passe oublié si vous l'avez oublié.");
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        alert("<?php echo $msg; ?>");
      </script>
    <?php
    }
  } 
  else {
    ?>
    <script>
      alert("Les champs ne peuvent pas être laissés vides, veuillez remplir vos détails");
    </script>
<?php
  }
}

?>

<div class="login-form">
  <center>
    <h2> Inscrivez-vous ici pour obtenir un accès complet à notre contenu</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <input type="text" placeholder="Nom:[A-Z]" name="name" autocomplete="Désactivé" required="Oui" pattern="[A-Za-z\\s]*" />
      <input type="number" placeholder="Numéro de mobile à 10 chiffres" name="num" autocomplete="Désactivé" required="Oui" />
      <div id="ck1">
        <select id="soflow" name="select">
          <option>GENRE</option>
          <option>MÂLE</option>
          <option>FEMELLE</option>
        </select>
      </div>
      <input type="email" placeholder="E-Mail" name="email" autocomplete="Désactivé" required="Oui" />
      <input type="password" placeholder="Mot de passe" name="pass" autocomplete="Désactivé" required="Oui" />
      <button type="submit">INSCRIVEZ-VOUS en tant qu'étudiant</button>
    </form>
    <a href="login.php"><button>Déjà enregistré? Connexion</button></a>
  </center>
</div>

<?php include 'footer.php'; ?>