
create database named work2024, 
you can change the name depending on you,
 but mine was work2024
----------------------
CREATE DATABASE work2024;


create table 
------------
CREATE TABLE `my_times` (
  `id` int(11) NOT NULL,
  `time_started` varchar(25) NOT NULL,
  `time_ended` varchar(25) NOT NULL,
  `descriptions` text DEFAULT NULL,
  `date_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
