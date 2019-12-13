<?php
// Fichier config
require("includes/config.php");
// Vérification login
if(empty($_SESSION['uid'])) {
    if (isset($_POST["login"]) && isset($_POST["mdp"])) {
        if (login($_POST["login"], $_POST["mdp"], $mysqli) == "ok") {
            $uid = $_SESSION["uid"];
        } else {
            echo "<html><head><script>document.location.href=\"index.php?badlogin=1\";</script></head><body></body></html>\n";
            exit;
        }
    }
}
if(!empty($_SESSION['uid'])) {
    // Récuperation user depuis la table
    $uid = $_SESSION["uid"];
    $select_user = "SELECT nom, prenom, email, adresse, cp, ville, telephone FROM shop_utilisateurs WHERE uid = '$uid'";
    $req_select_user = $mysqli->query($select_user);
    $row_select_user = $req_select_user->fetch_array();

    $nom = $row_select_user["nom"];
    $prenom = $row_select_user["prenom"];
    $user_email = $row_select_user["email"];
    $adresse = $row_select_user["adresse"];
    $cp = $row_select_user["cp"];
    $ville = $row_select_user["ville"];
    $phone = $row_select_user["telephone"];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- META -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <!-- LINK -->
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="./css/style.css" type='text/css' media='all' />
    <link rel="stylesheet" href="./css/responsive.css" type='text/css' media='all' />
    

    <!-- SCRIPT -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <title><?php echo $titre ?> - Shop IT Akademy</title>

</head>
<body>
<header>
    <div class="marge">
    <script>
		$(document).ready(function(){
			$("#btnmenu").click(function(){
				$("#btnmenu").toggleClass("open");
				$("#menumobile").toggleClass("show");
			});
		});
	</script>
    <div id="btnmenu" class="tooltips" data-original-title="" title=""></div>
    <div id="menumobile" class="">
        <ul id="menunav">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="./derniers-arrivages.php">Derniers arrivages</a>
            </li>
            <li>
                <a href="./allProducts.php">Tous les produits</a>
            </li>
        </ul>
    </div>
        <a href="./index.php" id="logoheader">Shop - IT Akademy</a>
        <div class="menu_header" id="header">
            <ul id="menu">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="./derniers-arrivages.php">Derniers arrivages</a>
                </li>
                <li>
                    <a href="./allProducts.php">Tous les produits</a>
                </li>
            </ul>
        </div>
        <div class="form_recherche">
            <form action="recherche.php" method="get">
                <div class="formulaire">
                    <input name="q" class="formulaire_rechercher" value="" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="form" type="text" placeholder="Recherche…">
                    <input type="submit" class="bouton_rechercher" />
                </div>

            </form>
        </div>
        <div class="panier">
            <a href="panier.php" id="panier" rel="nofollow">
                <span id="item_panier"><?php 
                if(!isset($_SESSION['panier']['libelleProduit']))
                    echo "0";
                else
                    echo count($_SESSION['panier']['libelleProduit']); ?></span>
            </a>
        </div>
        <script>
            $(document).ready(function(){
                $("#btnpanel").click(function(){
                    $("#btnpanel").toggleClass("open");
                    $("#panel").toggleClass("show");
                });
            });
        </script>
        <?php
        if(!empty($_SESSION["uid"])) {  ?>
        <div class="connexion">
            <a  id="btnpanel" class="panel-user">
            <div class="avatar">
                <img src="img/profil-1.png">
            </div>
            <?php echo $prenom . ' ' . $nom; ?>
        </a>
        <section id="panel" class="dropdown-menu extended logout">
            <div class="log-arrow-up"></div>
            <div class="panel_header">
                <span>Panel <?php if($_SESSION["lvl"] == 1) { echo"administrateur"; } else { echo "utilisateur"; }?></span>
            </div>
            <div class="avatar2">
                <img src="img/profil-1.png">
            </div>
            <div class="user">
                <li class="username"><?php echo ''.$prenom.' '.$nom.''; ?></li>
                <li>Adresse IP : <b><?php echo $_SESSION['IP']; ?></b></li>
            </div>
            <div class="panel_lvl">
                <li><a href="modifierProfil.php" class="profil" >Modifier mon profil</a></li>
                <li><a href="historiqueCommande.php">Historique de commandes</a></li>

                <?php if($_SESSION["lvl"] == 1) { ?>
                    <li><a href="creerArticle.php">Créer un article</a></li>
                    <li><a href="listeArticles.php">Liste des articles</a></li>
                    <li><a href="creerUtilisateur.php">Créer un utilisateur</a></li>
                    <li><a href="listeUtilisateurs.php">Liste des utilisateurs</a></li>
                <?php } ?>
            </div>
            <li><a href="logout.php" class="deconnexion">Se déconnecter</a></li>
        </section>
        </div>
        <?php }
        else{
            ?>
            <div class="connexion">
                <a  id="btnpanel" class="panel-user">
                    <span>Se connecter</span>
                </a>
                <section id="panel" class="dropdown-menu extended logout">
                    <form id="login" method="post" action="index.php">
                        <div class="champ">
                            <label id="email">E-mail</label>
                            <input type="email" name="login" id="email" class="inputConnexion" autocomplete="off" required/>
                        </div>
                        <div class="champ">
                            <label id="mdp">Mot de passe</label>
                            <input type="password" name="mdp" id="mdp" class="inputConnexion" autocomplete="off" required/>
                        </div>
                        <div class="champ">
                            <input type="submit" class="inputSubmit" value="Connexion" />
                        </div>
                        <script><? if (isset($_GET["badlogin"])) echo "alert(\"Identification erronée\");\n"; ?></script>
                    </form>
                </section>
            </div>
        <?php } ?>
</header>
<main>
