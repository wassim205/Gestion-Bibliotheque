-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 24 déc. 2024 à 14:13
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
-- Structure de la table `users`
--
CREATE DATABASE IF NOT EXISTS `library` ;
USE `library`;
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
(8, '', 'user@gmail.com', '$2y$10$t08pnC/MXhaUxgKrSyd.NOq.9/NSLfLetJdyU3//1bgwJe7cuSV1e', 'user', '2024-12-24 13:11:15');

--
-- Index pour les tables déchargées
--

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
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;















CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

INSERT INTO categories (name) VALUES
('Classic Literature'),
('Dystopian'),
('Romance'),
('Adventure'),
('Historical Fiction'),
('Young Adult'),
('Fantasy'),
('Philosophy'),
('Psychological Fiction'),
('Contemporary'),
('Post-Apocalyptic'),
('Survival'),
('Children\'s'),
('Historical Novel'),
('Satire'),
('Horror'),
('Science Fiction'),
('Magical Realism'),
('Social Commentary'),
('War Fiction');

CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    cover_image VARCHAR(255), 
    summary TEXT,
    status ENUM('available', 'borrowed', 'reserved') DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
INSERT INTO books (title, author, category_id, cover_image, summary, status) VALUES
('To Kill a Mockingbird', 'Harper Lee', 1, 'https://covers.openlibrary.org/b/id/8225261-L.jpg', 'A novel about the serious issues of race and rape in the Southern United States.', 'available'),
('1984', 'George Orwell', 2, 'https://covers.openlibrary.org/b/id/7222246-L.jpg', 'A dystopian novel about totalitarianism and surveillance.', 'borrowed'),
('Pride and Prejudice', 'Jane Austen', 3, 'https://covers.openlibrary.org/b/id/8231856-L.jpg', 'A romantic novel about manners and matrimonial machinations.', 'available'),
('The Great Gatsby', 'F. Scott Fitzgerald', 1, 'https://covers.openlibrary.org/b/id/8225631-L.jpg', 'A critique of the American Dream set in the 1920s.', 'reserved'),
('Moby Dick', 'Herman Melville', 4, 'https://covers.openlibrary.org/b/id/7222261-L.jpg', 'The tale of a sailor’s quest to hunt a great white whale.', 'available'),
('War and Peace', 'Leo Tolstoy', 5, 'https://covers.openlibrary.org/b/id/7222241-L.jpg', 'An epic novel about Napoleon’s invasion of Russia.', 'borrowed'),
('The Catcher in the Rye', 'J.D. Salinger', 6, 'https://covers.openlibrary.org/b/id/8225291-L.jpg', 'A story about teenage angst and alienation.', 'available'),
('The Hobbit', 'J.R.R. Tolkien', 7, 'https://covers.openlibrary.org/b/id/8235116-L.jpg', 'A fantasy novel about a hobbit’s adventure to reclaim treasure.', 'reserved'),
('Harry Potter and the Philosopher\'s Stone', 'J.K. Rowling', 7, 'https://covers.openlibrary.org/b/id/7984916-L.jpg', 'A young wizard discovers his magical heritage.', 'available'),
('The Alchemist', 'Paulo Coelho', 8, 'https://covers.openlibrary.org/b/id/8225636-L.jpg', 'A journey of self-discovery and pursuing one’s dreams.', 'available'),
('Crime and Punishment', 'Fyodor Dostoevsky', 9, 'https://covers.openlibrary.org/b/id/7222251-L.jpg', 'A psychological drama about crime and morality.', 'available'),
('The Kite Runner', 'Khaled Hosseini', 10, 'https://covers.openlibrary.org/b/id/8225637-L.jpg', 'A story of friendship and redemption set in Afghanistan.', 'borrowed'),
('Brave New World', 'Aldous Huxley', 2, 'https://covers.openlibrary.org/b/id/8225638-L.jpg', 'A dystopian novel about a genetically engineered future.', 'available'),
('Anna Karenina', 'Leo Tolstoy', 3, 'https://covers.openlibrary.org/b/id/7222242-L.jpg', 'A novel about love, betrayal, and societal expectations.', 'reserved'),
('The Road', 'Cormac McCarthy', 11, 'https://covers.openlibrary.org/b/id/8225639-L.jpg', 'A post-apocalyptic tale of survival and father-son bond.', 'available'),
('Life of Pi', 'Yann Martel', 12, 'https://covers.openlibrary.org/b/id/8225640-L.jpg', 'A tale of survival, faith, and companionship with a tiger.', 'borrowed'),
('The Little Prince', 'Antoine de Saint-Exupéry', 13, 'https://covers.openlibrary.org/b/id/8225641-L.jpg', 'A poetic tale about the meaning of life and friendship.', 'available'),
('Jane Eyre', 'Charlotte Brontë', 3, 'https://covers.openlibrary.org/b/id/8225642-L.jpg', 'A story about love, morality, and social class.', 'available'),
('Wuthering Heights', 'Emily Brontë', 3, 'https://covers.openlibrary.org/b/id/8225643-L.jpg', 'A gothic tale of love and revenge.', 'reserved'),
('The Lord of the Rings', 'J.R.R. Tolkien', 7, 'https://covers.openlibrary.org/b/id/8235117-L.jpg', 'An epic fantasy about the quest to destroy a powerful ring.', 'available'),
('The Picture of Dorian Gray', 'Oscar Wilde', 6, 'https://covers.openlibrary.org/b/id/8225644-L.jpg', 'A story about vanity and the consequences of a hedonistic lifestyle.', 'available'),
('A Tale of Two Cities', 'Charles Dickens', 14, 'https://covers.openlibrary.org/b/id/8225645-L.jpg', 'A historical novel about the French Revolution.', 'borrowed'),
('Don Quixote', 'Miguel de Cervantes', 15, 'https://covers.openlibrary.org/b/id/7222252-L.jpg', 'A comic tale of chivalry and adventures.', 'available'),
('Frankenstein', 'Mary Shelley', 16, 'https://covers.openlibrary.org/b/id/8225646-L.jpg', 'A gothic novel about the consequences of playing God.', 'available'),
('Dracula', 'Bram Stoker', 17, 'https://covers.openlibrary.org/b/id/8225647-L.jpg', 'A classic tale of the legendary vampire.', 'reserved'),
('Les Misérables', 'Victor Hugo', 14, 'https://covers.openlibrary.org/b/id/8225648-L.jpg', 'A story about justice, love, and redemption.', 'borrowed'),
('One Hundred Years of Solitude', 'Gabriel García Márquez', 18, 'https://covers.openlibrary.org/b/id/8225649-L.jpg', 'A magical realist story about a family’s history.', 'available'),
('The Grapes of Wrath', 'John Steinbeck', 19, 'https://covers.openlibrary.org/b/id/8225650-L.jpg', 'A novel about the Great Depression and societal struggles.', 'available'),
('Slaughterhouse-Five', 'Kurt Vonnegut', 20, 'https://covers.openlibrary.org/b/id/8225651-L.jpg', 'A satirical novel about war and time travel.', 'available'),
('The Book Thief', 'Markus Zusak', 11, 'https://covers.openlibrary.org/b/id/8225652-L.jpg', 'A story narrated by Death, about a girl in Nazi Germany.', 'borrowed');





insert into borrowings(user_id, book_id, borrow_date, due_date) 
VALUES(8, 2, '2024-12-27', '2025-01-01'),
(8, 6, '2024-12-27', '2025-01-01'),
(8, 12, '2024-12-27', '2025-01-01'),
(8, 16, '2024-12-27', '2025-01-01'),
(8, 22, '2024-12-27', '2025-01-01'),
(8, 26, '2024-12-27', '2025-01-01'),
(8, 30, '2024-27-12', '2025-01-01');