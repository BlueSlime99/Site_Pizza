
<?php
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");

$title="Order";
$_SESSION['theOrder'] = 0;
$_UID = $idm -> getUid() ;
$SQL = "SELECT cid, ref, rid, date, statut FROM commandes WHERE uid = $_UID" ;

$stmt = $db->prepare($SQL);
$stmt->execute();

?>

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>ref</th>
            <th>rid</th>
             <th>date</th>
			<th>statut</th>
            <th>Price of the Order</th>             
        </tr>
    </thead>
    <tbody>
        <?php while($data = $stmt->fetch()){ ?>
        <tr>
            <td><?php echo htmlspecialchars($data['ref']);?></td>
            <td><?php echo htmlspecialchars($data['rid']);?></td>
            <td><?php echo htmlspecialchars($data['date']);?></td>
            <td><?php echo htmlspecialchars($data['statut']);?></td>
          <td><?php echo htmlspecialchars($_SESSION['totalCommande'  . $data['cid']]['reference']);?></td>    
        
            <?php $_SESSION['theOrder'] = $_SESSION['theOrder'] + $_SESSION['totalCommande'  . $data['cid']]['reference'];?>
        
    <?php }?>
    
        <td><?php echo "Total De la commande: ". $_SESSION['theOrder'];?></td>
     </tr>
     
    </tbody>
</table>

<?php include("footer.php"); ?>