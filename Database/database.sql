-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2018 at 10:39 AM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `article`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `category_id` int(3) DEFAULT NULL,
  `cover_id` mediumint(8) DEFAULT NULL,
  `title` text,
  `description` text,
  `url` text,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL,
  `published_time` datetime DEFAULT NULL,
  `count_read` int(8) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `verified` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `user_id`, `category_id`, `cover_id`, `title`, `description`, `url`, `create_time`, `update_time`, `edit_time`, `published_time`, `count_read`, `status`, `verified`) VALUES
(1, 1, NULL, 42, 'นี่คือคำพูดที่ผมพูดกับเพื่อนในช่วง 1 - 2 ปีมานี้ คือ ผมเคยชอบเกมแนว', NULL, NULL, '2018-01-24 19:33:28', '2018-02-04 17:01:03', '2018-02-04 17:00:36', NULL, 0, 'published', NULL),
(2, 1, NULL, NULL, NULL, NULL, NULL, '2018-01-24 19:35:09', NULL, NULL, NULL, 0, 'draft', NULL),
(3, 1, NULL, 52, '19 อุตสาหกรรมได้รับผลกระทบจาก Blockchain', 'เนื้อหามีมาตั่งแต่กลางปีที่แล้ว มาทวนกันอีกรอบในปี 2018 ดีไม่น้อย พอเข้าใจมากขึ้น ดูซ้ำได้ความคิดใหม่ๆเพิ่มเติม', NULL, '2018-01-25 11:09:11', NULL, '2018-02-04 16:47:30', NULL, 0, 'draft', NULL),
(4, 1, NULL, 22, 'จากความรู้สึกของคุณตอนนี้ คุณว่า ระหว่าง 2 อาชีพนี้ ใครสร้างความกังวลให้คุณมากกว่ากัน...', 'งานของเราช่วงหลัง ทำให้มีโอกาสได้รู้จักคนเก่งเพิ่มขึ้นมากมาย ได้ฟังได้คุยด้วย ยิ่งเปิดโลกเรามากขึ้น โลกใบเดิมเราเริ่มมองอะไรที่ต่างออกไป', 'people-awesome', '2018-01-25 14:17:01', '2018-02-04 16:19:09', '2018-02-04 16:19:07', NULL, 0, 'published', NULL),
(5, 1, NULL, NULL, 'ครอบครัวลุคมาจากนิวยอร์ก', 'ผมลองเอาคำว่า “Perfectionism” ไปแปลใส่ Google translate จะได้ความหมายว่า “ลัทธิพอใจ แต่สิ่งดีเลิศ”', NULL, '2018-01-25 15:12:53', NULL, '2018-01-29 10:31:12', NULL, 0, 'draft', NULL),
(6, 1, NULL, NULL, NULL, NULL, NULL, '2018-01-25 15:48:23', NULL, NULL, NULL, 0, 'draft', NULL),
(7, 1, NULL, NULL, NULL, NULL, NULL, '2017-01-01 07:07:29', NULL, NULL, NULL, 0, 'draft', NULL),
(8, 1, NULL, NULL, NULL, NULL, NULL, '2018-01-25 19:49:02', NULL, NULL, NULL, 0, 'draft', NULL),
(9, 1, NULL, NULL, '', NULL, NULL, '2018-01-26 14:57:12', NULL, '2018-02-02 20:13:13', NULL, 0, 'draft', NULL),
(10, 1, NULL, 37, 'อินเทลเตรียมปล่อยชิปที่ป้องกัน Meltdown/Spectre', 'หลังจากใช้แล้ว รู้สึกว่า สมองเป็นระเบียบขึ้นเยอะครับ ... เอาไปลองใช้กันดูนะครับ ได้ผลยังงัย เอามาอับเดทกันมั่งนะครับ', NULL, '2018-01-26 14:57:57', NULL, '2018-02-04 16:46:54', NULL, 0, 'draft', NULL),
(11, 1, 3, 69, '''Top Gear'' Unveils Its Explosive New Trailer For Its 25th Season', NULL, 'ทสอบอีกครั้ง', '2018-01-31 11:51:36', '2018-02-04 15:23:56', '2018-02-04 15:19:56', NULL, 0, 'published', NULL),
(12, 1, 3, NULL, NULL, NULL, NULL, '2018-02-01 19:03:57', NULL, NULL, NULL, 0, 'draft', NULL),
(13, 2, 3, 84, 'If Birds Left Tracks in the Sky, They’d Look Like This', 'อยากชวนดู ซีรีย์เรื่องใหม่จาก Netflix เรื่อง Altered-Carbon', 'Birds-Left-Tracks', '2018-02-04 17:12:14', '2018-02-04 17:32:20', '2018-02-04 17:16:55', NULL, 0, 'published', NULL),
(14, 2, 4, NULL, NULL, NULL, NULL, '2018-02-04 17:36:01', NULL, NULL, NULL, 0, 'draft', NULL),
(15, 2, 3, NULL, NULL, NULL, NULL, '2018-02-04 17:36:44', NULL, NULL, NULL, 0, 'draft', NULL),
(16, 2, 4, NULL, NULL, NULL, NULL, '2018-02-04 17:36:47', NULL, NULL, NULL, 0, 'draft', NULL),
(17, 2, 2, NULL, NULL, NULL, NULL, '2018-02-04 17:37:26', NULL, NULL, NULL, 0, 'draft', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(5) NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `icon` varchar(20) DEFAULT NULL,
  `edit_time` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`, `icon`, `edit_time`) VALUES
(1, 'Technology', NULL, NULL, NULL),
(2, 'Reviews', NULL, NULL, NULL),
(3, 'Art & Design', NULL, NULL, NULL),
(4, 'Wallpapers', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` mediumint(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `article_id` int(8) NOT NULL,
  `topic` text,
  `body` text,
  `video_id` varchar(30) DEFAULT NULL,
  `img_location` text,
  `alt` text,
  `lat` decimal(17,14) DEFAULT NULL,
  `lng` decimal(17,14) DEFAULT NULL,
  `position` float unsigned DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `user_id`, `article_id`, `topic`, `body`, `video_id`, `img_location`, `alt`, `lat`, `lng`, `position`, `create_time`, `edit_time`, `type`, `status`) VALUES
(4, 1, 5, 'Topic of Contents', 'อาจารย์ อ.ไข่(ปกรณ์1) และ อ.กร(ปกรณ์2) ออกโรง HDC สู่ภาคปฏิบัติในพื้นที่จังหวัดนนทบุรี ที่ โรงพยาบาลบางบัวทอง วันนี้ลูกศิษย์เต็มห้องเลย สู้ๆ ครับ Dubble Pack', NULL, NULL, NULL, NULL, NULL, 7, '2018-01-25 15:12:53', NULL, 'textbox', 'active'),
(5, 1, 5, NULL, NULL, NULL, 'content_dea4cf99d69a085fe2bccad297f7d934.jpg', 'ยังไง', NULL, NULL, 9, '2018-01-25 15:12:53', NULL, 'image', 'active'),
(6, 1, 5, NULL, NULL, NULL, 'content_ec3770aa57dc8be2e5239ca85a431020.jpg', NULL, NULL, NULL, 6, '2018-01-25 15:31:43', NULL, 'image', 'active'),
(7, 1, 5, NULL, NULL, NULL, 'content_e10e3c27d73b5ceb235e91e818bd5bb0.jpg', NULL, NULL, NULL, 13, '2018-01-25 15:31:51', NULL, 'image', 'active'),
(8, 1, 5, NULL, 'xTNxlwROMZo', NULL, NULL, NULL, NULL, NULL, 14, '2018-01-25 15:32:25', NULL, 'youtube', 'active'),
(10, 1, 5, 'พึ่งมีเวลาได้นั่งคุยกับเขายาวๆ ', 'ครอบครัวลุคมาจากนิวยอร์ก ทั้งสองทำงานบริษัทประกันที่นั่น มีลูกสองคนด้วยกัน\nลุคเล่าให้ฟังว่าตั้งแต่ต้องทำงานและเดินทาง ทุกครั้งคือคุยกับลูกผ่าน Facetime เท่านั้น\n\nจึงเริ่มถามภรรยาว่าเราจะเลี้ยงลูกผ่านมือถือไปตลอดหรอ...\n(ชีวิตคุ้นๆ ไหม 555) ทั้งสองจึงลาออกจากงานพร้อมกันและเริ่มเดินทางรอบโลกแทน\nเขาเลือกที่จะหาที่พักที่ให้ประสบการณ์ใหม่ๆ แก่พวกเขา เพื่อให้เขาได้ใช้เวลาหนึ่งปีในการคิดว่าควรทำอะไรดี\n\nเขาบุคหอมไว้หนึ่งอาทิตย์เต็มๆ วันนี้พึ่งมีโอกาสได้นั่งคุยกันยาวๆ คือเค้าบอกผ่านวาจิว่าอยากคุยกับเจ้าของมากก นี่ก็วุ่นๆ พึ่งมีเวลาได้นั่งคุยกับเขายาวๆ \nลุคสัมภาษณ์ยาวมาก สัมภาษณ์ว่าตอนตัดสินใจลาออกคิดอย่างไร\nทำไมถึงมาทำโฮสเทลแบบนี้ได้ และบอกว่า this is the best hostel i ever stay in the past 6 months.\n\n(คือทั้งลุคและภรรยาชมไม่หยุดปาก แต่เราก็ว่าโฮสเทลเราคนมีลูกมักชอบนะเพราะทำกับข้าวได้ มีของเล่น มีทีวี มีที่เที่ยวใกล้ๆ)\nได้มีโอกาสเล่าเรื่องปรัชญาของเศรษฐกิจพอเพียงให้ลุคฟัง (ท่าที่เห็นในรูปนั่นคือห่วงแรก รู้จักตน)\n\nได้เล่าเรื่องความพอดีของเราอยู่ที่ตรงไหน แล้วเราทำให้หอมยั่งยืนในแบบใด\nคือนางประทับใจมากกกกกกกก แล้วลูกนางก็วิ่งเล่นจนนางต้องไปจับ บอกขอคุยต่อพรุ่งนี้นา 5555+\n\nบอกลุคว่าจริงๆ หอมมีชื่อเล่นคือ “The Quitter club” คนที่มานี่แล้วคุยถูกคอ มักเป็นคนที่พึ่งลาออกจากงาน เบื่องาน มาเที่ยวเพื่อหาตัวเอง\nจึงมีเวลา ไม่รีบร้อน ชิวได้และชอบเรียนรู้ไปด้วยกัน', NULL, NULL, NULL, NULL, NULL, 3, '2018-01-25 15:46:02', NULL, 'textbox', 'active'),
(11, 1, 5, 'หัวข้อ', '7 กุมภาพันธ์ ของทุกปีจะเป็นวันชาติของชาวไทยใหญ่ ที่จะจัดขึ้นบนดอยไตแลง รอยตะเข็บชายแดนไทยพม่า จะมีการสวนสนามของเหล่าทหาร มีการออกร้านขายของ มีการแสดงต่างๆ เช่น ลิเกไทยใหญ่\n\nปีนี้ได้การ์ดเชิญแต่ช่วงงานมีงานล้อมหน้าล้อมหลัง อยากไปสัมผัสบรรยากาศเหล่านั้นอีกครั้งจริงๆ ได้ไปฟังเพลงสัญญาปางโหลงก็คุ้มแล้ว เผื่อจะไม่ได้ไป เอาภาพปีก่อนๆ มาให้ดูกัน', NULL, NULL, NULL, NULL, NULL, 12, '2018-01-25 15:46:31', NULL, 'textbox', 'active'),
(14, 1, 1, NULL, 'Los Angeles residence ''Barrington House'' is a luxurious structure comprising of multiple polygons sunken into the Brentwood hillside. The three-story home looks almost inconspicuous from the front, but each level extends out the back to generous outdoor spaces which are a marvel to look at, let alone live in. Check out the tour below.', NULL, NULL, NULL, NULL, NULL, 2, '2018-01-25 15:57:54', NULL, 'textbox', 'active'),
(15, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, '2018-01-25 16:02:59', NULL, 'youtube', 'active'),
(18, 1, 3, NULL, NULL, NULL, 'content_e96a66dfdf93f99b7a30763f362a963f.jpg', NULL, NULL, NULL, 11, '2017-01-01 07:03:43', NULL, 'image', 'active'),
(19, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2017-01-01 07:07:29', NULL, 'textbox', 'active'),
(20, 1, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2017-01-01 07:07:29', NULL, 'image', 'active'),
(21, 1, 4, 'Capcom เผย! Monster Hunter World', 'ก็ดาเมจรุนแรงไม่แพ้แคปเฌอหรือปัญนะครับ ถึงเธอจะเป็นไอดอลที่อายุน้อยที่สุดในทีม แต่ก็มีพัฒนาการและความตั้งใจไม่แพ้คนอื่นเลยจริงๆ ถ้าอยากรู้จักเปี่ยมมากกว่านี้ ชวนเข้ามาอ่านกันต่อครับ (มีเซ็ตภาพเปี่ยมด้วย)\n\nCapcom ได้ประกาศในหน้าเว็บ เปิดเผยว่า Monster Hunter : World ภาคล่าสุดของเกมซีรีส์ Monster Hunter นั้น ทำยอดส่งได้แล้วถึง 5 ล้านชุด และยอดดังกล่าว ก็ทำให้ Monster Hunter:World ขึ้นแท่นเกมที่ทำยอดส่งใน 3 วันแรกได้เร็วที่สุดของซีรีส์นี้ ', NULL, NULL, NULL, NULL, NULL, 7, '2018-01-25 18:16:16', NULL, 'textbox', 'active'),
(22, 1, 4, NULL, NULL, NULL, 'content_4f876df49fcc0c548f456b28135e46c1.jpg', 'ใครสร้างความกังวลให้คุณมากกว่ากัน', NULL, NULL, 2, '2018-01-25 18:21:54', '2018-02-02 19:31:17', 'image', 'active'),
(23, 1, 4, NULL, NULL, NULL, 'content_9261e5b38f635e65e8a42c556ef0a7e4.png', 'Capcom เผย! Monster Hunter World', NULL, NULL, 5, '2018-01-25 18:36:41', '2018-02-02 20:16:09', 'image', 'active'),
(24, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, '2018-01-25 18:36:45', NULL, 'textbox', 'active'),
(25, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '2018-01-25 18:51:57', NULL, 'image', 'active'),
(26, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '2018-01-25 19:20:09', NULL, 'textbox', 'active'),
(27, 1, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-01-25 19:49:02', NULL, 'textbox', 'active'),
(28, 1, 8, NULL, NULL, NULL, 'content_28f80468424ccd27b084f298032e9bbc.jpg', NULL, NULL, NULL, 2, '2018-01-25 19:49:02', NULL, 'image', 'active'),
(30, 1, 3, NULL, NULL, NULL, 'content_cdffa5df24f2cb2b0215fb05d5737a9d.jpg', NULL, NULL, NULL, 9, '2018-01-26 00:47:17', NULL, 'image', 'active'),
(32, 1, 5, NULL, NULL, NULL, 'content_77af38dc70a91d196bbd5dd4fb732293.jpg', NULL, NULL, NULL, 4, '2018-01-26 09:38:23', NULL, 'image', 'active'),
(33, 1, 5, 'สร้างสินทรัพย์ที่เป็นทั้งออนไลน์และออฟไลน์ ', 'ในการเดินทางของชีวิตครั้งนี้ ได้แง่มุมของชีวิตที่กว้างมาก เข้าใจโลกและรักโลกมากขึ้น และก็รักชีวิตมากขึ้นเรื่อยๆด้วย ไม่ใช่ว่ายึดว่าต้องสมบูรณ์แบบไม่เจ็บไม่ป่วยไม่ตาย แต่รักชีวิตเพราะไม่อยากเป็นภาระในเรื่องสุขภาพ เลยเป็นสาเหตุของการเลิกเหล้า\n\nพ่อผมตายเพราะเหล้า ผมเลยไม่อยากตายแบบนั้น เพราะผมรู้แล้วว่าเงินเก็บของคนทั้งครอบครัวจะหายไปภายพริบตาถ้าหากมีการป่วยหนักที่ต้องใช้เงิน\nจากนี้ไปมุ่งมั่นไปทางหาความรู้เพิ่ม เรียนออนไลน์แบบเสียเงินแล้วได้ใบประกาส เช่น เรียนจาก Udacity ของ Google\n\nสร้างทีม โดยจะปั้นคนในพื้นที่บ้านผมก่อน คือ ขอนแก่น ตอนนี้ปั้นได้แล้วสองคน คนหนึ่งผมลงทุนซื้อคอมพิวเตอร์ให้แล้วผ่อนกับผมทุกเดือน ตอนนี้มีฝีมือพอตัวแล้ว รับงานออกแบบสติ๊กเกอร์ หาเงินเองได้แล้ว\n\nออนไลน์มีชัดเจนแล้วในมืออยู่สองสามตัว ทั้งทำเองและร่วมทำกับคนอื่น\nสิ่งที่สำคัญสุดอีกเรื่องคือการออมเงินและการลงทุน เพราะไม่อยากเป็นคนแก่ที่เป็นภาระลูก อยากนั่งเขียนบล็อกตอนแก่ ฝังตัวอ่านหนังสืออยู่บ้านป่า แต่ก็มีเงินใช้ อยากเดินทางเรียนรู้ชีวิตผู้คน', NULL, NULL, NULL, NULL, NULL, 2, '2018-01-26 09:38:26', NULL, 'textbox', 'active'),
(34, 1, 5, NULL, NULL, NULL, 'content_761cd3107e1b2cc0e09bdfea9c41e942.jpg', NULL, NULL, NULL, 11, '2018-01-26 09:54:07', NULL, 'image', 'active'),
(35, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-01-26 14:57:12', NULL, 'textbox', 'active'),
(36, 1, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-01-26 14:57:12', NULL, 'image', 'active'),
(37, 1, 10, NULL, NULL, NULL, 'content_9fe472966cab59c14756fd0e3116d37f.jpg', NULL, NULL, NULL, 1, '2018-01-26 14:57:57', NULL, 'image', 'active'),
(38, 1, 10, 'ใส่หัวข้อใหม่', 'ปีนี้อินเทลผลประกอบการก็มีคำถามว่าอินเทลจะปล่อยชิปที่ป้องกันการโจมตี Meltdown/Spectre ในระดับชิป (in-silicon) ได้เมื่อใด Brian Krzanich ซีอีโอของอินเทลก็ตอบผู้ถือหุ้นแล้วว่าน่าจะออกได้ภายในไตรมาสสี่ปีนี้\n\nตอนนี้ชิปรุ่นใหม่ๆ มีฟีเจอร์ PCID (Post-Context Identifier) ที่ช่วยให้แพตช์ KPTI ไม่กระทบต่อประสิทธิภาพนัก แต่หากชิปรุ่นใหม่ที่มีฟีเจอร์ป้องกันการโจมตีมาในตัวก็อาจจะส่งผลกระทบน้อยลง', NULL, NULL, NULL, NULL, NULL, 2, '2018-01-26 14:57:57', NULL, 'textbox', 'active'),
(39, 1, 5, NULL, NULL, NULL, 'content_43642fea0bae8fa6217a0ebafdc56921.jpg', NULL, NULL, NULL, 18, '2018-01-26 15:55:08', NULL, 'image', 'active'),
(40, 1, 5, NULL, NULL, NULL, 'content_f838534682527812d501d5aa86fa4cb9.jpg', NULL, NULL, NULL, 19, '2018-01-26 15:55:26', NULL, 'image', 'active'),
(41, 1, 5, NULL, 'Los Angeles residence ''Barrington House'' is a luxurious structure comprising of multiple polygons sunken into the Brentwood hillside. The three-story home looks almost inconspicuous from the front, but each level extends out the back to generous outdoor spaces which are a marvel to look at, let alone live in. Check out the tour below.', NULL, NULL, NULL, NULL, NULL, 16, '2018-01-26 15:55:58', NULL, 'textbox', 'active'),
(42, 1, 1, NULL, NULL, NULL, 'content_75c1ea0bb4334322ca4503f6c945855f.jpg', NULL, NULL, NULL, 1, '2018-01-26 15:59:35', NULL, 'image', 'active'),
(47, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2018-01-26 19:08:16', NULL, 'textbox', 'active'),
(48, 1, 3, NULL, 'The keyboard has now been updated to include predictive text. It learns how a user types, what they type, how they type and even what they type depending on the contact or form of messaging. So it''ll give users different word suggestions depending on who is being messaged - very useful when messaging your boss or messaging a friend.\n\nFamily members can now share content with each other making it easy to access content such as music, movies and apps between everyone without having to purchase multiple times.\n\nCalendars will sync between family members making it easy for everyone to stay organised and know their schedules.', NULL, NULL, NULL, NULL, NULL, 6, '2018-01-26 19:14:01', NULL, 'textbox', 'active'),
(50, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2018-01-26 19:17:07', NULL, 'textbox', 'active'),
(51, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, '2018-01-26 19:17:38', NULL, 'textbox', 'active'),
(52, 1, 3, NULL, NULL, NULL, 'content_e31b475edd1a5e13eaf2cf41c571e1bc.jpg', NULL, NULL, NULL, 12, '2018-01-26 19:17:54', NULL, 'image', 'active'),
(53, 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, '2018-01-26 19:19:32', NULL, 'textbox', 'active'),
(54, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2018-01-26 19:30:43', NULL, 'image', 'active'),
(55, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, '2018-01-26 19:30:54', NULL, 'image', 'active'),
(56, 1, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-01-29 10:15:50', NULL, 'quote', 'active'),
(58, 1, 10, NULL, 'https://www.youtube.com/watch?v=3Ybipel58Y0', 'dqvbjL6oGqI', NULL, 'https://www.youtube.com/watch?v=xnlm57-RN8Q', NULL, NULL, 3, '2018-01-30 11:33:50', NULL, 'youtube', 'active'),
(59, 1, 10, NULL, NULL, '1go3dL2eSYU', NULL, NULL, NULL, NULL, 4, '2018-01-30 20:10:50', NULL, 'youtube', 'active'),
(60, 1, 10, NULL, NULL, 'D3YIxFFRi2Q', NULL, NULL, NULL, NULL, 5, '2018-01-30 20:11:01', NULL, 'youtube', 'active'),
(61, 1, 4, NULL, NULL, 'yL4iuudB5vU', NULL, NULL, NULL, NULL, 8, '2018-01-31 09:49:10', NULL, 'youtube', 'active'),
(62, 1, 4, NULL, NULL, 'PhKKRb_DDWs', NULL, NULL, NULL, NULL, 9, '2018-01-31 09:54:55', NULL, 'youtube', 'active'),
(63, 1, 4, NULL, NULL, 'tSEU-7nvAG4', NULL, NULL, NULL, NULL, 10, '2018-01-31 10:02:03', NULL, 'youtube', 'active'),
(64, 1, 4, NULL, NULL, 'Ybom-HjTuJk', NULL, NULL, NULL, NULL, 12, '2018-01-31 10:03:02', NULL, 'youtube', 'active'),
(65, 1, 4, 'ครบ 7 เดือนในการออกมาทำงานเป็น "ฟรีแลนซ์"', 'ผมเคยเอารถเร่นาม CofffeeCraft ออกไปจอดขายที่ประจำในวันที่ฝนฟ้าไม่เป็นใจ วันนั้นผมได้เงิน 80 บาท ทั้งที่จริงแล้ว ผมเลือกที่จะนั้งออกแบบงานอยู่บ้านทำงานไม่กี่ชั่วโมงก็ได้เงินไม่ต่ำกว่าพันบาทแล้ว', NULL, NULL, NULL, NULL, NULL, 11, '2018-01-31 10:08:04', NULL, 'textbox', 'active'),
(66, 1, 5, NULL, NULL, 'ajbs3a0cILI', NULL, NULL, NULL, NULL, 20, '2018-01-31 10:18:06', NULL, 'youtube', 'active'),
(67, 1, 4, NULL, NULL, 'xteFeH8KJGc', NULL, NULL, NULL, NULL, 13, '2018-01-31 10:51:14', NULL, 'youtube', 'active'),
(68, 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, '2018-01-31 11:37:58', NULL, 'document', 'active'),
(69, 1, 11, NULL, NULL, NULL, 'content_db3a67eaf62f9650b526d33c4c4f0f89.jpg', NULL, NULL, NULL, 1, '2018-01-31 11:51:36', NULL, 'image', 'active'),
(70, 1, 11, 'สำหรับการใช้งาน Newcleus', 'สำหรับการใช้งาน Newcleus นั้นเพียงเชื่อมต่อตัว music server เข้ากับสาย Lan และโหลด App Roon Remote และ login Roon เเล้วตัว App จะสเเกนหาเจอแบบอัตโนมัติทันทีถ้าอยู่ในเครือ Wifi อันเดียวกันครับ\n\nเเละเเน่นอนครับการซื้อ music server เเยกออกจากคอมพิวเตอร์เพื่อเล่นไฟล์เพลงนอกจากความสะดวกในการใช้งานเเล้วยังให้คุณภาพเสียงที่ดีขึ้นอีกเช่นกันครับ ด้วยการ optimize ทั้งจาก hardware และ software เพื่อสำหรับฟังเพลงมาโดยเฉพาะใน Roon Newcleus จึงโดดเด่นเรื่องแบ็คกราวด์พื้นหลังที่นิ่งและสงัดขึ้นอย่างเห็นได้ชัดรวมไปน้ำเสียงที่ฟังดูไหลลื่นขึ้นและในขณะเดียวกันยังให้ปลายเสียงที่ทอดตัวได้ไกลขึ้น ซึ่งรวมเเล้วถือว่าสังเกตุการเปลี่ยนแปลงในทางที่ดีขึ้นได้อย่างได้อย่างเป็นรูปธรรมครับ\n\nสำหรับรีวิวเต็มๆเดี๋ยวรออ่านจากเฮียมั่นคงอีกทีครับเพราะรอบนี้เฮียควักกระเป๋าหิ้วเอากลับไปนอนคลุกเล่นที่บ้านเเล้วครับเเต่อาจจะใช้ระยะเวลาในการฟังอีกพักหนึ่งถึงจะมีให้อ่านกันครับ โดย Roon Newcleus นั้นสนนราคาอยู่ที่ 49,000 บาท ตอนนี้มีเดโม่ให้ทดลองฟังที่สาเรือธง ชั้น 3 ห้างอมรินทร์พลาซ่าครับ', NULL, NULL, NULL, NULL, NULL, 3, '2018-01-31 11:51:36', NULL, 'textbox', 'active'),
(73, 1, 11, NULL, NULL, 'UdSr2mWN2_4', NULL, NULL, NULL, NULL, 4, '2018-02-02 19:11:33', NULL, 'youtube', 'active'),
(74, 1, 11, 'หนังสือพิมพ์มีหน้าที่อะไร?', 'คำตอบของคำถามนี้ไม่ได้อยู่ในทวิตเตอร์ แต่ภาพยนตร์เรื่อง The Post กุมคำใบ้สำคัญเอาไว้ นอกจากได้เข้าชิงรางวัล Best Pictures และพา Meryl Steep เข้าชิงรางวัล Actress in a Leading Role ของออสการ์ The Post ยังแสดงพลังของหนังสือพิมพ์ให้เห็นอย่างทะลุปรุโปร่ง', NULL, NULL, NULL, NULL, NULL, 5, '2018-02-02 19:12:18', NULL, 'textbox', 'active'),
(75, 1, 11, NULL, NULL, NULL, 'content_f20f40c603bb430b843a172b0952a128.jpg', 'วิวตอนบ่าย', NULL, NULL, 2, '2018-02-02 19:14:41', NULL, 'image', 'active'),
(80, 1, 11, NULL, NULL, NULL, NULL, NULL, 14.94511658462445, 99.99742984771729, 10, '2018-02-03 17:48:32', '2018-02-03 19:11:09', 'map', 'active'),
(81, 1, 11, NULL, NULL, NULL, NULL, 'ร้านอยู่ข้างต้นไม้ใหญ่', 14.93105994380192, 100.04738330841064, 11, '2018-02-03 17:49:05', '2018-02-03 19:50:01', 'map', 'active'),
(82, 1, 11, NULL, NULL, NULL, NULL, 'ทดสอบ', 14.94540683004805, 99.99017715454102, 13, '2018-02-03 19:28:34', '2018-02-03 19:52:32', 'map', 'active'),
(83, 1, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, '2018-02-03 19:52:48', NULL, 'map', 'active'),
(84, 2, 13, NULL, NULL, NULL, 'content_4b0fcb71c5de69c3715824c3147602c7.jpg', NULL, NULL, NULL, 1, '2018-02-04 17:12:14', '2018-02-04 17:13:39', 'image', 'active'),
(85, 2, 13, NULL, 'A Course For You: Learn how to design a beautiful and engaging mobile app with Adobe Experience Design (XD). Learn-by-doing approach.\n\nyears Barcelona-based photographer Xavi Bou has been fascinated by this question. Just as a sinuous impression appears when a snake slides across sand, he imagined, so must a pattern form in the wake of a flying bird. But of course birds in flight leave no trace—at least none visible to the naked eye. Bou, now 38, spent the past five years trying to capture the elusive contours drawn by birds in motion, or, as he says, “to make visible the invisible.”\n\nFirst he had to shed the role of mere observer. “Like a naturalist, I used to travel around the world looking at wildlife,” he says. He began exploring photographic techniques that would allow him to express his love of nature and show the beauty of birds in a way not seen before.', NULL, NULL, NULL, NULL, NULL, 2, '2018-02-04 17:12:14', '2018-02-04 17:14:09', 'textbox', 'active'),
(86, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-02-04 17:36:01', NULL, 'image', 'active'),
(87, 2, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-02-04 17:36:01', NULL, 'textbox', 'active'),
(88, 2, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-02-04 17:36:44', NULL, 'image', 'active'),
(89, 2, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-02-04 17:36:44', NULL, 'textbox', 'active'),
(90, 2, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-02-04 17:36:47', NULL, 'image', 'active'),
(91, 2, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-02-04 17:36:47', NULL, 'textbox', 'active'),
(92, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2018-02-04 17:37:26', NULL, 'image', 'active'),
(93, 2, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '2018-02-04 17:37:26', NULL, 'textbox', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(8) NOT NULL,
  `article_id` mediumint(8) NOT NULL,
  `user_id` mediumint(8) NOT NULL,
  `title` text,
  `description` text,
  `file_name` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `file_size` float DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `view` mediumint(8) NOT NULL DEFAULT '0',
  `download` mediumint(8) NOT NULL DEFAULT '0',
  `secret` varchar(50) DEFAULT NULL,
  `privacy` varchar(20) DEFAULT 'member',
  `status` varchar(20) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `article_id`, `user_id`, `title`, `description`, `file_name`, `file_type`, `file_size`, `create_time`, `edit_time`, `view`, `download`, `secret`, `privacy`, `status`) VALUES
(2, 4, 1, 'โฆษณา-ปราจีนเดลี่', NULL, 'โฆษณา-ปราจีนเดลี่-303824.pdf', 'Array', 228872, '2018-01-31 20:06:21', '2018-01-31 20:06:21', 0, 0, 'a7285ce45b22a8a1840bd257267f2a78', 'public', 'active'),
(3, 4, 1, 'DATALINK-CONCEPT-001', NULL, 'DATALINK-CONCEPT-001-caafef.pdf', 'Array', 4324290, '2018-01-31 20:13:30', '2018-01-31 20:13:30', 0, 0, 'ea367e51447ce4241ea06b3f0868a0f3', 'public', 'active'),
(9, 11, 1, '20170124-02-Digital-Transformation', NULL, '20170124-02-Digital-Transformation-575bfa.pdf', 'Array', 7465410, '2018-02-02 20:33:53', '2018-02-02 20:33:53', 0, 0, '568a8406fc4e063fa06a3666e81bb3ac', 'public', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE IF NOT EXISTS `signature` (
  `id` int(8) NOT NULL,
  `sign` text NOT NULL,
  `expire` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `active_time` datetime DEFAULT NULL,
  `form` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signature`
--

INSERT INTO `signature` (`id`, `sign`, `expire`, `create_time`, `active_time`, `form`) VALUES
(37, '9c8944b85b15c74833250fdcd089b05da7c8144ca1246f29b9aa12f471eff7af', 1517738933, '2018-02-04 17:07:53', NULL, 'register');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(8) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` text,
  `fname` text NOT NULL,
  `lname` text,
  `bio` text,
  `password` text NOT NULL,
  `salt` text,
  `ip` varchar(50) DEFAULT NULL,
  `register_time` datetime NOT NULL,
  `edit_time` datetime DEFAULT NULL,
  `visit_time` datetime DEFAULT NULL,
  `verified` varchar(20) DEFAULT 'non-verified',
  `type` varchar(20) NOT NULL DEFAULT 'guest',
  `status` varchar(20) DEFAULT 'pending',
  `fb_id` varchar(20) DEFAULT NULL,
  `fb_fname` varchar(50) DEFAULT NULL,
  `fb_lname` varchar(50) DEFAULT NULL,
  `fb_link` text,
  `fb_verified` tinyint(1) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `phone`, `email`, `fname`, `lname`, `bio`, `password`, `salt`, `ip`, `register_time`, `edit_time`, `visit_time`, `verified`, `type`, `status`, `fb_id`, `fb_fname`, `fb_lname`, `fb_link`, `fb_verified`, `gender`) VALUES
(1, NULL, 'mrjimmy18@gmail.com', '', '', NULL, 'fbb14df497e1250295282f022e19b128e6ad2868f4b9dbbd8120ec2d5a8cf3f1cee1e0c1e6a55904db27a0e089bcebae1417c700d4040841670ca975dbd1a430', '7a8d717dc526b28f758a1dd7f559635b669c9d456b3b1cde9294c2070328d559684b93e715da2cb34233aaef83d091f526bae928ff372fecdd253bfcdd1867bc', '127.0.0.1', '2018-02-04 15:47:10', NULL, '2018-02-04 17:08:08', 'non-verified', 'member', 'pending', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '0359450', 'jimmy@gmail.com', 'Dinsorser', '', NULL, 'b8f7e816db42b9a66036e444ccabc6a9b3dab11b7363bc0f58d6056fdad0d8d1889519d81521ea4b809bb240273e3aaa567acb41d5e7b7d6fe80c99f36ce4abe', '98ed6f35f815e61eca7ccbda085a0c672a4da0cf6368a63c01e0a9ba502e0d2c00861fa9447848365061d10c128fcc623b42a4fb0a812e5c326a929dd9de953c', '127.0.0.1', '2018-02-04 17:08:08', NULL, '2018-02-04 17:38:35', 'non-verified', 'member', 'pending', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
