<?php
$titre = "Modifier mon profil";
include("header.php");
if(empty($_SESSION["uid"])) {
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
                <span>Modifiler mon profil</span>
            </li>
        </ol>
    </div>
</div>
<section id="profil1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Modifier mon profil</h2>
                <p>Si vous ne souhaiter pas modifier votre mot de passe, veuillez laisser la case vide.</p>
            </div>
            <div class="bottom_bloc">
                <form data-toggle="validator" enctype="multipart/form-data" role="form" id="creerArticle" action="modifierProfil.php?modif=profil" method="post">
                    <div class="champ">
                        <label for="nom">Nom : *</label>
                        <input type="text" name="nom" class="form_admin" id="nom" value="<?php echo $nom; ?>" required />
                    </div>
                    <div class="champ">
                        <label for="prenom">Prénom : *</label>
                        <input type="text" name="prenom" class="form_admin" id="prenom" value="<?php echo $prenom; ?>" required />
                    </div>
                    <div class="champ">
                        <label for="email">E-mail : *</label>
                        <input type="email" class="form_admin" id="email" value="<?php echo $user_email; ?>" disabled/>
                    </div>
                    <div class="champ">
                        <label for="password">Mot de passe : *</label>
                        <input type="password" name="pwd1" class="form_admin" id="password" />
                    </div>
                    <div class="champ">
                        <label for="password2">Confirmer le mot de passe : *</label>
                        <input type="password" name="pwd2" class="form_admin" id="password2" />
                    </div>
                    <div class="champ">
                        <label for="adresse">Adresse : *</label>
                        <input type="text" name="adresse" class="form_admin" value="<?php echo $adresse; ?>" id="adresse" required />
                    </div>
                    <div class="champ">
                        <label for="cp">Code postal : *</label>
                        <input type="number" name="cp" class="form_admin" value="<?php echo $cp; ?>" id="cp" required />
                    </div>
                    <div class="champ">
                        <label for="ville">Ville : *</label>
                        <input type="text" name="ville" class="form_admin" value="<?php echo $ville; ?>" id="ville" required />
                    </div>
                    <div class="champ">
                        <label for="telephone">Numéro de téléphone : *</label>
                        <input type="text" name="telephone" class="form_admin" value="<?php echo $phone; ?>" id="telephone" required />
                    </div>
                    <div class="champ">
                        <button type="submit" class="submit_admin">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script><? if (isset($_GET["badPwd"])) echo "alert(\"Les deux mot de passes ne sont pas identiques.\");\n"; ?></script>
<script><? if (isset($_GET["emptyInput"])) echo "alert(\"Un champ ou plusieurs sont incomplets.\");\n"; ?></script>

<?php include 'footer.php'; ?>
