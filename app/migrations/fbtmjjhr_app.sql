-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2020 at 08:32 AM
-- Server version: 10.3.24-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fbtmjjhr_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(250) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `passwordsalt` varchar(1000) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `country` varchar(50) NOT NULL,
  `lastlogindate` varchar(50) NOT NULL,
  `logintoken` varchar(1000) NOT NULL,
  `logindevice` varchar(1000) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `role`, `firstname`, `lastname`, `email`, `phone`, `photo`, `password`, `passwordsalt`, `address`, `city`, `state`, `country`, `lastlogindate`, `logintoken`, `logindevice`, `date`) VALUES
(1, 'Admin', NULL, 'Adewale', 'Adisa', 'info@metricsmanager.co', '08077018502', 'public/uploads/avatar.png', '$2y$08$S0pFbU4xbm02eFE2cDhFR.xInoMmZieJW0T11z/2fjkCQD7gX0bBi', '', '', '', '', '', '25-09-2020', 'c7cdd995105481cc37cd', '', '05-12-2019'),
(2, 'TeejayMaya', NULL, 'Teejay', 'Maya', 'info@codeplay.com.ng', '08057074642', 'public/uploads/avatar.png', '$2y$08$S0pFbU4xbm02eFE2cDhFR.xInoMmZieJW0T11z/2fjkCQD7gX0bBi', '', '', '', '', '', '07-02-2020', 'f5871e6c33dd6f7f2c84', '', '05-12-2019');

-- --------------------------------------------------------

--
-- Table structure for table `adminsettings`
--

