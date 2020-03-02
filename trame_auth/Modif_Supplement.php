<?php
$title="Modify Extra";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");


$SQL = "SELECT nom, prix, sid FROM supplements";
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
            <td><a href="Modif_Supplement.php?id=<?php echo $data['sid'];?>"> <span class="glyphicon glyphicon-edit"></span></a></td>
        </tr>
    <?php }?>
    </tbody>
</table>


<?php

}else{ 
    if(isset($_GET['id']))
   
        $_SESSION['sid'] = $_GET['id'];
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
            if($data['sid'] == $_SESSION['sid']){ ?>
                <form action="Modif_Supplement.php" method="post">
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

if (!empty($_POST['nom'])) {
  
    try {
    $SQL = "UPDATE supplements SET nom=:nom , prix=:prix WHERE sid=:sid";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute(array(
        'nom' => $_POST['nom'],
        'prix' => $_POST['prix'],
        'sid' => $_SESSION['sid']
    ));
     ?>  <meta http-equiv="refresh" content="0;URL=Modif_Supplement.php"> 
        <?php
} catch (\PDOException $e) {
    http_response_code(500);
    echo "Erreur de serveur.";
    exit();
}
}
include("footer.php"); 