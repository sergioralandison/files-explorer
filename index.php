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
?>
