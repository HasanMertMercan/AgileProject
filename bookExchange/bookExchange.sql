-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 18 Ara 2016, 00:27:02
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
(64, 'qfaAvUZeuRqwTDih4gRo');

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
(64, 'l2a0fjGrmpjsviL83Gsu');

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
  `emailConfirmed` int(1) NOT NULL,
  `isActive` int(1) NOT NULL DEFAULT '1',
  `isAdmin` int(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `salt`, `fullname`, `phone`, `emailConfirmed`, `isActive`, `isAdmin`, `date`) VALUES
(58, 'ahmetsafasezgin@gmail.com', 'd3bcbb163d1c6e3e6a8a9dbb4fee543f6e351d77', 0x77b255ce0477ae70acb4ea46aa4d1885bc5741eb, 'ahmet safa sezgin', '5351231212', 1, 1, 0, '2016-12-17 15:32:31'),
(62, 'ahmet@aktif.com', 'e59bf993ca931f7007ea4d18c37a3976ce7f4127', 0x188b9dd82d04d2e1007434ce374ea861fc1aa58d, 'ahmet_aktif', '1231231231', 1, 0, 0, '2016-12-17 17:32:03'),
(63, 'ahmet@noaktif.com', 'f31d009df71dd595e68a41b950d140c304b84980', 0x88992c391174a852f5ac5708aba96f3fbf3aba0d, 'ahmet no aktif', '1231231231', 1, 1, 0, '2016-12-17 17:32:26');

--
-- Dökümü yapılmış tablolar için indeksler
--

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
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
