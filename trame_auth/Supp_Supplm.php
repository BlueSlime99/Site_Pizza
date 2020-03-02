<?php

$title="Delete Extra";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("headertest.php");



$SQL = "SELECT nom, prix, sid FROM supplements";
$stmt = $db->prepare($SQL);
$stmt->execute();

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
        <?php while($data = $stmt->fetch()){ ?>
        <tr>
            <td><?php echo  htmlspecialchars($data['nom']);?></td>
            <td><?php echo  htmlspecialchars($data['prix']);?></td>
            <form method="GET" action="Supp_Supplm.php">
            <td><button type="button" data-toggle="modal" data-target="#<?php echo $data['sid']?>"> <span class="glyphicon glyphicon-remove"></span></button></td>
            <?php sup($data['sid'], $data['nom']); ?>
        </form>
        </tr>
    <?php }?>
    </tbody>
</table>
</div>
<?php 


    if(isset($_GET['id'])){
        $_SESSION['sid'] = $_GET['id'];      
        try {
        $SQL = "DELETE FROM supplements WHERE sid=:sid";
        $stmt = $db->prepare($SQL);
        $res = $stmt->execute(array(
            'sid' => $_SESSION['sid']
        ));

        ?>  <meta http-equiv="refresh" content="0;URL=Supp_Supplm.php"> 
        <?php

  
} catch (\PDOException $e) {
    http_response_code(500);
    echo  htmlspecialchars("Erreur de serveur.");
    exit();
}
}
     
include("footer.php");
?>