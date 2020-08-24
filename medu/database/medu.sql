-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 07:05 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medu`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `banner_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `description`, `banner_id`, `status`, `deleted`, `created_at`) VALUES
(3, 'hello dear i am alamin hossain. i am a web developer.', 1, 1, 0, '2020-03-19 02:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `banner_greeting` varchar(100) NOT NULL,
  `banner_title` varchar(100) NOT NULL,
  `banner_description` text NOT NULL,
  `banner_photo` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner_greeting`, `banner_title`, `banner_description`, `banner_photo`, `status`, `deleted`, `created_at`) VALUES
(1, 'Hello', 'alamin hossain', 'View Al amin Hossain is profile on LinkedIn, the world is largest professional community. Al amin has 3 ... I have over 5 years of experience working in web development . Currently, I work in ... Habib Ullah. Junior Software Engineer at ByteEver ...', '1.png', 1, 1, '2020-03-10 06:16:48'),
(3, 'Hi', 'i am alamin hossain', 'i am a web developer in php laravel.', '3.png', 1, 0, '2020-03-19 02:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `banner_icons`
--

CREATE TABLE `banner_icons` (
  `id` int(11) NOT NULL,
  `banner_icon_name` varchar(40) NOT NULL,
  `banner_icon_color` varchar(10) NOT NULL DEFAULT '#08cf37',
  `banner_icon_link` varchar(255) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_icons`
--

INSERT INTO `banner_icons` (`id`, `banner_icon_name`, `banner_icon_color`, `banner_icon_link`, `banner_id`, `deleted`, `created_at`) VALUES
(1, 'fab fa-facebook-f', '#ff8040', 'https://facebook.com', 1, 0, '2020-03-10 10:22:08'),
(2, 'fab fa-pinterest', '#ff0000', 'https://pinterest.com', 1, 0, '2020-03-10 10:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `brands_logo`
--

CREATE TABLE `brands_logo` (
  `id` int(11) NOT NULL,
  `brand_logo` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands_logo`
--

INSERT INTO `brands_logo` (`id`, `brand_logo`, `status`, `deleted`, `created_at`) VALUES
(9, '9.png', 1, 0, '2020-03-19 02:55:58'),
(10, '10.png', 1, 0, '2020-03-19 02:56:05'),
(11, '11.png', 1, 0, '2020-03-19 02:56:13'),
(12, '12.png', 1, 0, '2020-03-19 02:56:27'),
(13, '13.png', 1, 0, '2020-03-19 02:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_photo` varchar(255) NOT NULL,
  `client_comments` text NOT NULL,
  `client_occupation` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `client_photo`, `client_comments`, `client_occupation`, `status`, `deleted`, `created_at`) VALUES
(4, 'ismail', '4.png', 'wow you skill is so beautiful.nice confidence and good your behavior', 'head of web development', 1, 0, '2020-03-19 03:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `city`, `address`, `phone`, `email`, `banner_id`, `status`, `deleted`, `created_at`) VALUES
(5, 'mymensingh', 'phulpur mymensingh', '01759216367', 'alamingemamin@gmail.com', 3, 1, 0, '2020-03-19 03:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `customizes`
--

CREATE TABLE `customizes` (
  `id` int(11) NOT NULL,
  `bg_theme` varchar(10) NOT NULL DEFAULT '#112225',
  `bg_header` varchar(10) NOT NULL DEFAULT '#112226',
  `bg_sidebar` varchar(10) NOT NULL DEFAULT '#112228',
  `bg_banner` varchar(10) NOT NULL DEFAULT '#112230',
  `bg_about` varchar(10) NOT NULL DEFAULT '#112234',
  `bg_service` varchar(10) NOT NULL DEFAULT '#112238',
  `bg_portfolio` varchar(10) NOT NULL DEFAULT '#112242',
  `bg_fact` varchar(10) NOT NULL DEFAULT '#112245',
  `bg_testimonial` varchar(10) NOT NULL DEFAULT '#112249',
  `bg_brand` varchar(10) NOT NULL DEFAULT '#112252',
  `bg_contact` varchar(10) NOT NULL DEFAULT '#112254',
  `bg_footer` varchar(10) NOT NULL DEFAULT '#112225',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customizes`
--

INSERT INTO `customizes` (`id`, `bg_theme`, `bg_header`, `bg_sidebar`, `bg_banner`, `bg_about`, `bg_service`, `bg_portfolio`, `bg_fact`, `bg_testimonial`, `bg_brand`, `bg_contact`, `bg_footer`, `status`, `created_at`) VALUES
(2, '#313131', '#282828', '#252525', '#383838', '#333333', '#1f1f1f', '#2e2e2e', '#3b3b3b', '#464646', '#373737', '#444444', '#313131', 1, '2020-03-13 14:10:04'),
(3, '#640032', '#59002d', '#59002d', '#6a0035', '#59002d', '#620031', '#5b002e', '#5b002e', '#6f0037', '#660033', '#77003c', '#620031', 0, '2020-03-13 14:56:16'),
(4, '#285151', '#1f3d3d', '#1f3d3d', '#274e4e', '#275050', '#2b5757', '#2b5555', '#275050', '#316060', '#356a6a', '#285151', '#254b4b', 0, '2020-03-13 15:07:36'),
(5, '#112225', '#112226', '#112228', '#112230', '#112234', '#112238', '#112242', '#112245', '#112249', '#112252', '#112254', '#112225', 0, '2020-03-13 15:40:08'),
(6, '#000000', '#021100', '#031700', '#031500', '#041c00', '#031c00', '#021a00', '#031700', '#041a00', '#042b00', '#052200', '#041c00', 0, '2020-03-14 10:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(10) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `name`, `year`, `rank`, `banner_id`, `status`, `deleted`, `created_at`) VALUES
(3, 'jsc', '2013', '75', 3, 1, 0, '2020-03-19 02:53:02'),
(4, 'ssc', '2016', '85', 3, 1, 0, '2020-03-19 02:53:16'),
(5, 'diploma in engineer', '2020', '90', 3, 1, 0, '2020-03-19 02:53:40');

-- --------------------------------------------------------

--
-- Table structure for table `facts`
--

CREATE TABLE `facts` (
  `id` int(11) NOT NULL,
  `fact_icon` varchar(30) NOT NULL,
  `fact_icon_color` varchar(10) NOT NULL DEFAULT '#8cc090',
  `fact_title` varchar(100) NOT NULL,
  `fact_count` varchar(30) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facts`
--

INSERT INTO `facts` (`id`, `fact_icon`, `fact_icon_color`, `fact_title`, `fact_count`, `status`, `deleted`, `created_at`) VALUES
(5, 'fas fa-book', '#ff8000', 'web book', '7000', 1, 0, '2020-03-19 02:58:10'),
(6, 'fas fa-user', '#ff0000', 'clients', '5000000', 1, 0, '2020-03-19 02:59:06'),
(7, 'fas fa-project-diagram', '#ff00ff', 'projects', '700', 1, 0, '2020-03-19 03:00:33');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` int(11) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `guest_email` varchar(200) NOT NULL,
  `guest_message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `guest_name`, `guest_email`, `guest_message`, `status`, `deleted`, `created_at`) VALUES
(9, 'alamin', 'alamin@gmail.com', 'hello brother how are you  ishdof sdfsdoi fsdoiofi osdoi oioioihn oito othe uo toijioti oijoitjooijoieoiewijoijw efjoijeojfoofjoh fdo th iwe wt hweor oiwe otho weiwoieh towetoi woieowe to', 1, 1, '2020-03-09 06:18:37'),
(14, 'forid', 'forid@gmail.com', '\r\nKnowing What To Write In A Card Is Our Jam, And Weve Got Hundreds Of Greeting Card Messages And Things You Can Write In A Card For Every Occasion Or Situation ...\r\n', 1, 1, '2020-03-11 15:27:49'),
(17, 'forhad', 'forhad@gmail.com', 'heel heo hooe hoeow hello', 1, 0, '2020-03-19 03:03:08');

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo`, `status`, `deleted`, `created_at`) VALUES
(5, '5.png', 1, 0, '2020-03-19 02:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo`, `banner_id`, `status`, `deleted`, `created_at`) VALUES
(4, '4.png', 1, 1, 0, '2020-03-19 02:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user`, `title`, `body`, `photo`, `status`, `deleted`, `created_at`) VALUES
(10, 'alamin hossain', 'web development wordpress', 'WordPress is a free and open-source content management system written in PHP and paired with a MySQL or MariaDB database. Features include a plugin architecture and a template system, referred to within WordPress as Themes', '10.jpg', 1, 0, '2020-03-21 17:48:14'),
(11, 'alamin hossain', 'web development laravel', 'Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the modelâ€“viewâ€“controller architectural pattern and based on Symfony.', '11.jpg', 1, 0, '2020-03-21 17:49:57'),
(12, 'alamin hossain', 'web development php', 'PHP is a popular general-purpose scripting language that is especially suited to web development. It was originally created by Rasmus Lerdorf in 1994; the PHP reference implementation is now produced by The PHP Group', '12.jpg', 1, 0, '2020-03-21 17:50:34'),
(13, 'alamin hossain', 'web development', 'Web development is the work involved in developing a website for the Internet or an intranet. Web development can range from developing a simple single static page of plain text to complex web-based internet applications, electronic businesses, and social network services', '13.jpg', 1, 0, '2020-03-21 17:51:08'),
(14, 'alamin hossain', 'web design', 'Web design encompasses many different skills and disciplines in the production and maintenance of websites. The different areas of web design include web graphic design; interface design; authoring, including standardised code and proprietary software; user experience design; and search engine optimization', '14.jpg', 1, 0, '2020-03-21 17:51:46'),
(16, 'alamin hossain', 'photo editing', 'Motion graphics are pieces of animation or digital footage which create the illusion of motion or rotation, and are usually combined with audio for use in multimedia projects. Motion graphics are usually displayed via electronic media technology, but may also be displayed via manual powered technology', '16.jpg', 1, 0, '2020-03-21 17:53:13'),
(17, 'alamin hossain', 'motion graphic', 'Motion graphics are pieces of animation or digital footage which create the illusion of motion or rotation, and are usually combined with audio for use in multimedia projects. Motion graphics are usually displayed via electronic media technology, but may also be displayed via manual powered technology', '17.jpg', 1, 0, '2020-03-21 17:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_name` varchar(150) NOT NULL,
  `project_sub_title` varchar(200) NOT NULL,
  `project_description` text NOT NULL,
  `project_photo` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_title`, `project_name`, `project_sub_title`, `project_description`, `project_photo`, `status`, `deleted`, `created_at`) VALUES
(1, 'Wed design', 'medu metarial web', 'web mobile responsive bootstrap design', 'Material Design Lite. Material Design Lite lets you add a Material Design look and feel to your websites. ... It is a cross-browser, cross-OS web developer s toolkit that can be used by anyone who wants to write more productive, portable, and &mdash; most importantly &mdash; usable web pages.\r\nMaterial Design Lite. Material Design Lite lets you add a Material Design look and feel to your websites. ... It is a cross-browser, cross-OS web developers toolkit that can be used by anyone who wants to write more productive, portable, and &mdash; most importantly &mdash; usable web pages.', '1.jpg', 1, 0, '2020-03-13 04:29:21'),
(2, 'web development', 'social network web page', 'social network website like instrgram and metarial bootstrap design', 'Material Design Lite. Material Design Lite lets you add a Material Design look and feel to your websites. ... It is a cross-browser, cross-OS web developer\'s toolkit that can be used by anyone who wants to write more productive, portable, and &mdash; most importantly &mdash; usable web pages.Material Design Lite. Material Design Lite lets you add a Material Design look and feel to your websites. ... It is a cross-browser, cross-OS web developer\'s toolkit that can be used by anyone who wants to write more productive, portable, and &mdash; most importantly &mdash; usable web pages.wow waht a amazindg a put oa fo alla grate mann obeaslya', '2.jpg', 0, 0, '2020-03-13 04:36:51'),
(3, 'wordpress ', 'islamic all ', 'islamic all web page created by wordpress cms ', 'Muslims are people who follow or practice Islam, a monotheistic Abrahamic religion. Muslims ... the Italian word mussulmano or musulmano, the Romanian word musulman and the Greek word Î¼Î¿Ï…ÏƒÎ¿Ï…Î»Î¼Î¬Î½Î¿Ï‚ (all used for a Muslim).', '3.jpg', 1, 0, '2020-03-13 05:18:15'),
(4, 'web development laravel', 'collage management system', 'college management system in laravel', 'Shariatpur Technical School &amp; College is located at 1021 Sariatpur Shariatpur. Its EIIN is 133154 and ... the failure rate is 73.9726 %. Embed Result on Website.\r\nShariatpur Technical School &amp; College is located at 1021 Sariatpur Shariatpur. Its EIIN is 133154 and ... the failure rate is 73.9726 %. Embed Result on Website.', '4.jpg', 1, 0, '2020-03-13 05:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_icon` varchar(24) NOT NULL,
  `service_icon_color` varchar(10) NOT NULL DEFAULT '#8cc090',
  `service_title` varchar(100) NOT NULL,
  `service_description` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_icon`, `service_icon_color`, `service_title`, `service_description`, `status`, `deleted`, `created_at`) VALUES
(7, 'fas fa-heart', '#ff8000', 'web development', 'the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog the quick brown fox jumps over the lazy dog ', 1, 0, '2020-03-19 02:43:27'),
(8, 'fas fa-images', '#ff0000', 'web design', 'web design of most  platform in this world the quick brown fox jumps over the lazy dog the quic brown fox jumps over the lazy dog the quick brown fox  jump sover the lazy dog                                                                                             ', 1, 0, '2020-03-19 03:06:51'),
(9, 'fas fa-coffee', '#ff00ff', 'wordpress', 'wordpress most usefully cms in world the quick b rown  fox jump sover the lazu do gth quick brown fox jumps over the lazy od g dog the quickbrown fox jump sover the lazy dog the quickbrown fox jumps over ht elauz                                                                                                        ', 1, 0, '2020-03-19 03:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `register_role` varchar(10) NOT NULL DEFAULT '3',
  `limitation` int(11) NOT NULL,
  `sorting` varchar(100) NOT NULL,
  `tf_auth` tinyint(4) NOT NULL DEFAULT 0,
  `filtering` varchar(10) NOT NULL DEFAULT 'id',
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `register_role`, `limitation`, `sorting`, `tf_auth`, `filtering`, `status`) VALUES
(1, '3', 3, 'DESC', 0, 'created_at', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site_identy`
--

CREATE TABLE `site_identy` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `footer` varchar(200) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_identy`
--

INSERT INTO `site_identy` (`id`, `title`, `footer`, `icon`) VALUES
(1, 'personal site', 'medu', '1.ico');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `role` int(5) NOT NULL DEFAULT 0,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `vkey` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `forgot_key` varchar(255) DEFAULT NULL,
  `tf_key` varchar(255) DEFAULT NULL,
  `tf_email` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `user_photo`, `role`, `email`, `password`, `vkey`, `verified`, `forgot_key`, `tf_key`, `tf_email`, `deleted`, `created_at`) VALUES
(19, 'alamin hossain', 'male', '19.png', 1, 'alamingemamin@gmail.com', '$2y$10$S.a7IjmkQ/MpMw8W3h3kE.v1c9/HlS5o2nf6zaOPu19ub6MD9NL5G', 'bd15cf384799fdf23fbd6cf3c6562470', 1, 'NDkzMDY4NDE=', '524524', 'alaminstackamin@gmail.com', 0, '2020-03-18 08:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_icons`
--
ALTER TABLE `banner_icons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands_logo`
--
ALTER TABLE `brands_logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customizes`
--
ALTER TABLE `customizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facts`
--
ALTER TABLE `facts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_identy`
--
ALTER TABLE `site_identy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banner_icons`
--
ALTER TABLE `banner_icons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands_logo`
--
ALTER TABLE `brands_logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customizes`
--
ALTER TABLE `customizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `facts`
--
ALTER TABLE `facts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `site_identy`
--
ALTER TABLE `site_identy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
