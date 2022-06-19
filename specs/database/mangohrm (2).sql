-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2016 at 07:15 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mangohrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`id` int(3) NOT NULL,
  `username` varchar(40) NOT NULL,
  `userpass` varchar(40) NOT NULL,
  `usertype` varchar(20) NOT NULL,
  `plantid` int(3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdate` date NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `userpass`, `usertype`, `plantid`, `status`, `createdate`, `deleted`) VALUES
(1, 'mangoit', 'aa75520f89ca1de156d9d0c63b8c9e5d4c22116f', '1', 1, 1, '2016-04-28', 0),
(2, 'mangotex', '9f451970733ec7381a7a2c7171c299505a010e93', '1', 2, 1, '2016-04-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companysetup`
--

CREATE TABLE IF NOT EXISTS `companysetup` (
`id` int(3) NOT NULL,
  `companyname` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `companyaddress1` text NOT NULL,
  `companyaddress2` text NOT NULL,
  `tel` varchar(15) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `web` varchar(30) NOT NULL,
  `tradeli` varchar(40) NOT NULL,
  `ownername` varchar(40) NOT NULL,
  `tin` varchar(40) NOT NULL,
  `establishmentdate` date NOT NULL,
  `alias` varchar(20) NOT NULL,
  `companytype` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companysetup`
--

INSERT INTO `companysetup` (`id`, `companyname`, `description`, `companyaddress1`, `companyaddress2`, `tel`, `fax`, `email`, `web`, `tradeli`, `ownername`, `tin`, `establishmentdate`, `alias`, `companytype`) VALUES
(1, 'Mango Group of Companies', 'description', 'address 1', 'address 2', '8802-123456', '8802-123456', 'admin@bdcoder26.com', 'http://bdcoder26.com', '43589645', 'Round 26 GNSL', '43568975656', '2016-04-28', 'MGC', 'Group of Company');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
`countryid` int(3) NOT NULL,
  `countryname` varchar(40) NOT NULL,
  `countrycode` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`countryid`, `countryname`, `countrycode`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Åland Islands', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia (Plurinational State of)', 'BO'),
(28, 'Bonaire, Sint Eustatius and Saba', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'Brunei Darussalam', 'BN'),
(35, 'Bulgaria', 'BG'),
(36, 'Burkina Faso', 'BF'),
(37, 'Burundi', 'BI'),
(38, 'Cabo Verde', 'CV'),
(39, 'Cambodia', 'KH'),
(40, 'Cameroon', 'CM'),
(41, 'Canada', 'CA'),
(42, 'Cayman Islands', 'KY'),
(43, 'Central African Republic', 'CF'),
(44, 'Chad', 'TD'),
(45, 'Chile', 'CL'),
(46, 'China', 'CN'),
(47, 'Christmas Island', 'CX'),
(48, 'Cocos (Keeling) Islands', 'CC'),
(49, 'Colombia', 'CO'),
(50, 'Comoros', 'KM'),
(51, 'Congo', 'CG'),
(52, 'Congo (Democratic Republic of the)', 'CD'),
(53, 'Cook Islands', 'CK'),
(54, 'Costa Rica', 'CR'),
(55, 'Côte d''Ivoire', 'CI'),
(56, 'Croatia', 'HR'),
(57, 'Cuba', 'CU'),
(58, 'Curaçao', 'CW'),
(59, 'Cyprus', 'CY'),
(60, 'Czech Republic', 'CZ'),
(61, 'Denmark', 'DK'),
(62, 'Djibouti', 'DJ'),
(63, 'Dominica', 'DM'),
(64, 'Dominican Republic', 'DO'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands (Malvinas)', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Holy See', 'VA'),
(99, 'Honduras', 'HN'),
(100, 'Hong Kong', 'HK'),
(101, 'Hungary', 'HU'),
(102, 'Iceland', 'IS'),
(103, 'India', 'IN'),
(104, 'Indonesia', 'ID'),
(105, 'Iran (Islamic Republic of)', 'IR'),
(106, 'Iraq', 'IQ'),
(107, 'Ireland', 'IE'),
(108, 'Isle of Man', 'IM'),
(109, 'Israel', 'IL'),
(110, 'Italy', 'IT'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Korea (Democratic People''s Republic of)', 'KP'),
(119, 'Korea (Republic of)', 'KR'),
(120, 'Kuwait', 'KW'),
(121, 'Kyrgyzstan', 'KG'),
(122, 'Lao People''s Democratic Republic', 'LA'),
(123, 'Latvia', 'LV'),
(124, 'Lebanon', 'LB'),
(125, 'Lesotho', 'LS'),
(126, 'Liberia', 'LR'),
(127, 'Libya', 'LY'),
(128, 'Liechtenstein', 'LI'),
(129, 'Lithuania', 'LT'),
(130, 'Luxembourg', 'LU'),
(131, 'Macao', 'MO'),
(132, 'Macedonia (the former Yugoslav Republic ', 'MK'),
(133, 'Madagascar', 'MG'),
(134, 'Malawi', 'MW'),
(135, 'Malaysia', 'MY'),
(136, 'Maldives', 'MV'),
(137, 'Mali', 'ML'),
(138, 'Malta', 'MT'),
(139, 'Marshall Islands', 'MH'),
(140, 'Martinique', 'MQ'),
(141, 'Mauritania', 'MR'),
(142, 'Mauritius', 'MU'),
(143, 'Mayotte', 'YT'),
(144, 'Mexico', 'MX'),
(145, 'Micronesia (Federated States of)', 'FM'),
(146, 'Moldova (Republic of)', 'MD'),
(147, 'Monaco', 'MC'),
(148, 'Mongolia', 'MN'),
(149, 'Montenegro', 'ME'),
(150, 'Montserrat', 'MS'),
(151, 'Morocco', 'MA'),
(152, 'Mozambique', 'MZ'),
(153, 'Myanmar', 'MM'),
(154, 'Namibia', 'NA'),
(155, 'Nauru', 'NR'),
(156, 'Nepal', 'NP'),
(157, 'Netherlands', 'NL'),
(158, 'New Caledonia', 'NC'),
(159, 'New Zealand', 'NZ'),
(160, 'Nicaragua', 'NI'),
(161, 'Niger', 'NE'),
(162, 'Nigeria', 'NG'),
(163, 'Niue', 'NU'),
(164, 'Norfolk Island', 'NF'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestine, State of', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Réunion', 'RE'),
(182, 'Romania', 'RO'),
(183, 'Russian Federation', 'RU'),
(184, 'Rwanda', 'RW'),
(185, 'Saint Barthélemy', 'BL'),
(186, 'Saint Helena, Ascension and Tristan da C', 'GH'),
(187, 'Saint Kitts and Nevis', 'KN'),
(188, 'Saint Lucia', 'LC'),
(189, 'Saint Martin (French part)', 'MF'),
(190, 'Saint Pierre and Miquelon', 'PM'),
(191, 'Saint Vincent and the Grenadines', 'VC'),
(192, 'Samoa', 'WS'),
(193, 'San Marino', 'SM'),
(194, 'Sao Tome and Principe', 'ST'),
(195, 'Saudi Arabia', 'SA'),
(196, 'Senegal', 'SN'),
(197, 'Serbia', 'RS'),
(198, 'Seychelles', 'SC'),
(199, 'Sierra Leone', 'SL'),
(200, 'Singapore', 'SG'),
(201, 'Sint Maarten (Dutch part)', 'SX'),
(202, 'Slovakia', 'SK'),
(203, 'Slovenia', 'SI'),
(204, 'Solomon Islands', 'SB'),
(205, 'Somalia', 'SO'),
(206, 'South Africa', 'ZA'),
(207, 'South Georgia and the South Sandwich Isl', 'GS'),
(208, 'South Sudan', 'SS'),
(209, 'Spain', 'ES'),
(210, 'Sri Lanka', 'LK'),
(211, 'Sudan', 'SD'),
(212, 'Suriname', 'SR'),
(213, 'Svalbard and Jan Mayen', 'SJ'),
(214, 'Swaziland', 'SZ'),
(215, 'Sweden', 'SE'),
(216, 'Switzerland', 'CH'),
(217, 'Syrian Arab Republic', 'SY'),
(218, 'Taiwan, Province of China[a]', 'TW'),
(219, 'Tajikistan', 'TJ'),
(220, 'Tanzania, United Republic of', 'TZ'),
(221, 'Thailand', 'TH'),
(222, 'Timor-Leste', 'TL'),
(223, 'Togo', 'TG'),
(224, 'Tokelau', 'TK'),
(225, 'Tonga', 'TO'),
(226, 'Trinidad and Tobago', 'TT'),
(227, 'Tunisia', 'TN'),
(228, 'Turkey', 'TR'),
(229, 'Turkmenistan', 'TM'),
(230, 'Turks and Caicos Islands', 'TC'),
(231, 'Tuvalu', 'TV'),
(232, 'Uganda', 'UG'),
(233, 'Ukraine', 'UA'),
(234, 'United Arab Emirates', 'AE'),
(235, 'United Kingdom of Great Britain and Nort', 'GB'),
(236, 'United States of America', 'US'),
(237, 'United States Minor Outlying Islands', 'UM'),
(238, 'Uruguay', 'UY'),
(239, 'Uzbekistan', 'UZ'),
(240, 'Vanuatu', 'VU'),
(241, 'Venezuela (Bolivarian Republic of)', 'VE'),
(242, 'Viet Nam', 'VN'),
(243, 'Virgin Islands (British)', 'VG'),
(244, 'Virgin Islands (U.S.)', 'VI'),
(245, 'Wallis and Futuna', 'WF'),
(246, 'Western Sahara', 'EH'),
(247, 'Yemen', 'YE'),
(248, 'Zambia', 'ZM'),
(249, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`deptid` int(5) NOT NULL,
  `deptname` varchar(40) NOT NULL,
  `deptdesc` text NOT NULL,
  `plantid` int(3) NOT NULL,
  `createdate` date NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptid`, `deptname`, `deptdesc`, `plantid`, `createdate`, `deleted`) VALUES
(1, 'Store', 'factory 1 stores', 1, '2016-04-30', 0),
(2, 'Account', 'account dept', 1, '2016-04-30', 0),
(3, 'production', 'production dept', 2, '2016-04-29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE IF NOT EXISTS `designation` (
`desigid` int(5) NOT NULL,
  `designame` varchar(40) NOT NULL,
  `desigdesc` text NOT NULL,
  `grade` varchar(15) NOT NULL,
  `createdate` date NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`desigid`, `designame`, `desigdesc`, `grade`, `createdate`, `deleted`) VALUES
(1, 'Driver', 'company driver', '2', '0000-00-00', 0),
(2, 'CEO', 'Chief Technical Officer 1', '1', '0000-00-00', 0),
(3, 'Lead Engineer', 'Lead Engineer', '2', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`id` int(5) NOT NULL,
  `empid` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `dln` varchar(40) NOT NULL COMMENT 'driving license number',
  `dl_expdate` date NOT NULL COMMENT 'driving license exp date',
  `gender` enum('male','female','other','') NOT NULL,
  `dob` date NOT NULL,
  `maritalstatus` enum('married','unmarried','','') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `homephone` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `blood` varchar(3) NOT NULL,
  `tin` varchar(40) NOT NULL,
  `nid` varchar(40) NOT NULL,
  `fathersname` varchar(40) NOT NULL,
  `mothersname` varchar(40) NOT NULL,
  `bankname` varchar(40) NOT NULL,
  `bankaccno` varchar(40) NOT NULL,
  `bankacctype` enum('current','savings','salary','') NOT NULL,
  `plantid` int(3) NOT NULL,
  `deptid` int(5) NOT NULL,
  `secid` int(5) NOT NULL,
  `desigid` int(5) NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `empid`, `fname`, `mname`, `lname`, `dln`, `dl_expdate`, `gender`, `dob`, `maritalstatus`, `phone`, `homephone`, `email`, `blood`, `tin`, `nid`, `fathersname`, `mothersname`, `bankname`, `bankaccno`, `bankacctype`, `plantid`, `deptid`, `secid`, `desigid`, `deleted`) VALUES
(1, 'man008', 'Idb', '-', 'BISEW', '', '0000-00-00', 'male', '0000-00-00', 'married', '', '', '', 'NA', '', '', '', '', '', '', 'current', 1, 3, 2, 3, 0),
(2, 'TR202', 'Aman', '', 'Ullah', '', '0000-00-00', 'male', '2016-05-14', 'unmarried', '9865432', '234987', 'aman@gmail.com', 'B+', '4356786465', '43256435879655', 'Aman''s Father', 'Aman''s Mother', '', '', 'current', 1, 3, 1, 2, 0),
(3, 'TANJIMSTORE055', 'Tanjimul', '', 'Islam', '', '0000-00-00', 'male', '2016-05-15', 'married', '346436', '3464', 'tanjim@gmail.com', 'A+', '46546', '436546546', 'Father', 'Mother', '', '', 'current', 1, 1, 2, 3, 0),
(4, 'SADF', 'Sadf', 'Sdfa', 'Sdaf', '', '0000-00-00', 'male', '2016-05-02', 'married', '346', '678', 'em@gmail.com', 'AB-', '3245', '657', 'Father', 'Mother', '', '', 'current', 1, 1, 3, 1, 0),
(5, 'DRIV4', 'First', '', 'Driver', '', '0000-00-00', 'male', '0000-00-00', 'married', '', '', '', 'NA', '', '', '', '', '', '', 'current', 1, 1, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `emp_address`
--

CREATE TABLE IF NOT EXISTS `emp_address` (
  `id` int(5) NOT NULL COMMENT 'fkey of employee',
  `p_address1` varchar(80) NOT NULL,
  `p_address2` varchar(80) NOT NULL,
  `p_village` varchar(40) NOT NULL,
  `p_post_name` varchar(20) NOT NULL,
  `p_post_code` varchar(10) NOT NULL,
  `p_upazila` varchar(20) NOT NULL,
  `p_dist` varchar(20) NOT NULL,
  `p_country` varchar(20) NOT NULL,
  `sameornot` enum('yes','no') NOT NULL,
  `c_address1` varchar(80) NOT NULL,
  `c_address2` varchar(80) NOT NULL,
  `c_village` varchar(40) NOT NULL,
  `c_post_name` varchar(20) NOT NULL,
  `c_post_code` varchar(10) NOT NULL,
  `c_upazila` varchar(20) NOT NULL,
  `c_dist` varchar(20) NOT NULL,
  `c_country` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_address`
--

INSERT INTO `emp_address` (`id`, `p_address1`, `p_address2`, `p_village`, `p_post_name`, `p_post_code`, `p_upazila`, `p_dist`, `p_country`, `sameornot`, `c_address1`, `c_address2`, `c_village`, `c_post_name`, `c_post_code`, `c_upazila`, `c_dist`, `c_country`) VALUES
(2, 'Dhanmondi', 'Dhanmondi', 'Dhanmondi', 'Dhanmondi', '1221', 'Dhanmondi', 'Dhaka', 'BD', 'no', 'Mirpur', 'Golchokkor', 'Mirpur', 'Mirpur', '1216', 'Mirpur', 'Dhaka', 'BD'),
(1, 'Dsaf', 'Sadf', 'Sdaf', 'Sadf', '1216', 'Sadf', 'Sadf', 'BD', 'yes', 'Dsaf', 'Sadf', 'Sdaf', 'Sadf', '1216', 'Sadf', 'Sadf', 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `emp_attachment`
--

CREATE TABLE IF NOT EXISTS `emp_attachment` (
`id` int(7) NOT NULL,
  `empid` int(5) NOT NULL,
  `att_section` varchar(20) NOT NULL COMMENT 'employee section id',
  `filename` varchar(80) NOT NULL,
  `filedesc` varchar(200) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_education`
--

CREATE TABLE IF NOT EXISTS `emp_education` (
`id` int(7) NOT NULL,
  `eid` int(5) NOT NULL COMMENT 'foreign key of employee(id)',
  `level` varchar(20) NOT NULL,
  `institute` varchar(40) NOT NULL,
  `board` varchar(20) NOT NULL,
  `major` varchar(40) NOT NULL,
  `year` year(4) NOT NULL,
  `score` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='unique(empid,level)';

-- --------------------------------------------------------

--
-- Table structure for table `emp_experience`
--

CREATE TABLE IF NOT EXISTS `emp_experience` (
`id` int(7) NOT NULL,
  `eid` int(5) NOT NULL COMMENT 'fkey of employee(id)',
  `company` varchar(40) NOT NULL,
  `occupation` varchar(40) NOT NULL,
  `exp_from` date NOT NULL,
  `exp_to` date NOT NULL,
  `comment` varchar(80) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_experience`
--

INSERT INTO `emp_experience` (`id`, `eid`, `company`, `occupation`, `exp_from`, `exp_to`, `comment`, `created`) VALUES
(16, 5, 'asd', 'asd', '2016-05-02', '2016-05-03', 'asd', '2016-05-15 18:48:42'),
(17, 5, 'asdf', 'asdf', '2016-05-02', '2016-05-03', 'asdf', '2016-05-15 18:59:12'),
(18, 5, 'ttt', 'ttt', '2016-05-02', '2016-05-05', 'tttt', '2016-05-15 18:59:34'),
(19, 5, 'iiii', 'iiii', '2016-05-04', '2016-05-07', 'iiii', '2016-05-15 19:01:18'),
(20, 5, 'eee', 'eee', '2016-05-04', '2016-05-05', 'eee', '2016-05-15 19:04:02'),
(21, 5, 'rrrrrr', 'rrrrrrrrrrr', '2016-05-03', '2016-05-20', 'rrrrrrrr', '2016-05-15 19:05:30'),
(22, 5, 'rt', 'rt', '2016-05-03', '2016-05-06', 'rt', '2016-05-15 19:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `emp_grade`
--

CREATE TABLE IF NOT EXISTS `emp_grade` (
`id` int(3) NOT NULL,
  `gradeid` int(3) NOT NULL,
  `gradename` varchar(20) NOT NULL,
  `basic` double(10,2) NOT NULL,
  `houserent` double(10,2) NOT NULL,
  `medical` double(10,2) NOT NULL,
  `other` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_job`
--

CREATE TABLE IF NOT EXISTS `emp_job` (
  `id` int(5) NOT NULL COMMENT 'fkey of employee',
  `job_title` varchar(60) NOT NULL,
  `job_spec` varchar(80) NOT NULL,
  `emp_status` enum('active','onleave','dismissed','terminated','resigned','suspended','other') NOT NULL,
  `job_category` int(2) NOT NULL COMMENT 'fkey of emp_job_category',
  `joindate` date NOT NULL,
  `job_location` int(11) NOT NULL COMMENT 'HQ=1, Factory=2',
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `continue` tinyint(4) NOT NULL COMMENT '1 for active employees',
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `emp_job_category`
--

CREATE TABLE IF NOT EXISTS `emp_job_category` (
`id` int(3) NOT NULL,
  `title` varchar(30) NOT NULL,
  `desc` varchar(40) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emp_job_category`
--

INSERT INTO `emp_job_category` (`id`, `title`, `desc`, `created`) VALUES
(1, 'Officials and Managers', 'Officials and Managers', '2016-05-10 00:00:00'),
(2, 'Professionals', 'Professionals', '2016-05-10 00:00:00'),
(3, 'Technicians', 'Technicians', '2016-05-10 00:00:00'),
(4, 'Sales Workers', 'Sales Workers', '2016-05-10 00:00:00'),
(5, 'Operatives', 'Operatives', '2016-05-10 00:00:00'),
(6, 'Office and Clerical Workers', 'Office and Clerical Workers', '0000-00-00 00:00:00'),
(7, 'Craft Workers', 'Craft Workers', '0000-00-00 00:00:00'),
(8, 'Service Workers', 'Service Workers', '0000-00-00 00:00:00'),
(9, 'Laborers and Helpers', 'Laborers and Helpers', '0000-00-00 00:00:00'),
(10, 'Admin', 'Admin', '0000-00-00 00:00:00'),
(11, 'help desk', 'help desk', '2016-05-10 00:00:00'),
(12, 'HR Department', 'HR Department', '2016-05-10 00:00:00'),
(13, 'Accountant', 'Accountant', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `emp_reportto`
--

CREATE TABLE IF NOT EXISTS `emp_reportto` (
  `id` int(5) NOT NULL,
  `report_to` int(5) NOT NULL COMMENT 'fk of emp',
  `report_method` enum('direct','indirect','email','daily','weekly','monthly','yearly','other') NOT NULL,
  `other_method` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `plant`
--

CREATE TABLE IF NOT EXISTS `plant` (
`plantid` int(3) NOT NULL,
  `plantname` varchar(40) NOT NULL,
  `plantdesc` text NOT NULL,
  `companyid` int(3) NOT NULL,
  `createdate` date NOT NULL,
  `deleted` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plant`
--

INSERT INTO `plant` (`plantid`, `plantname`, `plantdesc`, `companyid`, `createdate`, `deleted`) VALUES
(1, 'Mango IT', 'Mango IT', 1, '2016-04-28', 0),
(2, 'Mango Textile', 'Mango Textile', 1, '2016-04-28', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
`secid` int(5) NOT NULL,
  `secname` varchar(40) NOT NULL,
  `secdesc` text NOT NULL,
  `deptid` int(5) NOT NULL,
  `createdate` date NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`secid`, `secname`, `secdesc`, `deptid`, `createdate`, `deleted`) VALUES
(1, 'sewing', 'some desc', 3, '2016-04-30', 0),
(2, 'store', 'store sec', 1, '2016-04-30', 0),
(3, 'asef', 'sadf', 1, '2016-05-07', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `companysetup`
--
ALTER TABLE `companysetup`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `companyname` (`companyname`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`countryid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`deptid`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
 ADD PRIMARY KEY (`desigid`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `empid` (`empid`,`tin`,`nid`);

--
-- Indexes for table `emp_attachment`
--
ALTER TABLE `emp_attachment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_education`
--
ALTER TABLE `emp_education`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_experience`
--
ALTER TABLE `emp_experience`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_grade`
--
ALTER TABLE `emp_grade`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_job_category`
--
ALTER TABLE `emp_job_category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plant`
--
ALTER TABLE `plant`
 ADD PRIMARY KEY (`plantid`), ADD UNIQUE KEY `plantname` (`plantname`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
 ADD PRIMARY KEY (`secid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `companysetup`
--
ALTER TABLE `companysetup`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
MODIFY `countryid` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `deptid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
MODIFY `desigid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_attachment`
--
ALTER TABLE `emp_attachment`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_education`
--
ALTER TABLE `emp_education`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_experience`
--
ALTER TABLE `emp_experience`
MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `emp_grade`
--
ALTER TABLE `emp_grade`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_job_category`
--
ALTER TABLE `emp_job_category`
MODIFY `id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `plant`
--
ALTER TABLE `plant`
MODIFY `plantid` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
MODIFY `secid` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
