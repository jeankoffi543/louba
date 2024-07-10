-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table louba.about_us
CREATE TABLE IF NOT EXISTS `about_us` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.actuality
CREATE TABLE IF NOT EXISTS `actuality` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tagdur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagebg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'UNKNOW',
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_publish` date DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.admin_actions
CREATE TABLE IF NOT EXISTS `admin_actions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `habilete_id` bigint unsigned NOT NULL,
  `id_demande` bigint unsigned NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_actions_habilete_id_foreign` (`habilete_id`),
  KEY `admin_actions_id_demande_foreign` (`id_demande`),
  CONSTRAINT `admin_actions_habilete_id_foreign` FOREIGN KEY (`habilete_id`) REFERENCES `habiletes` (`id`),
  CONSTRAINT `admin_actions_id_demande_foreign` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.client
CREATE TABLE IF NOT EXISTS `client` (
  `nom_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_naissance_client` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_oni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `actif_client` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.closed_centers
CREATE TABLE IF NOT EXISTS `closed_centers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_point_enrolement` bigint unsigned NOT NULL,
  `closed_date` datetime NOT NULL,
  `raison` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `closed_centers_id_point_enrolement_foreign` (`id_point_enrolement`),
  CONSTRAINT `closed_centers_id_point_enrolement_foreign` FOREIGN KEY (`id_point_enrolement`) REFERENCES `point_enrolement` (`id_pe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.contenu_site
CREATE TABLE IF NOT EXISTS `contenu_site` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tagdur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paragraphe1` text COLLATE utf8mb4_unicode_ci,
  `paragraphe2` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.demande
CREATE TABLE IF NOT EXISTS `demande` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_point_enrolement` bigint unsigned NOT NULL,
  `id_sender` bigint unsigned NOT NULL,
  `id_client` bigint unsigned NOT NULL,
  `date_rdv_demande` datetime NOT NULL,
  `date_traitement_demande` datetime DEFAULT NULL,
  `status_demande` enum('NEW','REJECTED','PENDING_PAY','CLOSED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NEW',
  `raison_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_request` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_product` bigint unsigned NOT NULL,
  `id_service` bigint unsigned NOT NULL,
  `document_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_demande` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `demand_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recepice_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paiement_date` datetime DEFAULT NULL,
  `personal_number` int DEFAULT NULL,
  `birth_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` int DEFAULT NULL,
  `complexion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `particular_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hair_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eye_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skin_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cni` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_recu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demande_id_point_enrolement_foreign` (`id_point_enrolement`),
  KEY `demande_id_client_foreign` (`id_client`),
  KEY `demande_id_sender_foreign` (`id_sender`),
  KEY `demande_id_product_foreign` (`id_product`),
  KEY `demande_id_service_foreign` (`id_service`),
  CONSTRAINT `demande_id_client_foreign` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  CONSTRAINT `demande_id_point_enrolement_foreign` FOREIGN KEY (`id_point_enrolement`) REFERENCES `point_enrolement` (`id_pe`),
  CONSTRAINT `demande_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  CONSTRAINT `demande_id_sender_foreign` FOREIGN KEY (`id_sender`) REFERENCES `client` (`id`),
  CONSTRAINT `demande_id_service_foreign` FOREIGN KEY (`id_service`) REFERENCES `service` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.equipe
CREATE TABLE IF NOT EXISTS `equipe` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.habiletes
CREATE TABLE IF NOT EXISTS `habiletes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.habilete_permission
CREATE TABLE IF NOT EXISTS `habilete_permission` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `habilete_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `habilete_permission_habilete_id_foreign` (`habilete_id`),
  KEY `habilete_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `habilete_permission_habilete_id_foreign` FOREIGN KEY (`habilete_id`) REFERENCES `habiletes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `habilete_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.importation_document
CREATE TABLE IF NOT EXISTS `importation_document` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_register` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.index_traitement
CREATE TABLE IF NOT EXISTS `index_traitement` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `habilete_id` bigint NOT NULL,
  `id_demande` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_traitement_id_demande_foreign` (`id_demande`),
  CONSTRAINT `index_traitement_id_demande_foreign` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.paiement
CREATE TABLE IF NOT EXISTS `paiement` (
  `id_pay` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount_pay` int NOT NULL,
  `reference_pay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_pay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_client` int NOT NULL,
  `id_demande` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cpm_currency` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cel_phone_num` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpm_phone_prefixe` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_pay`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.partners
CREATE TABLE IF NOT EXISTS `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `path` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_libelle_unique` (`libelle`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tokenable_id` bigint DEFAULT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tokenable` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.point_enrolement
CREATE TABLE IF NOT EXISTS `point_enrolement` (
  `id_pe` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `capacite_maximale_jour_pe` int DEFAULT NULL,
  `id_creation_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_pe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pe`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.point_enrolement_products
CREATE TABLE IF NOT EXISTS `point_enrolement_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_point_enrolement` bigint unsigned NOT NULL,
  `id_product` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `point_enrolement_lien_type_document_id_point_enrolement_foreign` (`id_point_enrolement`),
  KEY `point_enrolement_lien_type_document_id_product_foreign` (`id_product`),
  CONSTRAINT `point_enrolement_lien_type_document_id_point_enrolement_foreign` FOREIGN KEY (`id_point_enrolement`) REFERENCES `point_enrolement` (`id_pe`),
  CONSTRAINT `point_enrolement_lien_type_document_id_product_foreign` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `prix` int DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `flow_enable` tinyint(1) NOT NULL DEFAULT '0',
  `select_service_is_required` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Il faut choisir le service pour la prise de rendez-vous',
  `form_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.public_holidays
CREATE TABLE IF NOT EXISTS `public_holidays` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_point_enrolement` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `public_holidays_id_point_enrolement_foreign` (`id_point_enrolement`),
  CONSTRAINT `public_holidays_id_point_enrolement_foreign` FOREIGN KEY (`id_point_enrolement`) REFERENCES `point_enrolement` (`id_pe`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.reclammation
CREATE TABLE IF NOT EXISTS `reclammation` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sujet` text COLLATE utf8mb4_unicode_ci,
  `message` text COLLATE utf8mb4_unicode_ci,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `traiter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `date_register` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_traitement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_role` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.service
CREATE TABLE IF NOT EXISTS `service` (
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT '1',
  `is_disable` tinyint(1) DEFAULT '0',
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `visible_in_flow` tinyint(1) NOT NULL DEFAULT '1',
  `habiletes` json DEFAULT NULL,
  `habilete_position` int NOT NULL DEFAULT '0',
  `circuit_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '#f8f9fa',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.slider
CREATE TABLE IF NOT EXISTS `slider` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tagdur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_mise_a_jour` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_bg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.slider_buttons
CREATE TABLE IF NOT EXISTS `slider_buttons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slider_id` bigint unsigned NOT NULL,
  `button_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_background_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `have_external_link` tinyint(1) DEFAULT '0',
  `redirect_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slider_buttons_slider_id_foreign` (`slider_id`),
  CONSTRAINT `slider_buttons_slider_id_foreign` FOREIGN KEY (`slider_id`) REFERENCES `slider` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.socials
CREATE TABLE IF NOT EXISTS `socials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` enum('facebook','instagram','twitter','snapshat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table louba.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` int NOT NULL,
  `id_point_enrolement` int NOT NULL,
  `actif` int NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `habilete_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_habilete_id_foreign` (`habilete_id`),
  CONSTRAINT `users_habilete_id_foreign` FOREIGN KEY (`habilete_id`) REFERENCES `habiletes` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
