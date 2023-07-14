<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocumentPHP</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>
    <h1 style="text-align: center;">consultation des emprunts</h1>
    <hr>
<div>
    <table class="key">
        <tr>
            <td class='green'>exemplaire emprunté</td>
            <td class='yellow'>exemplaire rendu</td>
            <td class='red'>exemplaire pérdu</td>
        </tr>
    </table>
</div>

<?php

define("MYHOST","localhost"); 
define("MYUSER","root"); 
define("MYPASS","");
define("NomDb","mybibliothèque"); 

if (isset($_POST["history"])){
    echo "<table>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Email</th>
    <th>Titre</th>
    <th>Auteurs</th>
    <th>date_emprunt</th>
    <th>date_retour</th>
    <th>Statut</th>";

    $sql = "SELECT *
            FROM personne,Livre,emprunts,livre_emprunté,emprunter 
            WHERE personne.idPersonne=emprunter.idPeronne AND emprunter.idEmprunt=emprunts.idEmprunt AND livre_emprunté.idLivre=Livre.idLivre AND livre_emprunté.idemprunt=emprunts.idEmprunt
            ORDER BY emprunts.date_emprunt,livre_emprunté.date_retour,personne.Nom;";
    $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
    $requet = mysqli_query($idcom,$sql);
    $row = mysqli_fetch_assoc($requet);
    $today = date('Y-m-d');
    $today = strtotime($today);

    
   while($row = mysqli_fetch_assoc($requet)) {
        
        $dateret = strtotime($row["date_retour"]);
        $statut = $row["statut"];
        $secondsDiff1 = $today - $dateret;
        $days = floor($secondsDiff1 / (60 * 60 * 24));
        if (($statut == 'emprunté') && ($days <= 0)){
            echo "<tr class='green'> <td>"
            .$row["Nom"]."</td><td>"
            .$row["Prénom"]."</td><td>"
            .$row["Email"]."</td><td>"
            .$row["Titre"]."</td> <td>"
            .$row["Auteurs"]."</td> <td>"
            .$row["date_emprunt"]."</td> <td>"
            .$row["date_retour"]."</td> <td>"
            .$row["statut"]."</td> </tr>";
        }
        else if ($statut == 'rendu'){
            echo "<tr class='yellow'> <td>"
            .$row["Nom"]."</td><td>"
            .$row["Prénom"]."</td><td>"
            .$row["Email"]."</td><td>"
            .$row["Titre"]."</td> <td>"
            .$row["Auteurs"]."</td> <td>"
            .$row["date_emprunt"]."</td> <td>"
            .$row["date_retour"]."</td> <td>"
            .$row["statut"]."</td> </tr>";
        }
        else{
            echo "<tr class='red'> <td>"
            .$row["Nom"]."</td><td>"
            .$row["Prénom"]."</td><td>"
            .$row["Email"]."</td><td>"
            .$row["Titre"]."</td> <td>"
            .$row["Auteurs"]."</td> <td>"
            .$row["date_emprunt"]."</td> <td>"
            .$row["date_retour"]."</td> <td>"
            .$row["statut"]."</td> </tr>";
        }
       
   }
   echo "</table>";
}

?>
<style>
    body{
        background-color:#b0c4bc;
    }
    .key{
        position: relative;
        margin: 2% 25%;
        width:50%;
    }
    .yellow {
        color :black;
        background-color: #fff67b;
    }
    .green{
        color :black;
        background-color: #9fff82;
    }
    .red{
        color :black;
        background-color: #ff6560;
    }
    table {
	margin: 2% 0;
	width: 100%;
	border-collapse: collapse;
    }

    table td {
        padding: 2%;
        border: 1px solid rgb(173, 172, 172);
    }
</style>
<br>
<table>
            <tr>
            <td><a href="home.html"><input type="button" id="" name="home" value=" Home " class="btn"></a></td>
            </tr>
</table>
</body>