<!DOCTYPE html> 
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="indexcss.css"/>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des usagers</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>
<?php
//-----
define("MYHOST","localhost"); 
define("MYUSER","root"); 
define("MYPASS","");
define("NomDb","mybibliothèque");

if(isset($_POST['valid'])){
    
    if(!empty($_POST["adress"]) && !empty($_POST["Auteur"])&& !empty($_POST["titre"])&& !empty($_POST["date_emprunt"])&& !empty($_POST["date_retour"])){
        $adress=$_POST["adress"];
        $titre=$_POST["titre"];
        $Auteur=$_POST["Auteur"];
        $date_emprunt=$_POST["date_emprunt"];
        $date_retour=$_POST["date_retour"];
        
        
        $sql1 = "SELECT * FROM livre WHERE Titre ='$titre' AND Auteurs ='$Auteur';";
        $sql100 = "SELECT * FROM personne WHERE Email ='$adress';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $requet1 = mysqli_query($idcom,$sql1);
        $requet100 = mysqli_query($idcom,$sql100);
        $row1 = mysqli_fetch_assoc($requet1);
        $row2 = mysqli_fetch_assoc($requet100);
        
        if((!isset($row1["Titre"]) && !isset($row1["Auteurs"])) ||(!isset($row2["Email"]))){
            echo "pas de livre avec ces infos oubien pas de personne avec cet email.";
        }
        else{
            $date1 = strtotime($date_emprunt);
            $date2 = strtotime($date_retour);

            $secondsDiff = $date2 - $date1;
            $days = floor($secondsDiff / (60 * 60 * 24));
            if($days <= 30){
                //Requête SQL
                //creer nouveau emprunt
                $sql3="INSERT INTO emprunts (date_emprunt) VALUES('$date_emprunt');";
                //collecter les id
                $sql4="SELECT idEmprunt FROM emprunts WHERE idEmprunt>= ALL(SELECT idEmprunt FROM emprunts);";
                $sql11="SELECT * FROM emprunter,personne WHERE Email='$adress' AND personne.idPersonne=emprunter.idPeronne;";
                $sql5="SELECT idPersonne FROM personne WHERE Email='$adress';";
                $sql6="SELECT idLivre FROM livre WHERE Titre ='$titre' AND Auteurs ='$Auteur';";
                $sql10="SELECT Nbr_exemplaires FROM livre WHERE Titre ='$titre' AND Auteurs ='$Auteur';";
                //var pour se connecter a la base de donnees
                $idcom=@mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
                $requet1 = mysqli_query($idcom,$sql3);
                $idemprunt1=mysqli_query($idcom,$sql4);
                $idPersonne1=mysqli_query($idcom,$sql5);
                $idLivre1=mysqli_query($idcom,$sql6);
                $Nbr_exemplaires1=mysqli_query($idcom,$sql10);
                $MAx_personne1=mysqli_query($idcom,$sql11);

                $idemprunt = mysqli_fetch_assoc($idemprunt1)["idEmprunt"];
                $idPersonne = mysqli_fetch_assoc($idPersonne1)["idPersonne"];
                $idLivre = mysqli_fetch_assoc($idLivre1)["idLivre"];
                $Nbr_exemplaires = mysqli_fetch_assoc($Nbr_exemplaires1)["Nbr_exemplaires"];
                $MAx_emprunt = mysqli_num_rows($MAx_personne1);
                echo "max emprint".$MAx_emprunt;
                if($MAx_emprunt<=5){
                    if(!$requet1 && !$idemprunt1 && !$idPersonne1 && !$idLivre1 ){
                        echo "<h2>Erreur d'insertion et collection id s \n n˚</h2>";
                    }
                    else{
                        if($Nbr_exemplaires<=0)
                            echo "<h2>Pas d'exemplaire. Augmentez-le !!! </h2>";
                        else{
                            if($Nbr_exemplaires<=10){
                                echo "<h2>Attention le nombre des exemplaires est ".$Nbr_exemplaires." . Augmentez-le !!! </h2>";
                            }
                            $Nbr_exemplaires=$Nbr_exemplaires-1;
                            echo "nbr exemplair".$Nbr_exemplaires;
    
                            $sql7="INSERT INTO emprunter (idPeronne,idEmprunt,livres) VALUES('$idPersonne','$idemprunt','$titre');";
                            $sql8="INSERT INTO livre_emprunté (idLivre,idemprunt,date_retour) VALUES('$idLivre','$idemprunt','$date_retour');";
                            $sql9= "UPDATE Livre SET Nbr_exemplaires = '$Nbr_exemplaires' WHERE Titre ='$titre' AND Auteurs ='$Auteur';";
                            
                            $requet2 = mysqli_query($idcom,$sql7);
                            $requet3 = mysqli_query($idcom,$sql8);
                            $requet3 = mysqli_query($idcom,$sql9);
                            if(!$requet2 && !$requet3){
                                echo "<h2>Erreur d'insertion des association \n n˚</h2>";
                            }
                            else {
                                echo "creation avec succée ";
                                echo"Ce personne a emprunter ".$MAx_emprunt." livres!";
                            }
                        }
                    }
                }
                else{
                    echo"Ce personne ne peut pas emprunter plus de 5 livres!";
                }
            }
            else{echo" la date de retour ne doit pas passer plus de 30 jours !";}
        }    
        //creer nouveau associations---
            
    }
    else {echo "Formulaire à compléter!";}
}

