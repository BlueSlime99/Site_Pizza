<?php
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");

$title="Order";

$SQL = "SELECT * FROM commandes";
$stmt = $db->prepare($SQL);
$stmt->execute();?>
 
	<table class="table table-hover">
		<thead class="thead-light">
        <tr>
        	<th>Userid</th>
            <th>ref_Of_TheOrder</th>
	         <th>ID_Order</th>
             <th>date</th>
			<th>statut</th>
            <th>Price of the Order</th> 
            </tr>
            </thead>            
        </tr>


			<?php while($donnees = $stmt->fetch()){?>
		<tr> 
			<td> <?php echo htmlspecialchars( $donnees['uid']);?> </td>
			<td> <?php echo htmlspecialchars( $donnees['ref']);?> </td>
			<td> <?php echo htmlspecialchars( $donnees['cid']);?> </td>
			<td> <?php echo htmlspecialchars( $donnees['date']);?> </td>
			<td> <?php echo htmlspecialchars( $donnees['statut']);?> </td>
			<?php if(isset($_SESSION['totalCommande'  . $donnees['cid']]['reference'])){?>
			<td> <?php echo htmlspecialchars($_SESSION['totalCommande'  . $donnees['cid']]['reference']);?> </td>
		<?php } ?>

		 </tr>
	
	
	<?php } ?>
		</table>
<?php include("footer.php"); ?>