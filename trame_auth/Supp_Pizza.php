<?php

$title="Delete Pizza";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("headertest.php");


$SQL = "SELECT nom, prix, rid FROM recettes";
$stmt = $db->prepare($SQL);
$stmt->execute();
//id=<?php echo  htmlspecialchars($data['rid']);

 ?>
<div id="fixed">
<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ 
            ?>
        <tr>
            <td><?php echo  htmlspecialchars($data['nom']);?></td>
            <td><?php echo  htmlspecialchars($data['prix']);?></td>
            <form method="GET" action="Supp_Pizza.php">
            <td><button type="button" data-toggle="modal" data-target="#<?php echo $data['rid']?>"> <span class="glyphicon glyphicon-remove"></span></button></td>
            <?php sup($data['rid'], $data['nom']); ?>
        </form>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>
<?php  


    if(isset($_GET['id'])){
        $_SESSION['rid'] = $_GET['id'];
            
        try {
        $SQL = "DELETE FROM recettes WHERE rid=:rid";
        $stmt = $db->prepare($SQL);
        $res = $stmt->execute(array(
            'rid' => $_SESSION['rid']
        ));
        ?>
        <meta http-equiv="refresh" content="0;URL=Supp_Pizza.php">
        <?php
} catch (\PDOException $e) {
    http_response_code(500);
    echo  htmlspecialchars("Erreur de serveur.");
    exit();
}
}
     
include("footer.php");
?>
<?php include("footer.php"); ?>