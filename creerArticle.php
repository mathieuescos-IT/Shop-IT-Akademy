<?php
// PAGE RESERVER AUX ADMINS
$titre = "Création d'article";
include("header.php");
if(!empty($_SESSION['uid'])) {
    if ($_SESSION['lvl'] != 1) {
        echo "<html><script> alert('Vous ne pouvez pas consulter cette page.');</script></html>";
        echo "<html><script> document.location.href='index.php';</script></html>";
    }
}else{
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
                <span>Ajouter un article</span>
            </li>
        </ol>
    </div>
</div>
<section id="article1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Ajouter un article</h2>
                <a href="listeArticles.php" id="bouton_liste">Liste des articles</a>
            </div>
            <div class="bottom_bloc">
                <form data-toggle="validator" enctype="multipart/form-data" role="form" id="creerArticle" action="creerArticle.php?create=article" method="post">
                    <div class="champ">
                        <label for="img">Image de l'article : *</label>
                        <input type="file" name="img_article" class="form_img_admin" id="img" required />
                    </div>
                    <div class="champ">
                        <label for="nom_article">Nom de l'article : *</label>
                        <input type="text" name="nom_article" class="form_admin" id="nom_article" required />
                    </div>
                    <div class="champ">
                        <label for="short_description">Description courte : *</label>
                        <textarea name="short_description" rows=3 COLS=40 class="form_admin"  id="short_description" maxlength="150"></textarea>
                    </div>
                    <div class="champ">
                        <label for="description">Description : *</label>
                        <textarea name="description" rows=6 COLS=40 class="form_admin"  id="description"></textarea>
                    </div>
                    <div class="champ">
                        <label for="prix">Prix <small>(sans €)</small>: *</label>
                        <input type="number" name="prix" class="form_admin" id="prix" required />
                    </div>
                    <div class="champ">
                        <label for="stock">Stock disponible : *</label>
                        <input type="number" name="stock" class="form_admin"  id="stock" required />
                    </div>
                    <div class="champ">
                        <label for="publier">Mettre en ligne ? : *</label>
                        <select name="publier" class="select">
                            <option value="1" selected>Oui</option>
                            <option value="2">Non</option>
                        </select>
                    </div>
                    <div class="champ">
                        <button type="submit" class="submit_admin" > Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script><? if (isset($_GET["emptyInput"])) echo "alert(\"Un champ ou plusieurs sont incomplets.\");\n"; ?></script>

<?php include 'footer.php'; ?>