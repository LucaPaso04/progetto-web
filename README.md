# Alma Kick

Di seguito le informazioni base sul progetto AlmaKick.

## Schema DB

Le tabelle scelte per il database del progetto sono le seguenti:

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