<?php

require("auth/EtreAuthentifie.php");

require("header.php");
include_once("fonctions-panier.php");

$title="Order";

function getRef(){
	$String = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$Ref = '';
	$fin = (strlen($String))-1;
	for($i=0; $i<6; $i++){
		$Ref .= $String[rand(0,$fin)];
	}
	return $Ref;
}




	

$cmp=1;
$prix = 0;
?>

<table class="table table-hover">
	<thead class="thead-light">
		<tr>
			<th>Name</th>
			<th>Price</th>
			<th>Extras</th>
			<th>Quantity Extras</th>

		</tr>
	</thead>
	<tbody>

		<tr>
			<td><?php if(isset (($_SESSION['panier']['libelleProduit'][0])))
				echo htmlspecialchars($_SESSION['panier']['libelleProduit'][0]);?></td>
          	<td><?php if( isset(($_SESSION['panier']['prixProduit'][0])))
          		echo htmlspecialchars($_SESSION['panier']['prixProduit'][0]);?></td> 
          	<?php if($_SESSION['cmp'] != 0){ 
	          		$prix = $_SESSION['supplements'][$cmp]['prix']; ?>
	          		<td><?php echo htmlspecialchars($_SESSION['supplements'][$cmp]['nom']);?> </td>
	          		<td>
				 	<?php echo htmlspecialchars($_SESSION['supplements'][$_SESSION['supplements'][$cmp]['nom']]);
				 	$_SESSION['supplements'][$_SESSION['supplements'][$cmp]['nom']] = 0;
			 		?>
					</td>
	          	<?php } else{ ?>
	          		<td><?php echo "No extra"; ?></td>
	          	<?php }?>
		</tr>
		<?php while(++$cmp <= $_SESSION['cmp']) {
			$prix += $_SESSION['supplements'][$cmp]['prix'];
		
		if($_SESSION['supplements'][$_SESSION['supplements'][$cmp]['nom']] >= 1){ ?>
		<tr>
			<td></td>
			<td></td>
			<td><?php
			 echo htmlspecialchars($_SESSION['supplements'][$cmp]['nom']);?>
			</td>
			<td>
			 	<?php echo htmlspecialchars($_SESSION['supplements'][$_SESSION['supplements'][$cmp]['nom']]);?>
			</td>
			
		</tr>
	<?php 
		$_SESSION['supplements'][$_SESSION['supplements'][$cmp]['nom']] = 0;
	}
		} ?>
		<tr>
				<td></td>
				<td></td>
				<td><?php echo "Total De la commande: ". (float)(MontantGlobal() + $prix);?></td>
			</tr>
		<form method="post" >
			<tr>
				<td><input type="submit" name="sub" value="Submit"></td>
			</tr>
		</form>
		
	</tbody>
</table>

<?php


if(isset($_POST['sub'])){
	$date = date("Y-m-d H:i:s");
	$reference = $_SESSION['reference'] = getRef();
	$SQL = "INSERT INTO commandes(ref, uid, rid, statut, date) values(:ref, :uid, :rid, :statut, :date)";
	$stmt = $db->prepare($SQL);
	$stmt->execute(array(
		'uid' => $idm->getUid(),
		'rid' => $_SESSION['idPizza'],
		'statut' => "Preparation",
		'date' => $date,
		'ref' => $_SESSION['reference']
	));
	while($cmp<=$_SESSION['i']){
		$_SESSION['supplement']['prix' .$cmp] = NULL;
		$_SESSION['supplement'][$cmp] = NULL;

	}
	$cid = $db->lastInsertId();
	$_SESSION['totalCommande' . $cid]['reference'] = (float)(MontantGlobal()+ $prix);
	array_pop($_SESSION['panier']['libelleProduit']);
	?> <meta http-equiv="refresh" content="0;URL=Commande.php"> <?php
}?>
		
</form>


<?php include("footer.php"); ?>