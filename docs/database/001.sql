-- --------------------------------------------------------
-- Host:                         dataservix.com
-- Versión del servidor:         5.7.25-0ubuntu0.16.04.2 - (Ubuntu)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla wuaifai_portalv.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.categories: ~13 rows (aproximadamente)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(2, 'Automovilismo'),
	(3, 'Ciencia & Tecnología'),
	(4, 'Cine y animación'),
	(5, 'Comedia'),
	(6, 'Deportes'),
	(9, 'Educación'),
	(10, 'Entretenimiento'),
	(11, 'Gente y blogs'),
	(12, 'Instructivos & Estilo'),
	(13, 'Mascotas y animales'),
	(14, 'Música'),
	(1, 'Ninguna'),
	(15, 'Noticias y política');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.config_options
CREATE TABLE IF NOT EXISTS `config_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `result` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE name` (`name`),
  KEY `id` (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Volcando datos para la tabla wuaifai_portalv.config_options: ~0 rows (aproximadamente)
DELETE FROM `config_options`;
/*!40000 ALTER TABLE `config_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `config_options` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.log_auth
CREATE TABLE IF NOT EXISTS `log_auth` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `host` text NOT NULL,
  `real_ip` text NOT NULL,
  `forwarded_for` text NOT NULL,
  `user_agent` text NOT NULL,
  `accept` text,
  `referer` text,
  `cookie` text,
  `server_address` text,
  `server_name` text,
  `server_port` text,
  `remote_address` text,
  `script_filename` text,
  `redirect_url` varchar(250) DEFAULT NULL,
  `request_method` varchar(10) DEFAULT NULL,
  `request_uri` varchar(250) DEFAULT NULL,
  `time` text,
  `time_float` text,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `redirect_url` (`redirect_url`),
  KEY `request_uri` (`request_uri`),
  KEY `request_method` (`request_method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.log_auth: ~0 rows (aproximadamente)
DELETE FROM `log_auth`;
/*!40000 ALTER TABLE `log_auth` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_auth` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `data` json NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.permissions: ~1 rows (aproximadamente)
DELETE FROM `permissions`;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `data`) VALUES
	(1, 'Default', '{"users": {"view": true, "change": true, "create": true, "delete": true}, "routes": {"view": true, "change": true, "create": true, "delete": true}, "settings": {"view": true, "change": true, "create": true, "delete": true}, "dashboard": {"view": true}}');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.pictures
CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `size` int(32) NOT NULL,
  `data` mediumblob NOT NULL,
  `type` varchar(50) NOT NULL,
  `create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- Volcando datos para la tabla wuaifai_portalv.pictures: ~0 rows (aproximadamente)
DELETE FROM `pictures`;
/*!40000 ALTER TABLE `pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `pictures` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.url_redirects
CREATE TABLE IF NOT EXISTS `url_redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `module` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `module` (`module`),
  KEY `section` (`section`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.url_redirects: 27 rows
DELETE FROM `url_redirects`;
/*!40000 ALTER TABLE `url_redirects` DISABLE KEYS */;
INSERT INTO `url_redirects` (`id`, `url`, `module`, `section`, `created_at`, `update_at`) VALUES
	(2, '/admin/index.html', 'index', 'dashboard', '2019-02-06 19:34:21', '2019-02-14 11:13:51'),
	(4, '/out', 'login', 'out', '2019-02-06 19:38:43', '2019-02-06 19:38:43'),
	(5, '/admin/users/admin.html', 'admin', 'users-list', '2019-02-06 19:39:15', '2019-02-14 12:58:06'),
	(6, '/admin/modules/admin.html', 'admin', 'modules-list', '2019-02-06 19:40:18', '2019-02-14 13:18:19'),
	(7, '/admin/routes/admin.html', 'admin', 'routes-list', '2019-02-06 19:40:18', '2019-02-14 12:57:29'),
	(8, '/admin/logs/auth.html', 'admin', 'logs-auth', '2019-02-06 19:41:07', '2019-02-14 15:09:40'),
	(9, '/demo/tables.html', 'demo', 'tables', '2019-02-06 19:41:22', '2019-03-08 15:50:41'),
	(10, '/demo/charts.html', 'demo', 'charts', '2019-02-06 19:41:22', '2019-03-08 15:51:48'),
	(39, '/admin/settings-app/{name}', 'admin', 'settings-app', '2019-02-10 13:34:30', '2019-02-10 13:34:30'),
	(47, '/', 'site', 'index', '2019-02-20 15:54:37', '2019-03-12 08:21:41'),
	(49, '/demo/404.html', 'demo', '404', '2019-03-08 12:54:08', '2019-03-08 15:51:09'),
	(50, '/demo/blank.html', 'demo', 'blank', '2019-03-08 12:55:26', '2019-03-08 15:51:13'),
	(51, '/demo/contact.html', 'demo', 'contact', '2019-03-08 13:01:24', '2019-03-08 15:50:37'),
	(52, '/demo/education.html', 'demo', 'education', '2019-03-08 13:02:24', '2019-03-08 15:51:55'),
	(53, '/demo/entertain.html', 'demo', 'entertain', '2019-03-08 13:49:09', '2019-03-08 15:52:01'),
	(54, '/demo/living.html', 'demo', 'living', '2019-03-08 13:54:52', '2019-03-08 15:51:19'),
	(55, '/index.html', 'site', 'index', '2019-03-08 14:54:04', '2019-03-12 08:21:35'),
	(56, '/demo/index.html', 'demo', 'index', '2019-03-08 16:29:08', '2019-03-08 16:35:22'),
	(57, '/admin/dashboard.html', 'admin', 'dashboard', '2019-03-08 21:13:53', '2019-03-08 21:13:53'),
	(58, '/videos/youtube/{video_id}', 'videos', 'youtube', '2019-03-08 22:14:51', '2019-03-08 22:15:01'),
	(59, '/videos/youtube2/{video_id}', 'videos', 'youtube2', '2019-03-08 22:14:51', '2019-03-11 11:02:11'),
	(60, '/videos/yt/{video_id}', 'videos', 'yt', '2019-03-11 20:56:52', '2019-03-11 20:56:52'),
	(61, '/index/', 'site', 'index', '2019-03-12 08:11:50', '2019-03-12 08:11:50'),
	(62, '/video/youtube/', 'site', 'video-youtube-single', '2019-03-12 08:17:50', '2019-03-12 08:17:50'),
	(63, '/create:video/youtube/', 'site', 'video-youtube-add', '2019-03-12 08:20:08', '2019-03-12 08:20:08'),
	(64, '/categories/index/', 'site', 'categories', '2019-03-12 13:40:34', '2019-03-12 13:55:47'),
	(65, '/admin/categories/admin.html', 'admin', 'categories', '2019-03-12 15:14:12', '2019-03-12 15:14:12');
/*!40000 ALTER TABLE `url_redirects` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `names` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `second_surname` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `registered` datetime DEFAULT CURRENT_TIMESTAMP,
  `mail` varchar(150) NOT NULL,
  `avatar` int(11) DEFAULT NULL,
  `hash` text NOT NULL,
  `permissions` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`),
  KEY `FK_users_permissions` (`permissions`),
  KEY `FK_users_pictures` (`avatar`),
  CONSTRAINT `FK_users_permissions` FOREIGN KEY (`permissions`) REFERENCES `permissions` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_users_pictures` FOREIGN KEY (`avatar`) REFERENCES `pictures` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.users: ~2 rows (aproximadamente)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `names`, `surname`, `second_surname`, `phone`, `mobile`, `registered`, `mail`, `avatar`, `hash`, `permissions`) VALUES
	(41, 'admin', 'Admin', 'Pruebas', 'DEMO', '2745002', '3005473082', '2019-02-01 19:40:59', 'demo.admin@feliphegomez.lts', NULL, 'admin', 1),
	(42, '71684476', 'Rodrigo', 'Tobon', 'Monteverde', '0', '0', '2019-03-11 16:01:32', 'documentos.monteverde@gmail.com', NULL, '71684476', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.videos_yt
CREATE TABLE IF NOT EXISTS `videos_yt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref` varchar(50) NOT NULL,
  `title` varchar(200) NOT NULL,
  `thumb` text NOT NULL,
  `category` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref` (`ref`),
  KEY `id` (`id`),
  KEY `title` (`title`),
  KEY `FK_videos_yt_categories` (`category`),
  CONSTRAINT `FK_videos_yt_categories` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.videos_yt: ~1 rows (aproximadamente)
DELETE FROM `videos_yt`;
/*!40000 ALTER TABLE `videos_yt` DISABLE KEYS */;
INSERT INTO `videos_yt` (`id`, `ref`, `title`, `thumb`, `category`) VALUES
	(1, 'i1AC_FJ8WAg', 'Intro App Fb Videos deMedallo.com', '/api/yt/getimage.php?videoid=i1AC_FJ8WAg&sz=hd', 1);
/*!40000 ALTER TABLE `videos_yt` ENABLE KEYS */;

-- Volcando estructura para tabla wuaifai_portalv.videos_yt_files
CREATE TABLE IF NOT EXISTS `videos_yt_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `video` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `poster` text NOT NULL,
  `file` text NOT NULL,
  `type` text NOT NULL,
  `size` text NOT NULL,
  `sizem` text NOT NULL,
  `quality` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `FK_videos_yt_files_videos_yt` (`video`),
  CONSTRAINT `FK_videos_yt_files_videos_yt` FOREIGN KEY (`video`) REFERENCES `videos_yt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla wuaifai_portalv.videos_yt_files: ~3 rows (aproximadamente)
DELETE FROM `videos_yt_files`;
/*!40000 ALTER TABLE `videos_yt_files` DISABLE KEYS */;
INSERT INTO `videos_yt_files` (`id`, `video`, `title`, `poster`, `file`, `type`, `size`, `sizem`, `quality`) VALUES
	(21, 1, 'Intro App Fb Videos deMedallo.com', '/api/yt/getimage.php?videoid=i1AC_FJ8WAg&sz=hd', '/videos_html/Intro-App-Fb-Videos-deMedallocom-videomp4-hd720.mp4', 'mp4', '1219905', '1,16MB', 'hd720'),
	(22, 1, 'Intro App Fb Videos deMedallo.com', '/api/yt/getimage.php?videoid=i1AC_FJ8WAg&sz=hd', '/videos_html/Intro-App-Fb-Videos-deMedallocom-videowebm-medium.webm', 'webm', '428396', '418,36kB', 'medium'),
	(23, 1, 'Intro App Fb Videos deMedallo.com', '/api/yt/getimage.php?videoid=i1AC_FJ8WAg&sz=hd', '/videos_html/Intro-App-Fb-Videos-deMedallocom-videomp4-medium.mp4', 'mp4', '520870', '508,66kB', 'medium');
/*!40000 ALTER TABLE `videos_yt_files` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
