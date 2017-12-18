DROP DATABASE IF EXISTS webuction;
CREATE DATABASE webuction DEFAULT CHARACTER SET utf8;
use webuction;

SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT;
SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS;
SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION;
SET NAMES utf8;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0; 

# --- Create Tables ---
CREATE TABLE user(
    user_id                 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name               VARCHAR (150) NOT NULL,
    user_email              VARCHAR (150) NOT NULL,
    user_pw                 CHAR (32) NOT NULL,
    user_right              VARCHAR (20) NOT NULL DEFAULT 'Member',
    user_balance            DECIMAL (18,2) NOT NULL DEFAULT 1000
);

CREATE TABLE item(
    item_id                 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    item_name               VARCHAR (150) NOT NULL,
    item_desc               TEXT NOT NULL,
    item_starting_price     DECIMAL (18,2) NOT NULL,
    item_owner              INT NOT NULL,
    item_added_at           DATETIME NOT NULL,
    item_starting_at        DATETIME NOT NULL,
    item_ending_at          DATETIME NOT NULL,
    item_live               TINYINT (1) NOT NULL DEFAULT 0
);

CREATE TABLE inventory(
    inventory_id            INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    inventory_owner         INT NOT NULL,
    inventory_item          INT NOT NULL
);

CREATE TABLE bid(
    bid_id                  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    bid_by                  INT NOT NULL,
    bid_item                INT NOT NULL,
    bid_amount              DECIMAL (18,2) NOT NULL DEFAULT 0.00
);

# --- Alter Tables ---
ALTER TABLE item ADD FOREIGN KEY (item_owner) REFERENCES user(user_id);

ALTER TABLE inventory ADD FOREIGN KEY (inventory_owner) REFERENCES user(user_id);
ALTER TABLE inventory ADD FOREIGN KEY (inventory_item) REFERENCES item(item_id);

ALTER TABLE bid ADD FOREIGN KEY (bid_by) REFERENCES user(user_id);
ALTER TABLE bid ADD FOREIGN KEY (bid_item) REFERENCES item(item_id);

# --- Table Inserts ---
INSERT INTO user(user_name, user_email, user_pw, user_right) VALUES
('AlenV', 'alen.varazdinac@gmail.com', md5('123'), 'Admin'),
('User', 'user@gmail.com', md5('123'), 'Member'),
('User2', 'user2@gmail.com', md5('123'), 'Member');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT;
SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS;
SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION;
SET SQL_NOTES=@OLD_SQL_NOTES;


/*
# CREATE TABLES
CREATE TABLE user(
    user_id                 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name               VARCHAR(150) NOT NULL,
    user_email              VARCHAR(150) NOT NULL,
    user_pw                 CHAR(32) NOT NULL,
    user_right              VARCHAR(30) NOT NULL DEFAULT 'Member',
    user_balance            DECIMAL(18,2) NOT NULL DEFAULT 1000
);

CREATE TABLE item(
	item_id					INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	item_name				VARCHAR(150) NOT NULL,
	item_desc				TEXT NOT NULL,
	item_starting_price		DECIMAL(18, 2) NOT NULL,
    item_added_at           DATETIME NOT NULL,
	item_starting_at		DATETIME NOT NULL,
    item_ending_at          DATETIME NOT NULL,
	item_added_by			INT NOT NULL,
    item_live               TINYINT(1) NOT NULL DEFAULT 0,
    item_highest_bid        DECIMAL(18,2) NOT NULL DEFAULT 0.0
);

CREATE TABLE bid(
    bid_id                  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    bid_item                INT NOT NULL,
    bid_user                INT NOT NULL,
    bid_amount              DECIMAL(18,2) NOT NULL
);

CREATE TABLE inventory(
    inventory_id            INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    inventory_owner         INT NOT NULL,
    inventory_item          INT NOT NULL
);

# TABLE INSERT
INSERT INTO user(user_name, user_email, user_pw, user_right) VALUES 
('AlenV', 'alen.varazdinac@gmail.com', md5('123'), 'Admin'),
('User', 'user@gmail.com', md5('123'), 'Member'),
('User2', 'user2@gmail.com', md5('123'), 'Member');

# TABLE ALTER
ALTER TABLE item ADD FOREIGN KEY (item_added_by) REFERENCES user(user_id);

ALTER TABLE bid ADD FOREIGN KEY (bid_item) REFERENCES item(item_id);
ALTER TABLE bid ADD FOREIGN KEY (bid_user) REFERENCES user(user_id);

ALTER TABLE inventory ADD FOREIGN KEY (inventory_item) REFERENCES item(item_id);
*/