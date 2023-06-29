-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2022 at 06:15 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onfile`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `documents` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `size`, `created_at`, `author_id`, `documents`) VALUES
(1, 'blog.html', 316, '2021-01-11 01:30:35', 9, 'path/blog.html.html'),
(2, 'about.html', 4664, '2021-01-12 10:41:52', 9, 'path/about.html.html');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'Female'),
(2, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `image` varchar(256) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `image`, `date`, `author_id`, `size`, `type`) VALUES
(20, '5ffd717b71948', 'path/5ffd717b71948.jpg', '2021-01-12 10:52:59', 10, 176820, 'image/jpeg'),
(21, '5ffd71f5ea683', 'path/5ffd71f5ea683.jpg', '2021-01-12 10:55:01', 10, 67234, 'image/jpeg'),
(22, '5ffd753b182f5', 'path/5ffd753b182f5.jpg', '2021-01-12 11:08:59', 10, 67234, 'image/jpeg'),
(23, '5ffd755d482be', 'path/5ffd755d482be.jpg', '2021-01-12 11:09:33', 10, 67234, 'image/jpeg'),
(24, '5ffd7569c7f43', 'path/5ffd7569c7f43.jpg', '2021-01-12 11:09:45', 10, 67234, 'image/jpeg'),
(25, '5ffd757c4755d', 'path/5ffd757c4755d.jpg', '2021-01-12 11:10:04', 10, 67234, 'image/jpeg'),
(26, '5ffd75af126ed', 'path/5ffd75af126ed.jpg', '2021-01-12 11:10:55', 9, 68840, 'image/jpeg'),
(28, '5ffd7617ef299', 'path/5ffd7617ef299.jpg', '2021-01-12 11:12:39', 9, 69237, 'image/jpeg'),
(29, '5ffd761f100db', 'path/5ffd761f100db.jpg', '2021-01-12 11:12:47', 9, 68840, 'image/jpeg'),
(30, '5ffd7624bc576', 'path/5ffd7624bc576.jpg', '2021-01-12 11:12:52', 9, 68840, 'image/jpeg'),
(31, '5ffd778fdacf8', 'path/5ffd778fdacf8.jpg', '2021-01-12 11:18:55', 9, 67234, 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `music` varchar(256) NOT NULL,
  `type` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`id`, `name`, `size`, `created_at`, `author_id`, `music`, `type`) VALUES
(29, '[Waploaded]_Bebe_Rexha_-_The_Way_I_Are_(Dance_With_Somebody)_Ft._Lil_Wayne-1494598889.mp3._Lil_Wayne-1494598889', 4789249, '2021-01-12 11:25:20', 9, 'musics/[Waploaded]_Bebe_Rexha_-_The_Way_I_Are_(Dance_With_Somebody)_Ft._Lil_Wayne-1494598889.mp3._Lil_Wayne-1494598889._Lil_Wayne-1494598889', 'application/octet-stream');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `about` varchar(256) DEFAULT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `file_name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `about`, `from`, `to`, `file_name`) VALUES
(6, 'shared a file with you', 10, 9, '5ffd717b71948');

-- --------------------------------------------------------

--
-- Table structure for table `otherfiles`
--

CREATE TABLE `otherfiles` (
  `id` int(11) NOT NULL,
  `file` varchar(256) DEFAULT NULL,
  `file_name` varchar(256) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `file_size` varchar(32) NOT NULL,
  `file_type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `others`
--

CREATE TABLE `others` (
  `id` int(11) NOT NULL,
  `folder` varchar(32) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others`
--

INSERT INTO `others` (`id`, `folder`, `created_at`, `author_id`) VALUES
(12, 'office', '2021-01-12 11:19:23', 9),
(13, 'audio', '2021-01-12 11:28:15', 9);

-- --------------------------------------------------------

--
-- Table structure for table `receive`
--

CREATE TABLE `receive` (
  `id` int(11) NOT NULL,
  `from` int(11) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `file_name` varchar(256) DEFAULT NULL,
  `file_type` varchar(256) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file` varchar(256) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receive`
--

INSERT INTO `receive` (`id`, `from`, `to`, `file_name`, `file_type`, `file_size`, `file`, `date`) VALUES
(33, 9, 10, '[Waploaded]_Bebe_Rexha_-_The_Way_I_Are_(Dance_With_Somebody)_Ft._Lil_Wayne-1494598889.mp3._Lil_Wayne-1494598889', 'application/octet-stream', 4789249, 'musics/[Waploaded]_Bebe_Rexha_-_The_Way_I_Are_(Dance_With_Somebody)_Ft._Lil_Wayne-1494598889.mp3._Lil_Wayne-1494598889._Lil_Wayne-1494598889', '2021-01-12 11:26:13'),
(34, 10, 9, '5ffd717b71948', 'image/jpeg', 176820, 'path/5ffd717b71948.jpg', '2021-01-12 11:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `space`
--

CREATE TABLE `space` (
  `id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `space`
--

INSERT INTO `space` (`id`, `total`, `author_id`) VALUES
(35, 5132240, 9),
(37, 233474137, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `userName` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `userName`, `email`, `password`, `gender`) VALUES
(6, 'victor', 'samuel', 'vicsam', 'philsam774@gmail.com', '$2y$10$r0s/ayNRlf/GRFZakOeMEuCBJwoiTWK5gx6.AEuXKy6QWc3m.DOSu', 2),
(7, 'victor', 'samuel', 'vicsams', 'philsam600@gmail.com', '$2y$10$bwLv.WYLmCXOugWjB2YmfOK7kQPCi1fW0jSce9WjFUyoVA431gGlC', 2),
(8, 'rer', 'er', 'this is good', 'vi@gmail.com', '$2y$10$IoTibMrSUzkBteQ3RF64i.wyzjFvWIka/7mdfl8oVzlPK470qzHzK', 2),
(9, 'victor', 'samuel', 'vicki', 'victor@gmail.com', '$2y$10$dyyj8F7p5851GV5umvR96Oe3pIlrebyilYR8b.M/8nYP8NdyfB33e', 2),
(10, 'victor', 'samuel', 'vicks', 'vics@gmail.com', '$2y$10$xrvjY0fKArM5GZb1KsSJUep.6Qyt0FaJS4rFvmCdRgWGTpGB7rwyq', 2),
(11, 'victor', 'samuel', 'hello', 'vick@gmail.com', '$2y$10$kmSDsIWVcPv9LZ9dbtaqKeiz.H1Fk1UayEHoV4IKnw61XRbcJcOcO', 2);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `name` varchar(256) DEFAULT NULL,
  `size` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `author_id` int(11) NOT NULL,
  `video` varchar(256) NOT NULL,
  `type` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `size`, `created_at`, `author_id`, `video`, `type`) VALUES
(17, 'Agent 47.mp4.mp4', '228129546', '2021-01-12 10:53:52', 10, 'movies/Agent 47.mp4.mp4.mp4', 'video/mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otherfiles`
--
ALTER TABLE `otherfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `others`
--
ALTER TABLE `others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receive`
--
ALTER TABLE `receive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `space`
--
ALTER TABLE `space`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `otherfiles`
--
ALTER TABLE `otherfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `others`
--
ALTER TABLE `others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `receive`
--
ALTER TABLE `receive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `space`
--
ALTER TABLE `space`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
