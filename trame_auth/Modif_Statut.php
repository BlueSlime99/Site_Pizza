<?php


$title="Modify Statut";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");


$SQL = "SELECT * FROM commandes";
$stmt = $db->prepare($SQL);
$stmt->execute();

if(!isset($_GET['id'])){ ?>

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>cid</th>
             <th>ref</th>
            <th>rid</th>
             <th>date</th>
            <th>statut</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ ?>
        <tr>
            <td><?php echo htmlspecialchars($data['cid']);?></td>
           <td><?php echo htmlspecialchars($data['ref']);?></td>
            <td><?php echo htmlspecialchars($data['rid']);?></td>
            <td><?php echo htmlspecialchars($data['date']);?></td>
            <td><?php echo htmlspecialchars($data['statut']);?></td>
            <td><a href="Modif_Statut.php?id=<?php echo  htmlspecialchars($data['cid']);?>"> <span class="glyphicon glyphicon-edit"></span></a></td>
        </tr>
    <?php }?>
    </tbody>
</table>


<?php

}else{ 
   // if(isset($_SESSION['rid']))
   
        $_SESSION['cid'] = $_GET['id'];
    ?>
<div id="fixed">
    <table class="table table-hover">
    <thead class="thead-light">
        <tr>
          <th>cid</th>
          <th>ref</th>
            <th>rid</th>
             <th>date</th>
            <th>statut</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ 
            if($data['cid'] == $_SESSION['cid']){ ?>
                <form action="Modif_Statut.php" method="post">
                    <tr>
                      <td><?php echo htmlspecialchars($data['cid']);?></td>
                    <td><?php echo htmlspecialchars($data['ref']);?></td>
                     <td><?php echo htmlspecialchars($data['rid']);?></td>
                     <td><?php echo htmlspecialchars($data['date']);?></td>
                    <td><input type="text" name="statut" value="<?php echo  htmlspecialchars($data['statut'])?>"></td>
                    <input type="hidden" name="cid" value="<?php echo $data['cid']?>">
                    <td><button type="submit" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-ok"></span>DONE
                         </button></td>

                    </tr>
                </form>
            <?php }else{  ?>
                    <tr>
                     <td><?php echo htmlspecialchars($data['cid']);?></td>
                    <td><?php echo htmlspecialchars($data['ref']);?></td>
                     <td><?php echo htmlspecialchars($data['rid']);?></td>
                     <td><?php echo htmlspecialchars($data['date']);?></td>
                     <td><?php echo htmlspecialchars($data['statut']);?></td>
                    </tr>    
                <?php }
            }?>
    </tbody>
</table>
</div>
<?php }

if(isset($_POST['statut'])) {
    
    try {
    $SQL = "UPDATE commandes SET statut=:statut WHERE cid=:cid";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute(array(
        'statut' => $_POST['statut'],
        'cid'=> $_POST['cid']
    ));

     ?> <!-- <meta http-equiv="refresh" content="0;URL=Modif_Statut.php"> -->
        <?php
} catch (\PDOException $e) {
    http_response_code(500);
    echo  htmlspecialchars("Erreur de serveur.");
    exit();
}
}
include("footer.php"); 