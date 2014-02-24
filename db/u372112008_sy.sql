
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2013 at 06:47 PM
-- Server version: 5.1.66
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u372112008_sy`
--

-- --------------------------------------------------------

--
-- Table structure for table `antonyms`
--

CREATE TABLE IF NOT EXISTS `antonyms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word_meanings_id1` int(11) NOT NULL DEFAULT '0',
  `word_meanings_id2` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `word_meanings_id1` (`word_meanings_id1`),
  UNIQUE KEY `word_meanings_id2` (`word_meanings_id2`),
  KEY `word_meanings_id1_id2` (`word_meanings_id1`,`word_meanings_id2`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `antonyms`
--

INSERT INTO `antonyms` (`id`, `word_meanings_id1`, `word_meanings_id2`) VALUES
(1, 9367, 12225),
(2, 12676, 26152);

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authassignment`
--

INSERT INTO `authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('add_post', '0', 'return 3==$params[''value''];', 'N;'),
('add_post', '16813', 'return 3==$params[''value''];', 'N;'),
('add_post', '16816', 'return 3==$params[''value''];', 'N;'),
('admin', '0', '', 'N;'),
('admin', '1', NULL, 'N;'),
('admin', '118', NULL, 'N;'),
('admin', '16814', '', 'N;'),
('admin', '16819', NULL, 'N;'),
('admin', '92', NULL, 'N;'),
('guest', '100', NULL, 'N;'),
('guest', '115', NULL, 'N;'),
('guest', '58', NULL, 'N;'),
('guest', '71', NULL, 'N;'),
('guest', '72', NULL, 'N;'),
('guest', '79', NULL, 'N;'),
('guest', '84', NULL, 'N;'),
('guest', '90', NULL, 'N;'),
('manage_posts', '0', '', 'N;'),
('manage_posts', '16813', '', 'N;'),
('member', '16824', NULL, 'N;'),
('moderators', '0', '', 'N;'),
('moderators', '16813', '', 'N;'),
('moderators', '5', '', 'N;'),
('quest', '1', NULL, 'N;'),
('user', '0', '', 'N;'),
('user', '102', NULL, 'N;'),
('user', '105', NULL, 'N;'),
('user', '106', NULL, 'N;'),
('user', '108', NULL, 'N;'),
('user', '109', NULL, 'N;'),
('user', '113', NULL, 'N;'),
('user', '119', NULL, 'N;'),
('user', '120', NULL, 'N;'),
('user', '121', NULL, 'N;'),
('user', '122', NULL, 'N;'),
('user', '125', NULL, 'N;'),
('user', '128', NULL, 'N;'),
('user', '135', NULL, 'N;'),
('user', '143', NULL, 'N;'),
('User', '16', NULL, 'N;'),
('user', '16813', '', 'N;'),
('User', '17', NULL, 'N;'),
('User', '29', NULL, 'N;'),
('user', '30', NULL, 'N;'),
('user', '31', NULL, 'N;'),
('user', '34', NULL, 'N;'),
('user', '35', NULL, 'N;'),
('user', '4', NULL, 'N;'),
('user', '57', NULL, 'N;'),
('user', '58', NULL, 'N;'),
('user', '59', NULL, 'N;'),
('user', '61', NULL, 'N;'),
('user', '65', NULL, 'N;'),
('user', '67', NULL, 'N;'),
('user', '68', NULL, 'N;'),
('user', '69', NULL, 'N;'),
('user', '74', NULL, 'N;'),
('user', '80', NULL, 'N;'),
('user', '81', NULL, 'N;'),
('user', '82', NULL, 'N;'),
('user', '85', NULL, 'N;'),
('user', '86', NULL, 'N;'),
('user', '87', NULL, 'N;'),
('user', '89', NULL, 'N;'),
('user', '91', NULL, 'N;'),
('user', '92', NULL, 'N;'),
('user', '94', NULL, 'N;'),
('user', '95', NULL, 'N;'),
('user', '97', NULL, 'N;'),
('user', '98', NULL, 'N;'),
('user1', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, 'System Administrator', '', 'N;'),
('editor', 2, 'Site Editor', '', 'N;'),
('guest', 2, 'Site Guest', '', 'N;'),
('member', 2, 'Site Member', 'return !Yii::app()->user->isGuest;', 'N;'),
('op_acp_access', 0, 'Admin: Enter The Admin Control Panel', '', 'N;'),
('op_blog_addcats', 0, 'Blog: Add Categories', '', 'N;'),
('op_blog_addposts', 0, 'Blog: Add Posts', '', 'N;'),
('op_blog_comments', 0, 'Blog: Manage Comments', '', 'N;'),
('op_blog_deletecats', 0, 'Blog: Delete Categories', '', 'N;'),
('op_blog_deletecomments', 0, 'Blog: Delete Comments', '', 'N;'),
('op_blog_deleteposts', 0, 'Blog: Delete Posts', '', 'N;'),
('op_blog_editcats', 0, 'Blog: Edit Categories', '', 'N;'),
('op_blog_editposts', 0, 'Blog: Edit Posts', '', 'N;'),
('op_blog_manage', 0, 'Blog: Manage Posts', '', 'N;'),
('op_blog_managecats', 0, 'Blog: Manage Categories', '', 'N;'),
('op_custompages_addpages', 0, 'Custom Pages: Add New Pages', '', 'N;'),
('op_custompages_deletepages', 0, 'Custom Pages: Delete Pages', '', 'N;'),
('op_custompages_editpages', 0, 'Custom Pages: Edit Pages', '', 'N;'),
('op_custompages_managepages', 0, 'Custom Pages: Manage Pages', '', 'N;'),
('op_doc_add_comments', 0, 'Documentations: Add Comments', '', 'N;'),
('op_doc_delete_comments', 0, 'Documentations: Delete Comments', '', 'N;'),
('op_doc_edit_docs', 0, 'Documentations: Edit Topics', '', 'N;'),
('op_doc_manage_comments', 0, 'Documentations: Manage Comments', '', 'N;'),
('op_extensions_addcats', 0, 'Extensions: Add Categories', '', 'N;'),
('op_extensions_addposts', 0, 'Extensions: Add Extensions', '', 'N;'),
('op_extensions_comments', 0, 'Extensions: Manage Comments', '', 'N;'),
('op_extensions_deletecats', 0, 'Extensions: Delete Categories', '', 'N;'),
('op_extensions_deletecomments', 0, 'Extensions: Delete Comments', '', 'N;'),
('op_extensions_deleteposts', 0, 'Extensions: Delete Extension', '', 'N;'),
('op_extensions_editcats', 0, 'Extensions: Edit Categories', '', 'N;'),
('op_extensions_editposts', 0, 'Extensions: Edit Extensions', '', 'N;'),
('op_extensions_manage', 0, 'Extensions: Manage Posts', '', 'N;'),
('op_extensions_managecats', 0, 'Extensions: Manage Categories', '', 'N;'),
('op_forum_posts', 0, 'Forum: Manage Forum Posts', '', 'N;'),
('op_forum_post_posts', 0, 'Forum: Post New Posts', '', 'N;'),
('op_forum_post_topics', 0, 'Forum: Post New Topics', '', 'N;'),
('op_forum_topics', 0, 'Forum: Manage Forum Topics', '', 'N;'),
('op_lang_copy_strings', 0, 'Languages: Copy Source Language Strings', '', 'N;'),
('op_lang_translate', 0, 'Languages: Translate Strings', '', 'N;'),
('op_roles_add_auth', 0, 'Roles: Add Auth Items', '', 'N;'),
('op_roles_add_authchild', 0, 'Roles: Add Auth Items Childs', '', 'N;'),
('op_roles_delete_auth', 0, 'Roles: Delete Auth Items', '', 'N;'),
('op_roles_edit_auth', 0, 'Roles: Edit Auth Items', '', 'N;'),
('op_settings_add_settings', 0, 'Settings: Add New Settings', '', 'N;'),
('op_settings_add_settings_groups', 0, 'Settings: Add Setting Groups', '', 'N;'),
('op_settings_delete_settings', 0, 'Settings: Delete Settings', '', 'N;'),
('op_settings_delete_settings_groups', 0, 'Settings: Delete Setting Groups', '', 'N;'),
('op_settings_edit_settings', 0, 'Settings: Edit Settings', '', 'N;'),
('op_settings_edit_settings_groups', 0, 'Settings: Edit Setting Groups', '', 'N;'),
('op_settings_revert_settings', 0, 'Settings: Revert Settings', '', 'N;'),
('op_settings_update_settings', 0, 'Settings: Update Settings', '', 'N;'),
('op_settings_view_settings', 0, 'Settings: View Settings', '', 'N;'),
('op_tutorials_addcats', 0, 'Tutorials: Add Categories', '', 'N;'),
('op_tutorials_addtutorials', 0, 'Tutorials: Add Tutorials', '', 'N;'),
('op_tutorials_comments', 0, 'Tutorials: Manage Comments', '', 'N;'),
('op_tutorials_deletecats', 0, 'Tutorials: Delete Categories', '', 'N;'),
('op_tutorials_deletecomments', 0, 'Tutorials: Delete Comments', '', 'N;'),
('op_tutorials_deletetutorials', 0, 'Tutorials: Delete Tutorials', '', 'N;'),
('op_tutorials_editcats', 0, 'Tutorials: Edit Categories', '', 'N;'),
('op_tutorials_edittutorials', 0, 'Tutorials: Edit Tutorials', '', 'N;'),
('op_tutorials_manage', 0, 'Tutorials: Manage Tutorials', '', 'N;'),
('op_tutorials_managecats', 0, 'Tutorials: Manage Categories', '', 'N;'),
('op_users_add_users', 0, 'Users: Add New Users', '', 'N;'),
('op_users_bulk_users', 0, 'Users: Perform Bulk Operations On Users', '', 'N;'),
('op_users_comment', 0, 'Users: Add Comments to profiles', '', 'N;'),
('op_users_delete_users', 0, 'Users: Delete Users', '', 'N;'),
('op_users_edit_users', 0, 'Users: Edit Users', '', 'N;'),
('op_users_manage_comments', 0, 'Users: Manage Comments', '', 'N;'),
('task_blog', 1, 'Task Manage Blog', '', 'N;'),
('task_custompages', 1, 'Task Manage Custom Pages', '', 'N;'),
('task_documentations', 1, 'Task Manage Documentations', '', 'N;'),
('task_extensions', 1, 'Task Manage Extensions', '', 'N;'),
('task_forum', 1, 'Task: Manage Forum', '', 'N;'),
('task_languages', 1, 'Task Manage System Languages', '', 'N;'),
('task_members', 1, 'Task Manage Users', '', 'N;'),
('task_roles', 1, 'Task Manage User Roles', '', 'N;'),
('task_settings', 1, 'Task Manage System Setting', '', 'N;'),
('task_tutorials', 1, 'Task Manage Tutorials', '', 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('admin', 'editor'),
('admin', 'guest'),
('admin', 'member'),
('admin', 'op_acp_access'),
('admin', 'op_blog_addcats'),
('admin', 'op_blog_addposts'),
('admin', 'op_blog_comments'),
('admin', 'op_blog_deletecats'),
('admin', 'op_blog_deletecomments'),
('admin', 'op_blog_deleteposts'),
('admin', 'op_blog_editcats'),
('admin', 'op_blog_editposts'),
('admin', 'op_blog_manage'),
('admin', 'op_blog_managecats'),
('admin', 'op_custompages_addpages'),
('admin', 'op_custompages_deletepages'),
('admin', 'op_custompages_editpages'),
('admin', 'op_custompages_managepages'),
('admin', 'op_doc_add_comments'),
('admin', 'op_doc_delete_comments'),
('admin', 'op_doc_edit_docs'),
('admin', 'op_doc_manage_comments'),
('admin', 'op_extensions_addcats'),
('admin', 'op_extensions_addposts'),
('admin', 'op_extensions_comments'),
('admin', 'op_extensions_deletecats'),
('admin', 'op_extensions_deletecomments'),
('admin', 'op_extensions_deleteposts'),
('admin', 'op_extensions_editcats'),
('admin', 'op_extensions_editposts'),
('admin', 'op_extensions_manage'),
('admin', 'op_extensions_managecats'),
('admin', 'op_forum_posts'),
('admin', 'op_forum_post_posts'),
('admin', 'op_forum_post_topics'),
('admin', 'op_forum_topics'),
('admin', 'op_lang_copy_strings'),
('admin', 'op_lang_translate'),
('admin', 'op_roles_add_auth'),
('admin', 'op_roles_add_authchild'),
('admin', 'op_roles_delete_auth'),
('admin', 'op_roles_edit_auth'),
('admin', 'op_settings_add_settings'),
('admin', 'op_settings_add_settings_groups'),
('admin', 'op_settings_delete_settings'),
('admin', 'op_settings_delete_settings_groups'),
('admin', 'op_settings_edit_settings'),
('admin', 'op_settings_edit_settings_groups'),
('admin', 'op_settings_revert_settings'),
('admin', 'op_settings_update_settings'),
('admin', 'op_settings_view_settings'),
('admin', 'op_tutorials_addcats'),
('admin', 'op_tutorials_addtutorials'),
('admin', 'op_tutorials_comments'),
('admin', 'op_tutorials_deletecats'),
('admin', 'op_tutorials_deletecomments'),
('admin', 'op_tutorials_deletetutorials'),
('admin', 'op_tutorials_editcats'),
('admin', 'op_tutorials_edittutorials'),
('admin', 'op_tutorials_manage'),
('admin', 'op_tutorials_managecats'),
('admin', 'op_users_add_users'),
('admin', 'op_users_bulk_users'),
('admin', 'op_users_comment'),
('admin', 'op_users_delete_users'),
('admin', 'op_users_edit_users'),
('admin', 'op_users_manage_comments'),
('admin', 'task_blog'),
('admin', 'task_custompages'),
('admin', 'task_documentations'),
('admin', 'task_extensions'),
('admin', 'task_forum'),
('admin', 'task_languages'),
('admin', 'task_members'),
('admin', 'task_roles'),
('admin', 'task_settings'),
('admin', 'task_tutorials'),
('editor', 'member'),
('editor', 'op_doc_add_comments'),
('editor', 'op_doc_manage_comments'),
('manage_posts', 'add_post'),
('member', 'guest'),
('member', 'op_blog_addposts'),
('member', 'op_doc_add_comments'),
('member', 'op_extensions_addposts'),
('member', 'op_forum_post_posts'),
('member', 'op_forum_post_topics'),
('member', 'op_tutorials_addtutorials'),
('member', 'op_users_comment'),
('moderators', 'manage_posts'),
('task_blog', 'op_blog_addcats'),
('task_blog', 'op_blog_addposts'),
('task_blog', 'op_blog_comments'),
('task_blog', 'op_blog_deletecats'),
('task_blog', 'op_blog_deletecomments'),
('task_blog', 'op_blog_deleteposts'),
('task_blog', 'op_blog_editcats'),
('task_blog', 'op_blog_editposts'),
('task_blog', 'op_blog_manage'),
('task_blog', 'op_blog_managecats'),
('task_custompages', 'op_custompages_addpages'),
('task_custompages', 'op_custompages_deletepages'),
('task_custompages', 'op_custompages_editpages'),
('task_custompages', 'op_custompages_managepages'),
('task_documentations', 'op_doc_add_comments'),
('task_documentations', 'op_doc_delete_comments'),
('task_documentations', 'op_doc_edit_docs'),
('task_documentations', 'op_doc_manage_comments'),
('task_extensions', 'op_extensions_addcats'),
('task_extensions', 'op_extensions_addposts'),
('task_extensions', 'op_extensions_comments'),
('task_extensions', 'op_extensions_deletecats'),
('task_extensions', 'op_extensions_deletecomments'),
('task_extensions', 'op_extensions_deleteposts'),
('task_extensions', 'op_extensions_editcats'),
('task_extensions', 'op_extensions_editposts'),
('task_extensions', 'op_extensions_manage'),
('task_extensions', 'op_extensions_managecats'),
('task_forum', 'op_forum_posts'),
('task_forum', 'op_forum_post_posts'),
('task_forum', 'op_forum_post_topics'),
('task_forum', 'op_forum_topics'),
('task_languages', 'op_lang_copy_strings'),
('task_languages', 'op_lang_translate'),
('task_members', 'op_users_add_users'),
('task_members', 'op_users_bulk_users'),
('task_members', 'op_users_comment'),
('task_members', 'op_users_delete_users'),
('task_members', 'op_users_edit_users'),
('task_members', 'op_users_manage_comments'),
('task_roles', 'op_roles_add_auth'),
('task_roles', 'op_roles_add_authchild'),
('task_roles', 'op_roles_delete_auth'),
('task_roles', 'op_roles_edit_auth'),
('task_settings', 'op_settings_add_settings'),
('task_settings', 'op_settings_add_settings_groups'),
('task_settings', 'op_settings_delete_settings'),
('task_settings', 'op_settings_delete_settings_groups'),
('task_settings', 'op_settings_edit_settings'),
('task_settings', 'op_settings_edit_settings_groups'),
('task_settings', 'op_settings_revert_settings'),
('task_settings', 'op_settings_update_settings'),
('task_settings', 'op_settings_view_settings'),
('task_tutorials', 'op_tutorials_addcats'),
('task_tutorials', 'op_tutorials_addtutorials'),
('task_tutorials', 'op_tutorials_comments'),
('task_tutorials', 'op_tutorials_deletecats'),
('task_tutorials', 'op_tutorials_deletecomments'),
('task_tutorials', 'op_tutorials_deletetutorials'),
('task_tutorials', 'op_tutorials_editcats'),
('task_tutorials', 'op_tutorials_edittutorials'),
('task_tutorials', 'op_tutorials_manage'),
('task_tutorials', 'op_tutorials_managecats');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` double DEFAULT NULL,
  `name` varchar(1536) DEFAULT NULL,
  `position` varchar(96) DEFAULT NULL,
  `type` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `filename` varchar(1536) DEFAULT NULL,
  `content` blob,
  `link` varchar(1536) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `position`, `type`, `is_active`, `filename`, `content`, `link`, `created`) VALUES
