CREATE DATABASE IF NOT EXISTS play_card;

USE play_card;

CREATE TABLE IF NOT EXISTS card_variations (
    id SERIAL PRIMARY KEY,
    type VARCHAR(255),
    num int,
    image VARCHAR(255)
);
