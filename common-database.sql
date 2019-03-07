-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 28 juil. 2018 à 12:22
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `common-database`
--
CREATE DATABASE IF NOT EXISTS `common-database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `common-database`;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `content_comment` varchar(140) DEFAULT NULL,
  `date_comment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_comment` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_comment`),
  KEY `fk_comment_user1_idx` (`id_user`),
  KEY `fk_comment_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `id_user`, `id_tweet`, `content_comment`, `date_comment`, `delete_comment`) VALUES
(1, 4, 38, 'test again #try #reponse', '2018-07-27 09:01:22', 0),
(2, 4, 33, 'fhdryrdhdrh #nimp', '2018-07-27 09:03:05', 0),
(3, 4, 38, 'recoucou #bonjour #salut', '2018-07-27 09:11:38', 0),
(4, 4, 38, 'rr(uy @Fleurena', '2018-07-27 09:22:14', 0),
(5, 4, 38, 'test', '2018-07-27 14:56:16', 0),
(6, 4, 38, 'Encore un test, désolé FLeur #test', '2018-07-27 14:57:58', 0),
(7, 4, 38, 'Encore un test, désolé FLeur #test', '2018-07-27 14:58:07', 0),
(8, 4, 38, 'Again... Attention #test #again', '2018-07-27 14:58:57', 0),
(9, 4, 1, 'test', '2018-07-27 16:19:40', 0),
(10, 4, 34, 'Test du coup.... #espoir', '2018-07-27 16:56:17', 0),
(11, 4, 34, 'Test du coup.... #espoir', '2018-07-27 16:56:38', 0),
(12, 4, 36, 'On dit Fleur @Fleurena #ortho', '2018-07-27 16:57:10', 0),
(13, 4, 38, 'test du coup', '2018-07-27 17:01:27', 0),
(14, 4, 27, 'fctryryryrydrydry', '2018-07-27 17:02:44', 0),
(15, 4, 37, 'Coucou ! #bonjour @Fleurena', '2018-07-27 17:07:51', 0),
(16, 4, 37, 'test again #try #reponse', '2018-07-28 11:43:28', 0),
(17, 4, 37, 'encore', '2018-07-28 11:43:54', 0),
(18, 4, 38, 'rtertert', '2018-07-28 11:45:42', 0),
(19, 4, 38, 'rtrtrt', '2018-07-28 11:45:50', 0),
(20, 4, 38, 'test', '2018-07-28 11:46:34', 0),
(21, 4, 38, 'test', '2018-07-28 11:46:42', 0),
(22, 4, 38, 'rzrgerg', '2018-07-28 11:47:26', 0),
(23, 4, 38, 'rfggrg', '2018-07-28 11:48:10', 0),
(24, 4, 38, 'truc', '2018-07-28 11:53:08', 0),
(25, 4, 38, 'test', '2018-07-28 11:54:45', 0),
(26, 4, 37, 'test', '2018-07-28 12:22:12', 0),
(27, 4, 36, 'test', '2018-07-28 12:22:19', 0);

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `id_followed` int(11) NOT NULL,
  `id_follower` int(11) NOT NULL,
  `status_follow` tinyint(5) NOT NULL DEFAULT '1',
  KEY `fk_follow_user2_idx` (`id_follower`),
  KEY `fk_follow_user1_idx` (`id_followed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id_followed`, `id_follower`, `status_follow`) VALUES
(3, 4, 1),
(4, 4, 0),
(2, 4, 0),
(17, 4, 0),
(15, 4, 0),
(4, 3, 1),
(4, 2, 0),
(8, 4, 1),
(11, 4, 1),
(7, 4, 1),
(7, 3, 1),
(14, 4, 1),
(3, 22, 1),
(3, 26, 1),
(3, 2, 1),
(8, 2, 1),
(10, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

DROP TABLE IF EXISTS `hashtag`;
CREATE TABLE IF NOT EXISTS `hashtag` (
  `id_hashtag` int(11) NOT NULL AUTO_INCREMENT,
  `name_hashtag` varchar(255) NOT NULL,
  PRIMARY KEY (`id_hashtag`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `hashtag`
--

INSERT INTO `hashtag` (`id_hashtag`, `name_hashtag`) VALUES
(1, '#wac'),
(2, '#bonjour'),
(3, '#joie'),
(4, '#test'),
(5, '#fleurquiladit'),
(6, '#try'),
(7, '#croiselesdoigts'),
(8, '#nimp'),
(9, '#gogogo'),
(10, '#oubli'),
(11, '#pull'),
(12, '#love'),
(13, '#mdp'),
(14, '#holala'),
(15, '#pascompris'),
(16, '#tweet'),
(17, '#encore'),
(18, '#repondre'),
(19, '#reponse'),
(20, '#salut'),
(21, '#again'),
(22, '#espoir'),
(23, '#ortho'),
(24, '#papa');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_like` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `status_like` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_like`),
  KEY `fk_like_user1_idx` (`id_user`),
  KEY `fk_like_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`id_like`, `id_user`, `id_tweet`, `status_like`) VALUES
