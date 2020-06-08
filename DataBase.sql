-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.19 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for php35
CREATE DATABASE IF NOT EXISTS `php35` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `php35`;

-- Dumping structure for table php35.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date` datetime DEFAULT NULL,
  `post` int DEFAULT NULL,
  `author` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comments_posts` (`post`),
  KEY `FK_comments_users` (`author`),
  CONSTRAINT `FK_comments_posts` FOREIGN KEY (`post`) REFERENCES `posts` (`id`),
  CONSTRAINT `FK_comments_users` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table php35.comments: ~33 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`, `text`, `date`, `post`, `author`) VALUES
	(52, 'Комментарий № 1', '2020-03-29 13:04:55', 26, 1),
	(53, 'Комментарий № 2', '2020-03-29 13:05:14', 26, 1),
	(54, 'Комментарий № 3', '2020-03-29 13:05:21', 26, 1),
	(55, 'Комментарий № 4', '2020-03-29 13:05:29', 26, 1),
	(56, 'Comment # 5', '2020-03-29 13:05:41', 26, 1),
	(57, 'Comment <u>6</u>', '2020-03-29 13:05:49', 26, 1),
	(58, '<em>COmment</em> 7', '2020-03-29 13:05:59', 26, 1),
	(59, '<strong>8 комментарий </strong>', '2020-03-29 13:06:13', 26, 1),
	(60, '9<u> комментарий </u>', '2020-03-29 13:06:21', 26, 1),
	(61, 'Комментарий 10', '2020-03-29 13:06:27', 26, 1),
	(62, ' Комментарий 11', '2020-03-29 13:06:35', 26, 1),
	(63, 'Комментарий 12', '2020-03-29 13:06:43', 26, 1),
	(64, 'Комментарий № 1', '2020-03-29 13:20:20', 27, 1),
	(65, '<strong>Комментарий № 2</strong> <em>к посту</em> <u>№ 2</u>', '2020-03-29 13:20:37', 27, 1),
	(66, '<strong>Komment</strong>', '2020-03-29 13:21:28', 28, 1),
	(67, 'New comment', '2020-03-29 15:40:07', 28, 24),
	(68, 'Добавляем комментарий', '2020-03-29 15:40:23', 27, 24),
	(69, '<span style="background-color: rgb(255, 255, 255);">"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</span>', '2020-03-29 15:43:39', 28, 30),
	(70, 'Многозначительный комментарий', '2020-03-29 15:46:52', 31, 1),
	(71, 'Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, "consectetur", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги "de Finibus Bonorum et Malorum" ("О пределах добра и зла"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, "Lorem ipsum dolor sit amet..", происходит от одной из строк в разделе 1.10.32', '2020-03-29 15:48:10', 32, 26),
	(72, 'Коментиньйо', '2020-03-29 15:52:29', 36, 1),
	(73, '<span style="background-color: rgb(255, 255, 255);">Integer congue euismod ligula, vel interdum elit bibendum sed. Morbi auctor leo sed leo blandit luctus. In ultrices lorem id sapien euismod, et blandit lacus convallis. Aenean id aliquam nisl, vitae euismod tortor. Aliquam non ligula nec erat sollicitudin hendrerit nec vel eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque quis nisl ut dolor mollis viverra ac a justo.</span>', '2020-03-29 15:52:56', 29, 26),
	(74, 'Commento mori', '2020-03-29 15:53:30', 35, 24),
	(75, 'Comment diem', '2020-03-29 15:53:45', 36, 24),
	(76, 'Old good comment', '2020-03-29 15:56:23', 36, 24),
	(77, 'commentinio', '2020-03-29 15:56:31', 36, 24),
	(78, 'Коментус', '2020-03-29 15:56:50', 36, 1),
	(79, 'Ком.....', '2020-03-29 15:56:59', 36, 1),
	(80, 'Комми', '2020-03-29 15:57:03', 36, 1),
	(81, 'Комментарий № 218 756 319', '2020-03-29 15:57:13', 36, 1),
	(82, 'Комминтио', '2020-03-29 15:58:28', 36, 30),
	(83, 'Идеи закончились', '2020-03-29 15:58:53', 36, 30),
	(84, 'Или нет', '2020-03-29 15:59:02', 36, 30);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table php35.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `authorId` int NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_posts_users` (`authorId`),
  CONSTRAINT `FK_posts_users` FOREIGN KEY (`authorId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table php35.posts: ~11 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` (`id`, `title`, `authorId`, `date`, `text`) VALUES
	(26, 'Пост № 1', 1, '2020-03-29 13:04:42', 'Текст нового <u>поста</u>'),
	(27, 'Пост № 2', 1, '2020-03-29 13:20:09', '<strong style="background-color: rgb(255, 255, 255);">Lorem Ipsum</strong><span style="background-color: rgb(255, 255, 255);">&nbsp;- это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</span>'),
	(28, 'This is the post # 3 title', 1, '2020-03-29 13:21:16', '<span style="background-color: rgb(255, 255, 255);">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</span>'),
	(29, 'Еще один пост', 1, '2020-03-29 15:44:47', '<span style="background-color: rgb(255, 255, 255);">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</span>'),
	(30, 'Постик', 1, '2020-03-29 15:45:07', '<span style="background-color: rgb(255, 255, 255);">"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."</span>'),
	(31, 'In posts we trust', 1, '2020-03-29 15:45:53', '<strong>Текст</strong> <em>ТЕКСТ</em> <u>тЕКСТ</u>'),
	(32, 'Das ist postimo', 1, '2020-03-29 15:46:34', 'Postimulio'),
	(33, 'Постулио', 1, '2020-03-29 15:48:42', 'Эль посто'),
	(34, 'Постинатор', 1, '2020-03-29 15:49:03', '<span style="background-color: rgb(255, 255, 255);">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам "lorem ipsum" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</span>'),
	(35, 'Постэль', 1, '2020-03-29 15:49:33', 'In hac habitasse platea dictumst. Cras euismod porta tincidunt. Nunc vitae bibendum erat, sed laoreet neque. Donec a nisl sit amet nisl consectetur placerat. Quisque viverra nibh sit amet purus pulvinar, eget lacinia enim faucibus. Aenean fermentum scelerisque odio, vel volutpat purus posuere quis. Etiam sollicitudin fermentum sem, id pretium purus aliquet sed. Maecenas dignissim pretium pretium. Nullam accumsan ultricies interdum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris pretium laoreet tortor at tempus. Ut accumsan leo metus, ac tincidunt erat tristique eget. Praesent ut augue in augue facilisis vulputate at eu nibh.'),
	(36, 'Vox populi, vox posts', 1, '2020-03-29 15:50:35', '<em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla faucibus dolor neque, in aliquet massa faucibus sit amet. Morbi sagittis dapibus metus, quis sodales eros efficitur nec. Nunc consectetur eros tempor lectus lobortis pharetra. Aenean maximus augue libero. Fusce vel nulla id ipsum aliquet consequat nec tincidunt nibh.</em> Quisque semper nisi vitae convallis mollis. Vivamus ac felis urna. Donec tempus ultricies tempor. Morbi eget turpis libero. Nam in porttitor turpis. Quisque purus sapien, pretium sed tellus vel, dictum sodales sapien. Praesent fringilla massa nec sem ultrices, a facilisis massa blandit. Quisque ac erat bibendum, eleifend massa ac, tincidunt felis.<u> Donec mollis velit orci. Fusce pulvinar leo luctus lorem tincidunt, vel sagittis justo cursus. Fusce elementum lacus quis enim dapibus, id mollis nunc feugiat.</u>');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table php35.static_pages
CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `url` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table php35.static_pages: ~0 rows (approximately)
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
INSERT INTO `static_pages` (`id`, `url`, `name`, `title`, `text`) VALUES
	(1, 'about', 'about', 'Про нас', '<br> Эта страница про нас');
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;

-- Dumping structure for table php35.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `access` int DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `avatar` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table php35.users: ~7 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `access`, `register_date`, `avatar`) VALUES
	(1, 'admin', 'admin@mail.ru', '123', 1, '2020-02-17', 'uploads/avatar/5e807375b5239image_412411121637301037449.jpg'),
	(24, 'admin1', 'asd1@mail.ru', '123', 1, '2020-02-16', 'uploads/avatar/5e80971566f9a9d6669863b6bb9668835e962c86f05d8.jpg'),
	(25, 'admin12', 'adm21@mail.ru', '123', 1, '2020-01-17', NULL),
	(26, 'admin312', 'adm123@mail.ru', '123', 0, '2019-02-17', 'uploads/avatar/5e8098f9669acbunny-fisher.jpg'),
	(27, 'admin2', 'adm@mail.ru', '123', 0, '2018-02-17', NULL),
	(28, 'admin23', 'admin3@mail.ru', '123', 0, '2019-12-17', NULL),
	(30, 'asadasd123', 'ad21m@mail.ru', '123', 0, '2020-03-01', 'uploads/avatar/5e8097ec86add1040509194758.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
