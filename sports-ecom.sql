-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 01:05 PM
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
-- Database: `sports-ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Jersy', 1, '2024-06-18 21:37:33', '2024-06-18 21:37:33'),
(2, 'Genzi', 1, '2024-06-18 21:37:41', '2024-06-18 21:37:41'),
(3, 'T-shirt', 1, '2024-06-28 00:42:44', '2024-06-28 00:42:44');

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
-- Table structure for table `manufactures`
--

CREATE TABLE `manufactures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufactures`
--

INSERT INTO `manufactures` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bafufe', '1719241646.png', 1, '2024-06-24 09:07:27', '2024-06-24 09:08:14'),
(3, 'Mohamedan', '1719241756.png', 1, '2024-06-24 09:09:16', '2024-06-24 09:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Md Anikul Islam', 'anikul.islam.binju@gmail.com', 'Test', 'a critical examination, observation, or evaluation : trial. specifically : the procedure of submitting a statement to such conditions or operations as will lead to its proof or disproof or to its acceptance or rejection. a test of a statistical hypothesis. (2) : a basis for evaluation : criterion.', '2024-06-30 02:44:57', '2024-06-30 02:44:57');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_06_15_064536_create_sliders_table', 1),
(6, '2024_06_16_044913_create_categories_table', 1),
(7, '2024_06_16_050433_create_products_table', 1),
(8, '2024_06_16_050619_create_sizes_table', 1),
(13, '2024_06_24_144555_create_manufactures_table', 3),
(14, '2024_06_24_144614_create_partners_table', 3),
(15, '2024_06_24_153704_create_other_settings_table', 4),
(16, '2024_06_27_044337_create_wishlists_table', 5),
(17, '2024_06_27_161925_create_sub_categories_table', 6),
(18, '2024_06_24_050740_create_orders_table', 7),
(19, '2024_06_24_051006_create_order_items_table', 7),
(20, '2024_06_29_082756_create_payments_table', 8),
(21, '2024_06_29_165118_create_site_settings_table', 9),
(22, '2024_06_30_083754_create_messages_table', 10),
(25, '2024_06_30_095330_create_product_reviews_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `order_tracking_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `delivery_charge` varchar(255) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','completed','declined') NOT NULL DEFAULT 'pending',
  `remark` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `invoice_no`, `order_tracking_id`, `user_id`, `payment_method`, `delivery_charge`, `total`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(15, 'INV-1719724105', 'DQLOBP8IZL', 8, 'online', '60', 2860.00, 'processing', NULL, '2024-06-29 23:08:25', '2024-07-08 06:12:09'),
