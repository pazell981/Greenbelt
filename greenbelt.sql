-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jul 19, 2014 at 01:56 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenbelt`
--

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creator_idx` (`creator_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `name`, `created_on`, `updated_on`, `creator_id`) VALUES
(1, 'Missing Key', '2014-06-29', NULL, 3),
(2, 'Dirty Clothes', '2014-07-02', NULL, 5),
(3, 'Ceiling Climb', '2014-07-17', NULL, 4),
(4, 'Bike Theft', '2014-07-17', NULL, 6),
(5, 'General crime', '2014-06-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_on`, `updated_on`) VALUES
(2, 'Paul', 'Zellmer', 'zguy981@me.com', '13H.G7IFS9q6I', '2014-07-18 23:15:45', '2014-07-18 23:15:45'),
(3, 'Trey', 'Villafane', NULL, NULL, NULL, NULL),
(4, 'Julian', NULL, NULL, NULL, NULL, NULL),
(5, 'Kathy', 'Borne', NULL, NULL, NULL, NULL),
(6, 'Tim', 'Williams', NULL, NULL, NULL, NULL),
(7, 'Tony', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_seen_incident`
--

CREATE TABLE `user_seen_incident` (
  `users_id` int(11) NOT NULL,
  `incidents_id` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`incidents_id`),
  KEY `fk_user_seen_incident_users_idx` (`users_id`),
  KEY `fk_user_seen_incident_incidents1_idx` (`incidents_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_seen_incident`
--

INSERT INTO `user_seen_incident` (`users_id`, `incidents_id`) VALUES
(2, 3),
(2, 4),
(3, 4),
(5, 4),
(6, 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `creator` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `user_seen_incident`
--
ALTER TABLE `user_seen_incident`
  ADD CONSTRAINT `fk_user_seen_incident_incidents1` FOREIGN KEY (`incidents_id`) REFERENCES `incidents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_seen_incident_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
