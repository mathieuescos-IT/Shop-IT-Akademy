<?php
$titre = "Modifier l'article";
include("header.php");
if (!isset($_GET["id"]) || !preg_match("/^[0-9]{1,}$/",$_GET["id"])) {
    header("Location:index.php");
    exit;
}
if(!empty($_SESSION['uid'])) {
    if ($_SESSION['lvl'] != 1) {
        echo "<html><script> document.location.href='index.php';</script></html>";
    }
    else {
        $idArticle = $_GET["id"];
        // Récuperation shop_products depuis la table
        $select_produit = "SELECT * FROM shop_products WHERE id_product = '$idArticle'";
        $req_select_produit = $mysqli->query($select_produit);
        $rowA = $req_select_produit->fetch_array();
        $req_select_produit->close();
        if($idArticle != $rowA['id_product']){
            echo "<html><script> document.location.href='index.php';</script></html>";
        }
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
                <span>Modifiler l'article <b>"<?php echo $rowA['name']; ?>"</b></span>
            </li>
        </ol>
    </div>
</div>
<section id="profil1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Modifier mon profil</h2>
                <p>Si vous ne souhaiter pas modifier l'image de l'article, veuillez laisser la case vide.</p>
            </div>
            <div class="bottom_bloc">
                <form data-toggle="validator" enctype="multipart/form-data" role="form" id="modifArticle" action="modifArticle.php?id=<?php echo $idArticle; ?>&modif=article" method="post">
                    <div class="champ">
                        <label for="img">Image : *</label>
                        <input type="file" name="img" class="form_admin" id="img" />
                        <img src="uploads/<?php echo $rowA['img']; ?>" style="width:50px;"/>
                    </div>
                    <div class="champ">
                        <label for="name">Nom de l'article : *</label>
                        <input type="text" name="name" class="form_admin" id="name" value="<?php echo $rowA['name']; ?>" required />
                    </div>
                    <div class="champ">
                        <label for="short_description">Description courte : *</label>
                        <textarea name="short_description" rows=3 COLS=40 class="form_admin" maxlength="150" id="short_description"><?php echo $rowA['short_description']; ?></textarea>
                    </div>
                    <div class="champ">
                        <label for="description">Description : *</label>
                        <textarea name="description" rows=6 COLS=40 class="form_admin" id="description"><?php echo $rowA['description']; ?></textarea>
                    </div>
                    <div class="champ">
                        <label for="prix">Prix <small>(sans €)</small>: *</label>
                        <input type="number" name="prix" class="form_admin" value="<?php echo $rowA['prix']; ?>" id="prix" required />
                    </div>
                    <div class="champ">
                        <label for="stock">Stock disponible : *</label>
                        <input type="number" name="stock" class="form_admin" value="<?php echo $rowA['stock']; ?>" id="stock" required />
                    </div>
                    <div class="champ">
                        <label for="publier">Mettre en ligne ? : *</label>
                        <select name="publier" class="select">
                            <option value="1" selected>Oui</option>
                            <option value="2">Non</option>
                        </select>
                    </div>
                    <div class="champ">
                        <button type="submit" class="submit_admin">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script><? if (isset($_GET["emptyInput"])) echo "alert(\"Un champ ou plusieurs sont incomplets.\");\n"; ?></script>

<?php include 'footer.php'; ?>
