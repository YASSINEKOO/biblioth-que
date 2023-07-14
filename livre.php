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
    <h1>Livre page</h1>
    <hr>

<?php

define("MYHOST","localhost"); 
define("MYUSER","root"); 
define("MYPASS","");
define("NomDb","mybibliothèque");  
if(isset($_POST['addbook'])){
    
    if(!empty($_POST["titre"]) && !empty($_POST["Auteur"])&& !empty($_POST["M_edition"])&& !empty($_POST["Nbr_page"])&& !empty($_POST["Nbr_exemplaires"])){
        $titre=$_POST["titre"];
        $auteur=$_POST["Auteur"];
        $M_edition=$_POST["M_edition"];
        $N_page=$_POST["Nbr_page"];
        $N_exemplaire=$_POST["Nbr_exemplaires"];
        
        $sql1 = "SELECT * FROM livre WHERE Titre ='$titre';";
        $sql2 = "SELECT * FROM livre WHERE Nbr_pages ='$N_page';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $requet1 = mysqli_query($idcom,$sql1);
        $requet2 = mysqli_query($idcom,$sql2);

        $row1 = mysqli_fetch_assoc($requet1);
        $row2 = mysqli_fetch_assoc($requet2);

        
        if(!isset($row1["Titre"]) && !isset($row2["Nbr_pages"]) ){
            //Requête SQL
            $requete="INSERT INTO livre (Titre,Auteurs,Maison_edition,Nbr_pages,Nbr_exemplaires) VALUES('$titre','$auteur','$M_edition','$N_page','$N_exemplaire');";
            //var pour se connecter a la base de donnees
            $idcom=@mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
            $result=mysqli_query($idcom,$requete);
            if(!$result)
            {
                echo "<h2>Erreur d'insertion \n n˚</h2>";
            }
            else echo "ajouté avec succée !";
        }
        else
        {echo "Vous êtes DéJA enregistré.";}
    }

    else {echo "Formulaire à compléter!";}
}
?>

<?php


if (isset($_POST["searchbook"])){
    echo "<table>
    <th>Titre</th>
    <th>Auteurs</th>
    <th>Maison_edition</th>
    <th>Nbr_pages</th>
    <th>Nbr_exemplaires</th>";

   $idbook = $_POST["idbook"];
   $sql3 = "SELECT * FROM Livre WHERE Titre ='$idbook';";
   $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
   $requet3 = mysqli_query($idcom,$sql3);
   $row = mysqli_fetch_assoc($requet3);
   if (!isset($row)){
    echo "Désolé! pas de livre avec ce titre :(";
   }
   else{
   while($row = mysqli_fetch_assoc($requet3)) {
       echo "<tr> <td>"
       .$row["titre"]."</td><td>"
       .$row["Auteurs"]."</td> <td>"
       .$row["Maison_edition"]."</td> <td>"
       .$row["Nbr_pages"]."</td> <td>"
       .$row["Nbr_exemplaires"]."</td> </tr>";
   }
   echo "</table>";
}
}
if (isset($_POST["affichbook"])){
    echo "<table>
    <th>Titre</th>
    <th>Auteurs</th>
    <th>Maison_edition</th>
    <th>Nbr_pages</th>
    <th>Nbr_exemplaires</th>";

    $sql4 = "SELECT * FROM Livre ;";
   $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
   $requet4 = mysqli_query($idcom,$sql4);
   while($row = mysqli_fetch_assoc($requet4)) {
       echo "<tr> <td>"
       .$row["Titre"]."</td><td>"
       .$row["Auteurs"]."</td> <td>"
       .$row["Maison_edition"]."</td> <td>"
       .$row["Nbr_pages"]."</td> <td>"
       .$row["Nbr_exemplaires"]."</td> </tr>";
   }
   echo "</table>";
}

?>
<?php