(16, 'INV-1719727652', 'KAWI1SQUGV', 4, 'cod', '120', 1620.00, 'declined', 'Information Not Valid', '2024-06-30 00:07:32', '2024-07-04 01:19:20'),
(17, 'INV-1719727760', 'Q5YAV1UQPR', 4, 'cod', '60', 1060.00, 'completed', NULL, '2024-06-30 00:09:20', '2024-07-02 05:59:21'),
(18, 'INV-1719922807', '5JPLHK6HOJ', 4, 'cod', '60', 1560.00, 'pending', NULL, '2024-07-02 06:20:07', '2024-07-02 06:20:07'),
(19, 'INV-1719922866', 'L1GDI9OALR', 4, 'online', '60', 1860.00, 'pending', NULL, '2024-07-02 06:21:06', '2024-07-02 06:21:06'),
(20, 'INV-1720110045', 'IOP2NMBTUO', 8, 'cod', '120', 6120.00, 'completed', NULL, '2024-07-04 10:20:45', '2024-07-06 10:57:50'),
(21, 'INV-1720284824', 'XUF7GBLFBK', 8, 'cod', '120', 3120.00, 'pending', NULL, '2024-07-06 10:53:44', '2024-07-06 10:53:44'),
(22, 'INV-1720284941', '9HOXOBHX6L', 4, 'cod', '60', 2560.00, 'processing', NULL, '2024-07-06 10:55:41', '2024-07-06 11:02:11'),
(23, 'INV-1720440676', 'TPUU8KRV4I', 4, 'cod', '60', 3060.00, 'declined', 'Information Not Valid', '2024-07-08 06:11:16', '2024-07-08 06:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(21, 15, 9, 'Cressex United Tracksuit', 1, 2800.00, '2024-06-29 23:08:25', '2024-06-29 23:08:25'),
(22, 16, 11, 'Sporting London FC Home', 1, 1500.00, '2024-06-30 00:07:32', '2024-06-30 00:07:32'),
(23, 17, 10, 'Cressex United Tracksuit', 1, 1000.00, '2024-06-30 00:09:20', '2024-06-30 00:09:20'),
(24, 18, 11, 'Sporting London FC Home', 1, 1500.00, '2024-07-02 06:20:07', '2024-07-02 06:20:07'),
(25, 19, 8, 'Garden State FC Home', 1, 1800.00, '2024-07-02 06:21:06', '2024-07-02 06:21:06'),
(26, 20, 11, 'Sporting London FC Home', 1, 1500.00, '2024-07-04 10:20:45', '2024-07-04 10:20:45'),
(27, 20, 12, 'Garden State FC Home', 2, 1500.00, '2024-07-04 10:20:45', '2024-07-04 10:20:45'),
(28, 20, 12, 'Garden State FC Home', 1, 1500.00, '2024-07-04 10:20:45', '2024-07-04 10:20:45'),
(29, 21, 12, 'Garden State FC Home', 1, 1500.00, '2024-07-06 10:53:44', '2024-07-06 10:53:44'),
(30, 21, 12, 'Garden State FC Home', 1, 1500.00, '2024-07-06 10:53:44', '2024-07-06 10:53:44'),
(31, 22, 11, 'Sporting London FC Home', 1, 1500.00, '2024-07-06 10:55:41', '2024-07-06 10:55:41'),
(32, 22, 10, 'Cressex United Tracksuit', 1, 1000.00, '2024-07-06 10:55:41', '2024-07-06 10:55:41'),
(33, 23, 11, 'Sporting London FC Home', 2, 1500.00, '2024-07-08 06:11:16', '2024-07-08 06:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `other_settings`
--

CREATE TABLE `other_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `details` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `other_settings`
--

INSERT INTO `other_settings` (`id`, `category`, `details`, `created_at`, `updated_at`) VALUES
(1, 'terms_condition', '<h2><strong>Terms &amp; Conditions</strong></h2><p><strong>A. Introduction:</strong></p><p>Welcome to Evaly.com.bd additionally thusly known as \"we\", \"us\" or \"Evaly\". We are an online commercial center and these are the terms and conditions overseeing your entrance and utilization of Evaly alongside its related sub-areas, destinations, portable application, administrations and apparatuses (the \"Website\"). By utilizing the Site, you thusly acknowledge these terms and conditions (counting the connected data in this) and speak to that you consent to conform to these terms and conditions (the \"Client Agreement\"). This User Agreement is regarded as successful upon your utilization of the Site which means your acknowledgment of these terms. On the off chance that you don\'t consent to be bound by this User Agreement kindly don\'t get to, register with or utilize this Site. This Site is claimed and worked by Evaly Bangladesh Limited, an organization consolidated under the Companies Act, 1994.</p><p>The Site maintains whatever authority is needed to change, adjust, include, or expel bits of these Terms and Conditions whenever with no earlier warning. Changes will be successful when posted on the Site with no other notification gave. If it\'s not too much trouble check these Terms and Conditions normally for refreshes. You proceed with the utilization of the Site following the presenting of changes on Terms and Conditions of utilization establishes your acknowledgment of those changes.</p><p><strong>B. CONDITIONS OF USE</strong></p><p><strong>1. YOUR ACCOUNT</strong></p><p>To get to specific administrations offered by the stage, we may necessitate that you make a record with us or give individual data to finish the making of a record. We may whenever in our sole and total watchfulness, nullify the username as well as password without giving any explanation or earlier notice and will not be at risk or answerable for any misfortunes endured by, brought about by, emerging out of, regarding or by reason of such solicitation or negation.</p><p>Any agreement between us, regardless of whether for utilization of the site or in connection to the buy of items or administrations through the site will be represented by the laws of Bangladesh and all gatherings submit to the non-restrictive purview of the Bangladeshi Courts.</p><p>You are answerable for keeping up the classification of your client recognizable proof, password, account subtleties, and related private data. You consent to acknowledge this obligation and guarantee your record and its related subtleties are kept up safely consistently and every essential advance is taken to avoid abuse of your record. You ought to advise us promptly on the off chance that you have any motivation to accept that your secret phrase has gotten known to any other individual, or if the secret word is being, or is probably going to be, utilized in an unapproved way. You concur and recognize that any utilization of the Site and related administrations offered as well as any entrance to private data, information or interchanges utilizing your record and secret word will be esteemed to be either performed by you or approved by you all things considered. You consent to be bound by any entrance of the Site as well as utilization of any administrations offered by the Site (regardless of whether such access or use are approved by you or not). You concur that we will be entitled (yet not obliged) to follow up on, depend on or consider you exclusively capable and subject in regard thereof as though the equivalent were done or transmitted by you. You further concur and recognize that you will be bound by and consent to completely reimburse us against all misfortunes emerging from the utilization of or access to the Site through your record.</p><p>It would be ideal if you guarantee that the subtleties you give us are right and finish consistently. You are committed to refreshing insights regarding your record progressively by getting to your record on the web. For snippets of data you are not ready to refresh by getting to Your Account on the Site, you should advise us by means of our client care correspondence channels to help you with these changes. We claim all authority to decline access to the Site, end records, evacuate or alter content whenever without earlier notice to you. We may whenever in our sole and total carefulness, demand that you update your Personal Data or forthwith negate the record or related subtleties without giving any explanation or earlier notice and will not be at risk or liability for any misfortunes endured by or brought about by you or emerging out of or regarding or by reason of such solicitation or nullification. You thusly consent to change your secret key now and again and to keep your record secure and furthermore will be answerable for the privacy of your record and obligated for any revelation or use (regardless of whether such use is approved or not) of the username and additionally secret key.</p><p><strong>2. Your account vs your order</strong></p><p>We Only Consider the name of an evaly account holder as the owner of and the client of the product(s) which has been ordered from the respective evaly account. You should not request for any changes in the name of the owner while delivering the product (i.e.: Motor Bike/Car, apartments, lands etc.)</p><p>Evaly retains all kinds of authority to ban/cancel/freeze/unfreeze your account(s) if they think it should be done so. Evaly is not bound to provide the balance amount (of cashback)to you if your account is blocked/banned. Any kind of balance paid by you through bkash/bank/cash would be refunded to you within a reasonable time period. Please note that it may depend on the calculation of your total payment vs the cashback you received and used.</p><p><strong>3. Your Conduct:</strong></p><p>You should not utilize the site at all that causes, or is probably going to cause, the Site or access to it to interfere, harmed or disabled in any capacity. You should not participate in exercises that could hurt or conceivably hurt the Site, its workers, officials, delegates, partners or some other gathering legitimately or in a roundabout way connected with the Site or access to it to be intruded, harmed or debilitated in any capacity. You comprehend that you, and not us, are answerable for every single electronic correspondence and substance sent from your PC to us and you should utilize the Site for legal purposes as it were. You are carefully restricted from utilizing the Site</p><p>Evaly.com.bd might not be subject to any individual for any misfortune or harm, which may emerge from the utilization of any of the data contained in any of the materials on this site.</p><ul><li>for deceitful purposes, or regarding a criminal offense or other unlawful movements</li><li>to send, utilize or reuse any material that doesn\'t have a place with you; or is illicit, hostile (counting yet not constrained to material that is explicitly unequivocal substance or which advances prejudice, dogmatism, scorn or physical mischief), tricky, misdirecting, damaging, foul, hassling, disrespectful, abusive, derogatory, vulgar, obscene, pedophilic or threatening; ethically questionable, stigmatizing or in break of copyright, trademark, secrecy, protection or some other exclusive data or right; or is generally damaging to outsiders; or identifies with or advances tax evasion or betting; or is unsafe to minors in any capacity; or mimics someone else; or undermines the solidarity, trustworthiness, security or power of Bangladesh or neighborly relations with remote States; or offensive or generally unlawful in any way at all; or which comprises of or contains programming infections, political battling, business sales, networking letters, mass mailings or any ‘spam‘</li><li>Use the Site for illicit purposes.</li><li>to cause irritation, bother or unnecessary nervousness</li><li>for whatever other purposes that is other than what is expected by us</li></ul><p><strong>4. Submission:</strong></p><p>Anything that you submit to the Site or potentially give to us, including yet not restricted to, questions, audits, remarks, and proposals (on the whole, \"Entries\") will turn into our sole and selective property and will not become back to you. Notwithstanding the rights pertinent to any Submission, when you present remarks or surveys on the Site, you additionally award us the privilege to utilize the name that you submit, regarding such audit, remark, or other substance. You will not utilize a bogus email address, profess to be somebody other than yourself or generally misdirect us or outsiders with regards to the cause of any Submissions. We may, yet will not be committed to, expel or alter any Submissions with no notification or lawful course appropriate to us in such manner.</p><p><strong>5. CLAIMS AGAINST OBJECTIONABLE CONTENT:</strong></p><p>We list a huge number of items including apartments &amp; Lands available to be purchased offered by various dealers on the Site and host different remarks on postings, it isn\'t workable for us to know about the substance of every item recorded available to be purchased or each remark or survey that is shown. Appropriately, we work on a \"guarantee, audit and takedown\" premise. On the off chance that you accept that any substance on the Site is illicit, hostile (counting yet not restricted to material that is explicitly express substance or which advances prejudice, bias, scorn or physical mischief), beguiling, deluding, harsh, profane, irritating, impious, slanderous, offensive, revolting, obscene, pedophilic or threatening; ethnically questionable, criticizing; or is generally damaging to outsiders; or identifies with or advances tax evasion or betting; or isdestructive to minors in any capacity; or mimics someone else; or compromises the solidarity, trustworthiness, security or sway of Bangladesh or cordial relations with remoteStates; or shocking or generally unlawful in any way at all; or which comprises of or contains programming infections, (\" frightful substance \"), please tell us quickly by following by keeping in touch with us on legal@Evaly.com.bd. We will make every single useful undertaking to examine and evacuate substantial offensive substance griped about inside a sensible measure of time.</p><p>If it\'s not too much trouble guarantee to give your name, address, contact data and the same number of pertinent subtleties of the case including the name of frightful substance party, occasions of protest, confirmation of complaint among others. If you don\'t mind note that giving inadequate subtleties will ruin your case and unusable for legitimate purposes.</p><p><strong>6. CLAIMS AGAINST INFRINGING CONTENT:</strong></p><p>We regard the licensed innovation of others. On the off chance that you accept that your licensed innovation rights have been utilized such that offers to ascend to worries of encroachment if it\'s not too much trouble illuminate us and we will endeavor every single sensible exertion to address your worry inside a sensible measure of time. It would be ideal if you guarantee to give your name, address, contact data and the same number of pertinent subtleties of the case including the name of encroaching gathering, cases of encroachment, and verification of encroachment among others. If you don\'t mind note that giving deficient subtleties will ruin your case and unusable for lawful purposes. What\'s more, giving bogus or misdirecting data might be viewed as a legitimate offense and might be trailed by lawful procedures.</p><p>We likewise regard a maker\'s entitlement to go into selective appropriation or resale understandings for its items. In any case, infringement of such understandings doesn’t establish licensed innovation rights encroachment. As the implementation of these understandings is an issue between the producer, wholesaler and additionally particular affiliate, it would not be befitting for us to aid the authorization of such exercises. While we can\'t give legitimate guidance, nor share private data as secured by the law, we suggest that any inquiries or concerns with respect to your privileges might be steered to lawful authority.</p><p><strong>7. Indemnity</strong></p><p>You will repay and hold innocuous Evaly Limited, its auxiliaries, offshoots, and their particular officials, executives, operators, and representatives, from any case or request, or activities including sensible lawyer\'s expenses, made by any outsider or punishment forced due to or emerging out of your break of these Terms and Conditions or any record joined by reference, or your infringement of any law, rules, guidelines or the privileges of an outsider.</p><p>You therefore explicitly discharge Evaly as possessed by offshoots as well as any of its officials and delegates from any cost, harm, obligation or other outcome of any of the activities/inactions of the merchants or other specialist co-ops and explicitly waiver any cases or requests that you may have for this benefit under any resolution, contract or something else.</p><p><strong>8. Losses</strong></p><p>We won\'t be answerable for any business or individual misfortunes (counting however not restricted to loss of benefits, income, contracts, foreseen investment funds, information, altruism, or squandered consumption) or whatever other backhanded or weighty misfortune that isn\'t sensibly predictable to both you and us when you initiated utilizing the Site.</p><p><strong>9. Corrections TO CONDITIONS OR ALTERATIONS OF SERVICE AND RELATED PROMISE</strong></p><p>We maintain all authority to make changes to the Site, its strategies, these terms and conditions and some other freely showed condition or administration guarantee whenever. You will be dependent upon the approaches and terms and conditions in power at the time you utilized the Site except if any change to those strategies or these conditions is required to be made by law or government expert (in which case it will apply to orders recently set by you). In the event that any of these conditions is regarded invalid, void, or in any way, shape or form unenforceable, that condition will be considered severable and won\'t influence the legitimacy and enforceability of any outstanding condition.</p><p><strong>10. WAIVER</strong></p><p>You recognize and perceive that we are a private business endeavor and claim all authority to lead the business to accomplish our targets in a way we esteem fit. You additionally recognize that in the event that you break the conditions expressed on our Site and we make no move, we are as yet qualified for utilizing our privileges and cures in whatever other circumstance where you rupture these conditions.</p><p><strong>11. Administering LAW AND JURISDICTION</strong></p><p>These terms and conditions are administered by and interpreted as per the laws of The People\'s Republic of Bangladesh. You concur that the courts, councils and additionally semi-legal bodies situated in Dhaka, Bangladesh will have the restrictive purview on any question emerging inside Bangladesh under this Agreement.</p><p><strong>12. Offers:</strong></p><p>evaly is not liable or bound to provide any other offers of any merchant/importer/ vendors’ at any other places/sites except evaly. You can just request/ask/solicitation or look for data about the offers given/declared by evaly.</p><p>One client will have the option to buy one item during any special offers (*if not allowed and announced multiple quantities by evaly).</p><p>Customers cannot claim to withdraw any kind of cashback by any other form (example - by bkash, bank or cash) except evaly balance.</p><p><strong>13. Valuing, AVAILABILITY AND ORDER PROCESSING</strong></p><p>All costs are recorded in Bangladeshi Taka (BDT) and are comprehensive of VAT and are recorded on the Site by the merchant that is selling the item or administration. Things in your Shopping Cart will consistently mirror the latest value shown on the thing\'s item detail page. If it\'s not too much trouble note that this cost may vary from the value appeared for the thing when you previously put it in your truck. Putting a thing in your truck doesn\'t save the value that appeared around then. It is additionally conceivable that a thing\'s cost may diminish between the time you place it in your bin and the time you buy it.</p><p>We don\'t offer value coordinating for any things sold by any merchant on our Site or different sites.</p><p>We are resolved to give the most exact evaluating data on the Site to our clients; be that as it may, blunders may at present happen, for example, situations when the cost of a thing isn\'t shown effectively on the Site. In that capacity, we maintain all authority to won\'t or drop any request. If a thing is mispriced, we may, at our own tact, either get in touch with you for guidelines or drop your request and advise you of such crossing out. We will reserve the option to can\'t or drop any such requests whether the request has been affirmed and your prepayment handled. On the off chance that such a retraction happens on your prepaid request, our approaches for the discount will apply. If it\'s not too much trouble note that Evaly has 100% right on the discount sum. Generally, the discount sum is determined dependent on the client followed through on cost in the wake of deducting any kind of markdown and delivery charge.</p><p>We list accessibility data for items recorded on the Site, remembering for every item data page. Past what we state on that page or generally on the Site, we can\'t be increasingly explicit about accessibility. It would be ideal if you note that dispatch gauges are only that. They are not ensured dispatch times and ought not to be depended upon in that capacity. As we process your request, you will be educated by email or SMS if any items you request end up being inaccessible.</p><p>It would be ideal if you note that there are situations when a request can\'t be prepared for different reasons. The Site maintains whatever authority is needed to won\'t or drop any request in any way, shape or form at some random time. You might be approached to give extra confirmation or data, including yet not constrained to telephone numbers and address, before we acknowledge the request.</p><p>So as to keep away from any extortion with a credit or check cards, we maintain whatever authority is needed to acquire approval of your installment subtleties before furnishing you with the item and to confirm the individual data you imparted to us. This confirmation can take the state of a character, spot of habitation, or banking data check. The nonappearance of an answer following such a request will naturally cause the wiping out of the request inside a sensible timetable. We maintain whatever authority is needed to continue to coordinate undoing of a request for which we presume a danger of false utilization of banking instruments or different reasons without earlier notice or any ensuing lawful obligation.</p><p>If there is any mistakes found regarding pricing (example- overpriced than the MRP or lower price than the MRP) of any product and if the seller delivers that mispriced product even after notified by customer and if any action is not taken by the seller even after notified by customer then the seller will be solely legally liable for this.</p><p><strong>14. Special Items</strong></p><p><strong>SECURITY AND FRAUD</strong></p><ul><li>When you utilize a voucher, you warrant to Evaly that you are the appropriately approved beneficiary of the voucher and that you are utilizing it in compliance with common decency.</li><li>If you recover, endeavor to reclaim or support the recovery of voucher to acquire limits to which you are not entitled you might be perpetrating a common or criminal offense</li><li>If we sensibly accept that any voucher is being utilized unlawfully or illicitly, we may reject or drop any voucher/request and you concur that you will have no case against us in regard of any dismissal or crossing out. Evaly maintains whatever authority is needed to make any further move it considers suitable in such occasions</li></ul><p><strong>15. Mass Purchasing</strong></p><p>Evaly sites are accessible for non-business and residential utilization as it were. We maintain all authority to reject or cross out your request on the off chance that we trust you are requesting our items for business or other re-deal purposes. We apply breaking points to some of our items to ensure stock accessibility so that whatever number of our clients as could be expected under the circumstances can purchase our items.</p><p><strong>16. RESELLING EVALY PRODUCTS</strong></p><p>Reselling Evaly products for business purposes is strictly prohibited.If any unauthorized personnel are found committing the above act,legal action may be taken against him/her. If it is found and proventhat any order has been placed to cash out the paid amount, legalaction may be taken against him/her. If any seller orders (as acustomer) from their own shop using cashback or any other balanceit would be considered as the violation of the act mentioned above.In that case seller (as seller account) &amp; customer (as customeraccount) would be bound to oblige the decision taken by evaly aswell as legal action may be taken.</p><p><strong>17. Stock availability</strong></p><p>The orders are subject to availability of stock. If there is any problem with stock then the order can be canceled at any time, irrespective of any duration.</p><p><strong>18. Delivery Timeline</strong></p><p>The delivery might take longer than the usual timeframe/line to be followed by Evaly. As per the government law and policy, Evaly will deliver any item that is in physical stock within 10 working days. But, Evaly will do it’s best to hand over your items at its earliest. Delivery might be delayed due to force majeure event which includes, but not limited to, political unrest, political event, national/public holidays, Covid lockdowns or movement limitations, etc</p><p><strong>19. Delivery Charge(s)</strong></p><p>19.i) Delivery charge(s) applicable.</p><p>19.ii) Provision of the home delivery is/are subject to carrier and sellers’ delivery policy.</p><p>19.iii) If any delivery fails due to customer negligence or any other reason from the customer end then the customer is bound to pay the return courier charge(s) as well as the redelivery charge(s).</p><p><strong>20. Returns Policy</strong></p><p>1.If your item is faulty/harmed or mistaken/deficient at the hour of conveyance, if you don\'t mind, please get in touch with us inside the pertinent return window. Your item might be qualified for discount or substitution relying upon the item class and condition.</p><p>2. Please note that a few items are not qualified for arrival if the item is \"Never again required\"</p><p>3. For gadget related issues after use or the lapse of the arrival window, we will allude you to the brand guarantee focus (if relevant).</p><p>4. Please note that you should keep and be able to provide proper documentations and proof about your return/refund claim (i.e. unboxing video, receiving invoice, etc.).</p><p><strong>21. Cancellation</strong></p><p>Evaly retains unqualified right to cancel any order at its sole discretion prior to dispatch and for any reason which may include, but not limited to, the product being mispriced, out of stock, expired, defective, malfunctioned, and containing incorrect information or description arising out of technical or typographical error or for any other reason.</p><p><strong>22. Refund</strong></p><p>If any order is canceled, the payment against such order shall be refunded within 72 hours to 10 working days, but it may take longer time in exceptional cases that are related with other payment gateways, government authorities or any. Provided that received cash back, bonus, apology amount, gift amount, if any, will be adjusted with the refund amount when applied.</p><p><strong>3. Representations AND WARRANTIES</strong></p><p>We don\'t make any portrayal or guarantee as to points of interest, (for example, quality, esteem, saleability, and so forth) of the items or administrations leaned to be sold on the Site when items or administrations are sold by outsiders. We don\'t certainly or expressly bolster or embrace the deal or acquisition of any items or administrations on the Site. We acknowledge no obligation for any blunders or exclusions, regardless of whether for the benefit of itself or outsiders.</p><p>We are not liable for any non-execution or break of any agreement that went into among you and the merchants. We can\'t and don\'t ensure your activities or those of the dealers as they finish up exchanges on the Site. We are not required to intercede or resolve any debate or contradiction emerging from exchanges happening on our Site.</p><p>We don\'t any time of time during any exchange as went into by you with an outsider on our Site, gain title to or have any rights or claims over the items or administrations offered by a dealer. In this way, we don\'t have any commitments or liabilities in regard to such contract(s) went into among you and the seller(s). We are not answerable for inadmissible or postponed execution of administrations or harms or deferrals because of items that are out of stock, inaccessible or delay purchased.</p><p>Valuing on any product(s) or related data as thought about the Site may because of some specialized issue, typographical blunder or other explanation by the off base as distributed and therefore you acknowledge that in such conditions the vender or the Site may drop your request without earlier notice or any obligation emerging subsequently. Any prepayments made for such requests will be discounted to you per our discount arrangement as stipulated</p><p>**** You affirm that the product(s) or service(s) requested by you are obtained for your interior/individual utilization and not for business re-deal. You approve of us to proclaim and give a statement to any legislative expert for your benefit expressing the aforementioned reason for your requests on the Site. The Seller or the Site may drop a request wherein the amounts surpass the run of the mill singular utilization. This applies both to the number of items requested inside a solitary request and the putting in of a few requests for a similar item where the individual requests include an amount that surpasses the run of the mill singular utilization. What involves a run of the mill person\'s utilization amount limit will be founded on different components and at the sole watchfulness of the Seller or our own and may fluctuate from individual to person.</p><p>You may drop your request at no cost whenever before the thing is dispatched to you.</p><p>If you don\'t mind note that we sell items just in amounts that relate to the run of the mill needs of a normal family. This applies both to the number of items requested inside a solitary request and the putting in of a few requests for a similar item where the individual requests include an amount run of the mill for an ordinary family unit. It would be ideal if you audit our Refund Policy.</p>', '2024-06-24 10:06:04', '2024-06-24 10:06:04'),
(2, 'faq', '<h3><strong>Why can\'t I login with my old Evaly account?</strong></h3><p>Currently we are using a new server temporarily. All details from previous credentials will be available upon retrieval of our old server from Amazon. For now, please create a new account (you may use your old mobile no.)</p><h3><strong>Where are my old orders?</strong></h3><p>Evaly is currently operating from a new server which will have the details from recent usage. All the data from the earlier version are stored and protected with safety in Amazon server. We are in constant progress with Amazon to retrieve the previous data soon.</p><h3><strong>When will I be able to see my old orders?</strong></h3><p>We are trying our best to recover the old server as soon as possible.</p><h3><strong>Can I use my old phone number to new create account in new server?</strong></h3><p>Yes, you can. After recovering the old server, both accounts will be merged if you use same login number. You\'ll be able to see your old orders automatically.</p><h3><strong>What is Star Program?</strong></h3><p>i. Customers will get 1 Star ⭐ on every successful Delivered order from Evaly CBD, COD, PnP Store. ii. For non payment of delivery charge/not confirmed orders, 5 Stars ⭐ will be deducted as penalty. iii. For dispatched and returned orders due to not receiving the products without raising any prior Issue from customer end will also deduct 5 Stars ⭐. If Issue has been raised on time, Star⭐ will remain the same. iv. Stay updated with us to know more about the amazing Star ⭐ facilities which will be announced over the period.</p>', '2024-06-24 10:09:25', '2024-06-24 10:09:25'),
(3, 'privacy_policy', '<p><strong>Privacy Policy:</strong></p><p>If your product is damaged, defective, incorrect, or incomplete upon delivery, kindly initiate a return request through the Evaly app or website within 7 days from the date of delivery.</p><p>For issues with electronic appliances and mobile phones arising after usage or beyond the return policy period, it is recommended to verify if the product is covered under the seller\'s warranty or brand warranty.</p><p>In specific categories, a change of mind is accepted. Please review the \"Return Policy per Category\" section below for further details.</p><p><strong>Legitimate Reasons for Initiating a Return</strong></p><ul><li><strong>Change of Mind</strong>: If you wish to return an item due to a change of mind, we facilitate such requests within the specified timeframe, abiding by the conditions outlined in our Return Policy.</li><li><strong>Defective or Malfunctioning</strong>&nbsp;(e.g., physically destroyed or broken) or defective (e.g., unable to switch on).</li><li><strong>Incomplete Order</strong>&nbsp;(e.g., missing items and/or accessories).</li><li><strong>Wrong Item Shipped</strong>&nbsp;(e.g., wrong product/size/color, counterfeit item, or expired).</li><li><strong>Unsatisfactory&nbsp;Quality</strong>&nbsp;Delivered product does not match the product description or picture (e.g., product not as advertised).</li><li><strong>Incorrect Size/Color</strong>: Delivered product does not fit (e.g., size is unsuitable).</li></ul>', '2024-06-24 10:10:00', '2024-06-24 10:10:00'),
(4, 'about', '<h2><strong>Who We Are?</strong></h2><p>Welcome to 13space, a cutting-edge software company on a mission to revolutionize digital solutions. At 13space, we take pride in being a dynamic team of skilled software engineers committed to delivering exceptional web, desktop, and mobile applications tailored to our clients\' unique needs.</p><p>Since our establishment, we\'ve been at the forefront of innovation, partnering with a diverse range of companies and driving operational excellence for startups, emerging businesses, and established organizations, both locally and in the global freelance market.</p><h3><strong>Since 2021</strong></h3><p>At 13space, we don\'t just build software; we cultivate partnerships and help businesses thrive.</p><h3><strong>100+ clients</strong></h3><p>Our dedicated teams evolve with our clients, providing end-to-end solutions for you.</p>', '2024-06-24 10:10:45', '2024-06-24 10:10:45'),
(5, 'return_policy', '<p><strong>Return­­­­&nbsp;Policy:</strong></p><p>If your product is damaged, defective, incorrect, or incomplete upon delivery, kindly initiate a return request through the Evaly app or website within 7 days from the date of delivery.</p><p>For issues with electronic appliances and mobile phones arising after usage or beyond the return policy period, it is recommended to verify if the product is covered under the seller\'s warranty or brand warranty.</p><p>In specific categories, a change of mind is accepted. Please review the \"Return Policy per Category\" section below for further details.</p><p><strong>Legitimate Reasons for Initiating a Return</strong></p><ul><li><strong>Change of Mind</strong>: If you wish to return an item due to a change of mind, we facilitate such requests within the specified timeframe, abiding by the conditions outlined in our Return Policy.</li><li><strong>Defective or Malfunctioning</strong>&nbsp;(e.g., physically destroyed or broken) or defective (e.g., unable to switch on).</li><li><strong>Incomplete Order</strong>&nbsp;(e.g., missing items and/or accessories).</li><li><strong>Wrong Item Shipped</strong>&nbsp;(e.g., wrong product/size/color, counterfeit item, or expired).</li><li><strong>Unsatisfactory&nbsp;Quality</strong>&nbsp;Delivered product does not match the product description or picture (e.g., product not as advertised).</li><li><strong>Incorrect Size/Color</strong>: Delivered product does not fit (e.g., size is unsuitable).</li></ul><p> </p><p><strong>Return Policy Category Wise</strong> </p><p>For a comprehensive list of returnable &amp; non-returnable items, please refer to the provided information.</p><p><strong>Phones &amp; Accessories</strong></p><ul><li>Phones, Tablets, Batteries &amp; Chargers, Earphones &amp; Headsets, Mobile &amp; Tablet Accessories</li><li><strong>Change of Mind is not applicable for return and refund.</strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment.</li><li>Note: We do not accept returns for any used items. For mobile phones, you may raise a return request directly with Evaly if the device is dead on arrival (i.e. does not switch on completely). If the mobile phone has already been activated*, please contact the seller or brand warranty provider directly for information regarding the manufacturer\'s warranty.</li><li>*Mobile phone is considered activated once SIM card has been inserted or when the phone has been connected to the internet via Wi-Fi.</li></ul><p><strong>Fashion &amp; Lifestyle</strong></p><ul><li>Clothing, Apparel, Sunglasses, Shoes &amp; Accessories</li><li><strong>Change of mind is applicable for return and refund. </strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment. Items must be unworn, unwashed, and unaltered with their tags intact. Any items found used will be rejected and returned back to customers.</li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment. Items must be unworn, unwashed, and unaltered with their tags intact. Any items found used will be rejected and returned back to customers.</li><li>Items that are non-returnable: All custom-made items, Fine Jewelry (gold, diamonds, gems etc.)</li></ul><p> </p><p> </p><p><strong>Home Appliances &amp; Electronics</strong></p><ul><li><strong>Change of mind is not applicable for return and refund.</strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment.</li><li>Note: For device-related issues after usage or expiration of the return policy period, please check if the item is covered under Seller or Brand Warranty. </li></ul><p> </p><p><strong> </strong></p><p><strong>Beauty &amp; Health</strong></p><ul><li>Makeup, Fragrance, Moisturizers, Creams, Scrubs, Oils, Bath &amp; Body Accessories, Personal Care &amp; Health, Sexual Wellness, Shape wear, Food Supplements</li><li><strong>Change of mind is not applicable for return and refund.</strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment.</li><li>Note: For device-related issues after usage or expiration of the return policy period, please check if the item is covered under Seller or Brand Warranty. </li></ul><p><strong> </strong></p><p><strong>Computer &amp; Accessories</strong></p><ul><li>Laptops, Certified Refurbished Laptops, Components, Processors, Projectors, Storage, Printers, Scanners, Headphones, Speakers, Consoles &amp; PC / Video Games, Gaming Consoles &amp; Accessories, Software CDs</li><li><strong>Change of mind is not applicable for return and refund.</strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment.</li><li>Note: We do not accept returns for any used items. For laptops with brand warranty, Evaly will only accept returns if the device is dead on arrival (i.e. does not switch on completely). Once the brand seal has been opened or removed, please contact the seller or brand warranty provider directly for information regarding the manufacturer\'s warranty.</li><li>Items that are non-returnable: All software products that are labeled as non-returnable on their product details page</li><li>Note: For any software-related technical issues or installation issues, please contact the brand warranty provider directly for information regarding the manufacturer\'s warranty.</li></ul><p><strong> </strong></p><p><strong>Home &amp; Living</strong></p><ul><li>Bedding &amp; Bath, Furniture &amp; Lighting, Kitchen &amp; Dining, Home Décor, Home Improvements, Household &amp; Home Storage Supplies, Lawn &amp; Garden, Other Accessories</li><li><strong>Change of mind is not applicable for return and refund.</strong></li><li>If the item received is damaged, defective, incorrect, or incomplete, a refund will be issued based on Evaly\'s assessment.</li><li>Note: For device-related issues after usage or expiration of the return policy period, please check if the item is covered under Seller or Brand Warranty. Refer to our Warranty Policy for information on the different warranty types and ways to contact the seller/manufacturer.</li><li>Items that are non-returnable: Any custom-made items.</li></ul>', '2024-06-24 10:12:25', '2024-06-24 10:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `title`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'MM', '1719242428.png', 1, '2024-06-24 09:20:28', '2024-06-24 09:20:28'),
(3, 'CC', '1719242436.png', 1, '2024-06-24 09:20:36', '2024-06-24 09:20:36'),
(4, 'TT', '1719242446.png', 1, '2024-06-24 09:20:46', '2024-06-24 09:20:46');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `amount`, `status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(3, 15, 8, 2860.00, 'pending', '', '2024-06-29 23:08:25', '2024-06-29 23:08:25'),
(4, 19, 4, 1860.00, 'pending', '', '2024-07-02 06:21:06', '2024-07-02 06:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(255) DEFAULT NULL,
  `tags` varchar(191) DEFAULT NULL,
  `size_id` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `available_stock` int(11) DEFAULT NULL,
  `stock_sell` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_related` int(11) DEFAULT NULL,
  `is_new_arrival` int(11) DEFAULT NULL,
  `is_popular` int(11) DEFAULT NULL,
  `is_customized` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `amount`, `discount_amount`, `tags`, `size_id`, `stock`, `available_stock`, `stock_sell`, `details`, `image`, `is_related`, `is_new_arrival`, `is_popular`, `is_customized`, `status`, `created_at`, `updated_at`) VALUES
(6, '2', 1, 'Bangladesh Away', '600', '300', NULL, '[\"4\",\"3\",\"2\",\"1\"]', 1500, 1497, 10, '<p>T-shirts should fit comfortably without being too tight or too loose. The shoulder seam should sit at the edge of your shoulder, and the sleeves should cover the tops of your biceps. The hem should fall at your hips or slightly higher. Cotton is a natural fiber that is soft, breathable, and absorbent. It is a good choice for t-shirts you wear in warm weather.</p>', '[\"1719201920_6678f080a09b2.jpg\",\"1719201920_6678f080ba851.jpg\",\"1719201920_6678f080baf59.jpg\",\"1719201920_6678f080bb71c.jpg\"]', 1, 1, 0, 0, 1, '2024-06-23 22:05:20', '2024-06-29 22:42:43'),
(7, '1', 3, 'Mohammedan Sporting Club Away', '1500', '1200', NULL, '[\"3\",\"2\",\"1\"]', 300, 294, 8, '<p>The Cotton T-shirt is a versatile and comfortable garment made from soft and breathable cotton fabric. It features a classic crew neck and short sleeves, offering a relaxed fit suitable for various casual occasions. Ideal for everyday wear, this wardrobe staple provides a timeless and effortless style while ensuring comfort throughout the day.</p>', '[\"1719202071_6678f117e76ea.jpg\",\"1719202071_6678f117e8bf7.jpg\",\"1719202071_6678f117e9188.jpg\",\"1719202071_6678f117e9783.jpg\"]', 1, 1, 1, 1, 1, '2024-06-23 22:07:51', '2024-06-29 22:50:13'),
(8, '3', NULL, 'Garden State FC Home', '2500', '1800', NULL, '[\"3\",\"2\",\"1\"]', 500, 496, 5, '<h4>Product details of Argentina Copa America Jersey 2024 ( 3 Star )Half Sleeve Premium Quality With Embroidery - both Side Print</h4><ul><li>Product details of Argentina Copa America 2024</li><li>Argentina Home Football Jersey</li><li>Design: Copa America 2024</li><li>M Size Chest 36inches, Length 26inches</li><li>L Size Chest 38 inches, Length 28inches</li><li>XL Size Chest 39inches, Length 29 inches</li><li>XXL Size Chest 42 inches, Length 29.5inches</li><li>Design Level Official</li><li>Fit: Regular Fit</li><li>Material: Thai Microfiber Mash</li></ul>', '[\"1719202193_6678f1913f047.jpg\",\"1719202193_6678f191404ca.jpg\",\"1719202193_6678f19140cd5.jpg\",\"1719202193_6678f191419d5.jpg\"]', 1, 1, 1, 1, 1, '2024-06-23 22:09:53', '2024-07-02 06:21:06'),
(9, '1', 3, 'Cressex United Tracksuit', '3000', '2800', NULL, '[\"4\",\"3\"]', 100, 95, 5, '<p>T-shirts should fit comfortably without being too tight or too loose. The shoulder seam should sit at the edge of your shoulder, and the sleeves should cover the tops of your biceps. The hem should fall at your hips or slightly higher. Cotton is a natural fiber that is soft, breathable, and absorbent. It is a good choice for t-shirts you wear in warm weather.</p>', '[\"1719202503_6678f2c73d26f.jpg\",\"1719202503_6678f2c73e7a7.jpg\",\"1719202503_6678f2c73ed11.jpg\",\"1719202503_6678f2c73fa25.jpg\"]', 1, 1, 1, 1, 1, '2024-06-23 22:15:03', '2024-06-29 23:08:25'),
(10, '1', 5, 'Cressex United Tracksuit', '1500', '1000', NULL, '[\"4\",\"3\"]', 300, 297, 6, '<ul><li>Product details of Argentina Copa America 2024</li><li>Argentina Home Football Jersey</li><li>Design: Copa America 2024</li><li>M Size Chest 36inches, Length 26inches</li><li>L Size Chest 38 inches, Length 28inches</li><li>XL Size Chest 39inches, Length 29 inches</li><li>XXL Size Chest 42 inches, Length 29.5inches</li><li>Design Level Official</li><li>Fit: Regular Fit</li><li>Material: Thai Microfiber Mash</li></ul>', '[\"1719202574_6678f30e492c5.jpg\",\"1719202574_6678f30e4a8fb.jpg\",\"1719202574_6678f30e4ae13.jpg\",\"1719202574_6678f30e4bc22.jpg\"]', 1, 1, 1, 1, 1, '2024-06-23 22:16:14', '2024-07-06 10:55:41'),
(11, '2', 2, 'Sporting London FC Home', '1500', NULL, NULL, '[\"4\",\"3\"]', 100, 89, 13, '<p>Test</p>', '[\"1719502214_667d8586275b0.jpg\",\"1719502214_667d858630d41.jpg\",\"1719502214_667d858631262.jpg\",\"1719502214_667d858631803.jpg\",\"1719502214_667d858631d26.jpg\"]', 1, 1, 1, 1, 1, '2024-06-27 09:30:14', '2024-07-08 06:11:16'),
(12, '1', 3, 'Garden State FC Home', '1500', NULL, NULL, '[\"4\",\"3\"]', 500, 488, 12, '<p>Test</p>', '[\"1719547473_667e36515abae.jpg\",\"1719547473_667e36518520a.jpg\",\"1719547473_667e365185ffe.jpg\"]', 1, 1, 1, 1, 1, '2024-06-27 22:04:33', '2024-07-06 10:53:44'),
(13, '2', 1, 'Nimer Jarsy', '1000', '700', '[\"jercy\",\"footbal\"]', '[\"4\",\"3\"]', 500, 5, NULL, '<p>JustTest</p>', '[\"1720075847_6686464759971.jpg\",\"1720075847_668646476b50f.jpg\",\"1720075847_668646476bb66.jpg\",\"1720075847_668646476c22c.jpg\",\"1720075847_668646476c818.jpg\"]', 1, 1, 1, 1, 1, '2024-07-04 00:50:47', '2024-07-04 00:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `details` text DEFAULT NULL,
  `ratting` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `user_id`, `details`, `ratting`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 4, 'We take bulk orders from our designed jersey designs with your player name and jersey number. You can order a minimum of 15 pieces.', 4, 1, '2024-06-30 04:05:02', '2024-06-30 04:26:53'),
(2, 7, 8, 'It looks like you want to display customer reviews and star ratings dynamically based on the ratings stored in your database.', 5, 1, '2024-06-30 04:35:54', '2024-06-30 04:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `site_preview_image` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `site_link` varchar(255) DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `team_banner` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `name`, `title`, `meta_description`, `favicon`, `logo`, `site_preview_image`, `email`, `phone`, `address`, `short_description`, `site_link`, `facebook_link`, `twitter_link`, `linkedin_link`, `instagram_link`, `youtube_link`, `team_banner`, `created_at`, `updated_at`) VALUES
(1, 'Wing', 'Wings Keep Flyings', NULL, 'images/favicons/1719680170.png', 'images/logos/1719680170.png', 'images/site_preview_image/1719680170.png', 'wing@gmail.com', '01905256528', 'South Mugda Mugda Para, Dhaka.', 'Wings Keep Flyings', 'http://127.0.0.1:8000/', NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-29 10:54:34', '2024-06-29 11:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `chest` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `chest`, `length`, `status`, `created_at`, `updated_at`) VALUES
(1, 'L', '32', '40', 1, '2024-06-18 21:37:53', '2024-06-18 21:37:53'),
(2, 'M', '35', '48', 1, '2024-06-18 21:38:04', '2024-06-18 21:38:04'),
(3, 'XL', '40', '48', 1, '2024-06-18 21:38:15', '2024-06-18 21:38:15'),
(4, 'XXL', '38', '42', 1, '2024-06-23 22:01:41', '2024-06-23 22:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Test 1', '1718778177.png', 'http://127.0.0.1:8000/', 1, '2024-06-19 00:22:57', '2024-06-19 00:22:57'),
(5, 'Test 2', '1718778200.png', 'http://127.0.0.1:8000/', 1, '2024-06-19 00:23:20', '2024-06-19 00:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Football', 1, '2024-06-27 10:26:57', '2024-06-27 10:27:24'),
(2, 2, 'Cricket', 1, '2024-06-27 10:28:48', '2024-06-27 10:28:48'),
(3, 1, 'Casual', 1, '2024-06-27 10:28:55', '2024-06-27 10:28:55'),
(4, 2, 'Normal', 1, '2024-06-27 10:29:04', '2024-06-27 10:29:04'),
(5, 1, 'Saruk', 1, '2024-06-27 10:29:23', '2024-06-27 10:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `profile`, `gender`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'sports@admin.com', '01905256528', 'Online Shop', NULL, 'male', 'admin', NULL, '$2y$12$QllNwOos15OXy4qrENV2VusfY7M9Ek7VrgM/UjtwBbw2ThLvO6bIS', NULL, '2024-06-18 21:35:34', '2024-06-18 21:35:34'),
(4, 'Md Anikul Islam', 'test@gmail.com', '01402565528', 'Dhaka.Bangladesh', NULL, NULL, 'user', NULL, '$2y$12$x1vdh0ybh/RjOJpKbC0.SODeLVF7bDT76O6SWsHd7VORGpgZ1MZaG', NULL, '2024-06-23 02:24:41', '2024-06-23 02:24:41'),
(8, 'Binju', 'binju@gmail.com', '01889066742', 'DIT Project,Merul Badda,Dhaka 1212', '1719592865.jpg', NULL, 'user', NULL, '$2y$12$yRagIJRa70t395XcWxwZtuZG1oOHeGsECwBvTxjFQSYeIuA2kMP16', NULL, '2024-06-28 10:05:29', '2024-06-28 10:41:37'),
(9, 'Manna', 'manna@gmail.com', '01905458565', 'House no: 88, 51 Rd No. 9, Dhaka 1212', NULL, NULL, 'user', NULL, '$2y$12$PI5C3.aDOjSabSFu1NFsX.2oIIFswYPUUkIV6w0dg5qNVLcMm2f66', NULL, '2024-06-29 09:52:27', '2024-06-29 09:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `other_settings`
--
ALTER TABLE `other_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `other_settings`
--
ALTER TABLE `other_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
