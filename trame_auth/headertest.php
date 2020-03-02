<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />-->


<title><?= $title??"" ?></title>

    <style>
        .center { text-align: center }
        .center table {margin-left:auto; margin-right:auto;}
        .left {text-align: right}
        .right {text-align: left}
        body {background-color: silver;
            "background-image:url(images/imagesBejaia.jpg);"}

        .error {color: red;}
        
    </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


</head>

<body>
  <?php
  if(($idm -> getRole()) ==NULL ){
  ?>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="Home_Pizza.php">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="Home_Pizza.php">Log -> In</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Informations</a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      Contact -> Us
    </button>
       <div class="dropdown-menu">
      <a class="dropdown-item" href="#">Link 1</a>
    </div>
  </div>
      </li>    
    </ul>
        
  </div>  
</nav>
<br>
<?php
}else if(!strcmp($idm -> getRole(), "admin")){?>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="Home_Pizza.php">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="Administrateur.php">HOME</a>
      </li>
     
       
    </ul>
  </div>  
</nav>
<br>
<?php


}
 if(!strcmp($idm -> getRole(), "user")){?>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="Home_Pizza.php">Menu</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="Liste_de_Pizza_User.php">Carte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Commande.php">Commandes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Supplm_Pizza.php">Supplements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Informations.php">Informations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Contact.php">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Panier.php">Panier</a>
      </li>
      
       
    </ul>
  </div>  
</nav>
<br>
<?php
}


function sup($id, $nom){ ?>

<div id="<?php echo htmlspecialchars($id)?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-xs-center">Suppression</h4>
            </div>
            <div class="modal-body">
              <p>Etes vous sur de vouloir supprimer <?php echo htmlspecialchars($nom)?> ?<p>
            </div>
            <div class="modal-footer">
                <!--<form role="form" method="GET" action="">-->
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id)?>" >
                    <button type="submit" name="sup" class="btn btn-info btn-success">Oui</button>
                    <button type="submit" class="btn btn-info btn-danger" data-dismiss="modal">Non</button>
                <!--</form>-->
            </div>
        </div>
    </div>
</div>

<?php
}
?>
