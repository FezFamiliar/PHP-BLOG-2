-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: dec. 03, 2019 la 02:45 PM
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
(2, 'Impozitee'),
(3, 'Taxe'),
(4, 'Curs Valutar'),
(5, 'Credite');

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
  `posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `posts`
--

INSERT INTO `posts` (`id`, `user_who_posted`, `category_id`, `title`, `message`, `posted`) VALUES
(1, 'peter', 1, 'F', '            \r\nF\r\n          ', '2019-12-03 04:29:17'),
(2, 'peter', 1, 'F', '            \r\nF\r\n          ', '2019-12-03 04:29:29'),
(3, 'Aarnduke', 1, 'f', '            fffff\r\n\r\n          ', '2019-12-03 04:29:54'),
(4, 'Aarnduke', 1, 'g', '            \r\ng\r\n          ', '2019-12-03 04:41:58'),
(5, 'trump', 1, 'TRUMP', 'trump            \r\n\r\n          ', '2019-12-03 04:49:02'),
(6, 'trump', 1, 'ggggg', 'ggggg\r\n\r\n          ', '2019-12-03 04:49:12'),
(7, 'trump', 1, 'ffff', 'fffffffff\r\n\r\n          ', '2019-12-03 04:49:25'),
(9, 'Aarnduke', 4, 'a', '            \r\n\r\n          a', '2019-12-03 05:13:39'),
(13, 'Aarnduke', 4, 'title', 'mesag            \r\n\r\n          ', '2019-12-03 05:27:53'),
(14, 'Aarnduke', 4, 'dfdffdfd', '            dfdfdfdfddddddddddddddddddddddddddddddddddddddddddddddddddd\r\n\r\n          ', '2019-12-03 05:28:03'),
(17, 'admin', 3, 'this is a message by admin', 'admin wwas here', '2019-12-03 05:36:31');

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
(23, 'trump', 'trump@yahoo.com', '6ad5d29de368db3dcf6f9d8e133a223a', '2019-12-03 04:48:53');

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pentru tabele `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pentru tabele `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
