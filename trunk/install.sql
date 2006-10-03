--
-- Table structure for table `cbb_categories`
--

DROP TABLE IF EXISTS `cbb_categories`;
CREATE TABLE `cbb_categories` (
  `id` int(3) NOT NULL auto_increment,
  `parent_id` int(3) NOT NULL default '0',
  `title` varchar(50) collate utf8_bin NOT NULL default '',
  `description` varchar(255) collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_pm_content`
--

DROP TABLE IF EXISTS `cbb_pm_content`;
CREATE TABLE `cbb_pm_content` (
  `id` int(7) NOT NULL auto_increment,
  `from_user` int(5) NOT NULL default '0',
  `headline` varchar(50) collate utf8_bin NOT NULL default '',
  `text` tinyint(4) NOT NULL default '0',
  `sent_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_pm_recipient`
--

DROP TABLE IF EXISTS `cbb_pm_recipient`;
CREATE TABLE `cbb_pm_recipient` (
  `id` int(7) NOT NULL default '0',
  `to_user` int(5) NOT NULL default '0',
  `time` int(10) NOT NULL default '0',
  `status` int(1) NOT NULL default '0',
  KEY `id` (`id`),
  KEY `to_user` (`to_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_posts`
--

DROP TABLE IF EXISTS `cbb_posts`;
CREATE TABLE `cbb_posts` (
  `id` int(7) NOT NULL auto_increment,
  `topic` int(6) NOT NULL default '0',
  `user` int(5) NOT NULL default '0',
  `creation_time` int(10) NOT NULL default '0',
  `modification_time` int(10) NOT NULL default '0',
  `text` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `modification_time` (`modification_time`),
  KEY `topic` (`topic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_search_dictionary`
--

DROP TABLE IF EXISTS `cbb_search_dictionary`;
CREATE TABLE `cbb_search_dictionary` (
  `id` int(8) NOT NULL auto_increment,
  `word` varchar(20) collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_search_links`
--

DROP TABLE IF EXISTS `cbb_search_links`;
CREATE TABLE `cbb_search_links` (
  `id` int(8) NOT NULL default '0',
  `post` int(7) NOT NULL default '0',
  `where` int(2) NOT NULL default '0',
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_tags_dictionary`
--

DROP TABLE IF EXISTS `cbb_tags_dictionary`;
CREATE TABLE `cbb_tags_dictionary` (
  `id` int(7) NOT NULL auto_increment,
  `word` varchar(50) collate utf8_bin NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `word` (`word`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_tags_links`
--

DROP TABLE IF EXISTS `cbb_tags_links`;
CREATE TABLE `cbb_tags_links` (
  `id` int(7) NOT NULL default '0',
  `topic` int(6) NOT NULL default '0',
  `user` int(5) NOT NULL default '0',
  KEY `id` (`id`),
  KEY `topic` (`topic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_topics`
--

DROP TABLE IF EXISTS `cbb_topics`;
CREATE TABLE `cbb_topics` (
  `id` int(6) NOT NULL auto_increment,
  `category` int(3) NOT NULL default '0',
  `title` varchar(50) collate utf8_bin NOT NULL default '',
  `subtitle` varchar(255) collate utf8_bin NOT NULL default '',
  `user` int(5) NOT NULL default '0',
  `creation_time` int(10) NOT NULL default '0',
  `new_post_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `category` (`category`),
  KEY `new_post_time` (`new_post_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Table structure for table `cbb_users`
--

DROP TABLE IF EXISTS `cbb_users`;
CREATE TABLE `cbb_users` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(40) collate utf8_bin NOT NULL default '',
  `password` varchar(40) collate utf8_bin NOT NULL default '',
  `mail` varchar(107) collate utf8_bin NOT NULL default '',
  `session` varchar(40) collate utf8_bin NOT NULL default '',
  `status` int(1) NOT NULL default '0',
  `registered` int(10) NOT NULL default '0',
  `lastaction` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

