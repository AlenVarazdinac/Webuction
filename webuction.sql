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
	item_starting_price		DECIMAL(18, 2) NOT NULL,
	item_added_at			DATETIME,
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

CREATE TABLE item_bid(
    item_id                 INT NOT NULL,
    bid_id                  INT NOT NULL
);

# TABLE INSERT
INSERT INTO user(user_name, user_email, user_pw, user_right) VALUES 
('AlenV', 'alen.varazdinac@gmail.com', md5('123'), 'Admin'),
('User', 'user@gmail.com', md5('123'), 'Member');

INSERT INTO item(item_name, item_desc, item_starting_price, item_added_by, item_live) VALUES
('My item 1', 'Description for item 1', '512.99', 1, 0),
('My item 2', 'Description for item 2', '251.59', 1, 0),
('My item 3', 'Description for item 3', '512.99', 1, 0),
('My item 4', 'Description for item 4', '251.59', 1, 1),
('My item 5', 'Description for item 5', '512.99', 1, 1),
('My item 6', 'Description for item 6', '251.59', 1, 0),
('My item 7', 'Description for item 7', '512.99', 1, 1),
('My item 8', 'Description for item 8', '251.59', 1, 1),
('OtherItem 1', 'Description for other item 1', '312.52', 2, 1),
('OtherItem 2', 'Description for other item 2', '312.52', 2, 0);

# TABLE ALTER
ALTER TABLE item ADD FOREIGN KEY (item_added_by) REFERENCES user(user_id);

ALTER TABLE bid ADD FOREIGN KEY (bid_item) REFERENCES item(item_id);
ALTER TABLE bid ADD FOREIGN KEY (bid_user) REFERENCES user(user_id);

ALTER TABLE item_bid ADD FOREIGN KEY (item_id) REFERENCES item(item_id);
ALTER TABLE item_bid ADD FOREIGN KEY (bid_id) REFERENCES bid(bid_id);