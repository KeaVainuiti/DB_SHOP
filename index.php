
<?php
require('connexion_bdd.php'); //connexion au serveur de base de données
include('class/classdbshoop.php');


// instancier OU appeler une class (object)
$dbshoop = new dbshoop();

// =========================
// gestion des boutons
// =========================
if (isset($_POST['btn'])) {
    // si bouton == supprimer
    if ($_POST['btn'] == "Remove") {
        $state = "close";

        // je récupère mon formulaire supprimer
        $id = $_POST['id_book'];

        // j"execute ma requête supprimer dans ma fonction deleteDbShoop
        $res_delete = $dbshoop->deleteDbShoop($id);
        if($res_delete == true) {
            $sucess_delete ='sucess_delete';
        }else{
            $error_delete ='error_delete';
        }
    }

    if ($_POST['btn'] == "Edit") {
        $state = "open";
        $res_edit = $id_click = $_POST['id_book'];
        if($res_edit == true) {
            $sucess_edit ='sucess_edit';
        }else{
            $error_edit ='error_edit';
        }
    }

    if ($_POST['btn'] == "To confirm") {
        $state = "close";
        $new_name = $_POST['new_name'];
        $new_price = $_POST['new_price'];
        $new_quantity_stoks = $_POST['new_quantity_stoks'];
        $new_purchase_date = $_POST['new_purchase_date'];
        $new_publication_date = $_POST['new_publication_date'];
        $id_book = $_POST['id_book'];

        $res_update = $dbshoop->updateDbShoop($new_name, $new_price, $new_quantity_stoks, $new_purchase_date, $new_publication_date, $id_book);
        if($res_update == true) {
            $sucess_update ='sucess_update';
        }else{
            $error_update ='error_update';
        }
    }
    
    if ($_POST['btn'] == "Validate") {

        $state = "close";

        // récupérer les valeurs 
        $name = $_POST['name']; //Variable $nom contient les données de l'input 'nom'

        $price = $_POST['price']; //Variable $nom contient les données de l'input 'prix'

        $quantity_stoks = $_POST['quantity_stoks']; //Variable $nom contient les données de l'input 'quantité de stock0'

        $purchase_date = $_POST['purchase_date']; //Variable $nom contient les données de l'input 'date de publication'
        
        $publication_date = $_POST['publication_date']; //Variable $nom contient les données de l'input 'date de publication'
        
        $res_create = $dbshoop->createDbShoop($name, $price, $quantity_stoks, $purchase_date, $publication_date);
        if($res_create == true) {
            $sucess_create ='sucess_create';
        }else{
            $error_create ='error_create';
        }
    }
}else{
    $state = "close";
}

// j'affiche ma liste
$res_listBooks = $dbshoop->getDbShoop();
if($res_listBooks == true) {
    $sucess_listBooks ='sucess_listBooks';
}else{
    $error_listBooks ='error_listBooks';
}
?>

