-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 05 Kwi 2018, 17:57
-- Wersja serwera: 5.7.21-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bok`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Conversation`
--

CREATE TABLE `Conversation` (
  `id` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `supportId` int(11) DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Conversation`
--

INSERT INTO `Conversation` (`id`, `clientId`, `supportId`, `subject`) VALUES
(1, 2, 1, 'Issue #001'),
(2, 2, NULL, 'Test Conversation');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `conversationId` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `text` varchar(250) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `conversationId`, `senderId`, `text`) VALUES
(1, 1, 2, 'BOK Działa ale trzeba przetestować :)'),
(2, 2, 2, 'Test Message to conversation'),
(3, 1, 1, 'Odpowiadanie ze strony SUpportu Działa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `hash_pass` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `login`, `hash_pass`, `role`) VALUES
(1, 'Mateusz', '$2y$10$.dX3Wr.50BGul383Kljv6OJ5oY8mB3/jWdrufF/8/UjZKG1XzaLxK', 'Support'),
(2, 'User', '$2y$10$.bS6sbuMeQ/DIVdsPDEXleXMFkYayjj7XMsGQM/.2f7gOD3F3aKQ.', 'Client');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Conversation`
--
ALTER TABLE `Conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Conversation`
--
ALTER TABLE `Conversation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
