-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 05:47 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch` year(4) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `connected_to` text NOT NULL,
  `avatar` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= Unverified, 1= Verified',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `batch`, `course_id`, `email`, `connected_to`, `avatar`, `status`, `date_created`) VALUES
(2, 'Mike', 'D', 'Williams', 'Male', '2009', 1, 'mwilliams@sample.com', 'My Company', '1602730260_avatar.jpg', 1, '2020-10-15'),
(14, 'Mohamed', '', 'Afrath', 'Male', '2020', 6, 'afrath12@gmail.com', 'Kiska Management ', '1737043320_IMG-20221107-WA0004-02.jpg', 1, '2025-01-17'),
(15, 'Mohamed', '', 'Ammar', 'Male', '2016', 7, 'ammar22@gmail.com', 'John Entrepreneurs', '1737043380_WhatsApp-Image-2022-03-14-at-3.53.17-PM.jpeg', 1, '2025-01-17'),
(17, 'Fathima', '', 'Fahima', 'Female', '2019', 10, 'fahima23@gmail.com', 'Kiddo science', '1737043680_happy-girl-standing-in-creative-office-illustration-ai-generative-free-photo.jpg', 1, '2025-01-17'),
(18, 'Fathima', '', 'Asiyan', 'Female', '2012', 9, 'asiyan23@gmail.com', 'BBC', '1737043800_pngtree-single-asian-girl-in-formal-office-dress-business-professional-women-style-png-image_15446834.png', 1, '2025-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `company`, `location`, `job_title`, `description`, `link`, `user_id`, `date_created`) VALUES
(2, 'ABC Company', 'Alor Setar', 'IT Specialist', '&lt;p style=&quot;margin-top: 1.5em; margin-bottom: 1.5em; margin-right: unset; margin-left: unset; color: rgb(68, 68, 68); font-family: &amp;quot;Open Sans&amp;quot;, sans-serif; font-size: 16px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); line-height: 1.5; animation: 1000ms linear 0s 1 normal none running fadeInLorem;&quot;&gt;IT company&lt;/p&gt;', '', 1, '2020-10-15 15:05:37'),
(8, 'MCMC', 'Selangor,Malaysia', 'Cyber Security Executive', '&lt;span style=&quot;color: rgb(46, 56, 73); font-family: SeekSans, &amp;quot;SeekSans Fallback&amp;quot;, Arial, Tahoma, sans-serif; font-size: 16px;&quot;&gt;The executive will be reporting to the Head of the Technology Assurance Department, and is responsible for conducting audits of technology systems, networks, and cybersecurity measures within the Malaysian Communications and Multimedia Commission (MCMC). This role involves evaluating the effectiveness of technology controls, identifying risks, and contributing to the enhancement of the organization&amp;#x2019;s technology governance and security practices.&lt;/span&gt;', 'https://my.jobstreet.com/cybersecurity-jobs?jobId=81157776&type=standout', 33, '2025-01-17 00:48:39'),
(9, 'Meta', 'KL, Malaysia', 'Digital Marketing Specialist', 'Responsible for creating and executing marketing campaigns, analyzing market trends, and optimizing digital strategies to boost brand presence.', 'https://www.metacareers.com/locations/malaysia/?p[offices][0]=Kuala%20Lumpur%2C%20Malaysia&offices[0]=Kuala%20Lumpur%2C%20Malaysia', 1, '2025-01-17 01:54:18'),
(11, 'AIU', 'aiu', 'Banana', 'it is very good test', 'https://summerofcode.withgoogle.com/archive/2024/organizations', 46, '2025-01-25 14:20:31'),
(12, 'AIR ASIA', 'Penang', 'Cyber security analyst', '...', 'https://summerofcode.withgoogle.com/archive/2024/organizations', 46, '2025-01-25 15:37:16');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'BS Information Technology', 'Sample'),
(4, 'Data Science', ''),
(6, 'BBA (HRM)', ''),
(7, 'BBA (Marketing)', ''),
(9, 'Media and Communication', ''),
(10, 'Elementary Education', '');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(30) NOT NULL,
  `institution` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `program` text NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `institution`, `location`, `program`, `description`, `link`, `user_id`, `date_created`) VALUES
(1, 'German Academic Exchange Service (DAAD)', 'Germany', 'Master’s Degree Programs in Germany', 'DAAD offers fully-funded scholarships for international students to pursue master&rsquo;s degrees in Germany. The programs cover a wide range of disciplines with a focus on fostering development and strengthening capacities in developing countries.', 'https://www.daad.de/en/studying-in-germany/scholarships/daad-scholarships/', 1, '2025-01-10 21:09:03'),
(4, 'Harvard University', 'Online', 'Online - Data Science Professional Certificate', 'This comprehensive program consists of a series of courses designed to build expertise in data science, including R programming, machine learning, and data visualization. It equips learners with the skills required to analyze and interpret complex data for decision-making in diverse fields.', 'https://www.harvard.edu/', 32, '2025-01-16 17:50:10'),
(5, 'Google (Offered via Coursera)', 'Online', 'Google IT Support Professional Certificate', 'This beginner-friendly program provides foundational knowledge in IT support, including troubleshooting, system administration, and networking. It is an excellent pathway for those seeking to enter the IT field, with no prior experience required. Completion may lead to job placement opportunities with Google&rsquo;s partner network.', 'https://grow.google/certificates/it-support/', 1, '2025-01-17 01:06:49'),
(7, 'ABCDE', 'AIU', 'SCI', 'comkcdhnla&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 'https://summerofcode.withgoogle.com/archive/2024/organizations', 46, '2025-01-25 14:23:24');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `content`, `schedule`, `banner`, `date_created`) VALUES
(2, 'Study Circle January', 'Study Circle for SCI with Fahima', '2026-01-24 17:00:00', '1736851860_WhatsAppImage2022-10-30at16.21.57.jpg', '2025-01-14 18:51:35'),
(3, 'Skill development Lecture series', 'The Skill Development Lecture Series is a curated program designed to empower individuals by enhancing their personal and professional competencies. Through a series of expert-led sessions, participants gain valuable insights, practical knowledge, and actionable strategies to excel in various fields. Covering topics such as communication skills, leadership, time management, and technical proficiency, the series aims to bridge the gap between academic learning and real-world application.', '2026-02-24 15:37:00', '1737046800_The-Importance-and-Method-of-Skill-Development.png', '2025-01-14 19:02:22'),
(4, 'Alumni Get-together 2025', '&lt;span style=&quot;color: rgb(12, 12, 12); font-family: Arial, Helvetica, Verdana, &quot; bitstream=&quot;&quot; vera=&quot;&quot; sans&quot;,=&quot;&quot; sans-serif;=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; text-align:=&quot;&quot; justify;&quot;=&quot;&quot;&gt;The Alumni Get-together is organized on Saturday, Feruary 14, 2026 at 7:00 PM at the AIU Convocation Hall&lt;/span&gt;&lt;span style=&quot;color: rgb(12, 12, 12); font-family: Arial, Helvetica, Verdana, &quot; bitstream=&quot;&quot; vera=&quot;&quot; sans&quot;,=&quot;&quot; sans-serif;=&quot;&quot; font-size:=&quot;&quot; 12px;=&quot;&quot; text-align:=&quot;&quot; justify;&quot;=&quot;&quot;&gt;. Please register to connect with your fellow alumni and relive the awesome memories.&lt;/span&gt;', '2025-12-24 19:00:00', '1737046560_alumni2015.jpg', '2025-01-14 21:55:49'),
(5, 'Learn Python with Afrath', 'Online class for absolute beginners in python.&lt;br&gt;&lt;br&gt;Join if you&rsquo;re interested&lt;br&gt;&lt;br&gt;&lt;a href=&quot;https://summerofcode.withgoogle.com/archive/2024/organizations&quot;&gt;Archive Organizations | Google Summer of Code&lt;/a&gt;', '2026-02-04 15:36:00', '1737782700_download.jpg', '2025-01-25 13:25:57');

-- --------------------------------------------------------

--
-- Table structure for table `event_commits`
--

CREATE TABLE `event_commits` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_commits`
--

