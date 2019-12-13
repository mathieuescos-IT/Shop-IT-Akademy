<?
$titre = "Recherche";
include("./header.php");
if(!empty($_SESSION["uid"])) {
    if (!isset($_GET["q"])) {
        header("Location:index.php");
        exit;
    }
    $q = $_GET["q"];
}
else{
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
                <span>Recherche "<?php echo $q ?>"</span>
            </li>
        </ol>
    </div>
</div>
<section id="listeUser1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Liste des articles</h2>
            </div>
            <div class="bottom_bloc">
                <table id="listeEntreprisesR" class="table table-bordered table-hover table-striped row-border" width="100%">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nom de l'article</th>
                        <th>Prix</th>
                        <th>Stock</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?
                    $select_product = "SELECT * FROM shop_products WHERE name LIKE '%".$mysqli->real_escape_string($q)."%' AND actif = 1 ORDER BY name ASC";
                    $req_select_product = $mysqli->query($select_product);
                    while($row = $req_select_product->fetch_array()) {
                        echo "<tr>\n";
                        echo "<td><a id=\"imgproduit\" href=\"article.php?id_product=".$row["id_product"]."\"><img src='uploads/".$row["img"]."' /></a></td>\n";
                        echo "<td><a href=\"article.php?id_product=".$row["id_product"]."\">".$row["name"]."</a></td>\n";
                        echo "<td>".$row["prix"]." €</td>\n";
                        echo "<td>".$row["stock"]."</td>\n";

                    }
                    $req_select_product->close();
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ('footer.php'); ?>
