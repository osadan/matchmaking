-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2010 at 09:49 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `shiduchim`
--

-- --------------------------------------------------------

--
-- Table structure for table `advocats`
--

CREATE TABLE `advocats` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `name` varchar(50) character set utf8 NOT NULL default '',
  `relate` varchar(50) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `address` varchar(64) character set utf8 default NULL,
  `work` varchar(252) character set utf8 default NULL,
  `recommand` varchar(252) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=86 ;

-- --------------------------------------------------------

--
-- Table structure for table `extrnalview`
--

CREATE TABLE `extrnalview` (
  `id` int(11) NOT NULL auto_increment,
  `p_id` int(11) NOT NULL,
  `bird` varchar(52) character set utf8 default NULL,
  `hat` varchar(52) character set utf8 default NULL,
  `suit` varchar(52) character set utf8 default NULL,
  `sideburns` varchar(52) character set utf8 default NULL,
  `height` varchar(128) character set utf8 default NULL,
  `fabric` varchar(128) character set utf8 default NULL,
  `generalLook` mediumtext character set utf8,
  PRIMARY KEY  (`id`,`p_id`),
  UNIQUE KEY `p_id` (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `name` varchar(50) character set utf8 NOT NULL,
  `y_from` varchar(50) character set utf8 default NULL,
  `y_to` varchar(50) character set utf8 default NULL,
  `comment` varchar(252) character set utf8 default NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL auto_increment,
  `firstName` varchar(50) character set utf8 NOT NULL,
  `lastName` varchar(50) character set utf8 NOT NULL,
  `tid` int(11) default NULL,
  `gender` varchar(22) character set utf8 NOT NULL default '',
  `age` varchar(22) character set utf8 default NULL,
  `birthdate` datetime default NULL,
  `dorYesharim` varchar(50) character set utf8 default NULL,
  `fatherName` varchar(50) character set utf8 default NULL,
  `fatherJob` varchar(50) character set utf8 default NULL,
  `fatherWork` varchar(50) character set utf8 default NULL,
  `motherName` varchar(50) character set utf8 default NULL,
  `motherLastName` varchar(50) character set utf8 default NULL,
  `motherJob` varchar(50) character set utf8 default NULL,
  `sibiling` varchar(22) character set utf8 default NULL,
  `flow` varchar(22) character set utf8 default NULL,
  `origin` varchar(50) character set utf8 default NULL,
  `street` varchar(50) character set utf8 default NULL,
  `neighborhood` varchar(50) character set utf8 default NULL,
  `city` varchar(50) character set utf8 default NULL,
  `country` varchar(50) character set utf8 default NULL,
  `phone` varchar(50) character set utf8 default NULL,
  `cellPhone` varchar(50) character set utf8 default NULL,
  `email` varchar(50) character set utf8 default NULL,
  `insertDate` datetime NOT NULL,
  `updateDate` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `tid` (`tid`),
  FULLTEXT KEY `firstName` (`firstName`,`lastName`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=108 ;

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE `relatives` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `flow` varchar(64) default NULL,
  `familyName` varchar(50) NOT NULL,
  `type` varchar(64) NOT NULL,
  `address` varchar(64) default NULL,
  `phone` varchar(64) default NULL,
  `comments` mediumtext,
  `work` varchar(128) default NULL,
  PRIMARY KEY  (`id`),
  KEY `familyName` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;
