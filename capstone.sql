-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 07:56 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `areaNum` int(2) NOT NULL,
  `areaName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `areaNum`, `areaName`) VALUES
(1, 1, 'Mission, goals and objectives'),
(2, 2, 'Faculty'),
(3, 3, 'Curriculum and Instruction'),
(4, 4, 'Support to Students'),
(5, 5, 'Research'),
(6, 6, 'Extension and Community Involvement'),
(7, 7, 'Library'),
(8, 8, 'Physical Facilities'),
(9, 9, 'Laboratories'),
(10, 10, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `assessment`
--

CREATE TABLE `assessment` (
  `assessID` int(11) NOT NULL,
  `content` text,
  `assessUser` int(11) DEFAULT NULL,
  `file` int(11) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `type` enum('general','specific') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment`
--

INSERT INTO `assessment` (`assessID`, `content`, `assessUser`, `file`, `date`, `type`) VALUES
(13, 'lkfg', 62, NULL, 'May  13, 2021', 'general');

-- --------------------------------------------------------

--
-- Table structure for table `assigntask`
--

CREATE TABLE `assigntask` (
  `id` int(11) NOT NULL,
  `user` int(11) DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `program` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comID` int(11) NOT NULL,
  `content` text,
  `comUser` int(11) DEFAULT NULL,
  `file` int(11) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_file`
--

CREATE TABLE `evaluation_file` (
  `fileID` int(11) NOT NULL,
  `fileName` text,
  `path` int(11) DEFAULT NULL,
  `levelID` int(11) DEFAULT NULL,
  `uploader` int(11) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluation_file`
--

INSERT INTO `evaluation_file` (`fileID`, `fileName`, `path`, `levelID`, `uploader`, `time`, `date`) VALUES
(1, 'GitHub - ryanmcdermott_clean-code-javascript_ Clean Code concepts adapted for JavaScript.pdf', 21, 31, 62, '01:52 pm', 'May  20,  2021');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `fileName` text,
  `path` text,
  `uploader` int(11) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `status` enum('notArchived','archived') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `fileName`, `path`, `uploader`, `time`, `date`, `status`) VALUES
(13, 'pic3.jpg', 'slider', 14, 'B', NULL, 'notArchived'),
(14, 'pic4.jpg', 'slider', 14, 'C', NULL, 'notArchived'),
(15, 'pic5.jpg', 'slider', 14, 'A', NULL, 'notArchived'),
(16, 'pic6.jpg', 'slider', 14, 'F', NULL, 'notArchived'),
(17, 'pic7.jpg', 'slider', 14, 'D', NULL, 'notArchived'),
(19, 'pic9.jpg', 'slider', 14, 'G', NULL, 'notArchived'),
(20, 'pic1.jpg', 'slider', 14, 'E', NULL, 'notArchived'),
(46, 'GitHub - ryanmcdermott_clean-code-javascript_ Clean Code concepts adapted for JavaScript.pdf', 'Archive', 14, '01:31 pm', 'May  20,  2021', 'archived');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `levelID` int(11) NOT NULL,
  `levelName` varchar(50) DEFAULT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`levelID`, `levelName`, `num`) VALUES
(31, 'PSV', 1),
(32, 'Level 1', 2),
(33, 'Level 2', 3),
(34, 'Level 3', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notifyID` int(11) NOT NULL,
  `category` enum('upload','comment','assign','deleteAll','deleteSingle') DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `fileID` int(11) DEFAULT NULL,
  `usersID` int(11) DEFAULT NULL,
  `title` text,
  `assignTaskID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notifyID`, `category`, `date`, `time`, `fileID`, `usersID`, `title`, `assignTaskID`) VALUES
(1, 'deleteSingle', 'Apr  22,  2021', '05:06 pm', NULL, 14, 'Letters', NULL),
(2, 'deleteSingle', 'Apr  22,  2021', '05:06 pm', NULL, 14, 'Letters', NULL),
(36, 'deleteSingle', 'May  17,  2021', '03:52 pm', NULL, 14, 'Letters', NULL),
(37, 'deleteSingle', 'May  17,  2021', '04:51 pm', NULL, 14, 'Letters', NULL),
(40, 'deleteSingle', 'May  20,  2021', '01:23 pm', NULL, 14, 'Letters', NULL),
(41, 'deleteSingle', 'May  20,  2021', '01:23 pm', NULL, 14, 'Letters', NULL),
(42, 'deleteSingle', 'May  20,  2021', '01:23 pm', NULL, 14, 'Letters', NULL),
(43, 'deleteSingle', 'May  20,  2021', '01:23 pm', NULL, 14, 'Letters', NULL),
(46, 'deleteSingle', 'May  20,  2021', '01:27 pm', NULL, 14, 'Letters', NULL),
(47, 'deleteSingle', 'May  20,  2021', '01:27 pm', NULL, 14, 'Letters', NULL),
(48, 'deleteAll', 'May  20,  2021', '01:28 pm', NULL, 14, 'mgh', NULL),
(49, 'deleteAll', 'May  20,  2021', '01:31 pm', NULL, 14, 'kjnkd', NULL),
(51, 'deleteAll', 'May  20,  2021', '01:31 pm', NULL, 14, ',mdnfkvssv', NULL),
(52, 'deleteAll', 'May  20,  2021', '01:32 pm', NULL, 14, 'dklfngld', NULL),
(53, 'deleteAll', 'May  20,  2021', '01:33 pm', NULL, 14, 'mn mn', NULL),
(54, 'deleteAll', 'May  20,  2021', '01:38 pm', NULL, 14, 'New Folder', NULL),
(56, 'deleteSingle', 'May  20,  2021', '01:42 pm', NULL, 14, 'Letters', NULL),
(58, 'deleteSingle', 'May  20,  2021', '01:43 pm', NULL, 14, 'Letters', NULL),
(60, 'deleteSingle', 'May  20,  2021', '01:46 pm', NULL, 14, 'Letters', NULL),
(62, 'deleteSingle', 'May  20,  2021', '01:47 pm', NULL, 14, 'Letters', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notify`
--

CREATE TABLE `notify` (
  `noteID` int(11) NOT NULL,
  `notifyID` int(11) DEFAULT NULL,
  `usersID` int(11) DEFAULT NULL,
  `status` enum('opened','unopened') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notify`
--

INSERT INTO `notify` (`noteID`, `notifyID`, `usersID`, `status`) VALUES
(1, 1, 14, 'opened'),
(2, 1, 61, 'unopened'),
(3, 1, 68, 'unopened'),
(4, 1, 69, 'unopened'),
(5, 1, 70, 'unopened'),
(6, 1, 71, 'unopened'),
(7, 1, 72, 'unopened'),
(8, 1, 73, 'unopened'),
(9, 1, 74, 'unopened'),
(10, 1, 75, 'unopened'),
(11, 1, 76, 'unopened'),
(12, 1, 77, 'unopened'),
(13, 1, 78, 'unopened'),
(14, 1, 79, 'unopened'),
(15, 1, 80, 'unopened'),
(16, 1, 81, 'unopened'),
(17, 1, 82, 'unopened'),
(18, 1, 83, 'unopened'),
(19, 1, 84, 'unopened'),
(20, 1, 85, 'unopened'),
(21, 1, 14, 'opened'),
(22, 1, 61, 'unopened'),
(23, 1, 68, 'unopened'),
(24, 1, 69, 'unopened'),
(25, 1, 70, 'unopened'),
(26, 1, 71, 'unopened'),
(27, 1, 72, 'unopened'),
(28, 1, 73, 'unopened'),
(29, 1, 74, 'unopened'),
(30, 1, 75, 'unopened'),
(31, 1, 76, 'unopened'),
(32, 1, 77, 'unopened'),
(33, 1, 78, 'unopened'),
(34, 1, 79, 'unopened'),
(35, 1, 80, 'unopened'),
(36, 1, 81, 'unopened'),
(37, 1, 82, 'unopened'),
(38, 1, 83, 'unopened'),
(39, 1, 84, 'unopened'),
(40, 1, 85, 'unopened'),
(473, 36, 14, 'opened'),
(474, 36, 61, 'unopened'),
(475, 36, 68, 'unopened'),
(476, 36, 69, 'unopened'),
(477, 36, 70, 'unopened'),
(478, 36, 71, 'unopened'),
(479, 36, 72, 'unopened'),
(480, 36, 73, 'unopened'),
(481, 36, 74, 'unopened'),
(482, 36, 75, 'unopened'),
(483, 36, 76, 'unopened'),
(484, 36, 77, 'unopened'),
(485, 36, 78, 'unopened'),
(486, 36, 79, 'unopened'),
(487, 36, 80, 'unopened'),
(488, 36, 81, 'unopened'),
(489, 36, 82, 'unopened'),
(490, 36, 83, 'unopened'),
(491, 36, 84, 'unopened'),
(492, 36, 85, 'unopened'),
(493, 37, 14, 'unopened'),
(494, 37, 61, 'unopened'),
(495, 37, 68, 'unopened'),
(496, 37, 69, 'unopened'),
(497, 37, 70, 'unopened'),
(498, 37, 71, 'unopened'),
(499, 37, 72, 'unopened'),
(500, 37, 73, 'unopened'),
(501, 37, 74, 'unopened'),
(502, 37, 75, 'unopened'),
(503, 37, 76, 'unopened'),
(504, 37, 77, 'unopened'),
(505, 37, 78, 'unopened'),
(506, 37, 79, 'unopened'),
(507, 37, 80, 'unopened'),
(508, 37, 81, 'unopened'),
(509, 37, 82, 'unopened'),
(510, 37, 83, 'unopened'),
(511, 37, 84, 'unopened'),
(512, 37, 85, 'unopened'),
(553, 40, 14, 'unopened'),
(554, 40, 61, 'unopened'),
(555, 40, 68, 'unopened'),
(556, 40, 69, 'unopened'),
(557, 40, 70, 'unopened'),
(558, 40, 71, 'unopened'),
(559, 40, 72, 'unopened'),
(560, 40, 73, 'unopened'),
(561, 40, 74, 'unopened'),
(562, 40, 75, 'unopened'),
(563, 40, 76, 'unopened'),
(564, 40, 77, 'unopened'),
(565, 40, 78, 'unopened'),
(566, 40, 79, 'unopened'),
(567, 40, 80, 'unopened'),
(568, 40, 81, 'unopened'),
(569, 40, 82, 'unopened'),
(570, 40, 83, 'unopened'),
(571, 40, 84, 'unopened'),
(572, 40, 85, 'unopened'),
(573, 40, 14, 'unopened'),
(574, 40, 61, 'unopened'),
(575, 40, 68, 'unopened'),
(576, 40, 69, 'unopened'),
(577, 40, 70, 'unopened'),
(578, 40, 71, 'unopened'),
(579, 40, 72, 'unopened'),
(580, 40, 73, 'unopened'),
(581, 40, 74, 'unopened'),
(582, 40, 75, 'unopened'),
(583, 40, 76, 'unopened'),
(584, 40, 77, 'unopened'),
(585, 40, 78, 'unopened'),
(586, 40, 79, 'unopened'),
(587, 40, 80, 'unopened'),
(588, 40, 81, 'unopened'),
(589, 40, 82, 'unopened'),
(590, 40, 83, 'unopened'),
(591, 40, 84, 'unopened'),
(592, 40, 85, 'unopened'),
(593, 40, 14, 'unopened'),
(594, 40, 61, 'unopened'),
(595, 40, 68, 'unopened'),
(596, 40, 69, 'unopened'),
(597, 40, 70, 'unopened'),
(598, 40, 71, 'unopened'),
(599, 40, 72, 'unopened'),
(600, 40, 73, 'unopened'),
(601, 40, 74, 'unopened'),
(602, 40, 75, 'unopened'),
(603, 40, 76, 'unopened'),
(604, 40, 77, 'unopened'),
(605, 40, 78, 'unopened'),
(606, 40, 79, 'unopened'),
(607, 40, 80, 'unopened'),
(608, 40, 81, 'unopened'),
(609, 40, 82, 'unopened'),
(610, 40, 83, 'unopened'),
(611, 40, 84, 'unopened'),
(612, 40, 85, 'unopened'),
(613, 40, 14, 'unopened'),
(614, 40, 61, 'unopened'),
(615, 40, 68, 'unopened'),
(616, 40, 69, 'unopened'),
(617, 40, 70, 'unopened'),
(618, 40, 71, 'unopened'),
(619, 40, 72, 'unopened'),
(620, 40, 73, 'unopened'),
(621, 40, 74, 'unopened'),
(622, 40, 75, 'unopened'),
(623, 40, 76, 'unopened'),
(624, 40, 77, 'unopened'),
(625, 40, 78, 'unopened'),
(626, 40, 79, 'unopened'),
(627, 40, 80, 'unopened'),
(628, 40, 81, 'unopened'),
(629, 40, 82, 'unopened'),
(630, 40, 83, 'unopened'),
(631, 40, 84, 'unopened'),
(632, 40, 85, 'unopened'),
(673, 46, 14, 'unopened'),
(674, 46, 61, 'unopened'),
(675, 46, 68, 'unopened'),
(676, 46, 69, 'unopened'),
(677, 46, 70, 'unopened'),
(678, 46, 71, 'unopened'),
(679, 46, 72, 'unopened'),
(680, 46, 73, 'unopened'),
(681, 46, 74, 'unopened'),
(682, 46, 75, 'unopened'),
(683, 46, 76, 'unopened'),
(684, 46, 77, 'unopened'),
(685, 46, 78, 'unopened'),
(686, 46, 79, 'unopened'),
(687, 46, 80, 'unopened'),
(688, 46, 81, 'unopened'),
(689, 46, 82, 'unopened'),
(690, 46, 83, 'unopened'),
(691, 46, 84, 'unopened'),
(692, 46, 85, 'unopened'),
(693, 46, 14, 'unopened'),
(694, 46, 61, 'unopened'),
(695, 46, 68, 'unopened'),
(696, 46, 69, 'unopened'),
(697, 46, 70, 'unopened'),
(698, 46, 71, 'unopened'),
(699, 46, 72, 'unopened'),
(700, 46, 73, 'unopened'),
(701, 46, 74, 'unopened'),
(702, 46, 75, 'unopened'),
(703, 46, 76, 'unopened'),
(704, 46, 77, 'unopened'),
(705, 46, 78, 'unopened'),
(706, 46, 79, 'unopened'),
(707, 46, 80, 'unopened'),
(708, 46, 81, 'unopened'),
(709, 46, 82, 'unopened'),
(710, 46, 83, 'unopened'),
(711, 46, 84, 'unopened'),
(712, 46, 85, 'unopened'),
(713, 48, 14, 'unopened'),
(714, 48, 61, 'unopened'),
(715, 48, 68, 'unopened'),
(716, 48, 69, 'unopened'),
(717, 48, 70, 'unopened'),
(718, 48, 71, 'unopened'),
(719, 48, 72, 'unopened'),
(720, 48, 73, 'unopened'),
(721, 48, 74, 'unopened'),
(722, 48, 75, 'unopened'),
(723, 48, 76, 'unopened'),
(724, 48, 77, 'unopened'),
(725, 48, 78, 'unopened'),
(726, 48, 79, 'unopened'),
(727, 48, 80, 'unopened'),
(728, 48, 81, 'unopened'),
(729, 48, 82, 'unopened'),
(730, 48, 83, 'unopened'),
(731, 48, 84, 'unopened'),
(732, 48, 85, 'unopened'),
(733, 49, 14, 'unopened'),
(734, 49, 61, 'unopened'),
(735, 49, 68, 'unopened'),
(736, 49, 69, 'unopened'),
(737, 49, 70, 'unopened'),
(738, 49, 71, 'unopened'),
(739, 49, 72, 'unopened'),
(740, 49, 73, 'unopened'),
(741, 49, 74, 'unopened'),
(742, 49, 75, 'unopened'),
(743, 49, 76, 'unopened'),
(744, 49, 77, 'unopened'),
(745, 49, 78, 'unopened'),
(746, 49, 79, 'unopened'),
(747, 49, 80, 'unopened'),
(748, 49, 81, 'unopened'),
(749, 49, 82, 'unopened'),
(750, 49, 83, 'unopened'),
(751, 49, 84, 'unopened'),
(752, 49, 85, 'unopened'),
(773, 51, 14, 'unopened'),
(774, 51, 61, 'unopened'),
(775, 51, 68, 'unopened'),
(776, 51, 69, 'unopened'),
(777, 51, 70, 'unopened'),
(778, 51, 71, 'unopened'),
(779, 51, 72, 'unopened'),
(780, 51, 73, 'unopened'),
(781, 51, 74, 'unopened'),
(782, 51, 75, 'unopened'),
(783, 51, 76, 'unopened'),
(784, 51, 77, 'unopened'),
(785, 51, 78, 'unopened'),
(786, 51, 79, 'unopened'),
(787, 51, 80, 'unopened'),
(788, 51, 81, 'unopened'),
(789, 51, 82, 'unopened'),
(790, 51, 83, 'unopened'),
(791, 51, 84, 'unopened'),
(792, 51, 85, 'unopened'),
(793, 52, 14, 'unopened'),
(794, 52, 61, 'unopened'),
(795, 52, 68, 'unopened'),
(796, 52, 69, 'unopened'),
(797, 52, 70, 'unopened'),
(798, 52, 71, 'unopened'),
(799, 52, 72, 'unopened'),
(800, 52, 73, 'unopened'),
(801, 52, 74, 'unopened'),
(802, 52, 75, 'unopened'),
(803, 52, 76, 'unopened'),
(804, 52, 77, 'unopened'),
(805, 52, 78, 'unopened'),
(806, 52, 79, 'unopened'),
(807, 52, 80, 'unopened'),
(808, 52, 81, 'unopened'),
(809, 52, 82, 'unopened'),
(810, 52, 83, 'unopened'),
(811, 52, 84, 'unopened'),
(812, 52, 85, 'unopened'),
(813, 53, 14, 'unopened'),
(814, 53, 61, 'unopened'),
(815, 53, 68, 'unopened'),
(816, 53, 69, 'unopened'),
(817, 53, 70, 'unopened'),
(818, 53, 71, 'unopened'),
(819, 53, 72, 'unopened'),
(820, 53, 73, 'unopened'),
(821, 53, 74, 'unopened'),
(822, 53, 75, 'unopened'),
(823, 53, 76, 'unopened'),
(824, 53, 77, 'unopened'),
(825, 53, 78, 'unopened'),
(826, 53, 79, 'unopened'),
(827, 53, 80, 'unopened'),
(828, 53, 81, 'unopened'),
(829, 53, 82, 'unopened'),
(830, 53, 83, 'unopened'),
(831, 53, 84, 'unopened'),
(832, 53, 85, 'unopened'),
(833, 54, 14, 'unopened'),
(834, 54, 61, 'unopened'),
(835, 54, 68, 'unopened'),
(836, 54, 69, 'unopened'),
(837, 54, 70, 'unopened'),
(838, 54, 71, 'unopened'),
(839, 54, 72, 'unopened'),
(840, 54, 73, 'unopened'),
(841, 54, 74, 'unopened'),
(842, 54, 75, 'unopened'),
(843, 54, 76, 'unopened'),
(844, 54, 77, 'unopened'),
(845, 54, 78, 'unopened'),
(846, 54, 79, 'unopened'),
(847, 54, 80, 'unopened'),
(848, 54, 81, 'unopened'),
(849, 54, 82, 'unopened'),
(850, 54, 83, 'unopened'),
(851, 54, 84, 'unopened'),
(852, 54, 85, 'unopened'),
(873, 56, 14, 'unopened'),
(874, 56, 61, 'unopened'),
(875, 56, 68, 'unopened'),
(876, 56, 69, 'unopened'),
(877, 56, 70, 'unopened'),
(878, 56, 71, 'unopened'),
(879, 56, 72, 'unopened'),
(880, 56, 73, 'unopened'),
(881, 56, 74, 'unopened'),
(882, 56, 75, 'unopened'),
(883, 56, 76, 'unopened'),
(884, 56, 77, 'unopened'),
(885, 56, 78, 'unopened'),
(886, 56, 79, 'unopened'),
(887, 56, 80, 'unopened'),
(888, 56, 81, 'unopened'),
(889, 56, 82, 'unopened'),
(890, 56, 83, 'unopened'),
(891, 56, 84, 'unopened'),
(892, 56, 85, 'unopened'),
(913, 58, 14, 'unopened'),
(914, 58, 61, 'unopened'),
(915, 58, 68, 'unopened'),
(916, 58, 69, 'unopened'),
(917, 58, 70, 'unopened'),
(918, 58, 71, 'unopened'),
(919, 58, 72, 'unopened'),
(920, 58, 73, 'unopened'),
(921, 58, 74, 'unopened'),
(922, 58, 75, 'unopened'),
(923, 58, 76, 'unopened'),
(924, 58, 77, 'unopened'),
(925, 58, 78, 'unopened'),
(926, 58, 79, 'unopened'),
(927, 58, 80, 'unopened'),
(928, 58, 81, 'unopened'),
(929, 58, 82, 'unopened'),
(930, 58, 83, 'unopened'),
(931, 58, 84, 'unopened'),
(932, 58, 85, 'unopened'),
(953, 60, 14, 'unopened'),
(954, 60, 61, 'unopened'),
(955, 60, 68, 'unopened'),
(956, 60, 69, 'unopened'),
(957, 60, 70, 'unopened'),
(958, 60, 71, 'unopened'),
(959, 60, 72, 'unopened'),
(960, 60, 73, 'unopened'),
(961, 60, 74, 'unopened'),
(962, 60, 75, 'unopened'),
(963, 60, 76, 'unopened'),
(964, 60, 77, 'unopened'),
(965, 60, 78, 'unopened'),
(966, 60, 79, 'unopened'),
(967, 60, 80, 'unopened'),
(968, 60, 81, 'unopened'),
(969, 60, 82, 'unopened'),
(970, 60, 83, 'unopened'),
(971, 60, 84, 'unopened'),
(972, 60, 85, 'unopened'),
(993, 62, 14, 'unopened'),
(994, 62, 61, 'unopened'),
(995, 62, 68, 'unopened'),
(996, 62, 69, 'unopened'),
(997, 62, 70, 'unopened'),
(998, 62, 71, 'unopened'),
(999, 62, 72, 'unopened'),
(1000, 62, 73, 'unopened'),
(1001, 62, 74, 'unopened'),
(1002, 62, 75, 'unopened'),
(1003, 62, 76, 'unopened'),
(1004, 62, 77, 'unopened'),
(1005, 62, 78, 'unopened'),
(1006, 62, 79, 'unopened'),
(1007, 62, 80, 'unopened'),
(1008, 62, 81, 'unopened'),
(1009, 62, 82, 'unopened'),
(1010, 62, 83, 'unopened'),
(1011, 62, 84, 'unopened'),
(1012, 62, 85, 'unopened');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `programID` int(11) NOT NULL,
  `programName` varchar(50) DEFAULT NULL,
  `levelID` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`programID`, `programName`, `levelID`, `num`) VALUES
(19, 'BS Computer Science', 31, 1),
(20, 'BS Information Technology', 31, 2),
(21, 'BS Information System', 32, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `fileName` int(11) DEFAULT NULL,
  `tagger` int(11) DEFAULT NULL,
  `sourcePath` int(11) DEFAULT NULL,
  `tagNum` int(11) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL,
  `time` varchar(15) DEFAULT NULL,
  `targetPath` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usersID` int(11) NOT NULL,
  `Fname` varchar(20) DEFAULT NULL,
  `Mname` varchar(20) DEFAULT NULL,
  `Lname` varchar(20) DEFAULT NULL,
  `username` text,
  `password` text,
  `userType` enum('Admin','Area Faculty','Accreditor') NOT NULL,
  `status` enum('activated','deactivated') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersID`, `Fname`, `Mname`, `Lname`, `username`, `password`, `userType`, `status`) VALUES
(14, 'Nurjadein', 'Tominaman', 'Abdulmorid', 'nurj', '$2y$10$sFAcugS29RZWiIN/oqSVLO5IgPoCztC/67q81/h1xG9.NVgztmUbe', 'Admin', 'activated'),
(61, 'Mubin', 'M.', 'Macadadaya', 'mubin61', '$2y$10$mahQFOzXiZsllLcZvHquZOfPAwEpDdH6TMzxabBvtoOQhV6mr7BTC', 'Area Faculty', 'activated'),
(62, 'Accreditor', 'Accreditor', 'Accreditor', 'accreditor', '$2y$10$A3HytBENyLAKaXKap.a.ZuubMmd9QHqEtJAdj1ZExiWe0KrT75h/y', 'Accreditor', 'activated'),
(68, 'Al\'Annuar', 'H.', 'Asakil', 'al\'annuar68', '$2y$10$Kr8wC98LNdJkhV3zVJdEVeaK8zqz7/hsHlmPJdLNQT/SYa3Ecf6oi', 'Area Faculty', 'activated'),
(69, 'Jenan Fathma', '.', 'Rande', 'jenanfathma69', '$2y$10$4/htKKn66/NKj3vj/t46euOFX4.uc/yQnAOVoy/PWhTbT970710xe', 'Area Faculty', 'activated'),
(70, 'Maimona', 'M.', 'Asum', 'maimona70', '$2y$10$equPUc0Nl4LLb9BS1CmC2eqoRx8lcetAbNRBUN2.YRk.q0vI5K.nq', 'Admin', 'activated'),
(71, 'Jeffrey', 'M.', 'Mondejar', 'jeffrey71', '$2y$10$rEzc3QRO3ZVVmuJxVAQZPOD6heL2geHJT0eiBKq3V5Fv.qK2f5/KO', 'Area Faculty', 'activated'),
(72, 'Jasmine Jeanette', 'C.', 'Mama', 'jasminejeanette72', '$2y$10$fL9CVVL8tU.77/ukgenTvuR9FRGaptgW/zfCrCkum2b.33.NMs0Oq', 'Area Faculty', 'activated'),
(73, 'Janice', 'F.', 'Wade', 'janice73', '$2y$10$Ot4RSDKdtI4IIk9GJrtW3.IbSx73AE9yhAF7evQGSIna6BU7j3y.q', 'Area Faculty', 'activated'),
(74, 'Mudzna', 'M.', 'Asakil', 'mudzna74', '$2y$10$zLZp12Ircxgh42yt81Oxr.RV4UZnKjDB8BBODVVnyjRyomIdEni3y', 'Area Faculty', 'activated'),
(75, 'Nosaifa', 'M.', 'Mindalano', 'nosaifa75', '$2y$10$ySnjfxscwxgxWm5V/QWE1up/3qJ5RAZnA/ndC0Fs2G0E/uylltqHy', 'Area Faculty', 'activated'),
(76, 'Bantogun', 'S.', 'Tarathingan', 'bantogun76', '$2y$10$rCiEVO6jAEngTtcZ4YIBLethrFX.6G1Fj9XyED.GWIJUjmIo20SES', 'Area Faculty', 'activated'),
(77, 'Llewelyn', 'A.', 'Elcana', 'llewelyn77', '$2y$10$9cYtjxRpFC5lM8eec08dSOgy/tx1qTssQ/LmjTIHzhkI8rjBsRUjS', 'Area Faculty', 'activated'),
(78, 'Lucman', 'M.', 'Abdulrachman', 'lucman78', '$2y$10$qncaESDw.xX1r5dxIaAk8.xB9G/KpZx3QaVD0N9LmNrerKEiCeuXW', 'Area Faculty', 'activated'),
(79, 'Jogie', 'A.', 'Vistal', 'jogie79', '$2y$10$t5uT0y1vvOxU3eZTBCkvT.KkZU8zcpFvs4Rd2AZIz346KISi0ahl6', 'Area Faculty', 'activated'),
(80, 'Azreen', 'M.', 'Marohomsalic', 'azreen80', '$2y$10$In3k1FnTIf.s0Eq1XzcdouBtRN.9ZINf2JwYHpB9fi1YoBx9inoz2', 'Area Faculty', 'activated'),
(81, 'Suhaina', 'K.', 'Tamano', 'suhaina81', '$2y$10$1j95WuBIKf7NGi8z2EL3xuNg78d1qh7YkeE6QG2zzAw1grCxMmkA2', 'Area Faculty', 'activated'),
(82, 'Reymark', '.', 'Delena', 'reymark82', '$2y$10$V5K5LQ6ZTvxaNLnPA.4qmOqLkoLl7F/q7TPtfRonXyXc/kgWmfIY6', 'Area Faculty', 'activated'),
(83, 'Amer Hussien', '.', 'Macatotong', 'amerhussien83', '$2y$10$1WfmR46qamrd7FaRa22tZOQ02rnj0vO6LeLM8RjHin2A5dRwhpyhC', 'Area Faculty', 'activated'),
(84, 'Joseph', 'C.', 'Sieras', 'joseph84', '$2y$10$yi8X7pM.HefgPWSDnroez.n/zxZpNeP5g9G.33SbFN3z.HUtZ669W', 'Area Faculty', 'activated'),
(85, 'Mohammad', 'P.', 'Domato', 'mohammad85', '$2y$10$jstXfIshtqTioVQw5u1Zeeo1Cmq5hRvoQgUmdJShEyyAMAJ4ueQPC', 'Area Faculty', 'activated'),
(86, 'acc2', 'acc2', 'acc2', 'acc286', '$2y$10$n39RKW7dTvbS7wh.1WaRvu.0fYsBYerDwRuRs5uUzd037/nsiXprq', 'Accreditor', 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `usersfolder`
--

CREATE TABLE `usersfolder` (
  `usersFolderID` int(11) NOT NULL,
  `name` text,
  `area` int(11) DEFAULT NULL,
  `letter` varchar(1) DEFAULT NULL,
  `program` int(11) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usersfolder`
--

INSERT INTO `usersfolder` (`usersFolderID`, `name`, `area`, `letter`, `program`, `num`, `level`) VALUES
(562, '(Give this a label)', 1, 'A', 19, NULL, 31),
(563, '(Give this a label)', 2, 'A', 19, NULL, 31),
(564, '(Give this a label)', 3, 'A', 19, NULL, 31),
(565, '(Give this a label)', 4, 'A', 19, NULL, 31),
(566, '(Give this a label)', 5, 'A', 19, NULL, 31),
(567, '(Give this a label)', 6, 'A', 19, NULL, 31),
(568, '(Give this a label)', 7, 'A', 19, NULL, 31),
(569, '(Give this a label)', 8, 'A', 19, NULL, 31),
(570, '(Give this a label)', 9, 'A', 19, NULL, 31),
(571, '(Give this a label)', 10, 'A', 19, NULL, 31),
(572, '(Give this a label)', 1, 'A', 19, NULL, 32),
(573, '(Give this a label)', 2, 'A', 19, NULL, 32),
(574, '(Give this a label)', 3, 'A', 19, NULL, 32),
(575, '(Give this a label)', 4, 'A', 19, NULL, 32),
(576, '(Give this a label)', 5, 'A', 19, NULL, 32),
(577, '(Give this a label)', 6, 'A', 19, NULL, 32),
(578, '(Give this a label)', 7, 'A', 19, NULL, 32),
(579, '(Give this a label)', 8, 'A', 19, NULL, 32),
(580, '(Give this a label)', 9, 'A', 19, NULL, 32),
(581, '(Give this a label)', 10, 'A', 19, NULL, 32),
(582, '(Give this a label)', 1, 'A', 19, NULL, 33),
(583, '(Give this a label)', 2, 'A', 19, NULL, 33),
(584, '(Give this a label)', 3, 'A', 19, NULL, 33),
(585, '(Give this a label)', 4, 'A', 19, NULL, 33),
(586, '(Give this a label)', 5, 'A', 19, NULL, 33),
(587, '(Give this a label)', 6, 'A', 19, NULL, 33),
(588, '(Give this a label)', 7, 'A', 19, NULL, 33),
(589, '(Give this a label)', 8, 'A', 19, NULL, 33),
(590, '(Give this a label)', 9, 'A', 19, NULL, 33),
(591, '(Give this a label)', 10, 'A', 19, NULL, 33),
(592, '(Give this a label)', 1, 'A', 19, NULL, 34),
(593, '(Give this a label)', 2, 'A', 19, NULL, 34),
(594, '(Give this a label)', 3, 'A', 19, NULL, 34),
(595, '(Give this a label)', 4, 'A', 19, NULL, 34),
(596, '(Give this a label)', 5, 'A', 19, NULL, 34),
(597, '(Give this a label)', 6, 'A', 19, NULL, 34),
(598, '(Give this a label)', 7, 'A', 19, NULL, 34),
(599, '(Give this a label)', 8, 'A', 19, NULL, 34),
(600, '(Give this a label)', 9, 'A', 19, NULL, 34),
(601, '(Give this a label)', 10, 'A', 19, NULL, 34),
(602, '(Give this a label)', 1, 'A', 20, NULL, 31),
(603, '(Give this a label)', 2, 'A', 20, NULL, 31),
(604, '(Give this a label)', 3, 'A', 20, NULL, 31),
(605, '(Give this a label)', 4, 'A', 20, NULL, 31),
(606, '(Give this a label)', 5, 'A', 20, NULL, 31),
(607, '(Give this a label)', 6, 'A', 20, NULL, 31),
(608, '(Give this a label)', 7, 'A', 20, NULL, 31),
(609, '(Give this a label)', 8, 'A', 20, NULL, 31),
(610, '(Give this a label)', 9, 'A', 20, NULL, 31),
(611, '(Give this a label)', 10, 'A', 20, NULL, 31),
(612, '(Give this a label)', 1, 'A', 20, NULL, 32),
(613, '(Give this a label)', 2, 'A', 20, NULL, 32),
(614, '(Give this a label)', 3, 'A', 20, NULL, 32),
(615, '(Give this a label)', 4, 'A', 20, NULL, 32),
(616, '(Give this a label)', 5, 'A', 20, NULL, 32),
(617, '(Give this a label)', 6, 'A', 20, NULL, 32),
(618, '(Give this a label)', 7, 'A', 20, NULL, 32),
(619, '(Give this a label)', 8, 'A', 20, NULL, 32),
(620, '(Give this a label)', 9, 'A', 20, NULL, 32),
(621, '(Give this a label)', 10, 'A', 20, NULL, 32),
(622, '(Give this a label)', 1, 'A', 20, NULL, 33),
(623, '(Give this a label)', 2, 'A', 20, NULL, 33),
(624, '(Give this a label)', 3, 'A', 20, NULL, 33),
(625, '(Give this a label)', 4, 'A', 20, NULL, 33),
(626, '(Give this a label)', 5, 'A', 20, NULL, 33),
(627, '(Give this a label)', 6, 'A', 20, NULL, 33),
(628, '(Give this a label)', 7, 'A', 20, NULL, 33),
(629, '(Give this a label)', 8, 'A', 20, NULL, 33),
(630, '(Give this a label)', 9, 'A', 20, NULL, 33),
(631, '(Give this a label)', 10, 'A', 20, NULL, 33),
(632, '(Give this a label)', 1, 'A', 20, NULL, 34),
(633, '(Give this a label)', 2, 'A', 20, NULL, 34),
(634, '(Give this a label)', 3, 'A', 20, NULL, 34),
(635, '(Give this a label)', 4, 'A', 20, NULL, 34),
(636, '(Give this a label)', 5, 'A', 20, NULL, 34),
(637, '(Give this a label)', 6, 'A', 20, NULL, 34),
(638, '(Give this a label)', 7, 'A', 20, NULL, 34),
(639, '(Give this a label)', 8, 'A', 20, NULL, 34),
(640, '(Give this a label)', 9, 'A', 20, NULL, 34),
(641, '(Give this a label)', 10, 'A', 20, NULL, 34),
(642, '(Give this a label)', 1, 'A', 21, NULL, 31),
(643, '(Give this a label)', 2, 'A', 21, NULL, 31),
(644, '(Give this a label)', 3, 'A', 21, NULL, 31),
(645, '(Give this a label)', 4, 'A', 21, NULL, 31),
(646, '(Give this a label)', 5, 'A', 21, NULL, 31),
(647, '(Give this a label)', 6, 'A', 21, NULL, 31),
(648, '(Give this a label)', 7, 'A', 21, NULL, 31),
(649, '(Give this a label)', 8, 'A', 21, NULL, 31),
(650, '(Give this a label)', 9, 'A', 21, NULL, 31),
(651, '(Give this a label)', 10, 'A', 21, NULL, 31),
(652, '(Give this a label)', 1, 'A', 21, NULL, 32),
(653, '(Give this a label)', 2, 'A', 21, NULL, 32),
(654, '(Give this a label)', 3, 'A', 21, NULL, 32),
(655, '(Give this a label)', 4, 'A', 21, NULL, 32),
(656, '(Give this a label)', 5, 'A', 21, NULL, 32),
(657, '(Give this a label)', 6, 'A', 21, NULL, 32),
(658, '(Give this a label)', 7, 'A', 21, NULL, 32),
(659, '(Give this a label)', 8, 'A', 21, NULL, 32),
(660, '(Give this a label)', 9, 'A', 21, NULL, 32),
(661, '(Give this a label)', 10, 'A', 21, NULL, 32),
(662, '(Give this a label)', 1, 'A', 21, NULL, 33),
(663, '(Give this a label)', 2, 'A', 21, NULL, 33),
(664, '(Give this a label)', 3, 'A', 21, NULL, 33),
(665, '(Give this a label)', 4, 'A', 21, NULL, 33),
(666, '(Give this a label)', 5, 'A', 21, NULL, 33),
(667, '(Give this a label)', 6, 'A', 21, NULL, 33),
(668, '(Give this a label)', 7, 'A', 21, NULL, 33),
(669, '(Give this a label)', 8, 'A', 21, NULL, 33),
(670, '(Give this a label)', 9, 'A', 21, NULL, 33),
(671, '(Give this a label)', 10, 'A', 21, NULL, 33),
(672, '(Give this a label)', 1, 'A', 21, NULL, 34),
(673, '(Give this a label)', 2, 'A', 21, NULL, 34),
(674, '(Give this a label)', 3, 'A', 21, NULL, 34),
(675, '(Give this a label)', 4, 'A', 21, NULL, 34),
(676, '(Give this a label)', 5, 'A', 21, NULL, 34),
(677, '(Give this a label)', 6, 'A', 21, NULL, 34),
(678, '(Give this a label)', 7, 'A', 21, NULL, 34),
(679, '(Give this a label)', 8, 'A', 21, NULL, 34),
(680, '(Give this a label)', 9, 'A', 21, NULL, 34),
(681, '(Give this a label)', 10, 'A', 21, NULL, 34);

-- --------------------------------------------------------

--
-- Table structure for table `userssubfolder`
--

CREATE TABLE `userssubfolder` (
  `subID` int(11) NOT NULL,
  `subName` text,
  `folderNum` int(11) DEFAULT NULL,
  `usersFolder` int(11) DEFAULT NULL,
  `program` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userssubfolder`
--

INSERT INTO `userssubfolder` (`subID`, `subName`, `folderNum`, `usersFolder`, `program`, `level`) VALUES
(562, '(Give this a sub label)', 1, 562, 19, 31),
(563, '(Give this a sub label)', 1, 563, 19, 31),
(564, '(Give this a sub label)', 1, 564, 19, 31),
(565, '(Give this a sub label)', 1, 565, 19, 31),
(566, '(Give this a sub label)', 1, 566, 19, 31),
(567, '(Give this a sub label)', 1, 567, 19, 31),
(568, '(Give this a sub label)', 1, 568, 19, 31),
(569, '(Give this a sub label)', 1, 569, 19, 31),
(570, '(Give this a sub label)', 1, 570, 19, 31),
(571, '(Give this a sub label)', 1, 571, 19, 31),
(572, '(Give this a sub label)', 1, 572, 19, 32),
(573, '(Give this a sub label)', 1, 573, 19, 32),
(574, '(Give this a sub label)', 1, 574, 19, 32),
(575, '(Give this a sub label)', 1, 575, 19, 32),
(576, '(Give this a sub label)', 1, 576, 19, 32),
(577, '(Give this a sub label)', 1, 577, 19, 32),
(578, '(Give this a sub label)', 1, 578, 19, 32),
(579, '(Give this a sub label)', 1, 579, 19, 32),
(580, '(Give this a sub label)', 1, 580, 19, 32),
(581, '(Give this a sub label)', 1, 581, 19, 32),
(582, '(Give this a sub label)', 1, 582, 19, 33),
(583, '(Give this a sub label)', 1, 583, 19, 33),
(584, '(Give this a sub label)', 1, 584, 19, 33),
(585, '(Give this a sub label)', 1, 585, 19, 33),
(586, '(Give this a sub label)', 1, 586, 19, 33),
(587, '(Give this a sub label)', 1, 587, 19, 33),
(588, '(Give this a sub label)', 1, 588, 19, 33),
(589, '(Give this a sub label)', 1, 589, 19, 33),
(590, '(Give this a sub label)', 1, 590, 19, 33),
(591, '(Give this a sub label)', 1, 591, 19, 33),
(592, '(Give this a sub label)', 1, 592, 19, 34),
(593, '(Give this a sub label)', 1, 593, 19, 34),
(594, '(Give this a sub label)', 1, 594, 19, 34),
(595, '(Give this a sub label)', 1, 595, 19, 34),
(596, '(Give this a sub label)', 1, 596, 19, 34),
(597, '(Give this a sub label)', 1, 597, 19, 34),
(598, '(Give this a sub label)', 1, 598, 19, 34),
(599, '(Give this a sub label)', 1, 599, 19, 34),
(600, '(Give this a sub label)', 1, 600, 19, 34),
(601, '(Give this a sub label)', 1, 601, 19, 34),
(602, '(Give this a sub label)', 1, 602, 20, 31),
(603, '(Give this a sub label)', 1, 603, 20, 31),
(604, '(Give this a sub label)', 1, 604, 20, 31),
(605, '(Give this a sub label)', 1, 605, 20, 31),
(606, '(Give this a sub label)', 1, 606, 20, 31),
(607, '(Give this a sub label)', 1, 607, 20, 31),
(608, '(Give this a sub label)', 1, 608, 20, 31),
(609, '(Give this a sub label)', 1, 609, 20, 31),
(610, '(Give this a sub label)', 1, 610, 20, 31),
(611, '(Give this a sub label)', 1, 611, 20, 31),
(612, '(Give this a sub label)', 1, 612, 20, 32),
(613, '(Give this a sub label)', 1, 613, 20, 32),
(614, '(Give this a sub label)', 1, 614, 20, 32),
(615, '(Give this a sub label)', 1, 615, 20, 32),
(616, '(Give this a sub label)', 1, 616, 20, 32),
(617, '(Give this a sub label)', 1, 617, 20, 32),
(618, '(Give this a sub label)', 1, 618, 20, 32),
(619, '(Give this a sub label)', 1, 619, 20, 32),
(620, '(Give this a sub label)', 1, 620, 20, 32),
(621, '(Give this a sub label)', 1, 621, 20, 32),
(622, '(Give this a sub label)', 1, 622, 20, 33),
(623, '(Give this a sub label)', 1, 623, 20, 33),
(624, '(Give this a sub label)', 1, 624, 20, 33),
(625, '(Give this a sub label)', 1, 625, 20, 33),
(626, '(Give this a sub label)', 1, 626, 20, 33),
(627, '(Give this a sub label)', 1, 627, 20, 33),
(628, '(Give this a sub label)', 1, 628, 20, 33),
(629, '(Give this a sub label)', 1, 629, 20, 33),
(630, '(Give this a sub label)', 1, 630, 20, 33),
(631, '(Give this a sub label)', 1, 631, 20, 33),
(632, '(Give this a sub label)', 1, 632, 20, 34),
(633, '(Give this a sub label)', 1, 633, 20, 34),
(634, '(Give this a sub label)', 1, 634, 20, 34),
(635, '(Give this a sub label)', 1, 635, 20, 34),
(636, '(Give this a sub label)', 1, 636, 20, 34),
(637, '(Give this a sub label)', 1, 637, 20, 34),
(638, '(Give this a sub label)', 1, 638, 20, 34),
(639, '(Give this a sub label)', 1, 639, 20, 34),
(640, '(Give this a sub label)', 1, 640, 20, 34),
(641, '(Give this a sub label)', 1, 641, 20, 34),
(642, '(Give this a sub label)', 1, 642, 21, 31),
(643, '(Give this a sub label)', 1, 643, 21, 31),
(644, '(Give this a sub label)', 1, 644, 21, 31),
(645, '(Give this a sub label)', 1, 645, 21, 31),
(646, '(Give this a sub label)', 1, 646, 21, 31),
(647, '(Give this a sub label)', 1, 647, 21, 31),
(648, '(Give this a sub label)', 1, 648, 21, 31),
(649, '(Give this a sub label)', 1, 649, 21, 31),
(650, '(Give this a sub label)', 1, 650, 21, 31),
(651, '(Give this a sub label)', 1, 651, 21, 31),
(652, '(Give this a sub label)', 1, 652, 21, 32),
(653, '(Give this a sub label)', 1, 653, 21, 32),
(654, '(Give this a sub label)', 1, 654, 21, 32),
(655, '(Give this a sub label)', 1, 655, 21, 32),
(656, '(Give this a sub label)', 1, 656, 21, 32),
(657, '(Give this a sub label)', 1, 657, 21, 32),
(658, '(Give this a sub label)', 1, 658, 21, 32),
(659, '(Give this a sub label)', 1, 659, 21, 32),
(660, '(Give this a sub label)', 1, 660, 21, 32),
(661, '(Give this a sub label)', 1, 661, 21, 32),
(662, '(Give this a sub label)', 1, 662, 21, 33),
(663, '(Give this a sub label)', 1, 663, 21, 33),
(664, '(Give this a sub label)', 1, 664, 21, 33),
(665, '(Give this a sub label)', 1, 665, 21, 33),
(666, '(Give this a sub label)', 1, 666, 21, 33),
(667, '(Give this a sub label)', 1, 667, 21, 33),
(668, '(Give this a sub label)', 1, 668, 21, 33),
(669, '(Give this a sub label)', 1, 669, 21, 33),
(670, '(Give this a sub label)', 1, 670, 21, 33),
(671, '(Give this a sub label)', 1, 671, 21, 33),
(672, '(Give this a sub label)', 1, 672, 21, 34),
(673, '(Give this a sub label)', 1, 673, 21, 34),
(674, '(Give this a sub label)', 1, 674, 21, 34),
(675, '(Give this a sub label)', 1, 675, 21, 34),
(676, '(Give this a sub label)', 1, 676, 21, 34),
(677, '(Give this a sub label)', 1, 677, 21, 34),
(678, '(Give this a sub label)', 1, 678, 21, 34),
(679, '(Give this a sub label)', 1, 679, 21, 34),
(680, '(Give this a sub label)', 1, 680, 21, 34),
(681, '(Give this a sub label)', 1, 681, 21, 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment`
--
ALTER TABLE `assessment`
  ADD PRIMARY KEY (`assessID`),
  ADD KEY `assessUser` (`assessUser`),
  ADD KEY `file` (`file`);

--
-- Indexes for table `assigntask`
--
ALTER TABLE `assigntask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `area` (`area`),
  ADD KEY `program` (`program`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comID`),
  ADD KEY `comUser` (`comUser`),
  ADD KEY `file` (`file`);

--
-- Indexes for table `evaluation_file`
--
ALTER TABLE `evaluation_file`
  ADD PRIMARY KEY (`fileID`),
  ADD KEY `path` (`path`),
  ADD KEY `levelID` (`levelID`),
  ADD KEY `uploader` (`uploader`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploader` (`uploader`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`levelID`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notifyID`),
  ADD KEY `fileID` (`fileID`),
  ADD KEY `usersID` (`usersID`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`noteID`),
  ADD KEY `notifyID` (`notifyID`),
  ADD KEY `usersID` (`usersID`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`programID`),
  ADD KEY `programs_ibfk_1` (`levelID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fileName` (`fileName`),
  ADD KEY `user` (`tagger`),
  ADD KEY `sourcePath` (`sourcePath`),
  ADD KEY `targetPath` (`targetPath`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`);

--
-- Indexes for table `usersfolder`
--
ALTER TABLE `usersfolder`
  ADD PRIMARY KEY (`usersFolderID`),
  ADD KEY `area` (`area`),
  ADD KEY `program` (`program`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `userssubfolder`
--
ALTER TABLE `userssubfolder`
  ADD PRIMARY KEY (`subID`),
  ADD KEY `usersFolder` (`usersFolder`),
  ADD KEY `program` (`program`),
  ADD KEY `level` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assessment`
--
ALTER TABLE `assessment`
  MODIFY `assessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `assigntask`
--
ALTER TABLE `assigntask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `evaluation_file`
--
ALTER TABLE `evaluation_file`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `levelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notifyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `notify`
--
ALTER TABLE `notify`
  MODIFY `noteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1013;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `programID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `usersfolder`
--
ALTER TABLE `usersfolder`
  MODIFY `usersFolderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=682;

--
-- AUTO_INCREMENT for table `userssubfolder`
--
ALTER TABLE `userssubfolder`
  MODIFY `subID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=682;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assessment`
--
ALTER TABLE `assessment`
  ADD CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`assessUser`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assessment_ibfk_2` FOREIGN KEY (`file`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assigntask`
--
ALTER TABLE `assigntask`
  ADD CONSTRAINT `assigntask_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assigntask_ibfk_2` FOREIGN KEY (`area`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `assigntask_ibfk_3` FOREIGN KEY (`program`) REFERENCES `programs` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comUser`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`file`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_file`
--
ALTER TABLE `evaluation_file`
  ADD CONSTRAINT `evaluation_file_ibfk_1` FOREIGN KEY (`path`) REFERENCES `programs` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_file_ibfk_2` FOREIGN KEY (`levelID`) REFERENCES `level` (`levelID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_file_ibfk_3` FOREIGN KEY (`uploader`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`uploader`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notify`
--
ALTER TABLE `notify`
  ADD CONSTRAINT `notify_ibfk_1` FOREIGN KEY (`notifyID`) REFERENCES `notification` (`notifyID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notify_ibfk_2` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`levelID`) REFERENCES `level` (`levelID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_ibfk_1` FOREIGN KEY (`fileName`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_ibfk_2` FOREIGN KEY (`tagger`) REFERENCES `users` (`usersID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_ibfk_3` FOREIGN KEY (`sourcePath`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags_ibfk_4` FOREIGN KEY (`targetPath`) REFERENCES `userssubfolder` (`subID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usersfolder`
--
ALTER TABLE `usersfolder`
  ADD CONSTRAINT `usersfolder_ibfk_2` FOREIGN KEY (`area`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usersfolder_ibfk_3` FOREIGN KEY (`program`) REFERENCES `programs` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usersfolder_ibfk_4` FOREIGN KEY (`level`) REFERENCES `level` (`levelID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userssubfolder`
--
ALTER TABLE `userssubfolder`
  ADD CONSTRAINT `userssubfolder_ibfk_1` FOREIGN KEY (`usersFolder`) REFERENCES `usersfolder` (`usersFolderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userssubfolder_ibfk_2` FOREIGN KEY (`program`) REFERENCES `programs` (`programID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userssubfolder_ibfk_3` FOREIGN KEY (`level`) REFERENCES `level` (`levelID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
