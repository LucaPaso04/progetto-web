USE `almakick`;

START TRANSACTION;

INSERT INTO `user`
    (`friend_code`, `username`, `name`, `surname`, `mail`, `phone`, `password`, `role`)
VALUES
    ('TEST001', 'luca_test', 'Luca', 'Rossi', 'luca.test@example.com', '3331111111', 'test123', 'user');

SET @host_id = LAST_INSERT_ID();

INSERT INTO `user`
    (`friend_code`, `username`, `name`, `surname`, `mail`, `phone`, `password`, `role`)
VALUES
    ('TEST002', 'marco_test', 'Marco', 'Bianchi', 'marco.test@example.com', '3332222222', 'test123', 'user');

SET @player_id = LAST_INSERT_ID();

INSERT INTO `match`
    (`id_host`, `status`, `date`, `hour`, `visibility`, `format`,
     `place`, `max_players`, `total_cost`)
VALUES
    (@host_id, 'programmed', '2026-09-15', '20:30:00', 'public',
     '5v5', 'Centro Sportivo Milano', 10, 80);

SET @match_one_id = LAST_INSERT_ID();

INSERT INTO `match`
    (`id_host`, `status`, `date`, `hour`, `visibility`, `format`,
     `place`, `max_players`, `total_cost`)
VALUES
    (@host_id, 'programmed', '2026-09-18', '21:00:00', 'private',
     '7v7', 'Campo Comunale', 14, 120);

SET @match_two_id = LAST_INSERT_ID();

INSERT INTO `partecipation`
    (`id_match`, `id_user`, `team`, `status`, `goals`)
VALUES
    (@match_one_id, @host_id, 'A', 'waiting', 0),
    (@match_two_id, @player_id, 'B', 'waiting', 0);

COMMIT;