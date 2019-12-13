<?php
$titre = "Produit";
include("./header.php");

if (!isset($_GET["id_product"]) || !preg_match("/^[0-9]{1,}$/",$_GET["id_product"])) {
    header("Location:index.php");
    exit;
}
$idProduit = $_GET["id_product"];
$select_produits = "SELECT * FROM shop_products WHERE id_product = '$idProduit' AND actif = 1";
$req_select_produits = $mysqli->query($select_produits);
if ($req_select_produits->num_rows == 0) {
    echo "<script>document.location.href=\"index.php\";</script>\n";
    exit;
}
$row = $req_select_produits->fetch_array();
$req_select_produits->close();
?>
<div class="marge">
    <div class="page-header">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="./home.php">Home</a>
            </li>
            /
            <li class="breadcrumb-item active" aria-current="page">
                <span>Article "<?php echo $row["name"]; ?>"</span>
            </li>
        </ol>
    </div>
</div>
<section id="article1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2><a href="allProducts.php">Article</a> > <b><?php echo $row["name"]; ?></b></h2>
            </div>
            <div class="bottom_bloc">
                <div class="img_gauche">
                    <img src="uploads/<?php echo $row["img"]; ?>" />
                </div>
                <div class="txt_droite">
                    <h1><?php echo $row["name"]; ?></h1>
                    <p><?php echo $row["description"]; ?></p>
                    <span>Prix TTC : <?php echo $row["prix"]; ?> €</span>
                    <span class="stock">Stock : <?php echo $row["stock"]; ?></span>
                    <a id="bouton_add" href="panier.php?action=ajout&amp;l=<?= $row['name']; ?>&amp;q=1&amp;p=<?= $row['prix']; ?> ">Ajouter au panier</a>
                </div>
<?php include 'footer.php'; ?>
