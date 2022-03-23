
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <header>Fiche d'informations</header>
<?php
// Variables
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$age = $_POST['age'];
$tel = $_POST['numero'];
$email =$_POST['email'];
$filiere = $_POST['filiere'];
$level = $_POST['level'];
$modules = $_POST['modules'];
$nb_projet = $_POST['nb_projet'];
$remarque = $_POST['remarque'];
$clubs = $_POST['clubs'];
$fileName =$_FILES['image']['name'];
$filetmp =$_FILES["image"]["tmp_name"];
$path = 'files/'.$fileName;
// Tout type de fichier importé dans le formulaire html sera récupéré est enregistré  dans le dossier ./files
// s'il sagît d'une image elle sera affiché dans la recap.php
$image = move_uploaded_file($filetmp, $path);
if(isset($_POST['envoyer'])){
    if(!empty($nom) && !empty($prenom) && !empty($age) && !empty($tel) && !empty($email) 
    && isset($filiere) && isset($level) && isset($modules) && isset($nb_projet) && isset($remarque) && isset($clubs) && !empty($fileName)){
        
        // Affichage des données sous forme d'un tableau
        echo '   
                 <fieldset class="personnel"><legend><h4>Les informations de l\'etudiant</h4></legend>
                 <table>
                 <tr><td>Nom</td><td>::::</td><td>'.$nom.'</td></tr>
                 <tr><td>Prenom</td><td>::::</td><td>'.$prenom.'</td></tr>
                 <tr><td>Age</td><td>::::</td><td>'.$age.'</td></tr>
                 <tr><td>N° de téléphone</td><td>::::</td><td>'.$tel.'</td></tr>
                 <tr><td>Adresse de courrier</td><td>::::</td><td>'.$email.'</td></tr>
                 <tr><td>Filière</td><td>::::</td><td>'.$filiere.'</td></tr>
                 <tr><td>Niveau</td><td>::::</td><td>'.$level.'</td></tr>
                 <tr><td>Modules</td><td>::::</td><td>';
                 foreach($modules as $course){
                    echo "<p>$course</p>";
                } 
                echo '</td></tr>
                <tr><td>Clubs intégrés</td><td>::::</td><td>';
                 foreach($clubs as $club){
                    echo "<p>$club</p>";
                } 
                echo '</td></tr>
                <tr><td>Nombre de projets</td><td>::::</td><td>'.$nb_projet.'</td></tr>
                <tr><td>Vos remarques</td><td>::::</td><td>'.$remarque.'</td></tr>
                <tr><td>Image</td><td>::::</td><td><div><img src='.$path.' alt="Probleme affichage"></div></td></tr>
                 </table>
              </fieldset>';
              
    }
}
// Enregistrer le fichier importé sur la page formulaire.html

 ?>

 <br> <center><button onclick="history.go(-1)" id="btn">Modifier</button>&nbsp;&nbsp;&nbsp;<button onclick="saveEtudiant()" id="btn">SaveAsFile</button></center>
 <script>
    function saveEtudiant() {
        <?php 
                    // Code pour écrire les données récupérées par le serveur http
                    $file = fopen("Etudiant.txt", "a+");
                    fputs($file,  "Nom complet: ".$nom .' '.$prenom ."\n");
                    fputs($file,  $age . "ans\n");
                    fputs($file,  "Tél: ".$tel . "\n");
                    fputs($file,  "Mail: ".$email . "\n");
                    fputs($file,  "Filière: ".$filiere . "\n");
                    fputs($file,  "Niveau: ".$level . "\n");
                    fputs($file, "Les modules suivies cette année:\n");
                    foreach ($modules as $course)
                        fputs($file, "---> ".$course . "\n");
                    fputs($file, "Nombre de projets: ".$nb_projet . "\n");
                    fputs($file, "Remarques: ".$remarque . "\n");
                    fputs($file, "************************************\n");
                    fclose($file);
                    ?>
                    window.location.href = "formulaire.html";
    }
</script>
</body>
</html>