<?php
// PAGE RESERVER AUX ADMIN
$titre = "Création d'utilisateur";
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
                <span>Ajouter un utilisateur</span>
            </li>
        </ol>
    </div>
</div>
<section id="user1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Ajouter un utilisateur</h2>
                <a href="listeUtilisateurs.php" id="bouton_liste">Liste des utilisateurs</a>
            </div>
            <div class="bottom_bloc">
                <form data-toggle="validator" role="form" id="creationUtilisateur" action="creerUtilisateur.php?create=utilisateur" method="post">
                    <div class="champ">
                        <label for="nom">Nom : *</label>
                        <input type="text" name="nom" class="form_admin" id="nom" required />
                    </div>
                    <div class="champ">
                        <label for="prenom">Prénom* : </label>
                        <input type="text" name="prenom" class="form_admin" id="prenom" required />
                    </div>
                    <div class="champ">
                        <label for="email">E-mail : *</label>
                        <input type="email" name="email" class="form_admin" id="email" required />
                    </div>
                    <div class="champ">
                        <label for="password">Mot de passe : *</label>
                        <input type="password" name="pwd1" class="form_admin" id="password" required />
                    </div>
                    <div class="champ">
                        <label for="password2">Confirmer le mot de passe : *</label>
                        <input type="password" name="pwd2" class="form_admin" id="password2" required />
                    </div>
                    <div class="champ">
                        <label for="nom">Rôle : *</label>
                        <select name="lvl" class="select">
                            <option value="2" selected>Membre</option>
                            <option value="1">Administrateur</option>
                        </select>
                    </div>
                    <div class="champ">
                        <label for="adresse">Adresse : *</label>
                        <input type="text" name="adresse" class="form_admin" id="adresse" required />
                    </div>
                    <div class="champ">
                        <label for="cp">Code postal : *</label>
                        <input type="number" name="cp" class="form_admin" id="cp" required />
                    </div>
                    <div class="champ">
                        <label for="ville">Ville : *</label>
                        <input type="text" name="ville" class="form_admin" id="ville" required />
                    </div>
                    <div class="champ">
                        <label for="telephone">Numéro de téléphone : *</label>
                        <input type="number" name="telephone" class="form_admin" id="telephone" required />
                    </div>
                    <div class="champ">
                        <button type="submit" class="submit_admin">Créer</button>
                    </div>
                </form>
<script><? if (isset($_GET["badEmail"])) echo "alert(\"L'email existe déjà.\");\n"; ?></script>
<script><? if (isset($_GET["badPwd"])) echo "alert(\"Les deux mot de passes ne sont pas identiques.\");\n"; ?></script>
<script><? if (isset($_GET["emptyInput"])) echo "alert(\"Un champ ou plusieurs sont incomplets.\");\n"; ?></script>
