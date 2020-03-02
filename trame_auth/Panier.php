<?php

require("auth/EtreAuthentifie.php");

$_SESSION['open'] = 1;
require("header.php");
include_once("fonctions-panier.php");

if(isset($_GET['rid'])){
  $_SESSION['idPizza'] = $_GET['rid'];
}

if(isset($_GET['rid']) && isset($_GET['nom']) && isset($_GET['prix'])){
	ajouterArticle($_GET['nom'],1,$_GET['prix']);
  }


$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if($action !== null)
{
   if(!in_array($action,array('ajout', 'suppression', 'refresh')))
   $erreur=true;

   //récuperation des variables en POST ou GET
   $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
   $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
   $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

   //Suppression des espaces verticaux
   $l = preg_replace('#\v#', '',$l);
   //On verifie que $p soit un float
   $p = floatval($p);

   //On traite $q qui peut etre un entier simple ou un tableau d'entier
    
   if (is_array($q)){
      $QteArticle = array();
      $i=0;
      foreach ($q as $contenu){
         $QteArticle[$i++] = intval($contenu);
      }
   }
   else
   $q = intval($q);
    
}

if (!$erreur){
   switch($action){
      Case "ajout":
         ajouterArticle($l,$q,$p);
         break;

      Case "suppression":
         supprimerArticle($l);
         break;

      Case "refresh" :
         for ($i = 0 ; $i < count($QteArticle) ; $i++)
         {
            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
         }
         break;

      Default:
         break;
   }
}

?>

<table class="table table-hover">
<thead class="thead-light">
<title>Votre panier</title>
   <tr>
            <th>Name</th>
            <th>Price</th>
     

        </tr>
    </thead>
<tbody>


	<?php
  $bool = 0;
	if (creationPanier())
	{
	   $nbArticles=count($_SESSION['panier']['libelleProduit']);
     $i = $nbArticles;
	   if ($nbArticles <= 0)
	   echo "<tr><td>Votre panier est vide </td></tr>";
	   else if($nbArticles>0)
	   {
      $bool++;
	   	$i=0;
	      while ($i < $nbArticles )
	      {?>
	      	<tr>
	      	<td><?php echo htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]);?></td>
          <td><?php echo htmlspecialchars($_SESSION['panier']['prixProduit'][$i]);?></td>        
          <td> <?php  echo "<a href=\"".htmlspecialchars("Panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Delete</a>"?></td>
       		</tr>
			<?php
			 $i++;
       		}

 			?>
        <tr>
	      <td> <?php echo "<tdcolspan=\"2\">";?></td>
	      <td> <?php echo "<td colspan=\"2\">";?></td>
        <td> <?php echo "Total Du Panier : ". MontantGlobal();?> </td>
	      <td> <?php echo "<td colspan=\"4\">";?></td>
        
	     </tr>

	     <?php
	   }
	}
  ?>
 

</tbody>
</table>

</form>

<?php if($bool > 0){ ?> 
  <a href="Ajouter_Supplement_User.php"><button>Next</button></a> 
<?php } ?>


</html>