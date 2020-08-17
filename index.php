<!--Formulaire checkbox pour afficher les fichiers masqués-->
<form class="" action="" method="GET">
  <label for="">Afficher les fichiers masqués</label>
  <input type="checkbox" name="hidden" value="checked">
  <button type="submit" name="button" value="send">Envoyer</button>
</form>

<?php
  /*-------------------------------Affichage-------------------------------*/

  // Création du dossier de départ
  $start = "start";
  if(!is_dir($start)){
    mkdir("start");
  }

  $hidden = isset($_GET['hidden']); // Ajout de la variable pour les fichiers masqués

  // Récupère le chemin du répertoire courant et le stocke dans une variable.
  if(!isset($_GET['cwd'])){
    $cwd = getcwd().DIRECTORY_SEPARATOR.$start;
  } else {
    $cwd = $_GET['cwd'];
  }

  /*-------------------------------Navigation-------------------------------*/

  echo "<form method='get' id='ch_cwd'></form>"; // Formulaire pour changé de répertoire

  // Afficher le fil d'ariane
  $breadcrumbs = explode(DIRECTORY_SEPARATOR, $cwd);
  $path = "";
  foreach($breadcrumbs as $name){
    $path .= $name.DIRECTORY_SEPARATOR;
    if (strstr($path, $start)) {
      echo "<button type='submit' name='cwd' form='ch_cwd' value='". substr($path, 0, -1) . "'>";
      echo $name ;
      echo "</button>";
    }
  }

  echo "<br>";

  // Afficher le contenu du répertoire courant et navigation dans les dossiers
  $content = scandir($cwd);
  foreach ($content as $file) {
    if ($file == "." || $file == ".." || $hidden == NULL && $file[0] == "."){
      echo "";
    }
    else {
      echo "<br><button type='submit' name='cwd' form='ch_cwd' value='".$cwd.DIRECTORY_SEPARATOR.$file."'> ". $file ." </button>";
    }
  }
?>