if(isset($_POST['valid1'])){
    
    if(!empty($_POST["adressr"]) && !empty($_POST["Auteurr"])&& !empty($_POST["titrer"])){
        $adress=$_POST["adressr"];
        $titre=$_POST["titrer"];
        $Auteur=$_POST["Auteurr"];
        
        
        $sql1 = "SELECT * FROM livre WHERE Titre ='$titre' AND Auteurs ='$Auteur';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $requet1 = mysqli_query($idcom,$sql1);
        $row1 = mysqli_fetch_assoc($requet1);
        
        if(!isset($row1["Titre"]) && !isset($row1["Auteurs"]) ){
            echo "pas de livre avec ces infos.";
        }
        else {
            //Requête SQL
            //collecter les id
            $sql2="SELECT * FROM personne,Livre,emprunts,livre_emprunté,emprunter
                    WHERE personne.idPersonne=emprunter.idPeronne AND emprunter.idEmprunt=emprunts.idEmprunt AND livre_emprunté.idLivre=Livre.idLivre AND livre_emprunté.idemprunt=emprunts.idEmprunt AND personne.Email='$adress' AND Titre ='$titre' AND Auteurs ='$Auteur';";
            

            $idcom=@mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
            $requet1 = mysqli_query($idcom,$sql2);
            
            if(!$requet1){
                echo"ce personne n'a pas emprunter ce livre !";
            }
            else if(isset($row1["Email"])){
                $row = mysqli_fetch_assoc($requet1);
                $idLivre = $row["idLivre"];
                $idEmprunt = $row["idEmprunt"];
                $sql3="SELECT Nbr_exemplaires FROM livre WHERE idLivre ='$idLivre';";
                $requet2 = mysqli_query($idcom,$sql3);
                $Nbr_exemplaires = mysqli_fetch_assoc($requet2)["Nbr_exemplaires"];
                $Nbr_exemplaires = $Nbr_exemplaires +1;
                $sql4= "UPDATE Livre SET Nbr_exemplaires = '$Nbr_exemplaires' WHERE idLivre='$idLivre';";
                $sql5= "UPDATE emprunts SET statut = 'rendu' WHERE idEmprunt=$idEmprunt;";
                $requet2 = mysqli_query($idcom,$sql4);
                $requet3 = mysqli_query($idcom,$sql5);
            }
            else{
                echo"cet livre n'est pas emprunté par cette personne <br>
                ou cet personne n'est pas enregistré";
            }
        }
    }
    else {echo "Formulaire à compléter!";}
}

?>

<table>
    <tr>
    <td><a href="home.html"><input type="button" id="" name="home" value=" Home " class="btn"></a></td>
    </tr>
</table>