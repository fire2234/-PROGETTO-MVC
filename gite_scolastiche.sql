-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 23, 2025 alle 07:07
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gite_scolastiche`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `adesioni`
--

CREATE TABLE `adesioni` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `adesioni`
--

INSERT INTO `adesioni` (`id`, `meta_id`, `user_id`) VALUES
(1, 3, 1),
(4, 4, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `mete`
--

CREATE TABLE `mete` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `data_gita` date DEFAULT NULL,
  `costo` decimal(10,2) DEFAULT NULL,
  `numero_partecipanti` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `mete`
--

INSERT INTO `mete` (`id`, `nome`, `descrizione`, `data_gita`, `costo`, `numero_partecipanti`, `user_id`) VALUES
(3, 'ger', 'rwgaerg', '2000-10-10', 30.00, 10, 2),
(4, 'dfdfg', 'wdfg', '2003-10-10', 20.00, 4, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `reviews`
--

INSERT INTO `reviews` (`id`, `meta_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(1, 4, 1, 3, 'adrf', '2025-04-23 06:48:58'),
(2, 3, 1, 3, 'bella', '2025-04-23 06:52:48');

-- --------------------------------------------------------

--
-- Struttura della tabella `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descrizione` text DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `costo_aggiuntivo` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tours`
--

INSERT INTO `tours` (`id`, `meta_id`, `nome`, `descrizione`, `durata`, `costo_aggiuntivo`) VALUES
(1, 3, 'san', 'panzerotto', 3, 30.00),
(2, 3, 'carre', 'pan', 4, 11.00),
(3, 4, 'DAVF', 'sdAf', 1, 1.00),
(4, 4, 'sd', 'sd', 20, 14.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `tour_adesioni`
--

CREATE TABLE `tour_adesioni` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tour_adesioni`
--

INSERT INTO `tour_adesioni` (`id`, `tour_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `cognome` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `cognome`, `nome`, `email`, `password`) VALUES
(1, 'aarsa', 'hassan', 'aarsaelmostafa6@gmail.com', '$2y$10$QlLN3ktIYqIvAoA7iT4pruJXIB8HOukzhJO1p6PUjJFne1D3vDbQG'),
(2, 'aarsa', 'ffg', 'admin@gmail.com', '$2y$10$nkihteyT.BS0CA9x6IxnVuekD77fQ0UCA7ydQafo/MY7Siobx3Dhq');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `adesioni`
--
ALTER TABLE `adesioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `meta_id` (`meta_id`,`user_id`);

--
-- Indici per le tabelle `mete`
--
ALTER TABLE `mete`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_id` (`meta_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indici per le tabelle `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meta_id` (`meta_id`);

--
-- Indici per le tabelle `tour_adesioni`
--
ALTER TABLE `tour_adesioni`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tour_user_unique` (`tour_id`,`user_id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `adesioni`
--
ALTER TABLE `adesioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `mete`
--
ALTER TABLE `mete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tour_adesioni`
--
ALTER TABLE `tour_adesioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`meta_id`) REFERENCES `mete` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`meta_id`) REFERENCES `mete` (`id`) ON DELETE CASCADE;

--
-- Limiti per la tabella `tour_adesioni`
--
ALTER TABLE `tour_adesioni`
  ADD CONSTRAINT `tour_adesioni_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