(1, 'Social Top', '1', 3, 1, NULL, 0x3c756c2069643d22736f6369616c223e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d22687474703a2f2f66616365626f6f6b2e636f6d223e3c6920636c6173733d2266612066612d66616365626f6f6b223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d2268747470733a2f2f747769747465722e636f6d2fe2808e223e3c6920636c6173733d2266612066612d74776974746572223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d22687474703a2f2f736b7970652e636f6d223e3c6920636c6173733d2266612066612d736b797065223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d2268747470733a2f2f7777772e6c696e6b6564696e2e636f6d223e3c6920636c6173733d2266612066612d6c696e6b6564696e223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d2268747470733a2f2f676f6f676c652e636f6d223e3c6920636c6173733d2266612066612d676f6f676c652d706c7573223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a20202020202020202020202020202020202020203c6c693e3c6120687265663d2223223e3c6920636c6173733d2266612066612d656e76656c6f7065223e3c2f693e3c2f613e3c62723e3c2f6c693e0d0a202020202020202020202020202020203c2f756c3e, '', '2013-11-17 10:20:37'),
(2, 'Advertise Image', '2', 1, 1, '5955-banner.png', '', 'http://sinónimo.es', '2013-11-17 13:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `custompages`
--

CREATE TABLE IF NOT EXISTS `custompages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `content` text,
  `dateposted` int(10) NOT NULL DEFAULT '0',
  `authorid` int(10) NOT NULL DEFAULT '0',
  `last_edited_date` int(10) NOT NULL DEFAULT '0',
  `last_edited_author` int(10) NOT NULL DEFAULT '0',
  `tags` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(3) NOT NULL DEFAULT '',
  `metadesc` varchar(255) NOT NULL DEFAULT '',
  `metakeys` varchar(255) NOT NULL DEFAULT '',
  `visible` text,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`,`language`),
  KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `definition`
