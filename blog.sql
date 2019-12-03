-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: dec. 03, 2019 la 05:15 PM
-- Versiune server: 10.4.8-MariaDB
-- Versiune PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `blog`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(6) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'TVA'),
(2, 'Impozite'),
(3, 'Taxe'),
(4, 'Curs Valutar'),
(5, 'Credite');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `comments`
--

CREATE TABLE `comments` (
  `id` int(6) NOT NULL,
  `post_id` int(6) NOT NULL,
  `comment` text NOT NULL,
  `commented` datetime NOT NULL,
  `who_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment`, `commented`, `who_comment`) VALUES
(14, 29, 'Foarte fain frate!', '2019-12-03 08:13:21', 'Aarnduke'),
(15, 29, 'this is obnoxious!   \r\n          ', '2019-12-03 08:14:02', 'trump'),
(16, 31, '            \r\n     fffff    ', '2019-12-03 08:14:30', 'trump');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `posts`
--

CREATE TABLE `posts` (
  `id` int(6) NOT NULL,
  `user_who_posted` text NOT NULL,
  `category_id` int(6) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `posted` datetime NOT NULL,
  `comment_` text NOT NULL,
  `who_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `posts`
--

INSERT INTO `posts` (`id`, `user_who_posted`, `category_id`, `title`, `message`, `posted`, `comment_`, `who_comment`) VALUES
(27, 'admin', 3, 'fffff', 'fffffffff', '2019-12-03 06:42:42', 'ffff', 'peterke'),
(29, 'admin', 4, 'euro moare', 'moare rau', '2019-12-03 06:43:49', 'nagyon szep igazan\r\n            \r\n          ', 'peterke'),
(30, 'admin', 4, 'ff', 'fff', '2019-12-03 06:46:57', '', ''),
(31, 'admin', 4, 'eee', 'eeeeee', '2019-12-03 06:49:57', 'foarte frumos', 'Aarnduke');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `joined` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `joined`) VALUES
(1, 'aarnduke', 'arrnduke@yahoo.com', 'a643249416814e8185957c158ec2c169', '2019-12-03 03:39:38'),
(22, 'peter', 'peter@yahoo.com', 'f08e2a44ff938ba1fee15597f59e11eb', '2019-12-03 04:24:56'),
(23, 'trump', 'trump@yahoo.com', '6ad5d29de368db3dcf6f9d8e133a223a', '2019-12-03 04:48:53'),
(26, 'peterke', 'peterke@yahoo.com', '83878c91171338902e0fe0fb97a8c47a', '2019-12-03 07:45:21'),
(27, 'trump', 'trump@Yahoo.com', 'a643249416814e8185957c158ec2c169', '2019-12-03 08:13:49');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexuri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexuri pentru tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pentru tabele `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pentru tabele `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constrângeri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
