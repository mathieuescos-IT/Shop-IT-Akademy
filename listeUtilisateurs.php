<?php
// PAGE RERVERSER AUX ADMINS
$titre = "Liste des utilisateurs";
include("header.php");
if(!empty($_SESSION['uid'])) {
    if ($_SESSION['lvl'] != 1) {
        echo "<html><script> alert('Vous ne pouvez pas consulter cette page.');</script></html>";
        echo "<html><script> document.location.href='index.php';</script></html>";
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
                <span>Liste des utilisateurs</span>
            </li>
        </ol>
    </div>
</div>
<section id="listeUser1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Liste des utilisateurs</h2>
                <a href="creerUtilisateur.php" id="bouton_liste">Ajouter un utilisateur</a>
            </div>
            <div class="bottom_bloc">
                <table id="listeUtilisateurs" class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actif</th>
                            <th>Désactiver</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?
                        $listeUtilisateurs = "SELECT * FROM shop_utilisateurs ORDER BY nom ASC";
                        $req_listeUtilisateurs = $mysqli->query($listeUtilisateurs);
                        while($row = $req_listeUtilisateurs->fetch_array()) {
                            echo "<tr>\n";
                            echo "<td>".$row["nom"]."</td>\n";
                            echo "<td>".$row["prenom"]."</td>\n";
                            echo "<td>".$row["email"]."</td>\n";
                            if ($row["lvl"] == 1) echo "<td><b style=\"color:#42db75;\"><a href=\"listeUtilisateurs.php?majAdminNon=".$row["uid"]."\" style=\"color:#8760fb;\" >ADMIN</a></b></td>\n";
                            else echo "<td><b style=\"color:#cd3131;\"><a href=\"listeUtilisateurs.php?majAdminOui=".$row["uid"]."\" style=\"color:#334151;\">MEMBRE</a></b></td>\n";
                            if ($row["actif"] == 1) echo "<td><b style=\"color:#42db75;\">OUI</b></td>\n";
                            else echo "<td><b style=\"color:#cd3131;\">NON</b></td>\n";
                            if ($row["actif"] == 1) echo " <td><a href=\"listeUtilisateurs.php?disableUser=$row[uid]\" class=\"desactiver\">Désactiver</button></td>";
                            else echo " <td><a href=\"listeUtilisateurs.php?activateUser=$row[uid]\" class=\"desactiver\">Activer</button></td>";
                            echo " <td><a href=\"listeUtilisateurs.php?deleteUser=$row[uid]\" class=\"desactiver\">Supprimer</button></td>";

                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include ('footer.php'); ?>
