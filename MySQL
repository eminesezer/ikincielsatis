-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 06 Haz 2018, 11:16:20
-- Sunucu sürümü: 5.6.39-cll-lve
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `emin1937_mehmetkproject`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Ev Tekstili'),
(2, 'Ev Tekstili'),
(3, 'Oyuncak'),
(4, 'Elektronik'),
(5, 'Plastik'),
(6, 'Robot'),
(7, 'Oyuncak'),
(8, 'Oyuncak'),
(9, 'Oyuncak'),
(10, 'Oyuncak');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `level`
--

CREATE TABLE `level` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `level`
--

INSERT INTO `level` (`id`, `name`) VALUES
(1, 'Kullanici'),
(2, 'Uye'),
(3, 'Yonetici');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `pages`
--

CREATE TABLE `pages` (
  `id` bigint(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `pages`
--

INSERT INTO `pages` (`id`, `name`, `link`, `level`) VALUES
(1, 'Homepage', 'homepage.html', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `startdate` datetime NOT NULL,
  `finishdate` datetime NOT NULL,
  `difference` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productname` varchar(50) NOT NULL,
  `saveddate` datetime NOT NULL,
  `seller` int(11) NOT NULL,
  `quality` varchar(255) NOT NULL,
  `explanation` varchar(50) NOT NULL,
  `img1` varchar(150) NOT NULL,
  `img2` varchar(150) NOT NULL,
  `img3` varchar(150) NOT NULL,
  `img4` varchar(150) NOT NULL,
  `img5` varchar(150) NOT NULL,
  `img6` varchar(150) NOT NULL,
  `img7` varchar(150) NOT NULL,
  `img8` varchar(150) NOT NULL,
  `img9` varchar(150) NOT NULL,
  `img10` varchar(150) NOT NULL,
  `price` varchar(100) NOT NULL,
  `available` tinyint(2) NOT NULL,
  `categorymapping` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `productname`, `saveddate`, `seller`, `quality`, `explanation`, `img1`, `img2`, `img3`, `img4`, `img5`, `img6`, `img7`, `img8`, `img9`, `img10`, `price`, `available`, `categorymapping`) VALUES
(1, 'e', '2018-05-31 15:39:19', 1, '', 'e', '../ikinciel/products/eminesezer-com-tr-1.png', '', '', '', '', '', '', '', '', '', '10', 1, 0),
(2, 'e', '2018-05-31 15:42:49', 1, '', 'e', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '10', 1, 0),
(3, 'wed', '2018-05-31 15:43:00', 1, '', 'wed', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '20', 1, 0),
(4, 'sd', '2018-05-31 15:43:51', 1, '', 'sd', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '10', 1, 0),
(5, 'sd', '2018-05-31 15:44:42', 1, '', 'sd', '../ikinciel/products/eminesezer-com-tr-1.png', '', '', '', '', '', '', '', '', '', '10', 1, 0),
(6, 's', '2018-05-31 15:44:51', 1, '', 's', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '', 1, 0),
(7, 's', '2018-05-31 15:46:09', 1, '', 's', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '20', 1, 0),
(8, 's', '2018-05-31 15:46:19', 1, '', 's', '../img/noimage.jpg', '', '', '', '', '', '', '', '', '', '20', 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `securityquestion`
--

CREATE TABLE `securityquestion` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `securityquestion`
--

INSERT INTO `securityquestion` (`id`, `question`) VALUES
(0, 'oku kizim oku'),
(0, 'ne?'),
(0, 'kim?'),
(0, 'kim?'),
(0, 'neden?');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `selling`
--

CREATE TABLE `selling` (
  `id` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `saveddate` datetime NOT NULL,
  `buyer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `countity` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `states`
--

INSERT INTO `states` (`id`, `country`, `city`, `countity`) VALUES
(0, 'Turkiye', 'Bursa', 'Ankara'),
(0, 'Hirvatistan', 'Zagreb', 'Sam'),
(0, 'a', 'b', 'c'),
(0, 'a', 'b', 'f'),
(0, 'a', 'b', 'e'),
(0, 'a', 'b', 'c'),
(0, 'a', 'b', 'b'),
(0, 'a', 'b', 'a'),
(0, 'a', 'd', 'b'),
(0, 'a', 'd', 'a'),
(0, 'a', 'd', 'd'),
(0, 'a', 'd', 'c'),
(0, 'a', 'f', 'c'),
(0, 'a', 'f', 'e'),
(0, 'a', 'g', 'e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`) VALUES
(1, 'Berkay', 'KORKMAZ'),
(2, 'Süleyman', 'VER?M'),
(3, 'Kübra', 'KENAR'),
(4, 'Berat', 'ÖZÜGELD?'),
(5, 'Seda', 'KAYABAS'),
(6, 'Erkan', 'BALBINAR');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `postcode` int(10) NOT NULL,
  `country` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `userpass` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(2) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `countity` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `address`, `phone`, `email`, `postcode`, `country`, `city`, `profile`, `userpass`, `password`, `level`, `question`, `answer`, `birthday`, `countity`) VALUES
(1, 'es', 'es', 'es', 'MinareliÃ§avuÅŸ Mahallesi, Alkanlar Sokak 18,', 'dsv', 'eminesezer@gdrobot.com', 16140, 'a', 'd', 'unselected', 'sc', 'sc', 2, '', '', '0000-00-00', ''),
(2, 'es', 'es', 'dsv', 'MinareliÃ§avuÅŸ Mahallesi, Alkanlar Sokak 18,', 'es', 'eminesezer@gdrobot.com', 16140, 'Hirvatistan', 'Zagreb', 'unselected', 'sc', 'sc', 2, '', '', '0000-00-00', ''),
(3, 'scd', 'es', 'dsv2', 'MinareliÃ§avuÅŸ Mahallesi, Alkanlar Sokak 18,', 'dsv', 'eminesezer@gdrobot.com', 16140, 'a', 'd', 'unselected', 'sc', 'sc', 2, '', '', '0000-00-00', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `selling`
--
ALTER TABLE `selling`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `selling`
--
ALTER TABLE `selling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
