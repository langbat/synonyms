/*
SQLyog Ultimate - MySQL GUI v8.21 
MySQL - 5.6.12-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `banners` (
	`id` double ,
	`name` varchar (1536),
	`position` varchar (96),
	`type` double ,
	`is_active` tinyint (1),
	`filename` varchar (1536),
	`content` blob ,
	`link` varchar (1536),
	`created` datetime 
); 
insert into `banners` (`id`, `name`, `position`, `type`, `is_active`, `filename`, `content`, `link`, `created`) values('1','Social Top','1','3','1',NULL,'<ul id=\"social\">\r\n                    <li><a href=\"#\"><i class=\"fa fa-facebook\"></i></a><br></li>\r\n                    <li><a href=\"#\"><i class=\"fa fa-twitter\"></i></a><br></li>\r\n                    <li><a href=\"#\"><i class=\"fa fa-skype\"></i></a><br></li>\r\n                    <li><a href=\"#\"><i class=\"fa fa-linkedin\"></i></a><br></li>\r\n                    <li><a href=\"#\"><i class=\"fa fa-google-plus\"></i></a><br></li>\r\n                    <li><a href=\"#\"><i class=\"fa fa-envelope\"></i></a><br></li>\r\n                </ul>','','2013-11-17 10:20:37');
insert into `banners` (`id`, `name`, `position`, `type`, `is_active`, `filename`, `content`, `link`, `created`) values('2','Advertise Image','2','1','1','5955-banner.png','','http://sinónimo.es','2013-11-17 13:58:44');
