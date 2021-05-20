-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 20, 2021 at 10:12 PM
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
(11, 7, 6, 'OMG SUPER GUNNNNAAAAANNNNUUUUU ', '2021-05-13 13:49:46'),
(12, 3, 7, 'Cute', '2021-05-13 14:05:42'),
(13, 9, 8, 'SO HOT MAN DAMMMMNNNNN', '2021-05-13 14:27:53'),
(14, 3, 8, 'Lets goooo!', '2021-05-13 14:32:09'),
(15, 3, 9, 'You are a wizard Pottah', '2021-05-13 15:14:14'),
(16, 3, 10, 'khjsbdf', '2021-05-13 16:06:52'),
(17, 14, 70, 'ja man', '2021-05-15 10:29:36'),
(18, 9, 77, 'YUUUUUU', '2021-05-16 10:19:07'),
(19, 3, 1, 'this', '2021-05-16 10:33:49'),
(20, 3, 2, 'JAJA', '2021-05-16 10:35:23');

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
(4, 1, 6),
(6, 7, 6),
(7, 7, 7),
(9, 3, 6),
(13, 3, 7),
(17, 11, 8),
(20, 3, 35),
(22, 14, 7),
(23, 9, 54),
(25, 14, 70),
(28, 9, 57),
(29, 9, 8),
(31, 9, 77),
(33, 3, 1),
(34, 3, 2),
(44, 3, 10),
(48, 3, 57),
(54, 3, 9),
(55, 3, 77),
(82, 9, 2),
(83, 9, 10),
(84, 15, 86),
(85, 15, 85),
(86, 15, 82),
(88, 15, 10),
(92, 77, 85),
(95, 77, 80),
(98, 77, 81),
(99, 77, 82),
(101, 1, 85),
(102, 1, 82),
(103, 1, 81),
(104, 1, 80),
(105, 1, 79),
(106, 1, 78),
(107, 1, 11),
(108, 1, 10),
(109, 1, 7),
(112, 1, 3),
(114, 1, 2),
(115, 1, 1),
(116, 1, 5),
(117, 1, 4),
(121, 9, 80),
(123, 9, 79),
(124, 9, 78),
(140, 9, 85),
(141, 9, 82),
(142, 9, 81),
(144, 1, 88),
(145, 1, 89);

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
  `title` varchar(255) DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `image`, `description`, `user_id`, `time_posted`, `title`, `hidden`) VALUES
