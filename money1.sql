-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 06:19 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `money1`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `archive_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `branch_from` varchar(255) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `branch_to` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `purpose` text NOT NULL,
  `s_firstname` varchar(255) NOT NULL,
  `s_lastname` varchar(255) NOT NULL,
  `s_middlename` varchar(255) DEFAULT NULL,
  `s_contact` varchar(15) NOT NULL,
  `s_address` text NOT NULL,
  `r_firstname` varchar(255) NOT NULL,
  `r_lastname` varchar(255) NOT NULL,
  `r_middlename` varchar(255) DEFAULT NULL,
  `r_contact` varchar(15) NOT NULL,
  `r_address` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`, `address`, `created_at`) VALUES
(1, 'branch 101', 'tupi', '2023-11-24 16:00:11'),
(2, 'branch 102', 'polomolok', '2023-11-24 16:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `fee_structure`
--

CREATE TABLE `fee_structure` (
  `id` int(11) NOT NULL,
  `amount_from` decimal(10,2) NOT NULL,
  `amount_to` decimal(10,2) NOT NULL,
  `fee_percentage` decimal(5,2) DEFAULT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fee_structure`
--

INSERT INTO `fee_structure` (`id`, `amount_from`, `amount_to`, `fee_percentage`, `date_created`) VALUES
(1, '0.01', '100.01', '5.00', '2023-11-25'),
(2, '100.01', '500.00', '0.10', '2023-11-25'),
(3, '500.01', '1000.00', '0.15', '2023-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `branch_from` int(11) NOT NULL,
  `status` enum('pending','received','failed') DEFAULT 'pending',
  `tracking_code` varchar(50) NOT NULL,
  `purpose` varchar(50) NOT NULL,
  `branch_to` varchar(50) NOT NULL,
  `receiver_id` varchar(50) NOT NULL,
  `s_firstname` varchar(50) NOT NULL,
  `s_lastname` varchar(50) NOT NULL,
  `s_middlename` varchar(50) DEFAULT NULL,
  `s_contact` varchar(20) NOT NULL,
  `s_address` varchar(255) NOT NULL,
  `r_firstname` varchar(50) NOT NULL,
  `r_lastname` varchar(50) NOT NULL,
  `r_middlename` varchar(50) DEFAULT NULL,
  `r_contact` varchar(20) NOT NULL,
  `r_address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fee` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `sender_id`, `amount`, `branch_from`, `status`, `tracking_code`, `purpose`, `branch_to`, `receiver_id`, `s_firstname`, `s_lastname`, `s_middlename`, `s_contact`, `s_address`, `r_firstname`, `r_lastname`, `r_middlename`, `r_contact`, `r_address`, `created_at`, `fee`) VALUES
(48, 2, '1150.00', 1, 'received', 'QPB-578911	', 'allowance', '2', '3', '', 'sdsd', 'sdsd', '2323', 'sdsd', '', 'sdsd', 'sdsd', '2323', 'sd', '2024-12-04 10:19:09', '150.00'),
(49, 3, '105.00', 2, 'received', 'PYW-475251', 'allowance', '1', '2', '', 'sdsd', 'sdsd', '2323', 'sdsdsd', '', 'sdsdsd', 'sdsdsd', '23232', 'sdsd', '2024-12-04 10:20:58', '5.00');

--
-- Triggers `transactions`
--
DELIMITER $$
CREATE TRIGGER `before_insert_tracking_code` BEFORE INSERT ON `transactions` FOR EACH ROW BEGIN
    DECLARE tracking_code VARCHAR(10);
    SET tracking_code = CONCAT(
        CHAR(FLOOR(RAND() * 26) + 65), '', -- Random uppercase letter
        CHAR(FLOOR(RAND() * 26) + 65), '', -- Random uppercase letter
        CHAR(FLOOR(RAND() * 26) + 65), '-', -- Random uppercase letter
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10), -- Random digit
        FLOOR(RAND() * 10)  -- Random digit
    );

    SET NEW.tracking_code = tracking_code;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(200) NOT NULL,
  `branch_from` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `role`, `created_at`, `image`, `branch_from`) VALUES
(1, 'admin', 'admin123', 'admin@gmail.com', 'Administrator', 'admin', 'admin', '2023-11-24 16:01:24', 'upload/219970.png', 1),
(2, 'branch1', 'branch123', 'branch1@gmail.com', 'Branch 1', 'branch123', 'staff', '2023-11-24 16:02:25', 'upload/219988.png', 1),
(3, 'branch2', 'branch123', 'branch2@gmail.com', 'Branch2', 'branch2', 'staff', '2023-11-24 18:51:42', 'upload/219989.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `fee_structure`
--
ALTER TABLE `fee_structure`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `branch_from` (`branch_from`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `branch_from` (`branch_from`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fee_structure`
--
ALTER TABLE `fee_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`branch_from`) REFERENCES `branches` (`branch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
