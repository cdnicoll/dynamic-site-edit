-- Advanced Backup System SQL Dump
--
-- Host: localhost:3306
-- Export created: 2010/03/16 on 07:17


--
-- Tabel structuur voor tabel `content`
--
DROP TABLE IF EXISTS content;

CREATE TABLE IF NOT EXISTS `content` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`title` varchar(256) NOT NULL,
`content` text NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1
;

INSERT INTO content VALUES("1","Title 1","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>");
INSERT INTO content VALUES("2","Title 2","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>");



--
-- Tabel structuur voor tabel `images`
--
DROP TABLE IF EXISTS images;

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`column_id` int(11) NOT NULL,
`sort_no` int(11) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
;

INSERT INTO images VALUES("1","finalfantasy3.jpg","2","4");
INSERT INTO images VALUES("2","04.jpg","2","3");
INSERT INTO images VALUES("3","01_wall-e_walle02.jpg","1","2");
INSERT INTO images VALUES("4","02_batman_joker02.jpg","1","1");
INSERT INTO images VALUES("5","8.png","5","11");
INSERT INTO images VALUES("6","05_batman_joker.jpg","3","7");
INSERT INTO images VALUES("7","sport_biathlonpara.gif","2","5");
INSERT INTO images VALUES("8","2089911407_2e67513f58.jpg","3","8");
INSERT INTO images VALUES("9","127451.bin.jpeg","5","12");
INSERT INTO images VALUES("10","vancouver_2010_mascots10.jpg","3","6");
INSERT INTO images VALUES("11","14.png","4","9");
INSERT INTO images VALUES("12","73.png","4","10");
INSERT INTO images VALUES("13","34e044daee74cfc3cfc9c46ab62e6a34.jpg","1","0");



--
-- Tabel structuur voor tabel `links`
--
DROP TABLE IF EXISTS links;

CREATE TABLE IF NOT EXISTS `links` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`link` varchar(40) NOT NULL,
`title` varchar(60) NOT NULL,
`active` enum('0','1') NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1
;

INSERT INTO links VALUES("1","home","Content","1");
INSERT INTO links VALUES("2","panels","Panels","1");
INSERT INTO links VALUES("3","images","Images","1");
INSERT INTO links VALUES("4","upload","Upload Files","1");
INSERT INTO links VALUES("5","template_page","Template Page","1");



--
-- Tabel structuur voor tabel `template_box`
--
DROP TABLE IF EXISTS template_box;

CREATE TABLE IF NOT EXISTS `template_box` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`page_id` int(11) NOT NULL,
`image` varchar(100) NOT NULL,
`column_id` int(11) NOT NULL,
`sort_no` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1
;

INSERT INTO template_box VALUES("1","1","img01.jpg","1","0");
INSERT INTO template_box VALUES("2","1","img02.jpg","1","2");
INSERT INTO template_box VALUES("3","1","img03.jpg","1","1");
INSERT INTO template_box VALUES("4","2","img01.jpg","1","0");
INSERT INTO template_box VALUES("5","2","img02.jpg","1","1");



--
-- Tabel structuur voor tabel `template_content`
--
DROP TABLE IF EXISTS template_content;

CREATE TABLE IF NOT EXISTS `template_content` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`page_id` int(11) NOT NULL,
`title` varchar(100) NOT NULL,
`content` text NOT NULL,
`column_id` int(11) NOT NULL,
`sort_no` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1
;

INSERT INTO template_content VALUES("1","1","Content Box 1","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","1","0");
INSERT INTO template_content VALUES("2","1","Content Box 2","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","2","0");
INSERT INTO template_content VALUES("3","1","Content Box 3","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et d sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","3","0");
INSERT INTO template_content VALUES("4","1","Content Box 4","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","0","0");
INSERT INTO template_content VALUES("5","1","Content Box 5","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et d sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","0","0");
INSERT INTO template_content VALUES("6","2","Content Box 1","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et d sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et d sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","1","1");
INSERT INTO template_content VALUES("7","2","Content Box 2","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et d sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","1","0");
INSERT INTO template_content VALUES("8","2","Content Box 3","<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","1","2");



--
-- Tabel structuur voor tabel `template_page`
--
DROP TABLE IF EXISTS template_page;

CREATE TABLE IF NOT EXISTS `template_page` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`desc_title` varchar(100) NOT NULL,
`descr` blob NOT NULL,
`stats_title` varchar(100) NOT NULL,
`stats` blob NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1
;

INSERT INTO template_page VALUES("1","Created Template 1","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","Stats Template 1","<ul>\n<li>Lorem</li>\n<li>ipsum</li>\n<li>dolor</li>\n<li>sit amet</li>\n</ul>");
INSERT INTO template_page VALUES("2","Created Template 2","<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>","Stats Template 2","<ul>\n<li>Lorem</li>\n<li>ipsum</li>\n<li>dolor</li>\n<li>sit amet</li>\n</ul>");



--
-- Tabel structuur voor tabel `users`
--
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`name` varchar(40) NOT NULL,
`username` varchar(25) NOT NULL,
`password` varchar(40) NOT NULL,
PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1
;

INSERT INTO users VALUES("1","test","test","a94a8fe5ccb19ba61c4c0873d391e987982fbbd3");
INSERT INTO users VALUES("2","Cody Nicoll","cnicoll","a94a8fe5ccb19ba61c4c0873d391e987982fbbd3");



--
-- Tabel structuur voor tabel `widgets`
--
DROP TABLE IF EXISTS widgets;

CREATE TABLE IF NOT EXISTS `widgets` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`column_id` int(11) NOT NULL,
`sort_no` int(11) NOT NULL,
`title` varchar(100) NOT NULL,
`content` longtext NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8
;

INSERT INTO widgets VALUES("1","1","2","Panel 1","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO widgets VALUES("2","1","3","Panel 2","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud \n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO widgets VALUES("3","1","0","Panel 3","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO widgets VALUES("4","1","1","Panel 4","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.");
INSERT INTO widgets VALUES("5","1","4","Panel 5","Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco");





-- Constraints --
