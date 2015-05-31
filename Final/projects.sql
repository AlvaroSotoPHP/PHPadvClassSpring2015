USE PHPadvClassSpring2015;

CREATE TABLE IF NOT EXISTS `project` (
`projectid` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `project` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `projecttypeid` tinyint(3) unsigned DEFAULT NULL,
  `logged` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastupdated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `projecttype` (
`projecttypeid` tinyint(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `projecttype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) unsigned DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS signup (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(150) COLLATE utf8_unicode_ci NOT NULL UNIQUE KEY,
    password varchar(60) COLLATE utf8_unicode_ci NOT NULL,
    created DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
    active tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;
