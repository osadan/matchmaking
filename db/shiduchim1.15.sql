-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 06, 2011 at 02:59 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: 'shiduchim'
--

-- --------------------------------------------------------

--
-- Table structure for table 'advocats'
--

DROP TABLE IF EXISTS advocats;
CREATE TABLE IF NOT EXISTS advocats (
  id int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL,
  `name` varchar(50) NOT NULL default '',
  relate varchar(50) default NULL,
  phone varchar(50) default NULL,
  address varchar(64) default NULL,
  `work` varchar(252) default NULL,
  recommand varchar(252) default NULL,
  PRIMARY KEY  (id),
  KEY pid (pid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table 'advocats'
--


-- --------------------------------------------------------

--
-- Table structure for table 'defanitions'
--

DROP TABLE IF EXISTS defanitions;
CREATE TABLE IF NOT EXISTS defanitions (
  id int(11) NOT NULL auto_increment,
  item_id int(11) default NULL,
  `name` varchar(128) default NULL,
  `status` enum('active','disables') default 'active',
  remarks text,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table 'defanitions'
--


-- --------------------------------------------------------

--
-- Table structure for table 'extrnalview'
--

DROP TABLE IF EXISTS extrnalview;
CREATE TABLE IF NOT EXISTS extrnalview (
  id int(11) NOT NULL auto_increment,
  p_id int(11) NOT NULL,
  bird varchar(52) default NULL,
  hat varchar(52) default NULL,
  suit varchar(52) default NULL,
  sideburns varchar(52) default NULL,
  height varchar(128) default NULL,
  fabric varchar(128) default NULL,
  generalLook mediumtext,
  outLook varchar(45) default NULL,
  wigg varchar(45) default NULL,
  glasses tinyint(1) unsigned default '0',
  PRIMARY KEY  (id,p_id),
  UNIQUE KEY p_id (p_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table 'extrnalview'
--

-- --------------------------------------------------------

--
-- Table structure for table 'institutions'
--

DROP TABLE IF EXISTS institutions;
CREATE TABLE IF NOT EXISTS institutions (
  id int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  y_from varchar(50) default NULL,
  y_to varchar(50) default NULL,
  `comment` varchar(252) default NULL,
  PRIMARY KEY  (id),
  KEY pid (pid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table 'institutions'
--
-- --------------------------------------------------------

--
-- Table structure for table 'items'
--

DROP TABLE IF EXISTS items;
CREATE TABLE IF NOT EXISTS items (
  id int(11) NOT NULL auto_increment,
  `name` varchar(128) default NULL,
  `status` enum('active','disabled') default 'active',
  `type` tinyint(1) default NULL,
  var varchar(128) default NULL,
  gender enum('male','female','both') default 'both',
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table 'items'
--

INSERT INTO items (id, name, status, type, var, gender) VALUES
(7, 'כובע', 'active', NULL, 'hats', 'male'),
(2, 'זרם', 'active', NULL, 'flows', 'both'),
(3, 'זקן', 'active', NULL, 'birds', 'male'),
(4, 'חליפה', 'active', NULL, 'suits', 'male'),
(8, 'כיסוי ראש', 'active', NULL, 'wiggs', 'female'),
(6, 'פאות', 'active', NULL, 'sideburns', 'male'),
(9, 'הופעה', 'active', NULL, 'outLooks', 'both'),
(21, 'סטטוס הצעה', 'active', NULL, 'offer_process_status', 'both'),
(22, 'סטטוס פגישה', 'active', NULL, 'meeting_status', 'both');

-- --------------------------------------------------------

--
-- Table structure for table 'login'
--

DROP TABLE IF EXISTS login;
CREATE TABLE IF NOT EXISTS login (
  id int(10) unsigned NOT NULL auto_increment,
  userid int(10) unsigned NOT NULL,
  random varchar(256) NOT NULL,
  ip varchar(45) NOT NULL,
  l_date bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=591 ;

--
-- Dumping data for table 'login'
--

INSERT INTO login (id, userid, random, ip, l_date) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'meetings'
--

DROP TABLE IF EXISTS meetings;
CREATE TABLE IF NOT EXISTS meetings (
  m_id int(11) NOT NULL auto_increment,
  offer_id int(11) default NULL,
  meeting_date varchar(256) NOT NULL,
  meeting_place varchar(128) default NULL,
  `status` int(10) unsigned default NULL,
  remarks text,
  meeting_created datetime NOT NULL,
  meeting_updated datetime NOT NULL,
  meeting_date_real int(10) unsigned default NULL,
  PRIMARY KEY  USING BTREE (m_id),
  KEY offer_id (offer_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table 'meetings'
--

INSERT INTO meetings (m_id, offer_id, meeting_date, meeting_place, status, remarks, meeting_created, meeting_updated, meeting_date_real) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'offers'
--

DROP TABLE IF EXISTS offers;
CREATE TABLE IF NOT EXISTS offers (
  o_id int(11) NOT NULL auto_increment,
  boy_id int(11) default NULL,
  girl_id int(11) default NULL,
  `status` enum('offer','meeting','refused','MazalTov') default 'offer',
  update_date timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  insert_date timestamp NOT NULL default '0000-00-00 00:00:00',
  weight int(10) unsigned NOT NULL default '0',
  status_boy int(10) unsigned default NULL,
  status_girl int(10) unsigned default NULL,
  PRIMARY KEY  USING BTREE (o_id),
  UNIQUE KEY uniqe_boy_girl USING BTREE (boy_id,girl_id),
  KEY boy_id (boy_id),
  KEY girl_id (girl_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=33 ;

--
-- Dumping data for table 'offers'
--

INSERT INTO offers (o_id, boy_id, girl_id, status, update_date, insert_date, weight, status_boy, status_girl) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'offers_remarks'
--

DROP TABLE IF EXISTS offers_remarks;
CREATE TABLE IF NOT EXISTS offers_remarks (
  r_id int(10) unsigned NOT NULL auto_increment,
  offer_id int(10) unsigned NOT NULL,
  insert_date timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  update_date timestamp NOT NULL default '0000-00-00 00:00:00',
  `text` text,
  PRIMARY KEY  (r_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table 'offers_remarks'
--

INSERT INTO offers_remarks (r_id, offer_id, insert_date, update_date, text) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'person'
--

DROP TABLE IF EXISTS person;
CREATE TABLE IF NOT EXISTS person (
  id int(11) NOT NULL auto_increment,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  tid int(11) default NULL,
  gender varchar(22) NOT NULL default '',
  age varchar(22) default NULL,
  birthdate varchar(9) character set latin1 collate latin1_general_ci default NULL,
  dorYesharim varchar(50) default NULL,
  fatherName varchar(50) default NULL,
  fatherJob varchar(50) default NULL,
  fatherWork varchar(50) default NULL,
  motherName varchar(50) default NULL,
  motherLastName varchar(50) default NULL,
  motherJob varchar(50) default NULL,
  sibiling varchar(22) default NULL,
  flow varchar(22) default NULL,
  origin varchar(50) default NULL,
  street varchar(50) default NULL,
  neighborhood varchar(50) default NULL,
  city varchar(50) default NULL,
  country varchar(50) default NULL,
  phone varchar(50) default NULL,
  cellPhone varchar(50) default NULL,
  email varchar(50) default NULL,
  insertDate datetime NOT NULL,
  updateDate datetime NOT NULL,
  accupation varchar(128) default NULL,
  s_married int(10) unsigned default NULL,
  comments mediumtext,
  active tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (id),
  KEY tid (tid),
  FULLTEXT KEY firstName (firstName,lastName)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table 'person'
--

INSERT INTO person (id, firstName, lastName, tid, gender, age, birthdate, dorYesharim, fatherName, fatherJob, fatherWork, motherName, motherLastName, motherJob, sibiling, flow, origin, street, neighborhood, city, country, phone, cellPhone, email, insertDate, updateDate, accupation, s_married, comments, active) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'person_defanitions'
--

DROP TABLE IF EXISTS person_defanitions;
CREATE TABLE IF NOT EXISTS person_defanitions (
  id int(10) unsigned NOT NULL auto_increment,
  item_id varchar(45) NOT NULL,
  defanition_id varchar(45) NOT NULL,
  user_id varchar(45) NOT NULL,
  PRIMARY KEY  (id),
  UNIQUE KEY uniq (user_id,item_id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=111 ;

--
-- Dumping data for table 'person_defanitions'
--

INSERT INTO person_defanitions (id, item_id, defanition_id, user_id) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'relatives'
--

DROP TABLE IF EXISTS relatives;
CREATE TABLE IF NOT EXISTS relatives (
  id int(11) NOT NULL auto_increment,
  pid int(11) NOT NULL,
  flow varchar(64) default NULL,
  familyName varchar(50) NOT NULL,
  `type` varchar(64) NOT NULL,
  address varchar(64) default NULL,
  phone varchar(64) default NULL,
  comments mediumtext,
  `work` varchar(128) default NULL,
  PRIMARY KEY  (id),
  KEY familyName (pid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table 'relatives'
--

INSERT INTO relatives (id, pid, flow, familyName, type, address, phone, comments, work) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'search'
--

DROP TABLE IF EXISTS search;
CREATE TABLE IF NOT EXISTS search (
  pid int(10) unsigned NOT NULL,
  term text NOT NULL,
  `name` varchar(250) NOT NULL,
  age int(10) unsigned NOT NULL,
  gender enum('male','female') NOT NULL,
  PRIMARY KEY  USING BTREE (pid),
  FULLTEXT KEY `text` (term)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table 'search'
--

INSERT INTO search (pid, term, name, age, gender) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'search_queries'
--

DROP TABLE IF EXISTS search_queries;
CREATE TABLE IF NOT EXISTS search_queries (
  pid int(10) unsigned NOT NULL,
  `data` longtext NOT NULL,
  `last` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (pid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table 'search_queries'
--

INSERT INTO search_queries (pid, data, last) VALUES

-- --------------------------------------------------------

--
-- Table structure for table 'users'
--

DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
  id int(10) unsigned NOT NULL auto_increment,
  firstName varchar(45) NOT NULL,
  lastName varchar(45) NOT NULL,
  address varchar(64) default NULL,
  phone varchar(45) default NULL,
  cellphone varchar(45) default NULL,
  email varchar(45) default NULL,
  comments mediumtext,
  `password` varchar(128) default NULL,
  premmisions int(10) unsigned default NULL,
  updateDate datetime NOT NULL,
  insertDate datetime NOT NULL,
  nickName varchar(45) NOT NULL,
  PRIMARY KEY  (id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table 'users'
--

INSERT INTO users (id, firstName, lastName, address, phone, cellphone, email, comments, password, premmisions, updateDate, insertDate, nickName) VALUES
(1, 'אהד', 'סדן', 'יוסלה רוזנבלט 1', '026731136', '0527122336', 'sadanoh@gmail.com', '', 'fcea920f7412b5da7be0cf42b8c93759', 256, '2011-10-04 01:31:42', '2010-10-27 09:25:44', 'אהד'),
(2, 'נחמן', 'קירשנבאום', 'רובין 20', '026731136', '0527122336', 'nachman@gmail.com', '', 'fcea920f7412b5da7be0cf42b8c93759', 256, '2011-10-04 01:22:55', '2010-11-03 09:07:29', 'נחמן'),
