use twitterbdd;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    bio TEXT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    birthdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    profile_pic VARCHAR(255) NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tweet_text VARCHAR(280) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS followers (
    follower_id INT,
    followed_id INT,
    PRIMARY KEY (follower_id,followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (followed_id) REFERENCES users(id)
    
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_text VARCHAR(250) NOT NULL,
    userSend_id INT,
    userRecive_id INT,
    FOREIGN KEY (userSend_id) REFERENCES users(id),
    FOREIGN KEY (userRecive_id) REFERENCES users(id)
    
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text VARCHAR(250) NOT NULL,
    user_id INT,
    tweet_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS likes (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS retweet (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS picture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pic_uri VARCHAR(255) NULL,
    tweet_id INT,
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;


INSERT INTO users (firstname, lastname, username, bio, email, pwd, birthdate, profile_pic) 
VALUES -- tout les mdp sont : coucou
  ('John', 'Doe', 'mechantBTC', 'Developer', 'john@example.com', '$2y$12$yibbfGLsQQyXm3QMSloRKO15joRH8i8n5Rm1WdCiOptF.DKEHOWKq', '1990-01-01', 'profile_pic.jpg'),
  ('Quentin', 'laval', 'lionel_pessi', 'Designer', 'alice@example.com', '$2y$12$yibbfGLsQQyXm3QMSloRKO15joRH8i8n5Rm1WdCiOptF.DKEHOWKq', '1992-05-15', 'avatar.jpg'),
  ('Emily', 'Johnson', 'loserEnP3', 'Writer', 'emily@example.com', '$2y$12$yibbfGLsQQyXm3QMSloRKO15joRH8i8n5Rm1WdCiOptF.DKEHOWKq', '1988-08-20', 'emily_pic.jpg'),
  ('Michael', 'Brown', 'farfadetMalicieux', 'Photographer', 'michael@example.com', '$2y$12$yibbfGLsQQyXm3QMSloRKO15joRH8i8n5Rm1WdCiOptF.DKEHOWKq', '1985-04-12', 'mike_pic.jpg'),
  ('Sophia', 'Wilson', 'ClassiquePosey', 'Artist', 'sophia@example.com', '$2y$12$yibbfGLsQQyXm3QMSloRKO15joRH8i8n5Rm1WdCiOptF.DKEHOWKq', '1995-10-30', 'sophia_pic.jpg');

INSERT INTO tweets (user_id, tweet_text, created_at) 
VALUES 
  (1, 'Le bitcoin est monté je suis riche!!', '2024-03-31 08:12:00'),
  (2, 'Hier jai dockerisé mon site, grave dure ! pas vrai la team ?', '2024-04-01 15:24:00'),
  (3, 'Fock jai vendu mes BTC avant que ca monte..', '2024-03-29 18:37:00'),
  (1, 'NAPS meilleur rappeur, "pas de galenterie a par pour voir ton.." un classique!', '2024-03-29 22:56:00'),
  (2, 'Ratio macron, cette fraude', '2024-03-30 11:45:00');



INSERT INTO followers (follower_id, followed_id) 
VALUES 
  (1, 2),  -- John (ID: 1) suit Alice (ID: 2)
  (3, 1),  -- Emily (ID: 3) suit John (ID: 1)
  (2, 3),  -- Michael (ID: 2) suit Emily (ID: 3)
  (1, 4),  -- John (ID: 1) suit Sophia (ID: 4)
  (2, 1),  -- Michael (ID: 2) suit John (ID: 1)
  (3, 2);  -- Emily (ID: 3) suit Alice (ID: 2)


INSERT INTO message (message_text, userSend_id, userRecive_id) 
VALUES 
  ('Bonjour Alice!', 1, 2),  -- John (ID: 1) envoie un message à Alice (ID: 2)
  ('Salut John!', 2, 1),  -- Alice (ID: 2) répond à John (ID: 1)
  ('Hi Emily, love your work!', 1, 3),  -- John (ID: 1) envoie un message à Emily (ID: 3)
  ('Thanks for the follow!', 3, 2),  -- Emily (ID: 3) répond à Michael (ID: 2)
  ('Let''s collaborate!', 4, 2),  -- Sophia (ID: 4) envoie un message à Michael (ID: 2)
  ('Good morning!', 2, 3),  -- Michael (ID: 2) envoie un message à Emily (ID: 3)
  ('Nice weather today!', 3, 1),  -- Emily (ID: 3) envoie un message à John (ID: 1)
  ('Hello everyone!', 4, 1);  -- Sophia (ID: 4) envoie un message à John (ID: 1)


INSERT INTO comments (comment_text, user_id, tweet_id, created_at) 
VALUES 
  ('tu m''etonne me dis pas t''avais le super prof, monsieur diard ?', 1, 2, '2024-04-01 09:30:00'),  -- John (ID: 1) commente le tweet d'Alice (ID: 2)
  ('t''es gucci wola', 2, 1, '2024-03-31 10:45:00'),  -- Alice (ID: 2) répond au commentaire de John (ID: 1)
  ('dommage :(', 2, 3, '2024-03-29 14:20:00'),  -- Michael (ID: 2) commente le tweet d'Emily (ID: 3)
  ('je prefere okay okay perso', 3, 4, '2024-03-30 17:55:00'),  -- Emily (ID: 3) commente le tweet de John (ID: 4)
  ('Finito', 1, 5, '2024-03-29 21:10:00'),  -- John (ID: 1) commente le tweet de Michael (ID: 5)
  ('RIP', 4, 2, '2024-03-29 23:40:00'),  -- Sophia (ID: 4) commente le tweet d'Emily (ID: 2)
  ('le seum que tu dois avoir', 1, 3, '2024-03-30 08:15:00'),  -- Alice (ID: 2) commente le tweet de Michael (ID: 3)
  ('ahhh chanceux', 3, 1, '2024-04-01 12:25:00');  -- Emily (ID: 3) commente le tweet de John (ID: 1)


INSERT INTO likes (user_id, tweet_id) 
VALUES 
  (1, 2),  -- John (ID: 1) aime le tweet d'Alice (ID: 2)
  (2, 3),  -- Alice (ID: 2) aime le tweet de Michael (ID: 3)
  (3, 4),  -- Emily (ID: 3) aime le tweet de John (ID: 4)
  (4, 5),  -- Sophia (ID: 4) aime le tweet de Michael (ID: 5)
  (5, 1),  -- Sophia (ID: 5) aime le tweet de John (ID: 1)
  (1, 3);  -- John (ID: 1) aime le tweet d'Emily (ID: 3)


INSERT INTO retweet (user_id, tweet_id) 
VALUES 
  (1, 2),  -- John (ID: 1) retweet le tweet d'Alice (ID: 2)
  (2, 3),  -- Alice (ID: 2) retweet le tweet de Michael (ID: 3)
  (3, 4),  -- Emily (ID: 3) retweet le tweet de John (ID: 4)
  (4, 5),  -- Sophia (ID: 4) retweet le tweet de Michael (ID: 5)
  (5, 1),  -- Sophia (ID: 5) retweet le tweet de John (ID: 1)
  (1, 3);  -- John (ID: 1) retweet le tweet d'Emily (ID: 3)


INSERT INTO picture (pic_uri, tweet_id) 
VALUES 
  ('pic1.jpg', 1),  -- Une image attachée au tweet de John (ID: 1)
  ('pic2.jpg', 2),  -- Une image attachée au tweet d'Alice (ID: 2)
  ('pic3.jpg', 3),  -- Une image attachée au tweet d'Emily (ID: 3)
  ('pic4.jpg', 4),  -- Une image attachée au tweet de John (ID: 4)
  ('pic5.jpg', 5),  -- Une image attachée au tweet de Michael (ID: 5)
  ('pic6.jpg', 1),  -- Une image attachée au tweet de John (ID: 1)
  ('pic7.jpg', 2),  -- Une image attachée au tweet d'Alice (ID: 2)
  ('pic8.jpg', 3),  -- Une image attachée au tweet d'Emily (ID: 3)
  ('pic9.jpg', 4),  -- Une image attachée au tweet de John (ID: 4)
  ('pic10.jpg', 5);  -- Une image attachée au tweet de Michael (ID: 5)

