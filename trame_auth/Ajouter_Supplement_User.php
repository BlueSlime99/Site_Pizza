<?php

$title="Ajouter Supplement Pizza";
require("auth/EtreAuthentifie.php");

include("header.php");
include_once("fonctions-panier.php");




$title="ADD Extra Charge";
$_SESSION['nbSupp']=0;
$SQL = "SELECT nom, prix,sid FROM supplements";
$stmt = $db->prepare($SQL);
$stmt->execute();

?>

<div id="cover">
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ ?>
        <tr>
            <td><?php echo htmlspecialchars($data['nom']);?></td>
            <td><?php echo  htmlspecialchars($data['prix']);?></td>
             <td><a href="Ajouter_Supplement_User.php?idSupplement=<?php echo htmlspecialchars($data['sid']);?>&prixSupplement=<?php echo htmlspecialchars($data['prix']);?>&nomSupplement=<?php echo htmlspecialchars($data['nom']);?>"> <span class="glyphicon glyphicon-plus"></span></a></td>
        </tr>
         <?php 
         $_SESSION['nbSupp']++;
            } ?> 
    </tbody>
</table>

<?php
$i=1;
if(!isset($_GET['idSupplement'])) {
$_SESSION['cmp'] = 0;
while($i < $_SESSION['nbSupp']){
    $_SESSION['supplements'][$_SESSION['supplements'][$i]['nom']] = 0;
    $i++;

}
}else{ 
$_SESSION['cmp']++; }

if(isset($_GET['idSupplement'])){

    $_SESSION['supplements'][$_SESSION['cmp']]['prix'] = $_GET['prixSupplement'];
    $_SESSION['supplements'][$_SESSION['cmp']]['nom'] = $_GET['nomSupplement'];
    $_SESSION['supplements'][$_SESSION['supplements'][$_SESSION['cmp']]['nom']]++;
  
}

?>

<a href="Commande_User.php"> Next</span></a>
</div>