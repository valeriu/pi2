SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `e1295805`.`wa_pages`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_pages` (
  `id_page` INT NOT NULL AUTO_INCREMENT ,
  `titre` VARCHAR(250) NOT NULL ,
  `description_meta` VARCHAR(250) NULL ,
  `contenu` LONGTEXT NULL ,
  `date` DATETIME NOT NULL ,
  `statut` INT NOT NULL DEFAULT 0 COMMENT '0 - invisible\n1 - visible\n2 - supprimé' ,
  `long` FLOAT NULL ,
  `lat` FLOAT NULL ,
  PRIMARY KEY (`id_page`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_utilisateurs`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_utilisateurs` (
  `id_utilisateurs` INT NOT NULL ,
  `courriel` VARCHAR(200) NOT NULL ,
  `mot_passe` VARCHAR(64) NOT NULL ,
  `nom_prenom` VARCHAR(250) NOT NULL ,
  `date` DATETIME NOT NULL ,
  `role` INT NOT NULL DEFAULT 0 COMMENT '0 - users\n1 - administator\n2 - super administator' ,
  `cle_reactivation` INT NOT NULL ,
  `statut` INT NULL DEFAULT 1 COMMENT '1 - actif\n2 - supprimé' ,
  PRIMARY KEY (`id_utilisateurs`) ,
  UNIQUE INDEX `mail_UNIQUE` (`courriel` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_evaluation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_evaluation` (
  `id_evaluation` INT NOT NULL AUTO_INCREMENT ,
  `votes` INT NULL DEFAULT 0 ,
  `evaluation_total` INT NULL DEFAULT 0 ,
  PRIMARY KEY (`id_evaluation`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_categorie`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_categorie` (
  `id_categorie` INT NOT NULL AUTO_INCREMENT ,
  `nom` VARCHAR(250) NOT NULL ,
  PRIMARY KEY (`id_categorie`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_produits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_produits` (
  `id_produits` INT NOT NULL ,
  `nom` VARCHAR(250) NULL ,
  `prix` INT NULL ,
  `description` LONGTEXT NULL ,
  `specification` LONGTEXT NULL ,
  `image` VARCHAR(250) NULL ,
  `statut` INT NULL DEFAULT 1 COMMENT '0 - inactive\n1 - actif\n2 - supprimé' ,
  `type` INT NULL DEFAULT 0 COMMENT '0 - normale\n1 - nouveau\n2 - meilleure vente' ,
  `fournisseur` VARCHAR(250) NULL ,
  `iditem_fournisseur` VARCHAR(250) NULL ,
  `poids` FLOAT NULL ,
  `taille_longueur` FLOAT NULL ,
  `taille_largeur` FLOAT NULL ,
  `taille_hauteur` FLOAT NULL ,
  `evaluation_id_evaluation` INT NOT NULL ,
  `categorie_id_categorie` INT NOT NULL ,
  `puissance` INT NULL ,
  `voc` FLOAT NULL COMMENT 'voc -  la tension qui est présente lorsqu’il ne circule aucun courant' ,
  `vmp` FLOAT NULL COMMENT 'La tension Vmp (pour tension à puissance maximale)' ,
  `produitscol` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_produits`) ,
  INDEX `fk_produits_evaluation1_idx` (`evaluation_id_evaluation` ASC) ,
  INDEX `fk_produits_categorie1_idx` (`categorie_id_categorie` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_adresse`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_adresse` (
  `id_adresse` INT NOT NULL AUTO_INCREMENT ,
  `telephone` INT NOT NULL ,
  `rue` VARCHAR(45) NOT NULL ,
  `appartement` VARCHAR(45) NULL ,
  `ville` VARCHAR(45) NOT NULL ,
  `code_postal` VARCHAR(6) NOT NULL ,
  `province` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id_adresse`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_adresse_utilisateur`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_adresse_utilisateur` (
  `id_adresse_utilisateur` INT NOT NULL ,
  `adresse_id_adresse` INT NOT NULL ,
  `utilisateurs_id_utilisateurs` INT NOT NULL ,
  PRIMARY KEY (`id_adresse_utilisateur`) ,
  INDEX `fk_adresse_utilisateur_adresse1_idx` (`adresse_id_adresse` ASC) ,
  INDEX `fk_adresse_utilisateur_utilisateurs1_idx` (`utilisateurs_id_utilisateurs` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_commandes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_commandes` (
  `id_commandes` INT NOT NULL AUTO_INCREMENT ,
  `statut` INT NOT NULL DEFAULT 0 COMMENT '0 - en traitement\n1 - backorder\n2 - expedie' ,
  `commentaires` VARCHAR(250) NULL ,
  `adresse_utilisateur_id_adresse_utilisateur` INT NOT NULL ,
  `date` DATETIME NULL ,
  PRIMARY KEY (`id_commandes`) ,
  INDEX `fk_ordes_adresse_utilisateur1_idx` (`adresse_utilisateur_id_adresse_utilisateur` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_commande_produit`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_commande_produit` (
  `id_commande_produit` INT NOT NULL AUTO_INCREMENT ,
  `quantite` INT NOT NULL ,
  `produits_id_produits` INT NOT NULL ,
  `commandes_id_commandes` INT NOT NULL ,
  PRIMARY KEY (`id_commande_produit`) ,
  INDEX `fk_ordre_produit_produits1_idx` (`produits_id_produits` ASC) ,
  INDEX `fk_commande_produit_commandes1_idx` (`commandes_id_commandes` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `e1295805`.`wa_menu`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `e1295805`.`wa_menu` (
  `id_menu` INT NOT NULL AUTO_INCREMENT ,
  `titre` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(45) NULL ,
  `url` VARCHAR(45) NOT NULL ,
  `parent` INT NOT NULL DEFAULT 0 ,
  `order` INT NOT NULL ,
  `statut` INT NOT NULL DEFAULT 1 COMMENT '0 - invisible\n1 - visible\n2 - supprimé' ,
  PRIMARY KEY (`id_menu`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
