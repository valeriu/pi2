-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 17 Janvier 2014 à 14:53
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.3-7+squeeze15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `e1295805`
--

-- --------------------------------------------------------

--
-- Structure de la table `wa_adresse`
--

CREATE TABLE IF NOT EXISTS `wa_adresse` (
  `id_adresse` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` varchar(10) NOT NULL DEFAULT '0',
  `rue` varchar(45) NOT NULL,
  `appartement` varchar(45) DEFAULT NULL,
  `ville` varchar(45) NOT NULL,
  `code_postal` varchar(6) NOT NULL,
  `province` varchar(45) NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=150 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_adresse_utilisateur`
--

CREATE TABLE IF NOT EXISTS `wa_adresse_utilisateur` (
  `id_adresse_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `adresse_id_adresse` int(11) NOT NULL,
  `utilisateurs_id_utilisateurs` int(11) NOT NULL,
  PRIMARY KEY (`id_adresse_utilisateur`),
  KEY `fk_adresse_utilisateur_adresse1_idx` (`adresse_id_adresse`),
  KEY `fk_adresse_utilisateur_utilisateurs1_idx` (`utilisateurs_id_utilisateurs`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=141 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_categorie`
--

CREATE TABLE IF NOT EXISTS `wa_categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_commandes`
--

CREATE TABLE IF NOT EXISTS `wa_commandes` (
  `id_commandes` int(11) NOT NULL AUTO_INCREMENT,
  `statut` int(11) NOT NULL DEFAULT '0' COMMENT '0 - en traitement1 - backorder 2 - expedie 3 - anulle',
  `commentaires` varchar(2500) DEFAULT NULL,
  `adresse_utilisateur_id_adresse_utilisateur` int(11) NOT NULL,
  `date_commande` datetime DEFAULT NULL,
  `utilisateurs_id_utilisateurs` int(11) NOT NULL,
  `total_commande` decimal(11,2) NOT NULL,
  PRIMARY KEY (`id_commandes`),
  KEY `fk_ordes_adresse_utilisateur1_idx` (`adresse_utilisateur_id_adresse_utilisateur`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_commande_produit`
--

CREATE TABLE IF NOT EXISTS `wa_commande_produit` (
  `id_commande_produit` int(11) NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `produits_id_produits` int(11) NOT NULL,
  `commandes_id_commandes` int(11) NOT NULL,
  PRIMARY KEY (`id_commande_produit`),
  KEY `fk_ordre_produit_produits1_idx` (`produits_id_produits`),
  KEY `fk_commande_produit_commandes1_idx` (`commandes_id_commandes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=186 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_evaluation`
--

CREATE TABLE IF NOT EXISTS `wa_evaluation` (
  `id_evaluation` int(11) NOT NULL AUTO_INCREMENT,
  `votes` int(11) DEFAULT '0',
  `evaluation_total` int(11) DEFAULT '0',
  PRIMARY KEY (`id_evaluation`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_menu`
--

CREATE TABLE IF NOT EXISTS `wa_menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `ordre` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT '1' COMMENT '0 - invisible\n1 - visible\n2 - supprimé',
  PRIMARY KEY (`id_menu`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_pages`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=208 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_produits`
--

CREATE TABLE IF NOT EXISTS `wa_produits` (
  `id_produits` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  `description` longtext,
  `specification` longtext,
  `image` varchar(250) DEFAULT NULL,
  `statut` int(11) DEFAULT '1' COMMENT '0 - inactive\n1 - actif\n2 - supprimé',
  `type` int(11) DEFAULT '0' COMMENT '0 - normale\n1 - nouveau\n2 - meilleure vente',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Structure de la table `wa_utilisateurs`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=265 ;
