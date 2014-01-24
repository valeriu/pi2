-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 23 Janvier 2014 à 11:29
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `commande` varchar(1500) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;


--
-- Structure de la table `wa_adresse`
--

DROP TABLE IF EXISTS `wa_adresse`;
CREATE TABLE IF NOT EXISTS `wa_adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` varchar(10) NOT NULL DEFAULT '0',
  `rue` varchar(45) NOT NULL,
  `appartement` varchar(45) DEFAULT NULL,
  `ville` varchar(45) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `province` varchar(45) NOT NULL,
  `statut` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_adresse`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `wa_adresse`
--

INSERT INTO `wa_adresse` (`id_adresse`, `telephone`, `rue`, `appartement`, `ville`, `code_postal`, `province`, `statut`) VALUES
(1, '5145554499', '2030 Pie IX', '#58', 'Montreal', 'H0H0H0', 'qc', 1),
(2, '8193656969', '123 Viau', '#4', 'Montréal', 'H1H2H2', 'qc', 1),
(3, '5145585854', '3800  Sherbrooke Est', '#589', 'Montréal', 'H1X2A2', 'qc', 1),
(4, '8195651234', '45 Rue Armada', '', 'Québec', 'H1W5R6', 'qc', 1),
(5, '5142547131', '3854 Sherbrooke Est', '#85', 'Montréal', 'H1X2A2', 'qc', 1),
(6, '5146568888', '123 Ghetto', '', 'Trois-Rivières', 'H1H3R3', 'on', 1),
(7, '4506899854', '4578 Gouin', '', 'Trois-Pistole', 'h1H3N5', 'sk', 1),
(8, '5145555555', '123 Pierre', '', 'Montréal', 'H1V2H7', 'sk', 1),
(9, '5146666666', '125 herbivore', '', 'Gouin', 'H1V1H7', 'nb', 1);

-- --------------------------------------------------------

--
-- Structure de la table `wa_adresse_utilisateur`
--

DROP TABLE IF EXISTS `wa_adresse_utilisateur`;
CREATE TABLE IF NOT EXISTS `wa_adresse_utilisateur` (
  `id_adresse_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_id_adresse` int(11) NOT NULL,
  `utilisateurs_id_utilisateurs` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse_utilisateur`),
  KEY `fk_adresse_utilisateur_adresse1_idx` (`adresse_id_adresse`),
  KEY `fk_adresse_utilisateur_utilisateurs1_idx` (`utilisateurs_id_utilisateurs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `wa_adresse_utilisateur`
--

INSERT INTO `wa_adresse_utilisateur` (`id_adresse_utilisateur`, `adresse_id_adresse`, `utilisateurs_id_utilisateurs`) VALUES
(1, 1, 9),
(2, 2, 250),
(3, 3, 266),
(4, 4, 250),
(5, 5, 5),
(6, 6, 267),
(7, 7, 267),
(8, 8, 267),
(9, 9, 267);

-- --------------------------------------------------------

--
-- Structure de la table `wa_categorie`
--

DROP TABLE IF EXISTS `wa_categorie`;
CREATE TABLE IF NOT EXISTS `wa_categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `wa_categorie`
--

INSERT INTO `wa_categorie` (`id_categorie`, `nom`) VALUES
(1, 'Panneaux solaires'),
(2, 'Kits Solaires'),
(3, 'Lampes DEL');

-- --------------------------------------------------------

--
-- Structure de la table `wa_commande_produit`
--

DROP TABLE IF EXISTS `wa_commande_produit`;
CREATE TABLE IF NOT EXISTS `wa_commande_produit` (
  `id_commande_produit` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `produits_id_produits` int(11) NOT NULL,
  `commandes_id_commandes` int(11) NOT NULL,
  PRIMARY KEY (`id_commande_produit`),
  KEY `fk_ordre_produit_produits1_idx` (`produits_id_produits`),
  KEY `fk_commande_produit_commandes1_idx` (`commandes_id_commandes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `wa_commande_produit`
--

INSERT INTO `wa_commande_produit` (`id_commande_produit`, `quantite`, `produits_id_produits`, `commandes_id_commandes`) VALUES
(1, 1, 17, 1),
(2, 2, 17, 2),
(3, 1, 9, 2),
(4, 2, 15, 3),
(5, 1, 14, 4),
(6, 1, 15, 4),
(7, 1, 15, 5),
(8, 1, 16, 5),
(9, 1, 17, 5),
(10, 1, 18, 5),
(11, 1, 4, 6);

-- --------------------------------------------------------

--
-- Structure de la table `wa_commandes`
--

DROP TABLE IF EXISTS `wa_commandes`;
CREATE TABLE IF NOT EXISTS `wa_commandes` (
  `id_commandes` int(11) NOT NULL AUTO_INCREMENT,
  `statut` int(11) NOT NULL DEFAULT '0' COMMENT '0 - en traitement1 - backorder 2 - expedie 3 - anulle',
  `commentaires` varchar(2500) DEFAULT NULL,
  `adresse_utilisateur_id_adresse_utilisateur` int(11) NOT NULL,
  `date_commande` datetime DEFAULT NULL,
  `utilisateurs_id_utilisateurs` int(11) NOT NULL,
  `total_commande` decimal(11,2) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_commandes`),
  KEY `fk_ordes_adresse_utilisateur1_idx` (`adresse_utilisateur_id_adresse_utilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `wa_commandes`
--

INSERT INTO `wa_commandes` (`id_commandes`, `statut`, `commentaires`, `adresse_utilisateur_id_adresse_utilisateur`, `date_commande`, `utilisateurs_id_utilisateurs`, `total_commande`, `token`) VALUES
(1, 0, NULL, 1, '2014-01-23 10:41:24', 9, '1.44', 'EC-0VJ12566DG275782N'),
(2, 0, NULL, 2, '2014-01-23 10:50:35', 250, '232.82', 'EC-91830974459844611'),
(3, 0, NULL, 3, '2014-01-23 10:53:31', 266, '22.97', 'EC-67S83135BE0626339'),
(4, 0, NULL, 4, '2014-01-23 10:54:00', 250, '34.47', 'EC-41E69045UG5629421'),
(5, 0, NULL, 5, '2014-01-23 11:01:28', 5, '85.35', 'EC-3LY71586JC659010X'),
(6, 0, NULL, 6, '2014-01-23 11:10:38', 267, '237.30', 'EC-9NY720140D319722Y');

-- --------------------------------------------------------

--
-- Structure de la table `wa_evaluation`
--

DROP TABLE IF EXISTS `wa_evaluation`;
CREATE TABLE IF NOT EXISTS `wa_evaluation` (
  `id_evaluation` int(11) NOT NULL AUTO_INCREMENT,
  `votes` int(11) DEFAULT '0',
  `evaluation_total` int(11) DEFAULT '0',
  PRIMARY KEY (`id_evaluation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `wa_evaluation`
--


-- --------------------------------------------------------

--
-- Structure de la table `wa_menu`
--

DROP TABLE IF EXISTS `wa_menu`;
CREATE TABLE IF NOT EXISTS `wa_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `ordre` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '1' COMMENT '0 - invisible\n1 - visible\n2 - supprimé',
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `wa_menu`
--

INSERT INTO `wa_menu` (`id_menu`, `titre`, `description`, `url`, `parent`, `ordre`, `statut`) VALUES
(1, 'Accueil', 'Page Accueil', 'index.php', 0, 1, 1),
(2, 'Produits', 'Page Produits', 'index.php?requete=produits', 0, 2, 1),
(3, 'À propos', 'Page À propos', 'index.php?requete=page&page_id=1', 0, 3, 1),
(4, 'Nous joindre', 'Nous joindre', 'index.php?requete=page&page_id=2', 0, 4, 1),
(5, 'Panneaux solaires', 'Catalogue des panneaux solaires', 'index.php?requete=produits&mode=tous&1=true&2=false&3=false', 2, 1, 1),
(6, 'Kits Solaires', 'Catalogue des kits Solaires', 'index.php?requete=produits&mode=tous&1=false&2=true&3=false', 2, 2, 1),
(7, 'Lampes DEL', 'Catalogue des lampes DEL', 'index.php?requete=produits&mode=tous&1=false&2=false&3=true', 2, 3, 1),
(14, 'Tous', 'Catalogue de tous les produits', 'index.php?requete=produits&mode=tous&1=true&2=true&3=true', 2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `wa_pages`
--

DROP TABLE IF EXISTS `wa_pages`;
CREATE TABLE IF NOT EXISTS `wa_pages` (
  `id_page` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(250) NOT NULL,
  `description_meta` varchar(250) DEFAULT NULL,
  `contenu` longtext,
  `date_modif` datetime NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '0' COMMENT '0 - invisible\n1 - visible\n2 - supprimé',
  `geo_long` float DEFAULT NULL,
  `geo_lat` float DEFAULT NULL,
  PRIMARY KEY (`id_page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=213 ;

--
-- Contenu de la table `wa_pages`
--

INSERT INTO `wa_pages` (`id_page`, `titre`, `description_meta`, `contenu`, `date_modif`, `statut`, `geo_long`, `geo_lat`) VALUES
(1, 'À propos', 'À propos', '<h2>Une entreprise canadienne, bas&eacute;e au Qu&eacute;bec</h2>\r\n<p>Entreprise canadienne &eacute;tablie au Qu&eacute;bec depuis plus de 40 ans, SAIL dirige ses op&eacute;rations &agrave; <span style="color: #ff0000;">partir</span> de son si&egrave;ge social, situ&eacute; &agrave; Laval. SAIL poss&egrave;de pr&eacute;sentement des succursales &agrave; Beloeil, &agrave; Brossard, &agrave; Burlington, &agrave; Etobicoke, &agrave; Laval, &agrave; Oshawa, &agrave; Ottawa, &agrave; Qu&eacute;bec et &agrave; Vaughan. Bien qu''elle offre d&eacute;j&agrave; le plus grand r&eacute;seau de magasins de plein air, de camping, de chasse et p&ecirc;che de l&rsquo;E4 st du Canada, SAIL pr&eacute;voit poursuivre son d&eacute;veloppement en ouvrant de nouvelles succursales au Qu&eacute;bec et en Ontario au cours des prochaines ann&eacute;es.</p>\r\n<p>SAIL, &laquo; la plus grande destination plein air &raquo;, a pour mission d&rsquo;offrir le plus grand choix de produits des meilleures marques &agrave; des prix plus que comp&eacute;titifs. Dans cette optique, outre son choix exceptionnel de v&ecirc;tements de plein air, chaque magasin est une v&eacute;ritable salle d&rsquo;exposition en mettant &agrave; disposition entre 20 et 50 mod&egrave;les de tentes enti&egrave;rement mont&eacute;es (variable selon la saison), 40 mod&egrave;les d&rsquo;embarcations (kayaks et canots principalement), 3500 paires de raquettes &agrave; neige, 1550 mod&egrave;les de cannes &agrave; p&ecirc;che, 500 mod&egrave;les de bottes et de chaussures de plein air et bien d&rsquo;autres produits indispensables pour pratiquer vos loisirs en &eacute;tant bien &eacute;quip&eacute; et confortable. En tout, c''est plus de 500 000 articles dans chacun des magasins SAIL!</p>\r\n<h3>Des employ&eacute;s qui savent de quoi ils parlent</h3>\r\n<p>Chaque succursale <strong>compte</strong> plus de 100 employ&eacute;s et SAIL investit de fa&ccedil;on importante dans la formation de son personnel. Parmi ces employ&eacute;s, on retrouve des professionnels de chasse et de p&ecirc;che, des guides d&rsquo;exp&eacute;dition, des sp&eacute;cialistes de kayak et de marche nordique, des adeptes de course et de raids de haut niveau. Ainsi, dans l&rsquo;un ou l&rsquo;autre des d&eacute;partements, le consommateur peut compter &agrave; coup s&ucirc;r sur l&rsquo;expertise d&rsquo;un sp&eacute;cialiste ou d&rsquo;un passionn&eacute; de plein air et b&eacute;n&eacute;ficier de ses conseils.</p>', '2014-01-22 11:25:04', 1, NULL, NULL),
(2, 'Nous joindre', 'Quisque sit amet est et sapien ullamcorper pharetra', '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>\r\n<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>', '2014-01-22 09:48:32', 1, -73.268, 45.5808),
(211, 'Success', '', '<p>Votre paiement a &eacute;t&eacute; &eacute;ffectu&eacute; avec succ&egrave;s!</p>', '2014-01-23 10:09:00', 1, NULL, NULL),
(212, 'Échec', '', '<p>Il y a eu une erreur lors de votre paiement.</p>', '2014-01-23 10:05:37', 1, NULL, NULL),
(210, 'Annulé PayPal', 'Annulé PayPal', '<p>Annul&eacute; PayPal</p>', '2014-01-20 21:27:23', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `wa_produits`
--

DROP TABLE IF EXISTS `wa_produits`;
CREATE TABLE IF NOT EXISTS `wa_produits` (
  `id_produits` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `description` longtext,
  `specification` longtext,
  `image` varchar(250) DEFAULT NULL,
  `statut` int(11) DEFAULT '1' COMMENT '1 - actif 2 - supprimé 3 - inactive',
  `type` int(11) DEFAULT '3' COMMENT '1 - nouveau 2 - meilleure vente 3 - normale',
  `fournisseur` varchar(250) DEFAULT NULL,
  `iditem_fournisseur` varchar(250) DEFAULT NULL,
  `poids` double DEFAULT NULL,
  `taille_longueur` double DEFAULT NULL,
  `taille_largeur` double DEFAULT NULL,
  `taille_hauteur` double DEFAULT NULL,
  `evaluation_id_evaluation` int(11) NOT NULL,
  `categorie_id_categorie` int(11) NOT NULL,
  `puissance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_produits`),
  KEY `fk_produits_evaluation1_idx` (`evaluation_id_evaluation`),
  KEY `fk_produits_categorie1_idx` (`categorie_id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Contenu de la table `wa_produits`
--

INSERT INTO `wa_produits` (`id_produits`, `nom`, `prix`, `description`, `specification`, `image`, `statut`, `type`, `fournisseur`, `iditem_fournisseur`, `poids`, `taille_longueur`, `taille_largeur`, `taille_hauteur`, `evaluation_id_evaluation`, `categorie_id_categorie`, `puissance`) VALUES
(2, 'Kit panneau solaire 85W', 180, 'Kit solaire de base de 85W 4.89A avec régulateur de charge et câbles solaires.', 'Le kit de base de 85W comprend les accessoires suivants:,1- Panneau monocristallin 85W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit, doivent être fournis par le client', '15001.jpg', 3, 3, 'DC Solaire', '50001', 8.2, 107, 61, 9.9, 2, 2, 85),
(3, 'Kit panneau solaire 105W - POLY', 190, 'Kit solaire de base de 100W 5.7A avec régulateur de charge et câbles solaires.', 'Le kit de base de 105W comprend les accessoires suivants:,1- Panneau polycristallin 100W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit, doivent être fournis par le client', '15002.jpg', 1, 3, 'DC Solaire', '50002', 8.6, 124, 61, 9.9, 3, 2, 105),
(4, 'Kit panneau solaire 100W ', 210, 'Kit solaire de base de 100W 5.52A avec régulateur de charge et câbles solaires.', 'Le kit de base de 100W comprend les accessoires suivants:,1- Panneau monocristallin 100W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit, doivent être fournis par le client', '15003.jpg', 1, 3, 'DC Solaire', '50003', 8.6, 124, 61, 9.9, 4, 2, 100),
(5, 'Kit panneau solaire 135W - POLY', 240, 'Kit solaire de base de 135W polycristallin 7.67A avec régulateur de charge et câbles solaires.', 'Le kit de base de 135W comprend les accessoires suivants:,1- Panneau polycristallin 135W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit, doivent être fournis par le client', '15004.jpg', 1, 1, 'DC Solaire', '50004', 13.2, 152, 74, 9.9, 5, 2, 135),
(6, 'Kit panneau solaire 135W', 260, 'Kit solaire de base de 135W 7.5A avec régulateur de charge et câbles solaires.', 'Le kit de base de 135W comprend les accessoires suivants:,1- Panneau monocristallin 135W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit, doivent être fournis par le client', '15005.jpg', 1, 2, 'DC Solaire', '50005', 13.2, 152, 74, 9.9, 6, 2, 135),
(7, 'Kit panneau solaire 145W - POLY', 260, 'Kit solaire de base de 145W polycristallin 7.88A avec régulateur de charge et câbles solaires.', 'Le kit de base de 145W comprend les accessoires suivants:,1- Panneau polycristallin 145W,1- Contrôleur de charge de 10A EPRC-ST,2- Câble 12AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 12AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit doivent être fournis par le client', '15006.jpg', 3, 1, 'DC Solaire', '50006', 13.2, 152, 74, 9.9, 7, 2, 145),
(8, 'Kit panneau solaire 200W', 370, 'Kit solaire de base de 200W 10.6A avec régulateur de charge et câbles solaires.', 'Le kit de base de 200W comprend les accessoires suivants:,1- Panneau monocristallin 200W,1- Contrôleur de charge de 30A avec écran digital,2- Câble 10AWG de 20Pi chacun avec connecteurs MC4 pour connecter le panneau solaire au contrôleur de charge,2- Câble 10AWG de 7Pi chacun avec des pinces pour connecter le contrôleur de charge aux batteries,*Il n''y a pas de supports ou de fusibles inclus dans ce kit doivent être fournis par le client', '15007.jpg', 1, 1, 'DC Solaire', '50007', 16.8, 168, 86, 9.9, 8, 2, 200),
(9, 'Lampadaire de rue DEL 40W', 200, 'Lampadaire de rue DEL 40W 12V/24V - style shoebox', '3600Lumens, Couleur : 2700-3200K, Angle du faisceau : 120° horizontal et 60° vertical, Durée de vie >50000 heures, Garantie : 2 ans ', '152032.jpg', 1, 1, 'Microsun', '70000', 9, 70, 36.5, 9.9, 9, 3, 40),
(10, 'Lampadaire de rue DEL 80W ', 400, 'Lampadaire de rue DEL 80W 12V/24V - style shoebox', '7200Lumens, Couleur : 2700-3200K, Angle du faisceau : 120° horizontal et 60° vertical, Durée de vie >50000 heures, Garantie : 2 ans ', '152033.jpg', 1, 1, 'Microsun', '70001', 9.2, 70, 36.5, 9.9, 10, 3, 80),
(11, 'Lampadaire de rue DEL 120W', 600, 'Lampadaire de rue DEL 120W 12V/24V - style shoebox', '10800Lumens, Couleur : 2700-3200K, Angle du faisceau : 120° horizontal et 60° vertical, Durée de vie >50000 heures, Garantie : 2 ans ', '152034.jpg', 1, 1, 'Microsun', '70002', 9.4, 70, 36.5, 9.9, 11, 3, 120),
(12, 'Lampadaire de rue DEL 160W', 800, 'Lampadaire de rue DEL 1600W 12V/24V - style shoebox', '14400Lumens, Couleur : 2700-3200K, Angle du faisceau : 120° horizontal et 60° vertical, Durée de vie >50000 heures, Garantie : 2 ans ', '152035.jpg', 1, 1, 'Microsun', '70003', 10.1, 70, 36.5, 9.9, 12, 3, 160),
(13, 'Néon DEL 60cm 120VAC', 119, 'Néon DEL T8 encastré 60cm 1 rangée 120VAC 60Hz', 'Sans scintillement, Support d''installation intégré, 3000-3500K (blanc chaud), 1760 lumens, ', '153022.jpg', 3, 2, 'China Light my Life Corp', '70004', 1, 70, 10, 9.9, 13, 3, 10),
(14, 'Ampoule DEL 11W 120VAC 60Hz', 19.99, 'Ampoule DEL 11W 12VAC 60Hz socle E26 - Style épis de maïs', '216 DELS, Couleur: 3000-3500K (blanc chaud),970-1180LM, base E26, Durée de vie :>30000 heures ', '152030.jpg', 1, 2, 'China Light my Life Corp', '70005', 0.7, 15, 10, 9.9, 14, 3, 11),
(15, 'Ampoule DEL 5W 120VAC 60Hz', 9.99, 'Ampoule DEL 5W 12VAC 60Hz socle E26 - Diffuseur en plastique', 'Idéal pour maison ou bureau, Couleur: 3000-3500K (blanc chaud),450Lumens, base E26, Durée de vie :>30000 heures ', '153044.jpg', 1, 3, 'China Light my Life Corp', '70006', 0.5, 15, 10, 9.9, 15, 3, 5),
(16, 'Ampoule DEL 12W 120VAC 60Hz', 21.99, 'Ampoule DEL 12W 12VAC 60Hz socle E26 - Diffuseur en plastique', 'Idéal pour maison ou bureau, Couleur: 3000-3500K (blanc chaud),1080Lumens, base E26, Durée de vie :>30000 heures ', '153011.jpg', 1, 3, 'China Light my Life Corp', '70007', 0.7, 15, 10, 9.9, 16, 3, 12),
(17, 'Panneau Solaire 5W', 1.25, 'Panneau solaire polycristallin 5W 12VDC 0.3A', 'Cellules solaires polycristallines &agrave; rendement sup&eacute;rieure,Verre tremp&eacute;e en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodis&eacute; de type 6000 Bo&icirc;te de jonction &amp; c&acirc;bles PV certifi&eacute;s avec connecteurs &agrave; raccordement rapide,Garantie de puissance limit&eacute;e de 25 ans', '25000.jpg', 1, 1, 'Suntech', '60000', 1, 30.6, 21.6, 1.8, 2147483647, 1, 5),
(18, 'Panneau Solaire 10W', 41, 'Panneau solaire polycristallin 10W 12VDC 0.6A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25001.jpg', 1, 1, 'Suntech', '60001', 1.5, 36.8, 31.5, 1.8, 183333, 1, 10),
(19, 'Panneau Solaire 20W', 65, 'Panneau solaire polycristallin 20W 12VDC 1.2A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25002.jpg', 2, 1, 'Suntech', '60002', 2.5, 65.6, 30.6, 1.8, 19333, 1, 20),
(20, 'Panneau Solaire 30W', 90, 'Panneau solaire polycristallin 30W 12VDC 1.74A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '__25002.jpg', 1, 2, 'Suntech', '60003', 3.2, 68, 42.6, 1.8, 20333, 1, 30),
(21, 'Panneau Solaire 45W', 125, 'Panneau solaire polycristallin 45W 12VDC 2.56A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25004.jpg', 1, 1, 'Suntech', '60004', 4.5, 66.5, 53.7, 3, 2133, 1, 45),
(22, 'Panneau Solaire 65W', 145, 'Panneau solaire polycristallin 65W 12VDC 3.78A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25005.jpg', 2, 2, 'Suntech', '60005', 6.2, 77.1, 68.5, 3, 22, 1, 65),
(23, 'Panneau Solaire 80W', 165, 'Panneau solaire polycristallin 80W 12VDC 4.58A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25006.jpg', 1, 2, 'Suntech', '60006', 8, 119.5, 54.1, 3, 233, 1, 80),
(24, 'Panneau Solaire 130W', 225, 'Panneau solaire polycristallin 130W 12VDC 7.47A', 'Cellules solaires polycristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25007.jpg', 1, 3, 'Suntech', '60007', 12, 148.2, 67.6, 3.5, 243, 1, 130),
(25, 'Panneau Solaire 165W 24V', 175, 'Panneau solaire monocristallin 165W 24VDC, 4.74A approuvé cUL', 'Cellules solaires monocristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000 Boîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25008.jpg', 2, 2, 'DC Solaire', '60008', 15.5, 158, 80.8, 3.5, 253, 1, 165),
(26, 'Panneau solaire 250W 24V', 285, 'Panneau solaire monocristallin 250W 24VDC, 8.07A approuvé cUL', 'Cellules solaires monocristallines à rendement supérieure,Verre trempée en faible teneur en fer avec transparence optimale,Cadre robuste en aluminium anodisé de type 6000\nBoîte de jonction & câbles PV certifiés avec connecteurs à raccordement rapide,Garantie de puissance limitée de 25 ans', '25009.jpg', 1, 1, 'DC Solaire', '60009', 21.5, 165, 99.2, 4, 26, 1, 250);

-- --------------------------------------------------------

--
-- Structure de la table `wa_utilisateurs`
--

DROP TABLE IF EXISTS `wa_utilisateurs`;
CREATE TABLE IF NOT EXISTS `wa_utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT,
  `courriel` varchar(200) NOT NULL,
  `mot_passe` varchar(64) NOT NULL,
  `nom_prenom` varchar(250) NOT NULL,
  `date_entree` datetime NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0' COMMENT '0 - users1 - administator2 - super administator',
  `cle_reactivation` varchar(64) DEFAULT NULL,
  `statut` int(11) DEFAULT '2' COMMENT '1 - actif2 - supprimé',
  PRIMARY KEY (`id_utilisateurs`),
  UNIQUE KEY `courriel` (`courriel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=268 ;

--
-- Contenu de la table `wa_utilisateurs`
--

INSERT INTO `wa_utilisateurs` (`id_utilisateurs`, `courriel`, `mot_passe`, `nom_prenom`, `date_entree`, `role`, `cle_reactivation`, `statut`) VALUES
(1, 'ex@ex.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Luc, Cinq-Mars', '2014-01-07 13:48:50', 0, NULL, 1),
(2, 'a@a.com', 'dcf4f24fe14a1c830879a0199f38f061', 'Anjolie Sharp', '2014-01-16 12:10:26', 1, NULL, 1),
(3, 'Proin.mi.Aliquam@nullaCras.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Emerson Alexander', '1994-09-28 00:00:00', 2, '0536b5590b02cb17f4cc91fa995ef3e4', 2),
(4, 'a@a.eu', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin Test', '2014-01-21 13:44:53', 1, 'c25a03c929778e7e13a1c2d2c225aa9c', 1),
(5, 'jmartel@cmaisonneuve.qc.ca', '78f7a5fc9f3a196e4660927c757f6628', 'Jonathan Martel', '2014-01-16 19:28:01', 2, NULL, 1),
(9, 'valeriu@tihai.md', '8287458823facb8ff918dbfabcd22ccb', 'Valeriu Tihai', '2014-01-16 19:11:09', 2, NULL, 1),
(138, 'tempor.lorem.eget@Curabiturvel.com', 'dcf4f24fe14a1c830879a0199f38f061', 'Luc, Mars', '2014-01-08 09:01:43', 0, NULL, 1),
(139, 'tempor.lorem.eget@Curabiturvel.ca', 'dcf4f24fe14a1c830879a0199f38f061', 'Luc, Mars', '2014-01-08 09:01:43', 1, NULL, 1),
(144, 'tempor.lorem.eget@Cu.com', 'dcf4f24fe14a1c830879a0199f38f061', 'Luc, Mars', '2014-01-08 09:02:21', 0, NULL, 1),
(145, 'tempor.lorem.eget@Cura.ca', 'dcf4f24fe14a1c830879a0199f38f061', 'Luc, Mars', '2014-01-08 09:02:21', 1, NULL, 1),
(150, 't@Cu.com', '90cbe248eb1c7481c652989650cf493d', 'Dumont, Pierre', '2014-01-08 14:48:22', 0, NULL, 1),
(152, 'eget@ra.ca', '90cbe248eb1c7481c652989650cf493d', 'Duceppe, Jean', '2014-01-23 09:49:30', 0, NULL, 2),
(154, 't@u.com', '90cbe248eb1c7481c652989650cf493d', 'Renoir, Pierre', '2014-01-08 14:50:31', 0, NULL, 1),
(155, 't@ra.ca', '90cbe248eb1c7481c652989650cf493d', 'Roussel, Jean', '2014-01-08 14:50:31', 1, NULL, 1),
(237, 'e@e.com', '90cbe248eb1c7481c652989650cf493d', 'Groulx, Pierre', '2014-01-23 09:42:25', 1, NULL, 2),
(238, 'x@rx.ca', '90cbe248eb1c7481c652989650cf493d', 'Pagé, Jean', '2014-01-23 09:22:59', 0, NULL, 1),
(250, 'luis@luis.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Rosas, Luis', '2014-01-13 11:09:33', 0, NULL, 1),
(251, 'pi@pi.com', '061ccbb60489119026e6e87ebae1c731', 'Champagne, Luc', '2014-01-14 09:18:28', 0, NULL, 1),
(252, 'pi@pi.qc', '5f4dcc3b5aa765d61d8327deb882cf99', 'LeGrand, Pierre', '2014-01-14 09:21:01', 0, NULL, 1),
(254, 'pete@pete.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Béliveau, Pete', '2014-01-21 14:35:21', 0, NULL, 2),
(257, 'paul@paul.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Éluard, Paul', '2014-01-14 09:26:07', 0, NULL, 1),
(264, 'pa@pa.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Pot, Paul', '2014-01-21 14:20:26', 1, NULL, 2),
(265, 'b@b.ca', '5f4dcc3b5aa765d61d8327deb882cf99', 'Léponge, Bob', '2014-01-21 14:22:36', 0, NULL, 2),
(266, 'site@wadagbe.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Wadagbé Admin', '2014-01-22 13:19:31', 2, NULL, 1),
(267, 'test@test.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Ritchie, Guy', '2014-01-23 11:09:25', 0, NULL, 1);
