-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2020 at 06:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_beyoou`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@beyou.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_unique_id` varchar(10) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `service` varchar(100) NOT NULL,
  `service_price` varchar(100) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `total` int(11) NOT NULL,
  `transaction_id` varchar(25) NOT NULL,
  `time_filter` datetime NOT NULL,
  `payment` bit(1) NOT NULL DEFAULT b'0',
  `status` enum('Processing','Cancelled','Fulfilled') NOT NULL DEFAULT 'Processing'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `booking_unique_id`, `shop_id`, `booking_date`, `booking_time`, `service`, `service_price`, `discount`, `total`, `transaction_id`, `time_filter`, `payment`, `status`) VALUES
(1, 1, 'Dr5mUQneBf', 3, '2020-04-01', '12:00:00', '1', '4000', '4000', 4000, '', '0000-00-00 00:00:00', b'0', 'Processing'),
(2, 1, 'UEWnLurivl', 3, '2020-04-07', '12:00:00', '1', '4000', '4000', 4000, '', '0000-00-00 00:00:00', b'0', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `en` varchar(30) NOT NULL,
  `es` varchar(30) NOT NULL,
  `fr` varchar(30) NOT NULL,
  `pt` varchar(30) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `en`, `es`, `fr`, `pt`, `image_url`, `status`) VALUES
