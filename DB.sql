SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
--
-- Structure de la table `user`
--
CREATE TABLE IF NOT EXISTS user (
  `ID` INT(255) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY `ID` (`ID`)
) ENGINE=InnoDB;

--
-- Structure de la table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `ID` INT(255) unsigned NOT NULL AUTO_INCREMENT,
  `DATE` DATE NOT NULL,
  `content` MEDIUMTEXT NOT NULL,
  `userID` INT(255) unsigned NOT NULL,
  PRIMARY KEY `ID` (`ID`),
	FOREIGN KEY (`userID`) REFERENCES `user`(`ID`)
) ENGINE=InnoDB;