(1, 'standaardPost.png', 'This is my first post!', 2, '2021-04-27 17:39:01', '', 0),
(2, 'standaardPost.png', 'This is my second post!', 2, '2021-04-27 17:39:01', '', 0),
(3, 'standaardPost.png', 'This is my third post!', 2, '2021-04-27 17:39:01', '', 0),
(4, 'standaardPost.png', 'This is my fourth post!', 2, '2021-04-27 17:39:01', '', 0),
(5, 'standaardPost.png', 'This is my fifth post!', 2, '2021-04-27 17:39:01', '', 0),
(7, 'stefan.png', 'test', 7, '2021-05-13 16:00:36', 'Man Man Man ', 0),
(9, '114-1143208_harry-potter-broom-meme.png', 'yes', 3, '2021-05-13 17:13:19', 'ello boys', 0),
(10, 'dcysant-9b2e4daa-e337-4bff-8f39-c67764a307af.png', 'agt;hk njd', 11, '2021-05-13 17:42:22', 'Z:LD ABHFKJ', 0),
(11, '7493eec90def95526d3a2f3e55984268.jpg', 'asd', 11, '2021-05-13 17:42:38', 'Second post', 0),
(25, 'profile_pic_cs.jpg', 'etet', 3, '2021-05-13 17:46:34', 'yuu test', 0),
(26, 'test.jpg', '12', 3, '2021-05-13 18:03:01', '12', 0),
(27, 'test.jpg', '13', 3, '2021-05-13 18:03:06', '13', 0),
(28, '114-1143208_harry-potter-broom-meme.png', '14', 3, '2021-05-13 18:03:11', '14', 0),
(29, 'profile_pic_cs.jpg', '15', 3, '2021-05-13 18:03:16', '15', 0),
(30, '114-1143208_harry-potter-broom-meme.png', '16', 3, '2021-05-13 18:03:20', '16', 0),
(31, 'test.jpg', '17', 3, '2021-05-13 18:03:24', '17', 0),
(32, '114-1143208_harry-potter-broom-meme.png', '18', 3, '2021-05-13 18:03:28', '18', 0),
(33, 'dcysant-9b2e4daa-e337-4bff-8f39-c67764a307af.png', '19', 3, '2021-05-13 18:03:33', '19', 0),
(34, '7493eec90def95526d3a2f3e55984268.jpg', '20', 3, '2021-05-13 18:03:38', '20', 0),
(35, 'profile_pic_cs.jpg', '21', 3, '2021-05-13 18:03:45', '21', 0),
(78, 'login20210516132119.png', 'test post 1', 1, '2021-05-16 15:21:19', 'test post 1', 0),
(85, 'brian20210516185837.png', 'asd', 9, '2021-05-16 20:58:37', 'Second post', 0),
(86, 'new20210517154526.png', 'Hey dit is een post zonder title', 15, '2021-05-17 17:45:26', NULL, 0),
(87, 'brian20210520153741.png', 'taehafghd', 9, '2021-05-20 17:37:41', NULL, 0),
(88, 'brian20210520160659.jpg', 'vnx ', 9, '2021-05-20 18:06:59', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `post_id`) VALUES
(15, 3, 74),
(16, 12, 74),
(18, 1, 74);

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
(2, 'Gunnar20210515173003.jpg', 'gunnarvanremoortere@gmail.com', 'Gunnar Van Remoortere', 'Gunnar', '$2y$12$Y2ifZaQE2NLMslk3.XepbOm/r1./riZZV/XVQA.zDEdIrxUt8xyY2', 'Yo, ik ben de Gunnar en ik drink wel eens graag een pintje.'),
(7, 'stefan.png', 'stefan@idc', 'Stefan', 'stefan', '$2y$12$P.MW/57vC/8PTd0KP1jFFODj2kkM/w54SKVXetVYyU62/npSa5pPm', NULL),
(9, 'brian20210517151854.png', 'brian@b', 'Brian', 'brian', '$2y$12$q54hBxKhhyYPEzpN9T17KOQ5/6rX9wCRecQ//ZUuMfUHmK7ZLRtqy', 'Yuuu bio'),
(11, '7493eec90def95526d3a2f3e55984268.jpg', 'nopost@nopost', 'No post', 'nopost', '$2y$12$EZJvHWv1wMnIYmxmZCEK1uQNYK.cpz7vuN8c7eQbbsoT1ji4qZvuK', NULL),
(12, 'qw20210515132026.png', '12@as', 'qw', 'qw', '$2y$12$CX5LEH8anQB6LCO0/eE23ehxnXtXwgeOgmCYQ0GAaqOuvIOglGWpW', 'Dit is een bio'),
(14, 'user20210515121550.png', 'user@u', 'user', 'user', '$2y$12$fwm240sF/DVBej/KJ9C7a.JX8NBP/sdUyL48UggRt.sKK0EctrlK6', NULL),
(20, NULL, 'jonas.del.turco@gmail.com', 'Jonas Del Turco', 'jonas', '$2y$12$VY0cO/Zyq7RfUzcFLB5dOedXnBJLPBxDDh6RIOu1bfCXPswNbH6d.', NULL),
(74, NULL, 'w@w.com', 'r', 'r', '$2y$12$dmOwxaT3F9611dXGoq7dzee97VDeIeZU4r654lPCA1BinAue0a57u', NULL),
(77, 'q20210518133131.png', 'q@q.com', 'q', 'q', '$2y$12$xpCKYlVjBPcVfHNFTl6a6O7O.CqI3s6c0SV/SwAe0eTDrYdqWk5Vu', 'Hello my name is jonas'),
(79, NULL, 'e@e.vom', 'e', 'e', '$2y$12$BSVeNJEBpJMOP51eXzkWyulF2wxUT0T7pnVzVOQ8x.YyZ1J.N07lu', NULL);

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