--

CREATE TABLE IF NOT EXISTS `definition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_word` int(11) NOT NULL,
  `definition` varchar(1000) NOT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_definition_id_word` (`id_word`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17995 ;

--
-- Dumping data for table `definition`
--

INSERT INTO `definition` (`id`, `id_word`, `definition`, `order`) VALUES
(1435, 622, 'Don que se dedica a una divinidad para suplicarle un deseo o pedir su auxilio o, en la Iglesia Católica, a Dios y a los santos.', 1),
(1436, 622, 'Pan, vino u otros productos que los fieles llevan a la iglesia en ocasión de ciertas solemnidades.', 2),
(4663, 2685, ' Calidad o cualidad de parcial.', 1),
(4664, 2685, ' Personas que se unen para una finalidad, separándose del resto.', 2),
(4665, 2685, ' Confianza en el trato.', 3),
(4698, 2695, ' , orilla o extremo de algo.', 1),
(4699, 2695, ' Cada una de las caras de una hoja, tela, moneda u otro cuerpo con dos superficies opuestas.', 2),
(4700, 2695, '  o ubicación.', 3),
(5490, 3174, ' Especie de cinta o ceñidor con que se ciñe y rodea el cuerpo', 1),
(5491, 3174, '  elástica que se ciñe a la cintura para estilizar la figura o por motivos médicos', 2),
(5492, 3174, '  que se pone en la cubierta de un libro donde aparece alguna breve mención del contenido o de un premio obtenido', 3),
(5493, 3174, ' Cualquiera tira mucho mas larga que ancha, como las del globo terráqueo.', 4),
(5494, 3174, ' de los generales y de otras dignidades', 5),
(5495, 3174, 'Pieza del escudo que lo abraza de un lado a otro la tercera parte del centro', 6),
(5496, 3174, ' de lona que se pone en la fila de rizos de las velas', 7),
(5497, 3174, ' liso y largo que sirve para trincar los botes colgados', 8),
(5498, 3174, 'Tipo de cable con multitud de conectores situados paralelamente', 9),
(5499, 3174, ' Moldura ancha y de poco vuelo.', 10),
(5500, 3174, ' Telar liso que se hace alrededor de las ventanas y arcos de un edificio', 11),
(5503, 3179, '  o banda de un material ligero, tela o papel.', 1),
(5504, 3179, '  que se emite diariamente.', 2),
(5505, 3179, ' Programa deportivo de radio que se emite diariamente.', 3),
(5506, 3179, ' En general, agente de la policía u otra fuerza de seguridad', 4),
(5507, 3179, ' Funcionario de la policía civil de investigaciones', 5),
(6096, 3713, ' Deber contraído, promesa.', 1),
(6097, 3713, ' Obligación, acuerdo o pacto.', 2),
(6098, 3713, ' Dícese sobre alguna dificultad o algún peligro que se pueda tener.', 3),
(6099, 3713, ' Acto en el que los novios se proponen contraer matrimonio.', 4),
(6331, 3831, ' Calidad o cualidad de fiel.', 1),
(6332, 3831, ' Obediencia o nobleza de la fe que uno debe a otro.', 2),
(6333, 3831, ' Exactitud o puntualidad en la ejecución de alguna cosa.', 3),
(8824, 7381, ' Acción y efecto de asentar o asentarse', 1),
(8825, 7381, '  para sentarse', 2),
(8826, 7381, ' Por extensión, plaza destinada a una persona en un espacio público', 3),
(8827, 7381, ' Por extensión, plaza en un organismo colegiado', 4),
(8828, 7381, '  en que se asienta o asentaba un edificio o población', 5),
(8829, 7381, ' Parte inferior y plana de los recipientes, sobre la que descansan', 6),
(8830, 7381, ' Por metonimia, base o cimiento en que descansa algo', 7),
(8831, 7381, '  sólido que se decanta de algunos líquidos', 8),
(8832, 7381, '  que consigna un acuerdo', 9),
(8833, 7381, '  escrito', 10),
(8834, 7381, 'En especial, el que registra una operación en los libros de cuentas', 11),
(8835, 7381, 'En especial, el que registra los cambios de estado civil y las operaciones comerciales de propiedades registrables', 12),
(8836, 7381, '  de una sustancia sin digerir en el estómago ', 13),
(8837, 7381, '  estable de una situación en el tiempo', 14),
(8838, 7381, ' En especial, la de aquella que se considera deseable', 15),
(8839, 7381, '  para juzgar con prudencia en un ámbito determinado', 16),
(8840, 7381, ' ocupado por un madero en la formación de una armadura o entramado', 17),
(8841, 7381, ' de la embocadura que entra en la boca del caballo', 18),
(8842, 7381, 'Por metonimia, parte de la boca del caballo en que se apoya el cañón de la embocadura', 19),
(8843, 7381, ' equilibrada del jinete sobre la montura', 20),
(8844, 7381, ' de arcilla refractaria donde se coloca el crisol en los hornillos de ensayo', 21),
(8845, 7381, ' que se hace en una falleba para colocar los anillos que la sujetan al marco de la ventana o puerta', 22),
(8846, 7381, ' y población de las minas', 23),
(9231, 7622, ' Mueble que consta de una superficie plana y horizontal sostenida por patas.', 1),
(9232, 7622, ' Terreno elevado y llano de gran extensión.', 2),
(9233, 7622, ' Mesa servida para sentarse a comer.', 3),
(9234, 7622, ' Grupo de personas que preside una asamblea.', 4),
(9235, 7622, ' Parte sin peldaños de la escalera, entre tramo y tramo.', 5),
(9236, 7622, ' Parte plana en una gema tallada que es su cara principal.', 6),
(9237, 7622, ' En la iglesia católica, término que indicaba la renta de un obispo o un arzobispo más sus territorios. Si se refería al maestre de una orden militar se llamaba mesa maestral.&ltref&gt&lt/ref&gt', 7),
(9238, 7623, ' Establecimiento destinado al alojamiento de los penados a privación de libertad', 1),
(9239, 7623, ' Pena de privación de libertad que se impone a los condenados por algún delito', 2),
(9240, 7623, ' Elemento compuesto por cuatro piezas, dos horizontales y dos verticales, que sirve para soportar los empujes que reciben los tapiales en el momento de la construcción de las tapias', 3),
(9241, 7625, ' Conjunto de aves que vuelan juntas como un grupo', 1),
(11611, 9273, '  de palabra o por escrito que se da de hacer una cosa.&ltref name=&quotnovísimo&quot&gt Pág. 644&lt/ref&gt', 1),
(16951, 14102, ' Lugar o sitio en el cual se realiza alguna actividad o se trabaja.', 1),
(16952, 14102, ' Lugar o aposento donde se atiende, o se despacha.', 2),
(16954, 14103, '  de una vivienda u establecimiento destinada a la gestión de negocios o al estudio.', 2),
(16955, 14103, '  y enseres de un despacho.', 3),
(16956, 14103, '  de un establecimiento fabril, artesanal o comercial destinado a la venta y entrega de mercancías.', 4),
(16957, 14103, '  escrita oficial entre un gobierno y sus diplomáticos, o entre un mando militar y los oficiales en el campo.', 5),
(16958, 14103, ' En particular, despacho que notifica de un nombramiento o comisión a su destinatario.', 6),
(16959, 14103, ' Más generalmente, cualquier comunicación enviada por medios eléctricos o electrónicos, como un telegrama o teletipo.', 7),
(16960, 14103, ' de las galerías de una mina junto al pozo principal.', 8),
(16961, 14103, '  dedicada al expendio por menor de provisiones y vituallas, en general no perecederas.', 9),
(17751, 15047, '  de madera que en su parte superior tiene una tapa en forma de plano inclinado y sirve para escribir sobre él', 1),
(17981, 15311, ' más a popa en un velero de tres palos.', 1),
(17982, 15311, ' que en este mástil va atada a una verga móvil en sentido vertical y horizontal, llamada cangrejo.', 2),
(17987, 20994, 'seating posstion', 1),
(17991, 20996, 'Educate', 1),
(17992, 20997, 'Vilageration', 1),
(17993, 622, 'Por extensión, servicio o dádiva dado en señal de amor o gratitud.', 1),
(17994, 622, 'Lo que se ofrece o dedica a alguna persona o cosa.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_type`
--