(1, 'Beauty', 'belleza', 'beauté', 'beleza', '1979205142.jpg', '1'),
(2, 'Fitness', 'Aptitud', 'Aptitude', 'ginástica', '64649758.jpg', '1'),
(3, 'Wellness', 'bienestar', 'bien-être', 'bem estar', '21100003.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `child_category`
--

CREATE TABLE `child_category` (
  `child_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `en` varchar(50) NOT NULL,
  `es` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_category`
--

INSERT INTO `child_category` (`child_category_id`, `category_id`, `sub_category_id`, `en`, `es`, `fr`, `pt`, `status`) VALUES
(1, 1, 1, 'Bridal makeup', 'Maquillaje de novia', 'Maquillage de mariée', 'Maquiagem de noiva', '1'),
(3, 2, 4, 'Indoor Sports', 'Deportes de interior', 'Sports d\'intérieur', 'Esportes indoor', '1'),
(4, 2, 3, 'Cardio gym', 'Gimnasio cardiovascular', 'Gym cardio', 'Cardio gym', '1'),
(5, 3, 5, 'Face care', 'Hacer eso', 'Fais ça', 'Faça isso', '1'),
(6, 1, 1, 'Party Makeup', 'Maquillaje De Fiesta', 'Maquiagem Festa', 'Maquiagem Festa', '1'),
(7, 3, 6, 'Yoga', 'Yoga', 'Yoga', 'Ioga', '1'),
(8, 1, 7, 'Bowl Cut', 'Corte tazón', 'Coupe du bol', 'Corte de Tigela', '1');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(30) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `user_type` enum('Admin','Saloon') NOT NULL,
  `shop_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `coupon_value`, `user_type`, `shop_id`, `status`) VALUES
(1, 'get20', 20, 'Admin', 0, 'Active'),
(2, 'get10', 10, 'Saloon', 1, 'Active'),
(3, '25OFF', 25, 'Saloon', 1, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `faq` int(255) NOT NULL,
  `language type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq_desc`
--

CREATE TABLE `faq_desc` (
  `faq_desc_id` int(11) NOT NULL,
  `faq_id` int(11) NOT NULL,
  `faq_desc` text NOT NULL,
  `language_type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favourite`
--

CREATE TABLE `favourite` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `code`) VALUES
(4, 'Portuguese', 'pt'),
(5, 'French', 'fr'),
(6, 'Spanish', 'es'),
(9, 'English', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `languages_data`
--

CREATE TABLE `languages_data` (
  `id` int(10) NOT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `en` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'english',
  `es` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `languages_data`
--

INSERT INTO `languages_data` (`id`, `key`, `en`, `es`, `fr`, `pt`, `status`) VALUES
(1, 'header_signup', 'Sign up', 'Regístrate', 's\'inscrire', 'inscrever-se', '1'),
(2, 'header_login', 'Log In', 'iniciar sesión', 's\'identifier', 'Conecte-se', '1'),
(3, 'header_help', 'help', 'ayuda', 'Aidez-moi', 'Socorro', '1'),
(4, 'filter_content', 'Discover & Book Your Next Beauty Appointments Now!', '¡Descubra y reserve sus próximas citas de belleza ahora!', 'Découvrez et réservez vos prochains rendez-vous beauté maintenant!', 'Descubra e marque já as suas próximas consultas de beleza!', '1'),
(5, 'filter_content1', 'What', 'Qué', 'Quoi', 'o que', '1'),
(6, 'filter_content2', 'Where', 'Dónde', 'Où', 'Onde', '1'),
(7, 'filter_button', 'search', 'buscar', 'chercher', 'procurar', '1'),
(8, 'freelancer_title', 'Join as Freelancer', 'Únete como Freelancer', 'Rejoignez en tant que pigiste', 'Associe-se como Freelancer', '1'),
(9, 'freelancer_content', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magnaLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna Lorem ipsum ', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magnaLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna Lorem ipsum ', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magnaLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna Lorem ipsum ', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magnaLorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna Lorem ipsum ', '1'),
(10, 'freelancer_button', 'know more', 'saber más', 'savoir plus', 'saber mais', '1'),
(11, 'footer_title', 'About BeYoou', 'À propos de BeYoou', 'À propos de BeYoou', 'Sobre o BeYoou', '1'),
(12, 'footer_content', 'BeYoou is the online destination for beauty & wellness professionals and clients. Professionals can showcase their work, connect with new and existing clients, and build their business. Clients can discover new services and providers, book appointments on', 'BeYoou es el destino en línea para profesionales de belleza y bienestar y clientela. Los profesionales pueden exhibir sus trabajar, conectarse con nuevos y existentes clientes, y construir su negocio. Los clientes pueden descubrir nuevos servicios y prove', 'BeYoou es el destino en línea para profesionales de belleza y bienestar y clientela. Los profesionales pueden exhibir sus trabajar, conectarse con nuevos y existentes clientes, y construir su negocio. Los clientes pueden descubrir nuevos servicios y prove', 'BeYoou é o destino on-line para profissionais de beleza e bem-estar e clientes. Profissionais podem mostrar suas trabalho, conecte-se a novos e existentes clientes e criar seus negócios. Os clientes podem descobrir novos serviços e provedores, marque comp', '1'),
(13, 'footer_link_professional', 'FIND PROFESSIONALS', 'ENCUENTRE PROFESIONALES', 'ENCUENTRE PROFESIONALES', 'ENCONTRE PROFISSIONAIS', '1'),
(14, 'footer_link_list', 'GET LISTED', 'LISTA', 'OBTENEZ UNE LISTE', 'OBTENHA LISTADO', '1'),
(15, 'footer_link_carrer', 'CAREERS', 'Carreras', 'CARRIÈRES', 'CARREIRAS', '1'),
(16, 'footer_link_terms', 'TERMS FOR PROS', 'TÉRMINOS PARA PROS', 'CONDITIONS POUR LES PROS', 'TERMOS PARA PROS', '1'),
(17, 'footer_link_termsClient', 'TERMS FOR CLIENT', 'TÉRMINOS PARA EL CLIENTE', 'CONDITIONS POUR LE CLIENT', 'TERMOS PARA O CLIENTE', '1'),
(18, 'footer_link_privacy', 'PRIVACY', 'INTIMIDAD', 'INTIMITÉ', 'PRIVACIDADE', '1'),
(19, 'footer_link_sitemap', 'SITEMAP', 'MAPA DEL SITIO', 'PLAN DU SITE', 'MAPA DO SITE', '1'),
(20, 'footer_link_talk', 'TALK TO US', 'HÁBLANOS', 'PARLE-NOUS', 'PARLE-NOUS', '1'),
(21, 'login_modal_title', 'Login', 'Iniciar sesión', 'S\'identifier', 'Conecte-se', '1'),
(22, 'login_modal_email', 'Email', 'Email', 'Email', 'O email', '1'),
(23, 'login_modal_pass', 'Password', 'Mot de passe', 'Mot de passe', 'Senha', '1'),
(24, 'login_modal_remember', 'Remember Me', 'Recuérdame', 'Souviens-toi de moi', 'Lembre de mim', '1'),
(25, 'login_modal_forget', 'Forget password', 'Mot de passe oublié', 'Mot de passe oublié', 'Esqueceu a senha', '1'),
(26, 'login_modal_button', 'Login', 'Iniciar sesión', 'S\'identifier', 'inscrever-se', '1'),
(27, 'signup_modal_title', 'Sign up', 'Regístrate', 'S\'inscrire', 'Inscrever-se', '1'),
(28, 'signup_modal_name', 'Full Name', 'Nombre completo', 'Nom complet', 'Nome completo', '1'),
(29, 'signup_modal_phone', 'PHONE NUMBER', 'NÚMERO DE TELÉFONO', 'NUMÉRO DE TÉLÉPHONE', 'NÚMERO DE TELEFONE', '1'),
(30, 'signup_modal_service', 'SERVICES', 'SERVICIOS', 'PRESTATIONS DE SERVICE', 'SERVIÇOS', '1'),
(31, 'signup_modal_terms', 'I agree to the terms & conditions', 'Acepto los términos y condiciones', 'J\'accepte les termes et conditions', 'Eu aceito os termos e condiçoes', '1'),
(33, 'service_list', 'Select Services', 'Seleccionar servicios', 'Sélectionnez les services', 'Selecione Serviços', '1'),
(34, 'city_list', 'Select City', 'Ciudad selecta', 'Sélectionnez une ville', 'Selecione a cidade', '1'),
(43, 'detail_about', 'About', 'Acerca de', 'Sur', 'Sobre', '1'),
(44, 'detail_opening', 'Opening Time', 'Hora de apertura', 'Horaire d\'ouverture', 'Tempo de abertura', '1'),
(45, 'detail_location', 'Location', 'Ubicación', 'Emplacement', 'Localização', '1'),
(46, 'detail_review', 'Reviews', 'Comentarios', 'Commentaires', 'Avaliações', '1'),
(47, 'cart_title', 'Cart', 'Carro', 'Chariot', 'Carrinho', '1'),
(48, 'cart_venue', 'Add another service from this venue', 'Agregar otro servicio desde este lugar', 'Ajouter un autre service à partir de ce lieu', 'Adicione outro serviço deste local', '1');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `body` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `title`, `body`, `user_id`, `created_date`) VALUES
(1, 'New Message', 'Hello, How Are You?', 20, '2019-09-17 05:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(5000) NOT NULL,
  `rating` int(11) NOT NULL,
  `created` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `shop_id`, `user_id`, `review`, `rating`, `created`) VALUES
(1, 3, 1, 'They provide very good services at a very low cost.Thankyou', 4, '2020-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `saloon`
--

CREATE TABLE `saloon` (
  `shop_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `child_category_id` int(11) NOT NULL,
  `superchild_category_id` int(11) NOT NULL,
  `image_url` varchar(20) NOT NULL,
  `banner_url` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `shop_name_en` varchar(100) NOT NULL,
  `address_en` varchar(100) NOT NULL,
  `city_en` varchar(20) NOT NULL,
  `state_en` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `from` varchar(50) NOT NULL,
  `shop_name_es` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_es` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_es` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_es` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `is_visible` bit(1) NOT NULL DEFAULT b'0',
  `shop_name_fr` varchar(100) NOT NULL,
  `address_fr` varchar(100) NOT NULL,
  `city_fr` varchar(100) NOT NULL,
  `state_fr` varchar(100) NOT NULL,
  `shop_name_pt` varchar(100) NOT NULL,
  `address_pt` varchar(100) NOT NULL,
  `city_pt` varchar(100) NOT NULL,
  `state_pt` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saloon`
--

INSERT INTO `saloon` (`shop_id`, `category_id`, `sub_category_id`, `child_category_id`, `superchild_category_id`, `image_url`, `banner_url`, `email`, `password`, `about`, `shop_name_en`, `address_en`, `city_en`, `state_en`, `pincode`, `latitude`, `longitude`, `to`, `from`, `shop_name_es`, `address_es`, `city_es`, `state_es`, `status`, `is_visible`, `shop_name_fr`, `address_fr`, `city_fr`, `state_fr`, `shop_name_pt`, `address_pt`, `city_pt`, `state_pt`) VALUES
(1, 1, 1, 1, 4, '1025405158.jpg', '40303514.jpg', 'rohan.designoweb@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Saloon may refer to: An alternative name for a bar; A South Asian or Cypriot term for a barber\'s shop; One of the bars in a traditional British public house, or pub ...', 'Diamond Unisex saloon', 'Dilshad Garden', 'New delhi', 'Delhi', '263601', '28.5688294', '77.34934369999996', '22:00', '10:00', 'Salón Diamond Unisex', 'Dilshad Garden', 'Nuevo delhi', 'Delhi', 'Active', b'0', 'Diamond Unisex berline', 'Dilshad Garden', 'New Delhi', 'Delhi', 'Salão Unisex Diamond', 'Dilshad Garden', 'New Delhi', 'Delhi'),
(2, 3, 6, 7, 5, '1960385112.jpg', '1847439420.jpg', 'ramji.designoweb@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Avengers Yoga Classes', 'Avengers Yoga Classes', 'Bieber Street,Dilshad Garden', 'uttarkhand', 'uttarkhand', '110095', '28.5688294', '77.34934369999996', '22:00', '10:00', 'Avengers Yoga Classes', 'Bieber Street,Dilshad Garden', 'uttarkhand', 'uttarkhand', 'Active', b'0', 'Cours de yoga Avengers', 'Bieber Street,Dilshad Garden', 'uttarkhand', 'uttarkhand', 'Vingadores Yoga Classes', 'Bieber Street,Dilshad Garden', 'uttarkhand', 'uttarkhand'),
(3, 2, 3, 4, 2, '608202410.jpg', '1967521834.jpg', 'rajat.designoweb@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'Gym', 'Rajat Gym Complex', 'Alambagh', 'Lucknow', 'Uttar Pradesh', '110095', '28.5688294', '77.34934369999996', '22:00', '10:00', 'Rajat Gym Complex', 'Alambagh', 'LucknowLucknow', 'Uttar Pradesh', 'Active', b'0', 'Rajat Gym Complex', 'Alambagh', 'Lucknow', 'Uttar Pradesh', 'Rajat Gym Complex', 'Alambagh', 'Lucknow', 'Uttar Pradesh'),
(4, 1, 7, 8, 6, '64357808.jpg', '379114994.jpg', 'avengers.designoweb@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'All types of hair cut done by Avengers team', 'Avenger Hair Saloon', 'Punjabi bagh', 'uttarkhand', 'uttarkhand', '263601', '28.5688294', '77.34934369999996', '22:00', '10:00', 'Avenger Hair Saloon', 'Punjabi bagh', 'uttarkhand', 'uttarkhand', 'Active', b'0', 'Avenger Hair Saloon', 'Punjabi bagh', 'uttarkhand', 'uttarkhand', 'Avenger Hair Saloon', 'Punjabi bagh', 'uttarkhand', 'uttarkhand'),
(5, 1, 1, 1, 4, '784020423.jpg', '1007296947.jpg', 'rohan@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'adasd', 'Sapna Beauty Parlour', 'Mumbai', 'uttarkhand', 'uttarkhand', '263601', '28.5688294', '77.34934369999996', '22:00', '10:00', 'Sapna Beauty Parlour', 'Mumbai', 'uttarkhand', 'uttarkhand', 'Active', b'0', 'Sapna Beauty Parlour', 'Mumbai', 'uttarkhand', 'uttarkhand', 'Sapna Beauty Parlour', 'Mumbai', 'uttarkhand', 'uttarkhand');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_category_id` int(11) NOT NULL,
  `en` varchar(50) NOT NULL,
  `es` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `popular_service` bit(1) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_category_id`, `en`, `es`, `fr`, `pt`, `price`, `popular_service`, `status`) VALUES
(1, 2, 'Upper body Fitness', 'Upper body Fitness', 'Upper body Fitness', 'Upper body Fitness', 4000, b'1', '1'),
(2, 2, 'Lower body Fitness', 'Fitness para la parte inferior del cuerpo', 'Remise en forme du bas du corps', 'Parte inferior do corpo Fitness', 400, b'1', '1'),
(3, 7, 'Lower body Fitness', 'Fitness para la parte inferior del cuerpo', 'Remise en forme du bas du corps', 'Parte inferior do corpo Fitness', 200, b'1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `service_category`
--

CREATE TABLE `service_category` (
  `service_category_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `en` varchar(50) NOT NULL,
  `es` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_category`
--

INSERT INTO `service_category` (`service_category_id`, `shop_id`, `en`, `es`, `fr`, `pt`, `status`) VALUES
(2, 3, 'Muscular Fitness', 'Aptitud muscular', 'Fitness musculaire', 'Aptidão Muscular', '1'),
(4, 3, 'Biceps Strength', 'Fuerza de bíceps', 'Force du biceps', 'Força do bíceps', '1'),
(5, 2, 'Mental Yoga', 'Mental Yoga', 'Mental Yoga', 'Mental Yoga', '1'),
(6, 4, 'Hair cut', 'Corte de pelo', 'La Coupe de cheveux', 'Corte de cabelo', '1'),
(7, 5, 'Bridal Makeup', 'Maquillaje de novia', 'Maquillage de mariée', 'Maquiagem De Noiva', '1');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `language_type` varchar(10) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `type`, `language_type`, `text`) VALUES
(1, 'about', 'en', '<p>about us in english</p><p><br></p>'),
(2, 'about', 'pt', 'about us in portuguese'),
(3, 'about', 'fr', 'about us in french'),
(4, 'about', 'es', 'about us in spanish'),
(5, 'privacy', 'en', 'privacy in english'),
(6, 'privacy', 'pt', '<p style=\"line-height: 1; font-size: 1.25125rem; font-family: Roboto, sans-serif; color: rgb(27, 34, 60);\">Privacy Policy in portuguese</p><h4 style=\"font-family: Roboto, sans-serif; color: rgb(138, 144, 157);\"><br></h4>'),
(7, 'privacy', 'fr', '<h2 style=\"line-height: 1; font-size: 1.25125rem; font-family: Roboto, sans-serif;\"><span style=\"background-color: rgb(255, 255, 0);\">Privacy Policy in french</span></h2><div><br></div>'),
(8, 'privacy', 'es', '<h2 style=\"line-height: 1; font-size: 1.25125rem; font-family: Roboto, sans-serif; color: rgb(27, 34, 60);\">Privacy Policy in spanish</h2>');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `en` varchar(50) NOT NULL,
  `es` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `en`, `es`, `fr`, `pt`, `image_url`, `status`) VALUES
(1, 1, 'Makeover', 'cambio de imagen', 'relooking', 'reforma', '1383743920.jpg', '1'),
(2, 1, 'SkinCare', 'Protección de la piel', 'Soin de la peau', 'Cuidados com a pele', '39057905.png', '1'),
(3, 2, 'gym', 'gimnasio', 'Gym', 'Academia', '1812362276.jpg', '1'),
(4, 2, 'Sports', 'Deportes', 'Des sports', 'Esportes', '1049495653.jpg', '1'),
(5, 3, 'Personal care', 'Cuidado personal', 'Soins personnels', 'Cuidado pessoal', '1271312737.jpg', '1'),
(6, 3, 'Lifestyle', 'Estilo de vida', 'Mode de vie', 'Estilo de vida', '2120345975.jpg', '1'),
(7, 1, 'Hair Cut', 'Corte de pelo', 'La Coupe de cheveux', 'Corte de cabelo', '1787986758.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `superchild_category`
--

CREATE TABLE `superchild_category` (
  `superchild_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `child_category_id` int(11) NOT NULL,
  `en` varchar(50) NOT NULL,
  `es` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `pt` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superchild_category`
--

INSERT INTO `superchild_category` (`superchild_category_id`, `category_id`, `sub_category_id`, `child_category_id`, `en`, `es`, `fr`, `pt`, `status`) VALUES
(1, 3, 5, 5, 'Face Massage', 'Masaje facial', 'Massage du visage', 'Massagem Facial', '1'),
(2, 2, 3, 4, 'Squats', 'Sentadillas', 'Squats', 'Agachamentos', '1'),
(3, 1, 1, 6, 'Disco Party Makeup', 'Maquillaje de fiesta disco', 'Maquillage de soirée disco', 'Maquiagem De Discoteca', '1'),
(4, 1, 1, 1, 'indian bridal makeup', 'maquillaje de novia indio', 'maquillage de mariée indienne', 'maquiagem de noiva indiana', '1'),
(5, 3, 6, 7, 'Mind Relaxing Yoga', 'Yoga relajante mental', 'Yoga relaxant', 'Yoga Relaxante da Mente', '1'),
(6, 1, 7, 8, 'Buzz cut', 'Buzz cut', 'Buzz cut', 'Buzz cut', '1');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `user_id`, `token_id`) VALUES
(206, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(207, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(208, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(209, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(210, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(211, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(212, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(213, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(214, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(215, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(216, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(217, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(218, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(219, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(220, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(221, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(222, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(223, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(224, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(225, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(226, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(227, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(228, NULL, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(229, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(230, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(231, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(232, 4, 'fFt4JfUuCoc:APA91bHPXtIXmpgznKyV2xsmVS1y-aWbDK60de'),
(233, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(234, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(235, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(236, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(237, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(238, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(239, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(240, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(241, 4, 'ccavvyV2ieY:APA91bGsJWPFFVtt37g9swVfO_GgRTWtGqgFtG'),
(242, NULL, 'cqpQeJWpeyI:APA91bGrnOpBETuJnPW_wbQQm88jo3iSThbu_4'),
(243, NULL, 'cqpQeJWpeyI:APA91bGrnOpBETuJnPW_wbQQm88jo3iSThbu_4'),
(244, NULL, 'fxBOVS1FukI:APA91bFwnjysC6CyVpUGYtzdq-hhoEnGwICA_w');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(20) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `lattitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `source` enum('self','google','facebook') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `user_name`, `email`, `location`, `lattitude`, `longitude`, `mobile`, `image_url`, `password`, `source`, `created_at`) VALUES
(1, 'RjUQnKNSve', 'Rohan Singh', 'rohan.designoweb@gmail.com', 'New Delhi', '', '', '9899246225', '917957788.png', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'self', '2020-04-06 06:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_email_verify`
--

CREATE TABLE `user_email_verify` (
  `id` int(11) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `activationcode` varchar(20) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_email_verify`
--

INSERT INTO `user_email_verify` (`id`, `user_id`, `activationcode`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'icP2HbGDsh', 'Active', '2020-02-26 00:44:17', '2020-02-26 00:44:17'),
(2, '1', 'EhFNC1kcin', 'Active', '2020-02-26 00:49:40', '2020-02-26 00:49:40'),
(3, '1', 'Qlt7FUSHhC', 'Active', '2020-02-26 00:57:52', '2020-02-26 00:57:52'),
(4, '1', 'yYq4XhFI9r', 'Active', '2020-02-26 01:03:28', '2020-02-26 01:03:28'),
(5, '6', '30E2tpVX6v', 'Inactive', '2020-02-27 02:35:24', '2020-02-27 02:35:24'),
(6, '12', 'wJPhUpxfOv', 'Inactive', '2020-02-29 04:54:54', '2020-02-29 04:54:54'),
(7, '12', 'qJIe9WrPa0', 'Inactive', '2020-02-29 04:55:07', '2020-02-29 04:55:07'),
(8, '12', '27pY9TkHqd', 'Inactive', '2020-02-29 05:27:25', '2020-02-29 05:27:25'),
(9, '19', 'JDrmuGyxEA', 'Inactive', '2020-03-03 22:10:24', '2020-03-03 22:10:24'),
(10, '29', 'zKZgb7Ms9q', 'Inactive', '2020-03-12 00:48:22', '2020-03-12 00:48:22'),
(11, '29', 'EOl158TRxK', 'Inactive', '2020-03-12 00:48:57', '2020-03-12 00:48:57'),
(12, '29', 'Dsat8Beq4S', 'Inactive', '2020-03-12 00:50:50', '2020-03-12 00:50:50'),
(13, '29', 'gjcIHu2tRf', 'Inactive', '2020-03-12 00:52:51', '2020-03-12 00:52:51'),
(14, '29', 'dz5NmabXZi', 'Active', '2020-03-12 00:54:06', '2020-03-12 00:54:06'),
(15, '27', 'HyGaUqOF6f', 'Active', '2020-03-16 05:40:54', '2020-03-16 05:40:54'),
(16, '30', 'lm3GsjO019', 'Inactive', '2020-03-16 23:00:50', '2020-03-16 23:00:50'),
(17, '27', '5tTXvi098e', 'Active', '2020-03-17 02:54:13', '2020-03-17 02:54:13'),
(18, '30', 'dbvnCj2pEG', 'Inactive', '2020-03-18 04:18:06', '2020-03-18 04:18:06'),
(19, '33', '2di6l49N0c', 'Active', '2020-03-18 04:19:53', '2020-03-18 04:19:53'),
(20, '2', 'ojhPUSb7yu', 'Inactive', '2020-03-18 05:06:16', '2020-03-18 05:06:16'),
(21, '2', 'M86LzVojvN', 'Inactive', '2020-03-18 05:10:10', '2020-03-18 05:10:10'),
(22, '30', '4oashixYp5', 'Inactive', '2020-03-18 05:22:39', '2020-03-18 05:22:39'),
(23, '27', 'lMR13ZK84F', 'Active', '2020-03-18 05:22:45', '2020-03-18 05:22:45'),
(24, '27', 'Soihu0fU8m', 'Active', '2020-03-19 00:43:58', '2020-03-19 00:43:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `child_category`
--
ALTER TABLE `child_category`
  ADD PRIMARY KEY (`child_category_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `faq_desc`
--
ALTER TABLE `faq_desc`
  ADD PRIMARY KEY (`faq_desc_id`);

--
-- Indexes for table `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages_data`
--
ALTER TABLE `languages_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `saloon`
--
ALTER TABLE `saloon`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_category`
--
ALTER TABLE `service_category`
  ADD PRIMARY KEY (`service_category_id`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `superchild_category`
--
ALTER TABLE `superchild_category`
  ADD PRIMARY KEY (`superchild_category_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_email_verify`
--
ALTER TABLE `user_email_verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `child_category`
--
ALTER TABLE `child_category`
  MODIFY `child_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq_desc`
--
ALTER TABLE `faq_desc`
  MODIFY `faq_desc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `languages_data`
--
ALTER TABLE `languages_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saloon`
--
ALTER TABLE `saloon`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service_category`
--
ALTER TABLE `service_category`
  MODIFY `service_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `superchild_category`
--
ALTER TABLE `superchild_category`
  MODIFY `superchild_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_email_verify`
--
ALTER TABLE `user_email_verify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
