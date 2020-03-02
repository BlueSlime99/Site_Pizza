<?php


$title="Modify Pizza";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");

?>
 
 <?php   
$SQL = "SELECT nom, prix, rid FROM recettes";
$stmt = $db->prepare($SQL);
$stmt->execute();

if(!isset($_GET['id'])){ ?>

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
            <td><?php echo  htmlspecialchars($data['nom']);?></td>
            <td><?php echo  htmlspecialchars($data['prix']);?></td>
            <td><a href="Modif_Pizza.php?id=<?php echo  htmlspecialchars($data['rid']);?>"> <span class="glyphicon glyphicon-edit"></span></a></td>
        </tr>
    <?php }?>
    </tbody>
</table>


<?php

}else{ 
   // if(isset($_SESSION['rid']))
   
        $_SESSION['rid'] = $_GET['id'];
    ?>

    <table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>Name</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ 
            if($data['rid'] == $_SESSION['rid']){ ?>
                <form action="Modif_Pizza.php" method="post">
                    <tr>
                        <td><input type="text" name="nom" value="<?php echo  htmlspecialchars($data['nom'])?>"></td>
                        <td><input type="text" name="prix" value="<?php echo  htmlspecialchars($data['prix'])?>"></td>
                        <td><button type="submit" class="btn btn-default btn-sm">
                         <span class="glyphicon glyphicon-ok"></span>DONE
                         </button></td>
                    </tr>
                </form>
            <?php }else{  ?>
                    <tr>
                        <td><?php echo  htmlspecialchars($data['nom']);?></td>
                        <td><?php echo  htmlspecialchars($data['prix']);?></td>
                    </tr>    
                <?php }
            }?>
    </tbody>
</table>

<?php }

if (isset($_POST['nom'])) {

    try {
    $SQL = "UPDATE recettes SET nom=:nom , prix=:prix WHERE rid=:rid";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute(array(
        'nom' => $_POST['nom'],
        'prix' => $_POST['prix'],
        'rid' => $_SESSION['rid']
    ));
 ?>  <meta http-equiv="refresh" content="0;URL=Modif_Pizza.php"> 
        <?php
} catch (\PDOException $e) {
    http_response_code(500);
    echo  htmlspecialchars("Erreur de serveur.");
    exit();
}
}
 include("footer.php"); 