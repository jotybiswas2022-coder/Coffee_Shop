-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2026 at 06:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Coffee', '2026-03-09 11:53:41', '2026-03-09 11:53:41'),
(3, 'Cold Coffee', '2026-03-09 11:53:54', '2026-03-09 13:16:15'),
(4, 'Tea & Drinks', '2026-03-09 11:54:24', '2026-03-10 04:23:08'),
(5, 'Refreshers', '2026-03-09 11:54:44', '2026-03-10 01:25:58'),
(6, 'Bakery & Pastry', '2026-03-09 11:54:54', '2026-03-09 11:54:54'),
(7, 'Snacks', '2026-03-09 11:55:05', '2026-03-10 01:26:06'),
(8, 'Desserts', '2026-03-09 11:55:16', '2026-03-09 11:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Joty Biswas', 'jotybiswas0199@gmail.com', 'hgh', '2026-03-10 02:15:30', '2026-03-10 02:15:30'),
(2, 'Dev Paglu', 'jotybiswas0199@gmail.com', 'ফগফহ', '2026-03-10 04:12:14', '2026-03-10 04:12:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_21_173017_create_categories_table', 1),
(5, '2026_01_24_173801_create_products_table', 1),
(6, '2026_01_27_150926_create_carts_table', 1),
(7, '2026_01_31_155048_create_settings_table', 1),
(8, '2026_02_04_055853_create_orders_table', 1),
(9, '2026_02_04_055926_create_order_details_table', 1),
(10, '2026_02_19_092000_create_contacts_table', 1),
(11, '2026_02_25_145317_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `product_price_after_discount` decimal(15,2) NOT NULL,
  `delivery_charge` decimal(15,2) NOT NULL,
  `tax` decimal(15,2) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `firstname`, `lastname`, `email`, `phone`, `address`, `product_price_after_discount`, `delivery_charge`, `tax`, `total_price`, `status`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, 1, 'Joty', 'Biswas', 'jotybiswas0199@gmail.com', '01403107510', '22/2, Kabi Nazrul Sarak, west Tootpara', 690.00, 120.00, 13.80, 823.80, 'delivered', 'cod', '2026-03-10 05:19:14', '2026-03-10 05:20:37'),
