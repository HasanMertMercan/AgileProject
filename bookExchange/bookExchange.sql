-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 22 Ara 2016, 20:52:02
-- Sunucu sürümü: 10.1.13-MariaDB
-- PHP Sürümü: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `bookExchange`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `books`
--

CREATE TABLE `books` (
  `bookId` int(11) NOT NULL,
  `bookName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ownerId` int(11) NOT NULL,
  `PublishYear` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `books`
--

INSERT INTO `books` (`bookId`, `bookName`, `author`, `ownerId`, `PublishYear`) VALUES
(3, 'isim', 'yazar', 65, 2000),
(11, '213123', '213213', 58, 2131),
(12, 'sadqd', '213321', 58, 1231),
(13, 'asdasd', 'sadsadqwewqe', 58, 1111);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `emailTokens`
--

CREATE TABLE `emailTokens` (
  `id` int(11) NOT NULL,
  `token` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `emailTokens`
--

INSERT INTO `emailTokens` (`id`, `token`) VALUES
(58, '6w0M8FaxhaLVTUA9WSYG'),
(59, 'CBvb5RiE4mdlTkepszI5'),
(60, 'HDS9TIIoIxwzinKe4MTV'),
(61, '0SKU584Rvcx9OoTkgNGH'),
(62, 'eHpUW0sdNIQzfBItxsdv'),
(63, 'pb4uMbh8AL4SKLOx35Ar'),
(64, 'qfaAvUZeuRqwTDih4gRo'),
(64, 'I6KeLDsumKRzMqAovml5'),
(65, 'UoipZJmW47WuwVRj0C7S'),
(66, 'm9C2K3UkGmiNnBmp3Ss5'),
(67, 'v7lr2KfXAEwqVOoQURba'),
(68, 'NzCzMAHxh6mK09oYCYq9'),
(70, 'qORybxzNxJ0DEhYBTk0E'),
(72, 'c6QrchqwdxQy3K6lyf86'),
(73, 'M0HuTfw8FL87FRMg2Uyk'),
(74, 'lva6IxzlXOZigS0bCfiA'),
(75, 'zvObDVGMaNOBn1fz1aZq'),
(76, 'wJrVzyhmQYLX34HQf0Z8'),
(77, 'aCpAAJW8gFWFgBd8jkKC');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `passwordTokens`
--

CREATE TABLE `passwordTokens` (
  `id` int(11) NOT NULL,
  `token` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `passwordTokens`
--

INSERT INTO `passwordTokens` (`id`, `token`) VALUES
(58, 'RY3c1V5t3yK00TcfjRVN'),
(64, 'l2a0fjGrmpjsviL83Gsu'),
(58, 'vXxplnwcxxXCplVvgZ2S'),
(68, 'kBh4zhCd8RlH16746Kuy'),
(75, 'Ibij42pKBVNf1oJYRKxf'),
(75, 'd8BdTM3BSkden9ltyGQs'),
(75, 'gCRlTUz3518lFtNxxhjq'),
(73, 'a4FTbzas5hpluNRql8zZ');

-- --------------------------------------------------------

--
-- Görünüm yapısı durumu `searchview`
--
CREATE TABLE `searchview` (
`bookName` varchar(100)
,`author` varchar(100)
,`PublishYear` int(11)
,`fullname` varchar(50)
,`email` varchar(50)
,`phone` varchar(10)
);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` binary(20) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emailConfirmed` int(1) NOT NULL DEFAULT '0',
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `fullname`, `phone`, `emailConfirmed`, `isActive`, `isAdmin`, `date`) VALUES
(62, 'ahmet@aktif.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'ahmet_aktif', '1231231231', 1, 0, 0, '2016-12-17 17:32:03'),
(63, 'ahmet@noaktif.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'ahmet no aktif', '1231231231', 1, 1, 0, '2016-12-17 17:32:26'),
(65, 'ahmet@test.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'ahmetahmet', '1231231231', 1, 1, 0, '2016-12-19 14:27:33'),
(73, 'ahmetsafasezgin@gmail.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'Ahmet Safa Sezgin', '5351231212', 1, 1, 0, '2016-12-22 18:14:50'),
(75, 'asafasezgin@gmail.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'Ahmet Safa Sezgin', '5351231212', 1, 1, 0, '2016-12-22 18:25:17'),
(76, 'ozan_lahmacun@gmail.com', 'e053b56abf7e056c09e296b1ac8556269ebf4f7b', 0x0a9ca6ed7aef5a68d81fffe36de7cb35813bc0a9, 'lahmacuncu', '5351231212', 1, 1, 0, '2016-12-22 19:06:03'),
(77, 'asdsad@sdasd.comasd', '242502413857e032b45362dbf1eeb4cce162a15b', 0x98596aeff0f7007bb8ffa158be5669e62391b402, 'asdsad', '2131231231', 0, 1, 0, '2016-12-22 19:50:55');

-- --------------------------------------------------------

--
-- Görünüm yapısı `searchview`
--
DROP TABLE IF EXISTS `searchview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bookexchange`.`searchview`  AS  select `bookexchange`.`books`.`bookName` AS `bookName`,`bookexchange`.`books`.`author` AS `author`,`bookexchange`.`books`.`PublishYear` AS `PublishYear`,`bookexchange`.`users`.`fullname` AS `fullname`,`bookexchange`.`users`.`email` AS `email`,`bookexchange`.`users`.`phone` AS `phone` from (`bookexchange`.`books` join `bookexchange`.`users` on((`bookexchange`.`books`.`ownerId` = `bookexchange`.`users`.`id`))) ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `books`
--
ALTER TABLE `books`
  MODIFY `bookId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