CREATE TABLE `adminsettings` (
  `id` int(250) NOT NULL,
  `lastuserid` int(250) NOT NULL,
  `announcement` text DEFAULT NULL,
  `minimumorderamount` int(250) DEFAULT NULL,
  `minimumordershipmentfee` int(250) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `updateddate` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminsettings`
--

INSERT INTO `adminsettings` (`id`, `lastuserid`, `announcement`, `minimumorderamount`, `minimumordershipmentfee`, `author`, `updateddate`) VALUES
(1, 1, 'Please do note that all orders below N15,000 attracts a N1,000 shipping fee', 15000, 1000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(250) NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `image`, `link`, `position`, `details`, `author`, `date`) VALUES
(1, 'files/slide-img1.jpg', '#', 'Slider', 'undefined', 'agboola', '07-07-2020'),
(2, 'files/slide-img2.jpg', '#', 'Slider', 'undefined', 'agboola', '07-07-2020'),
(3, 'files/slide-img3.jpg', '#', 'Slider', 'undefined', 'agboola', '21-07-2020'),
(4, 'files/side-banner.jpg', '#', 'Side Banner', 'undefined', 'agboola', '23-08-2020'),
(8, 'files/footer-banner.jpg', '#', 'Advert Banner', '', 'agboola', '08-06-2020'),
(5, 'files/middle-banner1.png', '#', 'Side Banner', 'undefined', 'agboola', '09-06-2020'),
(6, 'files/middle-banner2.png', '#', 'Side Banner', 'undefined', 'agboola', '07-07-2020'),
(7, 'files/middle-banner3.png', '#', 'Advert Banner', 'undefined', 'agboola', '08-06-2020');

-- --------------------------------------------------------

--
-- Table structure for table `bannersliders`
--

CREATE TABLE `bannersliders` (
  `id` int(250) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidecaption` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidecaptiontwo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidecaptionthree` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidetext` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidebuttonlabel` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slidebuttonlink` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bannersliders`
--

INSERT INTO `bannersliders` (`id`, `type`, `media`, `slidecaption`, `slidecaptiontwo`, `slidecaptionthree`, `slidetext`, `slidebuttonlabel`, `slidebuttonlink`, `details`, `author`, `date`) VALUES
(1, 'photo', 'files/slide-img1.jpg', NULL, NULL, NULL, NULL, NULL, 'undefined', 'undefined', 'agboola', '30-01-2020'),
(2, 'photo', 'files/slide-img2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-01-2020'),
(3, 'photo', 'files/slide-img3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '07-01-2020');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(250) NOT NULL,
  `title` varchar(500) NOT NULL,
  `details` text NOT NULL,
  `photo` varchar(500) DEFAULT NULL,
  `safeurl` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `categoryid` int(250) DEFAULT NULL,
  `subcategory` varchar(200) DEFAULT NULL,
  `subcategoryid` int(250) DEFAULT NULL,
  `authorid` int(250) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `authorphoto` varchar(500) DEFAULT 'files/avatar.png',
  `authordetails` text DEFAULT NULL,
  `media` varchar(1000) DEFAULT NULL,
  `mediatype` varchar(100) DEFAULT NULL,
  `medialink` varchar(200) DEFAULT NULL,
  `views` int(250) DEFAULT NULL,
  `comments` int(250) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(250) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `authorid` int(250) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `safeurl` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `clienttestimonials`
--

CREATE TABLE `clienttestimonials` (
  `id` int(250) NOT NULL,
  `author` varchar(100) NOT NULL,
  `details` text NOT NULL,
  `authorphoto` varchar(500) DEFAULT NULL,
  `authorjob` varchar(100) DEFAULT NULL,
  `authorlocation` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT 'text',
  `media` varchar(250) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(250) NOT NULL,
  `companyid` int(250) DEFAULT NULL,
  `postid` int(250) DEFAULT NULL,
  `post` varchar(500) DEFAULT NULL,
  `userid` varchar(250) DEFAULT NULL,
  `username` varchar(300) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `photo` varchar(250) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `time` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(250) NOT NULL,
  `companyname` varchar(200) CHARACTER SET latin1 NOT NULL,
  `companycode` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `companyindustry` varchar(200) CHARACTER SET latin1 NOT NULL,
  `package` varchar(200) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `userid` int(250) DEFAULT NULL,
  `username` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyaddress` text CHARACTER SET latin1 NOT NULL,
  `companycity` varchar(30) CHARACTER SET latin1 NOT NULL,
  `companystate` varchar(50) CHARACTER SET latin1 NOT NULL,
  `companycountry` varchar(50) CHARACTER SET latin1 NOT NULL,
  `companypostalzipcode` varchar(50) CHARACTER SET latin1 NOT NULL,
  `companywebsite` varchar(50) CHARACTER SET latin1 NOT NULL,
  `companyemployeescount` varchar(50) CHARACTER SET latin1 NOT NULL,
  `paymentstatus` varchar(20) CHARACTER SET latin1 NOT NULL,
  `referralcode` varchar(50) CHARACTER SET latin1 NOT NULL,
  `referrercode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `verificationcode` varchar(50) CHARACTER SET latin1 NOT NULL,
  `verified` varchar(10) CHARACTER SET latin1 NOT NULL,
  `date` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companystructure`
--

CREATE TABLE `companystructure` (
  `id` int(250) NOT NULL,
  `companyid` int(250) NOT NULL,
  `userid` int(250) DEFAULT NULL,
  `username` varchar(300) DEFAULT NULL,
  `level` varchar(200) DEFAULT NULL,
  `parentlevel` varchar(300) DEFAULT NULL,
  `categoryid` int(250) DEFAULT NULL,
  `category` varchar(200) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(250) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `categoryid` int(250) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `subcategoryid` int(250) DEFAULT NULL,
  `subcategory` varchar(100) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `authorid` int(250) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(250) NOT NULL,
  `postid` int(250) DEFAULT NULL,
  `posttype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `categoryid` int(80) NOT NULL,
  `category` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `subcategoryid` int(50) NOT NULL,
  `subcategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `authorid` int(250) DEFAULT NULL,
  `author` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(250) NOT NULL,
  `companyid` int(250) NOT NULL,
  `userid` int(250) NOT NULL,
  `username` varchar(300) NOT NULL,
  `title` varchar(300) NOT NULL,
  `type` varchar(250) DEFAULT NULL,
  `level` varchar(500) DEFAULT NULL,
  `target` varchar(500) DEFAULT NULL,
  `targetdate` varchar(100) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `targetscore` int(250) DEFAULT NULL,
  `result` varchar(100) DEFAULT NULL,
  `score` int(250) DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `lastupdatedtime` varchar(50) DEFAULT NULL,
  `lastupdateddate` varchar(50) DEFAULT NULL,
  `time` varchar(200) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `safeurl` varchar(50) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newslettersubscriptions`
--

CREATE TABLE `newslettersubscriptions` (
  `id` int(250) NOT NULL,
  `name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(250) NOT NULL,
  `companyid` int(250) DEFAULT NULL,
  `userid` int(250) DEFAULT NULL,
  `username` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fromid` int(250) DEFAULT NULL,
  `from` int(250) DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `time` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(250) NOT NULL,
  `pagename` varchar(300) DEFAULT NULL,
  `pagecode` varchar(100) NOT NULL,
  `pagebanner` varchar(500) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `author` varchar(100) NOT NULL,
  `lastupdated` varchar(100) DEFAULT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `pagename`, `pagecode`, `pagebanner`, `content`, `author`, `lastupdated`, `date`) VALUES
(1, 'Home Page', 'home', NULL, NULL, '', NULL, '07-01-2020'),
(2, 'About Us Page', 'about', NULL, '<p><span><b>Company profile<br/></b></span><span>PhytoScience SdnBhd, is a global health &amp;wellness company stands at the forefront of product innovation and committed to helping people take control of<br/>their health, both physical and financial well-being. Founded in 2012 on little more than dreams and hard work, PhytoScience is now a multi-million dollar<br/>company, based in Kuala Lumpur. It was started based on the integrated and advanced e-commerce platform and vision to penetrate into global markets. In<br/>just a short span of 18 months after its inception, PhytoScience monthly sales have surged to USD 15 Million, making it one of the TOP MLM companies in<br/>Malaysia.</span></p><p><span>At PhytoScience, we are the TrendMaker. We’re in the Business of Life Transformation!</span></p><p><span>Transformation is a bold promise to make but we do so with full confidence. We believe that natural health and wellness have the power to transform lives and through our cutting edge products, our people, and our business opportunities, we work to make it a reality every day.</span></p><p><span>PhytoScience delivers the amazing transformation through its powerful quadripartite P-system.</span></p><p><span><br/></span></p><p><b><span></span></b></p><p><b><span>Products </span></b></p><p><span>Cutting edge,<br/>award-winning, scientifically proven &amp; clinically researched, supported by Mibelle Biochemistry Switzerland. (Learn more about <a href=\"https://www.mibellebiochemistry.com/\" target=\"_blank\">MibelleBiochemistry<br/>and PhytoCellTec™) </a>Our unique &amp; exclusive formulas are innovative, and the results are real.</span></p><p><b><span>Plan. </span></b></p><p><span>PhytoScience rewards all its distributors with one of the most lucrative and balanced financial reward plans in the industry. Our lucrative financial reward plans are built-in with plentiful incentives all-year-round to enable our valued distributors to enjoy the journey to their dream life.<br/><br/>›› Learn more about our </span><a href=\"https://www.iphyto.com/en/about-business-opportunity.php\"><span>Business Opportunity</span></a><span></span></p><p><b><span>Platform. </span></b></p><p><span>PhytoScience doesn’t settle for conventional network marketing strategies. We adopt and integrate the latest information technology with a cutting-edge on-line platform that distributors love.</span></p><p><b><span>People. </span></b></p><p><span>Network marketing is all about people – “People’s Business”. It’s about fulfilling people’s needs, dreams and aspirations. PhytoScience emphasizes strongly in<br/>building the well-being of its distributors, customers, partners and staff. PhytoScience holds the belief and philosophy of “Your success is our Success”<br/>and shares an emotional reward no other networking company can match. Products Platform People Plans The culture of PhytoScience spirals from the core values and solidarity of our Founders in connecting people on a heart-to-heart level. As a result, our worldwide family of distributors, customers, partners and staff experience rewarding relationships based on mutual respect, care, trust, and love.</span></p><p><b><span>OUR VISION</span></b></p><p><span>Become the world’s premier Health &amp; Wellness company enriching the lives of people who yearns to be wholesome </span><span>To be the top </span><span>notch renown MLM company in the world.</span></p><p><b><span>OUR MISSION</span></b></p><p><span>To empower the lives and well-being of our members, partners, customers, and staff with the highest quality, scientifically proven &amp; clinically researched products, innovative and best business opportunities.</span></p><p><b><span>OUR PROMISE</span></b></p><p><span>Always committed to uncompromising product quality</span></p><p><span>Continue to innovate and provide utmost rewarding opportunity</span></p><p><span>Constantly provide excellent value-for-money products and services</span></p><p><span>Committed to create a caring, inspiring &amp; a gratifying environment for our members, customers, partners and staff</span></p><p><span><br/></span></p><p><b>Business Opportunity</b> - ARE YOU READY TO LEAD THE LIFE OF YOUR DREAM?<br/></p><p><br/></p><p></p><p><span>Phyto Science makes it possible for you. Phyto Science provides you the opportunity to own your own business, secure your financial future with a proven marketing plan.</span></p><p><span>PhytoScience offers the once in a lifetime opportunity of living a healthier, wealthier life. PhytoScience exclusive health and beauty products, and proven business opportunity, are exactly what majoring of people are combing the world for – greater wellness and financial security. You make money simply by sharing this opportunity and dream with others.</span></p><p><span>JOIN US NOW and bring your passion for our simple, proven business opportunity, and you’ll find the wealth and freedom you’ve always wanted.</span></p><p><span><b>How Do I Start?</b></span></p><p><span>Starting your very own home-based business is easy. PhytoScience ensures your success every step of the way. If you don’t personally know a sponsor, we’ll match you up with someone near you to mentor you. There’s no membership or expensive investment. Just select the package you prefer. Training materials, successful financial plan and your commissions all will be provided. All you need to provide is your commitment to build your future and dream life.</span></p><p><span><b>What Do I Earn</b></span></p><p><span>11 Ways to Earn<br/>Unlimited * Income with PhytoScience Powerful &amp; proven Financial Rewards System</span></p>', 'agboola', '11-09-2020', ''),
(3, 'Services', 'services', NULL, '<p><span><b>OUR PRODUCT &amp; SERVICES</b></span></p><p><span>Crystal Cell - <b>CRYSTAL<br/>CELL – THE ORIGIN OF STEM CELLS</b></span></p><p><span>Phyto Science proudly presents a new revolutionary product birth from years of research.<br/>Tested vigorously for its potency and purity to produce a balanced formula. <b>Phytoene</b> &amp; <b>Phytofluene</b> extracted<br/>from tomatoes has the unique ability of blocking harmful free radicals from UV rays. As a result, your skin will be supple and radiant while your body’s<br/>health improves continuously.</span></p><p><b><span>BENEFITS</span></b></p><p><b><span>PROACTIVE UV PROTECTION</span></b></p><p><span>Imagine a <b>natural</b> sun block around your skin <b>protecting</b> you all day, free from any drugs or chemicals. Phytoene&amp;Phytofluene are<br/>carotenoids with the ability to block the UVA and UVB spectrums.</span></p><p><b><i><span>Leaving your skin radiant and youthful!</span></i></b></p><p><b><span>ANTI-INFLAMMATORY EFFECT</span></b></p><p><span>Live your life to the fullest, don’t let pain consume your life.<br/>Pytoene&amp;Phtofluene has unique properties that <b>speed up</b> wound <b>healing</b> and the restoration of acne scars. It also protects DNA strands in skin cells<br/>against further damage caused by harmful environmental agents</span></p><p><b><i><span>Living life active and healthy!</span></i></b></p><p><b><span>PROACTIVE UV PROTECTION</span></b></p><p><span>Finally, damaged cells can be <b>repaired</b> to form new cells. Thanks to the <b>anti-ageing</b> properties of<br/>Phytoene&amp;Phytofluene, your skin will be renewed after each use. Leave your friends wondering the secrets to your youth.</span></p><p><b><i><span>Youthfulness at your fingertips!</span></i></b></p><p><span>Double Stem Cell </span></p><p><b><span>CELLULAR REJUVENATION SECRET</span></b></p><p><span>Our cells lose control of its restoration ability as we age. Double Stemcell is a delicious blend of stem cells extracts found in the rare Swiss<br/>green <b>Apple</b> and Burgundy <b>Grapes</b>. It is exclusively formulated and enriched with phytonutrient-rich superstars to help you regain<br/>control and keep ageing at bay.</span></p><p><b><span>PROTECTS CELLULAR LONGEVITY</span></b></p><p><span>Who says you can’t remain <b>youthful</b>? Double Stem Cells <b>rejuvenates</b> your face, body and organs by protecting cellular <b>longevity</b>. The apple<br/>stem cell delays the ageing process naturally leaving your body feeling fresh and revitalized.</span></p><p><b><i><span>Shielding your youthfulness at the cellular level!</span></i></b></p><p><b><span>SUPERIOR UV PROTECTION</span></b></p><p><span>UV Radiation is responsible for 80% of skin ageing. Solar Vitis stem cells contain polyphenols known for <b>UV protection</b>. It differs from<br/>sunblock and filters as it protects your skin on the cellular level and restores the skin’s <b>regenerative capacity.</b></span></p><p><b><i><span>Protecting you all day long!</span></i></b></p><p><span></span></p><p><span>Snowphyllforte</span></p><p><b><span>OUR BLOOD THE RIVER OF LIFE</span></b></p><p><span>Our blood carries an important function of transporting oxygen and nutrients throughout our entire body. How do we ensure the longevity of our<br/>blood? The answer is Snowphyll™Forte which consists of <b>Snow Algae Chlorophyll </b>&amp; <b>Mulberry Leaf Extract </b>formulated by<br/>MibelleBioChemistry Switzerland to help <b>repair, rebuild and replenish</b> our blood</span></p><p><b><span>LIFE CHANGING BENEFITS</span></b></p><p><b><span>REBUILDS HAEMOGLOBIN &amp; RED BLOOD CELLS</span></b></p><p><span>Blood is the river of life &amp; energy. Snow Algae Chlorophyll resembles the blood structure and can help <b>rebuild</b> and replenish the<br/>blood in our body. It is rich in magnesium that gives an alkalizing cleansing effect to the body. Boost your body with <b>energy</b> and reduce<br/>fatigue.</span></p><p><b><i><span>Energy and vitality for healthy lifestyle!</span></i></b></p><p><b><span>DETOXIFY YOUR BODY</span></b></p><p><b><span>Flush</span></b><span> out the toxins in your body that causes chronic illnesses. Snow Algae reduces the binding of carcinogens from cooked<br/>red meat that damages the DNA and other organs especially the liver. <b>Cleanse</b> your body to function better.</span></p><p><b><i><span>Cleansing from within for the healthy you!</span></i></b></p><p><b><span>MANAGING BLOOD SUGAR &amp; WEIGHT LOSS</span></b></p><p><span>The combination of Snow Algae and Mulberry Leaf is known for its <b>caloric restriction</b> and reducing blood sugar spikes. It will suppress your<br/>craving for food and <b>prevents fat</b> from depositing in your body.</span></p><p><b><i><span>Goodbye diabetes and heart disease!</span></i></b></p><p><b><span>AID IN GASTROINTESTINAL PROBLEMS</span></b></p><p><span>Most major diseases start in the colon. Snow Algae contains chlorophylls that are known for <b>loosening</b> and <b>cleansing</b> the<br/>colon improving digestion &amp;assimilation. Prevent and treat gastrointestinal problems that causes chronic illnesses.</span></p><p><b><i><span>Live healthy, live easy!</span></i></b></p><p><b><span>BAD BREATH AWAY</span></b></p><p><span>Oral bacteria that resides in a person’s mouth causes bad breath.<br/>Snowphyll™Forte acts as a deodorizer that eliminates bad odor &amp; reduces stringent smell of urine, infected wounds and feces. No more stink but<br/>smelling <b>fresh</b> throughout the day.</span></p><p><b><i><span>Smelling fresh always!</span></i></b></p><p><b><span>FIGHTS INFECTIONS</span></b></p><p><span>Snowphyll™Forte is specially formulated with <b>antioxidants</b> &amp; <b>anti-inflammatory</b> compounds of Vitamin A, C &amp; E that helps reduce inflammation, kill harmful bacteria and germs.</span></p><p><b><i><span>Natural resistance against illnesses!</span></i></b></p><p><span><span> </span>Actual + </span></p><p><b><span>100% PURE INGREDIENTS BOOST YOUR NATURAL DEFENCES</span></b></p><p><i><span>Better safe than sorry</span></i></p><p><b><span>NOT A DRUG BUT WORKS MORE THAN A DRUG</span></b></p><p><span>Fruits, vegetables and spices are natural sources of antioxidants that possess the ability to boost immune system. When our immune system is strong<br/>enough, the bacteria or virus that enter our body can be directly destroyed, killed or neutralized. Therefore, we are able to heal ourselves if our body<br/>defence system works optimally.</span></p><p><span>Nowadays, the innovation in health supplement industry develops continuously, not only from the processing technology, but also from the<br/>variety of raw materials used. One of these innovations is herbal drops made from combination of natural ingredients, including fruits, vegetables and<br/>spices.</span></p><p><span>Actual + is processed with modern biotechnology to produce premium quality herbal drops that exert recovery or healing effect on different kinds<br/>of diseases. They are very beneficial for our body cell regeneration. Cell is the tiniest part of constituent of human body, where there are trillions of<br/>cells in the body. As a result, if the body is sick, means the cell is actually sick.</span></p><p><i><span>“So, are you still looking for medicine to get cured?”</span></i></p><p><span>H2O Moisturizer </span></p><p><b><span>AQUA WATER RESERVOIR HYDRATION</span></b></p><p><span>Water is a potent source of skin food to nourish cells and <b>hydrateskin</b> for a smooth complexion. Our innovative Triple StemCell H2O<br/>Moisturizer increases your skin stem cell vitality and regeneration.</span></p><p><span>This moisturizing gel acts like a water network providing instant freshness while liberating its stem cell ingredients keeping your skin <b>radiant<br/>and youthful</b>.</span></p><p><b><span>PERFECT BENEFITS</span></b></p><p><b><span>HIGH LEVEL MOISTURIZER</span></b></p><p><span>Triple Stemcell H2O Moisturizer hydrates your skin releasing stem cells into your skin. It soothes, hydrates, restores and nourishes your skin cells so<br/>that it remains <b>fresh</b> and <b>supple</b> throughout the day.</span></p><p><b><i><span>Moisturizing your skin all day long!</span></i></b></p><p><b><span>ANTI UV PROTECTION</span></b></p><p><span>The sun’s radiation causes our skin to dry. Triple Stemcell H2O Moisturizer <b>naturally protects</b> your skin against UV radiation<br/>and works as a defense against dehydration. Protecting your skin against further damages while leaving your skin <b>healthy</b>.</span></p><p><b><i><span>Natural hydration shield!</span></i></b></p><p><b><span>ANTI-FREE RADICAL &amp; ANTI AGEING</span></b></p><p><span>Free radicals damages your skin and causes ageing. Triple Stemcell H2O Moisturizer releases stem cells into the skin that <b>promotes<br/>regeneration</b> and repairs damaged skin. Bringing out your skin’s <b>radiance </b>after each use.</span></p><p><b><i><span>Youthfulness at your fingertips!</span></i></b></p><p><span></span></p><p><span>Miracle Intense Essence </span></p><p><b><span>YOUR AGELESS BEAUTY SECRET</span></b></p><p><span>Exclusively formulated with award winning active ingredients, Triple StemCell Miracle Intense Essence helps maintain perfect cellular balance.<br/>Formulated with three stem cells and DermCom, it is the elixir of youth with highly effective anti-ageing properties. Leave your friends wondering the<br/>secret to your youth!</span></p><p><b><span>BENEFITS</span></b></p><p><b><span>REVERSE AGEING PROCESS</span></b></p><p><span>Who says that you can’t look younger? Using a special ingredient DermCom based on a rare flower Crocus Chrystanthus, enables your cells to<br/>communicate <b>repair</b> and reverse the aging process. Due to its growth properties it is able to <b>rejuvenate</b> your skin after<br/>each use.</span></p><p><b><i><span>Leave people wondering the secret to your youth!</span></i></b></p><p><b><span>REFINES SKIN TEXTURE</span></b></p><p><span>Our skin loses its firmness and elasticity during ageing process. Triple Stem Cell Miracle Intense Essence can refine the texture of your skin,<br/>effectively removing visible wrinkles, spots and other skin defects. The results leaving your skin more <b>refined</b> and <b>beautiful</b>.</span></p><p><b><i><span>Protecting you all day long!</span></i></b></p><p><b><span>REINFORCED HYDRATION</span></b></p><p><span>Water is the key to cellular functions. Triple Stem Cell Miracle Intense Essence can help to <b>lock hydration</b> at cellular level to<br/>reinforce hydration. Keeping your cells active and healthy to <b>promote regeneration</b> of new cells.</span></p><p><b><i><span>Youthfulness at your fingertips!</span></i></b></p>', 'agboola', '11-09-2020', ''),
(4, 'Contact Page', 'contact', NULL, NULL, '', NULL, '07-01-2020'),
(5, 'Terms & Conditions Page', 'terms', NULL, 'Terms & Conditions \r\nGENERAL TERMS AND CONDITIONS \r\nBy using the WeBarn Foods website services and tools (the \"Site\"), you (\"you\" or the \"End User\") agree to the terms and conditions that we (\"WeBarn Products & Services Ltd\") have provided. If you do not agree with the outlined terms and conditions (the \"Terms of Use\" or \"Agreement\"), please refrain from using the Site. \r\nFor the purpose of these terms of use, wherever the context requires, ‘You’ shall mean any natural or legal person who has agreed to make use of the site. \r\nThe Site reserves the right, to change, modify, add, or remove portions of these Terms and Conditions of use at any time. \r\nPlease check these Terms and Conditions regularly for updates as changes will be made on the website with no notice provided. \r\nThese Terms & Conditions were most recently updated on February 3, 2020 and apply to sales to consumers. Subsequent changes would be stated with the clauses inclusive. \r\nYour continued use of the Site following the posting of changes to these Terms and Conditions of use constitutes your acceptance of those changes. \r\nIf you are a business then different Terms & Conditions will apply to you, please call our call centre on 08077018502. \r\n1 GENERAL \r\n1.1This Agreement sets forth the terms and conditions that apply to the use of this Site by the End User. By using this Site (other than to read this Agreement for the first time), End User agrees to comply with all of the terms and conditions hereof. The right to use this Site is personal to End-User and is not transferable to any other person or entity. \r\n1.2End User shall be responsible for protecting the confidentiality of End User\'s password(s), if any. End User acknowledges that, although the Internet is often a secure environment, sometimes there are interruptions in service or events that are beyond the control of WeBarn Products & Services Ltd, and WeBarn shall not be responsible for any data lost while transmitting information on the Internet. While it is WeBarn\'s objective to make the Site accessible 24 hours per day, 7 days per week, the Site may be unavailable from time to time for any reason including, without limitation, routine maintenance. You understand and acknowledge that due to circumstances both within and outside of the control of WeBarn Foods, access to the Site may be interrupted, suspended or terminated from time to time. WeBarn Foods shall have the right at any time to change or discontinue any aspect or feature of WeBarn Foods, including, but not limited to, content, hours of availability and equipment needed for access or use. Further, WeBarn Foods may discontinue disseminating any portion of information or category of information, may change or eliminate any transmission method and may change transmission speeds or other signal characteristics. \r\n2 USER SUBMISSIONS AND PRIVACY \r\n2.1 Anything that you submit to the Site and/or provide to us, including but not limited to, questions, reviews, comments, and suggestions (collectively, \"Submissions\") will become our sole and exclusive property and shall not be returned to you. \r\n2.2 In addition to the rights applicable to any Submission, when you post comments or reviews to the Site, you also grant us the right to use the name that you submit, in connection with such review, comment, or other content. \r\n2.3 You shall not use a false e-mail address, pretend to be someone other than you or otherwise mislead us or third parties as to the origin of any Submissions. We may, but shall not be obligated to, remove or edit any Submissions. \r\n2.4 We view protection of your privacy as a very important principle. We understand clearly that you and Your Personal Information are one of our most important assets. We store and process Your Information on computers that may be protected by physical as well as reasonable technological security measures and procedures. Our current Privacy Policy is available at https://webarnfoods.com/#!/policy. If you object to your Information being transferred or used in this way please do not use webarnfoods.com Website. \r\n3 ORDERING AND PRICING \r\n3.1 Once you have found the Goods you are looking for, you can buy them online by clicking the \'add to cart\' button for the selected Goods. You will then be directed to your ‘cart\'. Remember, you can remove Goods from your cart or stop the ordering process at any time. Please note that all prices are shown in Nigerian Naira (NGN) and are inclusive of VAT, unless stated otherwise. \r\nPlease note that there are cases when an order cannot be processed for various reasons. The Site reserves the right to refuse or cancel any order for any reason at any given time. You may be asked to provide additional verifications or information, including but not limited to phone number and address, before we accept the order. \r\n3.3 We are determined to provide the most accurate pricing information on the Site to our users; however, errors may still occur, such as cases when the price of an item is not displayed correctly on the website. If we discover an error in the price of goods you have ordered we will inform you as soon as possible and give you the option of reconfirming your order at the correct price or cancelling it. If we are unable to contact you we will treat the order as cancelled. If you cancel and you have already paid for the goods, you will receive a full refund. As such, we reserve the right to refuse or cancel any order. \r\n4 PURCHASE CONTRACT \r\n4.1 This website is operated by WeBarn Products & Services Ltd (\"we\", \"us\" or \"our\"). By using the webarnfoods.com website you are bound by these Terms & Conditions. All use and purchases made on this website are governed by these Terms & Conditions at any time although the Terms & Conditions governing any given use or purchase will be those in effect at the date of your order or specific use. If you use or order goods after we have published any changes you will be bound by those changes. Accordingly, you should check prior to each use or order to ensure that you understand the precise Terms & Conditions applicable to your site visit or purchase. To assist you in determining whether the Terms & Conditions have changed since your most recent order we will display the date when these Terms & Conditions were most recently updated. \r\n4.2 Webarnfoods.com sell goods only to end-users. \r\n4.3 We will confirm your order whether placed directly by using the webarnfoods.com website, the email, customer care line, Whatsapp line, Social Media platforms,live chat and any other medium that may be introduced by WeBarn Products & Services Ltd. This will occur either by telephone calls or messages via these mediums. \r\n4.4 Confirmation constitutes our acceptance of your order but order is completed when payment is received. \r\n4.5 To participate in our services, the customer must either complete the registration process or check out as a guest. As a guest, customer must provide relevant information such as full name, phone number and delivery address.  \r\n5 AMENDMENT OF ORDERS AND CANCELLATION RIGHTS \r\n5.1 Any orders placed may be amended or cancelled by the customer at no charge before or during confirmation but not after confirmation. \r\n5.2 Please note, for cancellation to be effective, an email should be sent to info@webarnfoods.com or a call placed to any other customer care line stated on the website.\r\n6 METHODS OF PAYMENT \r\n6.1 Payment may be made on the website, by Cash, POS and bank transfer. In the case of bank transfers, a proof of payment MUST be sent to info@webarnfoods.com before order is dispatched. \r\n6.2 We only accept Nigerian Naira as payment currency. \r\n7 DELIVERY \r\n7.1 Delivery days and times are Mondays - Saturdays 9am-6pm. Delivery will be made to the address specified by you when you register or placed your order. You have the ability to change this address through the \"Account & Profile Details\" feature on the website, and you must do so if you move locations so that we can deliver to the correct address. (Say something about public holidays) On recognized public holidays, delivery times are subject to change. \r\n7.2 We reserve the right to restrict deliveries in certain areas, and this includes the right to eliminate certain areas from our delivery schedule altogether. \r\n7.3 We cannot deliver to any location that is not contained on our Dispatch List. \r\n7.4 WeBarn Products & Services Ltd will be responsible for the delivery of the Goods you have ordered to your address. Until the time that the Goods are delivered to you, the Goods shall remain the property of WeBarn Foods (WeBarn products & Services Ltd) and title (together with risk of loss and damage) will not pass to you until the goods are delivered to the address provided that we have processed and received payment in full for the Goods. \r\n7.5 We take special care to endeavour that deliveries are made within a short delivery slot and accordingly, it is your responsibility to ensure that an appropriate person is available at the delivery address at all times during the delivery slot. We may ask that an appropriate person signs for the goods on delivery. If no one is at the address when the delivery is attempted the goods will be retained by us. We will leave notification of delivery and will telephone to attempt to rearrange the delivery with a delivery cost. \r\n7.6 Please note adverse weather conditions or other events outside of our reasonable control may result in the occasional late or cancelled delivery. If that is the case we will endeavour to contact you as soon as we are able to in order to reschedule your delivery time and date. In any event that the order doesn\'t get to you in time, for food orders our liability to you will be limited to the price of food and the cost of delivery.\r\n7.7 Should you fail to be present for your delivery and you want it delivered to another location, we would oblige you to communicate this to our dispatch team in time to enable them supply other customers on time.. \r\n7.8 WeBarnfoods.com will ordinarily only make deliveries when an appropriate person is able to receive the delivery. \r\n8 DEFECTIVE GOODS AND DISSATISFACTION \r\n8.1 We guarantee the quality of our goods. You must inspect the goods and notify our dispatch team or person if your delivered order is rejected at delivery point as we would not collect any delivered goods after the dispatch person has left the delivery address or premises. We would however replace any rejected order at the point of delivery.\r\n8.2 In the event that the Goods collected by you are damaged, defective, faulty or do not match their description at the point of collection, you would be sent a  refunded. \r\n9 CUSTOMER COMPLAINTS \r\n9.1 Any Customer complaints should be addressed to the WeBarn foods Customer Care Line or any other customer care contact medium stated on the website. An email should be sent to info@webarnfoods.com\r\n11 SPECIAL OFFERS PROMOTIONS AND COMPETITIONS \r\n11.1 From time to time, and in our complete discretion, purchases of goods may be subject to special offers. In the event that such a special offer applies to your purchase, the terms of such special offer shall be subject to these Terms & Conditions. If there is any conflict between the terms of a special offer and these Terms & Conditions, these Terms & Conditions shall prevail unless specifically excluded. \r\n11.2 We may change the terms of special offers, or withdraw them altogether, at any time and without prior notice. We will honour at the offer price any order placed by you before an offer ends, or is amended or withdrawn. \r\n11.3 We reserve the right to offer in our complete discretion different customers different special offers, promotions and the ability to enter different competitions. \r\n12 CANCELLATION OF DELIVERIES AND SUSPENSION OF YOUR ACCOUNT \r\n12.1 We reserve the right to cancel your delivery at any time if we suspect fraud, have reason to believe you are in breach of these Terms and Conditions or any other terms and conditions relating to your order, or if there is an outstanding payment for any account registered at your address. \r\n12.2 In addition to our right to cancel your order, we reserve the right to suspend your account. Your account will remain suspended until you contact our call centre and remedy any breaches which are capable of remedy, or provide any information reasonably requested by our call centre advisers to enable them to reactivate your account. \r\n13.3 In the rare event that unforeseen operational or technical issues occur, we may need to cancel or rearrange delivery. If this happens we will endeavour to contact you to arrange an alternative delivery date. \r\n14 COPYRIGHT AND TRADEMARKS \r\n14.1 All intellectual property rights, whether registered or unregistered, in the Site, information content on the Site and all the website design, including, but not limited to, text, graphics, software, photos, video, music, sound, and their selection and arrangement, and all software compilations, underlying source code and software shall remain our property. \r\n14.2 The entire contents of the Site also are protected by copyright as a collective work under Nigeria copyright laws and international conventions. All rights are reserved. \r\n15 APPLICABLE LAW AND JURISDICTION \r\n15.1 These Terms and Conditions shall be interpreted and governed by the laws in force in the Federal Republic of Nigeria. The place of jurisdiction shall be Lagos State, Nigeria. \r\n15.2 Unless otherwise specified, the material on webarnfoods.com is presented solely for the purpose of sale in Nigeria unless otherwise stated. webarnfoods.com makes no representation that materials on the site are appropriate or available for use in other locations/Countries other than Nigeria unless otherwise stated. Those who choose to access this site from other locations/Countries other than Nigeria do so on their own initiative and WeBarn is not responsible for supply of goods/refund for the goods ordered from other locations/Countries other than Nigeria, compliance with local laws, if and to the extent local laws are applicable. \r\n16 TERMINATION \r\n16.1 In addition to any other legal or equitable remedies, we may, without prior notice to you, immediately terminate the Terms and Conditions or revoke any or all of your rights granted under the Terms and Conditions. \r\n16.2 Upon any termination of this Agreement, you shall immediately cease all access to and use of the Site and we shall, in addition to any other legal or equitable remedies, immediately revoke all password(s) and account identification issued to you and deny your access to and use of this Site in whole or in part. \r\n16.3 Any termination of this agreement shall not affect the respective rights and obligations (including without limitation, payment obligations) of the parties arising before the date of termination. You furthermore agree that the Site shall not be liable to you or to any other person as a result of any such suspension or termination. \r\n16.4 If you are dissatisfied with the Site or with any terms, conditions, rules, policies, guidelines, or practices of WeBarn Foods in operating the Site, your sole and exclusive remedy is to discontinue using the Site. \r\n17 PRODUCT DESCRIPTION \r\n17.1 WeBarnfoods.com tries to be as accurate as possible. However, webarnfoods.com does not warrant that product description or other content of this site is accurate, complete, reliable, current, or error-free. If a product offered by webarn.com itself is not as described, your sole remedy is to return it in unused to our dispatch person before leaving your location. \r\n18 LIMITATION OF LIABILITY \r\n18.1 IN NO EVENT SHALL WeBarnfoods.com BE LIABLE FOR ANY SPECIAL, INCIDENTAL, INDIRECT OR CONSEQUENTIAL DAMAGES OF ANY KIND IN CONNECTION WITH THIS AGREEMENT, EVEN IF WeBarnfoods.com HAS BEEN INFORMED IN ADVANCE OF THE POSSIBILITY OF SUCH DAMAGES. \r\n18.2 Our liability for losses you suffer as a result of us breaking this agreement is strictly limited to the purchase price of the Goods you purchased. \r\n19 INDEMNITY \r\n19.1 You shall indemnify and hold harmless WeBarn Products & Services Ltd, its owner\'s, licensee, affiliates, subsidiaries, group companies (as applicable) and their respective officers, directors, agents, and employees, from any claim or demand, or actions including reasonable attorneys\' fees, made by any third party or penalty imposed due to or arising out of your breach of this Terms of Use, privacy Policy and other Policies, or your violation of any law, rules or regulations or the rights of a third party.', 'agboola', '03-02-2020', '07-01-2020'),
(6, 'Privacy Policy', 'policy', NULL, 'We understand that by choosing WeBarn Foods to deliver your both your farm fresh and processed food items, you’ve placed a great deal of trust in us. We also understand that you want the personal information you give us to be kept private as well as secure. To reassure you that we feel the same way, here’s how we will and will not use the personal information you give us. \r\nNote: Our privacy policy is subject to change at any time without notice. To make sure you are aware of any changes, please review this policy periodically. \r\n1. Collection of Personally Identifiable Information\r\nWe collect personally identifiable information (email address, name, phone number, etc.) from you when you set up an account with webarnfoods.com. We may use this information to send you suggestions about promotions and offers based on your interest. \r\n2. Use of Demographic and Profile Data\r\nWe use personal information to provide the services you request. You can opt out of marketing and other promotional material we send to you. We use your personal information to resolve disputes; troubleshoot problems; help promote a safe service; collect fees owed; measure consumer interest in our products and services, inform you about online and offline offers, products, services, and updates; customize your experience; detect and protect us against error, fraud and other criminal activity; enforce our terms and conditions; and as otherwise described to you at the time of collection. In our efforts to continually improve our product and service offerings, we collect and analyze demographic and profile data about our users\' activity on our website. We identify and use your IP address to help diagnose problems with our server, and to administer our website. Your IP address is also used to help identify you and to gather broad demographic information. We will occasionally ask you to complete optional online surveys. These surveys may ask you for contact information and demographic information (like location, local government area, age, or income level). We use this data to tailor your experience at our site, providing you with content that we think you might be interested in--and to display content according to your preferences. \r\nCookies\r\nA \"cookie\" is a small piece of information stored by a Web server on a Web browser so it can be later read back from that browser. Cookies are useful for enabling the browser to remember information specific to a given user. WeBarnfoods.com places both permanent and temporary cookies in your computer\'s hard drive. WeBarnfoods.com\'s cookies do not contain any of your personally identifiable information. \r\n3. Sharing of personal information\r\nWe may share personal information with our other corporate entities and affiliates to: help detect and prevent identity theft, fraud and other potentially illegal acts; correlate related or multiple accounts to prevent abuse of our services; and to facilitate joint or co-branded services that you request where such services are provided by more than one corporate entity. Those entities and affiliates may not market to you as a result of such sharing unless you explicitly opt-in. \r\nWe may disclose personal information if required to do so by law or in the good faith belief that such disclosure is reasonably necessary to respond to subpoenas, court orders, or other legal process. We may disclose personal information to law enforcement offices, third party rights owners, or others in the good faith belief that such disclosure is reasonably necessary to: enforce our Terms or Privacy Policy; respond to claims that an advertisement, posting or other content violates the rights of a third party; or protect the rights, property or personal safety of our users or the general public. \r\nWeBarnfoods.com and its affiliates will share some or all of your personal information with another business entity should we (or our assets) plan to merge with, or be acquired by that business entity. Should such a transaction occur, that other business entity (or the new combined entity) will be required to follow this privacy policy with respect to your personal information. \r\n4. Links to Other Sites\r\nOur site links to other websites that may collect personally identifiable information about you. WeBarnfoods.com is not responsible for the privacy practices or the content of those linked websites. \r\n5. Security Precautions\r\nOur site has stringent security measures in place to protect the loss, misuse, and alteration of the information under our control. Whenever you change or access your account information, we offer the use of a secure server. Once your information is in our possession we adhere to strict security guidelines, protecting it against unauthorized access. \r\n6. Choice/Opt-Out\r\nWeBarnfoods.com provides all users with the opportunity to opt-out of receiving non-essential (promotional, marketing-related) communications from us on behalf of our partners, and from us in general, after setting up an account. If you want to remove your contact information from all WeBarnfoods.com lists and newsletters, please click on the unsubscribe button in our mails. \r\n7. Advertisements on WeBarnfoods.com\r\nWe use third-party advertising companies to serve ads when you visit our website. These companies may use information (not including your name, address, email address, or telephone number) about your visits to this and other websites in order to provide advertisements about goods and services of interest to you. \r\n8. Questions?\r\nQuestions regarding this statement should be directed to the following address: info@webarnfoods.com', 'agboola', '04-02-2020', '07-01-2020'),
(7, 'Career', 'career', NULL, 'WeBarn is always looking for people that will improve her efficiency and if you are confident to be the person, send an email to career@webarnfoods.com and we will definitely contact you.', 'agboola', '30-01-2020', '07-01-2020'),
(8, 'Gallery', 'gallery', NULL, NULL, '', NULL, '07-01-2020');
INSERT INTO `pages` (`id`, `pagename`, `pagecode`, `pagebanner`, `content`, `author`, `lastupdated`, `date`) VALUES
(9, 'Frequently Asked Questions', 'faq', NULL, '<p><span><b>1. Why do my feces appear greenish after consuming Snow Algae Chlorophyll?</b></span></p><p><span>Before total cleansing takes place, the body fails to absorb all the goodness of chlorophyll<br/>and the excess gets discharged. Once toxins are cleared, absorption will then<br/>improve and feces will no longer appear green. This means your body is ready to<br/>take in all the nutrients in Snow Algae chlorophyll.</span></p><p><span><b>2. Can Snow Algae Chlorophyll be used as an antiseptic?</b></span></p><p><span>Yes. With the cleansing power it has, Snow Algae Chlorophyll is effective in removing bad<br/>breath and body odor. Daily intake one sachet of Snow Algae Chlorophyll will<br/>ensure total body cleansing from the internal organs to the skin.</span></p><p><span><b>3. Why do some people encounter discomforts like dry throat, headache, feverish and thirst after drinking concentrated chlorophyll?</b></span></p><p><span>These are positive reactions after drinking chlorophyll, a result of the cleansing<br/>function. After this, you will feel high-spirited and energetic. To speed up<br/>this cleansing effect, you may want to drink plenty of water or begin with<br/>lower dosage, then gradually increase intake as your body slowly adapts to the<br/>changes.</span></p><p><span><b>4. Can I take Snow Algae Chlorophyll while I am taking my doctor\'s prescribed medicines?</b></span></p><p><span>Yes you can take Snow Algae Chlorophyll. It will help the liver to detoxify the side<br/>effects of medicine.</span></p><p><span><b>5. Can I take Snow Algae Chlorophyll during fasting? (Not applicable during Muslim fasting period)?</b></span></p><p><span>Yes, will help cleanse and detoxify your body while supplying it with the nutrients it needs<br/>to survive. It is safe and soothing.</span></p><p><span><b>6. With improved health conditions after taking Snow Algae Chlorophyll, can I discontinue its consumption?</b></span></p><p><span>Yes, you can. Nonetheless, it is recommended that you continue with Snow Algae chlorophyll intake daily to ensure continuous supply of essential nutrients for good health</span></p><p><span><b>What is Phyto Science Double Stemcell™ ?</b></span></p><p><span>Phyto Science<br/>Double Stemcell™ is plants stem cells combination by using Swiss Plant<br/>Stem Cell Technology - PhytoCellTec™ MalusDomestica (Apple Stem Cell) and<br/>PhytoCellTec™ Solar Vitis(Grape Stem Cell)enriched with acai berry and blue<br/>berry to nourish your skin from within,provide you with a significant result.</span></p><p><span><b>Advantages of PhytoCellTec™ Technology?</b></span></p><p><span>This innovative technology developed by Mibelle Biochemistry offers the following advantages:</span></p><p><span>PhytoCellTec™ MalusDomestica (Apple Stem Cell)</span></p><p><span>A rare Swiss apple is being hailed in the cosmetic and fashion world as an exciting<br/>anti-ageing breakthrough - even Michelle Obama is rumoured to be a fan. Stem<br/>cells from the UttwilerSpätlauber apple are said to protect skin cell<br/>regeneration and so delay the onset of wrinkles. The discovery was made by a<br/>Swiss company.<br/><br/>The November edition of the United States Vogue magazine went as far as to call<br/>the variety &#34;the super-apple&#34;, and asked if the tree could be<br/>&#34;the new fountain of youth&#34;.<br/><br/>The UttwilerSpätlauber, which was first recorded in the 18th century, comes<br/>from canton Thurgau, in northern Switzerland.<br/><br/>It is well known for its excellent storability; it can stay fresh looking for<br/>up to four months after being harvested, long after other varieties have become<br/>wrinkled.</span></p><p><span>PhytoCellTec™ Solar VitisPhytoCellTec™</span></p><p><span>Solar Vitis is based on stem cells from the GamayTeinturierFréaux grape - a grape from<br/>Burgundy, which is characterised by an extremely high content of polyphenols<br/>for UV protection.</span></p><p><span>Extensive studies have shown that PhytoCellTec™ Solar Vitis reliably protects epidermal<br/>stem cells from UV stress and thus from skin aging caused by light.<br/>PhytoCellTec™ Solar Vitis increases the vitality and efficiency of all<br/>essential skin cells and improves the skin\'s resistance.</span></p><p><span>The use of plant stem cells protects the most important skin cells, namely its stem cells,<br/>thus delaying skin aging. PhytoCellTec™ Solar Vitis protects the skin from<br/>chronological and light-induced aging, extending skin cells\' vitality and<br/>keeping the skin\'s appearance young and beautiful longer.</span></p><p><span>Acai Berry</span></p><p><span>Touted as the &#34; Beauty Berry&#34; from the Amazon, Acai is packed with so many<br/>compounds that make the body feel and look amazing from the inside out. It is<br/>bursting with anthocyanins and flavonoids, and provides more antioxidants than<br/>most berries. It has 5 times the antioxidants of gingko and 33 times the<br/>antioxidants of red wine. But it\'s not just about antioxidants - this tiny<br/>berry is also loaded with omega fatty acids, amino acids, naturally occurring<br/>minerals as well as Vitamin A, B1 and E.<br/><br/>From a health standpoint, the advantages of the Acai are astounding:</span></p><p><span>Blueberry</span></p><p><span>Blueberry is a wonderful fruit full of vitamins, minerals and antioxidants. Its health<br/>benefits are amazingly beneficial in reducing fats, chomping down on free<br/>radicals, combating negative metabolic issues, promoting improved insulin<br/>levels, supporting ocular health and warding off diseases and cancers.</span></p><p><span>Blueberries are high in Vitamin C, which promotes a healthy immune system. Blueberries also<br/>contain Vitamin A, Iron, Calcium, Manganese, Vitamin K, Vitamin E, Zinc,<br/>Phosphorus and Selenium. Manganese helps convert carbs, proteins and fats into<br/>energy. Plus, the wonderful blend of nutrients in blueberries will keep your<br/>vision and retina healthy too! Blueberries contain high levels of antioxidants<br/>and fiber. This dynamic duo promotes our ability to dissolve our bad cholesterol.<br/>Plus, blueberries battle against metabolic issues which can in-turn promote<br/>heart disease.</span></p><p><span>Blueberries contain flavonoids. Flavonoids have been shown to improve memory and cognitive<br/>functions such as; the ability to reason, make decisions, and maintain general<br/>comprehension and retention. In addition, the regular consumption of flavonoids<br/>may help slow down the mental decline in the aging.</span></p><p><span>The flavonoids in blueberries have been shown to provide protection against disorders such as<br/>Alzheimer\'s and Parkinson\'s. Plus, flavonoids have also been found to assist in<br/>slowing down the decline of mental cognition in the aging.</span></p><p><span><b>Product Features</b></span></p><p><b><span>Benefits of product:</span></b><span></span></p><p><span>About Mibelle Biochemistry, Switzerland</span></p><p><span>Who is Mibelle Biochemistry?</span></p><p><span>Mibelle Biochemistry, a Swiss biochemistry group, which has extracted plant stem cells<br/>from an endangered Swiss apple variety ( UttwilerSpätlauber Apple) and has<br/>incorporated them into cosmetic products to ensure the longevity of skin cells.<br/></span></p><p><span></span></p><p><span><b>What does PhytoCellTec™ mean?</b></span></p><p><span>Plant cell technology</span></p><p><span></span></p><p><span><b>What is PhytoCellTec™ Technology?</b></span></p><p><span>Mibelle Biochemistry\'s motto - &#34;inspired by nature - realized by science&#34; -<br/>is the guiding principle behind its new approach to combining nature and<br/>science through a technique to extract raw materials from plants.</span></p><p><span></span></p><p><span><b>Who first discovered that plant stem cells could be used to revitalize skin stem cells?</b></span></p><p><span>Mibelle Biochemistry scientists, led by Dr<span> </span>FredZülli</span></p><p><span></span></p><p><span><b>Where do the stem cells in PhytoCellTec™ MalusDomestica come from?</b></span></p><p><span>The active ingredient was first extracted from only 2 to 3 UttwilerSpätlauber apples. All<br/>the plant stem cells for PhytoCellTec™ MalusDomestica continue to be cultivated<br/>from these original cells.</span></p><p><span></span></p><p><span><b>How do stem cells work?</b></span></p><p><span>Stem cells are special, very valuable cells that are present in small numbers in almost every<br/>tissue, including the skin. Only stem cells can divide over the course of a<br/>person\'s life and create new skin cells, continuously renewing the epidermis.<br/>As we age, the vitality and number of skin stem cells decreases, the epidermis<br/>takes longer to renew itself and wrinkles form.</span></p><p><span></span></p><p><span><b>What is the difference between embryonic and adult stem cells?</b></span></p><p><span>Embryonic stem cells are pluripotent cells derived from the inner cell mass of an early-stage<br/>embryo. They have the potential to develop into any type of cell in the body.<br/>Adult stem cells are responsible for supplying the necessary replacement cells<br/>in adults. They have been identified in over 20 organs and tissues. Unlike<br/>embryonic stem cells, adult stem cells can only generate cells of the organ in<br/>which they are found. They are therefore referred to as multipotent.</span></p><p><span></span></p><p><span><b>What makes PhytoCellTec™ active ingredients so innovative?</b></span></p><p><span>They have made it possible to promote the vitality of skin stem cells for the first time.<br/>Extracts obtained from plant stem cells using state-of-the-art technology have<br/>specific stem cell factors, which help skin stem cells retain their properties.<br/>PhytoCellTec™ active ingredients have been shown to have a positive effect on<br/>cultures of epidermal stem cells.</span></p><p><span></span></p><p><span><b>What makes active ingredients from plant stem cells better than traditional plant extracts?</b></span></p><p><span>PhytoCellTec™ active ingredients are extracted from pure plant stem cell cultures. Stem cells<br/>(plant and human) have specific epigenetic factors and only these components<br/>give cells the ability to act as stem cells. In traditional plant extracts<br/>these factors are present only to a very limited extent.</span></p><p><span></span></p><p><span><b>Plant versus animal cells?</b></span></p><p><span>In PhytoCellTec™ active ingredients the entire stem cell is used. Using plant stem<br/>cells poses no safety or other concerns for humans. The plant stem cells are<br/>cultivated in sterile conditions so no diseases can be transmitted and no<br/>genetically modified material is used. It is animal stem cells, rather, that<br/>pose a risk of transmitting diseases.</span></p><p><span></span></p><p><span><b>Have PhytoCellTec™ active ingredients been tested on animals?</b></span></p><p><span>Mibelle Biochemistry has never tested PhytoCellTec™ active ingredients on animals<br/>either during development or for proof of activity. The active ingredients were<br/>tested only on cell cultures and, in the form of finished products, on test<br/>subjects. These highly specific tests were conducted in cooperation with<br/>renowned dermatological test institutes.</span></p><p><span></span></p><p><span><b>How was the effect of the stem cells tested and what tests were conducted?</b></span></p><p><span>The effect of PhytoCellTec™ active ingredients was tested on cultures of human epidermal stem<br/>cells. The tests showed that the active ingredients can maintain the stem<br/>cells\' colony-forming efficiency longer even if the cells were stressed through<br/>exposure to UV light. Tests on the 3D epidermis model showed that even aged<br/>skin stem cells can form a complete epidermis when PhytoCellTec™ MalusDomestica<br/>is applied. In other words, aged stem cells treated with PhytoCellTec™<br/>MalusDomestica display similar activity to young stem cells. These positive<br/>effects were also confirmed in tests on test subjects. </span></p><p><span></span></p><p><span><b>What are the visible effects on the skin following application?</b></span></p><p><span>See the test results following application on the skin; active ingredients PhytoCellTec™ MalusDomestica and PhytoCellTec™ Alp Rose.</span></p><p><span></span></p><p><span><b>Is there an ideal age? Beginning at what age can the products be used?</b></span></p><p><span>As PhytoCellTec™ active ingredients have a very good, protective effect that prevents aging of the skin, they are recommended for younger and mature skin.</span></p><p><span></span></p><p><span><b>Is production of PhytoCellTec™ active ingredients sustainable?</b></span></p><p><span>Often, rare and nearly-extinct plants that are classified as endangered species and thus<br/>protected contain especially valuable ingredients but may not be used in cosmetics.<br/>Thanks to the innovative PhytoCellTec™ technology, it is now possible to use<br/>even these plants for cosmetics. Only a very small amount of plant material is<br/>needed to produce sufficient, high-quality active ingredients, thus<br/>PhytoCellTec™ is a very sustainable technology.</span></p><p><span></span></p><p><span><b>Why are plant stem cells the latest trend in cosmetics research?</b></span></p><p><span>Cosmetics research is always looking for new active ingredients as the skin\'s vitality<br/>and its ability to regenerate are key factors for a smooth, firm and youthful<br/>appearance. And plant stem cells have enormous potential to preserve the<br/>vitality and youthfulness of human skin as long as possible (examples:<br/>UttwilerSpätlauber apple and the Burgundy grape GamayTeinturierFréaux).</span></p><p><span></span></p><p><span><b>To what extent can the new PhytoCellTec™ active ingredients be called natural?</b></span></p><p><span>All of our PhytoCellTec™ active ingredients are based on plant stem cells and are 100%<br/>natural. Moreover, the raw material production process is very sustainable and<br/>preserves resources. We only need a small sample of a plant, such as a few<br/>berries, to extract plant stem cells. The entire production is then based on<br/>these stem cells. These active ingredients are compatible with our customers\'<br/>concerns about the environment, which also makes them attractive to companies<br/>that value natural raw materials.</span></p><p><span></span></p><p><span><b>What celebrities use the Mibelle active ingredient from apple stem cells?</b></span></p><p><span>Michelle Obama, Gwyneth Paltrow, Jennifer Lopez and Helen Mirren use products with our PhytoCellTec™ active ingredients.</span></p><p><b><span>DOUBLE STEMCELL™</span></b></p><p><span><b>Can I purchase Double Stemcell™ at a pharmacy in my area?</b></span></p><p><span>Our products may be purchased by on line on our website (www.phytoworld.com.ng) or send a whatsapp message to the numbers above.</span></p><p><span><b>Can Double Stemcell™ be used on Children?</b></span></p><p><span>Yes, can be used on children, under adult supervision.  This product is safe and Non-Toxic.</span></p><p><span><b>Is it safe to consume Double Stemcell™?</b></span></p><p><span>Double Stemcell™ has registered with Health Ministry Malaysia(KKM) and it has went<br/>through Standards and Industrial Research Institute of Malaysia (SIRIM) and SGS<br/>Singapore General Laboratory Testing Standard. This product is confirmed safe<br/>and 100% plant base.</span></p><p><span><b>Can Double Stemcell™ healing any of chronic illness as what the consumer had claim in<br/>their testimonial?</b></span></p><p><span>According to the professional advice from a group of doctors, Double Stemcell™ is actually<br/>when we consume and pour under the tongue, stem cell will go thru our nerves<br/>travel to the brain and provide a signal where they need to repair and<br/>regeneration the cells surround the wound and the illness part, regulate pH<br/>level inside the body, when after the body immunity system improved slowly<br/>the illness will get healing.</span></p><p><span><b>The product is effective but a lot of consumers wish to take consistently and FOC?</b></span></p><p><span>For those consumers keen to consume Double Stemcell™, they can actually sign up as member<br/>to enjoy member price and with the marketing proposal provided, they can even<br/>earn for free redeem and get some extra income.</span></p><p><span><b>What dosage should I take to obtain the best results?</b></span></p><p><span>While as each person may be different of  their own absorption ability so results may be<br/>accordingly, through our trials with our customers , we have developed the<br/>products that can be taken both on a daily basis 2 sachets day and night or the<br/>high strength that should be cycled over shorter periods when a stronger effect<br/>is required. Double stemcell™ should <a></a>always be taken<br/>before breakfast and before bed at night.</span></p><p><span><b>Does Double stemcell™ have any side effects?</b></span></p><p><span>Our products, taken at their recommended dosage are very well tolerated. However, one may<br/>experience a slight sense of increased metabolic body heat (thermogenesis)<br/>after taking Double stemcell™ and it is recommended to increase water intake.<br/>In my experience each individual reacts slightly differently, so the product<br/>dosage that works for you may be different for another. High dosages may give<br/>more dramatic effects within a shorter time frame of about 1-2 days, while<br/>lower dosages may take 1 week or more to notice the effect.</span></p><p><span><b>Can Double stemcell™ be taken by aged and diseased people?</b></span></p><p><span>Yes, we have observed that it is quite common that aged and diseased people in Developed<br/>Countries prepare stemcell when they require energy in times of convalescence.<br/>Scientific research on aged and diseased consuming Double stemcell™ is now<br/>being conducted  and the results have been encouraging, such as enhanced<br/>antibody and energy. Double stemcell™ is also suitable in menopausal women as<br/>it helps maintain progesterone production from the ovaries and adrenal glands.<br/>The ability of Double stemcell™ to enhance stamina in both men and women is<br/>always within physiological normal limits and thus it is increasingly being<br/>seen as a safe and natural performance supplement for sportspeople. The latest<br/>information is that sports scientists have found Double stemcell™ a benefit in<br/>their athletes as the increase in stamina is within natural limits and<br/>therefore completely legal in competition.</span></p><p><span><b>Who need Double stemcell™?</b></span></p><p><span>People who are health conscious,weak and diseased, love their family,who wish to enjoy their<br/>life perfectly  and always busy with a lot of engagements, they are the<br/>group of people which need to consume Double stemcell persistently.</span></p><p><span><b>Can Double stemcell™ be taken by diabetes patient?</b></span></p><p><span>According to number of panel doctors who also playing apart as our member in network, Double<br/>stemcell™ is not a drug, it can\'t replace the medicine gave by your doctor who<br/>you consult now. But we have number of diabetes consumers who after consumed<br/>Double stemcell their blood sugar level reducing, some even claimed drop to<br/>normal. They said this may cause of the possibility the antioxidants of the<br/>product.</span></p><p><span><b>Which is the best method of consume Double stemcell™ for more effectiveness?</b></span></p><p><span>Nevertheless Double stemcell ™can be mixed up with any drink or even pure water, but the<br/>best method is pour under our tongue, that is because below tongue there are a<br/>lot of nerves that can easily absorb due to the molecules is small.</span></p><p><span><b>What is Phyto Science Triple Stemcell™?</b></span></p><p><span>Phyto Science Triple Stemcell™ is plants stem cells combination by using Swiss Plant Stem<br/>Cell Technology - PhytoCellTec™ MalusDomestica (Apple Stem Cell), PhytoCellTec™<br/>Solar Vitis(Grape Stem Cell) AND PhytoCellTec™ Argan enriched with Derm Com to<br/>nourish your skin to be firm and provide with a significant result.</span></p><p><span><b>Advantages of PhytoCellTec™ Technology</b></span></p><p><span>This innovative technology developed by Mibelle Biochemistry offers the following<br/>advantages:</span></p><p><span>PhytoCellTec™ MalusDomestica (Apple Stem Cell)</span></p><p><span>A rare Swiss apple is being hailed in the cosmetic and fashion world as an exciting<br/>anti-ageing breakthrough - even Michelle Obama is rumoured to be a fan. Stem<br/>cells from the UttwilerSpätlauber apple are said to protect skin cell regeneration<br/>and so delay the onset of wrinkles. The discovery was made by a Swiss company.<br/><br/><br/><br/>The November edition of the United States Vogue magazine went as far as to call<br/>the variety &#34;the super-apple&#34;, and asked if the tree could be<br/>&#34;the new fountain of youth&#34;. The UttwilerSpätlauber, which was first<br/>recorded in the 18th century, comes from canton Thurgau, in northern<br/>Switzerland.<br/><br/><br/><br/>It is well known for its excellent storability; it can stay fresh looking for<br/>up to four months after being harvested, long after other varieties have become<br/>wrinkled.</span></p><p><span>PhytoCellTec™ Solar VitisPhytoCellTec™</span></p><p><span>Solar Vitis is based on stem cells from the GamayTeinturierFréaux grape - a grape from<br/>Burgundy, which is characterised by an extremely high content of polyphenols<br/>for UV protection.</span></p><p><span>Extensive studies have shown that PhytoCellTec™ Solar Vitis reliably protects epidermal<br/>stem cells from UV stress and thus from skin aging caused by light.<br/>PhytoCellTec™ Solar Vitis increases the vitality and efficiency of all<br/>essential skin cells and improves the skin\'s resistance.</span></p><p><span>The use of plant stem cells protects the most important skin cells, namely its stem cells,<br/>thus delaying skin aging. PhytoCellTec™ Solar Vitis protects the skin from<br/>chronological and light-induced aging, extending skin cells\' vitality and<br/>keeping the skin\'s appearance young and beautiful longer.</span></p><p><span>PhytoCellTec™Argan</span></p><p><span>The fruits are derived from the ancient Berber tree (Arganiaspinosa), that only grows in<br/>southwestern Morocco, and is renowned for its vigor and longevity. The Argan<br/>fruit kernels are rich in fatty acids (oleic, linoleic) and produce a deeply<br/>nourishing and moisturizing oil beneficial for hair and skin. are derived from<br/>the ancient Berber tree (Arganiaspinosa), that only grows in southwestern<br/>Morocco, and is renowned for its vigor and longevity. The Argan fruit kernels<br/>are rich in fatty acids (oleic, linoleic) and produce a deeply nourishing and<br/>moisturizing oil beneficial for hair and skin. The Fruit Stem Cells are<br/>procured by a patent pending liposomal encapsulation process for maximum<br/>efficacy and stability. Liposomes are one of the most effective carrier systems<br/>for the delivery and time release of biologically active ingredients.</span></p><p><span>Derm Com</span></p><p><span>A Flower Bulb Extract to Improve Cell-Cell Communication.Based on a Crocus chrysanthus bulb<br/>extract, DermCom can reverse the aging process by stimulating the communication<br/>between skin cells.Thecrocus is a universal symbol of rejuvenation and<br/>youthfulness. Crocus chrysanthus &#34;Cream Beauty&#34; is a beautiful<br/>variety with creamy-colored petals. Bulbs are plant parts specializing in the<br/>storage of nutrients and are an interesting source of active ingredients for<br/>cosmetics.</span></p><p><span>With age, the communication process between skin cells, which is mediated by growth factors,<br/>is reduced. This strongly affects the extracellular matrix (ECM), the<br/>structural network of the skin and leads to a reduction of its firmness,<br/>elasticity and density.</span></p><p><span>DermCom was shown, in a series of tests, to stimulate keratinocytes to secrete growth<br/>factors that could enhance the synthesis of collagen and elastin in the dermis.<br/>This effect on fibroblasts was comparable to the one of the transforming growth<br/>factor (TGF-?), a natural growth factor involved in ECM synthesis.Clinical<br/>studies confirmed this result after only 2 weeks\' treatment:</span></p><p><span>DermCom can thus rejuvenate the skin matrix thanks to its growth factor-like activity and<br/>so preserve and improve the biomechanical properties of the skin as well as its<br/>quality.</span></p><p><span>Product<br/>Features</span></p><p><b><span>Benefits of product:</span></b><span></span></p><p><b><span>Triple Stemcell™</span></b></p><p><span><b>Can I purchase Triple Stemcell™ at a pharmacy or department store in my area?</b></span></p><p><span>Our products may be purchased by on line on our website (www.icrystalccell.com) or only go<br/>thru our members network around Malaysia.</span></p><p><span>Is it safe to use Triple Stemcell™?</span></p><p><span>Triple Stemcell™ has registered with National Pharmaceutical Control Bureau<br/>(NPCB)under Health Ministry Malaysia(KKM) and it has went through Standards and<br/>Industrial Research Institute of Malaysia (SIRIM) and SGS Singapore General<br/>Laboratory Testing Standard. This product is confirmed safe and 100% plant<br/>base.</span></p><p><span><b>What\'s happen if spray on the eyes or swallowed accidentally?</b></span></p><p><span>This is a cosmetic product that is safe for consumers and others users under normal and<br/>reasonably foreseen use. In case of contact, immediately flush eyes with water.<br/>If irritation persists get medical attention. Ingestion If material swallowed,<br/>drink lots of water and get medical attention or advice.</span></p><p><b><span>Personal protection: </span></b><span>Avoid eye contact. Obey reasonable safety<br/>precautions and practice good housekeeping.</span></p><p><span><b>Can Triple Stemcell™ healing any of illness as what the consumer had claim in their testimonial?</b></span></p><p><span>According to the professional advice from a group of doctors, Triple Stemcell™ is actually<br/>when we spray on the face or the skin at any parts of our body, stem cell will<br/>go thru our pores and nerves which absorb to the dermis and provide a signal<br/>where they need to repair and regeneration the cells surround the wound and the<br/>illness part, regulate pH level inside the body, when after the body immunity<br/>system improved slowly the illness will get healing.</span></p><p><span>The product is effective but a lot of consumers wish to take consistently and FOC?</span></p><p><span>For those consumers keen to use Triple Stemcell™, they can actually sign up as member to<br/>enjoy member price and with the marketing proposal provided, they can even earn<br/>for free redeem and get some extra income.</span></p><p><span><b>What usage should I take to obtain the best results?</b></span></p><p><span>While as each person may be different of their own absorption ability so results may be<br/>accordingly, through our trials with our customers , we have developed the<br/>products that can be taken both on a daily basis 2 time day and night or the<br/>high strength that should be cycled over shorter periods when a stronger effect<br/>is required. Triple stemcell™ should always be use after apply facer toner or<br/>after cleansing.</span></p><p><span><b>Why do I have oily skin?</b></span></p><p><span>Oily skin is mainly due to hormonal factors. The activity of the sebaceous glands is<br/>hormone-dependent. We know that an increase in androgynous hormones during<br/>adolescence, in both boys and girls, stimulates sebum (oil) production by a<br/>significant amount. This changes the condition of the skin, which goes from a<br/>normal condition to an oily or combination skin type. In women, another<br/>hormone, LH, increases just after ovulation, causing excessive sebum production<br/>at the end of the menstrual cycle, just before the period. There are also other<br/>factors:</span></p><p><span><b>Should I still use Triple stemcell™ if I have oily skin?</b></span></p><p><span>Yes, it is formulated especially for all types of skin as these contain ingredients to<br/>absorb excess oil and help mattify the skin while maintaining balanced<br/>hydration.</span></p><p><span><b>What causes imperfections and why do they tend to come back time after time?</b></span></p><p><span>All skin types naturally produce oil, which reaches the surface of the skin via a network of<br/>sebaceous glands and is secreted out of millions of tiny pores, or openings.<br/>When these sebaceous glands produce excess sebum, or oil, the pore dilates or<br/>opens, and is visible to the naked eye. Following the accumulation of dead<br/>cells and sebum, the pore becomes blocked. Once the sebum makes contact with<br/>the air, it oxidizes and blackens: forming a \'blackhead\' on the surface of the<br/>skin.</span></p><p><span>Sometimes when a pore is blocked, the bacteria normally present on the skin multiply within<br/>the accumulation of sebum, which leads to chemical reactions that cause skin<br/>irritation. A spot develops and redness appears, often painful to the touch.</span></p><p><span>What causes sensitive skin?</span></p><p><span>50-90% of women and 30% of men have sensitive skin. It\'s not a permanent condition but<br/>can affect all skin types.</span></p><p><span>Typically, sensitive skin tends to be intolerant of normal stimuli. Sensitive skin burns,<br/>stings or itches, either after applying certain products or after exposure to<br/>environmental factors (change in temperature, wind, air-conditioning etc.)<br/>Reactions can also occur after periods of stress or even after eating spicy<br/>foods. Fortunately, there are cosmetic products specially designed to care for<br/>sensitive skin, which help to soothe the skin and build up its defences to<br/>combat the daily stresses it faces.</span></p><p><span>Useful tip: </span></p><p><span><b>Is this product specifically for sensitive skin?</b></span></p><p><b><span>Triple Stemcell™</span></b><span> does not contain alcohol or colour and is<br/>suitable for the most sensitive and delicate of skin types. The<br/>dermatologically tested formulas are enriched with Derm Com and mineral springs<br/>which has soothing properties, leaving your skin feeling clean, supple and<br/>comfortable.</span></p><p><span><b>What are wrinkles?</b></span></p><p><span>A wrinkle is a line or crease in the skin and can vary from a fine surface line, to deeper<br/>folds or ridges. Wrinkles are a natural occurrence and appear due to the ageing<br/>process, as well as due to dehydration and UV damage.</span></p><p><span><b>What\'s the best way to combat wrinkles?</b></span></p><p><span>Expression lines, frown lines, crow\'s feet... whether these are deep or superficial,<br/>wrinkles and fine lines are all visible reminders of the steady march of time!</span></p><p><span>Expression lines are often found on the forehead, between the eyebrows, at the corner of<br/>the eyes, or around the mouth, and at places of frequent contraction - such as<br/>from smiling or frowning. Fortunately the contain of Derm Com in <b>Triple<br/>Stemcell™</b> has the solutions to effectively combat the signs of ageing<br/>which include wrinkles, fine lines and loss of firmness.</span></p><p><span><b>Does Triple Stemcell™ have any side effects?</b></span></p><p><span>Our products, used at their recommended usage are very well tolerated. However, one may<br/>experience a slight sense of smarting feeling after spraying Triple Stemcell™<br/>and it is recommended to spray by a distance. In my experience each individual<br/>reacts slightly differently, so the product usage that works for you may be<br/>different for another. High usages may give more dramatic effects within a<br/>shorter time frame of about 2-3 days, while lower dosages may take 1 week or<br/>more to notice the effect.</span></p><p><span><b>Why should I use Triple Stemcell™?</b></span></p><p><span>Healthy, beautiful skin requires a range of nutrients, vitamins and minerals, many of<br/>which are not produced in the body. To give skin the care it needs, skincare<br/>products are formulated to contain these essential elements, such as certain<br/>mineral salts (magnesium, manganese, zinc etc.) or essential fatty acids<br/>(Omega-3).</span></p><p><span>For example, magnesium is essential for using and storing energy in the cells, but a typical<br/>diet does not provide enough magnesium, and it\'s the skin that\'s often last in<br/>line. Magnesium is also good at combating external aggressors such as<br/>pollution, sun, cold, wind or heat.</span></p><p><span>Similarly, fatty acids also need to be supplied as the body does not produce them, which<br/>is why they are called essential fatty acids. They play an important role as<br/>constituents of the cellular membranes, and also in the skin\'s defense system<br/>(immunity). Finally, zinc is well known as a regulator of sebum secretion, and<br/>is also important for combating skin stresses (impurities and free radicals).</span></p><p><span><b>What is the Triple Stemcell™ range for 40+ or mature skin?</b></span></p><p><b><span>Triple Stemcell™</span></b><span>  is a complete and effective firming and<br/>anti-wrinkle range formulated for mature or 40+ skin. Its secret lies in<br/>naturally-sourced Derm Com, a leading anti-wrinkle molecule which stimulates<br/>cellular renewal for visible results. Derm Com, a powerful anti-ageing agent is<br/>made up of flower bulb extract based, an active ingredient widely known to<br/>effectively combat wrinkles, and Hyaluronic Acid, which nourishes and<br/>strengthens the skin\'s natural barrier function. Naturally-sourced DermCom,<br/>acts like a formation of collagen and elastin reserve, deeply penetrating the<br/>skin\'s surface and continuously releasing collagen into the heart of wrinkles<br/>to renew skin cells and stimulate collagen production from within.</span></p>', 'agboola', '11-09-2020', '07-01-2020'),
(10, 'Dispute Resolutions', 'disputeresolutions', NULL, '', 'agboola', '08-01-2020', '07-01-2020'),
(11, 'Delivery Information', 'deliveryinformation', NULL, 'WeBarn foods encourage customers to enter their delivery location appropriately for our dispatch personnel to be able to locate easily. However, we know that customers can order for friends and family members, hence we have made this to be editable at everypoint of checking out.', 'agboola', '11-01-2020', '08-01-2020'),
(12, 'Payment Options', 'paymentinformation', NULL, 'WeBarn foods encourage payment on delivery and or online payment (payment before delivery) as it is working had to ensure customers trust.', 'agboola', '11-01-2020', '08-01-2020'),
(13, 'Return Policy', 'returnspolicy', NULL, 'We guarantee the quality of our goods but you must inspect the goods. \r\nIn the event that the Goods collected by you are damaged, defective, faulty or do not match their description at the point of collection, you would be sent a replacement or a full refund will be made to you. You are advised to check your goods for any defect, fault or damage before signing the delivery note. If you discover a genuine fault, defect or damage on delivery, you will be required to return the Goods to us (together with all relevant packaging) through the dispatch or delivery person.\r\nWeBarn foods will not collect any products from customers as returned products after the dispatch person has left the delivery location or premises, hence We would advise and encourage our customers to check the delivered products satisfactorily before the dispatch person leaves the delivery location. However, customers have right to reject delivered products only in the presence of the dispatch person not in his or her absence.', 'agboola', '04-02-2020', '08-01-2020'),
(14, 'How It Works', 'howitworks', NULL, '<p>Place order for your choice fresh and processed staple foods by ;</p><p>1. Searching through categories of choice or by searching from the search space at the top left corner of our home page</p><p>2. Add your choice product to cart</p><p>3. You can add as many product as possible to your cart</p><p>4. Checkout and follow the steps described by the page to place your order.</p>', 'agboola', '01-06-2020', '08-01-2020');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(250) NOT NULL,
  `subcategory` varchar(50) NOT NULL,
  `categoryid` int(250) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `details` text NOT NULL,
  `authorid` int(250) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `safeurl` varchar(50) NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(250) NOT NULL,
  `companyid` int(250) NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 NOT NULL,
  `photo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(20) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(20) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(20) CHARACTER SET latin1 NOT NULL,
  `address` text CHARACTER SET latin1 DEFAULT NULL,
  `city` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `state` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `country` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `postalzipcode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `position` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `lastlogindate` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `passwordsalt` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `logintoken` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `logindevice` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referralcode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `referrercode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `referrerdetails` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `verificationcode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `verified` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `passwordremindercode` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `passwordreminderdate` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `linkedinprofile` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `groupid` int(250) DEFAULT NULL,
  `group` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rating` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `result` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adminsettings`
--
ALTER TABLE `adminsettings`
  ADD PRIMARY KEY (`lastuserid`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bannersliders`
--
ALTER TABLE `bannersliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clienttestimonials`
--
ALTER TABLE `clienttestimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companystructure`
--
ALTER TABLE `companystructure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adminsettings`
--
ALTER TABLE `adminsettings`
  MODIFY `lastuserid` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bannersliders`
--
ALTER TABLE `bannersliders`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clienttestimonials`
--
ALTER TABLE `clienttestimonials`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companystructure`
--
ALTER TABLE `companystructure`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `newslettersubscriptions`
--
ALTER TABLE `newslettersubscriptions`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
