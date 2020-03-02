
       

<?php

require("auth/EtreAuthentifie.php");
$title = 'Accueil';
//include("header.php");
?>

</body>

<?php

if (!strcmp($idm -> getRole(), "admin")){

		

		redirect("Administrateur.php");
		?>
		
<?php
} else if(!strcmp($idm -> getRole(), "user")){
		
		redirect("Utilisateur.php");
	
}
include("footer.php");
?>

