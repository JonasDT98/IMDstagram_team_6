-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 13, 2021 at 02:04 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imdstagram`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `description` varchar(300) NOT NULL,
  `time_comment` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `description`, `time_comment`) VALUES
(1, 2, 3, 'gekke post man!', '2021-05-08 13:22:45'),
(2, 2, 5, 'Nice!', '2021-05-08 13:22:45'),
(3, 1, 3, 'This is so cool!', '2021-05-08 13:22:45'),
(5, 2, 2, 'text', '2021-05-08 13:22:45'),
(6, 2, 6, 'first comment', '2021-05-08 13:22:45'),
(7, 2, 6, 'ogwel', '2021-05-13 13:36:51'),
(8, 1, 6, 'Yuuuuu', '2021-05-13 13:45:44'),
(9, 1, 6, 'jajajaja zeker wel', '2021-05-13 13:46:12'),
(10, 3, 6, 'Yuuu', '2021-05-13 13:49:10'),
(11, 7, 6, 'OMG SUPER GUNNNNAAAAANNNNUUUUU ', '2021-05-13 13:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(1, 2, 5),
(2, 2, 3),
(3, 1, 3),
(4, 1, 6),
(5, 3, 6),
(6, 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `image`, `description`, `user_id`, `time_posted`, `title`) VALUES
(1, 'standaardPost.png', 'This is my first post!', 2, '2021-04-27 17:39:01', ''),
(2, 'standaardPost.png', 'This is my second post!', 2, '2021-04-27 17:39:01', ''),
(3, 'standaardPost.png', 'This is my third post!', 2, '2021-04-27 17:39:01', ''),
(4, 'standaardPost.png', 'This is my fourth post!', 2, '2021-04-27 17:39:01', ''),
(5, 'standaardPost.png', 'This is my fifth post!', 2, '2021-04-27 17:39:01', ''),
(6, 'standaardPost.png', 'Cracking open a cold one with the boys!', 1, '2021-04-29 22:15:28', ''),
(7, 'stefan.png', 'test', 7, '2021-05-13 16:00:36', 'Man Man Man ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profilePic` varchar(600) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profilePic`, `email`, `fullname`, `username`, `password`, `bio`) VALUES
(1, 'gibby.png', 'test@test', 'test', 'login', '$2y$12$1jRr.V2zOmslHiAJe9iyNOZuKOQQasokJ5t/.HP/6Q4IRO4zFX.b6', 'Yo, ik ben de Gibby en ik drink wel eens graag een pintje.'),
(2, 'skevegast.jpg', 'gunnarvanremoortere@gmail.com', 'Gunnar Van Remoortere', 'Gunnar', '$2y$12$Y2ifZaQE2NLMslk3.XepbOm/r1./riZZV/XVQA.zDEdIrxUt8xyY2', 'Yo, ik ben de Gunnar en ik drink wel eens graag een pintje.'),
(3, NULL, 'jonas.del.turco@gmail.com', 'Jonas Del Turco', 'jonas', '$2y$12$WrW/GC6eqhbVDjcPtwluiuHHhw19jc5/L7A5KO9ONF1BPteFzs0hO', NULL),
(7, 'stefan.png', 'stefan@idc', 'Stefan', 'stefan', '$2y$12$P.MW/57vC/8PTd0KP1jFFODj2kkM/w54SKVXetVYyU62/npSa5pPm', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
