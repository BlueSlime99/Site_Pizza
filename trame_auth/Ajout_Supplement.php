<?php

$title="Add Supplement";
require("auth/EtreAuthentifie.php");
$_SESSION['open'] = 1;
include("header.php");

if (empty($_POST['name'])) {
    include('Ajout_Supplement_form.php');
    exit();
}

$error = "";

foreach (['name', 'price'] as $name) {
    if (empty($_POST[$name])) {
        $error .= "La valeur du champs '$name' ne doit pas être vide";
    } else {
        $data[$name] = $_POST[$name];
    }
}


$SQL = "SELECT sid FROM supplements WHERE nom=?";
$stmt = $db->prepare($SQL);
$res = $stmt->execute([$data['name']]);

if ($res && $stmt->fetch()) {
    $error .= "supplement already exist";
}

if (!empty($error)) {
    include('Ajout_Supplement_form.php');
    exit();
}


try {
    $SQL = "INSERT INTO supplements(nom,prix) VALUES (:nom,:prix)";
    $stmt = $db->prepare($SQL);
    $res = $stmt->execute(array(
        'nom' => $data['name'],
        'prix' => $data['price']
    ));
     ?>  <meta http-equiv="refresh" content="0;URL=Ajout_Supplement.php"> 
        <?php
} catch (\PDOException $e) {
    http_response_code(500);
    echo  htmlspecialchars("Erreur de serveur.");
    exit();
}