CREATE DATABASE Library;
use Library;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 jan. 2025 à 09:57
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `status` enum('available','borrowed','reserved') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `category_id`, `cover_image`, `summary`, `status`, `created_at`) VALUES
(31, 'To Kill a Mockingbird', 'Harper Lee', 1, 'https://covers.openlibrary.org/b/id/8225261-L.jpg', 'A novel about the serious issues of race and rape in the Southern United States.', 'borrowed', '2024-12-25 13:33:49'),
(32, '1984', 'George Orwell', 2, 'https://covers.openlibrary.org/b/id/7222246-L.jpg', 'A dystopian novel about totalitarianism and surveillance.', 'available', '2024-12-25 13:33:49'),
(33, 'Pride and Prejudice', 'Jane Austen', 3, 'https://covers.openlibrary.org/b/id/8231856-L.jpg', 'A romantic novel about manners and matrimonial machinations.', 'borrowed', '2024-12-25 13:33:49'),
(34, 'The Great Gatsby', 'F. Scott Fitzgerald', 1, 'https://covers.openlibrary.org/b/id/8225631-L.jpg', 'A critique of the American Dream set in the 1920s.', 'available', '2024-12-25 13:33:49'),
(35, 'Moby Dick', 'Herman Melville', 4, 'https://covers.openlibrary.org/b/id/7222261-L.jpg', 'The tale of a sailor’s quest to hunt a great white whale.', 'borrowed', '2024-12-25 13:33:49'),
(36, 'War and Peace', 'Leo Tolstoy', 5, 'https://covers.openlibrary.org/b/id/7222241-L.jpg', 'An epic novel about Napoleon’s invasion of Russia.', 'borrowed', '2024-12-25 13:33:49'),
(37, 'The Catcher in the Rye', 'J.D. Salinger', 6, 'https://covers.openlibrary.org/b/id/8225291-L.jpg', 'A story about teenage angst and alienation.', 'available', '2024-12-25 13:33:49'),
(38, 'The Hobbit', 'J.R.R. Tolkien', 7, 'https://covers.openlibrary.org/b/id/8235116-L.jpg', 'A fantasy novel about a hobbit’s adventure to reclaim treasure.', 'borrowed', '2024-12-25 13:33:49'),
(39, 'Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 7, 'https://covers.openlibrary.org/b/id/7984916-L.jpg', 'A young wizard discovers his magical heritage.', 'available', '2024-12-25 13:33:49'),
(40, 'The Alchemist', 'Paulo Coelho', 8, 'https://covers.openlibrary.org/b/id/8225636-L.jpg', 'A journey of self-discovery and pursuing one’s dreams.', 'available', '2024-12-25 13:33:49'),
(41, 'Crime and Punishment', 'Fyodor Dostoevsky', 9, 'https://covers.openlibrary.org/b/id/7222251-L.jpg', 'A psychological drama about crime and morality.', 'borrowed', '2024-12-25 13:33:49'),
(42, 'The Kite Runner', 'Khaled Hosseini', 10, 'https://covers.openlibrary.org/b/id/8225637-L.jpg', 'A story of friendship and redemption set in Afghanistan.', 'available', '2024-12-25 13:33:49'),
(43, 'Brave New World', 'Aldous Huxley', 2, 'https://covers.openlibrary.org/b/id/8225638-L.jpg', 'A dystopian novel about a genetically engineered future.', 'available', '2024-12-25 13:33:49'),
(44, 'Anna Karenina', 'Leo Tolstoy', 3, 'https://covers.openlibrary.org/b/id/7222242-L.jpg', 'A novel about love, betrayal, and societal expectations.', 'available', '2024-12-25 13:33:49'),
(45, 'The Road', 'Cormac McCarthy', 11, 'https://covers.openlibrary.org/b/id/8225639-L.jpg', 'A post-apocalyptic tale of survival and father-son bond.', 'available', '2024-12-25 13:33:49'),
(46, 'Life of Pi', 'Yann Martel', 12, 'https://covers.openlibrary.org/b/id/8225640-L.jpg', 'A tale of survival, faith, and companionship with a tiger.', 'available', '2024-12-25 13:33:49'),
(47, 'The Little Prince', 'Antoine de Saint-Exupéry', 13, 'https://covers.openlibrary.org/b/id/8225641-L.jpg', 'A poetic tale about the meaning of life and friendship.', 'available', '2024-12-25 13:33:49'),
(48, 'Jane Eyre', 'Charlotte Brontë', 3, 'https://covers.openlibrary.org/b/id/8225642-L.jpg', 'A story about love, morality, and social class.', 'available', '2024-12-25 13:33:49'),
(49, 'Wuthering Heights', 'Emily Brontë', 3, 'https://covers.openlibrary.org/b/id/8225643-L.jpg', 'A gothic tale of love and revenge.', 'available', '2024-12-25 13:33:49'),
(50, 'The Lord of the Rings', 'J.R.R. Tolkien', 7, 'https://covers.openlibrary.org/b/id/8235117-L.jpg', 'An epic fantasy about the quest to destroy a powerful ring.', 'available', '2024-12-25 13:33:49'),
(51, 'The Picture of Dorian Gray', 'Oscar Wilde', 6, 'https://covers.openlibrary.org/b/id/8225644-L.jpg', 'A story about vanity and the consequences of a hedonistic lifestyle.', 'available', '2024-12-25 13:33:49'),
(52, 'A Tale of Two Cities', 'Charles Dickens', 14, 'https://covers.openlibrary.org/b/id/8225645-L.jpg', 'A historical novel about the French Revolution.', 'available', '2024-12-25 13:33:49'),
(53, 'Don Quixote', 'Miguel de Cervantes', 15, 'https://covers.openlibrary.org/b/id/7222252-L.jpg', 'A comic tale of chivalry and adventures.', 'available', '2024-12-25 13:33:49'),
(54, 'Frankenstein', 'Mary Shelley', 16, 'https://covers.openlibrary.org/b/id/8225646-L.jpg', 'A gothic novel about the consequences of playing God.', 'available', '2024-12-25 13:33:49'),
(55, 'Dracula', 'Bram Stoker', 17, 'https://covers.openlibrary.org/b/id/8225647-L.jpg', 'A classic tale of the legendary vampire.', 'available', '2024-12-25 13:33:49'),
(56, 'Les Misérables', 'Victor Hugo', 14, 'https://covers.openlibrary.org/b/id/8225648-L.jpg', 'A story about justice, love, and redemption.', 'available', '2024-12-25 13:33:49'),
(57, 'One Hundred Years of Solitude', 'Gabriel García Márquez', 18, 'https://covers.openlibrary.org/b/id/8225649-L.jpg', 'A magical realist story about a family’s history.', 'available', '2024-12-25 13:33:49'),
(58, 'The Grapes of Wrath', 'John Steinbeck', 19, 'https://covers.openlibrary.org/b/id/8225650-L.jpg', 'A novel about the Great Depression and societal struggles.', 'available', '2024-12-25 13:33:49'),
(59, 'Slaughterhouse-Five', 'Kurt Vonnegut', 20, 'https://covers.openlibrary.org/b/id/8225651-L.jpg', 'A satirical novel about war and time travel.', 'available', '2024-12-25 13:33:49'),
(60, 'The Book Thief', 'Markus Zusak', 11, 'https://covers.openlibrary.org/b/id/8225652-L.jpg', 'A story narrated by Death, about a girl in Nazi Germany.', 'available', '2024-12-25 13:33:49');

-- --------------------------------------------------------

--
-- Structure de la table `borrowings`
--

CREATE TABLE `borrowings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `notification_sent` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `borrowings`
--

INSERT INTO `borrowings` (`id`, `user_id`, `book_id`, `borrow_date`, `due_date`, `return_date`, `notification_sent`) VALUES
(41, 8, 31, '2025-01-01', '2025-01-16', '2025-01-01', 0),
(42, 8, 31, '2025-01-01', '2025-01-16', NULL, 0),
(43, 8, 33, '2025-01-01', '2025-01-16', '2025-01-01', 0),
(44, 8, 35, '2025-01-01', '2025-01-16', NULL, 0),
(45, 9, 32, '2025-01-01', '2025-01-16', '2025-01-01', 0),
(46, 9, 36, '2025-01-01', '2025-01-16', '2025-01-01', 0),
(47, 9, 38, '2025-01-01', '2025-01-16', NULL, 0),
(48, 9, 41, '2025-01-01', '2025-01-16', '2025-01-01', 0),
(49, 8, 36, '2025-01-01', '2025-01-15', NULL, 0),
(50, 9, 33, '2025-01-01', '2025-01-15', NULL, 0),
(51, 8, 41, '2025-01-01', '2025-01-15', '2025-01-02', 0),
(52, 9, 41, '2025-01-02', '2025-01-16', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Classic Literature'),
(2, 'Dystopian'),
(3, 'Romance'),
(4, 'Adventure'),
(5, 'Historical Fiction'),
(6, 'Young Adult'),
(7, 'Fantasy'),
(8, 'Philosophy'),
(9, 'Psychological Fiction'),
(10, 'Contemporary'),
(11, 'Post-Apocalyptic'),
(12, 'Survival'),
(13, 'Children\'s'),
(14, 'Historical Novel'),
(15, 'Satire'),
(16, 'Horror'),
(17, 'Science Fiction'),
(18, 'Magical Realism'),
(19, 'Social Commentary'),
(20, 'War Fiction'),
(21, 'Classic Literature'),
(22, 'Dystopian'),
(23, 'Romance'),
(24, 'Adventure'),
(25, 'Historical Fiction'),
(26, 'Young Adult'),
(27, 'Fantasy'),
(28, 'Philosophy'),
(29, 'Psychological Fiction'),
(30, 'Contemporary'),
(31, 'Post-Apocalyptic'),
(32, 'Survival'),
(33, 'Children\'s'),
(34, 'Historical Novel'),
(35, 'Satire'),
(36, 'Horror'),
(37, 'Science Fiction'),
(38, 'Magical Realism'),
(39, 'Social Commentary'),
(40, 'War Fiction');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reservation_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `book_id`, `user_id`, `reservation_date`) VALUES
(21, 35, 9, '2025-01-01'),
(24, 38, 8, '2025-01-01'),
(27, 31, 9, '2025-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(7, '', 'admin@gmail.com', '$2y$10$Z5Y3OUvGqq22YJXZdxF3feBcHtP.DuFsKdM5japZP78LbWmlzpLIG', 'admin', '2024-12-24 13:10:49'),
(8, '', 'user@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'user', '2024-12-24 13:11:15'),
(9, 'user2', 'user2@gmail.com', '$2y$10$0oT/LEQ1k.knep9Xf5K.S.CiVhShih6jvwDbQFvW4Pzui5AKnzzMS', 'user', '2024-12-26 08:39:57');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `borrowings`
--
ALTER TABLE `borrowings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `borrowings`
--
ALTER TABLE `borrowings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `borrowings`
--
ALTER TABLE `borrowings`
  ADD CONSTRAINT `borrowings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrowings_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
