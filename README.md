## Explorateur de fichiers PHP

### Affichage

#### Création du dossier de départ

Pour cela, nous affectons à une variable **$start** le nom du dossier de départ, "start". Ensuite, on exécute une boucle qui vérifie si le nom de fichier spécifié est un répertoire, avec la fonction **is_dir();**. Mais, avant cela on utilise un opérateur de comparaison **(!)**, qui va vérifier la condition quand elle est fausse, c'est-à-dire, **si le nom de fichier spécifié est un répertoire qui n'existe pas**.

```
$start = "start";
if(!is_dir($start)){
  mkdir("start");
}
```

#### Les fichiers masqués

Ensuite, on affecte à la variable **$hidden** la fonction : **isset()**. Cette fonction vérifie **si la variable est vide et est déclarée**. Mais aussi, ce qui signifie qu'elle n'est pas **NULL**. Donc, la fonction renvoie **TRUE** si la variable existe et n'est pas NULL, sinon elle retourne **FALSE**.

```
$hidden = isset($_GET['hidden']);
```

Comme on peut le voir, le premier paramètre de la fonction isset(), est la variable **super globale $_GET**, qui est utilisée pour collecter des données de formulaire après avoir soumis un formulaire HTML avec **method="get"**.
