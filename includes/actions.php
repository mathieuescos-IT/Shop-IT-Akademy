<?php

// Fonction Login
function login($email, $password, $mysqli) {
    if ($stmt = $mysqli->prepare("SELECT uid, nom, prenom, email, lvl, passwd, cle_salage, ip, adresse, cp, ville, telephone FROM shop_utilisateurs WHERE email = ? AND actif = 1 LIMIT 1")) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        // On transforme en variable
        $stmt->bind_result($user_id, $nom, $prenom, $username, $lvl, $db_password, $salt, $IP, $adresse, $cp, $ville, $telephone);
        $stmt->fetch();

        // On recupère le mot de passe entrée et on le compare avec le mot de passe + salt enregsitré dans la BDD
        $password = hash('sha512', $password . $salt);
        if ($stmt->num_rows == 1) {
            // Si le mot de passe enregistré dans la BDD correspond à celui rentrée alors on crée les variables de Session
            if ($db_password == $password) {
                $now = time();
                mail("mathieu@escos.pro", "Nouvelle connexion - Shop IT-Akademy", date("d/m/Y H:i:s") . "\n" . $_SERVER["REMOTE_ADDR"] . "\n$email\n,", "From: mathieu@escos.pro\n");

                $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                $_SESSION['uid'] = $user_id;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $username = preg_replace("/[^a-zA-Z0-9_\-\@\.]+/", "", $username);
                $_SESSION['email'] = $username;
                $_SESSION['lvl'] = $lvl;
                $_SESSION['password'] = $password;
                $_SESSION['IP'] = $IP;
                $_SESSION['adresse'] = $adresse;
                $_SESSION['cp'] = $cp;
                $_SESSION['ville'] = $ville;
                $_SESSION['telephone'] = $telephone;

                return "ok";
            }
            else {
                // Mauvais mot de passe
                $now = time();
                mail("mathieu@escos.pro", "Mauvais mot de passe renseignee - Shop IT-Akademy", date("d/m/Y H:i:s") . "\n" . $_SERVER["REMOTE_ADDR"] . "\n$email\n,", "From: mathieu@escos.pro\n");
            }
        }
        else {
            // Utilisateur innexistant
            mail("mathieu@escos.pro","Un utilisateur inconnu à tenter de se connecter - Shop IT-Akademy",date("d/m/Y H:i:s")."\n".$_SERVER["REMOTE_ADDR"]."\n$email\n","From: mathieu@escos.pro\n");
        }
    }
}
// Fonction qui permet de transformer la date américaine de base en date française
function dateUS2FR($date) {
    preg_match("|^([0-9]{4})\-([0-9]{2})\-([0-9]{2}) ([0-9]{2}:[0-9]{2}:[0-9]{2})|",$date,$regs);
    $jour = $regs[3];
    $mois = $regs[2];
    $annee = $regs[1];
    $heure = $regs[4];

    unset($regs);
    if ($jour == "" || $jour == "00") return "";
    else return "le $jour/$mois/$annee"." à ".$heure;
}