(2, 1, 'Joty', 'Biswas', 'jotybiswas0199@gmail.com', '01403107510', '22/2, Kabi Nazrul Sarak, west Tootpara', 435.00, 110.00, 8.70, 553.70, 'delivered', 'cod', '2026-03-10 06:05:43', '2026-03-10 06:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Processing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'Iced Mocha', '1', '200.00', 'delivered', '2026-03-10 05:19:14', '2026-03-10 05:20:37'),
(2, 1, 1, 'Espresso', '3', '110.00', 'delivered', '2026-03-10 05:19:14', '2026-03-10 05:20:37'),
(3, 1, 15, 'Hot Chocolate', '1', '160.00', 'delivered', '2026-03-10 05:19:14', '2026-03-10 05:20:37'),
(4, 2, 19, 'Chocolate Milkshake', '3', '145.00', 'delivered', '2026-03-10 06:05:43', '2026-03-10 06:06:04'),
(5, 2, 34, 'Ice Cream', '3', '99.00', 'delivered', '2026-03-10 06:05:43', '2026-03-10 06:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `base_price` decimal(15,2) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `discount` double NOT NULL,
  `stock` decimal(15,2) NOT NULL,
  `details` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `base_price`, `price`, `discount`, `stock`, `details`, `status`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Espresso', 2, 80.00, 110.00, 0, 97.00, '<p><strong>The purest and most intense form of coffee, our Espresso is a carefully extracted shot of finely ground premium coffee beans brewed under high pressure. This small but mighty cup delivers a rich, concentrated burst of flavor with a velvety crema on top. Expect bold, deep notes of dark chocolate, roasted caramel, and a hint of smokiness that lingers on your palate. It\'s the foundation of every great coffee drink and the ultimate choice for true coffee purists who crave strength and complexity in every sip.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Single or double shot of freshly ground and extracted espresso</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served in a traditional 2oz demitasse cup with a small glass of water on the side to cleanse the palate before the first sip.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;High (concentrated)</strong></p>\r\n<p><strong>Taste Profile:</strong></p>\r\n<ul>\r\n<li><strong>Body:&nbsp;Full and thick</strong></li>\r\n<li><strong>Acidity:&nbsp;Medium</strong></li>\r\n<li><strong>Bitterness:&nbsp;Bold</strong></li>\r\n<li><strong>Finish:&nbsp;Smooth with lingering roasted notes</strong></li>\r\n</ul>\r\n<p><strong>Best Paired With:&nbsp;Biscotti, dark chocolate, or a classic cheesecake.</strong></p>', 1, 'product/cxJRaPcRTBneiykQwOZjWX0olUh2mdbHYRRKmwtj.jpg', '2026-03-10 00:55:30', '2026-03-10 05:20:24'),
(2, 'Americano', 2, 100.00, 130.00, 0, 100.00, '<p><strong>A bold and smooth classic crafted by pulling rich espresso shots and diluting them with hot water. The Americano delivers the full depth and intensity of espresso with a lighter, more approachable body. Made with premium quality coffee beans, each cup offers a clean, robust flavor with subtle notes of dark chocolate and a slightly nutty finish. Perfect for those who appreciate the pure, unadulterated taste of real coffee without any milk or cream.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso</strong></li>\r\n<li><strong>Hot filtered water</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served hot in a standard 8oz ceramic cup. Can also be customized as an Iced Americano upon request.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium-High</strong></p>\r\n<p><strong>Best Paired With:&nbsp;Croissant, Bagel, or any light pastry.</strong></p>', 1, 'product/H2FPyKwxuXSdIOkfacgOKDlO5vKXnLf8A9byDONW.jpg', '2026-03-10 01:06:09', '2026-03-10 01:06:09'),
(3, 'Cappuccino', 2, 110.00, 150.00, 0, 100.00, '<p><strong>A timeless Italian classic that perfectly balances the boldness of espresso with the creamy sweetness of steamed milk and a thick, luxurious layer of velvety microfoam on top. Our Cappuccino is crafted with precision &mdash; one-third rich espresso, one-third silky steamed milk, and one-third dense, frothy foam that creates a heavenly cloud-like texture in every sip. The result is a harmonious blend of strong coffee flavor softened by the natural sweetness of perfectly textured milk. Each cup is finished with a beautiful latte art and an optional dusting of cocoa powder or cinnamon on top for an extra touch of elegance.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso</strong></li>\r\n<li><strong>Steamed whole milk</strong></li>\r\n<li><strong>Thick layer of microfoam</strong></li>\r\n<li><strong>Optional: cocoa powder or cinnamon dusting</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served hot in a 6oz wide-brimmed ceramic cup, showcasing the perfect foam layer and latte art. Also available as an Iced Cappuccino.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium-High</strong></p>\r\n<p><strong>Taste Profile:</strong></p>\r\n<ul>\r\n<li><strong>Body:&nbsp;Medium and creamy</strong></li>\r\n<li><strong>Acidity:&nbsp;Low-Medium</strong></li>\r\n<li><strong>Sweetness:&nbsp;Naturally mild</strong></li>\r\n<li><strong>Finish:&nbsp;Smooth, warm, and comforting</strong></li>\r\n</ul>\r\n<p><strong>Best Paired With:&nbsp;Chocolate muffin, cinnamon roll, banana bread, or a butter croissant.</strong></p>', 1, 'product/kNaPlH3g9XOJDfjkuKUCzm4RqfcJxqZfkkvBPOkA.webp', '2026-03-10 01:08:09', '2026-03-10 01:08:09'),
(4, 'Latte', 2, 120.00, 160.00, 0, 100.00, '<p>The ultimate smooth and creamy coffee experience for those who love a milder, milk-forward drink without sacrificing the rich essence of espresso. Our Latte is expertly crafted by combining a double shot of bold espresso with generous amounts of perfectly steamed milk, creating a silky, velvety texture that glides effortlessly across your palate. Topped with a thin layer of delicate microfoam and adorned with elegant latte art, this drink is as beautiful as it is delicious. The espresso provides a subtle coffee backbone while the steamed milk brings a natural sweetness and luxuriously smooth finish. A comforting, caf&eacute;-style classic that feels like a warm hug in a cup.</p>\r\n<p>Ingredients:</p>\r\n<ul>\r\n<li>Double shot of freshly pulled espresso</li>\r\n<li>Steamed whole milk (majority of the drink)</li>\r\n<li>Thin layer of microfoam on top</li>\r\n<li>Optional: flavored syrups (vanilla, caramel, hazelnut)</li>\r\n</ul>\r\n<p>Serving Style:<br />Served hot in a 10-12oz tall ceramic cup or glass, beautifully finished with signature latte art. Also available as an Iced Latte &mdash; served over ice in a clear glass to showcase the stunning layered effect.</p>', 1, 'product/gWPECVirE78fxS2gfYGDvUdCkedZ98fRoPGZtZ47.jpg', '2026-03-10 01:09:41', '2026-03-10 06:03:25'),
(5, 'Mocha', 2, 130.00, 180.00, 0, 100.00, '<p><strong>The perfect marriage of rich espresso and indulgent chocolate, our Mocha is a heavenly treat for coffee lovers with a sweet tooth. This decadent drink combines the bold intensity of freshly pulled espresso with premium dark chocolate sauce, velvety steamed milk, and a generous crown of whipped cream on top. Every sip delivers a luxurious blend of deep coffee flavor and smooth, bittersweet chocolate goodness that melts on your tongue. Finished with a beautiful drizzle of chocolate sauce and optional chocolate shavings, this drink is as Instagram-worthy as it is delicious. It\'s essentially a dessert and coffee combined into one irresistible cup of happiness.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso</strong></li>\r\n<li><strong>Premium dark chocolate sauce</strong></li>\r\n<li><strong>Steamed whole milk</strong></li>\r\n<li><strong>Fresh whipped cream topping</strong></li>\r\n<li><strong>Chocolate drizzle</strong></li>\r\n<li><strong>Optional: chocolate shavings or cocoa powder dusting</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served hot in a 10-12oz ceramic cup or clear glass mug to showcase the beautiful layers, topped with a mountain of whipped cream and chocolate drizzle. Also available as an Iced Mocha &mdash; served cold over ice with whipped cream, perfect for warm days when you crave something sweet and refreshing.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium</strong></p>', 1, 'product/pIshJDzRbjdDYgJp6olG8QIbPlq8iCrnfqOndCmC.jpg', '2026-03-10 01:12:42', '2026-03-10 01:12:42'),
(6, 'Flat White', 2, 120.00, 160.00, 0, 100.00, '<p><strong>Born in the coffee culture of Australia and New Zealand, the Flat White is the sophisticated, no-nonsense cousin of the Latte. This refined drink is all about showcasing the true essence of espresso while maintaining a smooth, velvety texture that makes every sip an absolute delight. Crafted with a double ristretto shot &mdash; a shorter, more concentrated extraction of espresso &mdash; blended with perfectly steamed milk that is textured to a silky, micro-foam consistency without the thick frothy layer found in a Cappuccino. The result is a strong yet incredibly smooth coffee experience where the espresso takes center stage, complemented by the natural creaminess of the milk rather than being overpowered by it. The Flat White is smaller in volume but bigger in flavor intensity, making it the ideal choice for those who want a bolder coffee experience with a creamy, luxurious mouthfeel. Each cup is finished with minimal, elegant latte art that reflects the precision and craftsmanship behind this beautifully balanced drink.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double ristretto shot of freshly extracted espresso</strong></li>\r\n<li><strong>Silky steamed whole milk with velvety micro-foam</strong></li>\r\n<li><strong>No thick foam layer &mdash; smooth and flat finish</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served hot in a smaller 5-6oz ceramic tulip cup, emphasizing the stronger coffee-to-milk ratio and showcasing the beautiful thin layer of micro-foam with delicate latte art. Also available as an Iced Flat White &mdash; poured over ice for a refreshing yet bold coffee experience.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium-High</strong></p>', 1, 'product/710bjf5bDmV1YwJiYRlBIqatnoqr0elG3kXT5u8W.jpg', '2026-03-10 01:13:39', '2026-03-10 01:13:39'),
(7, 'Iced Latte', 3, 130.00, 170.00, 0, 100.00, '<p><strong>The ultimate refreshing coffee experience for warm days or whenever you crave something cool and smooth. Our Iced Latte is a beautifully crafted combination of bold espresso shots poured over a generous amount of fresh ice and topped with cold, creamy milk that cascades down creating stunning natural layers before blending into a perfectly balanced drink. Unlike its hot counterpart, the Iced Latte offers a crisp, invigorating coffee experience that awakens your senses while delivering the same smooth, milk-forward taste you love. The espresso shines through with its rich, aromatic depth, while the chilled milk provides a refreshing, creamy sweetness that makes this drink incredibly easy to sip and enjoy. Served in a clear glass to showcase the gorgeous gradient of espresso and milk, it\'s a visually stunning drink that tastes as good as it looks. Perfect for on-the-go moments, afternoon pick-me-ups, or simply when you want to treat yourself to a cool, caf&eacute;-style indulgence.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso</strong></li>\r\n<li><strong>Fresh filtered ice cubes</strong></li>\r\n<li><strong>Cold whole milk</strong></li>\r\n<li><strong>Optional: flavored syrups for added sweetness</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served in a tall 12-14oz clear glass filled with fresh ice, allowing you to watch the beautiful swirl of espresso and milk come together. Comes with a reusable straw for easy sipping. Can be stirred before drinking to blend the layers or enjoyed layered for a gradual flavor experience &mdash; strong coffee first, creamy milk finish.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium</strong></p>', 1, 'product/ZpCRVslivVLvgWKbfra0jJQXb2nzPcgoAbhnpEfE.jpg', '2026-03-10 01:15:11', '2026-03-10 01:15:11'),
(8, 'Cold Brew', 3, 140.00, 190.00, 0, 100.00, '<p><strong>The smoothest, most refreshing coffee experience you\'ll ever taste. Our Cold Brew is a labor of love &mdash; crafted by steeping coarsely ground premium coffee beans in cold, filtered water for an extended period of 12-24 hours. This slow, patient extraction process results in a remarkably smooth, naturally sweet, and incredibly low-acidity coffee concentrate that\'s then served over ice for the ultimate refreshing experience. Unlike traditional iced coffee, which is simply hot coffee poured over ice, Cold Brew never touches heat, preserving the delicate flavor compounds and eliminating the harsh bitterness that heat extraction can create. The result is a clean, bold, and wonderfully smooth coffee with rich undertones of dark chocolate, subtle caramel sweetness, and a whisper of toasted nuts. Each sip is velvety, refreshing, and packed with a smooth caffeine punch that energizes without the jitters. It\'s coffee, but elevated to an entirely new level of coolness.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Coarsely ground premium Arabica coffee beans</strong></li>\r\n<li><strong>Cold filtered water (steeped for 12-24 hours)</strong></li>\r\n<li><strong>Fresh filtered ice cubes</strong></li>\r\n<li><strong>Optional: milk, cream, or flavored syrups</strong></li>\r\n</ul>', 1, 'product/hpN4cdTtdYDYgG0lU7OS6LHWbLQgVs1SHAoMGTJS.jpg', '2026-03-10 01:15:58', '2026-03-10 01:15:58'),
(9, 'Iced Americano', 3, 110.00, 150.00, 0, 100.00, '<p><strong>Bold, refreshing, and unapologetically strong &mdash; the Iced Americano is the ultimate no-frills coffee drink for purists who want the full intensity of espresso in a cool, refreshing format. This straightforward yet powerful drink is crafted by pulling rich, bold shots of freshly extracted espresso and pouring them over a glass filled with ice and cold filtered water. The result is a clean, crisp, and invigorating coffee experience that highlights the true character of the espresso without any milk or sweetness masking its authentic flavor. Unlike milky iced drinks, the Iced Americano delivers an honest, transparent taste &mdash; you\'ll experience every nuance of the espresso, from its deep roasted undertones to its subtle hints of dark chocolate and a slight smoky finish. It\'s refreshingly light on the palate yet satisfyingly bold in flavor, making it the perfect companion for hot summer days when you need a serious caffeine kick without the heaviness of milk-based drinks. Simple, elegant, and endlessly refreshing.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double or triple shot of freshly pulled espresso</strong></li>\r\n<li><strong>Cold filtered water</strong></li>\r\n<li><strong>Fresh filtered ice cubes</strong></li>\r\n<li><strong>Optional: simple syrup or flavored sweeteners</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served in a tall 12-14oz clear glass generously filled with fresh ice. The espresso is poured directly over the ice and cold water, creating a beautiful swirl as the rich, dark espresso blends with the crystal-clear water. Comes with a reusable straw for easy sipping. Best enjoyed stirred for even flavor distribution or sipped slowly to experience the gradual intensity.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;High</strong></p>', 1, 'product/UHuoXwhtTemN9M6iuadHDng2k9aHxhHA6eZC6xl9.jpg', '2026-03-10 01:16:45', '2026-03-10 01:16:45'),
(10, 'Iced Mocha', 3, 150.00, 200.00, 0, 99.00, '<p><strong>Indulgence meets refreshment in this irresistible chocolatey coffee creation. Our Iced Mocha is the ultimate treat for those who believe that coffee and chocolate are a match made in heaven. This decadent drink starts with bold, freshly pulled espresso shots that are blended with rich, velvety premium chocolate sauce, then poured over a generous amount of ice and combined with cold, creamy milk. The entire masterpiece is crowned with a glorious mountain of fresh whipped cream and finished with an artistic drizzle of chocolate sauce that cascades down the glass like a beautiful waterfall of sweetness. Every sip delivers an explosion of flavors &mdash; the deep, robust intensity of espresso perfectly balanced by the smooth, bittersweet richness of chocolate, all mellowed by the cool creaminess of milk. It\'s essentially a frozen dessert and a coffee combined into one utterly irresistible drink. Whether you\'re treating yourself on a hot afternoon, satisfying a chocolate craving, or simply need a delicious pick-me-up that feels like a reward, the Iced Mocha is your perfect companion.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso</strong></li>\r\n<li><strong>Premium dark chocolate sauce</strong></li>\r\n<li><strong>Cold whole milk</strong></li>\r\n<li><strong>Fresh filtered ice cubes</strong></li>\r\n<li><strong>Freshly whipped cream topping</strong></li>\r\n<li><strong>Chocolate drizzle garnish</strong></li>\r\n<li><strong>Optional: chocolate shavings or cocoa powder dusting</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served in a tall 14-16oz clear glass that beautifully showcases the stunning layers of chocolate, espresso, and milk swirling together beneath a fluffy cloud of whipped cream. The glass is drizzled with chocolate sauce both inside and on top for maximum visual appeal and chocolatey goodness in every sip. Comes with a reusable straw and a long spoon to scoop up all that delicious whipped cream.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium</strong></p>', 1, 'product/J3MTUyW9vvVIGOVFu2jrEj3RIqZhfCNkpkUjmVWt.jpg', '2026-03-10 01:18:54', '2026-03-10 05:20:24'),
(11, 'Frappe', 3, 160.00, 210.00, 0, 100.00, '<p><strong>The ultimate frozen coffee indulgence that blurs the line between a refreshing beverage and a decadent dessert. Our Frappe is a heavenly blended creation that combines bold espresso, ice, milk, and your choice of delicious flavors, all whipped together into a thick, creamy, slushy perfection that\'s impossibly smooth and endlessly satisfying. Unlike regular iced coffee drinks, the Frappe is fully blended, transforming simple ingredients into a frosty, milkshake-like treat that\'s rich, creamy, and absolutely irresistible. Each sip delivers an icy burst of coffee goodness with a luxuriously thick texture that coats your palate in pure bliss. Topped with a towering swirl of fresh whipped cream, a generous drizzle of your favorite sauce, and optional toppings, this drink is a showstopper both in looks and taste. Whether you\'re craving a mid-afternoon treat, a dessert replacement, or just something wonderfully refreshing and indulgent, the Frappe is your frozen ticket to coffee paradise.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Double shot of freshly pulled espresso (or frappe base)</strong></li>\r\n<li><strong>Whole milk</strong></li>\r\n<li><strong>Ice (blended smooth)</strong></li>\r\n<li><strong>Frappe base syrup for perfect consistency</strong></li>\r\n<li><strong>Flavored syrups (variety of options)</strong></li>\r\n<li><strong>Fresh whipped cream topping</strong></li>\r\n<li><strong>Drizzle and toppings of choice</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served in a tall 16oz clear plastic cup or signature frappe glass, showcasing the beautiful creamy texture and gorgeous layers. Topped with a mountain of freshly whipped cream that rises above the rim, finished with an artistic drizzle of sauce and optional toppings. Comes with a thick straw designed for sipping the blended goodness and a long spoon for enjoying every last bit of whipped cream and toppings.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Medium (can be customized)</strong></p>', 1, 'product/EHEXAqKNPzzSTNZnvkzu1MiGpXRGh65rqfUEEfVm.jpg', '2026-03-10 01:19:52', '2026-03-10 01:19:52'),
(12, 'Green Tea', 4, 80.00, 110.00, 0, 100.00, '<p><strong>A timeless, ancient elixir celebrated for centuries across Asian cultures for its delicate flavor, calming properties, and remarkable health benefits. Our Green Tea is sourced from premium tea leaves that are carefully harvested, gently steamed, and minimally processed to preserve their natural goodness, vibrant green color, and authentic taste. Each cup delivers a light, refreshing, and subtly grassy flavor with hints of earthiness, a touch of natural sweetness, and a clean, smooth finish that lingers pleasantly on your palate. Unlike bold coffee drinks, Green Tea offers a gentle, sustained energy boost without the jitters &mdash; thanks to its unique combination of moderate caffeine and L-theanine, an amino acid that promotes calm focus and mental clarity. It\'s the perfect drink for moments of mindfulness, quiet reflection, or whenever you need a gentle pick-me-up that nourishes both body and soul. Simple, pure, and wonderfully soothing.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Premium whole green tea leaves (or high-grade tea bags)</strong></li>\r\n<li><strong>Hot filtered water (optimal temperature: 70-80&deg;C / 160-175&deg;F)</strong></li>\r\n<li><strong>Optional: honey, lemon, or mint</strong></li>\r\n</ul>', 1, 'product/0P0Ex7mN0v1vpS4X1KljoZqVVUjLTEnH5Fwfz6gb.jpg', '2026-03-10 01:20:59', '2026-03-10 01:20:59'),
(13, 'Black Tea', 4, 70.00, 100.00, 0, 100.00, '<p><strong>The most beloved and widely consumed tea in the world, our Black Tea is a bold, robust, and deeply satisfying brew that has been a cornerstone of tea culture for centuries. Unlike green tea, black tea leaves undergo a complete oxidation process, transforming their color from green to deep brown-black and developing a rich, full-bodied flavor that\'s both invigorating and comforting. Each cup delivers a robust, malty depth with notes of caramel, honey, and subtle hints of dried fruit, finished with a pleasant astringency that awakens the senses and leaves you feeling refreshed. Our premium black tea is carefully sourced from renowned tea-growing regions, ensuring every cup offers the perfect balance of strength, flavor, and aroma. Whether enjoyed pure and simple, with a splash of milk for a classic British-style experience, or sweetened with honey, black tea is incredibly versatile and eternally satisfying. It\'s the dependable, everyday companion that delivers warmth, comfort, and a reliable caffeine boost whenever you need it most.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Premium whole black tea leaves (or high-grade tea bags)</strong></li>\r\n<li><strong>Hot filtered water (optimal temperature: 95-100&deg;C / 200-212&deg;F)</strong></li>\r\n<li><strong>Optional: milk, honey, sugar, lemon</strong></li>\r\n</ul>', 1, 'product/7zAQrarXkfaptesULa9aYB4lwkcoAR0ZQN8NOPoS.webp', '2026-03-10 01:21:38', '2026-03-10 01:21:38'),
(14, 'Masala Chai', 4, 90.00, 120.00, 0, 0.00, '<p><strong>A soul-warming, aromatic masterpiece born from the vibrant streets and kitchens of India, our Masala Chai is a rich, spiced tea experience that wraps you in layers of warmth, comfort, and exotic flavors with every single sip. This isn\'t just tea &mdash; it\'s a centuries-old tradition, a cultural treasure, and a sensory journey all brewed into one magnificent cup. Our authentic Masala Chai begins with robust, full-bodied black tea leaves simmered together with a carefully crafted blend of traditional Indian spices &mdash; aromatic cardamom, fiery ginger, warm cinnamon, fragrant cloves, and earthy black pepper &mdash; all slowly cooked with creamy milk and sweetened to perfection. The result is a beautifully balanced, deeply aromatic, and incredibly comforting drink that dances on your palate with complex layers of spicy, sweet, and creamy notes. Each sip delivers a warming sensation that starts in your chest and spreads throughout your entire body, leaving you feeling cozy, energized, and utterly satisfied. It\'s like a warm hug from the inside out.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Strong black tea leaves (Assam or CTC)</strong></li>\r\n<li><strong>Fresh whole milk</strong></li>\r\n<li><strong>Filtered water</strong></li>\r\n<li><strong>Freshly crushed ginger</strong></li>\r\n<li><strong>Green cardamom pods</strong></li>\r\n<li><strong>Cinnamon stick</strong></li>\r\n<li><strong>Whole cloves</strong></li>\r\n<li><strong>Black peppercorns</strong></li>\r\n<li><strong>Optional: star anise, fennel seeds, nutmeg</strong></li>\r\n<li><strong>Sweetener: sugar, jaggery, or honey</strong></li>\r\n</ul>', 1, 'product/tVCkEQHfAr3WKWSL4cho1dyN6hLHtUOkDR3LhAeZ.jpg', '2026-03-10 01:23:30', '2026-03-10 06:16:39'),
(15, 'Hot Chocolate', 4, 120.00, 160.00, 0, 99.00, '<p><strong>Pure liquid comfort in a cup &mdash; our Hot Chocolate is a rich, velvety, and utterly indulgent embrace of premium melted chocolate and steamed milk that warms your soul from the very first sip. This isn\'t your ordinary powdered cocoa mix; it\'s a luxuriously crafted masterpiece made with real, high-quality chocolate that\'s melted to silky perfection and blended with creamy, steamed milk to create a thick, decadent, and dreamily smooth drinking experience. Each cup delivers an intense, deep chocolate flavor that\'s perfectly balanced between sweet and bittersweet, with a luscious, velvety texture that coats your palate in pure chocolatey bliss. Crowned with a generous mountain of freshly whipped cream, a delicate drizzle of chocolate sauce, and optional toppings, this drink is the ultimate treat for chocolate lovers of all ages. Whether you\'re seeking refuge from a cold day, craving something sweet and comforting, or simply want to indulge in a moment of pure chocolate heaven, our Hot Chocolate is your perfect companion. Zero coffee, 100% cozy happiness.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Premium real chocolate (dark, milk, or white)</strong></li>\r\n<li><strong>Steamed whole milk</strong></li>\r\n<li><strong>Touch of sugar or sweetener</strong></li>\r\n<li><strong>Fresh whipped cream topping</strong></li>\r\n<li><strong>Chocolate drizzle</strong></li>\r\n<li><strong>Optional: marshmallows, cocoa powder dusting, toppings</strong></li>\r\n</ul>', 1, 'product/S0nKnN85fZ7IrD3MwSTfvSfW7f8tC8wc81ENqWTE.jpg', '2026-03-10 01:24:15', '2026-03-10 05:20:24'),
(16, 'Lemon Tea', 4, 70.00, 110.00, 0, 100.00, '<p><strong>Bright, zesty, and wonderfully refreshing &mdash; our Lemon Tea is a timeless classic that perfectly marries the robust depth of premium black tea with the vibrant, citrusy punch of freshly squeezed lemon. This beautifully simple yet incredibly satisfying drink offers a clean, invigorating taste that awakens your senses and refreshes your palate with every sip. The natural tartness of fresh lemon cuts through the malty richness of the tea, creating a perfectly balanced flavor profile that\'s both bold and refreshing. Unlike milk-based teas, Lemon Tea showcases the tea\'s natural character while adding a bright, sunny twist that feels like a burst of freshness in your mouth. Lightly sweetened with honey or sugar to your preference, this drink is the ultimate choice for those seeking a lighter, healthier, and incredibly refreshing tea experience. Whether you\'re fighting off a cold, needing a gentle pick-me-up, or simply craving something clean and revitalizing, our Lemon Tea delivers pure, uncomplicated goodness in every cup.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Premium black tea leaves (or high-grade tea bags)</strong></li>\r\n<li><strong>Hot filtered water</strong></li>\r\n<li><strong>Freshly squeezed lemon juice</strong></li>\r\n<li><strong>Fresh lemon slices for garnish</strong></li>\r\n<li><strong>Optional: honey, sugar, ginger, mint</strong></li>\r\n</ul>\r\n<p><strong>Serving Style:</strong><br /><strong>Served hot in a clear glass mug or ceramic cup that beautifully showcases the gorgeous amber-gold color of the tea with a fresh lemon wheel floating gracefully on top. A small dish with extra lemon wedges and honey is served on the side, allowing you to adjust the citrus intensity and sweetness to your personal preference. A small spoon is provided for stirring.</strong></p>\r\n<p><strong>Caffeine Level:&nbsp;Moderate (30-50mg per cup)</strong></p>', 1, 'product/OyUIHBZBUaKFJkS5qWNselrfsBLOgfY7iOLzHoAw.webp', '2026-03-10 01:25:17', '2026-03-10 01:25:17'),
(17, 'Mango Smoothie', 5, 140.00, 180.00, 0, 100.00, '<p><strong>A tropical paradise blended into a glass &mdash; our Mango Smoothie is a lusciously thick, creamy, and irresistibly refreshing celebration of the king of fruits. Made with perfectly ripe, sweet, and juicy mangoes blended with creamy yogurt or milk and a touch of honey, this vibrant golden drink is like sunshine in a cup. Every sip delivers an explosion of natural mango sweetness, a velvety smooth texture, and a refreshingly cool sensation that transports you straight to a tropical beach. Unlike artificial mango drinks, our smoothie is crafted with real, fresh mango pulp that bursts with authentic flavor, natural sweetness, and all the nutritional goodness that makes mangoes so beloved worldwide. The thick, shake-like consistency makes it incredibly satisfying &mdash; it\'s not just a drink, it\'s an experience. Whether you\'re cooling off on a hot day, fueling up after a workout, or simply treating yourself to something deliciously healthy, our Mango Smoothie is pure tropical bliss in every single sip.</strong></p>\r\n<p><strong>Ingredients:</strong></p>\r\n<ul>\r\n<li><strong>Fresh ripe mango chunks (or premium mango pulp)</strong></li>\r\n<li><strong>Creamy yogurt (or milk)</strong></li>\r\n<li><strong>Touch of honey or sugar</strong></li>\r\n<li><strong>Ice cubes</strong></li>\r\n<li><strong>Optional: banana, milk, cream, protein powder</strong></li>\r\n</ul>', 1, 'product/xOtQ4RVVRiXcDrrwDRp59y2Z3XZjVWYQLMGajMnw.jpg', '2026-03-10 01:27:03', '2026-03-10 01:27:03'),
(18, 'Berry Smoothie', 5, 110.00, 155.00, 0, 100.00, '<p><strong>A vibrant and refreshing blend of mixed berries including strawberry, blueberry, and raspberry, perfectly combined with chilled milk, creamy yogurt, and a drizzle of honey for natural sweetness. Blended with crushed ice to achieve a smooth, thick, and luscious texture. This antioxidant-packed drink delivers a perfect balance of sweet and tangy flavors in every sip. Served chilled in a tall glass topped with a few fresh berry pieces.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (350ml)</strong></p>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Made with a premium mix of real berries</strong></li>\r\n<li><strong>No artificial color, flavor, or preservatives</strong></li>\r\n<li><strong>Rich, creamy &amp; naturally tangy-sweet</strong></li>\r\n<li><strong>Loaded with antioxidants &amp; Vitamin C</strong></li>\r\n<li><strong>Boosts immunity &amp; energizes instantly</strong></li>\r\n<li><strong>Perfect refreshment for any time of the day</strong></li>\r\n</ul>', 1, 'product/ZsQeEi3sEb0i4wbLlq762e9CLP6EPIAlZw1COOPo.jpg', '2026-03-10 01:28:16', '2026-03-10 01:28:16'),
(19, 'Chocolate Milkshake', 5, 100.00, 145.00, 0, 97.00, '<p><strong>A rich, indulgent, and creamy milkshake crafted with premium cocoa chocolate, blended smoothly with chilled full-cream milk, a scoop of vanilla ice cream, and a touch of sugar for the perfect sweetness. Finished with a generous swirl of whipped cream on top and a light dusting of chocolate powder. Every sip delivers a deep, velvety chocolate flavor that satisfies your sweet cravings instantly. Served chilled in a tall glass with a straw.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (350ml)</strong></p>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Made with premium quality cocoa chocolate</strong></li>\r\n<li><strong>Blended with real vanilla ice cream for extra creaminess</strong></li>\r\n<li><strong>No artificial color or preservatives</strong></li>\r\n<li><strong>Topped with fresh whipped cream &amp; chocolate dust</strong></li>\r\n<li><strong>Rich, thick &amp; velvety smooth texture</strong></li>\r\n<li><strong>Ultimate comfort drink for chocolate lovers</strong></li>\r\n<li><strong>Perfect for any mood, any time of the day</strong></li>\r\n<li><strong>A favorite among kids and adults alike</strong></li>\r\n</ul>', 1, 'product/zUfCWupnW9w9VO3LvVx9xhKh3Yi2nMGQk6NyJiQV.jpg', '2026-03-10 01:30:56', '2026-03-10 06:06:00'),
(20, 'Fresh Orange Juice', 5, 80.00, 120.00, 0, 100.00, '<p><strong>A pure, refreshing, and naturally energizing drink made from freshly squeezed ripe oranges. Every glass is packed with the bright, tangy, and naturally sweet flavor of real oranges without any added artificial sugar, color, or preservatives. Lightly strained to maintain a smooth texture while keeping the natural pulp for an authentic fresh-squeezed experience. Served chilled with ice cubes and a slice of orange on the rim of the glass for a premium caf&eacute;-style presentation.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (300ml)</strong></p>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>100% freshly squeezed real oranges</strong></li>\r\n<li><strong>No added sugar, color, or preservatives</strong></li>\r\n<li><strong>Naturally rich in Vitamin C &amp; potassium</strong></li>\r\n<li><strong>Contains natural pulp for authentic taste</strong></li>\r\n<li><strong>Boosts immunity &amp; hydration instantly</strong></li>\r\n<li><strong>Light, refreshing &amp; perfect for any time of the day</strong></li>\r\n<li><strong>Served chilled with a fresh orange slice garnish</strong></li>\r\n<li><strong>One of the healthiest beverages on the menu</strong></li>\r\n<li><strong>Great for detox &amp; daily wellness</strong></li>\r\n</ul>', 1, 'product/bhCHso6Ax5xgJxkkNX1XYhf7jEqGaHBS3YlITaw4.jpg', '2026-03-10 01:32:17', '2026-03-10 01:32:17'),
(21, 'Detox Juice', 5, 95.00, 140.00, 0, 100.00, '<p><strong>A revitalizing and health-boosting cleanse drink carefully crafted with a powerful combination of fresh cucumber, celery, green apple, lemon, ginger, and a handful of fresh mint leaves. Cold-pressed and lightly blended to preserve maximum nutrients, enzymes, and natural goodness. This refreshing green elixir helps flush out toxins, improve digestion, and recharge your body with essential vitamins and minerals. Mildly sweet, slightly tangy, and incredibly refreshing with a subtle kick of ginger. Served chilled in a tall glass garnished with a slice of lemon and a sprig of fresh mint.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (300ml)</strong></p>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Made with 100% fresh natural ingredients</strong></li>\r\n<li><strong>Cold-pressed to retain maximum nutrients</strong></li>\r\n<li><strong>No added sugar, artificial color, or preservatives</strong></li>\r\n<li><strong>Rich in Vitamin C, Vitamin K, iron &amp; antioxidants</strong></li>\r\n<li><strong>Aids in digestion &amp; gut health</strong></li>\r\n<li><strong>Promotes natural body detoxification</strong></li>\r\n<li><strong>Boosts metabolism &amp; supports weight management</strong></li>\r\n<li><strong>Hydrating, refreshing &amp; naturally energizing</strong></li>\r\n<li><strong>Anti-inflammatory properties from fresh ginger</strong></li>\r\n<li><strong>Perfect morning starter or mid-day health boost</strong></li>\r\n<li><strong>Ideal for health-conscious customers &amp; fitness enthusiasts</strong></li>\r\n</ul>', 1, 'product/bYLHMxPgvNiL2KYrOuy2r6rj9KVgDAX1YzOmW6pB.jpg', '2026-03-10 01:33:42', '2026-03-10 01:33:42'),
(22, 'Croissant', 6, 55.00, 95.00, 0, 100.00, '<p><strong>A classic French-style pastry baked to golden perfection with layer upon layer of light, flaky, and buttery dough. Each croissant is carefully handcrafted using premium quality butter, folded multiple times to create that signature airy, delicate, and crispy texture on the outside while remaining soft, warm, and pillowy on the inside. The rich aroma of freshly baked butter fills the air with every bite. Served warm on a clean plate with a light dusting of powdered sugar and a side of butter and strawberry jam for an authentic caf&eacute; experience.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (Single Piece)</strong></p>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Freshly baked in-house every day</strong></li>\r\n<li><strong>Made with premium quality imported butter</strong></li>\r\n<li><strong>Classic French laminated dough technique</strong></li>\r\n<li><strong>Multiple layers for perfect flaky &amp; crispy texture</strong></li>\r\n<li><strong>Golden brown crust with soft &amp; airy inside</strong></li>\r\n<li><strong>Rich, buttery aroma &amp; melt-in-your-mouth feel</strong></li>\r\n<li><strong>Served warm for the best taste experience</strong></li>\r\n<li><strong>Comes with a side of butter &amp; strawberry jam</strong></li>\r\n<li><strong>Perfect pairing with coffee, latte, or cappuccino</strong></li>\r\n<li><strong>Ideal for breakfast, brunch, or a light evening snack</strong></li>\r\n<li><strong>A timeless bakery classic loved by all ages</strong></li>\r\n</ul>', 1, 'product/wB08yGOKilUjA86eEchvaCaLcukJsJNQWS9PDHwZ.jpg', '2026-03-10 01:36:57', '2026-03-10 01:36:57'),
(23, 'Muffin', 6, 45.00, 85.00, 0, 100.00, '<p><strong>A soft, fluffy, and perfectly moist bakery-style muffin baked fresh daily with premium quality ingredients. Each muffin features a beautifully risen golden dome top with a slightly crispy outer edge and an incredibly tender, spongy, and melt-in-your-mouth inside. Available in classic flavors including rich chocolate chip, fresh blueberry, and warm vanilla. Made with real eggs, butter, and fresh milk to deliver that authentic homemade taste and aroma. Served on a clean plate or in a classic paper muffin liner for a charming caf&eacute;-style presentation.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (Single Piece)</strong></p>\r\n<p><strong>Available Flavors:</strong></p>\r\n<ul>\r\n<li><strong>🍫 Chocolate Chip</strong></li>\r\n<li><strong>🫐 Blueberry</strong></li>\r\n<li><strong>🍦 Vanilla</strong></li>\r\n<li><strong>🍌 Banana Walnut</strong></li>\r\n</ul>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Freshly baked in-house every day</strong></li>\r\n<li><strong>Made with real butter, eggs &amp; fresh milk</strong></li>\r\n<li><strong>No artificial color or preservatives</strong></li>\r\n<li><strong>Soft, moist &amp; fluffy texture in every bite</strong></li>\r\n<li><strong>Perfectly risen dome top with golden crust</strong></li>\r\n<li><strong>Rich aroma of freshly baked goodness</strong></li>\r\n<li><strong>Loaded with real chocolate chips or fresh berries</strong></li>\r\n<li><strong>Perfect portion size for a satisfying snack</strong></li>\r\n<li><strong>Pairs beautifully with coffee, tea, or hot chocolate</strong></li>\r\n<li><strong>Ideal for breakfast, afternoon snack, or dessert</strong></li>\r\n<li><strong>A beloved comfort treat for all ages</strong></li>\r\n<li><strong>Great grab-and-go option for busy customers</strong></li>\r\n</ul>', 1, 'product/1kQ9EpoVZ12plFCjNh1so6oRGmGFcX8H3O2jYGdm.webp', '2026-03-10 01:40:24', '2026-03-10 01:40:24'),
(24, 'Donut', 6, 40.00, 75.00, 0, 100.00, '<p><strong>A classic ring-shaped soft, fluffy, and pillowy fried dough pastry that melts in your mouth with every bite. Each donut is freshly made with premium quality flour, eggs, milk, and a touch of sugar, then perfectly fried to achieve a light golden exterior with an airy, cloud-like interior. Generously coated or topped with delicious glazes, icings, or toppings for an irresistible sweet treat. Served fresh on a clean plate or in a signature donut box for a delightful caf&eacute;-style presentation.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (Single Piece)</strong></p>\r\n<p><strong>Available Varieties:</strong></p>\r\n<ul>\r\n<li><strong>🤍 Classic Glazed</strong></li>\r\n<li><strong>🍫 Chocolate Frosted</strong></li>\r\n<li><strong>🍓 Strawberry Glazed</strong></li>\r\n<li><strong>🌈 Sprinkle Topped</strong></li>\r\n<li><strong>🥜 Peanut Crunch</strong></li>\r\n<li><strong>🍬 Caramel Drizzle</strong></li>\r\n<li><strong>🧁 Cream Filled</strong></li>\r\n<li><strong>🍦 Vanilla Frosted</strong></li>\r\n</ul>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Freshly made in-house daily</strong></li>\r\n<li><strong>Light, soft, fluffy &amp; airy texture</strong></li>\r\n<li><strong>Perfectly fried to golden perfection</strong></li>\r\n<li><strong>Made with real eggs, milk &amp; premium flour</strong></li>\r\n<li><strong>Generously topped with premium glazes &amp; toppings</strong></li>\r\n<li><strong>No artificial preservatives</strong></li>\r\n<li><strong>Sweet, indulgent &amp; utterly satisfying</strong></li>\r\n<li><strong>Perfect balance of soft inside &amp; slightly crisp outside</strong></li>\r\n<li><strong>Pairs wonderfully with coffee, latte, or cold milk</strong></li>\r\n<li><strong>Great for breakfast, snack, or dessert</strong></li>\r\n<li><strong>A timeless favorite for kids and adults alike</strong></li>\r\n<li><strong>Perfect grab-and-go sweet treat anytime</strong></li>\r\n</ul>', 1, 'product/2sBu8l4okjPwB0BLCJhoey8xgn7UyJWqp5WXmFen.jpg', '2026-03-10 01:41:38', '2026-03-10 01:41:38'),
(25, 'Cinnamon Roll', 6, 60.00, 110.00, 0, 100.00, '<p><strong>A warm, soft, and gooey spiral-shaped pastry made with fluffy enriched dough, generously layered with a heavenly mixture of aromatic ground cinnamon, brown sugar, and melted butter. Slowly baked to perfection until golden and caramelized, then topped with a luscious drizzle of sweet cream cheese glaze that melts beautifully into every swirl. Each bite delivers a perfect harmony of warm spice, buttery sweetness, and irresistible softness. Served fresh and warm on a clean plate for the ultimate cozy caf&eacute; experience.</strong></p>\r\n<p><strong>Size:&nbsp;Regular (Single Piece)</strong></p>\r\n<p><strong>Available Varieties:</strong></p>\r\n<ul>\r\n<li><strong>🤍 Classic Cream Cheese Glazed</strong></li>\r\n<li><strong>🍫 Chocolate Drizzle</strong></li>\r\n<li><strong>🥜 Pecan Caramel Topped</strong></li>\r\n<li><strong>🍎 Apple Cinnamon</strong></li>\r\n<li><strong>🍦 Vanilla Icing</strong></li>\r\n</ul>\r\n<p><strong>Key Highlights:</strong></p>\r\n<ul>\r\n<li><strong>Freshly baked in-house daily</strong></li>\r\n<li><strong>Made with premium quality cinnamon &amp; brown sugar</strong></li>\r\n<li><strong>Soft, fluffy &amp; pillowy enriched dough</strong></li>\r\n<li><strong>Perfectly caramelized with buttery layers</strong></li>\r\n<li><strong>Generously topped with cream cheese glaze</strong></li>\r\n<li><strong>Warm, gooey &amp; melt-in-your-mouth texture</strong></li>\r\n<li><strong>Rich aroma of fresh cinnamon &amp; baked butter</strong></li>\r\n<li><strong>No artificial color or preservatives</strong></li>\r\n<li><strong>Best served warm for maximum indulgence</strong></li>\r\n<li><strong>Pairs beautifully with coffee, cappuccino, or latte</strong></li>\r\n<li><strong>Perfect for breakfast, brunch, or dessert</strong></li>\r\n<li><strong>A comforting sweet treat for cozy moments</strong></li>\r\n<li><strong>Beloved classic pastry for all ages</strong></li>\r\n</ul>', 1, 'product/AFuzROfbOUcYtgHb4nQKhKvvE73Uu2OQ2g2J02Ux.jpg', '2026-03-10 01:44:24', '2026-03-10 01:44:24'),
(26, 'Sandwich', 7, 75.00, 130.00, 0, 100.00, '<p>A hearty, fresh, and satisfying classic sandwich made with soft, lightly toasted premium bread slices layered generously with a delicious combination of fresh vegetables, protein, creamy spreads, and flavorful seasonings. Each sandwich is carefully handcrafted with crisp lettuce, ripe tomato slices, crunchy cucumber, and your choice of filling, all perfectly stacked between two slices of golden toasted bread. Finished with a spread of creamy mayonnaise, tangy mustard, or signature house sauce for an extra burst of flavor. Served fresh on a clean plate with a side of coleslaw or fries and a pickle wedge for a complete caf&eacute;-style meal.</p>\r\n<p>Size:&nbsp;Regular (Full Sandwich)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Freshly prepared to order</li>\r\n<li>Made with premium quality soft bread</li>\r\n<li>Lightly toasted for perfect crunch</li>\r\n<li>Loaded with fresh vegetables &amp; quality protein</li>\r\n<li>Generous fillings in every layer</li>\r\n<li>Creamy, tangy &amp; flavorful spreads</li>\r\n<li>No artificial preservatives</li>\r\n<li>Perfectly balanced taste &amp; texture</li>\r\n<li>Served with coleslaw or fries &amp; pickle</li>\r\n<li>Ideal for breakfast, lunch, or quick snack</li>\r\n<li>Filling, nutritious &amp; utterly delicious</li>\r\n<li>Perfect grab-and-go meal option</li>\r\n<li>Customizable with extra toppings available</li>\r\n</ul>', 1, 'product/GBWd9rQg6rBkLlIeFX7UBJznH1vJvRPjnwHaT6rl.webp', '2026-03-10 01:47:25', '2026-03-10 06:25:17'),
(27, 'Burger', 7, 95.00, 160.00, 0, 100.00, '<p>A juicy, flavorful, and satisfying classic burger featuring a perfectly seasoned and grilled premium patty nestled between soft, lightly toasted sesame seed buns. Each burger is stacked with layers of fresh crisp lettuce, ripe tomato slices, crunchy onion rings, tangy pickles, and melted cheese for that ultimate cheesy pull. Generously slathered with creamy mayonnaise, smoky BBQ sauce, and signature house special sauce for an explosion of flavors in every bite. Served hot on a clean plate with a side of golden crispy fries, coleslaw, and a dollop of ketchup for the complete caf&eacute;-style burger experience.</p>\r\n<p>Size:&nbsp;Regular (Single Patty)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Freshly prepared and grilled to order</li>\r\n<li>Premium quality seasoned chicken patty</li>\r\n<li>Perfectly toasted soft sesame seed bun</li>\r\n<li>Loaded with fresh vegetables &amp; tangy pickles</li>\r\n<li>Melted cheese for creamy, gooey goodness</li>\r\n<li>Signature sauces for rich flavor burst</li>\r\n<li>Juicy, tender &amp; flavorful in every bite</li>\r\n<li>No artificial preservatives</li>\r\n<li>Served hot with crispy fries &amp; coleslaw</li>\r\n<li>Perfectly balanced taste &amp; texture</li>\r\n<li>Filling, satisfying &amp; utterly delicious</li>\r\n<li>Ideal for lunch, dinner, or anytime cravings</li>\r\n<li>Customizable with extra patty, cheese, or toppings</li>\r\n<li>A timeless favorite for burger lovers of all ages</li>\r\n</ul>', 1, 'product/DyjbrWPm8umpfcx22uYLDSXTaUC1PfFIqfV2ShSh.jpg', '2026-03-10 01:49:04', '2026-03-10 06:25:06'),
(28, 'Wrap', 7, 85.00, 145.00, 0, 100.00, '<p>A delicious, handheld, and perfectly rolled wrap made with a soft, warm, and slightly charred flour tortilla stuffed generously with flavorful protein, fresh crispy vegetables, creamy sauces, and aromatic seasonings. Each wrap is carefully assembled with tender grilled or crispy chicken, crunchy lettuce, juicy tomatoes, sliced onions, shredded cabbage, and a drizzle of signature sauces, then tightly rolled for a mess-free eating experience. Every bite delivers a perfect balance of textures and bold flavors wrapped in one convenient package. Served fresh on a clean plate, sliced diagonally for presentation, with a side of fries, coleslaw, and dipping sauce for the ultimate caf&eacute;-style meal.</p>\r\n<p>Size:&nbsp;Regular (Full Wrap)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Freshly prepared and rolled to order</li>\r\n<li>Soft, warm &amp; slightly charred tortilla</li>\r\n<li>Loaded with premium quality protein</li>\r\n<li>Packed with fresh crunchy vegetables</li>\r\n<li>Signature creamy &amp; tangy sauces inside</li>\r\n<li>Perfectly seasoned for bold flavor</li>\r\n<li>Tightly rolled for mess-free eating</li>\r\n<li>Served with fries, coleslaw &amp; dipping sauce</li>\r\n<li>Light yet filling &amp; satisfying</li>\r\n<li>Ideal for lunch, dinner, or on-the-go meals</li>\r\n<li>Healthier alternative to burgers</li>\r\n<li>Customizable with extra protein or toppings</li>\r\n<li>Perfect balance of taste, texture &amp; freshness</li>\r\n<li>A modern caf&eacute; favorite for all ages</li>\r\n</ul>', 1, 'product/KcA4QmAt0nddmtseOcqgsfDhTsxEe7vPmbDaILz6.jpg', '2026-03-10 01:51:29', '2026-03-10 06:24:55'),
(29, 'Panini', 7, 105.00, 175.00, 0, 100.00, '<p>A classic Italian-style pressed sandwich made with artisan ciabatta bread, perfectly grilled on a hot panini press to achieve beautiful golden grill marks, a crispy exterior, and a warm, soft, and melty interior. Each panini is generously layered with premium quality protein, gooey melted cheese, fresh vegetables, and flavorful spreads, then pressed until perfectly toasted and the cheese is irresistibly melted. The result is a warm, crunchy, and satisfying sandwich with smoky charred edges and a heavenly cheese pull in every bite. Served hot on a clean plate, sliced diagonally, with a side of crispy fries, fresh salad, and a tangy dipping sauce for an authentic caf&eacute;-style experience.</p>\r\n<p>Size:&nbsp;Regular (Full Panini)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Freshly prepared and grilled to order</li>\r\n<li>Authentic Italian-style ciabatta bread</li>\r\n<li>Perfectly pressed with golden grill marks</li>\r\n<li>Crispy crunchy outside, warm soft inside</li>\r\n<li>Loaded with premium quality fillings</li>\r\n<li>Generous gooey melted cheese in every layer</li>\r\n<li>Fresh vegetables &amp; flavorful spreads</li>\r\n<li>Rich, smoky &amp; charred flavor from the grill</li>\r\n<li>Irresistible cheese pull with every bite</li>\r\n<li>Served hot with fries, salad &amp; dipping sauce</li>\r\n<li>Perfectly balanced textures &amp; flavors</li>\r\n<li>Ideal for breakfast, lunch, or dinner</li>\r\n<li>Lighter yet filling caf&eacute; meal option</li>\r\n<li>Customizable with extra cheese or toppings</li>\r\n<li>A sophisticated pressed sandwich experience</li>\r\n<li>Modern caf&eacute; classic loved by all</li>\r\n</ul>', 1, 'product/49MQvqeiu27Jlk6wc0dqiMb0vrcYYlYKbrbk47lI.jpg', '2026-03-10 01:54:05', '2026-03-10 06:24:42');
INSERT INTO `products` (`id`, `name`, `category_id`, `base_price`, `price`, `discount`, `stock`, `details`, `status`, `image`, `created_at`, `updated_at`) VALUES
(30, 'French Fries', 7, 50.00, 95.00, 0, 100.00, '<p>Golden, crispy, and perfectly seasoned classic French fries made from premium quality potatoes, carefully cut into uniform strips and fried to absolute perfection. Each fry features a satisfying crunchy exterior with a soft, fluffy, and tender interior that melts in your mouth. Lightly salted and seasoned while still hot to ensure maximum flavor in every bite. Served piping hot in a stylish basket or on a clean plate, accompanied by your choice of dipping sauces for the ultimate snacking experience.</p>\r\n<p>Size:&nbsp;Regular (Single Serving)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Made from premium quality fresh potatoes</li>\r\n<li>Perfectly cut into uniform golden strips</li>\r\n<li>Fried to crispy golden perfection</li>\r\n<li>Crunchy outside, fluffy soft inside</li>\r\n<li>Lightly seasoned while piping hot</li>\r\n<li>No artificial preservatives or additives</li>\r\n<li>Served fresh and hot every time</li>\r\n<li>Comes with ketchup &amp; mayonnaise</li>\r\n<li>Multiple seasoning options available</li>\r\n<li>Perfect as a side or standalone snack</li>\r\n<li>Pairs wonderfully with burgers, sandwiches &amp; wraps</li>\r\n<li>Shareable portion for friends &amp; family</li>\r\n<li>A timeless caf&eacute; favorite for all ages</li>\r\n<li>The ultimate comfort snack anytime</li>\r\n</ul>', 1, 'product/iUIhEtQ68U2TcF8VRSinFQ8ZRN4QJdTk8H0Zaz2J.jpg', '2026-03-10 01:56:50', '2026-03-10 06:24:26'),
(31, 'Cheesecake', 8, 85.00, 150.00, 0, 100.00, '<p>A rich, creamy, and indulgent classic New York-style cheesecake made with premium quality cream cheese, perfectly blended with fresh cream, sugar, eggs, and a hint of vanilla to create an ultra-smooth, velvety, and luxuriously dense filling. Sitting atop a perfectly crumbly, buttery, and golden graham cracker crust that adds the ideal contrast of texture in every forkful. Each slice is carefully crafted and baked low and slow to achieve that signature creamy consistency without any cracks. Served chilled on a clean plate with your choice of delicious toppings, a drizzle of sauce, and a dollop of fresh whipped cream for an elegant caf&eacute;-style dessert experience.</p>\r\n<p>Size:&nbsp;Regular (Single Slice)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Made with premium quality cream cheese</li>\r\n<li>Authentic New York-style recipe</li>\r\n<li>Ultra-smooth, creamy &amp; velvety texture</li>\r\n<li>Rich, dense &amp; melt-in-your-mouth filling</li>\r\n<li>Perfectly buttery crumbly crust base</li>\r\n<li>Baked low and slow for perfect consistency</li>\r\n<li>No artificial flavors or preservatives</li>\r\n<li>Served chilled for best taste</li>\r\n<li>Topped with fresh fruit or signature sauce</li>\r\n<li>Garnished with whipped cream</li>\r\n<li>Perfect balance of sweet &amp; tangy</li>\r\n<li>Ideal for dessert or sweet cravings</li>\r\n<li>Pairs beautifully with coffee or tea</li>\r\n<li>A luxurious treat for cheesecake lovers</li>\r\n<li>Perfect for celebrations or self-indulgence</li>\r\n<li>An all-time favorite dessert classic</li>\r\n</ul>', 1, 'product/BLCzZ6K6QxmC2f04oZt6aaCDUpiM91L4U4r1nli7.webp', '2026-03-10 01:58:31', '2026-03-10 06:24:11'),
(32, 'Brownie', 8, 65.00, 115.00, 0, 100.00, '<p>A rich, dense, and utterly decadent chocolate brownie made with premium quality dark cocoa and real chocolate chunks, baked to perfection to achieve that signature fudgy, gooey center with a delicate crackly, slightly crispy top. Each brownie is crafted with real butter, fresh eggs, and the finest chocolate to deliver an intense, deep, and satisfying chocolate flavor that melts luxuriously in your mouth. The edges are perfectly chewy while the center remains soft, moist, and incredibly indulgent. Served warm on a clean plate with a dusting of powdered sugar, a scoop of vanilla ice cream, and a drizzle of chocolate sauce for the ultimate caf&eacute;-style dessert experience.</p>\r\n<p>Size:&nbsp;Regular (Single Piece)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Freshly baked in-house daily</li>\r\n<li>Made with premium dark cocoa &amp; real chocolate</li>\r\n<li>Rich, fudgy &amp; gooey center</li>\r\n<li>Crackly crispy top layer</li>\r\n<li>Chewy edges with soft moist inside</li>\r\n<li>Intense deep chocolate flavor</li>\r\n<li>No artificial preservatives or additives</li>\r\n<li>Real butter &amp; fresh eggs for authentic taste</li>\r\n<li>Served warm for maximum indulgence</li>\r\n<li>Dusted with powdered sugar</li>\r\n<li>Pairs perfectly with vanilla ice cream</li>\r\n<li>Drizzled with rich chocolate sauce</li>\r\n<li>Ideal for dessert or chocolate cravings</li>\r\n<li>Perfect with coffee, milk, or hot chocolate</li>\r\n<li>A timeless chocolate lover\'s dream</li>\r\n<li>Ultimate comfort dessert for any mood</li>\r\n<li>Great for sharing or solo indulgence</li>\r\n</ul>', 1, 'product/BlbZrIW6dibFhDi3p5UcCCTkPf6JUPpMbX8hPouw.jpg', '2026-03-10 02:00:23', '2026-03-10 06:24:01'),
(33, 'Tiramisu', 8, 110.00, 185.00, 0, 100.00, '<p>An elegant, luxurious, and authentically crafted Italian classic dessert featuring delicate layers of espresso-soaked ladyfinger biscuits (Savoiardi) nestled between clouds of rich, creamy, and velvety mascarpone cheese filling. Each layer is perfectly balanced with the bold, aromatic flavor of freshly brewed espresso coffee and a subtle hint of cocoa and coffee liqueur essence for that signature sophisticated taste. Finished with a generous dusting of premium Dutch cocoa powder on top, creating a beautiful contrast of bitter and sweet in every spoonful. Chilled to perfection and served in an elegant glass dish or on a clean plate for an authentic caf&eacute;-style Italian dessert experience.</p>\r\n<p>Size:&nbsp;Regular (Single Serving)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Authentic traditional Italian recipe</li>\r\n<li>Made with premium imported mascarpone cheese</li>\r\n<li>Soft, delicate espresso-soaked ladyfingers</li>\r\n<li>Rich, creamy &amp; velvety smooth texture</li>\r\n<li>Bold aromatic espresso coffee flavor</li>\r\n<li>Subtle hint of coffee liqueur essence</li>\r\n<li>Perfectly balanced sweet &amp; bitter notes</li>\r\n<li>Generously dusted with Dutch cocoa powder</li>\r\n<li>No artificial flavors or preservatives</li>\r\n<li>Chilled to perfection for best taste</li>\r\n<li>Light yet indulgent &amp; satisfying</li>\r\n<li>Multiple delicate layers in every bite</li>\r\n<li>Sophisticated &amp; elegant presentation</li>\r\n<li>Pairs beautifully with espresso or cappuccino</li>\r\n<li>Perfect ending to any meal</li>\r\n<li>Ideal for coffee &amp; dessert lovers alike</li>\r\n<li>A true taste of Italy in every spoonful</li>\r\n<li>The ultimate romantic dessert experience</li>\r\n<li>Caf&eacute; favorite for special moments &amp; celebrations</li>\r\n</ul>', 1, 'product/NuiBxUrFyHUOXwEJeQ1mhSFNCe6gDhuRoivH2t0V.jpg', '2026-03-10 02:04:42', '2026-03-10 06:23:53'),
(34, 'Ice Cream', 8, 55.00, 99.00, 100, 97.00, '<p>A creamy, smooth, and delightfully refreshing scoop of premium handcrafted ice cream made with fresh full-cream milk, real cream, and the finest natural ingredients. Each scoop is slow-churned to perfection to achieve that ultra-creamy, dense, and velvety texture that melts luxuriously on your tongue. Bursting with rich, authentic flavors and free from artificial colors or preservatives, our ice cream delivers pure, natural sweetness and indulgence in every bite. Served chilled in an elegant glass cup, crispy waffle cone, or a clean bowl, beautifully presented with your choice of delicious toppings, sauces, and garnishes for the ultimate caf&eacute;-style frozen treat experience.</p>\r\n<p>Size:&nbsp;Regular (2 Scoops)</p>\r\n<p>Available Flavors:</p>\r\n<ul>\r\n<li>🍦 Classic Vanilla Bean</li>\r\n<li>🍫 Rich Belgian Chocolate</li>\r\n<li>🍓 Fresh Strawberry</li>\r\n<li>🥭 Alphonso Mango</li>\r\n<li>🍪 Cookies &amp; Cream</li>\r\n<li>🌰 Nutella Hazelnut</li>\r\n<li>🥜 Peanut Butter Cup</li>\r\n<li>🍵 Matcha Green Tea</li>\r\n<li>🧁 Salted Caramel</li>\r\n<li>🫐 Blueberry Cheesecake</li>\r\n<li>🍌 Banana Walnut</li>\r\n<li>☕ Coffee Espresso</li>\r\n<li>🍬 Butterscotch Crunch</li>\r\n<li>🥥 Creamy Coconut</li>\r\n<li>🍇 Black Currant</li>\r\n<li>🍋 Tangy Lemon Sorbet</li>\r\n<li>🍒 Cherry Garcia</li>\r\n<li>🍫 Dark Chocolate Truffle</li>\r\n<li>🍯 Honey Almond</li>\r\n</ul>\r\n<p>Serving Options:</p>\r\n<ul>\r\n<li>🥣 Classic Bowl</li>\r\n<li>🍦 Crispy Waffle Cone (+৳20)</li>\r\n<li>🧇 Waffle Bowl (+৳30)</li>\r\n<li>🥂 Elegant Glass Cup</li>\r\n</ul>', 1, 'product/1YcRpWdDcGa8tdp4nHMdamNEAH1SF0ublOqcY80t.jpg', '2026-03-10 02:06:20', '2026-03-10 06:23:44'),
(35, 'Panna Cotta', 8, 95.00, 165.00, 0, 100.00, '<p>An exquisite, silky, and elegantly crafted traditional Italian cream dessert made with the finest heavy cream, fresh milk, pure vanilla, and a delicate touch of sugar, gently set with just the right amount of gelatin to achieve that signature luscious, jiggly, and melt-in-your-mouth texture. Each Panna Cotta is slow-cooked and carefully infused to deliver an incredibly smooth, light, and luxuriously creamy experience that dissolves on your tongue like velvet. Perfectly unmolded onto a clean plate and beautifully adorned with a glossy fruit compote, coulis, or caramel sauce that cascades elegantly over the pristine white cream for a stunning visual and flavorful caf&eacute;-style dessert presentation.</p>\r\n<p>Size:&nbsp;Regular (Single Serving)</p>\r\n<p>Key Highlights:</p>\r\n<ul>\r\n<li>Authentic traditional Italian recipe</li>\r\n<li>Made with premium heavy cream &amp; fresh milk</li>\r\n<li>Infused with real vanilla bean</li>\r\n<li>Silky, smooth &amp; velvety texture</li>\r\n<li>Perfectly jiggly &amp; melt-in-your-mouth</li>\r\n<li>Delicate, light &amp; luxuriously creamy</li>\r\n<li>No artificial flavors or preservatives</li>\r\n<li>Gently set with just enough gelatin</li>\r\n<li>Beautifully unmolded presentation</li>\r\n<li>Topped with fresh fruit compote or coulis</li>\r\n<li>Stunning visual elegance on the plate</li>\r\n<li>Perfect balance of sweet &amp; creamy</li>\r\n<li>Light yet indulgent &amp; satisfying</li>\r\n<li>Chilled to perfection for best taste</li>\r\n<li>Pairs wonderfully with espresso or tea</li>\r\n<li>Ideal ending to any meal</li>\r\n<li>Perfect for special occasions &amp; celebrations</li>\r\n<li>A sophisticated Italian dessert experience</li>\r\n<li>Romantic, elegant &amp; absolutely divine</li>\r\n<li>True taste of Italian culinary artistry</li>\r\n</ul>', 1, 'product/eHIlGl3TC5I9vMjEELPf31wm3w7ZgzfhzUpe8C79.webp', '2026-03-10 02:08:52', '2026-03-10 06:23:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VVeL0mDX2m7fzQkLBtcXbuHRD9gg49v4DnniSSrB', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQzh2TVc4SW1zZ3QyZUVCTENRRlZ4cUc2WUEyeTE3WmNEVjgwUjg4VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc3MzE2MzQzOTt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1773164981);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `language` varchar(255) NOT NULL DEFAULT 'en',
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `currency`, `language`, `delivery_charge`, `tax_percentage`, `created_at`, `updated_at`) VALUES
(1, 'BDT', 'en', 110.00, 2.00, '2026-03-10 01:02:54', '2026-03-10 05:22:52');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slider1` varchar(255) DEFAULT NULL,
  `slider2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider1`, `slider2`, `created_at`, `updated_at`) VALUES
(1, 'sliders/ufbNfWD4XYwlHUfr6S4RDpaU8qsq6LLZi1LFJNyL.jpg', 'sliders/rVTcHYX2h2YjwONng6SzQJGBWiDDqsqfTtbo14hf.jpg', '2026-03-10 02:12:04', '2026-03-10 11:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Joty Biswas', 'jotybiswas0199@gmail.com', NULL, 1, '$2y$12$rI7y6otvIRqeVAJVNQmdRO3iRJ6yTFhP17xd/K0ZfMjx6Jx3TUxeq', 'bJMWZAKmJl1ex6CHjaLVXSx1nAjU6b2RBmE0ftPn3D9mUrGlvYRgqXcJLFOf', '2026-03-10 00:54:52', '2026-03-10 00:54:52'),
(2, 'Dev Paglu', 'jotybiswas019@gmail.com', NULL, 0, '$2y$12$aToCIXgovlBvY9UlSg0oW.9q/vN7mC9z3cB2HsQgU7Qtt4RURdqHu', NULL, '2026-03-10 11:07:46', '2026-03-10 11:07:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
