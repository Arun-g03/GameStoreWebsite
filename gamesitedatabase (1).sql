-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 11:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamesitedatabase`
--
CREATE DATABASE IF NOT EXISTS `gamesitedatabase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gamesitedatabase`;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

DROP TABLE IF EXISTS `genres`;
CREATE TABLE IF NOT EXISTS `genres` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`ID`, `Name`) VALUES
(1, 'Action'),
(2, 'Adventure'),
(3, 'Casual'),
(112, 'Driving'),
(4, 'Educational'),
(5, 'Fighting'),
(6, 'FPS'),
(7, 'Horror'),
(8, 'MMORPG'),
(9, 'Music'),
(21, 'Online'),
(10, 'Platformer'),
(11, 'Puzzle'),
(12, 'Racing'),
(13, 'Rogue-like'),
(14, 'RPG'),
(15, 'Simulation'),
(16, 'Sports'),
(17, 'Stealth'),
(18, 'Strategy'),
(19, 'Survival'),
(20, 'Visual Novel');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

DROP TABLE IF EXISTS `login_details`;
CREATE TABLE IF NOT EXISTS `login_details` (
  `username` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`ID`, `Name`, `Username`, `Password`, `Email`) VALUES
(1, 'John Doe', 'user1', 'password1', 'user1@example.com'),
(2, 'Jane Smith', 'user2', 'password2', 'user2@example.com'),
(3, 'Mike Johnson', 'user3', 'password3', 'user3@example.com'),
(39, 'JohnSmith', 'jSmith', 'Password2024', 'jSmith@mail.com'),
(40, 'rasfasf', 'saedsvcedwsafgv', 'EWSefwwefgv32543245', 'asdfwaesfcd@segfer.com'),
(41, 'feawsfesvfger', 'grfebgebgrb', 'gdrfsgrwegswergv', 'jhntrfjnhtr@jrtjjt.com'),
(42, 'ytrshythbtsre', 'hhfzshtrezhntdz', 'rf3ewqtrfwe43tgfewfew', 'grzgzgbrfghr@hgterhbtr.com');

-- --------------------------------------------------------

--
-- Table structure for table `platforms`
--

DROP TABLE IF EXISTS `platforms`;
CREATE TABLE IF NOT EXISTS `platforms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platforms`
--

INSERT INTO `platforms` (`ID`, `Name`) VALUES
(1, 'PC'),
(2, 'PlayStation'),
(3, 'Xbox');

-- --------------------------------------------------------

--
-- Table structure for table `products_genres`
--

DROP TABLE IF EXISTS `products_genres`;
CREATE TABLE IF NOT EXISTS `products_genres` (
  `Product_ID` int(11) NOT NULL,
  `Genre_ID` int(11) NOT NULL,
  PRIMARY KEY (`Product_ID`,`Genre_ID`),
  KEY `Genre_ID` (`Genre_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_genres`
--

INSERT INTO `products_genres` (`Product_ID`, `Genre_ID`) VALUES
(6, 1),
(6, 8),
(6, 21),
(7, 1),
(7, 6),
(7, 19),
(7, 21),
(8, 1),
(8, 2),
(8, 6),
(8, 8),
(8, 14),
(8, 21),
(9, 1),
(9, 3),
(9, 18),
(9, 21),
(10, 1),
(10, 14),
(10, 18),
(11, 1),
(11, 3),
(11, 6),
(11, 18),
(11, 21),
(12, 2),
(12, 14),
(13, 1),
(13, 15),
(13, 18),
(13, 21),
(14, 1),
(14, 6),
(15, 3),
(15, 11),
(15, 18),
(20, 1),
(20, 17),
(20, 18),
(21, 1),
(21, 6),
(21, 18),
(21, 21),
(22, 1),
(22, 6),
(22, 18),
(22, 21),
(23, 1),
(23, 2),
(23, 5),
(23, 13),
(23, 18),
(24, 1),
(24, 5),
(24, 6),
(24, 18),
(24, 21),
(25, 1),
(25, 2),
(25, 5),
(25, 13),
(25, 14),
(25, 18),
(25, 21),
(26, 3),
(26, 12),
(26, 15),
(26, 21),
(26, 112),
(27, 1),
(27, 2),
(27, 6),
(27, 21),
(28, 1),
(28, 2),
(28, 6),
(28, 21);

-- --------------------------------------------------------

--
-- Table structure for table `products_platforms`
--

DROP TABLE IF EXISTS `products_platforms`;
CREATE TABLE IF NOT EXISTS `products_platforms` (
  `Product_ID` int(11) NOT NULL,
  `Platform_ID` int(11) NOT NULL,
  PRIMARY KEY (`Product_ID`,`Platform_ID`),
  KEY `Platform_ID` (`Platform_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_platforms`
--

INSERT INTO `products_platforms` (`Product_ID`, `Platform_ID`) VALUES
(6, 1),
(6, 2),
(6, 3),
(7, 1),
(7, 2),
(7, 3),
(8, 1),
(8, 2),
(8, 3),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(10, 3),
(11, 1),
(11, 2),
(11, 3),
(12, 1),
(12, 2),
(12, 3),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(20, 1),
(20, 2),
(20, 3),
(21, 1),
(21, 2),
(21, 3),
(22, 1),
(22, 2),
(22, 3),
(23, 1),
(23, 2),
(24, 1),
(25, 1),
(25, 2),
(25, 3),
(26, 1),
(26, 2),
(26, 3),
(27, 1),
(27, 3),
(28, 1),
(28, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

DROP TABLE IF EXISTS `product_table`;
CREATE TABLE IF NOT EXISTS `product_table` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Release_date` date DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Image1` varchar(255) DEFAULT NULL,
  `Image2` varchar(255) DEFAULT NULL,
  `Image3` varchar(255) DEFAULT NULL,
  `Discount` float DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`ID`, `Title`, `Release_date`, `Description`, `Price`, `Image1`, `Image2`, `Image3`, `Discount`) VALUES
(6, 'Grand Theft Auto V', '2013-11-13', 'Welcome to Los Santos: a sprawling sun-soaked metropolis full of self-help gurus, starlets, and fading celebrities. Once the envy of the Western world, the city is now struggling to stay afloat in an era of economic uncertainty and cheap reality TV. Amidst the turmoil, three very different criminals plot their own chances of survival and success.\r\n\r\nMichael De Santa, a retired bank robber with a seemingly perfect life that’s anything but; Franklin Clinton, a street hustler looking for real opportunities and serious money; and Trevor Philips, a violent maniac driven by the next big score. With no options left, the crew risks everything in a series of daring and dangerous heists that could set them up for life.\r\n\r\nExplore the stunning open world of Los Santos and Blaine County, from the tops of mountains to the depths of the ocean. Experience the interconnected lives of three unique characters, switching between them to pull off complex missions and witness their intertwining stories. Navigate through a city filled with action, adventure, and opportunities, where every choice matters.\r\n\r\nEngage in a wide array of activities, from high-speed chases and epic heists to yoga and golf. Customize your vehicles, properties, and outfits. Enjoy a massive online multiplayer experience in GTA Online, where you can join your friends in cooperative missions, races, and other game modes, or create your own unique content.', 29.99, 'Images\\4064_Grand_Theft_Auto_V-1935282683.jpg', 'Images\\gta_5-2554494705.jpg', 'Images\\gta_5-3308256991.jpg', 0.1),
(7, 'Call of Duty®: Black Ops Cold War', '2023-04-23', 'Black Ops Cold War, the direct sequel to Call of Duty®: Black Ops, will drop fans into the depths of the Cold Wars volatile geopolitical battle of the early 1980s.', 29.99, 'Images\\COD_Cold_War_Cover.png', 'Images\\COD_Cold_War_GP1.jpg', '', 0.25),
(8, 'Destiny 2', '2019-10-01', 'The last safe city on Earth has fallen to Ghaul, the ruthless leader of the Red Legion, who has stripped the Guardians of their Light. Forced to flee, you must venture to unexplored worlds in our solar system, discovering powerful weapons and devastating new abilities. To reclaim our home and defeat the Red Legion, you must reunite humanity’s scattered heroes and stand together against the darkness.\r\n\r\nThe story delves into the essence of the Light, exploring the desperation of Guardians without it and Ghaul\'s obsession with its power. Journey through diverse landscapes, from the sands of Mercury to the icy expanses of Europa, and confront formidable enemies, including the Vex, Hive, and Fallen. Witness the awakening of ancient threats and the emergence of new ones, as the Traveler\'s light beckons both hope and danger.\r\n\r\nUncover the secrets of the Golden Age on Mars, avenge fallen comrades in the Prison of Elders, and face off against the Witch Queen in her twisted Throne World. As the Witness, the ultimate adversary, arrives with his Disciple Emperor Calus, you must race to secure a mysterious artifact, the Veil, hidden on Neptune.\r\n\r\nDecades, centuries, and millennia of conflict culminate in this epic showdown. The Witness has transformed the Traveler, and now, the path to ultimate destiny lies open. From the ruins of Old Russia to the furthest reaches of the Sol System, you must face all manner of foes, from marauding pirates to time-bending machines and eldritch horrors.\r\n\r\nIt’s time to become legend. Confront the being responsible for it all and show the universe what it truly means to be a Guardian.', 0.00, 'Images\\destiny2.jpg', 'Images\\destiny_2_2019_4k-HD-3422947999.jpg', 'Images\\destiny-2-lightfall-strand-01-2829424714.jpg', 0),
(9, 'EARTH DEFENSE FORCE 5', '2019-07-11', 'Stand and fight for humanity. This arcade shooter takes place in the year 2022, as the Earth Defence Force fends off an all-out attack by unknown life forms. Become an EDF soldier, battle against endless hordes of immense enemies, and restore peace to the earth.', 15.99, 'Images\\edf5.png', 'Images\\edf5_1.jpg', 'Images\\earth-defense-force-5-scaled-329178735.jpg', 0.1),
(10, 'Helldivers', '2015-12-07', 'HELLDIVERS™ is a hardcore, cooperative, twin stick shooter. As part of the elite unit called the HELLDIVERS, players must work together to protect SUPER EARTH and defeat the enemies of mankind in an intense intergalactic war.', 29.99, 'Images\\HellDivers.png', 'Images\\helldivers_gp.jpg', '', 0.2),
(11, 'The Finals', '2023-12-08', 'Join THE FINALS, the world-famous, free-to-play, combat-centred game show! Fight alongside your teammates in virtual arenas that you can alter, exploit, and even destroy. Build your own playstyle in this first-person shooter to win escalating tournaments and lasting fame.', 0.00, 'Images/the-finals-xbox-series-front-cover-.png', 'Images\\The-Finals-screenshot-M60-Panda-328604218.jpg', 'Images\\The-Finals-505538196.jpg', 0),
(12, 'Fallout 4', '2015-11-10', 'Bethesda Game Studios, the award-winning creators of Fallout 3 and The Elder Scrolls V: Skyrim, welcome you to the world of Fallout 4 – their most ambitious game ever, and the next generation of open-world gaming.', 14.99, 'Images\\fallout4cover.jpg', 'Images\\FO4_GamePlay.jpg', '', 0.2),
(13, 'War Thunder', '2012-11-01', 'War Thunder is a free-to-play vehicular combat multiplayer video game developed and published by Gaijin Entertainment. Announced in 2011, it was first released in November 2012 as an open beta with a worldwide release in January 2013; it had its official release on December 21, 2016. It has a cross-platform format for Microsoft Windows, macOS, Linux, PlayStation 4, Xbox One, PlayStation 5, Xbox Series X/S, Oculus, and Vive', 0.00, 'Images\\war-thunder-logo-570714012.jpeg', 'Images\\warthunder.jpeg', 'Images\\warthunder_planetank.jpg', 0),
(14, 'Back 4 Blood', '2021-10-12', 'Back 4 Blood is a thrilling cooperative first-person shooter from the creators of the critically acclaimed Left 4 Dead franchise. Experience the intense 4 player co-op narrative campaign, competitive multiplayer as human or Ridden, and frenetic gameplay that keeps you in the action.', 49.99, 'Images\\Back4Blood_Cover.jpeg', 'Images\\Back_4_Blood_-_PC_Trailer-1920954994.jpg', 'Images\\back-4-blood-characters-1051168856.jpg', 0),
(15, 'Factorio', '2020-08-14', 'Factorio is a game about building and creating automated factories to produce items of increasing complexity, within an infinite 2D world. Use your imagination to design your factory, combine simple elements into ingenious structures, and finally protect it from the creatures who dont really like you.', 30.00, 'Images\\factorio-cover.cover_large-1577639482.jpg', 'Images\\factoriio-bild.jpg', 'Images\\factorio_rocket.png', 0),
(20, 'Hitman 3', '2021-01-20', 'Hitman World of Assassination brings together the best of Hitman, Hitman 2 and Hitman 3 including the main campaign, contracts mode, escalations, elusive target arcades and the new Hitman: Freelancer.\r\nExperience a truly globetrotting spy-thriller campaign in Hitman World of Assassination. From the ICA Facility and Agent 47’s training to the dramatic conclusion in the Carpathian Mountains of Romania, eliminate targets as creatively or stealthily as you want.\r\n\r\nHitman World of Assassination includes all missions from Hitman 1, 2 and 3 and simplifies the way to play through the entire trilogy through one interface.\r\n\r\nVisit exotic, meticulously detailed locations packed with creative opportunities - a tactile and immersive game world that offers unparalleled player choice and replayability.\r\n\r\nWhere to go, when to strike and who to kill - it is all up to you.', 57.99, 'Images\\Hitman_Cover.jpg', 'Images\\Hitman_GP.jpg', 'Images\\Hitman_GP2.jpg', 0.05),
(21, 'Hell Let Loose', '2021-07-27', 'Join the ever expanding experience of Hell Let Loose - a hardcore World War Two first person shooter with epic battles of 100 players with infantry, tanks, artillery, a dynamically shifting front line and a unique resource based RTS-inspired meta-game.', 49.99, 'Images\\Hell-Let-Loose-jpg-1886353746.jpg', 'Images\\Hell-Let-Loose-GP.jpg', 'Images\\Hell-Let-Loose-GP2.jpg', 0),
(22, 'Tom Clancy\'s Rainbow Six® Siege', '2015-12-01', 'Tom Clancy\'s Rainbow Six® Siege is an elite, tactical team-based shooter where superior planning and execution triumph.', 15.99, 'Images\\r6Siege_Cover.jpg', 'Images\\r6Siege_Cover2.jpg', 'Images\\r6Siege_Cover3.jpg', 0),
(23, 'Ghost of Tsushima - DIRECTOR\'S CUT', '2024-05-16', 'A storm is coming. Venture into the complete Ghost of Tsushima DIRECTOR’S CUT on PC; forge your own path through this open-world action adventure and uncover its hidden wonders. Brought to you by Sucker Punch Productions, Nixxes Software and PlayStation Studios.', 49.99, 'Images\\Ghost_of_tsushima_cover.png', 'Images\\Ghost_of_tsushima_GP1.png', 'Images\\Ghost_of_tsushima_GP2.png', 0),
(24, 'Counter-Strike 2', '2012-08-21', 'For over two decades, Counter-Strike has offered an elite competitive experience, one shaped by millions of players from across the globe. And now the next chapter in the CS story is about to begin. This is Counter-Strike 2.', 0.00, 'Images\\CounterStrike_Cover.jpeg', 'Images\\CounterStrike_GP1.jpeg', '', 0),
(25, 'Elden Ring', '2022-02-24', 'THE NEW FANTASY ACTION RPG.\r\nRise, Tarnished, and be guided by grace to brandish the power of the Elden Ring and become an Elden Lord in the Lands Between.\r\n• A Vast World Full of Excitement\r\nA vast world where open fields with a variety of situations and huge dungeons with complex and three-dimensional designs are seamlessly connected. As you explore, the joy of discovering unknown and overwhelming threats await you, leading to a high sense of accomplishment.\r\n• Create your Own Character\r\nIn addition to customizing the appearance of your character, you can freely combine the weapons, armor, and magic that you equip. You can develop your character according to your play style, such as increasing your muscle strength to become a strong warrior, or mastering magic.\r\n• An Epic Drama Born from a Myth\r\nA multilayered story told in fragments. An epic drama in which the various thoughts of the characters intersect in the Lands Between.\r\n• Unique Online Play that Loosely Connects You to Others\r\nIn addition to multiplayer, where you can directly connect with other players and travel together, the game supports a unique asynchronous online element that allows you to feel the presence of others.\r\nMATURE CONTENT DESCRIPTION', 49.99, 'Images\\elden-ring_cover.jpg', 'Images\\elden-ring-GP1.jpg', 'Images\\elden-ring-GP2.jpg', 0),
(26, 'The Crew 2', '2018-06-29', 'JOIN A COMMUNITY OF 30 MILLION PLAYERS! Get ready for a high-speed trip across the USA and enjoy one of the most complete open-world action driving experiences ever created. With dozens of new game modes, tracks, vehicles, events, and more added every season, The Crew® 2 has all you need for an unforgettable ride.\r\n\r\nTake on the American motorsports scene, discover exhilarating landscapes and pick your favorite vehicles among hundreds. Experience the thrill and excitement of competing across the USA as you test your skills in a wide range of disciplines. Record every heart-pounding moment and share them with the push of a button - fame is yours to take! Play with up to seven friends online.', 41.99, 'Images\\TheCrew2_Cover.png', 'Images\\TheCrew2_GP1.png', 'Images\\TheCrew2_GP2.png', 0),
(27, 'Halo: Reach', '2019-12-03', 'Experience the tragic and heroic story of Noble Team, a group of Spartans, who through great sacrifice and courage, saved countless lives in the face of impossible odds. The planet Reach is humanity’s last line of defense between the encroaching Covenant and their ultimate goal, the destruction of Earth. If it falls, humanity will be pushed to the brink of destruction.\r\nEnjoy iconic Halo multiplayer** experiences with generation-defining player customization, unforgettable maps and classic game modes. Battle alone or with squad mates in Firefight to survive against endless waves of enemies deploying with ever-increasing difficulty.', 8.99, 'Images\\HaloReach_Cover.jpg', 'Images\\HaloReach_GP1.jpg', 'Images\\HaloReach_GP2.jpg', 0),
(28, 'Halo 3', '2020-07-14', 'Step into the boots of Spartan-117 and experience the epic conclusion of the Human-Covenant War. Crash-landing in an African jungle, the Master Chief must fight alongside Arbiter Thel, Vadam and the remaining UNSC forces against relentless Covenant and Flood enemies. Battle through diverse and treacherous environments, from the dense jungles to the UNSC stronghold & Crow\'s Nest and the ancient ruins of New Mombasa.\r\n\r\nJoin Commander Miranda Keyes and Fleet Admiral Terrence Hood in a desperate bid to stop the Covenant from activating a catastrophic Forerunner artifact. Uncover hidden secrets and face harrowing challenges as you dismantle enemy defenses, rescue captured comrades, and thwart the Flood infestation.\r\n\r\nVenture beyond the Milky Way to the Ark, deactivate the Halo Array, and confront the truths behind the Covenant&#039;s religious fervor. With the fate of the galaxy hanging in the balance, team up with the Arbiter to stop the Prophet of Truth and the Gravemind. Experience unforgettable moments of heroism, betrayal, and sacrifice.\r\n\r\nPrepare for heart-pounding action, immersive storytelling, and the iconic Halo multiplayer that defined a generation. Will you save humanity and achieve peace, or will the fires of the Great Journey consume all? The end begins with Halo 3.', 8.99, 'Images\\Halo3_Cover.jpg', 'Images\\Halo3_GP1.jpg', 'Images\\Halo3_GP2.jpg', 0.25);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `thumbs_up` int(11) DEFAULT 0,
  `thumbs_down` int(11) DEFAULT 0,
  PRIMARY KEY (`review_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `thumbs_up`, `thumbs_down`) VALUES
(1, 25, 50, 25),
(3, 15, 1, 0),
(4, 25, 1, 0),
(5, 6, 2, 30),
(6, 7, 51, 28),
(7, 8, 70, 46),
(8, 9, 34, 49),
(9, 10, 21, 12),
(10, 11, 80, 48),
(11, 12, 48, 45),
(12, 13, 91, 36),
(13, 14, 23, 40),
(14, 15, 87, 42),
(15, 20, 22, 38),
(16, 21, 43, 40),
(17, 22, 61, 19),
(18, 23, 24, 21),
(19, 24, 43, 32),
(20, 25, 83, 20),
(21, 26, 61, 30),
(22, 27, 47, 37),
(23, 28, 17, 25);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products_genres`
--
ALTER TABLE `products_genres`
  ADD CONSTRAINT `products_genres_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product_table` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_genres_ibfk_2` FOREIGN KEY (`Genre_ID`) REFERENCES `genres` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `products_platforms`
--
ALTER TABLE `products_platforms`
  ADD CONSTRAINT `products_platforms_ibfk_1` FOREIGN KEY (`Product_ID`) REFERENCES `product_table` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_platforms_ibfk_2` FOREIGN KEY (`Platform_ID`) REFERENCES `platforms` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