(1, 2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id_media` int(11) NOT NULL AUTO_INCREMENT,
  `id_tweet` int(11) NOT NULL,
  `name_media` varchar(255) DEFAULT NULL,
  `file_media` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_media`),
  KEY `fk_media_tweet_idx` (`id_tweet`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_sender` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `content_message` text,
  `date_message` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_message` tinyint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_message`),
  KEY `fk_message_user1_idx` (`id_sender`),
  KEY `fk_message_user2_idx` (`id_receiver`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `id_sender`, `id_receiver`, `content_message`, `date_message`, `delete_message`) VALUES
(1, 4, 2, 'coucou', '2018-07-26 11:27:20', 0),
(2, 4, 2, 'coucou', '2018-07-26 11:47:50', 0),
(3, 4, 2, 'NON MAIS ALORS', '2018-07-26 11:47:58', 0),
(4, 4, 2, 'NON MAIS ALORS', '2018-07-26 11:48:30', 0),
(5, 4, 2, 'coucou', '2018-07-26 11:48:48', 0),
(6, 4, 2, 'gjrrjkt;j;jf', '2018-07-26 11:49:03', 0),
(7, 4, 2, 'gjrrjkt;j;jf', '2018-07-26 11:50:37', 0),
(8, 4, 2, 'Et donc ?', '2018-07-27 17:11:02', 0),
(9, 4, 2, 'nn', '2018-07-27 17:19:31', 0),
(10, 4, 3, 'bonjour', '2018-07-27 17:19:41', 0),
(11, 4, 3, 'truc', '2018-07-27 17:19:44', 0),
(12, 4, 3, 'yyu', '2018-07-27 17:19:51', 0),
(13, 4, 2, 'tranquillou', '2018-07-27 17:41:05', 0),
(14, 4, 2, 'je t\'énerve ', '2018-07-28 11:33:47', 0),
(15, 4, 2, 'ok', '2018-07-28 12:46:14', 0);

-- --------------------------------------------------------

--
-- Structure de la table `retweet`
--

DROP TABLE IF EXISTS `retweet`;
CREATE TABLE IF NOT EXISTS `retweet` (
  `id_retweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_tweet` int(11) NOT NULL,
  `date_retweet` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_retweet` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_retweet`),
  KEY `fk_retweet_user1_idx` (`id_user`),
  KEY `fk_retweet_tweet1_idx` (`id_tweet`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `retweet`
--

INSERT INTO `retweet` (`id_retweet`, `id_user`, `id_tweet`, `date_retweet`, `delete_retweet`) VALUES
(1, 2, 4, '2018-07-18 14:47:21', 1),
(2, 4, 38, '2018-07-28 10:29:08', 1),
(3, 4, 38, '2018-07-28 10:37:57', 1),
(4, 4, 38, '2018-07-28 10:37:57', 1),
(5, 4, 33, '2018-07-28 10:38:50', 1),
(6, 4, 32, '2018-07-28 10:38:51', 1),
(7, 4, 30, '2018-07-28 10:38:52', 1),
(8, 4, 30, '2018-07-28 10:38:53', 1),
(9, 4, 29, '2018-07-28 10:38:53', 1),
(10, 4, 28, '2018-07-28 10:38:54', 1),
(11, 4, 34, '2018-07-28 10:39:21', 1),
(12, 4, 38, '2018-07-28 11:00:09', 1),
(13, 4, 38, '2018-07-28 11:11:53', 1),
(14, 4, 38, '2018-07-28 11:24:59', 1),
(15, 4, 38, '2018-07-28 11:25:38', 1),
(16, 4, 38, '2018-07-28 11:25:38', 1),
(17, 4, 38, '2018-07-28 11:25:41', 1),
(18, 4, 38, '2018-07-28 11:25:42', 1),
(19, 4, 38, '2018-07-28 11:25:47', 1),
(20, 4, 38, '2018-07-28 11:25:50', 1),
(21, 4, 38, '2018-07-28 11:25:52', 1),
(22, 4, 38, '2018-07-28 11:25:53', 1),
(23, 4, 38, '2018-07-28 11:25:54', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

DROP TABLE IF EXISTS `tweet`;
CREATE TABLE IF NOT EXISTS `tweet` (
  `id_tweet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `content_tweet` varchar(140) DEFAULT NULL,
  `date_tweet` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_tweet` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_tweet`),
  KEY `fk_tweet_user1_idx` (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tweet`
--

INSERT INTO `tweet` (`id_tweet`, `id_user`, `content_tweet`, `date_tweet`, `delete_tweet`) VALUES
(1, 1, 'Salut les gens !', '2018-07-18 13:40:10', 1),
(2, 2, 'waaaaah, trop fort', '2018-07-18 13:41:12', 1),
(3, 1, 't as vu ça !!', '2018-07-18 13:41:17', 1),
(4, 3, 'les mecs oubliés pas les hashtag', '2018-07-18 13:41:59', 1),
(5, 4, 'Salut à tous les amis #wac #bonjour', '2018-07-18 14:12:08', 1),
(6, 4, 'bonjour du vendredi #bonjour', '2018-07-20 11:06:31', 1),
(7, 4, 'youpi ça marche #joie', '2018-07-20 11:07:44', 1),
(8, 4, '', '2018-07-20 13:12:47', 1),
(9, 4, 'petit test #test', '2018-07-20 14:08:52', 1),
(10, 4, 'encore un test #test', '2018-07-20 14:16:38', 1),
(11, 4, 'coucou Fleurina #bonjour', '2018-07-20 14:23:02', 1),
(12, 4, 'Dylan doit tweeter #fleurquiladit', '2018-07-20 14:58:05', 1),
(13, 4, 'Test de nouveau tweet #test #try #croiselesdoigts', '2018-07-20 15:19:24', 1),
(14, 4, 'yuyuuuuuuy #nimp', '2018-07-20 15:19:42', 1),
(15, 4, 'Test de nouveau tweet #test #try #croiselesdoigts', '2018-07-20 16:57:05', 1),
(16, 4, 'cae7eff7 #test', '2018-07-20 17:10:54', 1),
(17, 4, 'et une nouvelle semaine commence ! #gogogo', '2018-07-23 09:27:46', 1),
(18, 4, 'oups, j\'ai pas mis de é ou de à ou de ç bon bah voila #oubli', '2018-07-23 09:28:21', 1),
(19, 3, 'c\'est la wac que j\'préfère c\'est la wac #wac', '2018-07-23 13:25:48', 1),
(20, 3, 'efficace et pas cher #wac', '2018-07-23 13:26:05', 1),
(21, 4, 'Fleur a push... #pull', '2018-07-23 14:59:31', 1),
(22, 18, 'Dylan c\'est le meilleur #love', '2018-07-23 17:14:39', 1),
(23, 3, 'le mdp pour pas l\'oublier : titecrevettedu69 #mdp', '2018-07-23 17:15:05', 1),
(24, 2, 'Oula ! Mais c\'est pas sécrure ça ! #holala', '2018-07-23 17:15:24', 1),
(25, 4, 'wat pourquoi mon nom magnifuque de Jérôme bug #pascompris', '2018-07-23 17:26:31', 1),
(26, 2, 'Je tweete #tweet', '2018-07-23 17:45:52', 1),
(27, 2, 'Et retweet #tweet', '2018-07-23 17:45:57', 1),
(28, 4, 'Un petit tweet pour taguer @Dylan', '2018-07-26 07:43:56', 1),
(29, 4, 'Un autre tweet pour montrer à @Dylan', '2018-07-26 08:14:11', 1),
(30, 4, 'je fais un autre test #test #try', '2018-07-26 08:43:39', 1),
(31, 4, 'A nouveau', '2018-07-26 08:48:54', 1),
(32, 4, 'Attends quoi #pascompris #try', '2018-07-26 08:49:05', 1),
(33, 4, 'A nouveau try #test #try', '2018-07-26 08:53:42', 1),
(34, 4, 'ENcore un nouveau.... #test #encore', '2018-07-26 08:55:01', 1),
(35, 4, 'Et encore un.... #test #encore', '2018-07-26 08:55:41', 1),
(36, 4, 'coucou flu', '2018-07-26 11:01:13', 1),
(37, 4, 'Coucou Fleur #bonjour @Fleurena', '2018-07-26 11:01:32', 1),
(38, 4, 'Recoucou Fleur @Fleurena #bonjour', '2018-07-26 11:04:53', 1),
(39, 22, 'bonjour test #try', '2018-07-28 12:34:57', 1),
(40, 26, 'Papa où es-tu ? #papa', '2018-07-28 13:15:28', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tweet_to_tag`
--

DROP TABLE IF EXISTS `tweet_to_tag`;
CREATE TABLE IF NOT EXISTS `tweet_to_tag` (
  `id_tweet` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `status_ttt` int(11) NOT NULL DEFAULT '1',
  KEY `id_tweet` (`id_tweet`),
  KEY `id_tag` (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tweet_to_tag`
--

INSERT INTO `tweet_to_tag` (`id_tweet`, `id_tag`, `status_ttt`) VALUES
(5, 1, 1),
(5, 2, 1),
(6, 2, 1),
(7, 3, 1),
(9, 4, 1),
(10, 4, 1),
(11, 2, 1),
(12, 5, 1),
(13, 4, 1),
(13, 6, 1),
(13, 7, 1),
(14, 8, 1),
(15, 4, 1),
(15, 6, 1),
(15, 7, 1),
(16, 4, 1),
(17, 9, 1),
(18, 10, 1),
(19, 1, 1),
(20, 1, 1),
(21, 11, 1),
(22, 12, 1),
(23, 13, 1),
(24, 14, 1),
(25, 15, 1),
(26, 16, 1),
(27, 16, 1),
(30, 4, 1),
(30, 6, 1),
(32, 15, 1),
(32, 6, 1),
(33, 4, 1),
(33, 6, 1),
(34, 4, 1),
(34, 17, 1),
(35, 4, 1),
(35, 17, 1),
(37, 2, 1),
(38, 2, 1),
(38, 6, 1),
(38, 18, 1),
(38, 6, 1),
(38, 18, 1),
(38, 6, 1),
(38, 19, 1),
(38, 6, 1),
(38, 19, 1),
(38, 8, 1),
(38, 2, 1),
(38, 20, 1),
(38, 4, 1),
(38, 4, 1),
(38, 4, 1),
(38, 21, 1),
(38, 4, 1),
(38, 22, 1),
(38, 22, 1),
(38, 23, 1),
(38, 2, 1),
(38, 6, 1),
(38, 19, 1),
(39, 6, 1),
(40, 24, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `theme` varchar(255) NOT NULL DEFAULT '#1da1f2',
  `register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `username`, `email`, `firstname`, `lastname`, `password`, `avatar`, `theme`, `register_date`, `status`) VALUES
(1, 'admin', 'admin@mail.com', 'Oscar', 'Admin', 'wololo', NULL, '29, 161, 242', '2018-07-16 17:29:22', 1),
(2, 'Fleurena', 'fleur.fradetal@epitech.eu', 'Fleur', 'Fradetal', 'HXŠ!töGVbL7 Q›', NULL, '29, 161, 242', '2018-07-17 14:59:21', 1),
(3, 'Dylan', 'dylan1.lobjois@epitech.eu', 'Dylan', 'Lobjois', 'Ø‘=ó{$É(ø@M½\r».D', NULL, '29, 161, 242', '2018-07-17 15:01:52', 1),
(4, 'Jerome', 'jerome.cyrus@epitech.eu', 'JÃ©rÃ´me', 'Cyrus', 's¨?øÒþ7\n).e:)2V˜§k', NULL, '29, 161, 242', '2018-07-17 15:39:29', 1),
(5, 'Jojo', 'petitjo@mail.com', 'Jo', 'Gaga', 'íxpF	kÑh0È£\'[\"éŠC&', NULL, '29, 161, 242', '2018-07-18 09:40:36', 1),
(6, 'Tangouille', 'tanguy@mail.fr', 'Tanguy', 'Guy', '}—ŸX€Ã}Õ^\nÜØôÃÜSƒ', NULL, '29, 161, 242', '2018-07-18 13:23:56', 1),
(7, 'Romano', 'romain@mail.fr', 'Romain', 'Leduc', 'x‹§4i_;æñ¬_¾¯Ä¥µX;', NULL, '29, 161, 242', '2018-07-18 13:24:25', 1),
(8, 'Onmahdi', 'mahdi@mail.fr', 'Mahdi', 'Camara', '®¼«O€KÓ:‚=¤Vz°ä€”Ûù', NULL, '29, 161, 242', '2018-07-18 13:25:27', 1),
(9, 'Emulsifiant', 'emumu@mail.fr', 'Sifiant', 'Emul', '!ØÚKQrÈ”×üÞ®`}siV', NULL, '29, 161, 242', '2018-07-18 13:29:47', 1),
(10, 'Bartouille', 'bartsim@mail.com', 'Bart', 'Simpsons', '•tJþ›ÎuÑ/*G‡$”	ÆW¯', NULL, '29, 161, 242', '2018-07-18 13:30:32', 1),
(11, 'Homer', 'homer@mail.com', 'Homer', 'Simpsons', '|Ý¾”_:†ô??š?ìƒº)’„', NULL, '29, 161, 242', '2018-07-18 13:31:03', 1),
(12, 'Leke', 'leke@mail.com', 'Leke', 'Thornard', '—wæ^gø£Òè?§Ó*ôàA‘', NULL, '29, 161, 242', '2018-07-18 13:35:11', 1),
(13, 'admine', 'admineuh@mail.com', 'admine', 'Oscare', 'mŸTúÃ²ÝB¬xÓ¤ùÊ œZFÆø', NULL, '29, 161, 242', '2018-07-18 13:36:02', 1),
(14, 'Mumu', 'myex@mail.com', 'Atime', 'Onceupon', '—{´´B‡íÞébze—™E¹', NULL, '29, 161, 242', '2018-07-18 13:36:43', 1),
(15, 'Dydy', 'dylo@mail.fr', 'Lolo', 'Dydy', 'ÈÁ¾\Z ‹@DFFþbu»éÞ', NULL, '29, 161, 242', '2018-07-18 13:38:01', 1),
(16, 'Hello', 'mailbidon@mail.fr', 'un test', 'ceci est', '^Rþä~ke÷CrFŒÜiè‘', NULL, '29, 161, 242', '2018-07-19 10:00:21', 1),
(17, 'Dylanbeaugosse', 'zefzef@mail.fr', 'efefef', 'efefz', 'Ø‘=ó{$É(ø@M½\r».D', NULL, '29, 161, 242', '2018-07-23 13:43:47', 1),
(18, 'Bubew', 'bubew@hotmail.fr', 'Joelle', 'Derderian', 'ßßŠÕÅ‚ÈÑ™cækð÷œ’‰×', NULL, '29, 161, 242', '2018-07-23 17:14:17', 1),
(19, 'Julia', 'juju@mail.fr', 'reberbebr', 'vzevzv', 's¨?øÒþ7\n).e:)2V˜§k', NULL, '#1da1f2', '2018-07-28 11:50:57', 1),
(20, 'rgerrgrg', 'rgrgergerg@mail.fr', '', '', '\Zÿâ¸S*9Sª\\¨­|¶32', NULL, '#1da1f2', '2018-07-28 12:06:22', 1),
(21, 'vzrv', 'rvrvre@maoil.fr', '', '', 'óÿÂÁy@$±D|”,òj`ígYÈ', NULL, '#1da1f2', '2018-07-28 12:10:48', 1),
(22, 'dvsvdsdvsdv', 'julia@mail.fr', '', '', 'óÿÂÁy@$±D|”,òj`ígYÈ', NULL, '29, 161, 242', '2018-07-28 12:19:31', 1),
(23, 'Coucou', 'pouet@mail.com', 'coucou', 'test', 's¨?øÒþ7\n).e:)2V˜§k', NULL, '#1da1f2', '2018-07-28 13:05:38', 1),
(24, 'recoucou', 'aze@mail.fr', 'zrgerbzgb', 'fzezev', 'Ã_WÜÇ{~-1rø„ï)Ë’{#', NULL, '#1da1f2', '2018-07-28 13:06:39', 1),
(25, 'encore', 'test@mail.fr', 'gain', 'rtest', '^Rþä~ke÷CrFŒÜiè‘', NULL, '#1da1f2', '2018-07-28 13:10:55', 1),
(26, 'Luc', 'luc@starwars.com', 'Skywalker', 'Luc', '€aŽ”ßrSÉ¥ãêva†žŽí0', NULL, '#1da1f2', '2018-07-28 13:14:47', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
