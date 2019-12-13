<?php
$titre = "Mon panier";
include 'header.php';

if(empty($_SESSION["uid"])) {
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
                <span>Panier</span>
            </li>
        </ol>
    </div>
</div>
<section id="article1">
    <div class="marge">
        <div id="bloc">
            <div class="top_bloc">
                <h2>Panier</h2>
            </div>
            <div class="bottom_bloc">
                <form method="post" action="panier.php" style="width:100%;">
                        <table class="table">
                            <tr>
                                <td>Libellé</td>
                                <td>Quantité</td>
                                <td>Prix Unitaire</td>
                                <td>Action</td>
                            </tr>


                                    <?php
                                    if (creationPanier())
                                    {
                                        $nbArticles=count($_SESSION['panier']['libelleProduit']);
                                        if ($nbArticles <= 0)
                                        echo "<tr><td>Votre panier est vide </ td></tr>";
                                        else
                                        {
                                            for ($i=0 ;$i < $nbArticles ; $i++)
                                            {
                                                echo "<tr>";
                                                echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
                                                echo "<td><input type=\"text\" size=\"4\" disabled name=\"q[]\" value=\"".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."\"/></td>";
                                                echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])." €</td>";
                                                echo "<td><a class=\"desactiver\" href=\"".htmlspecialchars("panier.php?action=suppression&l=".rawurlencode($_SESSION['panier']['libelleProduit'][$i]))."\">Supprimer</a></td>";
                                                echo "</tr>";
                                            }

                                            echo "<td>";
                                            echo "Total : ".MontantGlobal()."€";
                                            echo "</td></tr>";

                                            echo "<tr><td>";
                                            echo "<input type=\"submit\" class=\"desactiver\" value=\"Rafraichir\"/>";
                                            echo "<input type=\"hidden\" class=\"desactiver\" name=\"action\" value=\"Rafraichir\"/>";

                                            echo "</td></tr>";
                                        }
                                    }

                                    $erreur = false;

                                $action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
                                if($action !== null)
                                {
                                if(!in_array($action,array('ajout', 'suppression', 'refresh')))
                                $erreur=true;

                                //récuperation des variables en POST ou GET
                                $l = (isset($_POST['l'])? $_POST['l']:  (isset($_GET['l'])? $_GET['l']:null )) ;
                                $p = (isset($_POST['p'])? $_POST['p']:  (isset($_GET['p'])? $_GET['p']:null )) ;
                                $q = (isset($_POST['q'])? $_POST['q']:  (isset($_GET['q'])? $_GET['q']:null )) ;

                                //Suppression des espaces verticaux
                                $l = preg_replace('#\v#', '',$l);
                                //On vérifie que $p soit un float
                                $p = floatval($p);

                                //On traite $q qui peut être un entier simple ou un tableau d'entiers
                                    
                                if (is_array($q)){
                                    $QteArticle = array();
                                    $i=0;
                                    foreach ($q as $contenu){
                                        $QteArticle[$i++] = intval($contenu);
                                    }
                                }
                                else
                                $q = intval($q);
                                    
                                }

                                if (!$erreur){
                                switch($action){
                                    Case "ajout":
                                        ajouterArticle($l,$q,$p);
                                        break;

                                    Case "suppression":
                                        supprimerArticle($l);
                                        break;

                                    Case "refresh" :
                                        for ($i = 0 ; $i < count($QteArticle) ; $i++)
                                        {
                                            modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
                                        }
                                        break;

                                    Default:
                                        break;
                                }
                                }
                                    ?>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

<?php include ('footer.php'); ?>