CREATE TABLE IF NOT EXISTS `feedback_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `feedback_type`
--

INSERT INTO `feedback_type` (`id`, `description`) VALUES
(1, 'Suggestion'),
(2, 'Fail');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_code` varchar(10) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `region_code`, `name`, `icon`) VALUES
(1, 'es', 'Spain', '5681-Spain.png'),
(2, 'en', 'English', '1710-England.png');

-- --------------------------------------------------------

--
-- Table structure for table `meaning`
--

CREATE TABLE IF NOT EXISTS `meaning` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meaning` varchar(500) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4079 ;

--
-- Dumping data for table `meaning`
--

INSERT INTO `meaning` (`id`, `meaning`, `order`) VALUES
(1009, 'compromiso', 1),
(1071, 'defecto', 1),
(1960, 'asiento', 1),
(3703, 'mesa', 1),
(3714, 'seating', 1),
(3715, 'chair', 1),
(3716, 'trim', 1),
(3717, 'place', 1),
(3718, 'Education', 1),
(3719, 'Vilagera', 1),
(4078, 'compromiso', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `username` varchar(155) NOT NULL DEFAULT '',
  `gender` tinyint(1) NOT NULL,
  `email` varchar(155) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `sourcefrom` text,
  `coupon` int(255) DEFAULT NULL,
  `joined` int(10) NOT NULL DEFAULT '0',
  `data` text,
  `passwordreset` char(40) NOT NULL DEFAULT '',
  `role` char(30) NOT NULL DEFAULT 'user',
  `ipaddress` char(30) NOT NULL DEFAULT '',
  `seoname` varchar(155) NOT NULL DEFAULT '',
  `fbuid` int(10) NOT NULL DEFAULT '0',
  `fbtoken` varchar(255) NOT NULL DEFAULT '',
  `fname` varchar(40) NOT NULL DEFAULT '',
  `lname` varchar(40) NOT NULL DEFAULT '',
  `birthday` date DEFAULT NULL,
  `photo` varchar(155) NOT NULL DEFAULT '',
  `address` varchar(155) NOT NULL DEFAULT '',
  `phone` varchar(40) NOT NULL DEFAULT '',
  `vericode` char(40) NOT NULL DEFAULT '',
  `current_plan` int(10) NOT NULL DEFAULT '0',
  `street` varchar(255) DEFAULT NULL,
  `nr` varchar(255) NOT NULL,
  `ext_information` varchar(255) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL,
  `city` varchar(155) NOT NULL DEFAULT '',
  `country_id` int(11) NOT NULL,
  `shipping_street` varchar(255) DEFAULT NULL,
  `shipping_nr` varchar(255) DEFAULT NULL,
  `shipping_ext_information` varchar(255) DEFAULT NULL,
  `shipping_postcode` int(11) DEFAULT NULL,
  `shipping_city` varchar(155) DEFAULT NULL,
  `shipping_country_id` int(11) DEFAULT NULL,
  `shipping_fname` varchar(40) DEFAULT NULL,
  `shipping_lname` varchar(40) DEFAULT NULL,
  `shipping_phone` varchar(40) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `last_logged` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `FK_members` (`country_id`),
  KEY `FK_members2` (`shipping_country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `parent_id`, `username`, `gender`, `email`, `password`, `sourcefrom`, `coupon`, `joined`, `data`, `passwordreset`, `role`, `ipaddress`, `seoname`, `fbuid`, `fbtoken`, `fname`, `lname`, `birthday`, `photo`, `address`, `phone`, `vericode`, `current_plan`, `street`, `nr`, `ext_information`, `postcode`, `city`, `country_id`, `shipping_street`, `shipping_nr`, `shipping_ext_information`, `shipping_postcode`, `shipping_city`, `shipping_country_id`, `shipping_fname`, `shipping_lname`, `shipping_phone`, `status`, `last_logged`) VALUES
