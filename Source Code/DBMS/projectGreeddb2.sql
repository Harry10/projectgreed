use htun;
SET FOREIGN_KEY_CHECKS=0;

/*DROP TABLE IF EXISTS stock;
DROP TABLE IF EXISTS account;*/
/*DROP TABLE IF EXISTS portfolio;
DROP TABLE IF EXISTS competition;*/
DROP TABLE IF EXISTS historical_info;

/*CREATE TABLE stock
(stock_id INTEGER(8) NOT NULL,
stock_name VARCHAR(32) NOT NULL,
stock_value FLOAT(16),
quantity INTEGER(16),
portfolio_id INTEGER(8),
PRIMARY KEY(stock_id),
FOREIGN KEY(portfolio_id) REFERENCES portfolio(portfolio_id))ENGINE=InnoDB;

CREATE TABLE portfolio
(portfolio_id INTEGER(8) NOT NULL,
active BOOLEAN,
capital FLOAT(32),
username VARCHAR(32) NOT NULL,
stock_id INTEGER(8),
competition_id INTEGER(8),
portfolio_name VARCHAR(32),
PRIMARY KEY(portfolio_id),
FOREIGN KEY(competition_id) REFERENCES competition(competition_id),
FOREIGN KEY(username) REFERENCES account(username))ENGINE=InnoDB;

CREATE TABLE competition
(competition_id INTEGER(8) NOT NULL,
username VARCHAR(32),
fee FLOAT(32),
duration INTEGER(16),
date_created DATE,
winner VARCHAR(32),
PRIMARY KEY(competition_id),
FOREIGN KEY(username) REFERENCES account(username))ENGINE=InnoDB;*/

CREATE TABLE historical_info
(hportfolio_id INTEGER(8) NOT NULL,
hvalue INTEGER(16),
date_taken DATETIME NOT NULL,
PRIMARY KEY(hportfolio_id,date_taken))ENGINE=InnoDB;

CREATE TABLE account
(username VARCHAR(32) NOT NULL,
user_password VARCHAR(32),
PRIMARY KEY(username))ENGINE=InnoDB;
