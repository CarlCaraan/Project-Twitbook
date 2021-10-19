-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 04:15 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twitter`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(17, 'Merry Christmas', 'carl_caraan', 'female_account', '2021-09-01 19:03:56', 'no', 22),
(21, 'test', 'female_account', 'female_account', '2021-09-01 20:19:10', 'no', 22),
(26, 'dummmyy tests', 'carl_caraan', 'female_account', '2021-09-12 16:50:16', 'no', 22),
(27, 'tryy', 'carl_caraan', 'female_account', '2021-09-12 16:51:19', 'no', 22),
(28, 'comment', 'carl_caraan', 'female_account', '2021-09-12 16:53:11', 'no', 22),
(30, 'test', 'carl_caraan', 'carl_caraan', '2021-09-28 14:35:01', 'no', 48),
(31, 'hi', 'carl_caraan', 'third_account', '2021-10-11 14:08:30', 'no', 35),
(32, 'Hi', 'third_account', 'carl_caraan', '2021-10-11 14:09:45', 'no', 60),
(33, 'sample', 'third_account', 'carl_caraan', '2021-10-11 14:10:16', 'no', 62),
(34, 'GG', 'carl_caraan', 'carl_caraan', '2021-10-11 14:10:58', 'no', 62),
(35, 'hi', 'carl_caraan', 'carl_caraan', '2021-10-11 14:12:08', 'no', 56),
(36, 'hi', 'third_account', 'third_account', '2021-10-14 21:00:10', 'no', 63);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(18, 'carl_caraan', 'female_account');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(149, 'female_account', 21),
(209, 'female_account', 22),
(211, 'carl_caraan', 27),
(215, 'carl_caraan', 36),
(237, 'carl_caraan', 29),
(244, 'carl_caraan', 12),
(248, 'carl_caraan', 35),
(250, 'carl_caraan', 22),
(251, 'carl_caraan', 43),
(254, 'carl_caraan', 45),
(255, 'carl_caraan', 1),
(256, 'carl_caraan', 47),
(257, 'carl_caraan', 48),
(260, 'carl_caraan', 34),
(261, 'carl_caraan', 38),
(262, 'carl_caraan', 56),
(263, 'carl_caraan', 37),
(264, 'carl_caraan', 60),
(265, 'third_account', 61),
(266, 'third_account', 62),
(267, 'third_account', 60),
(268, 'carl_caraan', 63),
(269, 'female_account', 63),
(270, 'third_account', 56);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(36, 'carl_caraan', 'carl_caraan', 'hi', '2021-10-02 16:27:03', 'yes', 'yes', 'no'),
(38, 'third_account', 'carl_caraan', 'hi', '2021-10-02 17:02:34', 'yes', 'no', 'no'),
(39, 'carl_caraan', 'third_account', 'helllo', '2021-10-02 17:12:28', 'yes', 'yes', 'no'),
(40, 'female_account', 'carl_caraan', 'hi', '2021-10-02 17:16:06', 'yes', 'yes', 'no'),
(41, 'fourth_account', 'carl_caraan', 'hi', '2021-10-02 17:16:09', 'no', 'no', 'no'),
(42, 'fifth_account', 'carl_caraan', 'hi', '2021-10-02 17:16:15', 'no', 'no', 'no'),
(43, 'sixth_account', 'carl_caraan', 'hi', '2021-10-02 17:16:17', 'no', 'no', 'no'),
(44, 'seventh_account', 'carl_caraan', 'hi', '2021-10-02 17:16:20', 'yes', 'yes', 'no'),
(45, 'carl_caraan', 'seventh_account', 'lowww', '2021-10-02 18:28:15', 'yes', 'yes', 'no'),
(46, 'seventh_account', 'carl_caraan', 'FB IS DOWN!', '2021-10-05 08:04:58', 'no', 'no', 'no'),
(47, 'carl_caraan', 'female_account', 'wassup', '2021-10-07 19:06:14', 'yes', 'yes', 'no'),
(48, 'carl_caraan', 'female_account', 'hi', '2021-10-08 09:22:38', 'yes', 'yes', 'no'),
(49, 'carl_caraan', 'third_account', 'EZZ', '2021-10-10 20:47:32', 'yes', 'yes', 'no'),
(50, 'carl_caraan', 'third_account', 'pakyu', '2021-10-11 22:24:16', 'yes', 'yes', 'no'),
(51, 'carl_caraan', 'female_account', 'hello', '2021-10-14 20:59:36', 'yes', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_to`, `user_from`, `message`, `link`, `datetime`, `opened`, `viewed`) VALUES
(1, 'carl_caraan', 'third_account', 'Third Account liked your post', 'post.php?id=61', '2021-10-10 20:40:20', 'yes', 'yes'),
(2, 'third_account', 'carl_caraan', 'Carl Caraan liked your post', 'post.php?id=62', '2021-10-10 20:40:48', 'no', 'yes'),
(3, 'carl_caraan', 'third_account', 'Third Account liked your post', 'post.php?id=63', '2021-10-11 14:09:40', 'yes', 'yes'),
(4, 'carl_caraan', 'third_account', 'Third Account liked your post', 'post.php?id=62', '2021-10-11 14:10:05', 'yes', 'yes'),
(5, 'carl_caraan', 'third_account', 'Third Account commented on your post', 'post.php?id=62', '2021-10-11 14:10:16', 'yes', 'yes'),
(6, 'carl_caraan', 'carl_caraan', 'Carl Caraan commented on your post', 'post.php?id=62', '2021-10-11 14:10:58', 'yes', 'yes'),
(7, 'third_account', 'carl_caraan', 'Carl Caraan commented on your profile post', 'post.php?id=62', '2021-10-11 14:10:58', 'no', 'yes'),
(8, 'carl_caraan', 'third_account', 'Third Account liked your post', 'post.php?id=60', '2021-10-11 22:24:06', 'no', 'yes'),
(9, 'third_account', 'carl_caraan', 'Carl Caraan liked your post', 'post.php?id=63', '2021-10-14 20:52:07', 'no', 'no'),
(10, 'third_account', 'female_account', 'Female Account liked your post', 'post.php?id=63', '2021-10-14 20:59:24', 'no', 'no'),
(11, 'third_account', 'third_account', 'Third Account commented on your post', 'post.php?id=63', '2021-10-14 21:00:10', 'no', 'no'),
(12, 'carl_caraan', 'third_account', 'Third Account commented on your profile post', 'post.php?id=63', '2021-10-14 21:00:10', 'no', 'no'),
(13, 'carl_caraan', 'third_account', 'Third Account liked your post', 'post.php?id=56', '2021-10-14 21:00:13', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(16, '16', 'carl_caraan', 'none', '2021-08-29 19:11:34', 'no', 'no', 0, ''),
(17, '17', 'carl_caraan', 'none', '2021-08-29 19:11:36', 'no', 'no', 0, ''),
(18, '18', 'carl_caraan', 'none', '2021-08-29 19:11:38', 'no', 'no', 0, ''),
(19, '19', 'carl_caraan', 'none', '2021-08-29 19:11:40', 'no', 'no', 0, ''),
(20, '20', 'carl_caraan', 'none', '2021-08-29 19:11:42', 'no', 'no', 0, ''),
(21, '21', 'carl_caraan', 'none', '2021-08-29 19:11:43', 'no', 'no', 1, ''),
(22, 'test', 'female_account', 'none', '2021-08-30 13:18:24', 'no', 'no', 2, ''),
(27, 'NO ERROR PLEASE', 'carl_caraan', 'female_account', '2021-09-11 16:31:05', 'no', 'no', 1, ''),
(28, 'Example Post!', 'carl_caraan', 'female_account', '2021-09-11 20:34:02', 'no', 'no', 0, ''),
(29, 'sample', 'carl_caraan', 'none', '2021-09-12 15:26:29', 'no', 'no', 1, ''),
(30, 'word', 'carl_caraan', 'none', '2021-09-12 15:26:39', 'no', 'no', 0, ''),
(31, 'testx', 'carl_caraan', 'none', '2021-09-12 15:26:42', 'no', 'no', 0, ''),
(32, 'yow!!!!!!!!!', 'carl_caraan', 'none', '2021-09-12 15:26:51', 'no', 'no', 0, ''),
(33, 'GGG', 'carl_caraan', 'none', '2021-09-12 15:27:10', 'no', 'no', 0, ''),
(34, 'GGG', 'carl_caraan', 'none', '2021-09-12 16:22:37', 'no', 'no', 1, ''),
(35, 'HEYEYEYEYYYY!!!!!!!!!!', 'third_account', 'none', '2021-09-12 21:19:57', 'no', 'no', 1, ''),
(36, 'dafuk!', 'carl_caraan', 'third_account', '2021-09-12 21:20:30', 'no', 'no', 1, ''),
(37, 'Messaging part :)', 'carl_caraan', 'none', '2021-09-13 16:43:32', 'no', 'no', 1, ''),
(38, 'Another Post', 'carl_caraan', 'none', '2021-09-13 16:43:39', 'no', 'no', 1, ''),
(56, 'TEST', 'carl_caraan', 'none', '2021-09-28 14:51:09', 'no', 'no', 2, ''),
(60, '#FACEBOOK IS DOWN!#SERVERDOWN', 'carl_caraan', 'none', '2021-10-05 08:02:34', 'no', 'no', 2, ''),
(61, 'hi', 'carl_caraan', 'third_account', '2021-10-10 20:38:33', 'no', 'no', 1, ''),
(62, 'yow', 'carl_caraan', 'third_account', '2021-10-10 20:40:48', 'no', 'no', 1, ''),
(63, 'Hi', 'third_account', 'carl_caraan', '2021-10-11 14:09:40', 'no', 'no', 2, ''),
(64, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/KRUWn3dLoRg&list=RDKRUWn3dLoRg&start_radio=1\'></iframe><br>', 'carl_caraan', 'none', '2021-10-19 13:19:08', 'no', 'yes', 0, ''),
(65, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/KRUWn3dLoRg\'></iframe><br>', 'carl_caraan', 'none', '2021-10-19 13:25:53', 'no', 'no', 0, ''),
(66, 'Hello guys! I am looking forward to the superbowl', 'carl_caraan', 'none', '2021-10-19 17:26:00', 'no', 'yes', 0, ''),
(67, 'Hello guys! I am looking forward to the superbowl', 'carl_caraan', 'none', '2021-10-19 17:27:28', 'no', 'yes', 0, ''),
(68, 'Hello guys! I am looking forward to the superbowl', 'carl_caraan', 'none', '2021-10-19 17:27:34', 'no', 'yes', 0, ''),
(69, 'Hello guys! I am looking forward to the superbowl', 'carl_caraan', 'none', '2021-10-19 17:27:37', 'no', 'yes', 0, ''),
(70, 'Hello guys! I am looking forward to the superbowl', 'carl_caraan', 'none', '2021-10-19 17:28:37', 'no', 'no', 0, ''),
(71, 'No one who achieves success does so without the help of others. ', 'carl_caraan', 'none', '2021-10-19 17:30:22', 'no', 'yes', 0, ''),
(72, 'twitbookisdown', 'carl_caraan', 'none', '2021-10-19 17:31:18', 'no', 'yes', 0, ''),
(73, 'twitbookisdown', 'carl_caraan', 'none', '2021-10-19 17:33:14', 'no', 'no', 0, ''),
(74, '<br><iframe width=\'420\' height=\'315\' src=\'https://www.youtube.com/embed/ImtZ5yENzgE\'></iframe><br>', 'carl_caraan', 'none', '2021-10-19 18:01:15', 'no', 'no', 0, ''),
(75, 'Picture upload', 'carl_caraan', 'none', '2021-10-19 21:17:59', 'no', 'yes', 0, ''),
(76, 'Hello', 'carl_caraan', 'none', '2021-10-19 21:22:27', 'no', 'no', 0, 'assets/images/posts/616ec693dd84fpexels-keegan-checks-9730025.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Hello', 2),
('Guys', 1),
('Looking', 1),
('Forward', 1),
('Superbowl', 1),
('Twitbookisdown', 1),
('Picture', 1),
('Upload', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`, `gender`) VALUES
(1, 'carl', 'caraan', 'carl_caraan', 'Admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-08-24', 'assets/images/profile_pics/carl_caraana97c3ca5b2b18b24e79dc37d0b2c1de1n.jpeg', 72, 19, 'no', ',third_account,fourth_account,fifth_account,sixth_account,seventh_account,', 'Male'),
(2, 'Female', 'Account', 'female_account', 'Sample@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-08-24', 'assets/images/profile_pics/defaults/head_Female.png', 1, 2, 'no', ',third_account,', 'Female'),
(3, 'Third', 'Account', 'third_account', 'Sample1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-09-07', 'assets/images/profile_pics/defaults/head_Female.png', 2, 3, 'no', ',female_account,carl_caraan,', 'Female'),
(4, 'Fourth', 'Account', 'fourth_account', 'Sample2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-09-21', 'assets/images/profile_pics/defaults/head_Male.png', 0, 0, 'no', ',carl_caraan,', 'Male'),
(5, 'Fifth', 'Account', 'fifth_account', 'Sample3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-09-21', 'assets/images/profile_pics/defaults/head_Male.png', 0, 0, 'no', ',carl_caraan,', 'Male'),
(6, 'Sixth', 'Account', 'sixth_account', 'Sample4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-09-21', 'assets/images/profile_pics/defaults/head_Female.png', 0, 0, 'no', ',carl_caraan,', 'Female'),
(7, 'Seventh', 'Account', 'seventh_account', 'Sample5@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2021-09-21', 'assets/images/profile_pics/defaults/head_Female.png', 0, 0, 'no', ',carl_caraan,', 'Female');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
