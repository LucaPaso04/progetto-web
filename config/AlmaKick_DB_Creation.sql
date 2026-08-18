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

DROP TABLE IF EXISTS `rating`;
DROP TABLE IF EXISTS `partecipation`;
DROP TABLE IF EXISTS `friendship`;
DROP TABLE IF EXISTS `match`;
DROP TABLE IF EXISTS `user`;


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

CREATE TABLE `friendship` (
    `id_friendship` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_requester` int NOT NULL,
    `id_receiver` int NOT NULL,
    `friendship_status` enum('pending', 'accepted', 'rejected', 'blocked') NOT NULL DEFAULT 'pending',
    `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

    UNIQUE (`id_requester`, `id_receiver`),
    CHECK (`id_requester` <> `id_receiver`),

    /*Per cancellare, e aggiornare i riferimenti dello user 
    all'id del requester */
    CONSTRAINT `fk_friendship_requester`
    FOREIGN KEY (`id_requester`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT `fk_friendship_receiver`
    FOREIGN KEY (`id_receiver`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `match` (
    `id_match` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_host` int NOT NULL,
    `status` enum('programmed', 'playing', 'ended', 'canceled') NOT NULL DEFAULT 'programmed',
    `date` date NOT NULL,
    `hour` time NOT NULL,
    `visibility` enum('public', 'private') NOT NULL DEFAULT 'private',
    `format` enum('5v5', '7v7', '11v11') NOT NULL DEFAULT '5v5',
    `place` varchar(100) NOT NULL,
    `max_players` int NOT NULL,
    `total_cost` int NOT NULL,
    `result_team_a` int DEFAULT NULL,
    `result_team_b` int DEFAULT NULL,

    CONSTRAINT `fk_match_host`
    FOREIGN KEY (`id_host`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `partecipation` (
    `id_partecipation` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_match` int NOT NULL,
    `id_user` int NOT NULL,
    `team` enum('A', 'B') NOT NULL,
    `status` enum('invited', 'played', 'refused', 'waiting') NOT NULL,
    `goals` int DEFAULT 0,

    UNIQUE(`id_match`, `id_user`),
    CHECK (`goals` >= 0),

    CONSTRAINT `fk_match_partecipation`
    FOREIGN KEY (`id_match`)
    REFERENCES `match` (`id_match`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT `fk_user_partecipation`
    FOREIGN KEY (`id_user`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `rating` (
    `id_rating` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_match` int NOT NULL,
    `id_user_rated` int NOT NULL,
    `id_user_rating` int NOT NULL,
    `vote` int NOT NULL,
    `comment` varchar(200) DEFAULT NULL,
    `rating_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,

    UNIQUE(`id_match`, `id_user_rated`, `id_user_rating`),
    CHECK (`id_user_rated` <> `id_user_rating`),
    CHECK (`vote` BETWEEN 1 AND 10),

    CONSTRAINT `fk_match_rating`
    FOREIGN KEY (`id_match`)
    REFERENCES `match` (`id_match`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT `fk_user_rated`
    FOREIGN KEY (`id_user_rated`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,

    CONSTRAINT `fk_user_rating`
    FOREIGN KEY (`id_user_rating`)
    REFERENCES `user` (`id_user`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_unicode_ci;