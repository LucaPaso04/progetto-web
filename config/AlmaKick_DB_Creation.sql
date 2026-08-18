/*
Creazione database Almakick.

lo schema seguito è il seguente:

**User**
- id_user (PK)
- friend_code (UNIQUE)
- username (UNIQUE)
- name
- surname
- mail (UNIQUE)
- phone
- password (hash)
- role
- register_date

**Friendship**
- id_friendship (PK)
- id_requester (FK User)
- id_receiver (FK User)
- friendship_status
- request_date 
- UNIQUE (id_requester, id_receiver)
- CHECK (id_richiedente != id_ricevente)

**Match**
- id_match (PK)
- id_host (FK User)
- status
- date
- hour
- visibility
- format
- place
- max_players
- total_cost
- result_team_a
- result_team_b

**Partecipation**
- id_partecipation (PK)
- id_match (FK Match)
- id_user (FK User)
- team
- status
- goals
- UNIQUE (id_match, id_user)

**Rating**
- id_rating (PK)
- id_match (FK Match)
- id_user_rated (FK User)
- id_user_rating (FK User)
- vote
- comment
- rating_date
- UNIQUE (id_match, id_user_rating, id_user_rated)
- CHECK (id_user_rating != id_user_rated)
*/

CREATE DATABASE IF NOT EXISTS `almakick` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `almakick`;

DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `friendship`;
DROP TABLE IF EXISTS `match`;
DROP TABLE IF EXISTS `partecipation`;
DROP TABLE IF EXISTS `rating`;

CREATE TABLE `user` (
    `id_user` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `friend_code` varchar(10) DEFAULT NULL,
    `username` varchar(20) NOT NULL,
    `name` varchar(20) NOT NULL,
    `surname` varchar(20) NOT NULL,
    `mail` varchar(100) NOT NULL,
    `phone` varchar(20) NOT NULL,
    `password` varchar(255) NOT NULL,
    `role` enum('user', 'admin') NOT NULL DEFAULT 'user',
    `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    
    UNIQUE (friend_code),
    UNIQUE (username),
    UNIQUE (mail)
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;