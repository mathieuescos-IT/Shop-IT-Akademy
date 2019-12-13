-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : escospronwtonton.mysql.db
-- Généré le :  ven. 13 déc. 2019 à 20:18
-- Version du serveur :  5.6.39-log
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `escospronwtonton`
--

-- --------------------------------------------------------

--
-- Structure de la table `shop_orders`
--

CREATE TABLE `shop_orders` (
  `id_orders` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `date_commande` datetime DEFAULT NULL,
  `Status` bigint(1) NOT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `shop_products`
--

CREATE TABLE `shop_products` (
  `id_product` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(150) NOT NULL,
  `description` text,
  `prix` float NOT NULL,
  `stock` int(11) NOT NULL,
  `actif` bigint(1) DEFAULT NULL,
  `date` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shop_products`
--

INSERT INTO `shop_products` (`id_product`, `img`, `name`, `short_description`, `description`, `prix`, `stock`, `actif`, `date`) VALUES
(20, 'bonnet bleu.jpg', 'Bonnet mixte', 'Bonnet mixte à revers bleu marine 100% acrylique !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.', 10, 5000, 1, '2019-12-13 09:42:01'),
(21, 'bonnet bleu tricot.jpg', 'Bonnet tricoté', 'Jolie bonnet tricoté bleu marine', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 20, 2500, 1, '2019-12-13 10:01:54'),
(22, 'casquette.jpg', 'Casquette bleu ou rouge', 'Casquette bleu ou rouge 50% coton', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.', 25, 2500, 1, '2019-12-13 10:03:54'),
(23, 'Lunettes marque UGA.jpg', 'Lunette rouge', 'Lunette de marge UGA en coloris rouge !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 35, 300, 1, '2019-12-13 10:13:27'),
(24, 'Polo UGA.jpg', 'Polo 100% coton ', 'Superbe polo 100% coton en bleu marine avec broderie blanche et blason', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 40, 2500, 1, '2019-12-13 10:15:54'),
(25, 'sacs-a-dos.jpg', 'Sac à dos bleu ou rouge', 'Sac à dos bleu ou rouge avec bandoulière et dos métallisé !  ', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 35, 250, 1, '2019-12-13 10:17:30'),
(26, 'sac cabas.jpg', 'Sac cabas écru', 'Superbe sac cabas écru, utile pour vos déplacements !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 20, 2500, 1, '2019-12-13 10:18:45'),
(27, 'Sac de sport de marque UGA.jpg', 'Sac de sport bleu marine', 'Sac de sport utile pour les sportifs !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.\r\n', 45, 650, 1, '2019-12-13 10:19:37'),
(28, 'fouta.jpg', 'Serviette de plage', 'Magnifique serviette de plage en coton beige 179x90', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.', 40, 800, 1, '2019-12-13 10:21:09'),
(29, 'sweat-capuche-gris-leo.jpg', 'Sweet à capuche ', 'Sweet à capuche marque léopard en gris !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.', 30, 255, 2, '2019-12-13 10:22:05'),
(30, 'sweat gris.jpg', 'Sweat à capuche gris pour femme', 'Jolie sweat gris à capuche pour femme !', 'Ac ne quis a nobis hoc ita dici forte miretur, quod alia quaedam in hoc facultas sit ingeni, neque haec dicendi ratio aut disciplina, ne nos quidem huic uni studio penitus umquam dediti fuimus. Etenim omnes artes, quae ad humanitatem pertinent, habent quoddam commune vinculum, et quasi cognatione quadam inter se continentur.', 30, 355, 1, '2019-12-13 10:23:11');

-- --------------------------------------------------------

--
-- Structure de la table `shop_slider`
--

CREATE TABLE `shop_slider` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `txt_bouton` varchar(255) NOT NULL,
  `lien_bouton` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shop_slider`
--

INSERT INTO `shop_slider` (`id`, `image`, `titre`, `description`, `txt_bouton`, `lien_bouton`) VALUES
(1, '1', 'titre test', 'rtest test test', 'test', 'test');

-- --------------------------------------------------------

--
-- Structure de la table `shop_utilisateurs`
--

CREATE TABLE `shop_utilisateurs` (
  `uid` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lvl` bigint(1) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `cle_salage` char(128) NOT NULL,
  `actif` bigint(1) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `adresse` text,
  `cp` int(5) DEFAULT NULL,
  `ville` varchar(150) DEFAULT NULL,
  `telephone` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `shop_utilisateurs`
--

INSERT INTO `shop_utilisateurs` (`uid`, `nom`, `prenom`, `email`, `lvl`, `passwd`, `cle_salage`, `actif`, `ip`, `adresse`, `cp`, `ville`, `telephone`) VALUES
(8, 'Test', 'Compte', 'test@test.fr', 1, 'f7647fde4db83d73f976e97865338ac6222a02ac4f550a4c6b75e118542c77dd4f39fca14af942a5f29c19bd4d4d9328e876dc2f7521adf84fae8866e400d075', '527c0c5743cca03a1438ec878ff1aa9c16fba5974706a27a9bd3d5518e17bebb6738f36d4112379f751ad9ebb51eaa3fc5a84f77403a5bf62beaaa0991a25869', 1, '92.154.11.124', '2 rue des combles', 69300, 'Fontaine', '0987654321'),
(9, 'Test ', 'Compte Utilisateur', 'test2@test.fr', 2, '6ccbbccd621cbc5651cce2df1c1435fcfad7a6c9eecd6933309f56e18cc27afb3106052a0b95974c16f2c1b691242c21d96cb6aa7f29017a629d2e604ff18ac4', '0cba90c11c296453fe210ba1e90f4734c4ca27e36c97d2f761cd9192c85cfdec1268718bcaa7aaa7a17bd1dba9a130fbe4eb47f6a62e43a9c2c405b3dd76b69d', 1, '92.154.11.124', '30 montée de la pente', 69160, 'Tassin-la-demi-lune', '0478520909');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD KEY `fk_id_product` (`id_product`),
  ADD KEY `fk_id_user` (`id_utilisateur`);

--
-- Index pour la table `shop_products`
--
ALTER TABLE `shop_products`
  ADD PRIMARY KEY (`id_product`);

--
-- Index pour la table `shop_slider`
--
ALTER TABLE `shop_slider`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `shop_utilisateurs`
--
ALTER TABLE `shop_utilisateurs`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `shop_products`
--
ALTER TABLE `shop_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `shop_slider`
--
ALTER TABLE `shop_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `shop_utilisateurs`
--
ALTER TABLE `shop_utilisateurs`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `shop_orders`
--
ALTER TABLE `shop_orders`
  ADD CONSTRAINT `fk_id_product` FOREIGN KEY (`id_product`) REFERENCES `shop_products` (`id_product`),
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_utilisateur`) REFERENCES `shop_utilisateurs` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
