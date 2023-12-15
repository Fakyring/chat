SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chat`;

CREATE TABLE `convers` (
  `id_convers` int(11) NOT NULL,
  `id_creator` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_convers` int(11) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(30) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `convers`
  ADD PRIMARY KEY (`id_convers`),
  ADD KEY `id_creator` (`id_creator`);

ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `id_convers` (`id_convers`),
  ADD KEY `messages_ibfk_2` (`id_user`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`);


ALTER TABLE `convers`
  MODIFY `id_convers` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `convers`
  ADD CONSTRAINT `convers_ibfk_1` FOREIGN KEY (`id_creator`) REFERENCES `users` (`id_user`);

ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`id_convers`) REFERENCES `convers` (`id_convers`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
