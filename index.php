<?php
$titre = "Home";
include 'header.php';

?>
<section id="home1">
    <div class="marge">
        <?php include('slider_home.php'); ?>
    </div>
</section>
<section id="home2">
    <div class="marge">
        <ul id="articles">
            <?
            $listeArticles = "SELECT * FROM shop_products WHERE actif = 1 ORDER BY name ASC LIMIT 8";
            $req_listeArticles = $mysqli->query($listeArticles);
            while($row = $req_listeArticles->fetch_array()) {
                echo "<li>";
                echo "<a id=\"imgproduit\" class=\"imgtop\" href=\"article.php?id_product=".$row["id_product"]."\"><img src='uploads/" . $row["img"] . "' /></a>";
                echo "<div class='texte'>";
                echo "<h2><a href=\"article.php?id_product=".$row["id_product"]."\">" . $row["name"] . "</a></h2>";
                echo "<p>".$row["short_description"]."</p>";
                echo "<span>".$row["prix"]." €</span>";
                echo "<a id=\"bouton_voir\" href=\"article.php?id_product=".$row["id_product"]."\">Voir</a>";
                echo "<a id=\"bouton_add\" href=\"panier.php?action=ajout&amp;l=".$row['name']."&amp;q=1&amp;p=".$row['prix']."\">Ajouter au panier</a>";
                echo "</div>";
                echo "</li>";
            }
            ?>
        </ul>
    </div>
</section>
<?php include 'footer.php'; ?>