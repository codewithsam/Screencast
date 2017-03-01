-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2015 at 08:40 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `screencast`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catname` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `catname`, `created_at`, `updated_at`) VALUES
(1, 'Science', '2015-03-03 19:05:36', '0000-00-00 00:00:00'),
(2, 'Maths', '2015-03-03 19:05:36', '0000-00-00 00:00:00'),
(3, 'English', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(4, 'C++', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(5, 'Java', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(6, 'C Language', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(7, 'Python', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(8, 'C#', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(9, 'Biology', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(10, 'Physics', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(11, 'Chemestry', '2015-03-03 19:07:34', '0000-00-00 00:00:00'),
(12, 'DBMS', '2015-03-03 19:07:34', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `comment` text,
  `rate` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `member_id`, `post_id`, `comment`, `rate`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Than you master', '5', '2015-03-12 19:30:05', '2015-03-12 19:30:05'),
(2, 1, 1, 'You are awesome. Thanks', '5', '2015-03-12 19:30:31', '2015-03-12 19:30:31'),
(3, 2, 1, 'Wow, Now i understood how java works.', '5', '2015-03-12 19:31:05', '2015-03-12 19:31:05'),
(4, 1, 15, 'Come and Join Me.', '5', '2015-03-13 21:53:39', '2015-03-13 21:53:39'),
(5, 4, 15, 'I love your tutorials.', '5', '2015-03-13 22:10:19', '2015-03-13 22:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(255) DEFAULT 'avatar/user.jpg',
  `place` varchar(50) NOT NULL DEFAULT 'Ludhiana',
  `language` varchar(50) NOT NULL DEFAULT 'English',
  `bio` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `email`, `username`, `password`, `verified`, `created_at`, `updated_at`, `avatar`, `place`, `language`, `bio`) VALUES
(1, 'sam@gmail.com', 'sam', 'sam', 1, '2015-03-03 19:17:02', '2015-03-13 22:31:56', 'cczhi7pjiadhul6e69n6t0xdfosjrem0am5afl0j9fitg3t94c.png', 'Ludhiana', 'English', 'I am a creator of this cool website.'),
(2, 'danish@gmail.com', 'Danish', 'danish', 1, '2015-03-08 19:20:50', '0000-00-00 00:00:00', 'user.jpg', 'Ludhiana', 'English', ''),
(3, 'rob@gmail.com', 'rob', 'rob', 1, '2015-03-09 12:19:42', '0000-00-00 00:00:00', 'user.jpg', 'Ludhiana', 'English', ''),
(4, 'ashish@gmail.com', 'ashish', 'ashish', 1, '2015-03-12 06:57:58', '2015-03-13 22:31:05', 'q4ntaoqs3gzjraqoqley8ci4l6ir522d9n8txqafffbt9z194s.png', 'Ludhiana', 'English', 'Hi! lets get started.'),
(5, 'happy@gmail.com', 'happy', 'happy', 1, '2015-03-12 07:09:55', '2015-03-13 21:33:34', 'ntcs2r2ljlfxu6e7rzq3b2xrpyiog1c4shf81tj1445gg7va4c.jpg', 'Ludhiana', 'English', 'I am a BCA student.'),
(6, 'naveen@gmail.com', 'naveen', 'naveen', 1, '2015-03-12 10:43:25', '0000-00-00 00:00:00', 'user.jpg', 'Ludhiana', 'English', ''),
(7, 'test@gmail.com', 'test', 'test', 1, '2015-03-13 19:58:45', '2015-03-13 20:54:18', '9gmfbfpsc7t27lnvqsagd869kxetdci6eh2rtu1qpmmi8zdfpe.jpg', 'Amritsar', 'Punjabi', 'I am a test user');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `coverimg` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `member_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `category_id`, `coverimg`, `description`, `status`, `member_id`, `created_at`, `updated_at`) VALUES
(1, 'I Can Teach Object Oriented Java To All The Students', 5, 'ne8fn7z77vlg0tndtoepyjrhy8yjpnpv8vwtgox53m8o0vtf24.jpg', 'I can teach everything about Object Oriented Language.\r\nIf you are starter and you want to clear all your doubts about Java OOP, then stick with me.\r\n\r\nOOPS is a very important concept of java, so every student should learn about it.\r\n', 1, 1, '2015-03-03 20:18:00', '2015-03-12 10:39:53'),
(2, 'I Can Teach you C Language from the scratch', 6, '5gnegoa4vfgmfbfpsc7t27lnvqsagd869kxetdci6eh2rtu1qp.jpg', 'C language is a famous programming language due to its qualities. Some qualities are:\r\n\r\nIt is robust language whose rich setup of built in functions and operator can be used to write any complex program.\r\n\r\nProgram written in C are efficient due to several variety of data types and powerful operators.\r\n\r\nThe C compiler combines the capabilities of an assembly language with the feature of high level language. Therefore it is well suited for writing both system software and business package.\r\n\r\nThere are only 32 keywords; several standard functions are available which can be used for developing program.\r\n\r\nC is portable language; this means that C programs written for one computer system can be run on another system, with little or no modification.\r\n\r\nC language is well suited for structured programming, this requires user to think of a problems in terms of function or modules or block. A collection of these modules make a program debugging and testing easier.\r\n\r\nC language has its ability to extend itself. A c program is basically a collection of functions that are supported by the C library. We can continuously add our own functions to the library with the availability of the large number of functions.\r\nIn India and abroad mostly people use C programming language because it is easy to learn and understand.\r\n\r\n\r\nRead more at http://www.queryhome.com/35052/importance-of-c-language-and-reasons-to-use-it#jV1BHriGLT6XDsmF.99', 1, 1, '2015-03-03 21:24:35', '2015-03-03 21:24:35'),
(3, 'I Can Teach You All Types Of Joins Available in MySQL, Oracle', 12, 'p59wq41edtbbekdgrznah251mokab1mtnqenzgu6wde3cnhb8w.jpg', 'We understand the benefits of Cartesian product of two relation, which gives us all the possible tuples that are paired together. But Cartesian product might not be feasible for huge relations where number of tuples are in thousands and the attributes of both relations are considerable large.\r\n\r\nJoin is combination of Cartesian product followed by selection process. Join operation pairs two tuples from different relations if and only if the given join condition is satisfied.', 1, 1, '2015-03-05 22:17:46', '2015-03-05 22:17:46'),
(4, 'I Can Teach you A Chapter On Math Graphs', 2, 'yq1nda5qyebkhp2x67y138g5wfwm1mxo3dpi9gzuol4mldqhlr.jpg', 'In mathematics, and more specifically in graph theory, a graph is a representation of a set of objects where some pairs of objects are connected by links. The interconnected objects are represented by mathematical abstractions called vertices, and the links that connect some pairs of vertices are called edges.[1] Typically, a graph is depicted in diagrammatic form as a set of dots for the vertices, joined by lines or curves for the edges. Graphs are one of the objects of study in discrete mathematics.\r\n\r\nThe edges may be directed or undirected. For example, if the vertices represent people at a party, and there is an edge between two people if they shake hands, then this is an undirected graph, because if person A shook hands with person B, then person B also shook hands with person A. In contrast, if there is an edge from person A to person B when person A knows of person B, then this graph is directed, because knowledge of someone is not necessarily a symmetric relation (that is, one person knowing another person does not necessarily imply the reverse; for example, many fans may know of a celebrity, but the celebrity is unlikely to know of all their fans). This latter type of graph is called a directed graph and the edges are called directed edges or arcs.', 1, 1, '2015-03-05 22:31:04', '2015-03-05 22:31:04'),
(5, 'I Can Teach You The Fundamentals Of Atomic and Molecular Structure', 11, 'g2pnmbeycey9w9z57rtt1hu5nm0svji82zs0px8mm1gsb8hg5j.jpg', 'The three dimensional shape or configuration of a molecule is an important characteristic. This shape is dependent on the preferred spatial orientation of covalent bonds to atoms having two or more bonding partners. Three dimensional configurations are best viewed with the aid of models. In order to represent such configurations on a two-dimensional surface (paper, blackboard or screen), we often use perspective drawings in which the direction of a bond is specified by the line connecting the bonded atoms. In most cases the focus of configuration is a carbon atom so the lines specifying bond directions will originate there. As defined in the diagram on the right, a simple straight line represents a bond lying approximately in the surface plane. The two bonds to substituents A in the structure on the left are of this kind. A wedge shaped bond is directed in front of this plane (thick end toward the viewer), as shown by the bond to substituent B; and a hatched bond is directed in back of the plane (away from the viewer), as shown by the bond to substituent D.To learn more, Hop into my tutorial session.', 1, 1, '2015-03-08 19:03:09', '2015-03-08 19:03:09'),
(6, 'I Can Teach you Balancing chemical equations', 11, 'fzo8rnm4lwmaxoykv1vlho0k5gykuiacyewcl32b8061vvch9o.jpg', 'We are now going to look at chemical reactions. But as we do, we need to make sure that atoms aren''t magically appearing or disappearing. Put another way, we need to sure that we have the same number of each constituent atom in the product of the reaction as we do in the reactants (the molecules that react)! ', 1, 2, '2015-03-08 19:22:47', '2015-03-08 19:22:47'),
(7, 'I Can Concept Of Molecular composition', 11, 'bpgv6xcbyc3dexl2xjrq9q8q30t6wfjajvcfmhuadojghf6cch.jpg', 'We''ll now explore two different ways of representing what elements are in a molecule: molecular and empirical formulas. Then we''ll actually Molecular formulas actually represent the number of atoms in a molecule while empirical formulas show us the ratio of the constituents based on experiments. In order to help us connect these ideas, we''ll also explore a quantity called the "mole". Just as a "dozen" represents 12 of something, a "mole" represents roughly 602,200,000,000,000,000,000,000 of something. This will help us think about mass composition of molecules. ', 1, 2, '2015-03-08 19:24:33', '2015-03-08 19:24:33'),
(8, 'I Can Teach You On The Topic Limiting reagent stoichiometry', 11, 'yfosjrem0am5afl0j9fitg3t94cwo3dhreyo3ghcat5zqt7jta.png', 'In a reaction, you often have extra of one molecule (or too little of the other) so all the reactant doesn''t react. We''ll explore how to identify which reactant is limiting which is helpful in a whole series of scenarios. ', 1, 2, '2015-03-08 19:26:12', '2015-03-08 19:26:12'),
(9, 'I Can Teach You Fundamentals Of Arithmetic Equations In Detail', 2, '5qyh98fefujthj3kct4uteqzzzf8al05d3ukawlk8y9chly0wc.jpg', 'So you''re ready to have some arithmetic fun? You''ve come to the right spot! It''s the first "official" math topic and chalked full of fun exercises and great videos which help you start your journey towards math mastery. We''ll cover the big ones: addition, subtraction, multiplication, and division, of course. But we don''t stop there. We''ll get into negative numbers, absolute value, decimals, and fractions, too. Learning math should be fun, and we plan on having some with you. Ready to get started? ', 1, 2, '2015-03-08 19:28:56', '2015-03-08 19:28:56'),
(10, 'I Can C# Fundamentals For Absolute Beginners', 8, 'xfwm1mxo3dpi9gzuol4mldqhlrg1sadcaoodurhkcl6znouq0w.png', 'Want to learn a different language? Over the course of 25 episodes, our friend Bob Tabor, from VST teaches you the fundamentals of visual C# programming. Tune in to learn C# concepts applicable to video games, mobile environments, and client applications. We walk you through getting the tools, writing code, debugging features, customizations, and much more! Each concept in this C# for beginners course is broken into its own video so you can search for and focus on the information you need.', 1, 3, '2015-03-10 13:16:15', '2015-03-10 18:16:22'),
(11, 'I Can Learn C# Datatypes And Operators', 8, 't13m8o0vtf247qjxe8566kzfznvm5dfixxe6p62t4ntaoqs3gz.jpg', 'The Object Type is the ultimate base class for all data types in C# Common Type System (CTS). Object is an alias for System.Object class. So object types can be assigned values of any other types, value types, reference types, predefined or user-defined types. However, before assigning values, it needs type conversion.', 1, 3, '2015-03-10 14:08:58', '2015-03-10 18:16:23'),
(12, 'I Can Easy Event Handing in C#', 8, '8kub2mjfy6jajoaiegwqaj3s8xcakwh3rvezwzobs510a4qf1i.jpg', 'The events are declared and raised in a class and associated with the event handlers using delegates within the same class or some other class. The class containing the event is used to publish the event. This is called the publisher class. Some other class that accepts this event is called the subscriber class. Events use the publisher-subscriber model.\r\n\r\nA publisher is an object that contains the definition of the event and the delegate. The event-delegate association is also defined in this object. A publisher class object invokes the event and it is notified to other objects.\r\n\r\nA subscriber is an object that accepts the event and provides an event handler. The delegate in the publisher class invokes the method (event handler) of the subscriber class. ', 1, 3, '2015-03-10 15:03:46', '2015-03-10 18:11:03'),
(13, 'I Can Multithreading in Java â€“ Introduction and Constructing Threads', 5, '48al05d3ukawlk8y9chly0wc1cupuerm4gnegoa4vfgmfbfpsc.png', 'Multithreading in Java is one of the Important concepts in Core Java.  Most of the Beginners feel that this concept is more complex as well as confusing. In this article i have tried my best to give examples which can make the concepts simple.\r\n\r\nMost of us have mobile phones â€“ sorry, I mean everyone of us. Now, image a situation where we are speaking on phone and still.. we will be able to eat the food and going further, some SMART people can even watch TV while these two activities.', 1, 3, '2015-03-10 15:06:05', '2015-03-10 18:11:04'),
(14, 'I Can Teach You Quantum Computing', 10, '3rq9q8q30t6wfjajvcfmhuadojghf6cchb2g06ot2hnfrcgaqf.jpg', 'I will teach you something about Quantum Computers.', 0, 4, '2015-03-12 07:00:01', '2015-03-13 22:05:35'),
(15, 'I Can Teach You Python Scripting Language', 7, 'axgwi5ohu70nsygf705spkif0cug3qb1draqlv93plej2pnmbe.jpg', 'Python rules.', 1, 5, '2015-03-12 07:12:13', '2015-03-12 07:12:13');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
