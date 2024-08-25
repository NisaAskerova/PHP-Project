-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 25 Ağu 2024, 16:49:48
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `final_project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `title` varchar(1000) NOT NULL,
  `description` mediumtext NOT NULL,
  `profile` varchar(255) NOT NULL,
  `is_publish` tinyint(1) DEFAULT 0,
  `view_count` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `category_id`, `title`, `description`, `profile`, `is_publish`, `view_count`, `created_at`, `updated_at`) VALUES
(21, 53, 9, ' Süni Zəkanın Tibb Sahəsindəki İnqilabi Dəyişiklikləri', 'Giriş: Süni zəka, tibb sahəsində diaqnostika və müalicə üsullarını təkmilləşdirir. Bu yazıda, AI-nin tibbi sahədəki əsas tətbiq sahələrini nəzərdən keçirəcəyik.\r\n\r\nMövzu: Süni zəka, tibbi görüntüləri təhlil edə bilər, xəstəliklərin erkən mərhələlərdə aşkar edilməsinə kömək edir və müalicə planlarını optimallaşdırır.\r\n\r\nNəticə: Süni zəkanın tibb sahəsində tətbiqi, xəstəliklərin daha dəqiq diaqnozunu və müalicənin effektivliyini artırır.', '66bdb99368b4c_1723709843.jpg', 1, 3, '2024-08-15 08:17:23', '2024-08-16 11:42:06'),
(22, 57, 13, 'Yeni Bacarıqların Qazanılması', 'Giriş: Karyera inkişafı üçün yeni bacarıqlar qazanmaq vacibdir. Bu yazıda, karyera məqsədlərinə çatmaq üçün hansı bacarıqların öyrənilməli olduğunu müzakirə edəcəyik.\r\n\r\nMövzu: Liderlik bacarıqları, müasir texnologiyalar və təsirli ünsiyyət bacarıqları karyera inkişafında mühüm rol oynayır.\r\n\r\nNəticə: Yeni bacarıqlar öyrənmək, karyera inkişafını dəstəkləyir və iş bazarındakı rəqabət qabiliyyətini artırır.', '66bdc38b779dd_1723712395.jpeg', 1, 9, '2024-08-15 08:59:55', '2024-08-16 17:19:07'),
(23, 57, 16, 'Günlük Rutininizə İdman Əlavə Etmək Üçün Sadə Yollar', 'Giriş: Günlük rutininizə idmanı daxil etmək, sağlamlığınızı yaxşılaşdırmaq üçün vacibdir. Bu yazıda, idmanı gündəlik həyata inteqrasiya etməyin yollarını təqdim edəcəyik.\r\n\r\nMövzu: Qısa məşqlər, yüngül idman fəaliyyətləri və evdə idman avadanlıqları istifadə etmək idmanı gündəlik rutininizə daxil etməyə kömək edir.\r\n\r\nNəticə: İdmanı gündəlik həyatınıza əlavə etmək, sağlamlığınızı və enerjinizi artırır.', '66bdc48aa37c3_1723712650.jpg', 1, 6, '2024-08-15 09:04:10', '2024-08-25 12:56:41'),
(24, 58, 18, 'Evdə Bütün Ailə Üçün Əyləncəli Aktivliklər', 'Giriş: Evdə ailə üzvləri ilə keyfiyyətli vaxt keçirmək çox vacibdir. Bu yazıda, evdə bütün ailə üçün əyləncəli aktivliklər təqdim edəcəyik.\r\n\r\nMövzu: Oyun gecələri, yaradıcılıq fəaliyyətləri və birgə layihələr ailə bağlarını gücləndirir və əyləncəni artırır.\r\n\r\nNəticə: Evdə əyləncəli aktivliklər, ailə üzvləri arasında daha yaxın münasibətlər və əyləncəli vaxt keçirmək üçün əla bir yoldur.', '66bdc62eb39d0_1723713070.jpg', 1, 7, '2024-08-15 09:11:10', '2024-08-18 09:12:42'),
(25, 59, 10, 'Dijital Marketinqdə SEO-nun Rolu', 'Giriş: SEO (Axtarış Motoru Optimizasiyası) dijital marketinqin ayrılmaz bir hissəsidir. Bu yazıda, SEO-nun veb saytların axtarış motorlarındakı görünürlüğünü necə artırdığını öyrənəcəyik.\r\n\r\nMövzu: Açar sözlərin optimallaşdırılması, meta təsvirlərin yazılması və daxili bağlantıların yaradılması SEO-nun əsas prinsiplərindəndir.\r\n\r\nNəticə: Effektiv SEO strategiyaları, veb saytların axtarış motorlarında yüksək sıralarda yer almasına kömək edir.', '66bdca6f8ba84_1723714159.jpeg', 1, 5, '2024-08-15 09:29:19', '2024-08-16 12:49:01'),
(26, 59, 12, 'Təhlükəsiz İnternet İstifadəsi: Uşaqlar üçün Bələdçi', 'Giriş: İnternet istifadəçiləri arasında təhlükəsizlik, xüsusən uşaqlar üçün əhəmiyyətlidir. Bu yazıda, uşaqların internetdə təhlükəsizliyini təmin etmək üçün məsləhətlər təqdim edəcəyik.\r\n\r\nMövzu: Şəxsi məlumatların qorunması, internetdə düzgün davranış və valideyn nəzarəti uşaqların internet təhlükəsizliyini təmin edir.\r\n\r\nNəticə: Təhlükəsiz internet istifadəsi, uşaqların onlayn mühitdə qorunmasını təmin edir.', '66bdcc2cea655_1723714604.jpeg', 1, 5, '2024-08-15 09:36:44', '2024-08-16 12:49:03'),
(27, 61, 14, 'Ekoloji Cəhətdən Düşünülmüş Həyat Tərzi', 'Giriş: Ekoloji cəhətdən davamlı həyat tərzi, müasir dövrdə əhəmiyyətli bir mövzudur. Bu yazıda, davamlı yaşamın prinsiplərini və tətbiq üsullarını araşdıracağıq.\r\n\r\nMövzu: Enerji qənaəti, tullantıların azaldılması və təbii resursların qorunması davamlı yaşamın əsas elementləridir.\r\n\r\nNəticə: Ekoloji cəhətdən davamlı həyat tərzi, ətraf mühitin qorunmasına kömək edir və gələcək nəsillər üçün daha yaxşı bir dünya təmin edir.', '66bdce1bd6551_1723715099.jpg', 1, 42, '2024-08-15 09:44:59', '2024-08-16 12:48:57'),
(33, 58, 15, 'Yerli İqtisadiyyatın Gücləndirilməsi: Kiçik Bizneslərin Rolu', 'Giriş: Kiçik bizneslər, yerli iqtisadiyyatın inkişafında mühüm rol oynayır. Bu yazıda, kiçik bizneslərin iqtisadi təsirini müzakirə edəcəyik.\r\n\r\nMövzu: Kiçik bizneslər yerli iş yerləri yaradır, cəmiyyətə xidmət edir və iqtisadi artımı dəstəkləyir.\r\n\r\nNəticə: Kiçik bizneslər yerli iqtisadiyyatın inkişafını təşviq edir və iqtisadi dayanıqlığı təmin edir.', '66bddb9282bea_1723718546.jpg', 1, 4, '2024-08-15 10:42:26', '2024-08-16 12:20:11'),
(46, 57, 10, '2024-cü İl üçün Sosial Media Marketinq Trendləri', 'Giriş:\r\nSosial media marketinqi, bizneslərin müştəri bazasını genişləndirmək və marka tanınmasını artırmaq üçün əsas vasitələrdən biridir.\r\n\r\nMəzmun:\r\n\r\nİnfluencer Marketinqi: Sosial media influenserləri ilə əməkdaşlıq və onların markanın tanınmasında rolu.\r\nVideonun Gücü: Video məzmunun sosial media platformalarında istifadə edilməsi və müştəri cəlb etmə potensialı.\r\nŞəxsi Yanaşma: Müştəri ilə fərdi əlaqələrin qurulması və onların xüsusi ehtiyaclarına uyğun məzmun təqdim edilməsi.\r\nNəticə:\r\nSosial media marketinqində müasir trendləri izləmək və tətbiq etmək, bizneslərin rəqabət üstünlüyünü artırır və müştəri əlaqələrini gücləndirir.', '66bf3e0983187_1723809289.jpg', 1, 8, '2024-08-16 11:45:22', '2024-08-16 13:02:10'),
(47, 61, 11, 'Uşaqların Sosial Bacarıqlarını İnkişaf Etdirən Təhsil Yöntemləri', 'Giriş:\r\nUşaqların sosial bacarıqları, onların gələcəkdə müvəffəqiyyətli və əməkdaşlığa uyğun olmaları üçün vacibdir. Müasir təhsil metodları bu bacarıqları inkişaf etdirmək üçün nəzərdə tutulmuşdur.\r\n\r\nMəzmun:\r\n\r\nQrup Fəaliyyətləri: Qrup oyunları və layihələr vasitəsilə əməkdaşlıq bacarıqlarının inkişafı.\r\nƏl-Cəhət Təhsili: Empati və emosional zəka üzərində fokuslanma.\r\nRol Oynama: Sosial situasiyalarda rolu oynayaraq uşaqların sosial bacarıqlarının gücləndirilməsi.\r\nNəticə:\r\nSosial bacarıqların inkişafını dəstəkləyən təhsil metodları, uşaqların gələcəkdə daha uğurlu və empatik fərdlər olmalarına kömək edir.', '66bf3c690e10f_1723808873.jpg', 1, 11, '2024-08-16 11:47:53', '2024-08-16 18:03:37'),
(48, 53, 13, 'Şəxsi Brendinq: Karyera İnkişafında Özünüzü Necə Tanıda Bilərsiniz?', 'Giriş:\r\nŞəxsi brendinq, karyera inkişafında özünüzü tanıtmaq və fərqləndirmək üçün vacib bir yanaşmadır. Güclü şəxsi brend, professional dünyada tanınmanı artırır.\r\n\r\nMəzmun:\r\n\r\nŞəxsi Brendinqin Əsasları: Öz güclü tərəflərinizi və unikal bacarıqlarınızı müəyyən etmək, şəxsi brendin qurulması.\r\nOnlayn Təqdimat: LinkedIn və digər sosial media platformalarında güclü bir profil yaratmaq və fəal iştirak.\r\nŞəxsi Brendin İdarə Edilməsi: Şəxsi brendi müntəzəm olaraq yeniləmək, professional əlaqələri genişləndirmək və brendinizi qorumaq.\r\nNəticə:\r\nŞəxsi brendinq, karyera inkişafını dəstəkləyir və professional mühitdə tanınmağı artırır. Güclü bir şəxsi brend yaratmaq və idarə etmək, karyera məqsədlərinə çatmağa kömək edir.', '66bf3d8581a5f_1723809157.jpg', 1, 24, '2024-08-16 11:52:37', '2024-08-18 09:13:22'),
(49, 57, 9, 'qwertyui', 'AQSWERTYUI', '66c9bdb62f131_1724497334.jpg', 0, 0, '2024-08-24 11:02:14', '2024-08-24 11:02:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `update_at`) VALUES
(9, 'Texnologiya / Tibb', '2024-08-15 08:11:14', '2024-08-15 08:11:14'),
(10, 'Marketinq / Dijital Strategiyalar', '2024-08-15 08:11:30', '2024-08-15 08:11:30'),
(11, 'Təhsil / Uşaq İnkişafı', '2024-08-15 08:11:39', '2024-08-15 08:11:39'),
(12, 'Təhlükəsizlik / Təhsil', '2024-08-15 08:11:51', '2024-08-15 08:11:51'),
(13, 'Karyera / İnkişaf', '2024-08-15 08:12:03', '2024-08-15 08:12:03'),
(14, 'Ekologiya / Həyat Tərzi', '2024-08-15 08:12:16', '2024-08-15 08:12:16'),
(15, 'İqtisadiyyat / Biznes', '2024-08-15 08:12:25', '2024-08-15 08:12:25'),
(16, 'Sağlamlıq / İdman', '2024-08-15 08:12:33', '2024-08-15 08:12:33'),
(17, 'Kommunikasiya / Yazılı Bacarıqlar', '2024-08-15 08:12:44', '2024-08-15 08:12:44'),
(18, 'Ailə / Əyləncə', '2024-08-15 08:12:51', '2024-08-15 08:12:51'),
(34, 'Ev Təmiri / Yaradıcılıq', '2024-08-15 21:04:01', '2024-08-15 21:04:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `active` int(11) DEFAULT 0,
  `role` int(11) DEFAULT 0,
  `otp` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `password`, `gender`, `dob`, `profile`, `email`, `active`, `role`, `otp`, `created_at`, `updated_at`) VALUES
(53, 'Nise', 'Esgerova', '$2y$10$AYWXKF1WYG5tV7V9z.KaA.0M0JtjtnWPqoGr0L15Ogth/453mLQ.i', 2, '1111-11-11', NULL, 'nisaaskerova98@gmail.com', 1, 0, NULL, '2024-08-14 13:09:03', '2024-08-14 13:09:03'),
(57, 'Nise', 'Esgerova', '$2y$10$9i7hx4Wvj4EiQ8d4Yb949.qjrZdE4wRFc9T/Z9QPAMrdBWWynXT.m', 2, '1998-04-03', NULL, 'nise@gmail.com', 1, 0, NULL, '2024-08-15 08:57:28', '2024-08-15 08:57:28'),
(58, 'Meley98', 'Allahverdiyeva', '$2y$10$gWoMeaM0Eh6NNCdnr430Guzh6me9jPDELU6mLtbRh6FLGdxKzxu3W', 2, '1998-12-02', NULL, 'meleyallahverdiyeva22@gmail.com', 1, 0, NULL, '2024-08-15 09:06:36', '2024-08-15 09:06:36'),
(59, 'Lale', 'Agayeva', '$2y$10$8PQTXeHRe3Ka6M2Y01DGcO05ymQKJA.ytIUJUx7wSUeuQ.nC0rQEq', 2, '2000-11-27', NULL, 'lale@gmail.com', 1, 0, NULL, '2024-08-15 09:26:29', '2024-08-15 09:26:29'),
(60, 'Nise', 'Esgerova', '$2y$10$NrFbayLMR/2ng56LyN8sYumEkg04oMMw5DzT6mSH1lyvKVEWHtATe', 2, '1998-04-03', 'public/66bdccae01f04_1723714734.jpg', 'esnise16@gmail.com', 1, 1, NULL, '2024-08-15 09:38:54', '2024-08-15 09:38:54'),
(61, 'Arzu', 'Aliyeva', '$2y$10$aUBfMFNXm2WpkP/CrAjNrONdQspcBGdF/FSrLk2H9X6YkmOg1FGSy', 0, '2002-04-05', NULL, 'arzu@gmail.com', 1, 0, NULL, '2024-08-15 09:41:52', '2024-08-15 09:41:52'),
(62, 'Banu', 'Hemidova', '$2y$10$DXfuNyogNDOtd3e13RiPquXZukTUJnum/6CYmeQo.Wzm/lwhVQkkq', 2, '2003-10-07', NULL, 'banu@gmail.com', 1, 0, NULL, '2024-08-16 09:03:39', '2024-08-16 09:03:39'),
(63, 'Ayse', 'Hesenova', '$2y$10$krUUuosCqHp1uSmgY6BI7ueyyjNzt8dbHWilqTaG0SPtusBkCXir6', 2, '1999-12-01', NULL, 'ayse@gmail.com', 0, 0, 4313, '2024-08-25 13:09:03', '2024-08-25 13:09:03');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Tablo için AUTO_INCREMENT değeri `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `blogs_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
