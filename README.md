## Explorateur de fichiers PHP

### Affichage

#### Création du dossier de départ

Pour cela, nous affectons à une variable **$start** le nom du dossier de départ, "start". Ensuite, on exécute une boucle qui vérifie si le nom de fichier spécifié est un répertoire, avec la fonction **is_dir();**. Mais, avant cela, on utilise un opérateur de comparaison **(!)**, qui va vérifier la condition quand elle est fausse, c'est-à-dire, **si le nom de fichier spécifié est un répertoire qui n'existe pas**.

```
$start = "start";
if(!is_dir($start)){
  mkdir("start");
}
```

#### Les fichiers masqués

##### Formulaire "checkbox" pour afficher les fichiers masqués

Pour pouvoir exécuter la partie des fichiers masqués, on créer un formulaire :

```
<form class="" action="" method="GET">
  <label for="">Afficher les fichiers masqués</label>
  <input type="checkbox" name="hidden" value="checked">
  <button type="submit" name="button" value="send">Envoyer</button>
</form>
```

Ce formulaire, nous permettra de collecter les données renvoyées par **method="GET"** et *l'input* de type *checkbox*, ainsi que le bouton *submit* enverra les données qui pourront être traitées.

Ensuite, on affecte à la variable **$hidden** la fonction : **isset()**. Cette fonction vérifie **si la variable est vide et est déclarée**. Mais aussi, ce qui signifie qu'elle n'est pas **NULL**. Donc, la fonction renvoie **TRUE** si la variable existe et n'est pas NULL, sinon elle retourne **FALSE**.

```
$hidden = isset($_GET['hidden']);
```

Comme on peut le voir, le premier paramètre de la fonction isset(), est la variable **super globale $_GET**, qui est utilisée pour collecter des données de formulaire après avoir soumis un formulaire HTML avec **method="get"**.

Ensuite, on récupère le chemin du répertoire courant et on le stock dans une variable, pour cela, nous utiliserons le code suivant

```
if(!isset($_GET['cwd'])){
  $cwd = getcwd().DIRECTORY_SEPARATOR.$start;
} else {
  $cwd = $_GET['cwd'];
}
```

Ici, on vérifie **si la variale n'est pas définie** avec la fonction *if(!isset())*, mais nous ajoutons également la super globale PHP **$_GET**. Donc, si la condition est remplie, on affecte à la variable **$cwd**, le chemin du répertoire courant, suivant des séparateurs et le dossier **start**. Sinon, nous affectons les données collectées par le formulaire après soumission de ce dernier avec **method="get"**.

### Navigation

#### Afficher le fil d'ariane

Dans cette partie, on affiche le fil d'ariane, et pour cela nous, utiliserons des boucles, pour parcourir les fichiers. Et le code est le suivant :

```
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
```

Donc, on affecte à la variable **breadcrumbs**, la fonction **explode**, qui divise une chaîne en un tableau avec en premier paramètre le séparateur qui spécifie où diviser la chaîne. En deuxième paramètre, la chaîne à diviser, ici en l'occurence la variable **$cwd** qui contient le répertoire courant.

Ensuite, nous affectons une chaîne vide à la variable **path (chemin)**, qui nous servira plus tard pour le chemin du repértoire. Et nous ouvrons la boucle **foreach** qui pour chaque itération de boucle, la valeur de l'élément du tableau ($breadcrumbs) actuel est affectée à **$name** et le pointeur de tableau est déplacé de un, jusqu'à ce qu'il atteigne le dernier élément du tableau.

Après, on concatène à la variable **$path**, la valeur de l'élément du tableau ($name), et qu'on ajoute un séparateur.

Enfin, on ajoute une boucle **if**, suivi de la fonction **strstr**, qui recherche la première occurence d'un chaîne dans une autre chaîne. Exemple, ici, nous recherchons dans **path** (chemin du répertoire) la variable (dossier) **$start**.

Donc, si les conditions sont remplies, on affiche un bouton de type *submit*, avec comme valeur de l'attribut *value* la fonction **substr**, qui nous renvoie une partie d'une chaîne. Le premier paramètre est le chemin du répertoire ($path), le deuxième paramètre, est le début où commencer la chaîne *(0 = début au premier caractère)* et comme troisième paramètre la longueur (length) de la chaîne et ici, c'est **-1**, qui veut dire, retourner à partir de la fin de la chaîne.

Ensuite, on affiche l'itération avec la variable **$name** et on ferme la balise bouton.

#### Afficher le contenu du répertoire courant et navigation dans les dossiers

Pour cela, nous exécutons le code suivant :

```
$content = scandir($cwd);
foreach ($content as $file) {
  if ($file == "." || $file == ".." || $hidden == NULL && $file[0] == "."){
    echo "";
  }
  else {
    echo "<br><button type='submit' name='cwd' form='ch_cwd' value='".$cwd.DIRECTORY_SEPARATOR.$file."'> ". $file ." </button>";
  }
}
```

Pour commencer, on affecte à la variable **$content** la fonction **scandir**, qui nous renvoie un tableau de fichiers et de répertoires du  répertoire spécifié. Et ici, le répertoire choisi est le répertoire de travail courant **($cwd)**.

Ensuite, on exécute une boucle **foreach**, qui parcourera pour chaque itération le contenu du répertoire de travail courant. Et on vérifie à chaque fois si les fichiers contiennent des **"." ou ".." ou encore si la variable $hidden est égale à NULL et que le fichier débute par un "."**, alors on affiche rien.

Sinon, on affiche un bouton de type *submit* le répertoire de travail courant avec le séparateur et qu'on concatène avec la variable **($file)**.
