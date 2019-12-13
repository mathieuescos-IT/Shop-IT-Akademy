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
$row = $req_select_produits;
if ($req_select_produits->num_rows == 0) {
    echo "<script>document.location.href=\"index.php\";</script>\n";
    exit;
}
else{
    if(!empty($_SESSION["panier"])) {
        if(in_array($row[0],array_keys($_SESSION["panier"]))) {
            foreach($_SESSION["panier"] as $k => $v) {
                if($row[0] == $k) {
                    if(empty($_SESSION["panier"][$k]["panier"])) {
                        $_SESSION["panier"][$k]["panier"] = 0;
                    }
                    $_SESSION["panier"][$k]["quantite"] += $_POST["quantite"];
                }
            }
        } else {
            $_SESSION["panier"] = array_merge($_SESSION["panier"],$itemArray);
        }
    } else {

    }
}
$req_select_produits->close();
?>

<?php include 'footer.php'; ?>
