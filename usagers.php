<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumentPHP</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Usager page</h1>
    <hr>

<?php

define("MYHOST","localhost"); 
define("MYUSER","root"); 
define("MYPASS","");
define("NomDb","mybibliothèque");  
if(isset($_POST['save'])){
    
    if ( !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adress']) && !empty($_POST['email']) && !empty($_POST['Statut'])){
        $nom= $_POST['nom'];
        $prenom=$_POST['prenom'];
        $adress=$_POST['adress'];
        $email=$_POST['email'];
        $Statut=$_POST['Statut'];
        $sql1 = "SELECT * FROM personne WHERE Email ='$email';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $requet1 = mysqli_query($idcom,$sql1);
        $row = mysqli_fetch_assoc($requet1);
        
        if(!isset($row["Email"])){
            //Requête SQL
            $requete="INSERT INTO personne (Nom,Prénom,Email,Adress,Statut) VALUES('$nom','$prenom','$email','$adress','$Statut');";
            //var pour se connecter a la base de donnees
            $idcom=@mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
            $result=mysqli_query($idcom,$requete);
            if(!$result)
            {
                echo "<h2>Erreur d'insertion \n n˚</h2>";
            }
            echo "enregistrement avec succée";
        }
        else
        {echo "Vous êtes DéJA enregistré.";}
    }

    else {echo "Formulaire à compléter!";}
}
?>

<?php


if (isset($_POST["search"])){
    echo "<table>
    <th>nom</th>
    <th>prenom</th>
    <th>email</th>
    <th>adress</th>
    <th>statut</th>";

   $id_email = $_POST["idemail"];
   $sql2 = "SELECT * FROM personne WHERE Email ='$id_email';";
   $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
   $requet2 = mysqli_query($idcom,$sql2);
   while($row = mysqli_fetch_assoc($requet2)) {
       echo "<tr> <td>"
       .$row["Nom"]."</td><td>"
       .$row["Prénom"]."</td> <td>"
       .$row["Email"]."</td> <td>"
       .$row["Adress"]."</td> <td>"
       .$row["Statut"]."</td> </tr>";
   }
   echo "</table>";
}
if (isset($_POST["affichpersonne"])){
    echo "<table>
    <th>nom</th>
    <th>prenom</th>
    <th>email</th>
    <th>adress</th>
    <th>statut</th>";

    $sql3 = "SELECT * FROM personne ;";
   $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
   $requet3 = mysqli_query($idcom,$sql3);
   while($row = mysqli_fetch_assoc($requet3)) {
       echo "<tr> <td>"
       .$row["Nom"]."</td><td>"
       .$row["Prénom"]."</td> <td>"
       .$row["Email"]."</td> <td>"
       .$row["Adress"]."</td> <td>"
       .$row["Statut"]."</td> </tr>";
   }
   echo "</table>";
}

?>
<table>
    <tr>
    <td><a href="home.html"><input type="button" id="" name="home" value=" Home " class="btn"></a></td>
    </tr>
</table>
</body> </html>