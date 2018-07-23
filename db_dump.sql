-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Erstellungszeit: 23. Jul 2018 um 07:23
-- Server-Version: 5.6.38
-- PHP-Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Datenbank: `webshop`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `guestbook`
--

INSERT INTO `guestbook` (`id`, `name`, `text`, `date`) VALUES
  (1, 'Steve', 'Tolle Webseite, klasse Produkte, gerne wieder! *****', '2018-07-21 12:58:10');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`) VALUES
  (1, 'Tisch SJÄLLAND', 'Die Tischplatte besteht aus Eukalyptusholz und sorgt für aromatische Entspannung bei Frühstück, Mittag- und Abendessen.', 17900),
  (2, 'Tisch LACK', 'Praktisch, klein und günstig. Der Tisch für jeden Zweck.', 599),
  (3, 'Tisch INGO', 'Der Tisch ist aus massiver Kiefer, einem Naturmaterial, das in Würde altert.', 5900),
  (4, 'Schrank PAX', 'Außen schick und innen praktisch. Diese Regalkombination ist für jeden was.', 39100),
  (5, 'Regal KALLAX', 'Flexibel, quadratisch, praktisch, gut! Das Kallax Regal lässt sich stellen oder legen und passt so gut in jeden Raum.', 5900),
  (6, 'Regal BILLY', 'Billy ist der ewig moderne Favorit unter den Regalen.', 5900);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(128) NOT NULL,
  `data` text NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `username` varchar(128) NOT NULL DEFAULT '',
  `password` varchar(1024) NOT NULL DEFAULT '',
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`username`, `password`, `is_admin`) VALUES
  ('admin', '$2y$10$MlMCmvDpeujjiFVjxqmw3uG4xSACUqesbooyHjaotnCkvWi0.Ribm', 1),
  ('Judy', '$2y$10$qdC9LroYzH0omCVtBmPZquq3AiCZlCYXRdAMRPmAThBLxJTkrSVK.', 0),
  ('Max', '$2y$10$mRCNrmcF/vyWQql6UIdHGuApolIQOhqNjMA6.EPtCI5IZqXndJ8na', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
