<?php
// PAGE RESERVER AUX ADMINS
$titre = "Liste des articles";
include("header.php");
if(!empty($_SESSION['uid'])) {
    if ($_SESSION['lvl'] != 1) {
        echo "<html><script> alert('Vous ne pouvez pas consulter cette page.');</script></html>";
        echo "<html><script> document.location.href='index.php';</script></html>";
    }
}
else{
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
                <span>Liste des articles</span>
            </li>
        </ol>
    </div>
</div>
<section id="listeArticles1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Liste des articles</h2>
                <a href="creerArticle.php" id="bouton_liste">Ajouter un article</a>
            </div>
            <div class="bottom_bloc">
                <table id="listeArticle" class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Date de mise en ligne</th>
                            <th>Actif</th>
                            <th>Modifier</th>
                            <th>Activer / Désactiver</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $listeArticles = "SELECT * FROM shop_products ORDER BY name ASC";
                        $req_listeArticles = $mysqli->query($listeArticles);
                        while($row = $req_listeArticles->fetch_array()) {
                            $dateFR = dateUS2FR($row["date"]);
                            echo "<tr>\n";
                            echo "<td><a id=\"imgproduit\" href=\"article.php?id_product=".$row["id_product"]."\"><img src='uploads/" . $row["img"] . "' /></a></td>\n";
                            echo "<td><a href=\"article.php?id_product=".$row["id_product"]."\">" . $row["name"] . "</a></td>\n";
                            echo "<td>$dateFR</td>\n";
                            if ($row["actif"] == 1) echo "<td><b style=\"color:#42db75;\"><span style=\"color:#8760fb;\" >ACTIF</span></b></td>\n";
                            else echo "<td><b style=\"color:#cd3131;\"><span style=\"color:#b80000;\">DESACTIVER</a></b></td>\n";
                            echo "<td><a href=\"modifArticle.php?id=$row[id_product]\" class='desactiver'>Modifier</a>";
                            if ($row["actif"] == 1) echo "<td><a href=\"listeArticles.php?disableArticle=$row[id_product]\" class='desactiver'>Désactiver</a></td>";
                            else echo "<td><a href=\"listeArticles.php?activateArticle=$row[id_product]\" class='desactiver'>Activer</a>";
                            echo " <td><a href=\"listeArticles.php?deleteArticle=$row[id_product]\" class='desactiver'>Supprimer</a></td>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ('footer.php'); ?>