(1, 0, 'admin', 0, '', '75489b52a82e0175f5163d1967d1c6f1a84d6c6d', NULL, NULL, 1375311600, NULL, '', 'admin', '', 'admin', 0, '', 'Super', 'Admin', '1990-01-05', '', 'Da Nang', '219879505', '', 0, 'Olso', '402', '', 12345, 'Muchen', 66, 'Olso1234', '4020', NULL, 123456789, 'Muchen', 66, 'Super', 'Admin', '219879504', 0, '2013-11-21 11:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(16) NOT NULL DEFAULT '',
  `translation` text,
  PRIMARY KEY (`id`,`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `language`, `translation`) VALUES
(1, 'es', 'Sinónimo \r\n'),
(2, 'es', 'Sinónimo.es - Tesauro en español'),
(3, 'es', 'Diccionario de sinónimos online con más de 20.000 palabras'),
(4, 'es', 'Sinónimo'),
(5, 'es', 'Definición'),
(6, 'es', 'Antónimo'),
(7, 'es', 'Buscar'),
(8, 'es', 'Que la contenga'),
(9, 'es', 'Definicións'),
(10, 'es', 'Antónimos'),
(11, 'es', 'Lista de  sinónimos'),
(12, 'es', 'Lista de Palabras'),
(13, 'es', 'Sinónimo.es'),
(14, 'es', 'Tesauro en español'),
(15, 'es', 'Copyright © sinónimo.es 2013. All rights reserved.'),
(16, 'es', 'Sinónimo.es - Tesauro en español - definicións de : '),
(17, 'es', 'Definicións de '),
(18, 'es', 'Sugerir definicións'),
(19, 'es', 'Informe de error'),
(20, 'es', 'Sinónimo.es - Tesauro en español  - antónimos de : '),
(21, 'es', 'Antónimos de  '),
(22, 'es', 'No hay coincidencias'),
(23, 'es', 'Sugerir antónimo'),
(24, 'es', 'Sinónimo.es - Tesauro en español - Sugerir '),
(25, 'es', 'Sugerir  a '),
(26, 'es', 'Envíe un correo electrónico'),
(27, 'es', 'Sugerencia'),
(28, 'es', 'Presentar'),
(29, 'es', 'Cancelar'),
(30, 'es', 'Admin'),
(31, 'es', 'Dashboard'),
(32, 'es', 'Are you sure you want to delete this item?\\nThis action cannot be undone!'),
(33, 'es', 'OK! Action Cancled.'),
(34, 'es', 'Dashboard'),
(35, 'es', 'System'),
(36, 'es', 'Manage Settings'),
(37, 'es', 'Manage Setting Languages'),
(38, 'es', 'Dictionary'),
(39, 'es', 'Manage Words'),
(40, 'es', 'Manage Meaning'),
(41, 'es', 'Manage Definitions'),
(42, 'es', 'Manage Languages'),
(43, 'es', 'Advertise & Social'),
(44, 'es', 'Manage Advertise'),
(45, 'es', 'Manage Suggest'),
(46, 'es', 'Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.'),
(47, 'es', 'Home'),
(48, 'es', 'Languages'),
(49, 'es', 'Manage'),
(50, 'es', 'Languages'),
(51, 'es', 'Language Key'),
(52, 'es', 'Language Title'),
(53, 'es', 'Source Language'),
(54, 'es', '# Strings'),
(55, 'es', 'Options'),
(56, 'es', 'Not Source Language'),
(57, 'es', 'Translate this language'),
(58, 'es', 'Translate only the strings that were not translated yet.'),
(59, 'es', 'Copy missing language strings from source into this language'),
(60, 'es', 'Source cannot be translated'),
(61, 'es', 'Copy completed! Total of {number} missing strings copied.'),
(62, 'es', 'Success!'),
(63, 'es', 'Translate'),
(64, 'es', 'Language Strings'),
(65, 'es', 'Original String'),
(66, 'es', 'Translation'),
(67, 'es', 'ID'),
(68, 'es', 'Sort by string id'),
(69, 'es', 'Sort by translation'),
(70, 'es', 'Delete'),
(71, 'es', 'Submit'),
(72, 'es', 'Strings Updated.'),
(73, 'es', 'Create'),
(74, 'es', 'ID'),
(75, 'es', 'Region Code'),
(76, 'es', 'Name'),
(77, 'es', 'Icon'),
(78, 'es', 'Revert translation to original'),
(79, 'es', 'Words'),
(80, 'es', 'Word'),
(81, 'es', 'Id Language'),
(82, 'es', 'Alias'),
(83, 'es', ' Meaning'),
(84, 'es', ' Antonym'),
(85, 'es', 'Edit'),
(86, 'es', 'View'),
(87, 'es', 'Add'),
(88, 'es', 'Id Word'),
(89, 'es', 'Order'),
(90, 'es', 'Back'),
(91, 'es', 'Sinónimo.es-Tesauro en español - Sinónimo de : '),
(92, 'es', 'Sinónimo de '),
(93, 'es', 'Synonyms'),
(94, 'es', 'Sugerir sinónimo'),
(95, 'es', 'Sinónimo.com - Thesaurus in Spanish - List of synonyms of : '),
(96, 'es', 'No strings found.'),
(97, 'es', 'User Feedbacks'),
(98, 'es', 'UserFeedback'),
(99, 'es', 'User Search'),
(100, 'es', 'Feedback Text'),
(101, 'es', 'Id Feedback Type'),
(102, 'es', 'Id Search Type'),
(103, 'es', 'Id User Feedback Status'),
(104, 'es', 'Feedback Type'),
(105, 'es', 'Search Type'),
(106, 'es', 'Status'),
(107, 'es', 'Error'),
(108, 'es', 'File:'),
(109, 'es', 'Type:');

-- --------------------------------------------------------

--
-- Table structure for table `search_type`
--

CREATE TABLE IF NOT EXISTS `search_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `search_type`
--

INSERT INTO `search_type` (`id`, `description`) VALUES
(1, 'Synonym'),
(2, 'Definition'),
(3, 'Antonym');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(125) NOT NULL DEFAULT '',
  `description` text,
  `category` int(10) NOT NULL DEFAULT '0',
  `type` char(30) NOT NULL DEFAULT 'text',
  `settingkey` varchar(125) NOT NULL DEFAULT '',
  `default_value` text,
  `value` text,
  `extra` text,
  `php` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settingkey` (`settingkey`),
  KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `description`, `category`, `type`, `settingkey`, `default_value`, `value`, `extra`, `php`) VALUES
(13, 'Site Name', 'This is the default application (site) title', 2, 'text', 'applicationName', 'My Site', 'Sinónimo\r\n', '', ''),
(14, 'Default Role ', 'Choose the default group for new users registered.', 0, 'dropdown', 'default_group', 'user', 'admin', '#show_roles#', ''),
(15, 'Sinonims.es', 'Language is spain', 2, 'text', 'languages', 'es', 'es', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sourcemessage`
--

CREATE TABLE IF NOT EXISTS `sourcemessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(32) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `sourcemessage`
--

INSERT INTO `sourcemessage` (`id`, `category`, `message`) VALUES
(1, 'global', 'Sinónimo\r\n'),
(2, 'global', 'Sinónimo.com - Thesaurus in Spanish'),
(3, 'global', 'Dictionary of synonyms online with more than 20,000 words'),
(4, 'global', 'Synonym'),
(5, 'global', 'Definition'),
(6, 'global', 'Antonym'),
(7, 'global', 'Search'),
(8, 'global', 'Containing it'),
(9, 'global', 'Definitions'),
(10, 'global', 'Antonyms'),
(11, 'global', 'List of synonyms'),
(12, 'global', 'List of words'),
(13, 'global', 'Sinónimo.com'),
(14, 'global', 'Thesaurus in Spanish'),
(15, 'global', 'Copyright © sinónimo.com 2013. All rights reserved.'),
(16, 'global', 'Sinónimo.com - Thesaurus in Spanish - definition of : '),
(17, 'global', 'Definitions of '),
(18, 'global', 'Suggest definition'),
(19, 'global', 'Report a Fail'),
(20, 'global', 'Sinónimo.com - Thesaurus in Spanish - antonym of : '),
(21, 'global', 'Antonyms of '),
(22, 'global', 'No matches'),
(23, 'global', 'Suggest Antonym'),
(24, 'global', 'Sinónimo.com - Thesaurus in Spanish - Suggest'),
(25, 'global', 'Suggest a '),
(26, 'global', 'User Email'),
(27, 'global', 'Suggestion'),
(28, 'global', 'Submit'),
(29, 'global', 'Cancel'),
(30, 'global', 'Admin'),
(31, 'adminglobal', 'Dashboard'),
(32, 'adminglobal', 'Are you sure you want to delete this item?\\nThis action cannot be undone!'),
(33, 'adminglobal', 'OK! Action Cancled.'),
(34, 'global', 'Dashboard'),
(35, 'global', 'System'),
(36, 'global', 'Manage Settings'),
(37, 'global', 'Manage Setting Languages'),
(38, 'global', 'Dictionary'),
(39, 'global', 'Manage Words'),
(40, 'global', 'Manage Meaning'),
(41, 'global', 'Manage Definitions'),
(42, 'global', 'Manage Languages'),
(43, 'global', 'Advertise & Social'),
(44, 'global', 'Manage Advertise'),
(45, 'global', 'Manage Suggest'),
(46, 'adminglobal', 'Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.'),
(47, 'adminglobal', 'Home'),
(48, 'global', 'Languages'),
(49, 'global', 'Manage'),
(50, 'adminlang', 'Languages'),
(51, 'adminlang', 'Language Key'),
(52, 'adminlang', 'Language Title'),
(53, 'adminlang', 'Source Language'),
(54, 'adminlang', '# Strings'),
(55, 'adminlang', 'Options'),
(56, 'adminlang', 'Not Source Language'),
(57, 'adminlang', 'Translate this language'),
(58, 'adminlang', 'Translate only the strings that were not translated yet.'),
(59, 'adminlang', 'Copy missing language strings from source into this language'),
(60, 'adminlang', 'Source cannot be translated'),
(61, 'adminlang', 'Copy completed! Total of {number} missing strings copied.'),
(62, 'global', 'Success!'),
(63, 'adminlang', 'Translate'),
(64, 'adminlang', 'Language Strings'),
(65, 'adminlang', 'Original String'),
(66, 'adminlang', 'Translation'),
(67, 'adminlang', 'ID'),
(68, 'adminlang', 'Sort by string id'),
(69, 'adminlang', 'Sort by translation'),
(70, 'adminlang', 'Delete'),
(71, 'adminlang', 'Submit'),
(72, 'adminlang', 'Strings Updated.'),
(73, 'global', 'Create'),
(74, 'global', 'ID'),
(75, 'global', 'Region Code'),
(76, 'global', 'Name'),
(77, 'global', 'Icon'),
(78, 'adminlang', 'Revert translation to original'),
(79, 'global', 'Words'),
(80, 'global', 'Word'),
(81, 'global', 'Id Language'),
(82, 'global', 'Alias'),
(83, 'global', ' Meaning'),
(84, 'global', ' Antonym'),
(85, 'global', 'Edit'),
(86, 'global', 'View'),
(87, 'global', 'Add'),
(88, 'global', 'Id Word'),
(89, 'global', 'Order'),
(90, 'global', 'Back'),
(91, 'global', 'Sinónimo.com - Thesaurus in Spanish - Synonym of : '),
(92, 'global', 'Synonym of '),
(93, 'global', 'Synonyms'),
(94, 'global', 'Suggest synonym'),
(95, 'global', 'Sinónimo.com - Thesaurus in Spanish - List of synonyms of : '),
(96, 'adminlang', 'No strings found.'),
(97, 'global', 'User Feedbacks'),
(98, 'global', 'UserFeedback'),
(99, 'global', 'User Search'),
(100, 'global', 'Feedback Text'),
(101, 'global', 'Id Feedback Type'),
(102, 'global', 'Id Search Type'),
(103, 'global', 'Id User Feedback Status'),
(104, 'global', 'Feedback Type'),
(105, 'global', 'Search Type'),
(106, 'global', 'Status'),
(107, 'adminglobal', 'Error'),
(108, 'admindebug', 'File:'),
(109, 'admindebug', 'Type:'),
(110, 'global', 'Meanings'),
(111, 'global', 'Meaning'),
(112, 'global', 'Select antonyms'),
(113, 'global', 'Update'),
(114, 'global', 'Save');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE IF NOT EXISTS `user_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) DEFAULT NULL,
  `user_search` varchar(100) DEFAULT NULL,
  `feedback_text` varchar(1000) NOT NULL,
  `id_feedback_type` int(11) DEFAULT NULL,
  `id_search_type` int(11) DEFAULT NULL,
  `id_user_feedback_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_user_feedback_id_feedback_type` (`id_feedback_type`),
  KEY `id_user_feedback_id_user_feedback_status` (`id_user_feedback_status`),
  KEY `i_user_feedback_id_search_type` (`id_search_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`id`, `user_email`, `user_search`, `feedback_text`, `id_feedback_type`, `id_search_type`, `id_user_feedback_status`) VALUES
(2, 'hocnv.qn@gmail.com', NULL, 'Hello', 1, 1, 1),
(3, 'hocnv.qn@gmail.com', NULL, 'Report fail', 2, 2, 3),
(4, 'hocnv.qn@gmail.com', NULL, 'Report', 2, 2, 3),
(5, 'hocnv.qn@gmail.com', NULL, 'hello', 1, 1, 3),
(6, 'hocnv.qn@gmail.com', NULL, 'gfd', 1, 1, 3),
(7, 'hocnv.qn@gmail.com', NULL, 'Fail', 2, 1, 3),
(8, 'hocnv.qn@gmail.com', NULL, 'hello', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback_status`
--

CREATE TABLE IF NOT EXISTS `user_feedback_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_feedback_status`
--

INSERT INTO `user_feedback_status` (`id`, `description`) VALUES
(1, 'Checked'),
(3, 'Not Checked');

-- --------------------------------------------------------

--
-- Table structure for table `word`
--

CREATE TABLE IF NOT EXISTS `word` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `id_language` int(11) NOT NULL,
  `id_antonyms` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_word` (`id_language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20999 ;

--
-- Dumping data for table `word`
--

INSERT INTO `word` (`id`, `word`, `alias`, `id_language`, `id_antonyms`) VALUES
(303, 'porción', '303', 1, 622),
(622, 'ofrenda', '622', 1, 303),
(2685, 'parcialidad', '2685', 1, NULL),
(2695, 'lado', '2695', 1, NULL),
(3174, 'faja', '3174', 1, NULL),
(3179, 'tira', '3179', 1, NULL),
(3505, 'vicio', '3505', 1, NULL),
(3713, 'compromiso', '3713', 1, NULL),
(3818, 'fe', '3818', 1, NULL),
(3830, 'juramento', '3830', 1, NULL),
(3831, 'fidelidad', '3831', 1, NULL),
(5913, 'banco', '5913', 1, NULL),
(7381, 'asiento', '7381', 1, NULL),
(7436, 'perfección', '7436', 1, NULL),
(7622, 'mesa', '7622', 1, NULL),
(7623, 'cárcel', '7623', 1, NULL),
(7624, 'sotabanco', '7624', 1, NULL),
(7625, 'bandada', '7625', 1, NULL),
(7626, 'costado', '7626', 1, 20999),
(7627, 'banquillo', '7627', 1, NULL),
(9273, 'promesa', '9273', 1, NULL),
(9274, 'palabra', '9274', 1, NULL),
(9275, 'voto', '9275', 1, NULL),
(10354, 'moralidad', '10354', 1, NULL),
(14102, 'oficina', '14102', 1, NULL),
(14103, 'despacho', '14103', 1, NULL),
(15044, 'bufete', '15044', 1, NULL),
(15045, 'buró', '15045', 1, NULL),
(15046, 'escritorio', '15046', 1, NULL),
(15047, 'pupitre', '15047', 1, NULL),
(15295, 'virtud', '15295', 1, NULL),
(15311, 'mesana', '15311', 1, NULL),
(15354, 'ética', '15354', 1, NULL),
(20988, 'remesa', '20988', 1, NULL),
(20994, 'portion', '20994', 1, NULL),
(20996, 'education', '622', 2, NULL),
(20997, 'Vilage', '20997', 2, NULL),
(20998, 'Prueba1', '20998', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `word_meanings`
--

CREATE TABLE IF NOT EXISTS `word_meanings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_meaning` int(11) DEFAULT NULL,
  `id_word` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_word_meanings_id_meaning` (`id_meaning`),
  KEY `i_word_meanings_id_word` (`id_word`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26153 ;

--
-- Dumping data for table `word_meanings`
--

INSERT INTO `word_meanings` (`id`, `id_meaning`, `id_word`) VALUES
(5085, 1009, 3830),
(7139, 1960, 5913),
(9361, 1960, 7381),
(9362, 1960, 7622),
(9363, 1960, 7623),
(9364, 1960, 7624),
(9365, 1960, 3174),
(9366, 1960, 3179),
(9367, 1960, 303),
(9368, 1960, 2685),
(9369, 1960, 7625),
(9370, 1960, 2695),
(9371, 1960, 7626),
(9372, 1960, 7627),
(12218, 1009, 3713),
(12219, 1009, 9273),
(12220, 1009, 9274),
(12221, 1009, 9275),
(12223, 1009, 3831),
(12224, 1009, 3818),
(12225, 1009, 622),
(12676, 1071, 3505),
(23727, 3703, 15044),
(23728, 3703, 15045),
(23729, 3703, 7622),
(23730, 3703, 15046),
(23731, 3703, 15047),
(24103, 3703, 14103),
(24104, 3703, 14102),
(24122, 3714, 20994),
(24123, 3715, 20994),
(24124, 3716, 20994),
(24125, 3717, 20994),
(24127, 3718, NULL),
(24128, 3718, 20996),
(24129, 3719, 20997),
(26152, 4078, 15295);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
