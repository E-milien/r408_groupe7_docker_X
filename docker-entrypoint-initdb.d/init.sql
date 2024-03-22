create database twitter7;

use twitter7;

CREATE TABLE users (
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

CREATE TABLE tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tweet_text VARCHAR(280) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE followers (
    follower_id INT,
    followed_id INT,
    PRIMARY KEY (follower_id,followed_id),
    FOREIGN KEY (follower_id) REFERENCES users(id),
    FOREIGN KEY (followed_id) REFERENCES users(id)
    
);

CREATE TABLE message (
    id INT AUTO_INCREMENT PRIMARY KEY,
    message_text VARCHAR(250) NOT NULL,
    userSend_id INT,
    userRecive_id INT,
    FOREIGN KEY (userSend_id) REFERENCES users(id),
    FOREIGN KEY (userRecive_id) REFERENCES users(id)
    
);

CREATE TABLE comment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_text VARCHAR(250) NOT NULL,
    user_id INT,
    tweet_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id) 
);

CREATE TABLE like (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);

CREATE TABLE retweet (
    user_id INT,
    tweet_id INT,
    PRIMARY KEY (user_id,tweet_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);

CREATE TABLE picture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pic_uri VARCHAR(255) NULL,
    tweet_id INT,
    FOREIGN KEY (tweet_id) REFERENCES tweets(id)
);



