-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: estrescero
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,1,'no pues duerme','2025-03-26 03:24:23','2025-03-26 03:24:23'),(2,1,2,'ooaaa','2025-03-26 03:28:36','2025-03-26 03:28:36'),(3,1,2,'no quiero','2025-03-26 03:28:59','2025-03-26 03:28:59'),(4,7,3,'que rico','2025-03-30 09:28:18','2025-03-30 09:28:18');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ejercicios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duracion` int NOT NULL,
  `icono` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ejercicios`
--

LOCK TABLES `ejercicios` WRITE;
/*!40000 ALTER TABLE `ejercicios` DISABLE KEYS */;
INSERT INTO `ejercicios` VALUES (3,'Día 1- Reto de Yoga para Principiantes | Aprende yoga en 7 clases de iniciación | Anabel Otero','El video \"Día 1 - Reto de Yoga para Principiantes\" de Anabel Otero es la primera clase de un programa de 7 días para aprender yoga desde cero. En esta sesión, se enseñan posturas básicas, técnicas de respiración y alineación para desarrollar flexibilidad y bienestar.','Yoga',30,'fas fa-yoga','https://www.youtube.com/watch?v=HZn7SwU-lN8&ab_channel=AnabelOtero','ejercicios/ON5KZMpdaycTLBKfhDngHbj4TgymyR26v8RIL2Hs.jpg',0,'2025-03-30 04:59:01','2025-03-30 04:59:01'),(4,'Día 2- Reto de Yoga para Principiantes | Construye tus primeras posturas de pie | Anabel Otero','El video \"Día 2 - Reto de Yoga para Principiantes | Construye tus primeras posturas de pie\" de Anabel Otero es la segunda clase de un programa de 7 días diseñado para introducir a los principiantes en la práctica del yoga. En esta sesión, Anabel guía a los participantes a través de las primeras posturas de pie, enfocándose en la correcta alineación y técnica para desarrollar fuerza y equilibrio. La clase tiene una duración aproximada de 30 minutos y está estructurada para ser accesible a quienes no tienen experiencia previa en yoga.','Yoga',32,'fas fa-meditation','https://www.youtube.com/watch?v=kNavJY0EBbU&ab_channel=AnabelOtero','ejercicios/ArgoZKYJOb2v0X9TDwjs7EtX45ldgkQSIaG5zjZc.jpg',1,'2025-03-30 05:01:58','2025-03-30 05:01:58');
/*!40000 ALTER TABLE `ejercicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emotional_entries`
--

DROP TABLE IF EXISTS `emotional_entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emotional_entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `date` date NOT NULL,
  `stress_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emotion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `emotional_entries_user_id_foreign` (`user_id`),
  CONSTRAINT `emotional_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emotional_entries`
--

LOCK TABLES `emotional_entries` WRITE;
/*!40000 ALTER TABLE `emotional_entries` DISABLE KEYS */;
INSERT INTO `emotional_entries` VALUES (1,3,'2025-03-25','Bajo','Feliz','Fue un buen día salí con mi hermana','2025-03-26 05:38:45','2025-03-26 05:38:45'),(2,3,'2025-03-25','Medio','Tristeza','Murió mi perro','2025-03-26 05:39:29','2025-03-26 05:39:29'),(3,3,'2025-03-29','Alto','Tristeza','Muchos proyectos','2025-03-30 05:03:19','2025-03-30 05:03:19'),(4,7,'2025-03-29','Medio','Feliz','Hoy me la pase muy bien','2025-03-30 09:26:32','2025-03-30 09:26:32');
/*!40000 ALTER TABLE `emotional_entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_03_25_210851_create_posts_table',2),(5,'2025_03_25_210903_create_comments_table',2),(6,'2025_03_25_213937_add_avatar_to_users_table',3),(7,'2025_03_25_233355_create_emotional_entries_table',4),(8,'2025_03_27_140612_add_admin_and_active_to_users_table',5),(9,'2025_03_27_161035_create_recursos_table',6),(10,'2025_03_27_213712_create_ejercicios_table',7),(11,'2025_03_28_230952_add_video_url_to_ejercicios_table',8),(12,'2025_03_28_234913_add_imagen_to_ejercicios_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,3,'Odio mis dias','¿Por qué odio mis días? ¿no lo entiendo que debería hacer? no encuentro motivación','2025-03-26 03:22:52','2025-03-26 03:22:52'),(2,1,'Ya vamonos al cielo','Porque odio la vida. Pasen tip','2025-03-26 03:26:48','2025-03-26 03:26:48'),(3,3,'triste','comer pizza me quita lo triste mándenme una a mi casaaaa','2025-03-26 04:16:43','2025-03-26 04:16:43'),(4,3,'Holaa','Holaaa','2025-03-30 04:50:09','2025-03-30 04:50:09'),(5,7,'Estres Academico','Tips para el estres en la escula, los leo chat','2025-03-30 09:27:55','2025-03-30 09:27:55');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recursos`
--

DROP TABLE IF EXISTS `recursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recursos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recursos`
--

LOCK TABLES `recursos` WRITE;
/*!40000 ALTER TABLE `recursos` DISABLE KEYS */;
INSERT INTO `recursos` VALUES (1,'Manejo del Estrés para una Vida Saludable','Aprende estrategias efectivas para reducir el estrés y mejorar tu bienestar físico y mental. Descubre cómo la alimentación, el ejercicio y la relajación pueden ayudarte a controlar el estrés diario.','El estrés es una respuesta natural del cuerpo, pero un nivel elevado y constante puede afectar la salud física y mental. Aquí te compartimos algunas estrategias para reducirlo:\r\n\r\nEjercicio regular: Realizar actividad física libera endorfinas, lo que ayuda a reducir el estrés y mejorar el estado de ánimo.\r\n\r\nTécnicas de respiración y meditación: La meditación mindfulness y la respiración profunda pueden disminuir la ansiedad y mejorar la concentración.\r\n\r\nAlimentación balanceada: Consumir frutas, verduras y alimentos ricos en magnesio ayuda a reducir la tensión y mejorar el bienestar.\r\n\r\nOrganización del tiempo: Priorizar tareas y establecer horarios evita la acumulación de estrés por carga laboral o académica.\r\n\r\nDescanso adecuado: Dormir entre 7 y 9 horas por noche permite recuperar la energía y mejorar la respuesta del cuerpo ante situaciones estresantes.','recursos/i7TaWEkVPaf5qxUPzjrmbg6W776M5et2X0q7qtlB.jpg','2025-03-27 22:42:36','2025-03-27 22:42:36'),(2,'Estrategias Efectivas para Combatir el Estrés','Descubre cómo reducir el estrés con técnicas simples y efectivas que puedes aplicar en tu día a día. Aprende a gestionar la presión y mejorar tu bienestar.','El estrés prolongado puede afectar tu salud, causando fatiga, ansiedad y problemas físicos. Para controlarlo, prueba estas estrategias:\r\n\r\n🔹 Ejercicio físico: Caminar, correr o practicar yoga ayuda a liberar tensiones.\r\n🔹 Técnicas de relajación: Practica respiración profunda y meditación durante 5-10 minutos al día.\r\n🔹 Tiempo de calidad: Dedica tiempo a actividades que disfrutes, como leer, escuchar música o pasar tiempo con amigos.\r\n🔹 Buena alimentación: Evita el exceso de cafeína y azúcar, prioriza alimentos nutritivos.\r\n🔹 Gestión del tiempo: Organiza tus tareas y establece prioridades para evitar la sobrecarga.','recursos/tRPBc08l4LufsOty5zuhPBBN1xo1mG0YoGnt0JBe.jpg','2025-03-28 02:20:21','2025-03-28 02:20:21'),(4,'hola','holaa','asd','recursos/BdkQQNawhQ3X0Y8JBjxA18mNRVllzQm2m5Vqx3rQ.jpg','2025-03-30 08:23:39','2025-03-30 08:23:39');
/*!40000 ALTER TABLE `recursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('iqVUZ65R7tDN2eMg20NntDdlapXVfSCYCeitWi5J',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoic2VEdFBJaHNNcHpqR0IzMDNRcDVHeThMSEhBR3dJYnRlZjFxcE4xSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1743305440),('MbYi9H4Y2hTwAldjTNC7BQU7nBlbqEPRmMUQvCIe',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlN2Ukh4ZXczWkJBYjNjMHVodnRsY0NNOHBRMlRGekt4ajlnUkc4QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=',1743299979);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'jafet','123455678@gmail.com',NULL,'$2y$12$Vc.TcQ/5ma1KTijky.IRU.AUKWjM0AygVAdm9WO3BOfgQH6YIogyG',NULL,'2025-03-25 04:28:18','2025-03-30 08:23:01','avatars/2Wejh3RYZvSDF9FYQvXsZsnvUlmMtNS3xLRG3ttw.png',0,1),(2,'jose','jose@gmail.com',NULL,'$2y$12$oTXIIkSIl6JGunI1X6ypEeRLIapMGLG/3Cr1s3kCyeftImH14/f2O',NULL,'2025-03-25 06:20:57','2025-03-28 03:13:35',NULL,0,1),(3,'Kevin Dominguez','1234@gmail.com',NULL,'$2y$12$xAkG1XBP.UxHgjUTUK8ci.797tA/jAjrA3zohFwiUlX4HT29ara9G',NULL,'2025-03-25 06:34:52','2025-03-28 03:15:09','avatars/tMgNfEieXqvJSkgkvHB7vc053sz6JBLKXeM7MLNl.png',0,1),(4,'jafet','jafet@gmail.com',NULL,'$2y$12$wGUMRjlxzma8ggdlZzm4q.x3/oFk2jbG29ovkEw3bvAOoUkHfkL8.',NULL,'2025-03-26 03:59:23','2025-03-26 04:05:37','avatars/ipIlBrAco6bcYaOSb9K1wPpPaiMrTpTOmdbXUvz8.png',0,1),(5,'Majo','majo@gmail.com',NULL,'$2y$12$0HxY2UkpZa5rDFLpjhl3F.8eG0yL.9PocDOSYneRLvl2Br1.LZJte',NULL,'2025-03-26 04:13:23','2025-03-26 04:14:27','avatars/4ELs3OPOS4mkNmcpp9qOJ89J87b1MtysuoI8lzjx.png',0,1),(6,'Administrador','admin@admin.com',NULL,'$2y$12$f9cseOu491EHtqsYZep8euqrUOEscUCKQWWwhc2tby7KlSIvQAdmC',NULL,'2025-03-27 20:25:14','2025-03-27 20:25:14',NULL,1,1),(7,'Pedro','Pedro@gmail.com',NULL,'$2y$12$0C9GiAoGQFlShRXIdVhoSesYqotYTFPaI11HrgL.MJHwKYJhE.FBy',NULL,'2025-03-30 09:24:26','2025-03-30 09:30:05','avatars/vvvbZEYYJLT3H9HFoAefTOoLseddJzEkeZLyMTnz.jpg',0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-05 16:04:32