if(isset($_POST["modi-book"])){
    if (!empty($_POST["idmodi-book"])) {
        # code...(^_^)
        $titro=$_POST["idmodi-book"];
        $sql5 = "SELECT * FROM Livre WHERE TITRE='$titro';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $requet5 = mysqli_query($idcom,$sql5);
        if(!$requet5){
            echo"Désolé! pas de livre avec ce titre :(";
        }
        else{
            $row = mysqli_fetch_assoc($requet5);
            if(isset($row["Titre"])){

                echo '<table>';
                echo '<tr><td><label for="titre">Titre :</label></td>';
                echo '<td><input type="text" id="titre" name="modititro" value="' . $row['Titre'] . '" class="field"></td>';
                echo '<td><input type="submit" name="mod_titre" value=" Modifier " class="btn"></td></tr><br>';

                echo '<tr><td><label for="Auteur">Auteur : </label></td>';
                echo '<td><input type="text" id="Auteur" name="modi_Auteur" value="' . $row['Auteurs'] . '" class="field"></td>';
                echo '<td><input type="submit" name="mod_auteur" value=" Modifier " class="btn"></td></tr><br>';

                echo '<tr><td><label for="M_edition">Maison d\'édition : </label></td>';
                echo '<td><input type="text" id="M_edition" class="field" name="modi_maison_edition" value="' . $row['Maison_edition'] . '"></td>';
                echo '<td><input type="submit" name="mod_maison_edition" value=" Modifier " class="btn"></td></tr><br>';

                echo '<tr><td><label for="Nbr_pages">Nombre des Pages :</label></td>';
                echo '<td><input type="text" id="Nbr_pages" name="modi_nbr_page" value="' . $row['Nbr_pages'] . '" class="field"></td>';
                echo '<td><input type="submit" name="mod_nbr_page" value=" Modifier " class="btn"></td></tr><br>';

                echo '<tr><td><label for="Nbr_exemplaires">Nombre d\'exemplaires :</label></td>';
                echo '<td><input type="text" id="Nbr_exemplaires" class="field" name="modi_nbr_exemplaires" value="' . $row['Nbr_exemplaires'] . '"></td>';
                echo '<td><input type="submit" name="mod_nbr_exemplaires" value=" Modifier " class="btn"></td></tr><br>';

                echo '<tr><td><input type="submit" id="deletbook" name="deletbook" value="supprimer" class="btn"></td></tr><br>';
                echo'</table>';
                if(isset($_POST["mod_titre"])){
                    if(!empty($_POST["modititro"])){
                        if($_POST["modititro"]<>$row['TITRE']){
                            $new_mod_titre=$_POST["modititro"];
                            $old_titre=$row['TITRE'];
                            $sql6="UPDATE Livre SET TITRE='$new_mod_titre' WHERE TITRE='$old_titre';";
                            $result1=mysqli_query($idcom,$sql6);
                            if(!$result1){
                                echo "modification titre failed";
                            }
                            else    echo" modification titre work";
                        }
                    }
                    else    echo "le champ de titre est vide ,remplirez !";
                }

                if(isset($_POST["mod_auteur"])){
                    if(!empty($_POST["modi_Auteur"])){
                        if($_POST["modi_Auteur"]<>$row['Auteurs']){
                            $new_mod_auteur=$_POST["modi_Auteur"];
                            $old_auteur=$row['Auteurs'];
                            $sql7="UPDATE Livre SET TITRE='$new_mod_auteur' WHERE TITRE='$old_auteur';";
                            $result2=mysqli_query($idcom,$sql6);
                            if(!$result1){
                                echo "modification auteur failed";
                            }
                            else    echo" modification auteur work";
                        }
                    }
                    else    echo "le champ d'auteur est vide, remplissez-le !";
                }

                if(isset($_POST["mod_maison_edition"])){
                    if(!empty($_POST["modi_maison_edition"])){
                        if($_POST["modi_maison_edition"]<>$row['MAISON_EDITION']){
                            $new_mod_maison_edition=$_POST["modi_maison_edition"];
                            $old_maison_edition=$row['MAISON_EDITION'];
                            $sql8="UPDATE Livre SET MAISON_EDITION='$new_mod_maison_edition' WHERE MAISON_EDITION='$old_maison_edition';";
                            $result3=mysqli_query($idcom,$sql8);
                            if(!$result3){
                                echo "modification maison d'édition failed";
                            }
                            else    echo" modification maison d'édition work";
                        }
                    }
                    else    echo "le champ de maison d'édition est vide, remplissez-le !";
                }
                
                if(isset($_POST["mod_nbr_page"])){
                    if(!empty($_POST["modi_nbr_page"])){
                        if($_POST["modi_nbr_page"]<>$row['Nbr_pages']){
                            $new_mod_nbr_page=$_POST["modi_nbr_page"];
                            $old_nbr_page=$row['Nbr_pages'];
                            $sql9="UPDATE Livre SET Nbr_pages='$new_mod_nbr_page' WHERE Nbr_pages='$old_nbr_page';";
                            $result4=mysqli_query($idcom,$sql9);
                            if(!$result4){
                                echo "modification nombre de pages failed";
                            }
                            else    echo" modification nombre de pages work";
                        }
                    }
                    else    echo "le champ de nombre de pages est vide, remplissez-le !";
                }
                
                if(isset($_POST["mod_nbr_exemplaires"])){
                    if(!empty($_POST["modi_nbr_exemplaires"])){
                        if($_POST["modi_nbr_exemplaires"]<>$row['Nbr_exemplaires']){
                            $new_mod_nbr_exemplaires=$_POST["modi_nbr_exemplaires"];
                            $old_nbr_exemplaires=$row['Nbr_exemplaires'];
                            $sql10="UPDATE Livre SET Nbr_pages='$new_mod_nbr_page' WHERE Nbr_pages='$old_nbr_page';";
                            $result5=mysqli_query($idcom,$sql10);
                            if(!$result5){
                                echo "modification nombre de pages failed";
                            }
                            else    echo" modification nombre de pages work";
                        }
                    }
                    else    echo "le champ de nombre de pages est vide, remplissez-le !";
                }
            }else{
                echo"Désolé! pas de livre avec ce titre :( ";
            }
        }
    }
    else echo "le champ de recherche sur livre est vide, remplissez-le !";
}

if(isset($_POST["deletbook"])){
    if(!empty($_POST["idmodi-book"])){

        $book_id = $_POST["idmodi-book"];
        $sql11="DELETE FROM Livre WHERE TITRE='$book_id';";
        $idcom = @mysqli_connect(MYHOST,MYUSER,MYPASS,NomDb);
        $result = mysqli_query($idcom, $sql11);
        if(!$result){
            echo "Erreur de suppression du livre.";
            }
            else {echo "Le livre est supprimé.";}
    }
    else    echo "le champ de titre est vide ,remplirez !";
}


?>
<table>
    <tr>
    <td><a href="home.html"><input type="button" id="" name="home" value=" Home " class="btn"></a></td>
    </tr>
</table>
</body> </html>