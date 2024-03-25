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
);

CREATE TABLE IF NOT EXISTS tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tweet_text VARCHAR(280) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS followers (
    follower_id INT,
    followed_id INT,
    PRIMARY KEY (follower_id,followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (followed_id) REFERENCES users(id)
    
);

CREATE TABLE IF NOT EXISTS message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_text VARCHAR(250) NOT NULL,
    userSend_id INT,
    userRecive_id INT,
    FOREIGN KEY (userSend_id) REFERENCES users(id),
    FOREIGN KEY (userRecive_id) REFERENCES users(id)
    
);

CREATE TABLE IF NOT EXISTS comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text VARCHAR(250) NOT NULL,
    user_id INT,
    tweet_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id) 
);

CREATE TABLE IF NOT EXISTS like (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);

CREATE TABLE IF NOT EXISTS retweet (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);

CREATE TABLE IF NOT EXISTS picture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pic_uri VARCHAR(255) NULL,
    tweet_id INT,
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);


INSERT INTO users (firstname, lastname, username, bio, email, pwd, profile_pic) VALUES
('Hugo', 'Raguin', 'boubou', 'Développeur full-stack passionné par les nouvelles technologies.', 'hugo@example.com', 'motdepassehash', 'path/to/image1.jpg'),
('Alex', 'Dupont', 'alexdu', 'Fan de randonnée et de photographie.', 'alex@example.com', 'unautremotdepasse', 'path/to/image2.jpg'),
('Marie', 'Curie', 'mariecurie', 'Chercheuse en physique et en chimie, passionnée par la science.', 'marie@example.com', 'motdepasseencore', 'path/to/image3.jpg');