INSERT INTO `event_commits` (`id`, `event_id`, `user_id`) VALUES
(1, 1, 3),
(2, 1, 8),
(3, 2, 22),
(4, 2, 25),
(5, 3, 25),
(6, 2, 8),
(7, 3, 27),
(8, 4, 22),
(9, 5, 46),
(10, 5, 47),
(11, 2, 46);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `topic_id`, `comment`, `user_id`, `date_created`) VALUES
(1, 3, 'Sample updated Comment', 3, '2020-10-15 15:46:03'),
(3, 3, 'Sample', 1, '2020-10-16 08:48:02'),
(5, 0, '', 1, '2020-10-16 09:49:34'),
(8, 1, 'MatPlotLib', 1, '2025-01-17 00:30:47'),
(9, 1, '', 1, '2025-01-17 01:10:00'),
(10, 38, 'ok&lt;p&gt;&lt;br&gt;&lt;/p&gt;', 1, '2025-01-17 01:24:54'),
(11, 46, 'more', 46, '2025-01-25 13:18:06'),
(12, 46, 'ohhh gooddd', 46, '2025-01-25 14:26:54'),
(13, 33, '....', 33, '2025-01-25 15:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `title`, `description`, `user_id`, `date_created`) VALUES
(4, 'Data Science', 'Suggest some good python libraries that can be used for data analytics', 1, '2020-10-16 08:31:45'),
(5, 'Career Guidance and Opportunities', 'Share advice, resources, and opportunities for career growth. Alumni can post about job openings, internships, or tips on succeeding in specific industries.', 1, '2025-01-17 01:11:29'),
(8, 'Skill Development And Lifelong Learning', '&lt;span style=&quot;color: rgb(33, 37, 41); font-family: Merriweather, -apple-system, BlinkMacSystemFont, &amp;quot;Segoe UI&amp;quot;, Roboto, &amp;quot;Helvetica Neue&amp;quot;, Arial, &amp;quot;Noto Sans&amp;quot;, sans-serif, &amp;quot;Apple Color Emoji&amp;quot;, &amp;quot;Segoe UI Emoji&amp;quot;, &amp;quot;Segoe UI Symbol&amp;quot;, &amp;quot;Noto Color Emoji&amp;quot;; font-size: 16px;&quot;&gt;Recommend courses, workshops, or certifications that have helped you professionally. Share your experiences and discuss trending skills in various fields.&lt;/span&gt;', 38, '2025-01-17 01:17:11'),
(10, 'How to jsdgcjka', 'ihdkslancsjlkz', 46, '2025-01-25 14:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(30) NOT NULL,
  `about` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `about`, `created`) VALUES
(1, 'MUHAMMAD YASSER RABUSAH\r\n(Diploma in Aviation Management & Bachelor in Airline and Airport Management, 2009-2014)\r\n...............................................................\r\n-Ground Handling Manager, MyJet Express-\r\n“I graduated with Diploma in Aviation Management in 2009 before I completed my Bachelor’s Degree in Airline and Airport Management in 2014 with UniCAM. I can tell, there is no educational institution in Malaysia highly-specified as UniCAM in aviation. I started my career in aviation by becoming a cabin crew for a few years before I was promoted to a high-ranked position as a station head in East Malaysia. Today, I worked as a Safety Anchor where I am responsible for SMS and investigation aspect of the entire organisation in Kota Kinabalu, Sabah.”', '2025-01-10 21:41:03'),
(3, 'ETHIRA SHERWANY BINTI AHMAD\r\n(Diploma in Aviation Management, 2017)\r\n-Senior Executive, Alliance Bank-\r\n“My time during University College of Aviation Malaysia has been spectacular. They offered me a chance to develop my academic and personal skills. Furthermore, their blended learning initiatives make study more relevant in today’s modern world.”', '2025-01-16 23:51:03'),
(4, 'ANSHATH AHAMED AJUMIL\r\n(Diploma in Aviation Management ,\r\nBachelor in Airline & Airport Management, 2012)\r\n– Pharmaniaga Logistics Sdn. Bhd–\r\n“The academic approach & teaching methods applied here is very effective and excellent syllbus program enable me to acquired the skills to advance my dream career and widening my career prospect in the fast developing fields of Aviation & Logistics Industry.”', '2025-01-16 23:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `student_bio`
--

CREATE TABLE `student_bio` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `cohort` varchar(10) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `s_id` varchar(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=verified, 0=unverified',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_bio`
--

INSERT INTO `student_bio` (`id`, `firstname`, `middlename`, `lastname`, `gender`, `cohort`, `course_id`, `email`, `s_id`, `status`, `date_created`) VALUES
(11, 'Mohamed', '', 'Faruk', 'Male', '4', 4, 'faruk12@gmail.com', 'AIU2311002', 1, '2025-01-17'),
(12, 'Khan', '', 'Asar', 'Male', '5', 1, 'asar12@gmail.com', 'AIU23102134', 1, '2025-01-17'),
(13, 'Salam', '', 'Anshaf', 'Male', '4', 4, 'anshaf12@gmail.com', 'AIU23102100', 1, '2025-01-17'),
(14, 'Af', '', 'Ridwan', 'Male', '3', 9, 'ridwan12@gmail.com', 'AIU23102222', 1, '2025-01-17'),
(16, 'Mohammed', '', 'Ammar', 'Male', '5', 7, 'ammar@gmail.com', 'AIU24102100', 1, '2025-01-25'),
(17, 'Asiyan', '-', 'Bahahkhiri', 'Female', '4', 4, 'asiyan.bahahkhiri@student.aiu.edu.my', 'AIU22102036', 1, '2025-01-25'),
(19, 'Anshath', '', 'Ahamed', 'Male', '4', 4, 'anshath@gmail.com', 'AIU23102143', 0, '2025-12-22');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'AIU Alumni Management System', 'admin.ams@aiu.edu.my', '011-784-5404', '1737043080_bg.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;font color=&quot;#000000&quot; face=&quot;Open Sans, Arial, sans-serif&quot; style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;b style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;AIU Alumni Management System is specially tailored to manage registered alumni of Albukhary International University, where the alumni can post job and educational opportunities which can benefit others, and publish their success stories.&lt;/b&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;font color=&quot;#000000&quot; face=&quot;Open Sans, Arial, sans-serif&quot;&gt;&lt;b&gt;AIU Students can register to view job and educational opportunities which can support their career and ask questions through question forums.&lt;/b&gt;&lt;/font&gt;&lt;/p&gt;&lt;p style=&quot;text-align: justify; background: transparent; position: relative;&quot;&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;b&gt;&lt;/p&gt;&lt;font color=&quot;#000000&quot; face=&quot;Open Sans, Arial, sans-serif&quot;&gt;&lt;p style=&quot;text-align: center;&quot;&gt;&lt;span style=&quot;background-color: transparent;&quot;&gt;&lt;b&gt;For posting on Events and Success stories please contact admin through admin.ams@aiu.edu.my&lt;/b&gt;&lt;/span&gt;&lt;/p&gt;&lt;/font&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1=Admin,2=Student\r\n, 3= Alumni',
  `auto_generated_pass` text NOT NULL,
  `alumnus_id` int(30) NOT NULL,
  `student_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `auto_generated_pass`, `alumnus_id`, `student_id`) VALUES
(1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 1, '', 0, 0),
(20, 'new Changed', 'd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 3, '', 10, 0),
(32, 'Fahiiii', 'Fahiii', '21232f297a57a5a743894a0e4a801fc3', 1, '', 0, 0),
(33, 'Mohamed Afrath', 'afrath12@gmail.com', '113b81a086a3d601341d83124ba96074', 3, '', 14, 0),
(34, 'Mohamed Ammar', 'ammar22@gmail.com', 'a0da27baba88e573c351502a63844844', 3, '', 15, 0),
(36, 'Fathima Fahima', 'fahima23@gmail.com', '04a896bfd86724016179aa72867ee39b', 3, '', 17, 0),
(37, 'Fathima Asiyan', 'asiyan23@gmail.com', 'efe25de014fd962171f7b455042478e9', 3, '', 18, 0),
(38, 'Mohamed Faruk', 'faruk12@gmail.com', 'c2b6814336f5560b2eebcbeded2a78be', 2, '', 0, 11),
(39, 'Khan Asar', 'asar12@gmail.com', 'fc01993d12215808d66d690cd42dd7eb', 2, '', 0, 12),
(40, 'Salam Anshaf', 'anshaf12@gmail.com', 'ba862ce2b6b7e796c63ee5b17923d049', 2, '', 0, 13),
(41, 'Af Ridwan', 'ridwan12@gmail.com', '43534dd7f74ec71111e5feff6825d92d', 2, '', 0, 14),
(44, 'Mohammed Ammar', 'ammar@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '', 0, 16),
(45, 'Chicken', 'chicken123', '21232f297a57a5a743894a0e4a801fc3', 1, '', 0, 0),
(47, 'Asiyan Bahahkhiri', 'asiyan.bahahkhiri@student.aiu.edu.my', '5b410a032966bfbeaf694543f1d18fc0', 2, '', 0, 17),
(49, 'Anshath Ahamed', 'anshath@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, '', 0, 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_bio`
--
ALTER TABLE `student_bio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `event_commits`
--
ALTER TABLE `event_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_bio`
--
ALTER TABLE `student_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
