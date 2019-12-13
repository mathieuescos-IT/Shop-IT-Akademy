<?php
$titre = "Tous les produits";
include 'header.php';
if(empty($_SESSION["uid"])) {
    echo "<html><script>alert('Veuillez vous connecter pour accéder à cette page.');</script></html>";
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
                <span>Tous les produits</span>
            </li>
        </ol>
    </div>
</div>
<section id="home1">
    <div class="marge">
        <?php include('slider_home.php'); ?>
    </div>
</section>
<section id="home2">
    <div class="marge">
        <ul id="articles">
            <?
            $listeArticles = "SELECT * FROM shop_products WHERE actif = 1 ORDER BY name ASC";
            $req_listeArticles = $mysqli->query($listeArticles);
            while($row = $req_listeArticles->fetch_array()) {
                echo "<li>";
                echo "<a id=\"imgproduit\" class=\"imgtop\" href=\"article.php?id_product=".$row["id_product"]."\"><img src='uploads/" . $row["img"] . "' /></a>";
                echo "<div class='texte'>";
                echo "<h2><a href=\"article.php?id_product=".$row["id_product"]."\">" . $row["name"] . "</a></h2>";
                echo "<p>".$row["short_description"]."</p>";
                echo "<a id=\"bouton_voir\" href=\"article.php?id_product=".$row["id_product"]."\">Voir</a>";
                echo "<a id=\"bouton_add\" href=\"panier.php?action=ajout&amp;l=".$row['name']."&amp;q=1&amp;p=".$row['prix']."\">Ajouter au panier</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</section>
</div>
</body>
</html>
