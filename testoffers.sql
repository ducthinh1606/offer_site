-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2021 at 05:11 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testoffers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblapps`
--

CREATE TABLE `tblapps` (
  `id` int(11) NOT NULL,
  `app_name` varchar(200) NOT NULL,
  `net_work` varchar(45) NOT NULL,
  `url` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblapps`
--

INSERT INTO `tblapps` (`id`, `app_name`, `net_work`, `url`) VALUES
(1, 'App1', 'Tapjoy', 'url.app1.test'),
(2, 'App2', 'Tapjoy', 'url.app2.test'),
(3, 'App3', 'Tapjoy', 'url.app3.test'),
(4, 'App4', 'Fyber', 'url.app4.test'),
(5, 'App5', 'Fyber', 'url.app5.test');

-- --------------------------------------------------------

--
-- Table structure for table `tblemployee`
--

CREATE TABLE `tblemployee` (
  `id` int(11) NOT NULL,
  `e_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `e_role` int(11) NOT NULL,
  `phone` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblemployee`
--

INSERT INTO `tblemployee` (`id`, `e_name`, `username`, `password`, `e_role`, `phone`) VALUES
(4, 'Thinh', 'admin', '$2y$10$9PGukS1iMZQVLQxRcnQVtOzZCl61Jfp7aeHc/YoPaRD2hiLJuPtpa', 1, '123'),
(5, 'thinh', 'thinh', '$2y$10$UJ8RnGtKf3qd8kFtOIgBOexTnRwJBcGzgJZeCCvUkfqABBpkEW9o6', 2, '123'),
(6, '', 'son', '$2y$10$HxLpNTXmhtTcYrFGvgjuROpz1njt.CXrpE.oCwFlJLti7/HUUxHqq', 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblhistory`
--

CREATE TABLE `tblhistory` (
  `id` int(11) NOT NULL,
  `network_name` varchar(45) NOT NULL,
  `offer_name` varchar(200) NOT NULL,
  `coins` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `tblusers_id` int(11) NOT NULL,
  `tblapps_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblip`
--

CREATE TABLE `tblip` (
  `id` int(11) NOT NULL,
  `IP` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblip`
--

INSERT INTO `tblip` (`id`, `IP`) VALUES
(1, '118.70.40.1'),
(22, '::1'),
(21, '::1'),
(20, '::1'),
(19, '::1'),
(18, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tblnetwork`
--

CREATE TABLE `tblnetwork` (
  `id` int(11) NOT NULL,
  `network_name` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblnetwork`
--

INSERT INTO `tblnetwork` (`id`, `network_name`) VALUES
(6, 'Tapjoy'),
(2, 'ironSource'),
(7, 'Fyber');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gaid` varchar(45) NOT NULL,
  `coins` int(11) DEFAULT 0,
  `app_name` varchar(200) NOT NULL,
  `IP` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblapps`
--
ALTER TABLE `tblapps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_name` (`app_name`);

--
-- Indexes for table `tblemployee`
--
ALTER TABLE `tblemployee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblhistory`
--
ALTER TABLE `tblhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblusers_id` (`tblusers_id`,`tblapps_id`);

--
-- Indexes for table `tblip`
--
ALTER TABLE `tblip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnetwork`
--
ALTER TABLE `tblnetwork`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblapps`
--
ALTER TABLE `tblapps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblemployee`
--
ALTER TABLE `tblemployee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblhistory`
--
ALTER TABLE `tblhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblip`
--
ALTER TABLE `tblip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblnetwork`
--
ALTER TABLE `tblnetwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


SET @MIN = '2021-05-01 00:00:00';
SET @MAX = NOW();

INSERT INTO tblusers (email, gaid, app_name, IP, created_at)
SELECT CONCAT('son', n), CONCAT('gaidSon', n), CONCAT('App', FLOOR(RAND()*(5-4+1)+4)), "::1", (SELECT TIMESTAMPADD(SECOND, FLOOR(RAND() * TIMESTAMPDIFF(SECOND, @MIN, @MAX)), @MIN))
  FROM
(
select a.N + b.N * 10 + c.N * 100 + d.N * 1000 + e.N * 10000 + f.N * 100000 + 1 N
from (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) a
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) b
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) c
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) d
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) e
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) f
) t;

INSERT INTO tblhistory (network_name, offer_name, coins, datetime, tblusers_id, tblapps_id)
SELECT 'Fyber', 'Fyber Offer', FLOOR(RAND()*(500-10+1)+10), (SELECT TIMESTAMPADD(SECOND, FLOOR(RAND() * TIMESTAMPDIFF(SECOND, @MIN, @MAX)), @MIN)), FLOOR(RAND()*(1000000-1+1)+1), FLOOR(RAND()*(5-1+1)+1)
  FROM
(
select a.N + b.N * 10 + c.N * 100 + d.N * 1000 + e.N * 10000 + f.N * 100000 + 1 N
from (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) a
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) b
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) c
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) d
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) e
      , (select 0 as N union all select 1 union all select 2 union all select 3 union all select 4 union all select 5 union all select 6 union all select 7 union all select 8 union all select 9) f
) t;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
