-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 01:16 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `postid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `msg`, `likes`, `postid`, `userid`, `date_posted`) VALUES
(5, 'This is the fist comment', 3, 5, 1, '2021-10-18 07:15:59'),
(11, 'This is the second comment', 0, 5, 1, '2021-10-18 16:57:14'),
(16, ' A test comment here', 0, 5, 1, '2021-10-20 17:36:06'),
(18, 'A new comment', 0, 13, 1, '2021-10-21 17:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `msg` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `tags` text DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `msg`, `likes`, `tags`, `userid`, `date_posted`) VALUES
(5, NULL, 'lobortis mattis aliquam faucibus purus in. Viverra nam libero justo laoreet sit amet cursus sit amet. Sollicitudin nibh sit amet commodo nulla facilisi nullam.', 0, NULL, 1, '2021-09-30 12:25:45'),
(10, NULL, 'Lorem ipsum first post simmet ipsum lorem ls site dolllar', 0, NULL, 1, '2021-10-03 20:10:19'),
(11, NULL, 'Diam quis enim lobortis scelerisque fermentum dui faucibus in. In metus vulputate eu scelerisque. Eleifend quam adipiscing vitae proin sagittis nisl rhoncus mattis rhoncus. Bibendum est ultricies integer quis auctor elit sed vulputate. Pharetra et ultrices neque ornare aenean euismod. Nunc lobortis mattis aliquam faucibus purus in. Viverra nam libero justo laoreet sit amet ', 0, NULL, 1, '2021-10-04 09:21:39'),
(13, NULL, 'Dignissim suspendisse in est ante in nibh mauris cursus mattis. Sit amet mattis vulputate enim. Accumsan sit amet nulla facilisi morbi tempus. Interdum varius sit amet mattis vulputate enim nulla aliquet porttitor. Eros in cursus turpis massa tincidunt dui ut ornare. Facilisis leo vel fringilla est ullamcorper eget. Semper feugiat nibh sed pulvinar proin gravida hendrerit lectus a. Consectetur adipiscing elit pellentesque habitant morbi tristique senectus et. Blandit volutpat maecenas volutpat blandit aliquam etiam erat velit. Vulputate sapien nec sagittis aliquam malesuada bibendum. Quisque id diam vel quam elementum pulvinar etiam. Magna eget est lorem ipsum dolor', 0, NULL, 1, '2021-10-20 01:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `content` varchar(20) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `postid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `about` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `username`, `email`, `password`, `birthdate`, `about`) VALUES
(1, 'mufid', 'Fusheini', NULL, 'mufid', '', '123456', NULL, 'Bibendum est ultricies integeleifend quam adipiscing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `postid` (`postid`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