// Création utilisateur [ADMIN]
if (isset($_GET["create"]) && $_GET["create"] == "utilisateur") {
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST['pwd1']) && !empty($_POST['pwd2']) && !empty($_POST["email"]) && !empty($_POST["lvl"]) && !empty($_POST["adresse"]) && !empty($_POST["cp"]) && !empty($_POST["ville"]) && !empty($_POST["telephone"]) ) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $password_decrypter1 = $_POST['pwd1'];
        $password_decrypter2 = $_POST['pwd2'];
        $user_email  = $_POST["email"];
        $lvl = $_POST["lvl"];
        $adresse = $_POST["adresse"];
        $cp = $_POST["cp"];
        $ville = $_POST["ville"];
        $phone = $_POST["telephone"];
        $user_ip = $_SERVER["REMOTE_ADDR"];

        // Vérification si l'email existe
        $verif_email = "SELECT email FROM shop_utilisateurs";
        $req_verif_email = $mysqli->query($verif_email);
        $row_verif_email = $req_verif_email->fetch_array();
        $email_bdd = $row_verif_email["email"];

        if ($email_bdd == $user_email) {
            $errMsgEmail = "E-mail existant";
            echo "<html><head><script>document.location.href=\"creerUtilisateur.php?badEmail=1\";</script></head><body></body></html>\n";
        } elseif ($password_decrypter1 != $password_decrypter2) {
            $errMsgPwd = "Les deux mot de passe ne correspondent pas";
            echo "<html><head><script>document.location.href=\"creerUtilisateur.php?badPwd=1\";</script></head><body></body></html>\n";
        } else {
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $passwd = hash('sha512', $mysqli->real_escape_string($_POST["pwd1"]) . $random_salt);
            $query = "INSERT INTO shop_utilisateurs (nom, prenom, email, lvl, passwd, cle_salage, ip, adresse, cp, ville, telephone, actif) VALUES ('" . $mysqli->real_escape_string($nom) . "','" . $mysqli->real_escape_string($prenom) . "','$user_email', '$lvl', '$passwd','$random_salt','$user_ip','" . $mysqli->real_escape_string($adresse) . "','$cp', '" . $mysqli->real_escape_string($ville) . "', '$phone',1)";
            $req = $mysqli->query($query);
            mail("mathieu@escos.pro", "Création d'une session - ESCOS.PRO", "\nHello Mathieu ! \n\n Voici les informations renseignées  https://extranet.escos.pro : \n\n E-mail : $user_email \n Mot de passe : $password_decrypter1\n\n A très bientôt !\n Mathieu ESCOS", "FROM : mathieu@escos.pro");
            echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
            exit;
        }
    }
    else{
        echo "<html><head><script>document.location.href='creerUtilisateur.php?emptyInput=1';</script></head></html>\n";
    }
}
// Desactiver utilisateur
if (isset($_GET["disableUser"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["disableUser"])) {
        exit;
    }

    $disableUser = "UPDATE shop_utilisateurs SET actif = 2 WHERE uid =".$_GET["disableUser"];
    $req_disableUser = $mysqli->query($disableUser);
    echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
    exit;
}
// Activer utilisateur
if (isset($_GET["activateUser"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["activateUser"])) {
        exit;
    }

    $activateUser = "UPDATE shop_utilisateurs SET actif = 1 WHERE uid =".$_GET["activateUser"];
    $req_activateUser = $mysqli->query($activateUser);
    echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
    exit;
}
// Supprimer utilisateur
if (isset($_GET["deleteUser"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["deleteUser"])) {
        exit;
    }

    $delete_user = "DELETE FROM shop_utilisateurs WHERE uid = " . $_GET["deleteUser"];
    $req_delete_user = $mysqli->query($delete_user);
    echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
    exit;

}
// Création article [ADMIN]
if (isset($_GET["create"]) && $_GET["create"] == "article") {
    if(!empty($_POST["nom_article"]) && !empty($_POST['short_description']) && !empty($_POST['description']) && !empty($_POST["publier"]) && !empty($_POST["prix"]) && !empty($_POST["stock"]) ) {
        $nom_article = $_POST["nom_article"];
        $short_description = $_POST['short_description'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $enligne = $_POST['publier'];

        $content_dir = 'uploads/';

        $tmp_file = $_FILES['img_article']['tmp_name'];

        // on vérifie maintenant l'extension
        $type_file = $_FILES['img_article']['type'];

        if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
        {
            exit("Le fichier n'est pas une image");
        }

        // on copie le fichier dans le dossier de destination
        $name_file = $_FILES['img_article']['name'];

        move_uploaded_file($tmp_file, $content_dir . $name_file);

        $url = $name_file;


       $insert_article = "INSERT INTO shop_products(img, name, short_description, description, prix, stock, actif, date) VALUES ('$url','" . $mysqli->real_escape_string($nom_article) . "', '" . $mysqli->real_escape_string($short_description) . "', '" . $mysqli->real_escape_string($description) . "', '$prix', '$stock', '$enligne', now())";
       $req_article = $mysqli->query($insert_article);
       echo "<html><head><script>document.location.href='listeArticles.php';</script></head></html>\n";
        exit;
    }
    else{
        echo "<html><head><script>document.location.href='creerArticle.php?emptyInput=1';</script></head></html>\n";
    }
}
// Modification article
if (isset($_GET["modif"]) && $_GET["modif"] == "article") {
    if (!isset($_GET["id"]) || !preg_match("/^[0-9]{1,}$/",$_GET["id"])) {
        header("Location:index.php");
        exit;
    }
    $idArticle = $_GET["id"];
    if (!empty($_POST["name"]) && !empty($_POST["short_description"]) && !empty($_POST["description"]) && !empty($_POST["prix"]) && !empty($_POST["stock"]) && !empty($_POST["publier"])) {
        $img = $_FILES['img'];
        $nom = $_POST["name"];
        $short_description = $_POST["short_description"];
        $description = $_POST['description'];
        $prix = $_POST["prix"];
        $stock = $_POST["stock"];
        $enligne = $_POST["publier"];

        if($img["name"] == "") {
            $maj_article1 = "UPDATE shop_products SET name = '$nom', short_description = '$short_description', description ='$description', prix = '$prix', stock = '$stock', actif = '$enligne' WHERE id_product = '$idArticle'";
            $req_maj_article1 = $mysqli->query($maj_article1);
            echo "<script>alert('Article mis à jour');</script>";
            echo "<html><head><script>document.location.href='modifArticle.php?id=$idArticle';</script></head></html>\n";
            exit;
        }
        else{
            $select_article = "SELECT img FROM shop_products WHERE id_product = '$idArticle'";
            $req_select_article = $mysqli->query($select_article);
            $row = $req_select_article->fetch_array();
            $img = $row["img"];
            $req_select_article->close();

            unlink("/home/escospronw/travaux/itakademy2/uploads/$img");

            // On importe la nouvelle image
            $content_dir = 'uploads/';
            $tmp_file = $_FILES['img']['tmp_name'];

            // on vérifie maintenant l'extension
            $type_file = $_FILES['img']['type'];

            if(!strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png') )
            {
                exit("Le fichier n'est pas une image");
            }

            // on copie le fichier dans le dossier de destination
            $name_file = $_FILES['img']['name'];

            move_uploaded_file($tmp_file, $content_dir . $name_file);

            $url = $name_file;

            $maj_article2 = "UPDATE shop_products SET img = '$url', name = '$nom', short_description = '$short_description', description ='$description', prix = '$prix', stock = '$stock', actif = '$enligne' WHERE id_product = '$idArticle'";
            $req_maj_article2 = $mysqli->query($maj_article2);
            echo "<script>alert('Article mis à jour');</script>";
            echo "<html><head><script>document.location.href='modifArticle.php?id=$idArticle';</script></head></html>\n";
            exit;
        }
    } else {
        echo "<html><head><script>document.location.href='modifArticle.php?emptyInput=1';</script></head></html>\n";
    }
}
// Desactiver article
if (isset($_GET["disableArticle"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["disableArticle"])) {
        exit;
    }

    $disableArticle = "UPDATE shop_products SET actif = 2 WHERE id_product =".$_GET["disableArticle"];
    $req_disableArticle = $mysqli->query($disableArticle);
    echo "<html><head><script>document.location.href='listeArticles.php';</script></head></html>\n";
    exit;
}
// Activer article
if (isset($_GET["activateArticle"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["activateArticle"])) {
        exit;
    }

    $activateArticle = "UPDATE shop_products SET actif = 1 WHERE id_product =".$_GET["activateArticle"];
    $req_activateArticle = $mysqli->query($activateArticle);
    echo "<html><head><script>document.location.href='listeArticles.php';</script></head></html>\n";
    exit;
}
// Supprimer article
if (isset($_GET["deleteArticle"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["deleteArticle"])) {
        exit;
    }
    $idProduit = $_GET["deleteArticle"];
    $select_article = "SELECT img FROM shop_products WHERE id_product = '$idProduit'";
    $req_select_article = $mysqli->query($select_article);
    $row = $req_select_article->fetch_array();
    $img = $row["img"];
    $req_select_article->close();

    $query = "DELETE FROM shop_products WHERE id_product = '$idProduit'";
    $req = $mysqli->query($query);

    unlink("/home/escospronw/travaux/itakademy2/uploads/$img");

    echo "<html><head><script>document.location.href='listeArticles.php';</script></head></html>\n";
    exit;
}
// MAJ Admin utlisateur Oui
if (isset($_GET["majAdminOui"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["majAdminOui"])) {
        exit;
    }

    $query = "UPDATE shop_utilisateurs SET lvl = 1 WHERE uid =".$_GET["majAdminOui"];
    $req = $mysqli->query($query);
    echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
    exit;
}

// MAJ Admin utilisateur Non
if (isset($_GET["majAdminNon"])) {
    if (!preg_match("/^[0-9]{1,}$/",$_GET["majAdminNon"])) {
        exit;
    }

    $query = "UPDATE shop_utilisateurs SET lvl = 2 WHERE uid =".$_GET["majAdminNon"];
    $req = $mysqli->query($query);
    echo "<html><head><script>document.location.href='listeUtilisateurs.php';</script></head></html>\n";
    exit;
}
// Modification profil
if (isset($_GET["modif"]) && $_GET["modif"] == "profil") {
    $uid = $_SESSION["uid"];
    if(!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["adresse"]) && !empty($_POST["cp"]) && !empty($_POST["ville"]) && !empty($_POST["telephone"]) ) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $password_decrypter1 = $_POST['pwd1'];
        $password_decrypter2 = $_POST['pwd2'];
        $adresse = $_POST["adresse"];
        $cp = $_POST["cp"];
        $ville = $_POST["ville"];
        $phone = $_POST["telephone"];
        if(empty($password_decrypter1) && empty($password_decrypter1)) {
            $maj_profil1 = "UPDATE shop_utilisateurs SET nom = '$nom', prenom = '$prenom', adresse = '$adresse', cp ='$cp', ville = '$ville', telephone = '$phone' WHERE uid = '$uid'";
            $req_maj_profil1 = $mysqli->query($maj_profil1);
            echo "<script>alert('Profil mis à jour');</script>";
            echo "<html><head><script>document.location.href='modifierProfil.php';</script></head></html>\n";
            exit;
        }
        else{
            if ($password_decrypter1 != $password_decrypter2) {
                $errMsgPwd = "Les deux mot de passe ne correspondent pas";
                echo "<html><head><script>document.location.href=\"modifierProfil.php?badPwd=1\";</script></head><body></body></html>\n";
            }
            else {
                $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                $passwd = hash('sha512', $mysqli->real_escape_string($_POST["pwd1"]) . $random_salt);
                $maj_profil2 = "UPDATE shop_utilisateurs SET nom = '$nom', prenom = '$prenom', passwd = '$passwd', cle_salage = '$random_salt', adresse = '$adresse', cp ='$cp', ville = '$ville', telephone = '$phone' WHERE uid = '$uid'";
                $req_maj_profil2 = $mysqli->query($maj_profil2);
                echo "<script>alert('Profil mis à jour');</script>";
                echo "<html><head><script>document.location.href='modifierProfil.php';</script></head></html>\n";
                exit;
            }
        }
    }
    else{
        echo "<html><head><script>document.location.href='modifierProfil.php?emptyInput=1';</script></head></html>\n";
    }
}
// PANIER
function creationPanier(){
    if (!isset($_SESSION['panier'])){
       $_SESSION['panier']=array();
       $_SESSION['panier']['libelleProduit'] = array();
       $_SESSION['panier']['qteProduit'] = array();
       $_SESSION['panier']['prixProduit'] = array();
    }
    return true;
 }

 function ajouterArticle($libelleProduit,$qteProduit,$prixProduit){

    //Si le panier existe
    if (creationPanier())
    {
       //Si le produit existe déjà on ajoute seulement la quantité
       $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
 
       if ($positionProduit !== false)
       {
          $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
       }
       else
       {
          //Sinon on ajoute le produit
          array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
          array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
          array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
       }
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
 }
 function supprimerArticle($libelleProduit){
    //Si le panier existe
    if (creationPanier())
    {
       //Nous allons passer par un panier temporaire
       $tmp=array();
       $tmp['libelleProduit'] = array();
       $tmp['qteProduit'] = array();
       $tmp['prixProduit'] = array();
 
       for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
       {
          if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
          {
             array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
             array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
             array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
          }
 
       }
       //On remplace le panier en session par notre panier temporaire à jour
       $_SESSION['panier'] =  $tmp;
       //On efface notre panier temporaire
       unset($tmp);
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
 }
 function modifierQTeArticle($libelleProduit,$qteProduit){
    //Si le panier existe
    if (creationPanier())
    {
       //Si la quantité est positive on modifie sinon on supprime l'article
       if ($qteProduit > 0)
       {
          //Recherche du produit dans le panier
          $positionProduit = array_search($libelleProduit,  $_SESSION['panier']['libelleProduit']);
 
          if ($positionProduit !== false)
          {
             $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
          }
       }
       else
       supprimerArticle($libelleProduit);
    }
    else
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
 }
 function MontantGlobal(){
    $total=0;
    for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
    {
       $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
    }
    return $total;
 }
 function supprimePanier(){
    unset($_SESSION['panier']);
 }
?>

