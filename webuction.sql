DROP DATABASE IF EXISTS webuction;
CREATE DATABASE webuction DEFAULT CHARACTER SET utf8;
use webuction;

# CREATE TABLES
CREATE TABLE user(
    user_id                 INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name               VARCHAR(150) NOT NULL,
    user_email              VARCHAR(150) NOT NULL,
    user_pw                 CHAR(32) NOT NULL,
    user_right              VARCHAR(30) NOT NULL DEFAULT 'Member'
);

CREATE TABLE item(
	item_id					INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	item_name				VARCHAR(150) NOT NULL,
	item_desc				TEXT,
	item_price				DECIMAL(18, 2) NOT NULL,
	item_added_at			DATETIME,
	item_added_by			INT NOT NULL
);

# TABLE INSERT
INSERT INTO user(user_name, user_email, user_pw, user_right) VALUES 
('AlenV', 'alen.varazdinac@gmail.com', md5('123'), 'Admin'),
('User', 'user@gmail.com', md5('123'), 'Member');

INSERT INTO item(item_name, item_desc, item_price, item_added_by) VALUES
('My item 1', 'Description for item 1', '512.99', 1),
('My item 2', 'Description for item 2', '251.59', 1),
('My item 3', 'Description for item 3', '512.99', 1),
('My item 4', 'Description for item 4', '251.59', 1),
('My item 5', 'Description for item 5', '512.99', 1),
('My item 6', 'Description for item 6', '251.59', 1),
('My item 7', 'Description for item 7', '512.99', 1),
('My item 8', 'Description for item 8', '251.59', 1),
('OtherItem 1', 'Description for other item 1', '312.52', 2),
('OtherItem 2', 'Description for other item 2', '312.52', 2);