<html>

    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- CSS -->
        <link href="style.css" rel="stylesheet">

        <title>DB SHOP</title>

    </head>


    <body>

        <div class="row">
            <div class="col-sm-6">

                <?php

                // CONDITIONS \\
                // Afficher la liste des livres
                if(isset($sucess_create)){
                    echo'<div id="sucess_create" style="background-color:green" class="sucess_create">Réussie</div>';
                }
                if(isset($error_create)){
                    echo'<div id="error_create" style="background-color:red" class="error_create">Echec</div>';
                }


                if(isset($sucess_listBooks)){
                    echo'<div id="sucess_listBooks" style="background-color:green" class="sucess_listBooks">Réussie</div>';
                }
                if(isset($error_listBooks)){
                    echo'<div id="error_listBooks" style="background-color:red" class="error_listBooks">Echec</div>';
                }

                if(isset($sucess_delete)){
                    echo'<div id="sucess_delete" style="background-color:green" class="sucess_delete">Mission réussie</div>';
                }
                if(isset($error_delete)){
                    echo'<div id="error_delete" style="background-color:red" class="error_delete">Echec de la mission</div>';
                }

                echo '<label>';
                    echo '<u>';
                        echo '<b>';
                           echo 'LISTE DES LIVRES';
                        echo '</b>';
                    echo '</u>';
                echo '</label>';

                //si $res_listLivres contient au moins une données 
                if ($res_listBooks->num_rows > 0) {
                    //faire ceci
                    echo "<table>";

                        echo "<th>";
                            echo "Name";
                        echo "</th>";

                        echo "<th>";
                            echo "Price";
                        echo "</th>";

                        echo "<th>";
                            echo "Quantity_stocks";
                        echo "</th>";

                        echo "<th>";
                            echo "purchase_date";
                        echo "</th>";

                        echo "<th>";
                            echo "publication_date";
                        echo "</th>";

                        echo "<th>";
                            echo "Actions";
                        echo "</th>";

                    foreach ($res_listBooks as $valeur) { //Boucle : Pour chaque resultat 

                        if (($state == "open") && ($id_click == $valeur['id'])) {

                            echo '<form action="index.php" method="post">';
                                echo "<input type='hidden' name='id_book' value=" . $valeur['id'] . ">";
                                    echo "<tr>";

                                        echo "<td>";
                                            echo "<input type='text' name='new_name' value='" . $valeur['name'] . "'>";
                                        echo "</td>";

                                        echo "<td>";
                                            echo "<input type='text' name='new_price'  value='" . $valeur['price'] . "'>";
                                        echo "</td>";

                                        echo "<td>";
                                            echo "<input type='text' name='new_quantity_stoks' value='" . $valeur['quantity_stoks'] . "'>";
                                        echo "</td>";

                                        echo "<td>";
                                            echo "<input type='text' name='new_purchase_date'  value='" . $valeur['purchase_date'] . "'>";
                                        echo "</td>";

                                        echo "<td>";
                                            echo "<input type='text' name='new_publication_date' value='" . $valeur['publication_date'] . "'>";
                                        echo "</td>";

                                        echo "<td>";
                                            echo "<input type='submit' name='btn' value='To confirm'/>";
                                        echo "</td>";

                                    echo "<tr>";
                            echo '</form>';


                            // -------------------------------------------------------
                        } else {

                            echo "<tr>";

                                echo "<td>";
                                    echo $valeur['name'];
                                echo "</td>";

                                echo "<td>";
                                    echo $valeur['price'];
                                echo "</td>";

                                echo "<td>";
                                    echo $valeur['quantity_stoks'];
                                echo "</td>";

                                echo "<td>";
                                    echo $valeur['purchase_date'];
                                echo "</td>";

                                echo "<td>";
                                    echo $valeur['publication_date'];
                                echo "</td>";

                                echo "<td>";

                                    echo '<form action="index.php" method="post">';

                                        echo "<input type='submit' name='btn' value='Edit'/>";
                                        echo "<input type='hidden' name='id_book' value=" . $valeur['id'] . ">";

                                    echo '</form>';

                                    echo '<form action="index.php" method="post">';

                                        echo "<input type='hidden' name='id_book' value=" . $valeur['id'] . ">";
                                        echo "<input type='submit' name='btn' value='Remove'/>";

                                    echo '</form>';

                                echo "</td>";

                            echo "</tr>";
                            
                        };
                    };

                    echo "</table>";

                } else { //sinon faire cela
                    echo "Il n'y a aucun résultats";
                };

                ?>

            </div>

                    <br>

            <div class="col-sm-6">
                <?php
                    if(isset($sucess_edit)){
                    echo'<div id="sucess_edit" style="background-color:green" class="sucess_edit">Mission réussie</div>';
                    }
                    if(isset($error_edit)){
                        echo'<div id="error_edit" style="background-color:red" class="error_edit">Echec de la mission</div>';
                    }

                    if(isset($sucess_update)){
                        echo'<div id="sucess_update" style="background-color:green" class="sucess_update">Mission réussie</div>';
                    }
                    if(isset($error_update)){
                        echo'<div id="error_update" style="background-color:red" class="error_update">Echec de la mission</div>';
                    }
                    // <!-- CREER UN LIVRE  -->
                    echo '<form  method="POST" action="index.php">';
                       
                        echo '<label>';
                            echo '<u>';
                                echo '<b>';
                                    echo 'CREER UN LIVRES';
                                echo '</b>';
                            echo '</u>';
                        echo '</label>';

                        echo '<u>';
                            echo '<p>';
                                echo 'Ajouter un livre:';
                            echo '</p>';
                        echo '</u>';

                        echo '<p>';
                            echo "<input type='text' name='name' placeholder='Name'>";
                        echo '</p>';

                        echo '<p>';
                            echo "<input type='text' name='price' placeholder='Price'>";
                        echo '</p>';

                        echo '<p>';
                            echo "<input type='text' name='quantity_stoks' placeholder='quantity_stoks'>";
                        echo '</p>';

                        echo '<p>';
                            echo "<input type='text' name='purchase_date' placeholder='purchase_date'>";
                        echo '</p>';

                        echo '<p>';
                            echo "<input type='text' name='publication_date' placeholder='publication_date'>";
                        echo '</p>';

                        echo '<p>';
                            echo "<input type='submit' name='btn' value='Validate'/>";
                        echo '</p>';

                    echo '</form>';

                ?>

            </div>

        </div>
        <script src="jquery.js"></script>
        <script language ="javascript">
            $(document).ready(function(){
                $('.sucess_create').delay(2000).hide('fast');
                $('.error_create').delay(2000).hide('fast');

                $('.sucess_listBooks').delay(4000).hide('fast');
                $('.error_listBooks').delay(4000).hide('fast');

                $('.sucess_edit').delay(6000).hide('fast');
                $('.error_edit').delay(6000).hide('fast');

                $('.sucess_update').delay(6000).hide('fast');
                $('.error_update').delay(6000).hide('fast');

                $('.sucess_delete').delay(8000).hide('fast');
                $('.error_delete').delay(8000).hide('fast');
            })
        </script>

    </body>

</html>