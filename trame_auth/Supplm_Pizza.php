<?php
require("auth/EtreAuthentifie.php");

$_SESSION['open'] = 1;
include("header.php");


$title="Extra";
$SQL = "SELECT nom, prix, sid FROM supplements";
$stmt = $db->prepare($SQL);
$stmt->execute();
?>
 
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
        </tr>
    <?php }?>
    </tbody>
</table>
<?php include("footer.php"); ?>