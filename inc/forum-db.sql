-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Sep 2017 um 09:10

-- Server-Version: 10.1.10-MariaDB
-- PHP-Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `forum-db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `benutzer`
--

CREATE TABLE `benutzer` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regkey` varchar(255) NOT NULL,
  `activated` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Userinformationen';

--
-- Daten für Tabelle `benutzer`
--

INSERT INTO `benutzer` (`id`, `username`, `password`, `salt`, `email`, `regkey`, `activated`, `role`) VALUES
(43, 'Azragh', '8d643b643081685e2e48cfe06d49d2f5c57a48a1846372b35d0b53aef2a80f67', '485fa30034f61642', 'geiserdaniel@hotmail.ch', '76428a4bd5b152fef71ee4328801222f', 1, 'admin'),
(51, 'Ezrath', '446151639bccfa2ccdb5d2de8dec0c3457da0561de1073b1221fa52b6780df1b', '2e527fa04f8a33d6', 'daniel.geiser@new-time.ch', '89d185ee8fb4edad12897cbdb69ee08c', 1, 'user');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `msgfrom` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `msgto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `threadID` int(11) NOT NULL,
  `user_ip` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ratings`
--

INSERT INTO `ratings` (`id`, `threadID`, `user_ip`) VALUES
(9, 24, '::1'),
(10, 35, '::1'),
(11, 17, '::1'),
(12, 23, '::1'),
(13, 35, '192.168.1.75');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `threadID` int(11) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `author` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `replies`
--

INSERT INTO `replies` (`id`, `threadID`, `content`, `author`, `status`) VALUES
(131, 17, 'Kommentar vom Administrator - yo!', 'Azragh', 1),
(133, 17, 'Und gleich nochmals einer.. sollte den neuen link in der subscription_mail enthalten..', 'Azragh', 1),
(134, 17, 'und gleich der notification-test!', 'Azragh', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL,
  `threadID` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `threadID`, `email`) VALUES
(5, '24', 'geiserdaniel@hotmail.ch');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `threads`
--

CREATE TABLE `threads` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `author` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `totalRatings` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `threads`
--

INSERT INTO `threads` (`id`, `title`, `content`, `author`, `rating`, `totalRatings`, `tags`, `date`) VALUES
(17, 'Lorem Ipsum - yo!', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. \r\n\r\nNulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.\r\n\r\nPhasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. \r\n\r\nMaecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh.', 'Azragh', 3, 1, 'lorem, ipsum, dolor, sit, amet', '12.03.15'),
(23, 'EinhÃ¶rner und Ihre VorzÃ¼ge', 'Weit hinten, hinter den Wortbergen, fern der LÃ¤nder Vokalien und Konsonantien leben die Blindtexte. Abgeschieden wohnen sie in Buchstabhausen an der KÃ¼ste des Semantik, eines groÃŸen Sprachozeans. \r\n\r\nEin kleines BÃ¤chlein namens Duden flieÃŸt durch ihren Ort und versorgt sie mit den nÃ¶tigen Regelialien. Es ist ein paradiesmatisches Land, in dem einem gebratene Satzteile in den Mund fliegen. Nicht einmal von der allmÃ¤chtigen Interpunktion werden die Blindtexte beherrscht â€“ ein geradezu unorthographisches Leben. \r\n\r\nEines Tages aber beschloÃŸ eine kleine Zeile Blindtext, ihr Name war Lorem Ipsum, hinaus zu gehen in die weite Grammatik', 'Einhornpony', 4, 1, 'ipsum, lorem', '10.04.16'),
(24, '&lt;h1&gt;HTML Entities Test&lt;/h1&gt;', '&lt;strong&gt;HTML&lt;/strong&gt; sollte nun nicht mehr funktionieren..', 'Azragh', 1, 1, 'ipsum', '13.04.16'),
(35, 'Ein weiterer Test..', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.', 'Azragh', 5, 2, 'lorem, ipsum', '18.04.16');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `benutzer`
--
ALTER TABLE `benutzer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT für Tabelle `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT für Tabelle `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
