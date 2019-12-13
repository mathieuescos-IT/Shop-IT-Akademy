<?php
// PAGE RESERVER AUX ADMINS
$titre = "Mes commandes passées";
include("header.php");
if(empty($_SESSION['uid'])) {
    echo "<html><script> document.location.href='index.php';</script></html>";
}
?>
<div class="marge">
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="./home.php">Home</a>
            </li>
            /
            <li class="breadcrumb-item active" aria-current="page">
                <span>Liste des commandes</span>
            </li>
        </ol>
    </div>
</div>
<section id="listeCommandes1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Liste des commandes</h2>
            </div>
            <div class="bottom_bloc">
                <table id="listeCommandes" class="table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Titre</th>
                        <th>Nom</th>
                        <th>Date d'achat</th>
                        <th>Statut</th>
                        <th>Archiver</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $uid = $_SESSION['uid'];
                    $listeOrders = "SELECT * FROM shop_orders WHERE id_utilisateur = '$uid' ORDER BY date_commande ASC";
                    $req_listeOrders = $mysqli->query($listeOrders);
                    while($row = $req_listeOrders->fetch_array()) {
                        $dateFR = dateUS2FR($row["date"]);
                        echo "<tr>\n";
                        echo "<td><a id=\"imgproduit\" href=\"article.php?id_product=".$row["id_product"]."\"><img src='" . $row["img"] . "' /></a></td>\n";
                        echo "<td><a href=\"article.php?id_product=".$row["id_product"]."\">" . $row["name"] . "</a></td>\n";
                        echo "<td>$dateFR</td>\n";
                        if ($row["actif"] == 1) echo "<td><b style=\"color:#42db75;\"><span style=\"color:#8760fb;\" >ACTIF</span></b></td>\n";
                        else echo "<td><b style=\"color:#cd3131;\"><span style=\"color:#b80000;\">DESACTIVER</a></b></td>\n";
                        if ($row["actif"] == 1) echo "<td><a href=\"listeArticles.php?disableArticle=$row[id_product]\" class=\"btn btn-warning\"><i class=\"fa icon-ban-circle\"></i>Désactiver</a></td>";
                        else echo "<td><a href=\"listeArticles.php?activateArticle=$row[id_product]\" class=\"btn btn-warning\"><i class=\"fa icon-check\"></i>Activer</a>";
                        echo " <td><a href=\"listeArticles.php?deleteArticle=$row[id_product]\" class=\"btn btn-danger\"><i class=\"fa icon-trash\"></i>&nbsp;&nbsp;Supprimer</a></td>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ('footer.php'); ?>
