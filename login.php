<!-- <!DOCTYPE html>
<html>
<head>
  <title>Se connecter</title>
  <link rel="stylesheet" href="style7.css">
  <link rel="stylesheet" href="style7.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="icon" type="image/png" href="37005.png">
  <link rel="shortcut icon" type="image/png" href="archive.png"> -->
  <!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Se connecter</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add your custom CSS file -->
    <link rel="stylesheet" type="text/css" href="style7.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="37005.png">
    <link rel="shortcut icon" type="image/png" href="archive.png">
	</head>
	<body>
</head>
<body>

<?php
require('config.php');
session_start();

if (isset($_POST['email'])) {
  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($conn, $email);
  $password = stripslashes($_REQUEST['mot_de_passe']);
  $password = mysqli_real_escape_string($conn, $password);
  $query = "SELECT * FROM `utilisateurs` WHERE email='$email' AND mot_de_passe='".hash('sha256', $password)."'";
  $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['email'];
    $_SESSION['niveau_acces'] = $user['niveau_acces'];
    if ($user['niveau_acces'] == 'super') {
      // Redirection vers le tableau de bord du superutilisateur
      header("Location: tableaubord.php");
      exit; // Add exit after header redirections to stop further execution
    } elseif ($user['niveau_acces'] == 'user') {
      // Redirection vers le tableau de bord de l'utilisateur
      header("Location: tableuser.php");
      exit; // Add exit after header redirections to stop further execution
    }
  } else {
$message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>

		<br><br>
		<div class="container col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
      <div class="panel-heading display-3"><h3>Application Gestion d'Archive <br> Lycée Collégiale AKKA <br> ثانوية أقـــــا الاعدادية</h3></div>
      <br>
				<div class="panel-heading">Se connecter </div>
        
				<div class="panel-body">
        <form class="box" action="" method="post" name="login">
									
						<div class="form-group">
							<label for="login" class="control-label" >E-mail</label>
							<input type="email" name="email" placeholder="Email" autocomplete="off" id="login" class="form-control" required/>
						</div>
						
						<div class="form-group">
							<label for="pwd" class="control-label">Mot de passe</label>
							<input type="password" name="mot_de_passe" placeholder="Mot de passe" id="pwd" class="form-control" required/>
						</div>
							
						<button type="submit" class="btn btn-primary btn-block">Se connecter</button>
						<br>
						
						<a href="registre1.php">Créer mon compte</a>
						&nbsp&nbsp&nbsp&nbsp&nbsp
						<!-- <a href="page_demande_pwd.php">Mot de passe oublié</a> -->
						
					</form>
				</div>
			</div>			
		</div>
	</body>
</html>

  <?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
  <?php } ?>



